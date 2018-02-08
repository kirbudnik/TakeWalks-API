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



$app->get('/', function () use ($app) {
    return $app->version();
});


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




// auth_client starts
$app->group(['middleware' => 'auth_client'], function () use ($app) {


/**
 * POST name, email and password to create an apiuser for the password type login
 * Summary: 
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/apiusers', 'UserApi@addApiUser');


/**
 * POST userSignup
 * Summary: userSignup send email address to adestra
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/signup', 'UserApi@userSignup');

/**
 * POST addUser
 * Summary: Add a new user
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user', 'UserApi@addUser');
/**
 * GET loginUser
 * Summary: Logs user into the system
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/user/login', 'UserApi@loginUser');

/**
 * PUT loginSocialMedia
 * Summary: Log user in using social account
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/login/social', 'UserApi@loginSocialMedia');



/**
 * GET logoutUser
 * Summary: Logs out current logged in user session
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/user/logout', 'UserApi@logoutUser');

/**
 * PUT passwordEmail
 * Summary: Sends password reset email
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->PUT('/v1/user/passwordEmail', 'UserApi@passwordEmail');

/**
 * PUT userPasswordChange
 * Summary: Sends password reset email
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/password/change', 'UserApi@userPasswordChange');

/**
 * POST userPasswordResetKey
 * Summary: Recover user from key
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/password/resetkey', 'UserApi@userPasswordResetKey');

/**
 * DELETE deleteUser
 * Summary: Deletes a user
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/user/{userId}', 'UserApi@deleteUser');
/**
 * GET getUserById
 * Summary: Find user by userId
 * Notes: Returns a single user
 * Output-Formats: [application/json]
 */
$app->GET('/v1/user/{userId}', 'UserApi@getUserById');
/**
 * POST updateUser
 * Summary: Updates a user
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}', 'UserApi@updateUser');
/**
 * POST addUserDestination
 * Summary: Add to users destination list
 * Notes: updates a resource, adds a subsidiary resource, or causes a change
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/destination', 'UserApi@addUserDestination');
/**
 * DELETE deleteUserDestination
 * Summary: Deletes a social provider
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/user/{userId}/destination', 'UserApi@deleteUserDestination');
/**
 * GET userDestination
 * Summary: Get user destination list
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/user/{userId}/destination', 'UserApi@userDestination');
/**
 * PUT passwordReset
 * Summary: User password reset
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->PUT('/v1/user/{userId}/passwordReset', 'UserApi@passwordReset');
/**
 * POST addUserSocialProvider
 * Summary: Add to users SocialGraph provider list
 * Notes: updates a resource, adds a subsidiary resource, or causes a change
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/social', 'UserApi@addUserSocialProvider');
/**
 * DELETE deleteUserSocialProvider
 * Summary: Deletes a social provider
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/user/{userId}/social', 'UserApi@deleteUserSocialProvider');
/**
 * GET userSocial
 * Summary: Get user social graph
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/user/{userId}/social', 'UserApi@userSocial');
/**
 * GET userTourlist
 * Summary: Get list past and future tours
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/user/{userId}/tourlist', 'UserApi@userTourlist');
/**
 * POST addUserTraveler
 * Summary: Add to users traveler list
 * Notes: updates a resource, adds a subsidiary resource, or causes a change
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/traveler', 'UserApi@addUserTraveler');
/**
 * DELETE deleteUserTraveler
 * Summary: Deletes a traveler
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/user/{userId}/traveler', 'UserApi@deleteUserTraveler');
/**
 * GET userTraveler
 * Summary: Get user traveler list
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/user/{userId}/traveler', 'UserApi@userTraveler');
/**
 * POST uploadFile
 * Summary: uploads an image
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/uploadImage', 'UserApi@uploadFile');
/**
 * POST addUserWishlist
 * Summary: Add to users Wishlist of events
 * Notes: updates a resource, adds a subsidiary resource, or causes a change
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/wishlist', 'UserApi@addUserWishlist');
/**
 * DELETE deleteWishlistItem
 * Summary: Deletes a wishlist item
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/user/{userId}/wishlist', 'UserApi@deleteWishlistItem');
/**
 * GET userWishlist
 * Summary: Get user wishlist of events
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->GET('/v1/user/{userId}/wishlist', 'UserApi@userWishlist');

/**
 * POST userBookingVoucher
 * Summary: resend the booking voucher.
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/booking/voucher', 'UserApi@userBookingVoucher');


/**
 * POST userBookingCancel
 * Summary: Post user order cancel, you're going to need the booking_id
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/booking/cancel', 'UserApi@userBookingCancel');


/**
 * POST userBookingRefund
 * Summary: Post user order to refund, you're going to need the booking_id
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/booking/refund', 'UserApi@userBookingRefund');



/**
 * POST userMessage
 * Summary: You're going to need the templateName
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/user/{userId}/message', 'UserApi@userMessage');

// this is the end of the client_auth
});
