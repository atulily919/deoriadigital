<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInCampaignTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('campaigns', function (Blueprint $table) {
			$table->string('campaign_type')->after('users_id')->nullable();
			$table->longText('param_value')->after('campaign_type')->nullable();
			$table->integer('screen_id')->after('param_value')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('campaigns', function (Blueprint $table) {
			//
		});
	}
}
