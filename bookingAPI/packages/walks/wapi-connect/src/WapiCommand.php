<?php 

namespace Walks\WapiConnect;

use Log;


class WapiCommand  {


    public $command;
    public $method;
    public $uri;
    public $options;
    public $retryOnError;
    public $commandStatus;

    

/**
     * @param string                              $service  
     * @param string			                  $command  
     * @param object $data    Request body
     */
    public function __construct($service, $command, $data) {

    	Log::info('##################### WapiCommand  __construct #####################');
    	Log::info('service : '.print_r($service, true));
    	Log::info('command : '.print_r($command, true));


        $this->service = $service;
    	$this->command = $command;

    	$services = config('walks_services');


    	$requestedService = $services[$service]; 

    	Log::info('requestedService  : '.print_r($requestedService, true));

        Log::info('requestedService  endpoint: '.$requestedService['endpoint']);

    	$requestedCommand = $requestedService['commands'][$command]; 

    	Log::info('requestedCommand  : '.print_r($requestedCommand, true));

    	$this->method = $requestedCommand['method'];


    	$this->url = 'http://'.$requestedService['endpoint'].'/'.$requestedCommand['uri'];
    	

    	$this->options = ['form_params'=>$data];
    	$this->retryOnError = false;


    }	







}

