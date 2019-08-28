<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class location_master extends Model
{
    //table name
    protected $table = 'location_masters';
	protected $fillable = array('location','location_state','status');

	 public function clientlocation_details()
    {
    	return $this->hasMany('App\Models\clientlocation_details','location_master_id','id');
    }
    public function locationserver()
    {
        return $this->belongsToMany('App\Models\location_server');
    }
}
