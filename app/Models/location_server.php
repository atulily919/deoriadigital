<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class location_server extends Model
{
	//table name
    protected $table = 'location_servers';
	protected $fillable = array('location_id','server_ip','prev_server_ip','login_credentials','status');
	
	public function location_masters()
    {
    	return $this->belongsTo('App\Models\location_master','location_id','id');
    }
    public function locationmaster()
    {
        return $this->belongsToMany('App\Models\location_master');
    }
}
