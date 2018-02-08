<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// ==========================================================================
// in the clear

//kmr test for get currency function
$app->GET('/v1/booking/test', 'Booking@test');
$app->GET('/v1/booking/promotest', 'Promo@test');

$app->get('/', function () use ($app) {
    return $app->version();
});


//-----------------------------------
// Booking
//-----------------------------------
/**
 * GET
 * Summary:  Get booking and booking details 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/booking/{booking_id}', 'Booking@bookingRetrieve'); //built

/**
 * DELETE
 * Summary:  Delete entire booking by id
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/booking/{booking_id}', 'Booking@bookingDelete');
/**
 * POST
 * Summary:  Initialize the start of booking (checkout process) 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/booking/process/initialize', 'Booking@bookingInitialize');
/**
 * POST
 * Summary:  Finialize the booking process (checkout with payment)
 * Output-Formats: [application/json]
 */
$app->POST('/v1/booking/process/finalize', 'Booking@bookingFinalize');


//-----------------------------------
// Cart Product
//-----------------------------------
/**
 * POST
 * Summary: Add product to a booking  
 * Output-Formats: [application/json]
 */
$app->POST('/v1/booking/product', 'Booking@productAdd'); //working on 1/9/18
/**
 * DELETE
 * Summary:  Delete product from booking
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/booking/{booking_id}/product/{stage_id}', 'Booking@productDelete');

//-----------------------------------
// Promo
//-----------------------------------
/**
 * POST
 * Summary:  Add promo to booking
 * Output-Formats: [application/json]
 */
$app->POST('/v1/booking/promo', 'Promo@promoAdd');

/**
 * DELETE
 * Summary:  Delete promo from booking
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/booking/{booking_id}/promo', 'Promo@promoDelete');

// ==========================================================================
// protected
/* 
Dev local
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client Secret: oug8G4X5IbD550ib4ST7XyOTF3Z2qdRmjwoSQ1Cq
Password grant client created successfully.
Client ID: 2
Client Secret: GaZnu4SrDlqSntNvOG5UAyk2PqBfrSvCfIj0o1FP
Client ID: 3
Client Secret: rGDrbfaIFIsqJm4myBZvM0Lkh8I0dzGdJfpazEvM
*/




/**
 * GET Docs as swagger
 * Summary: Logs user into the system
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/docs/swagger', 'UserApi@getDocsSwagger');

/**
 * GET Docs as html
 * Summary: Logs user into the system
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/docs/html', 'UserApi@getDocsHTML');

/**
 * GET postman collection
 * Summary: Logs user into the system
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/docs/postman', 'UserApi@getPostman');
