<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->integer('keyval_id')->default('0');
            $table->longText('peopledata')->nullable();
            $table->longText('modifylog')->nullable();
            $table->longText('dirty')->nullable();
            $table->string('currentstatus')->nullable();
            $table->string('legalstatus')->nullable();
            $table->string('camp_name')->nullable();
            $table->string('status')->nullable();
            $table->string('clientinternalid')->nullable();
            $table->string('clientcode')->nullable();
            $table->string('dialer_status')->nullable();
            $table->string('dialer_substatus')->nullable();
            $table->dateTime('dialer_callback')->nullable();
            $table->dateTime('dialer_lastcall')->nullable();
            $table->integer('crm_id')->nullable();
            $table->integer('LeadID')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
