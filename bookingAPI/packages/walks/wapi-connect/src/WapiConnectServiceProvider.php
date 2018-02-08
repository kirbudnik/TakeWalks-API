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



    // push the walks_services locations into lumens config
    config(['walks_services' => [

      'mailer' => [
          // 'endpoint' => env('APP_ENV').'-mailer.local.walks',
          'endpoint' => 'staging-mailer.walks.org',
          'version' => '',
          'commands' => ['sendBookingCancel' => ['uri' => 'mailer/bookingCancel',
                                                'method' => 'POST',
                                                'options' => ['body'=>'']
                                                ],
                        'sendBookingRefund' => ['uri' => 'mailer/bookingRefund',
                                                'method' => 'POST',
                                                'options' => ['body'=>'']
                                                ],
                         'clientPasswordReset' => ['uri' => 'mailer/clientPasswordReset',
                                                'method' => 'POST',
                                                'options' => ['body'=>'']
                                                ],
                         'sendBookingConfirmation' => ['uri' => 'mailer/sendBookingConfirmation',
                                                'method' => 'POST',
                                                'options' => ['body'=>'']
                                                ]
                        ]

      ]

    ]]);


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
