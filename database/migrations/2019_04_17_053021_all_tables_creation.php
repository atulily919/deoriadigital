<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllTablesCreation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Client Table
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

         //Location Master Table
        Schema::create('location_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');
            $table->string('location_state');
            $table->string('status');
            $table->timestamps();
        });

         //Location Server Table
        Schema::create('location_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('location_id');
            $table->string('server_ip');
            $table->string('prev_server_ip');
            $table->longText('login_credentials')->nullable();
            $table->boolean('status')->default(1);
            $table->string('address')->nullable();
            $table->timestamps();
        });

         // Client Location Table
        Schema::create('clientlocation_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedInteger('location_master_id');
            $table->string('location_server_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

         //Features Table
        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('features_name');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        //Sub Feature's Table
         Schema::create('sub_features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_features_name')->nullable();
            $table->unsignedInteger('features_id');
            $table->foreign('features_id')->references('id')->on('features');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });


          Schema::create('clientfeatures_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('features_id');
            $table->string('subfeatures_id');
            $table->boolean('status')->default(1);
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
        //client
        Schema::dropIfExists('location_masters');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('location_servers');
        Schema::dropIfExists('clientlocation_details');
        //features
        Schema::dropIfExists('features');
        Schema::dropIfExists('sub_features');

        Schema::dropIfExists('clientfeatures_details');
    }
}
