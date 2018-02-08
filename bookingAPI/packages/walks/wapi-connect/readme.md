


General package creation notes:

From: 
http://blog.cloudoki.com/creating-a-lumen-package/

mkpath packages/walks/wapi-connect/src/

cd packages/walks/wapi-connect/

composer init

```
{
    "name": "walks/wapi-connect",
    "description": "WAPI API connect",
    "type": "library",
    "require": {
        "php": "^7.1"
    },
    "minimum-stability": "dev",
    "require": {}
}
```


we'll need to let Lumen autoload our package. For that, open the composer.json file on the root of your Lumen app. You'll notice a psr4 section on it, with just:

cd ../../../

```
"psr-4": {
    "App\\": "app/"
}
Add your package to it, like so:

"psr-4": {
    "App\\": "app/",
     "Walks\\WapiConnect\\": "packages/walks/wapi-connect/src"
}
```


And update the autoload with:

$ composer dumpautoload
Thus, generating a new namespace for your package.

cd packages/walks/wapi-connect/src/
vi WapiConnectServiceProvider.php


```
<?php

namespace Walks\WapiConnect;

use Illuminate\Support\ServiceProvider;

class WapiConnectServiceProvider extends ServiceProvider {

   /**
    * Bootstrap the application services.
    *
    * @return void
    */
   public function boot()
   {
      //
   }

   /**
    * Register the application services.
    *
    * @return void
    */
   public function register()
   {


      // Let Laravel Ioc Container know about our Controller
      $this->app->make('Walks\WapiConnect\WapiConnectController');
  }

}
```

vi WapiConnectController.php 
```
<?php

namespace Walks\WapiConnect;

use App\Http\Controllers\Controller;
use Log;

class WapiConnectController extends Controller {

  public function __construct() {
    //
  }


  public static function getApiDocs()
  {

    $file_path = app()->basePath() . DIRECTORY_SEPARATOR . 'swagger/usersapi.json';

        Log::info('file_path : '.print_r($file_path, true));

        $data = json_decode(file_get_contents($file_path), true);

        return $data;
  }

}
```

Hooking up an APP Controller with the package

cd ../../../../app/Http/Controllers/


vi UserApi.php 

add:
use Walks\WapiConnect\WapiConnectController;



 /**
     * Operation getDocsSwagger
     *
     * Sends 
     *
     *
     * @return Http response
     */
    public function getDocsSwagger(Request $request)
    {
     Log::info('##################### getDocsSwagger #####################');


        $json = WapiConnectController::getApiDocs();

        return response($json);

    }



Hit it:
http://{{hostStage}}-userapi.walks.org/v1/docs/swagger











