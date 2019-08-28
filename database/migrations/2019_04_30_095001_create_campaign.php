<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('campaign_name');
            $table->string('status')->default('Active');
            $table->string('users_id')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });

        Schema::table('users',function (Blueprint $table){

           $table->string('sel_campaign')->after('dialmode_assign')->nullable();

        });

        Schema::create('groupskills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name');
            $table->string('status')->default('Active');
            $table->string('users_id')->nullable();
            $table->timestamps();
        });

        Schema::create('assign_campaign_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('groupskill_id')->nullable();
            $table->string('campaign_id')->nullable();
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('groupskills');
        Schema::dropIfExists('assign_campaign_details');
    }
}
