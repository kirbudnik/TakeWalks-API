<?php

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\JsonFormatter;
use Monolog\Formatter\ElasticaFormatter;

require_once __DIR__.'/../vendor/autoload.php';



try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}


/*
|--------------------------------------------------------------------------
| Walks Global Configs
|--------------------------------------------------------------------------
|
| Here we will load the global configs specific to Walks
| like environmental, api, etc type configs 
|
*/

require_once __DIR__.'/../app/Walks/Config.php';



/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);


$app->instance('path.config', app()->basePath() . DIRECTORY_SEPARATOR . 'config');
$app->instance('path.storage', app()->basePath() . DIRECTORY_SEPARATOR . 'storage');


$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

 $app->middleware([
    'request_logger' => \App\Http\Middleware\RequestResponseLogger::class
 ]);

 $app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    'auth_client' => \Laravel\Passport\Http\Middleware\CheckClientCredentials::class
    
 ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);

$app->register(Laravel\Passport\PassportServiceProvider::class);
$app->register(Dusterio\LumenPassport\PassportServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);



$app->register(Walks\WapiConnect\WapiConnectServiceProvider::class);

$app->register(Walks\Adestra\AdestraServiceProvider::class);


// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);

// issues with this
// $app->register(Krlove\EloquentModelGenerator\Provider\GeneratorServiceProvider::class);

   //$app->register(Way\Generators\GeneratorsServiceProvider::class);
   //$app->register(Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
   //$app->register(User11001\EloquentModelGenerator\EloquentModelGeneratorProvider::class);
       
Dusterio\LumenPassport\LumenPassport::routes($app, ['prefix' => 'v1/oauth']);



/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    require __DIR__.'/../routes/web.php';
});


# $handlers[] = (new StreamHandler(storage_path("logs/lumen_notice.log"), 0, Logger::NOTICE, false))->setFormatter(new LineFormatter(null, null, true, true));

// StreamHandler __construct($stream, $level = Logger::DEBUG, $bubble = true, $filePermission = null, $useLocking = false)


$handlers = app('Psr\Log\LoggerInterface')->getHandlers();

//$handlers[] = (new StreamHandler(storage_path("logs/lumen_notice.log"), Logger::NOTICE, true, 644, false))->setFormatter(new JsonFormatter());

# $handlers[] = (new StreamHandler(storage_path("logs/lumen_notice.log"), 0, Logger::NOTICE, false))->setFormatter(new LineFormatter(null, null, true, true));


// $handlers[] = (new StreamHandler(storage_path("logs/lumen_notice.log"), 0, Logger::NOTICE, false))->setFormatter(new ElasticaFormatter('kinesis', 'logs'));


// app('Psr\Log\LoggerInterface')->setHandlers($handlers);

$app->configure('adestra');


return $app;
