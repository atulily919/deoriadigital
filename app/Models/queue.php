<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class queue extends Model {
	protected $table = 'queues';
	protected $fillable = array('request', 'client_details', 'location_id', 'server_id', 'data', 'status');
}
