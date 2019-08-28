<?php

use DB;
use Illuminate\Database\Seeder;

class ScreenDataSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('screens')->insert([
			['screen_name' => 'AEM Relationship Screen', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
			['screen_name' => 'AEM Sales Screen', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
			['screen_name' => 'AEM Collections Screen', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
			['screen_name' => 'Non-AEM Relationship Screen', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
			['screen_name' => 'Non-AEM Sales Screen', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
			['screen_name' => 'Non-AEM Collections', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
		]);

	}
}
