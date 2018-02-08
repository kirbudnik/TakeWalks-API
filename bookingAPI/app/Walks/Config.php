<?php
/**
 * Definition of all Walks proprietary configurations
 */  
define('CLOUD_ENVIRONMENT', getenv('CLOUD_ENVIRONMENT')); 

switch (CLOUD_ENVIRONMENT) {
    case "PROD":
        $coordinatorApiAddress = "";
        $guideApiAddress = "";
        $mailerApiAddress = "https://mailer.local.walks/mailer/";
        
        //Payment
        $paymentApi = "http://production-transactions.local.walks/api/";
        $paymentSubmitUrl = "https://orbital1.paymentech.net";
        $paymentApiUsername = "PWALKS14";
        $paymentApiPassword = "MM4PTW54";
        
        $takeWalksUrl = "https://www.takewalks.com/";
        $walksOfItalyUrl = "https://www.walksofitaly.com/";

        $operationsUrl = 'https://admin.walks.org/';
        $guidePortalUrl = 'https://guides.walks.org/';
        $feedbackPortalUrl = 'https://feedback.walks.org/';
        $coordinatorPortalUrl = 'https://coordinators.walks.org/';

        $feedbackEmail = 'feedback@walks.org';
        $customerServiceEmail = 'info@walks.org';
        $operationsRomeEmail = 'rome@walks.org';  

        
        break;

    case "STAGE":
        $coordinatorApiAddress = "";
        $guideApiAddress = "";
        $mailerApiAddress = "https://staging-mailer.local.walks/mailer/";
        
        //Payment
        $paymentApi = "http://transactions-staging/api/";
        $paymentSubmitUrl = "https://orbitalvar1.paymentech.net/authorize";
        $paymentApiUsername = "TWALKS14";
        $paymentApiPassword = "MP36TDYK";
        
        $takeWalksUrl = "https://staging-www.takewalks.com/";
        $takeWalksUrl = "https://staging06-www.takewalks.com/";
        $walksOfItalyUrl = "https://staging-www.walksofitaly.com/";

        $operationsUrl = 'https://staging-admin.walks.org/';
        $guidePortalUrl = 'https://staging-guides.walks.org/';
        $feedbackPortalUrl = 'https://staging-feedback.walks.org/';
        $coordinatorPortalUrl = 'https://staging-coordinators.walks.org/';
        
        $feedbackEmail = 'mailtest+staging_feedback@walks.org';
        $customerServiceEmail = 'mailtest+staging_info@walks.org';
        $operationsRomeEmail = 'mailtest+staging_rome_operations@walks.org';  

        break;

    case "DEV":
    default: 
        $coordinatorApiAddress = "";
        $guideApiAddress = "";
        $mailerApiAddress = "http://dev-mailer.local.walks/mailer/";
        
        //Payment
        $paymentApi = "http://transactions-staging/api/";
        $paymentSubmitUrl = "https://orbitalvar1.paymentech.net/authorize";
        $paymentApiUsername = "TWALKS14";
        $paymentApiPassword = "MP36TDYK";
        
        $takeWalksUrl = "dev-www.takewalks.com/";
        $walksOfItalyUrl = "dev-www.walksofitaly.com/";

        $operationsUrl = 'dev-admin.walks.org/';
        $guidePortalUrl = 'dev-guides.walks.org/';
        $feedbackPortalUrl = 'dev-feedback.walks.org/';
        $coordinatorPortalUrl = 'dev-coordinators.walks.org/';

        $feedbackEmail = 'mailtest+dev_feedback@walks.org';
        $customerServiceEmail = 'mailtest+dev_info@walks.org';
        $operationsRomeEmail = 'mailtest+dev_rome_operations@walks.org';  

        break;
}

//Apis
define('COORDINATOR_API', $coordinatorApiAddress);
define('MAILER_API', $mailerApiAddress);
define('GUIDE_API', $guideApiAddress);

//Email Contacts
define('CUSTOMER_SERVICE_EMAIL', $customerServiceEmail);
define('FEEDBACK_EMAIL', $feedbackEmail);
define('OPERATIONS_EMAIL', $operationsRomeEmail);

//Urls
define('OPERATIONS_URL', $operationsUrl);
define('GUIDE_PORTAL_URL', $guidePortalUrl);
define('COORDINATOR_PORTAL_URL', $coordinatorPortalUrl);
define('FEEDBACK_PORTAL_URL', $feedbackPortalUrl);
define('TAKE_WALKS_URL', $takeWalksUrl);
define('WALKS_OF_ITALY_URL', $walksOfItalyUrl);

//Payment
define('PAYMENT_API', $paymentApi);
define('PAYMENT_SUBMIT_URL', $paymentSubmitUrl);
define('PAYMENT_API_USERNAME', $paymentApiUsername);
define('PAYMENT_API_PASSWORD', $paymentApiPassword);