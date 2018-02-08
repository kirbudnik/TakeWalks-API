<?php
namespace App\Walks\Helpers;

/*
 * Class to override built in Log functionality.
 * Purpose is to build walks specific logging format 
 * but still use the existing Log syntax built into lumen.
 * Array data passed in is converted to readable string
 * and outputted with message.
 * 
 * Place commented section pertaining to Monolog Logger Class
 * at the end of bootstrap/app.php before return $app;
*/

/*
|--------------------------------------------------------------------------
| Modification of the Monolog Logger Class 
|--------------------------------------------------------------------------
|
| Here we are overwritting the log filename to be walks specific.
| Naming structure is now (/logs/walks_YyyyMmDd.log)
| 
| Overwriting lumen's Log Facade output to a more walks specific 
| format located in App\Walks\Helpers\Log
|
*/
/*
$app->configureMonologUsing(function(Monolog\Logger $monolog) {
    $date = date('Ymd');
    $formatContent = "%message% %context% %extra%\n";
    $handler = (new \Monolog\Handler\StreamHandler(storage_path("/logs/walks_{$date}.log")))
        ->setFormatter(new \Monolog\Formatter\LineFormatter($formatContent, null, true, true));

    return $monolog->pushHandler($handler);
});
*/

class Log
{
    /**
     * Log an error message
     * @param string $msg Message to log
     * @param array $arr Data array to write to log
     */
    public static function critical($msg,$arr = []) {
        //add slack notification here
        self::_log('critical', $msg, $arr);
    }
     
    /**
     * Log an error message
     * @param string $msg Message to log
     * @param array $arr Data array to write to log
     */
    public static function error($msg,$arr = []) {
        self::_log('error', $msg, $arr);
    }

    /**
     * Log an info message
     * @param string $msg Message to log
     * @param array $arr Data array to write to log
     */
    public static function info($msg,$arr = []) {
        self::_log('info', $msg, $arr);
    }
      
    /**
     * Log a warning message
     * @param string $msg Message to log
     * @param array $arr Data array to write to log
     */
    public static function warning($msg,$arr = []) {
        self::_log('warning', $msg, $arr);
    }
    
    /**
     * Breaks out array into readable string
     * for writing array data to logs
     * @param array $arrIn  The array to convert
     * @return string the input array as a formatted string
    */
    private static function _convertArrToStr($arrIn) {
        if (!is_array($arrIn)) {
            return $arrIn;
        }

        $string = '';
        
        foreach ($arrIn as $key => $value) {
            $string .= "[{$key} => {$value}] ";
        }
        return $string;
    }
    
    /**
     * Wrapper to build Walks standard logging format
     * @param string $msg   the message to log
     * @param string $level log level (debug, info, warning, error)
     * 
     * @param type $level
     * @param string $msg Varbose message
     * @param type $arr Array data to also display
    */
    private static function _log($level, $msg, $arr) {
        if (is_array($arr)){
           $msg .= " " . self::_convertArrToStr($arr); 
        }
        
        $levelLabel = strtoupper($level);
        $date = date('Ymd');
        $time = date('H:i:s');
        
        $traces = debug_backtrace();
        $line   = $traces[1]['line'];
        $file   = basename($traces[1]['file']);
        
        $format = $date . "|" . $time . "|" .  $file . "|" . $line . "|" . $levelLabel . "|" . $msg;
        \Illuminate\Support\Facades\Log::$level($format);
    }
    
     
}
