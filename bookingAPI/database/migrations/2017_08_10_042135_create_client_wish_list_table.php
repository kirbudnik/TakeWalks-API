<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientWishListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {

    // https://laravel.com/docs/master/migrations#creating-columns

    Schema::create('client_wish_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('events_id');
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
        Schema::dropIfExists('client_wish_lists');
    }
}
