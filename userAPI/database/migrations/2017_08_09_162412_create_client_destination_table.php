<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
 * @property int $id
 * @property string $client_id
 * @property string $city
 * @property string $hotelPhone
 * @property string $hotelEmail
 * @property string $startDate
 * @property string $endDate
*/

class CreateClientDestinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    // https://laravel.com/docs/master/migrations#creating-columns

    Schema::create('client_destinations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('city');
            $table->string('hotelPhone');
            $table->string('hotelEmail');
            $table->string('startDate');
            $table->string('endDate');
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
        Schema::dropIfExists('client_destinations');
    }
}
