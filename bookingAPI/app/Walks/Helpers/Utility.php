<?php

namespace App\Walks\Helpers;

use Illuminate\Database\Eloquent\Model;
use Exception;

use App\Walks\Helpers\Log;

/*
* Logger class to support additional log features
*/
class Utility extends Model
{
    /**
     * Decodes the stage id into readable array content
     * @param string $stageId
     * @return array
     */
    public static function decodeStageId($stageId) {
        self::logFunctionCall();
        
        $stageId = strval($stageId);
        if ($stageId[0] == '1') {
            $gp_binary = 1;
            $gp = 'G';
            $gp_long = 'Group';
        } else {
            $gp_binary = 0;
            $gp = 'P';
            $gp_long = 'Private';
        }
        $events_id = ltrim(substr($stageId, 1, 6), "0");
        $y = substr($stageId, 7, 2);
        $m = substr($stageId, 9, 2);
        $d = substr($stageId, 11, 2);
        $h = substr($stageId, 13, 2);
        $i = substr($stageId, 15, 2);

        $date = "20{$y}-{$m}-{$d}";
        $datetime = "{$date} {$h}:{$i}";

        $private_group_number = ltrim(substr($stageId, 17, 2), "0");
        $arr = array(
            'gp' => $gp,
            'gp_long' => $gp_long,
            'gp_binary' => $gp_binary,
            'events_id' => $events_id,
            'datetime' => $datetime,
            'date' => $date,
            'private_group_number' => $private_group_number,
            'stage_id' => $stageId
        );
        return $arr;
    }
        
    /**
    * Logs the function call and 
    * any param values passed
    */
    public static function logFunctionCall() {
        $e     = new Exception();
        $trace = $e->getTrace();
        $info  = $trace[1];
        $args = implode(',', $info['args']);

        Log::info("Calling {$info['function']}({$args})");
    }

    /**
     * Safely gets a value from an array or object
     * by first checking that the key, or object exists.
     * Return default value if none found
     * @param mixed  $container
     * @param string $key
     * @param mixed  $default
     */
    public static function safe($container, $key, $default = null) {
        // Make sure the key is actually set
        if (!$key && $key !== 0) {
            return $default;
        }
        
        //Array
        if (is_array($container)) {
            return isset($container[$key]) ? $container[$key] : $default;
        }

        //Object
        if (is_object($container)) {
            if (isset($container->$key)) {
                return $container->$key;
            }
            return property_exists(get_class($container), $key) ? $container->$key : $default;
        }

        return $default;
    }
    
    /**
     * Constructs the response array returned from api called
     * @param type $code
     * @param type $data
     * @param type $message
     * @return type
     */
    public static function buildResponse($code=200, $data=[], $message=null){
        
        $status = ($code == 200) ? 'success' : 'failure';
        
        if (!is_array($data)){
            $data = [$data];
        }
        
        return 
        [
            'code' => $code,
            'status' => $status,
            'data' => $data,
            'message' => $message
        ];
    }


    

}