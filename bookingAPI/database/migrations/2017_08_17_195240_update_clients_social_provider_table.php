<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientsSocialProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // https://laravel.com/docs/master/migrations#creating-columns

         Schema::table('client_social_providers', function (Blueprint $table) {

            // change $table->string('userName'); to $table->string('socialUserId');

            $table->renameColumn('userName', 'socialUserId');
            $table->json('metadata');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_social_providers', function (Blueprint $table) {

            $table->renameColumn('socialUserId', 'userName');
            $table->dropColumn('metadata');
        });
    }
}
