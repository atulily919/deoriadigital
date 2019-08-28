<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //users table
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedInteger('location_id');
            $table->foreign('location_id')->references('id')->on('location_masters');
            $table->integer('server_id');
            $table->string('username');
            $table->string('password');
            $table->string('fullname')->nullable();
            $table->string('email')->unique();
            $table->string('status')->default('Active');
            $table->string('organization')->default('Default')->nullable();
            $table->string('group')->default('Default')->nullable();
            $table->string('data')->nullable();
            $table->integer('presence');
            $table->string('timezone')->nullable()->default('-330');
            $table->integer('invisible')->default('0');
            $table->string('usertype');
            $table->integer('diskuse');
            $table->string('source');
            $table->string('meta')->nullable();
            $table->string('reports_to')->nullable(); //merge columns of Iteam,Iteam2
            $table->string('supervisor')->nullabel();
            $table->string('passwordreset')->nullable();
            $table->string('remember_token');
            $table->string('numbers')->nullable();//merge columns of number1 & number2
            $table->string('exten')->nullable();
            $table->string('extencontext')->nullable();
            $table->string('dialmode_assign')->nullable();
            $table->string('current_dialmode')->nullable();
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
        Schema::dropIfExists('users');
    }
}
