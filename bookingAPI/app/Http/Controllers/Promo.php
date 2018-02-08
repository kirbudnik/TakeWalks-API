<?php

/**
 * Walks Promo API
 *
 *
 * OpenAPI spec version: 1.0.0
 * Contact: admins@walks.org
 * 
 */

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Validator;
use Log;
use Carbon\Carbon;

use Walks\WapiConnect\WapiConnectController; 
use Walks\WapiConnect\WapiCommand; 
use App\Walks\Helpers\Utility;

use Walks\Adestra\AdestraContact;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class Promo extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {

        DB::connection()->enableQueryLog();
    }


    /**
     * Operation getDocsSwagger
     *
     * 
     *
     *
     * @return Http response
     */
    public function getDocsSwagger(Request $request)
    {
     Log::info('##################### getDocsSwagger #####################');


        $json = WapiConnectController::getApiDocs();

        return response($json);

    }

    public function getDocsHTML(Request $request)
    {
     Log::info('##################### getDocsHTML #####################');


        $json = WapiConnectController::getApiHTML();

        return response($json);

    }

    public function getPostman(Request $request)
    {
     Log::info('##################### getPostman #####################');


        $json = WapiConnectController::getPostman();

        return response($json);

    }

    /**
     * Apply promo to cart
     * if it passes all required criteria
     * 
     * @param Request $request
     */
    public function promoAdd(Request $request)
    {   
       Log::info('##################### promoAdd function #####################');
       
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'promo_code' => 'required'
        ]);

        if ($validator->fails()) {            
            Log::info('request : '.print_r($validator->errors(), true));
            return Utility::buildResponse(400, $validator->errors(), 'Validation error'); 
        }       

        $bookingId = $request->booking_id;
        $promoCode = trim($request->promo_code);

        
        $promoValid = $this->checkPromoValidity($bookingId, $promoCode);
        if (!$promoValid){
            return Utility::buildResponse(400, [], "promo isn't valid for these cart contents");         
        }
        
        $promoApplied = $this->applyPromo($bookingId, $promoCode);       
        if (!$promoApplied){
            return Utility::buildResponse(400, [], "promo can't be applied");         
        }
        
        return Utility::buildResponse(200, [$promoApplied]); 
    }

    /**
     * Remove promo from entire cart
     * 
     * @param int $bookingId
     * @return bool
     */
    public function promoDelete($bookingId) {   
        Log::info('##################### promoDelete function #####################');
       
        $this->removePromo($bookingId);       
        
        return Utility::buildResponse(200, [true]); 
    }
    
    /**
     * Verify promo is valid and can 
     * apply discount to the booking details
     * 
     * @param int $bookingId
     * @param string $promoCode
     * @return bool
     */
    public function checkPromoValidity($bookingId, $promoCode){
        $eventSpecificPromosArr = $resultArr = [];

        $errorTitle = "Promo code {$promoCode}:";
        
        $bookingPromo = \App\Models\BookingsPromo::where(['promo_code'=>$promoCode, 'active'=>1])->first();
        if (is_null($bookingPromo)) {
            $errorMessage = "{$errorTitle} not found or inactive"; 
            Log::info($errorMessage);
            return false;
        }

        if ($bookingPromo && $bookingPromo->events_id){
            $eventSpecificPromosArr = explode(',', $bookingPromo->events_id);
        }

        //Get all booking detail recs in cart
        $bookingDetailRecs = app('App\Http\Controllers\Booking')->getUnpaidBookingDetailRecords($bookingId);    
        if (!$bookingDetailRecs){
            $errorMessage = "{$errorTitle} not booking detail records found"; 
            Log::info($errorMessage);
            return false;
        }
        
        foreach($bookingDetailRecs as $bdRec){
            $errorMessage = null;
            $success = true;
            $eventDisabled = false;
            
            $bookingDetailId = $bdRec->id;
            $eventId = $bdRec->events_id; 
            $eventDate = date('Y-m-d', strtotime($bdRec->events_datetimes));
            $bookingTotalsByCurrencyCodeArr = app('App\Http\Controllers\Booking')
                    ->getBookingsCurrenciesExchangeAmountForEntireBooking($bookingId);
            //Get the full price in this specific currency
            $fullAmount = $bookingTotalsByCurrencyCodeArr[$bookingPromo->promo_exchange_currency]['amount_full_price'];            
            $eventRec = \App\Models\Event::find($eventId);
            if (!$eventRec || $eventRec->disable_promos == 1){
                $eventDisabled = true;
            }
            
            //-----------------------------------
            //Check each condition of promo validity 
            //and return error if not valid
            //-----------------------------------        
            if ($eventDisabled){
                //This event doesn't allow for promos to be used
                $errorMessage = "event id {$eventId} has promo disabled";
            }elseif ($fullAmount < floatval($bookingPromo->min_cart_value) ){
                //Minimum amount in cart not met
                $errorMessage = "minimum amount of {$bookingPromo->min_cart_value} not met";
            }elseif(count($bookingDetailRecs) < $bookingPromo->min_events ){
                //Minimum events in cart not met
                $errorMessage = "minimum number of {$bookingPromo->min_events} events in cart not met";
            }elseif($bookingPromo->booking_start_date > $bdRec->booking_date || $bookingPromo->booking_end_date < $bdRec->booking_date){
                //booking date range not met
                $errorMessage = "{$bdRec->booking_date} out of booking date range";
            }elseif($bookingPromo->event_start_date > $eventDate || $bookingPromo->event_end_date < $eventDate){
                //event date range not met
                $errorMessage = "{$eventDate} out of event date range";
            }elseif ($bookingPromo->events_id && !in_array($eventId, $eventSpecificPromosArr)){
                //promo only for specific events and it wasn't found
                $errorMessage = "event '{$eventRec->name_short}' not allowed for this promo";
            }
            
            if ($errorMessage){
                $errorMessage = "{$errorTitle} {$errorMessage}";
                Log::info($errorMessage);
                $success = false;
            }

            //Save each booking detail
            $resultArr[$bookingDetailId] = $success;          
        }     

        //Loop through all results and see if at lease 1 event is valid for a promo
        foreach($resultArr as $bdId => $status){
            if ($status){    
                return true;
            }
        }
        return false;
    }
  
    /**
     * 
     * @param int $bookingId
     * @param string $promoCode
     */
    public function applyPromo($bookingId, $promoCode){
        $bookingPromo = \App\Models\BookingsPromo::where(['promo_code'=>$promoCode, 'active'=>1])->first();
        if (is_null($bookingPromo)) {
            Log::info("no active promo found for {$promoCode}");
            return false;
        }
        
        //Get all booking detail recs in cart
        $bookingDetailRecs = app('App\Http\Controllers\Booking')->getUnpaidBookingDetailRecords($bookingId);    
        if (!$bookingDetailRecs){
            Log::info("not booking detail records found for booking id {$bookingId}");
            return false;
        }

        //Clear our any existing promo on tour
        $this->removePromo($bookingId);
        
        $bookingPromo->evergreen;
        $bookingPromo->discount_amount;
        $bookingPromo->fixed;
        $bookingPromo->fixed_cart;
        $bookingPromo->booking_start_date;
        $bookingPromo->booking_end_date;
        $bookingPromo->event_start_date;
        $bookingPromo->event_end_date;
        $eventsIdArr = explode(',',$bookingPromo->events_id);
        $bookingPromo->min_events;
        $bookingPromo->min_cart_value;
                
        $isPercentage = ($bookingPromo->fixed) ? false : true;
        $fullCartDiscount ($bookingPromo->fixed_cart) ? true : false;
        $allEvents = (empty($eventsIdArr)) ? true : false;
        
        $bookingTotalsByCurrencyCodeArr = app('App\Http\Controllers\Booking')
                    ->getBookingsCurrenciesExchangeAmountForEntireBooking($bookingId);
        //Get the full price in this specific currency
        $fullAmount = $bookingTotalsByCurrencyCodeArr[$bookingPromo->promo_exchange_currency]['amount_full_price'];
            
        foreach($bookingDetailRecs as $bdRec){
            $bookingDetailId = $bdRec->id;
            $eventId = $bdRec->events_id; 
            $eventDate = date('Y-m-d', strtotime($bdRec->events_datetimes));
                        
            $eventRec = \App\Models\Event::find($eventId);
            if (!$eventRec || $eventRec->disable_promos == 1){
                continue;
            }
            
            
            if ($fullCartDiscount && $fullAmount < floatval($bookingPromo->min_cart_value) ){
                continue;
            }elseif(count($bookingDetailRecs) < $bookingPromo->min_events ){
                continue;
            }elseif($bookingPromo->booking_start_date > $bdRec->booking_date || $bookingPromo->booking_end_date < $bdRec->booking_date){
                continue;
            }elseif($bookingPromo->event_start_date > $eventDate || $bookingPromo->event_end_date < $eventDate){
                continue;
            }elseif ($bookingPromo->events_id && !in_array($eventId, $eventSpecificPromosArr)){
                continue;
            }
 
        }
        
    }
    
    
    /**
     * Remove promo for any booking detail
     * records and update prices to 
     * their original full amount
     * 
     * @param int $bookingId
     * @return boolean
     */
    public function removePromo($bookingId){
        $bookingDetailIdArr = [];

        $bookingDetailRecs = app('App\Http\Controllers\Booking')->getUnpaidBookingDetailRecords($bookingId);    
        if (!$bookingDetailRecs){
            return false;
        }
        foreach($bookingDetailRecs as $bdRec){
            $bookingDetailIdArr[] = $bdRec->id;
        }
        
        //Reset amount back to full price
        \App\Models\BookingsDetailsExchangeRate::whereIn('bookings_details_id', $bookingDetailIdArr)
                    ->update([
                        'amount' => DB::raw('bookings_details_exchange_rates.amount_full_price')
                    ]);
        
        //Wipe out existing promo from booking detail records 
        \App\Models\BookingsDetail::whereIn('id',$bookingDetailIdArr)
                    ->update([
                        'imported_promo' => null
                    ]);
        
        return true;
    }
        
}