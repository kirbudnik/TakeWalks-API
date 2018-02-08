<?php

namespace App\Walks\Helpers;

use App\Walks\Helpers\Log;
/**
 * http://docs.guzzlephp.org/en/stable/index.html
 * 
 * Get Request Ex.)
 *  $result = Api::get(
                'guzzleDemoApi', 
                'https://api.github.com/repos/guzzle/guzzle', 
                ['id'=>123, 'name'=>'smith', 'address'=>'123 red rd']
                );
 * Post Request Ex.) - Booking confirmation
    $postData = [
                    "emailPaidEventsIds_str"=>["246729","246734","246731","246732","246733","246730"],
                    "emailTemplateLanguage" => "italy-booking-confirmation-email-english",
                    "emailAddressOverride" => $email
                ];
    $apiCallResult = Api::post('mailer', 'sendBookingConfirmation', $postData);
 */

class Api 
{
    /** 
     * Sends GET http request to api
     * @param type $apiName Name of api to call ex.)guide / coordinator / mailer
     * @param type $methodName  Path of calling api without the base path
     * @param type $getParamsArr  Key / Value array of GET params
     * @return type array
     */
    public static function get($apiName, $methodName, $getParamsArr = []) {
        $i = 0;
        $paramString = null;
        $delimiter = '?';

        foreach($getParamsArr as $key => $value){
            if ($i > 0){
                $delimiter = '&';
            }
            $paramString .= "{$delimiter}{$key}={$value}";
            $i++;
        }

        $configAddress = self::_getApiAddress($apiName);
        $uri = $configAddress . $methodName . $paramString;

        return self::_send('GET', $uri);
    }    
    
    /**
     * Sends POST http request to api
     * 
     * @param type $apiName
     * @param type $path
     * @param type $postDataArr
     * @return type array
     */
    public static function post($apiName, $methodName, $postDataArr = []) {
        $apiName = strtolower($apiName);
        
        $configAddress = self::_getApiAddress($apiName);
        $uri = $configAddress . $methodName;
        $formParams = ['form_params' => $postDataArr];
        
        return self::_send('POST', $uri, $formParams);
    }      
    
    /**
     * Get the specific config address for the requested api
     * @param type $apiName
     * @return string Api address from config
     */
    private static function _getApiAddress($apiName){
        $apiName = strtolower($apiName);
        
        $apiArr = [
                'coordinator' => COORDINATOR_API,
                'guide' => GUIDE_API, 
                'mailer' => MAILER_API,
                'payment' => PAYMENT_API
                ];
        
        return (isset($apiArr[$apiName])) ? $apiArr[$apiName] : null;
    }
    
    /**
     * Make the outbound HTTP Request that
     * collects the returned response 
     * code and and body content.
     * Return as array back to
     * calling function
     *  
     * @param type $requestType
     * @param type $fullUrl
     * @param type $params
     * @return type array ['success'=>bool, 'code'=>int, 'body'=>array]
     */
    private static function _send($requestType, $uri, $params = []){
        $responseArr = [
            'success'=>false, 
            'code'=>null, 
            'body'=>null
            ];
        
        $client = new \GuzzleHttp\Client();
        
        $result = $client->request($requestType, $uri, $params);
        $statusCode = $result->getStatusCode();

        $responseArr['code'] = intval($statusCode);
        $responseArr['body'] = json_decode($result->getBody());
        
        if ($statusCode == 200){
            $responseArr['success'] = true;
        }
        
        return $responseArr;
    }
}
