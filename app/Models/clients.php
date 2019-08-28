<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clients extends Model {
	//table name
	protected $table = 'clients';
	protected $fillable = array('name', 'description', 'features_id', 'status');

	public function features() {
		return $this->hasMany('App\Models\feature');
	}

	public function clientlocation_details() {
		return $this->hasMany('App\Models\clientlocation_details', 'client_id', 'id');
	}

	public function clientfeatures_details() {
		return $this->hasMany('App\Models\clientfeatures', 'client_id', 'id');
	}
	public function roles() {
		return $this->hasMany('App\Models\roles', 'client_id', 'id');
	}

}
