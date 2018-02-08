<?php 

namespace Walks\WapiConnect;

use App\Http\Controllers\Controller;
use Walks\WapiConnect\WapiCommand; 

use GuzzleHttp\Psr7\Response;

use Log;

class WapiConnectController extends Controller {

  public function __construct() {
    //
  }


  public static function getApiDocs()
  { 

    $file_path = app()->basePath() . DIRECTORY_SEPARATOR . 'docs/usersapi.json';

        Log::info('file_path : '.print_r($file_path, true));

        $data = json_decode(file_get_contents($file_path), true);

        return $data;
  }

  public static function getApiHTML()
  { 

    $file_path = app()->basePath() . DIRECTORY_SEPARATOR . 'docs/index.html';

        Log::info('file_path : '.print_r($file_path, true));

        // render this as follows:


        $data = file_get_contents($file_path);

        return $data;
  }

  public static function getPostman()
  { 

    $file_path = app()->basePath() . DIRECTORY_SEPARATOR . 'docs/postman_collection.json';

        Log::info('file_path : '.print_r($file_path, true));

        // render this as follows:
        

        $data = file_get_contents($file_path);

        return $data;
  }


    /**
     * Operation userMessage
     *
     * POST: 
     *
     * @param int $user_id ID  (required)
     *
     * @return Http response
     */
    public static function apiRequest(WapiCommand $command){
        Log::info('##################### apiRequest #####################');

        
        
        #mailerAPI = 'http://{{hostStage}}-mailer.walks.org/mailer/sendBookingCancel'
        
        // ['body'=>$data]
        // $client->post($mailVendorURL, ['body'=>$data]);


    // 'https://httpbin.org/status/503'
    
    try {
        $client = new \GuzzleHttp\Client();
        
        //$client->setUserAgent('Wapi/1.0');
        //$client->setHeader('User-Agent', 'Wapi/1.0');
        // need to set data

        $guzzleResponse = $client->request($command->method, $command->url, $command->options); 

        Log::info('guzzleResponse getBody: '.$guzzleResponse->getBody());
        Log::info('guzzleResponse getStatusCode: '.$guzzleResponse->getStatusCode());
        Log::info('guzzleResponse getReasonPhrase: '.$guzzleResponse->getReasonPhrase());

         $wapiStatus = [
            'code' => 200,
            'status' => 'success',
            'data' => '',
            'message' => ''
            ];

        if ($guzzleResponse->getStatusCode() != 200) {

             $wapiStatus = [
            'code' => 500,
            'status' => 'failure',
            'data' => $guzzleResponse->getBody(),
            'message' => 'Http Status Error '.$command->service." ".$command->command. ' code '.$guzzleResponse->getStatusCode()
            ];

        } 

        $bodyArray = json_decode($guzzleResponse->getBody());
        Log::info('bodyArray : '.print_r($bodyArray, true));

        if (isset($bodyArray->code) ) {

            if ($bodyArray->code != 200) {

                 $wapiStatus = [
                'code' => $bodyArray->code,
                'status' => 'failure',
                'data' => $bodyArray,
                'message' => 'Wapi Endpoint Error - service: '.$command->service." command: ".$command->command
                ];
            
            } 

        }

        if (isset($bodyArray->error) ) {

                 $wapiStatus = [
                'code' => 500,
                'status' => 'failure',
                'data' => $bodyArray,
                'message' => 'Wapi Endpoint Error - service: '.$command->service." command: ".$command->command
                ];

            } 

            return array('guzzleResponse' => $guzzleResponse, 'wapiStatus' => $wapiStatus);

    } catch (\GuzzleHttp\Exception\BadResponseException $e) {

        if ($command->retryOnError) {
            return $this->apiRequest();
        }

        abort(503);
   }
   


}

}
