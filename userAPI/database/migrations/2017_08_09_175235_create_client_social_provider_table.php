<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
https://laravel.com/docs/master/migrations#running-migrations

php artisan make:migration create_client_social_provider_table 

php artisan migrate

php artisan migrate:rollback

php artisan migrate:rollback --step=1

php artisan migrate:refresh
*/

class CreateClientSocialProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {

    // https://laravel.com/docs/master/migrations#creating-columns

    Schema::create('client_social_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('provider');
            $table->string('userName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('client_social_providers');
    }
}
