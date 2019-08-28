<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('queues', function (Blueprint $table) {
			$table->increments('id');
			$table->string('request');
			$table->string('client_details');
			$table->integer('location_id')->nullable();
			$table->integer('server_id')->nullable();
			$table->longText('data')->nullable();
			$table->integer('priority')->default('0');
			$table->longText('remark')->nullable();
			$table->string('status')->default('paused');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('queues');
	}
}
