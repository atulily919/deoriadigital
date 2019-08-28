<?php

use App\Models\pages;
use Illuminate\Database\Seeder;

class PagesTableSeeders extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$arr = [['page_name' => 'Dashboard', 'parent_page' => '0', 'url' => '/home', 'status' => 'Active', 'icon' => 'fa fa-cube'],
			['page_name' => 'Location Server', 'parent_page' => '0', 'url' => '/locationserver', 'status' => 'Active', 'icon' => 'fa fa-location-arrow'],
			['page_name' => 'Clients', 'parent_page' => '0', 'url' => '/allclients', 'status' => 'Active', 'icon' => 'fa fa-users'],
			['page_name' => 'All Features', 'parent_page' => '0', 'url' => '/allfeatures', 'status' => 'Active', 'icon' => 'fa fa-asterisk'],
			['page_name' => 'Central system roles', 'parent_page' => '0', 'url' => '/privileges', 'status' => 'Active', 'icon' => 'fa fa-share'],
			['page_name' => 'Client Users', 'parent_page' => '0', 'url' => '/users', 'status' => 'Active', 'icon' => 'fa far fa-user'],
			['page_name' => 'Client Features', 'parent_page' => '0', 'url' => '/clientfeatures', 'status' => 'Active', 'icon' => 'fa fa-bars'],
			['page_name' => 'Roles', 'parent_page' => '0', 'url' => '/roles', 'status' => 'Active', 'icon' => 'fa fa-star'],
			['page_name' => 'Campaign', 'parent_page' => '0', 'url' => '#', 'status' => 'Active', 'icon' => 'fa fab fa-bandcamp'],
			['page_name' => 'SkillGroup', 'parent_page' => '9', 'url' => '/skillgroup', 'status' => 'Active', 'icon' => 'fa far fa-address-card'],
			['page_name' => 'Create Campaign', 'parent_page' => '9', 'url' => '/campaign', 'status' => 'Active', 'icon' => 'fa fa-pencil'],
			['page_name' => 'Assign Campaign', 'parent_page' => '9', 'url' => '/assigncampaign', 'status' => 'Active', 'icon' => 'fa fa-plus'],
			['page_name' => 'Phonebook', 'parent_page' => '9', 'url' => '/phonebook', 'status' => 'Active', 'icon' => 'fa fa-phone'],
			['page_name' => 'Campaign Query', 'parent_page' => '9', 'url' => '/campaignquery', 'status' => 'Active', 'icon' => 'fa fa-question'],
			['page_name' => 'Synchronization Data', 'parent_page' => '0', 'url' => '/synchronization', 'status' => 'Active', 'icon' => 'fa fa-spinner']];

		pages::insert($arr);
	}
}
