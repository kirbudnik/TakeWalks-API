<?php

namespace Walks\Adestra;

use Log;
use Config;

class AdestraClient {

    protected $xmlrpc = null;

    public function __construct($account, $username, $password, $debug = false)
    {

        Log::info('AdestraClient account : '.print_r($account, true));
        Log::info('AdestraClient username : '.print_r($username, true));
        Log::info('AdestraClient password : '.print_r($password, true));

        // $server = "http://$account.$username:$password@new.adestra.com/api/xmlrpc";

        $xmlrpc = new \PhpXmlRpc\Client("https://$account.$username:$password@new.adestra.com/api/xmlrpc");

        $xmlrpc->setDebug($debug);

        $this->xmlrpc = $xmlrpc;
    }

    public static function make($debug = false)
    {   
         Log::info('AdestraClient make config : '.print_r(config(), true));

        $account = config('adestra.account');
        $username = config('adestra.username');
        $password = config('adestra.password'); 

        // https://app.adestra.com/doc/page/current/index/api/examples

        return new AdestraClient($account, $username, $password, $debug);
    }

    public function request($endpoint, $params = [])
    {
        $options = static::arrayToValues($params);

        // _d($options); exit;

        $msg = new \PhpXmlRpc\Request($endpoint, $options);

        Log::info('AdestraClient msg : '.print_r($msg, true));

        $response = $this->xmlrpc->send($msg);

         Log::info('AdestraClient response : '.print_r($response, true));

        return $response;
    }

    public static function arrayToValues($array = [])
    {
        $values = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = static::arrayToValues($value);
                $values[$key] = new \PhpXmlRpc\Value($value, self::isAssociative($value) ? 'struct' : 'array');
            }

            if (is_numeric($value)) {
                $values[$key] = new \PhpXmlRpc\Value($value, 'int');
            }

            if (is_string($value)) {
                $values[$key] = new \PhpXmlRpc\Value($value, 'string');
            }

            if (is_bool($value)) {
                $values[$key] = new \PhpXmlRpc\Value($value, 'boolean');
            }
        }

        return $values;
    }

    public static function isAssociative($arr)
    {
        if (! is_array($arr)) {
            return false;
        }

        return ! isset($arr[0]);
    }

}
