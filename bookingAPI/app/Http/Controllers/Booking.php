<?php
/**
 * Walks Booking API
 *
 * OpenAPI spec version: 1.0.0
 * Contact: admins@walks.org
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Log;
use Carbon\Carbon;
use App\Walks\Config;
use App\Walks\Helpers\Api;
use App\Walks\Helpers\Utility;
use Walks\Adestra\AdestraContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Booking extends Controller
{
    public $exchangeRateBuffer = .0035;
    
    private $_paymentAccounts = array(
        'AUD' => 239989,
        'CAD' => 239993,
        'EUR' => 239986,
        'GBP' => 239991,
        'USD' => 239983
    );
    
    /**
     * Constructor
     */
    public function __construct()
    {
        DB::connection()->enableQueryLog();
    }

    /**
     * Operation getDocsSwagger
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
     * Add individual product to booking.
     * as well as reserve inventory
     * 
     * @param Request $request
     * @return type array
     */
    public function productAdd(Request $request)
    {           
        Log::info('##################### productAdd #####################');
        $responseMessage = $existingPromoCode = null;
        $responseCode = 200;
        
        $validator = Validator::make($request->all(), [
            'stage_id' => 'required',
            'currency_code' => 'required',
        ]);

        if ($validator->fails()) {            
            Log::info('request : '.print_r($validator->errors(), true));
            return Utility::buildResponse(400, $validator->errors(), 'Validation error'); 
       } 
        
        //Trim of spaces from front/back of all incoming params
        foreach($request->all() as $key => $value){
            $request->$key = trim($value);
        }

        //Post params
        $stageId = $request->stage_id;
        $currencyCode = $request->currency_code;
        $bookingId = ($request->has('booking_id')) ? $request->booking_id : null;
        $numberAdults = ($request->has('number_adults')) ? $request->number_adults : 0;
        $numberSeniors = ($request->has('number_seniors')) ? $request->number_seniors : 0;
        $numberStudents = ($request->has('number_students')) ? $request->number_students : 0;
        $numberChildren = ($request->has('number_children')) ? $request->number_children : 0;
        $numberInfants = ($request->has('number_infants')) ? $request->number_infants : 0;

        //Get total sum of local amount
        $eventStage = \App\Models\EventsStage::find($stageId);
        if (!$eventStage){
            $responseMessage = "invalid stage id: {$stageId}";
            Log::info($responseMessage);
            return Utility::buildResponse(400, [], $responseMessage);
        }
        
        $adultPrice = floatval($numberAdults * $eventStage->adults_price);
        $seniorsPrice = floatval($numberSeniors * $eventStage->seniors_price);
        $studentsPrice = floatval($numberStudents * $eventStage->students_price);
        $childrenPrice = floatval($numberChildren * $eventStage->children_price);
        $infantsPrice = floatval($numberInfants * $eventStage->infants_price);        
        $amountLocal = $adultPrice + $seniorsPrice + $studentsPrice + $childrenPrice + $infantsPrice;
        
        //Get event details from decoded stage id
        $stageArr = Utility::decodeStageId($stageId);
        $groupType = $stageArr['gp'];
        $eventsId = $stageArr['events_id'];
        $eventsDatetime = date('Y-m-d h:i:s', strtotime($stageArr['datetime']));
        
        //Check inventory and availability
        $hasAvailability = $this->_checkAvailabilty($stageId, $numberAdults, $numberSeniors, $numberStudents, $numberChildren, $numberInfants);
        if (!$hasAvailability){
            $responseMessage = "not enough availability on this tour";
            Log::info($responseMessage);
            return Utility::buildResponse(400, [], $responseMessage);
        }

        //Get booking record or create new
        $booking = \App\Models\Booking::find($bookingId);
        if (!$booking){
            $booking = new \App\Models\Booking();
            $booking->save();
            $bookingId = $booking->id;
        }else{
            $bookingDetails = $this->getUnpaidBookingDetailRecords($bookingId);
            foreach($bookingDetails as $rec){
                if ($rec->imported_promo){
                    $existingPromoCode = $rec->imported_promo;
                    break;
                }
            }
        }
        
        //Create booking details record
        $bookingDetail = new \App\Models\BookingsDetail();
        $bookingDetail->bookings_id = $bookingId;
        $bookingDetail->number_adults = $numberAdults;
        $bookingDetail->number_seniors = $numberSeniors;
        $bookingDetail->number_students = $numberStudents;
        $bookingDetail->number_children = $numberChildren;
        $bookingDetail->number_infants = $numberInfants;
        $bookingDetail->stage_id = $stageId;
        $bookingDetail->events_id = $eventsId;
        $bookingDetail->events_datetimes = $eventsDatetime;
        $bookingDetail->booking_date = date('Y-m-d h:i:s');
        $bookingDetail->amount_local = $amountLocal;
        $bookingDetail->private_group = $groupType;
        $bookingDetail->date_modified = date('Y-m-d h:i:s');
        //bd rec needs field for hold status
        $bookingDetail->save();
        
        //Reserve spots on tour
        $availabilityReserved = $this->_reserveAvailabilty($bookingDetail->id, $stageId, $numberAdults, $numberSeniors, $numberStudents, $numberChildren, $numberInfants);
        
        if (!$availabilityReserved){
            //Delete booking detail record
            \App\Models\BookingsDetail::destroy($bookingDetail->id);     
            return Utility::buildResponse(400, [], "Not enough inventory left");
        }

        $this->_setCurrenciesExchangeFullAmount($bookingDetail->id, $amountLocal);

        if ($existingPromoCode){
            //run promo add logic
            app('App\Http\Controllers\Promo')->checkPromoValidity($bookingId, $existingPromoCode);
        }
        
        $bookingDetailArr = $this->_buildBookingDetailReturnData($bookingId);
        return Utility::buildResponse($responseCode, $bookingDetailArr, $responseMessage);        
    }    

    /**
     * Remove product from an exisiting booking
     * If its the only product in booking
     * then will delete the booking as well
     * 
     * @param type $bookingId
     */
    public function productDelete($bookingId, $stageId){
        Log::info('##################### productDelete #####################');
        
        $bookingDetailArr = $bookingDetailsIdArr = [];
        $responseMessage = "product was successfully deleted from booking";
        $responseCode = 200;
        
        //Get booking record
        $booking = \App\Models\Booking::find($bookingId);
        
        if (!$booking){
            $responseMessage = "no booking found for booking id: {$bookingId}";
            Log::info($responseMessage);
            return Utility::buildResponse(400, [], $responseMessage);
        }
       
        //Get all unpaid booking details
        $bookingDetailRecs = \App\Models\BookingsDetail::where(['bookings_id'=>$bookingId, 'is_paid'=>0, 'stage_id'=>$stageId])
                ->get();
        
        foreach($bookingDetailRecs as $bookingDetail){
            if ($this->_releaseAvailabilty($bookingDetail->id) ){
                $bookingDetailsIdArr[] = $bookingDetail->id;
            }

            //Remove currency data
            $this->_removeCurrenciesExchangeAmount($bookingDetail->id);
        }
                
        //Delete booking details released from inventory
        if ($bookingDetailsIdArr){
            \App\Models\BookingsDetail::destroy($bookingDetailsIdArr);
        }
            
        $bookingDetailRecCount  = \App\Models\BookingsDetail::where('bookings_id', $bookingId)->count();
        if ($bookingDetailRecCount == 0){
            //No remaining booking detail records, delete the booking rec.
            \App\Models\Booking::destroy($bookingId);            
        }
        
        return Utility::buildResponse($responseCode, [], $responseMessage);
    }

    /**
     * Return all unpaid booking details for a specific booking
     * 
     * @param type $bookingId
     */
    public function bookingRetrieve($bookingId){
        Log::info('##################### bookingRetrieve #####################');
        $bookingDetailArr = [];
        $responseMessage = null;
        $responseCode = 200;
        
        //Build return data
        $bookingDetailArr = $this->_buildBookingDetailReturnData($bookingId);

        if (empty($bookingDetailArr)) {
            $responseMessage = "no unpaid bookings found for booking id: {$bookingId}";
            Log::info($responseMessage);
            $responseCode = 400; //not found            
        }
        
        return Utility::buildResponse($responseCode, $bookingDetailArr, $responseMessage);
    }
    

    /**
     * Remove bookings and clear out "cart" contents
     * 
     * @param type $bookingId
     */
    public function bookingDelete($bookingId){
        Log::info('##################### bookingDelete #####################');

        $bookingDetailArr = $bookingDetailsIdArr = [];
        $responseMessage = "entire booking was deleted";
        $responseCode = 200;
        
        //Get booking record
        $booking = \App\Models\Booking::find($bookingId);
        if (!$booking){
            $responseMessage = "no booking found for booking id: {$bookingId}";
            Log::info($responseMessage);
            return Utility::buildResponse(400, [], $responseMessage);
        }
       
        $bookingDetailRecs  = \App\Models\BookingsDetail::where('bookings_id', $bookingId)->get();
        
        foreach($bookingDetailRecs as $bookingDetail){
            if ($bookingDetail->is_paid == 1){
                continue;
            }
            
            if ($this->_releaseAvailabilty($bookingDetail->id) ){
                $bookingDetailsIdArr[] = $bookingDetail->id;
            }            
            
            //Remove currency data
            $this->_removeCurrenciesExchangeAmount($bookingDetail->id);
        }
             
        //Delete booking details released from inventory
        $deletedRows = 0;
        if ($bookingDetailsIdArr){
            $deletedRows = \App\Models\BookingsDetail::destroy($bookingDetailsIdArr);
        }

        if ($deletedRows > 0 && $deletedRows == $bookingDetailRecs->count() ){
            //No remaining booking detail records, delete the booking rec.
            \App\Models\Booking::destroy($bookingId);            
        }
        
        return Utility::buildResponse($responseCode, [], $responseMessage);
    }
    
    
    /**
     * Step 1 of 2 in processing a booking.
     * Save client information and start the process of 
     * completing a booking
     * 
     * @param Request $request
     */
    public function bookingInitialize(Request $request) {
        Log::info('##################### bookingInitialize #####################');

        $responseMessage = null;
        $responseCode = 200;

        $agentId = $client = null;

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country_code' => 'required'
        ]);

        if ($validator->fails()) {            
            Log::info('request : '.print_r($validator->errors(), true));
            return Utility::buildResponse(400, $validator->errors(), 'Validation error');
        } 

        //Trim of spaces from front/back of all incoming params
        foreach($request->all() as $key => $value){
            $request->$key = trim($value);
        }

        //Post params
        $bookingId = $request->booking_id;
        $firstName = $request->first_name;
        $lastName = $request->last_name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $city = $request->city;
        $state = $request->state;
        $zip = $request->zip;
        $countryCode = $request->country_code;
        $agentIatta = ($request->has('agent_iatta')) ? $request->agent_iatta : null;
        $clientId = ($request->has('client_id')) ? $request->client_id : null;        

        $booking = \App\Models\Booking::find($bookingId);
        if (!$booking){
            return Utility::buildResponse(400, [], 'No booking found');
        }

        //Check if this is an agent making the booking
        $agent = \App\Models\Agent::where('email_address', $email)->first();
        
        if ($agent){
            //Attach agents id and generated travel agent email to client record
            $agentId = $agent->id;
            $email = 'TravelAgent-' . strtotime('now') . '@walks.org';
        }else{
            if ($clientId){
                //Check for client if client id passed in to get client rec
                $client = \App\Models\Client::find($clientId);
            }else{
                $client = \App\Models\Client::where('email', $email)->first();
            }
        }
        
        if (!$client){
            //Client not found by email.  Create new            
            $client = new \App\Models\Client;
            $client->account_status = 'active';
            $client->createdate = date('Y-m-d h:i:s');
        }

        $countryId = null;
        $country = \App\Models\Country::where('ccode', $countryCode)->first();
        if ($country){
            $countryId = $country->id;
        }elseif ($client->countries_id){
            $countryId = $client->countries_id;
        }
        
        $client->fname = $firstName;
        $client->lname = $lastName;
        $client->email = $email;
        $client->mobile_number = $phone;
        $client->address = $address;
        $client->city = $city;
        $client->state = $state;
        $client->zip = $zip;
        $client->countries_id = $countryId;
        $client->iata = $agentIatta;
        $client->agents_id = $agentId;
        
        if (!$client->save()) {
            $responseMessage = 'could not save client record';
            $responseCode = 400;
        }  
    
        //Update booking with client id and agent id (if any)
        $booking->clients_id = $client->id;
        $booking->agents_id = $agentId;
        $booking->save();

        return Utility::buildResponse($responseCode, [$bookingId], $responseMessage);
    }

    
    /**
     * Finalize the booking 
     * with optional payment information
     * 
     * @param Request $request
     * @return type
     */
    public function bookingFinalize(Request $request) {
        Log::info('##################### bookingFinalize #####################');
        /**
         * client id and booking id required
         * 
         * pass in sales channel param
         * pass currency paying
         * 
         * get currency prices
         * 
         * recheck if tour is still on sale and not closed yet.  TBD
         * 
         * call payment api
         * --error
         * ..cleanup of recs
         * ..return that error
         * 
         * --success
         * put following 3 into function together
         *  — Update Events Stages Call (Maybe Workflow) Function
         *  — Update reserves to Confirmed, limited to number of pax
            — Update Booking Details to paided... update DB to is_paid = 1 
         * ..send booking confirmation
         */
    
        $status = 200;
        $message = 'Checkout finalize was successful';
        
        $validator = Validator::make($request->all(), [
            'perform_charge' => 'required',
            'booking_id' => 'required',
            'currency_code' => 'required',
            'sales_channel' => 'required',           
        ]);

        if ($validator->fails()) {            
            Log::info('request : '.print_r($validator->errors(), true));
            return Utility::buildResponse(400, $validator->errors(), 'Validation error');
        }
        
        $bookingId = $request->booking_id;
        $currencyCode = $request->currency_code;
        $salesChannel = $request->sales_channel;

        $booking = \App\Models\Booking::find($bookingId);
        if (!$booking){
            $responseMessage = "no booking found for booking id: {$bookingId}";
            Log::info($responseMessage);
            return Utility::buildResponse(400, [], $responseMessage);
        }
        
        $bookingDetails = $this->getUnpaidBookingDetailRecords($bookingId);
        
        if ($bookingDetails->count() == 0){
            $responseMessage = "no booking detail recs found for booking id: {$bookingId}";
            Log::info($responseMessage);
            return Utility::buildResponse(400, $bookingDetails, $responseMessage);
        }
        
        $clientId = $booking->clients_id;
        if (!$clientId){
            $responseMessage = "no client id associated for booking id: {$bookingId}";
            Log::info($responseMessage);
            return Utility::buildResponse(400, [], $responseMessage);
        }
        
        //Call to check if tour hasn't closed yet
        if ( $this->_checkTourNotStalled() ){
            $responseMessage = "Tour is no longer available to add pax.";
            Log::info($responseMessage);
            return Utility::buildResponse(400, [], $responseMessage);            
        }

        $totalAmountLocal = $totalAmount = 0;
        
        foreach ($bookingDetails as $bookingDetailRec){
            //Get all currency amounts for this booking detail id
            $totalChargeArr = $this->getCurrenciesExchangeAmounts($bookingDetailRec->id);
            //Get local currency code
            $exchangeFromCurrencyCode = $this->getEventsCurrencySymbol($bookingDetailRec->events_id);
            if ($exchangeFromCurrencyCode){
                //Sum the local amounts
                $totalAmountLocal += $totalChargeArr[$exchangeFromCurrencyCode]['amount'];            
            }
            
            //Sum the total amount to be charged
            $totalAmount += $totalChargeArr[$currencyCode]['amount'];
        
            if ($exchangeFromCurrencyCode && isset($totalChargeArr[$exchangeFromCurrencyCode])){
                $exchangeRate = $totalChargeArr[$exchangeFromCurrencyCode]['exchange_rate'];   
            }
        }
                       
        //-----------------------------------
        //Payment Processing
        //Only Validate CC info if needing to apply payment on booking
        //-----------------------------------
        $performCharge = $request->perform_charge;
        if ($performCharge){
            $validator = Validator::make($request->all(), [
                'cc_type' => 'required',
                'cc_number' => 'required',
                'cc_month' => 'required',
                'cc_year' => 'required',
                'cc_cvv' => 'required',
            ]);

            if ($validator->fails()) {            
                Log::info('request : '.print_r($validator->errors(), true));
                return Utility::buildResponse(400, $validator->errors(), 'Validation error');
            }
            
            $ccType = $request->cc_type;
            $ccNumber = $request->cc_number;
            $ccMonth = $request->cc_month;
            $ccYear = $request->cc_year;
            $ccCvv = $request->cc_cvv;

            $result = $this->_processPayment($ccType, $ccNumber, $ccMonth, $ccYear, $ccCvv, $bookingId, $clientId, $totalAmount, 
                    $totalAmountLocal, $exchangeRate, $exchangeFromCurrencyCode, $currencyCode, $salesChannel);
            
            if ($result['success']){
                $status = 200;
            }else{
                $status = 400;
                $message = $result['message'];
            }
        }
        
        if ($status == 200){
//         put following 3 into function together
//         *  — Update Events Stages Call (Maybe Workflow) Function
//         *  ----- ES rec already updated on in productAdd func() calling _reserveAvailabilty
//         *  — Update reserves to Confirmed, limited to number of pax
//         *  — Update Booking Details to paid... update DB to is_paid = 1 
            
            foreach($bookingDetails as $rec){
                $this->_confirmPaxInventory($rec->id);
            }
            
            \App\Models\BookingsDetail::where(['bookings_id'=>$bookingId, 'is_paid'=>0])
                    ->update([
                        'is_paid' => true
                    ]); 
        }
        
        return Utility::buildResponse($status, [], $message);
    }
       
    /**
     * Get the currency symbol an event is priced in.
     * @param type $eventId
     * @return currency symbol
     */
    public function getEventsCurrencySymbol($eventId){
        $currencySymbol = DB::table('events_domains')
                        ->select('currencies.currency_symbol')
                        ->join('domains_settings', 'domains_settings.domain_id', '=', 'events_domains.domains_id')
                        ->join('currencies', 'currencies.id', '=', 'domains_settings.currency_id')
                        ->where('events_domains.id', $eventId)
                        ->first();
        if (!$currencySymbol){
            return false;
        }
        
        return $currencySymbol->currency_symbol;
    }

    //************************************
    // Private Functions
    //************************************    
    

    /**
     * Get array of currency exchange amounts and rates
     * 
     * @param string $eventLocalCurrencySymbol
     * @param float $amountLocal
     * @return array
     */
    private function _getCurrenciesExchangeForLocalAmount($eventLocalCurrencySymbol, $amountLocal){
        $currencyExchangeRatesArr =[];
        
        //Get usd rate and amount
        $localUsdExchange  = \App\Models\CurrenciesExchange::where('exchangepair', $eventLocalCurrencySymbol . 'USD')->first();
        $usdRate = $localUsdExchange->rate;
        $amountUSD = $amountLocal * $usdRate;
        
        //Get all currency exchanges except eur to eur
        $currencyExchangeRecs  = \App\Models\CurrenciesExchange::where('exchangepair', '!=', 'EUREUR')->get();
        
        foreach ($currencyExchangeRecs as $rec){
            $localSymbol = substr($rec->exchangepair,0,3);
            $foreignSymbol = substr($rec->exchangepair,3);
            $exchangeRate = 1 / $rec->rate ;
            
            if ($eventLocalCurrencySymbol != $localSymbol){
                //Include a buffer percentage to all markets except this events own market
                $exchangeRate *= ( 1 + $this->exchangeRateBuffer );
            }
           
            $amount = $amountUSD * $exchangeRate;
            
            //Array of amounts and rates
            $currencyExchangeRatesArr[$localSymbol] = [
                'exchangeAmount'=>round($amount,2), 
                'exchangeToUsdRate'=>round($exchangeRate, 5),
                'usdAmount'=>round($amountUSD, 2), 
                'localToUsdRate'=>round($usdRate,5)
                ];            
        }
        
        return $currencyExchangeRatesArr;
    }
    
        
    /**
     * Return array of each currency exchange total amounts
     * (bookings_details_exchange_rate table)
     * records saved at the time thie 
     * booking detail rec was created
     * 
     * @param int $bookingDetailId
     * @return array
     */
    public function getCurrenciesExchangeAmounts($bookingDetailId){ 
        $currencyExchangeTotalsArr = [];
 
        $exchangeRateRecs = \App\Models\BookingsDetailsExchangeRate::where('bookings_details_id', $bookingDetailId)->get();
        foreach($exchangeRateRecs as $rec){
            $currencyCode = $rec->currency_code;            
            $currencyExchangeTotalsArr[$currencyCode]['amount'] = $rec->amount;
            $currencyExchangeTotalsArr[$currencyCode]['exchange_rate'] = $rec->rate;
            $currencyExchangeTotalsArr[$currencyCode]['amount_full_price'] = $rec->amount_full_price;
        }

        return $currencyExchangeTotalsArr;
    }
       
    /**
     * Get totals by currency type for the 
     * entire unpaid booking
     * 
     * @param int $bookingId
     * @return array
     */
    public function getBookingsCurrenciesExchangeAmountForEntireBooking($bookingId){ 
        $currencyExchangeTotalsArr = $bookingDetailIdArr = [];

        $bookingDetailRecs  = $this->getUnpaidBookingDetailRecords($bookingId);
        
        foreach ($bookingDetailRecs as $rec){
            $bookingDetailIdArr[] = $rec['id'];
        }

        $exchangeRateRecs = \App\Models\BookingsDetailsExchangeRate::whereIn('bookings_details_id', $bookingDetailIdArr)->get();

        foreach($exchangeRateRecs as $rec){
            $currencyCode = $rec->currency_code;  
            if (!isset($currencyExchangeTotalsArr[$currencyCode])){
                $currencyExchangeTotalsArr[$currencyCode]['amount'] = 0;
                $currencyExchangeTotalsArr[$currencyCode]['amount_full_price'] = 0;
            }
            $currencyExchangeTotalsArr[$currencyCode]['amount'] += $rec->amount;
            $currencyExchangeTotalsArr[$currencyCode]['amount_full_price'] += $rec->amount_full_price;
        }

        return $currencyExchangeTotalsArr;
    }
     
    /**
     * Get all booking detail records
     * not yet in paid status
     * 
     * @param int $bookingId
     * @param obj $bookingId 
     */
    public function getUnpaidBookingDetailRecords($bookingId){
         $bookingDetailRecs  = \App\Models\BookingsDetail::where(
                 [
                     'bookings_id'=>$bookingId, 
                     'is_paid'=>0
                     ])
                    ->get();
         
         if ($bookingDetailRecs->count() == 0){
             return [];
         }
         
         return $bookingDetailRecs;
    }
    
    
    
    /**
     * Return array of all currency exchange
     * (bookings_details_exchange_rate table)
     * records saved at the time thie 
     * booking detail rec was created
     * 
     * @param int $bookingDetailId
     * @return array
     */
    private function _getCurrenciesExchangeAmountByBookingDetailId($bookingDetailId){ 
        $currencyExchangeRatesArr = [];
 
        $exchangeRateRecs = \App\Models\BookingsDetailsExchangeRate::where('bookings_details_id', $bookingDetailId)->get();

        foreach($exchangeRateRecs as $rec){
            $currencyExchangeRatesArr[] = [
                'currency_code' => $rec['currency_code'],
                'amount' => $rec['amount'],
                'exchange_rate' => $rec['rate'],              
                'amount_full_price' => $rec['amount_full_price'],              
            ];
        }
        
        return $currencyExchangeRatesArr;
    }
       
    /**
     * Set the current currency amount and rates 
     * for this booking detail record
     * 
     * @param int $bookingDetailId
     * @param float $amountLocal
     * @return array
     */
    private function _setCurrenciesExchangeFullAmount($bookingDetailId, $amountLocal){        
        $bookingDetail = \App\Models\BookingsDetail::find($bookingDetailId);
        if (!$bookingDetail){
            return [];
        }

        $eventLocalCurrencySymbol = $this->getEventsCurrencySymbol($bookingDetail->events_id);
        if (!$eventLocalCurrencySymbol){
            return [];
        }
        
        $exchangeArr = $this->_getCurrenciesExchangeForLocalAmount($eventLocalCurrencySymbol, $amountLocal);
        if (!$exchangeArr){
            return [];            
        }
  
        foreach($exchangeArr as $currencySymbol => $rec){
            $bookingsDetailsExchangeRate = new \App\Models\BookingsDetailsExchangeRate();
            $bookingsDetailsExchangeRate->bookings_details_id = $bookingDetailId;
            $bookingsDetailsExchangeRate->currency_code =  $currencySymbol;
            $bookingsDetailsExchangeRate->amount = $rec['exchangeAmount'];
            $bookingsDetailsExchangeRate->rate = $rec['exchangeToUsdRate'];
            $bookingsDetailsExchangeRate->amount_full_price = $rec['exchangeAmount'];
            $bookingsDetailsExchangeRate->save();            
        }
        
        return $exchangeArr;
    }
    
    
    /**
     * Delete all exchange currency amounts and rates
     * for specific booking detail id
     * 
     * @param int $bookingDetailId
     * @return boolean
     */
    private function _removeCurrenciesExchangeAmount($bookingDetailId){        
        \App\Models\BookingsDetailsExchangeRate::where('bookings_details_id', $bookingDetailId)->delete();     
        return true;
    }
        
    /**
     * Build array of booking details how they should return in a standard format
     * 
     * @param int $bookingId
     * @return array
     */
    private function _buildBookingDetailReturnData($bookingId){
        $bookingDetailArr =[];
        $bookingDetailRecs  = $this->getUnpaidBookingDetailRecords($bookingId);
      
        if ($bookingDetailRecs->count() > 0) {
            foreach($bookingDetailRecs as $rec){
                $currencyExchangeArr = $this->_getCurrenciesExchangeAmountByBookingDetailId($rec->id);
               
                $bookingDetailArr[] = [
                    'booking_detail_id' => $rec->id,
                    'booking_id' =>$rec->bookings_id,
                    'number_adults' => $rec->number_adults,
                    'number_seniors' => $rec->number_seniors,
                    'number_students' => $rec->number_students,
                    'number_children' => $rec->number_children,
                    'number_infants' => $rec->number_infants,
                    'stage_id' => $rec->stage_id,
                    'booking_date' => date('Y-m-d h:i:s', strtotime($rec->booking_date)),
                    'imported_promo' => $rec->imported_promo,
                    'amount_local' => $rec->amount_local,  
                    'currency_exchange' => $currencyExchangeArr
                ];
            }
        }

        return $bookingDetailArr;
    }
  
    
    /**
     * Check availability on stage 
     * to verify enought spots still available
     * 
     * @param int $stageId
     * @param int $numberAdults
     * @param int $numberSeniors
     * @param int $numberStudents
     * @param int $numberChildren
     * @param int $numberInfants
     * @return boolean
     */
    private function _checkAvailabilty($stageId, $numberAdults, $numberSeniors = 0, $numberStudents = 0, $numberChildren = 0, $numberInfants = 0){
        //Check the new availability table and return bool on result
        $totalPax = $numberAdults + $numberSeniors + $numberStudents + $numberChildren;
        $eventsStagePaxRemaining  = \App\Models\EventsStagePaxRemaining::where('id', $stageId)
                ->where('pax_remaining', '>=', $totalPax)
                ->get();
      
        if ($eventsStagePaxRemaining->count() > 0){
            return true;            
        }
        return false;
    }

    
    /**
     * Reserve pax "spots" on this stage
     * 
     * @param int $bookingDetailId
     * @param int $stageId
     * @param int $numberAdults
     * @param int $numberSeniors
     * @param int $numberStudents
     * @param int $numberChildren
     * @param int $numberInfants
     * @return boolean
     */
    private function _reserveAvailabilty($bookingDetailId, $stageId, $numberAdults = 0, $numberSeniors = 0, $numberStudents = 0, $numberChildren = 0, $numberInfants = 0) {
        if ($this->_checkAvailabilty($stageId, $numberAdults, $numberSeniors, $numberStudents, $numberChildren, $numberInfants)){
            $eventsStage  = \App\Models\EventsStage::find($stageId);  
            
            //Total without infants
            $totalPax = $numberAdults + $numberSeniors + $numberStudents + $numberChildren;

            $eventsStage->pax_total += $totalPax;
            $eventsStage->pax_adults += $numberAdults;
            $eventsStage->pax_seniors += $numberSeniors;
            $eventsStage->pax_students += $numberStudents;
            $eventsStage->pax_children += $numberChildren;
            $eventsStage->pax_infants += $numberInfants;

            if ($eventsStage->save()){
                //record to new table even though we don't use it yet
                $this->_reservePaxInventory($bookingDetailId, $stageId, $numberAdults, $numberSeniors, $numberStudents, $numberChildren);
                return true;            
            }  
        }
        return false;
    }

    
    /**
     * Release reserved inventory 
     * and make it available for others
     * 
     * @param int $bookingDetailId
     * @return boolean 
     */
    private function _releaseAvailabilty($bookingDetailId) {
        $bookingsDetail  = \App\Models\BookingsDetail::find($bookingDetailId);
        if (!$bookingDetailId){
            return false;
        }

        //Total without infants
        $totalPaxToRemove = $bookingsDetail->number_adults 
                + $bookingsDetail->number_seniors 
                + $bookingsDetail->number_students 
                + $bookingsDetail->number_children;
        
        $eventsStage  = \App\Models\EventsStage::find($bookingsDetail->stage_id);  
        
        if ($eventsStage){        
            //Decrement each of these pax totals
            $eventsStage->pax_total -= $totalPaxToRemove;
            $eventsStage->pax->adults -= $bookingsDetail->number_adults;
            $eventsStage->pax->seniors -= $bookingsDetail->number_seniors;
            $eventsStage->pax->students -= $bookingsDetail->number_students;
            $eventsStage->pax->children -= $bookingsDetail->number_children;
            $eventsStage->pax->infants -= $bookingsDetail->number_infants;
            
            if ($eventsStage->save() ){
                //record 'deleted' to new table even though we don't use it yet
                $this->_releasePaxInventory($bookingDetailId);
                return true;
            }
        }
        
        return false;
    }
    
    
    //-----------------------------------
    // New functions for the 
    // events_stages_pax_inventory table
    // Not really being utilized yet
    //-----------------------------------
    /**
     * Checks pax inventory table for total count 
     * 
     * @param int $stageId
     * @return int 
     */
    private function _checkPaxInventory($stageId){
        return \App\Models\EventsStagesPaxInventory::where('stage_id', $stageId)
                ->whereIn('pax_status', ['reserved', 'confirmed'])
                ->count();
    }
    
    
    /**
     * Reserves each pax type a spot 
     * on the stage for this booking id
     * 
     * @param int $bookingDetailId
     * @param int $stageId
     * @param int $numberAdults
     * @param int $numberSeniors
     * @param int $numberStudents
     * @param int $numberChildren
     * @param int $numberInfants
     */
    private function _reservePaxInventory($bookingDetailId, $stageId, $numberAdults = 0, $numberSeniors = 0, $numberStudents = 0, $numberChildren = 0, $numberInfants = 0){
        $stageArr = Utility::decodeStageId($stageId);

        $this->_checkPaxInventory($stageId);
        
        $reserveArr = [
            'adult' => $numberAdults,
            'senior' => $numberSeniors,
            'student' => $numberStudents,
            'child' => $numberChildren,
            'infant' => $numberInfants,
        ];
        
        foreach ($reserveArr as $type => $paxCount){
            if ($paxCount < 1){
                continue;
            }
            
            for($i=0; $i < $paxCount; $i++){
                //Create new records for each pax type and # of them
                $paxInventoryTable = new \App\Models\EventsStagesPaxInventory();
                $paxInventoryTable->event_id = $stageArr['events_id'];
                $paxInventoryTable->stage_id = $stageId ;
                $paxInventoryTable->booking_detail_id = $bookingDetailId;
                $paxInventoryTable->pax_type = $type;
                $paxInventoryTable->pax_status = 'reserved';
                $paxInventoryTable->save();
            }
        }
    }
    
    
    /**
     * Sets status as 'removed' on inventory holds for 
     * a specific booking detail id
     * 
     * @param int $bookingDetailId
     */
    private function _releasePaxInventory($bookingDetailId){
        return \App\Models\EventsStagesPaxInventory::where('booking_detail_id', $bookingDetailId)
                ->update(['pax_status'=>'removed']);        
    }

    
    /**
     * Sets status as 'confirmed' on inventory holds for 
     * a specific booking detail id
     * 
     * @param int $bookingDetailId
     */
    private function _confirmPaxInventory($bookingDetailId){
        return \App\Models\EventsStagesPaxInventory::where('booking_detail_id', $bookingDetailId)
                ->update(['pax_status'=>'confirmed']);      
    }

    
    /**
     * Check to make sure tour is still
     * available to have pax added to it.
     * Not in a stalled status
     * @return boolean
     */
    private function _checkTourNotStalled(){
        return false;
    }

    
    /**
     * Process credit card through Orbital payment processor
     * 
     * @param int $ccType
     * @param int $ccNumber
     * @param int $ccMonth
     * @param int $ccYear
     * @param int $ccCvv
     * @param int $bookingId
     * @param int $clientId
     * @param type $totalAmount
     * @param type $totalAmountLocal
     * @param type $exchangeRate
     * @param strig $exchangeFromCurrencyCode
     * @param string $currencyCode
     * @param string $salesChannel
     * @return type array
     */
    private function _processPayment($ccType, $ccNumber, $ccMonth, $ccYear, $ccCvv, $bookingId, $clientId, $totalAmount, $totalAmountLocal, $exchangeRate, $exchangeFromCurrencyCode, $currencyCode, $salesChannel){
        $avsStatus = 'OFF';
        $countryCode = $country = '';
        $merchantId = $this->_paymentAccounts[$currencyCode];
        
        $client = \App\Models\Client::find($clientId);

        $phone = ($client->mobile_number) ? $client->mobile_number : $client->home_number;

        if ($client->countries_id){
            //Get the 2 string country code US, UK, etc
            $countryRec = \App\Models\Country::find($client->countries_id);
            if ($countryRec){
                $country = $countryRec->country;
                $countryCode = $countryRec->ccode;
                $avsStatus = 'ON';
            }
        }
        
        switch (strtolower($salesChannel)){
            case 'takewalks':
                $domain = 'takeWalks';
                break;

            case 'newyork':
                $domain = 'new-york';
                break;
            
            case 'turkey':
                $domain = 'turkey';
                break;
            
            case 'italyspanish':
                $domain = 'italy-es';
                break;
            
            case 'walksofitaly':
            default:
                $domain = 'italy';                
        }
       
        $postData = [
            'domain' => $domain,
            'booking_id' => $bookingId,
                //can't find why these are needed
                'booking_promo' => null,  //isset($options['giftCard']) ? $options['giftCard'] : null,
            'currency' => $currencyCode,
            'avs_status' => $avsStatus,
            'amount' => $totalAmount,
            'email' => $client->email,
            'phone_number' => $phone,
            'street_address' => $client->address,
            'city' => $client->city,
            'state' => $client->state,
            'zip' => $client->zip,
            'country_code' => $countryCode,
            'country' => $country,
            'cc_number' => $ccNumber,
            'cc_type' => $ccType,
            'cc_month' => $ccMonth,
            'cc_year' => $ccYear,
            'cc_ccv' => $ccCvv,
            'cc_full_name' => $client->fname . ' ' . $client->lname,
            'clients_id' => $clientId,
            //Not actually used but still required by api.
            'amount_local' => $totalAmountLocal, 
            'exchange_rate' => $exchangeRate, 
            'exchange_from' => $exchangeFromCurrencyCode, 
            'exchange_to' => $currencyCode
        ];

        //Payment API call
        $paymentResponse = Api::post('payment', 'payments', $postData);   
        $responseBody = $paymentResponse['body'];
        $this->_writeLogProcess('api_payment', 
                [
                    'card_type'=>$ccType, 
                    'cc_number'=>$ccNumber, 
                    'amount'=>$totalAmount, 
                    'email'=>$client->email, 
                    'response'=> get_object_vars($responseBody), 
                    'response_raw'=>$paymentResponse
                ]);
        
        if ($paymentResponse['code'] == 200){
            //Successfully charged the card
            if ($paymentResponse['success'] && $responseBody->success){
                $merchantArr = get_object_vars($responseBody->data->merchants_id);                
                
                $processorResult = [
                    'success' => true,
                    'message' => $responseBody->message,
                    'transactionId' => $responseBody->data->transactionId,
                    'authCode' => $responseBody->data->authcode,
                    'merchantId' => $merchantArr[0]
                ]; 
        
                $bookingDetailRecs = \App\Models\BookingsDetail::where(['bookings_id'=>$postData['booking_id'], 'is_paid'=>0])
                        ->update([
                            'payment_transaction_number' => $processorResult['authCode']
                        ]);
 
                //Insert new payment transaction record
                $paymentTransaction = new \App\Models\PaymentTransaction();
                $paymentTransaction->amount_local = $postData['amount_local'];
                $paymentTransaction->payment_amount = $postData['amount'];
                $paymentTransaction->currencies_id = null;
                $paymentTransaction->transaction_date = date("Y-m-d H:i:s");
                $paymentTransaction->booking_id = $postData['booking_id'];
                $paymentTransaction->merchant_trans_number = $processorResult['authCode'];
                $paymentTransaction->TxRefNum = $processorResult['transactionId'];
                $paymentTransaction->merchants_id = $processorResult['merchantId'];
                $paymentTransaction->merchant_result = 1;
                $paymentTransaction->payment_status = null;
                $paymentTransaction->clients_id = $postData['clients_id'];
                $paymentTransaction->exchange_rate = $postData['exchange_rate'];
                $paymentTransaction->exchange_from = $postData['exchange_from'];
                $paymentTransaction->exchange_to = $postData['exchange_to'];
                $paymentTransaction->payment_status = null;
                $paymentTransaction->save(); 
                
                $this->_writeLogProcess('payment_response', 
                        [
                            'orbital_response'=> $processorResult, 
                            'total_price_total' => $totalAmount, 
                            'total_price_total_local' => $totalAmountLocal
                        ]);

                return ['success'=>true];
              
            } else {
                $message = ( count($responseBody->message) > 0 ) ? $responseBody->message : $responseBody;

                return [
                    'success' => false,
                    'status' => $response['status'],
                    'message' => $message,
                    'error' => '',
                    'transactionId' => '',
                    'authcode' => '',
                    'merchants_id' => $merchantId,
                    'payment_status' => '',
                    'orderId' => ''
                ];                
            }
        } else {
            return [
                'success' => false,
                'status' => '99',
                'message' => 'Wrong connection with payment API',
                'error' => 'Was not possible to connect with '. PAYMENT_API,
                'transactionId' => '',
                'authcode' => '',
                'merchants_id' => $merchantId,
                'payment_status' => '',
                'orderId' => ''
            ];
        }    
    }
   
    
    /**
     * Write to text file in storage/logs/cc_log directory
     * @param string $type
     * @param array $info
     */
    private function _writeLogProcess($type, $info){
        $credit_card_log_path = storage_path() . '/logs/cc_log/process_log.txt';
        $info['type'] = $type;
        $info['created'] = date('Y-m-d H:i:s');
        $info['ip'] = $_SERVER['REMOTE_ADDR'];

        $cc_number = (isset($info['cc_number'])) ? $info['cc_number'] : '';
        $cc_number = strlen($cc_number) > 4 ? str_repeat('*', strlen($cc_number) - 4) . substr($cc_number, -4) : $cc_number;
        $json_info = json_encode($info);
        if( $cc_number != '') {
            $json_info = str_replace($info['cc_number'], $cc_number,  $json_info);
        }

        file_put_contents($credit_card_log_path, $json_info . "\n", FILE_APPEND);
    }
}
