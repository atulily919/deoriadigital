<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clientlocation_details extends Model
{
    //table name
    protected $table = 'clientlocation_details';
	protected $fillable = array('client_id','location_master_id','location_server_id','status');
}
