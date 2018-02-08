<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Log;
use Carbon\Carbon;


class RequestResponseLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            return $next($request);
    }
 
    public function terminate($request, $response)
    {

        Log::notice('[RequestResponse]', [
            'timestamp' => Carbon::now()->toIso8601String(),
            'service' => ['property' =>'userapi',
                        'app_env' => env('APP_ENV'),
                        ],
            'request' => [$request->all(),
                        'path' => $request->getPathInfo(),
                        'headers' => $request->headers->all()],
            'response' => $response->getOriginalContent()
        ]);
    }
}