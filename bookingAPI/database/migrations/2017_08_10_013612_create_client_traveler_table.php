<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTravelerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {

    // https://laravel.com/docs/master/migrations#creating-columns

    Schema::create('client_travelers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('traveler_client_id');
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
        Schema::dropIfExists('client_travelers');
    }
}
