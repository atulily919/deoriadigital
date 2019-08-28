<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class campaign extends Model {
	//table name
	protected $table = 'campaigns';
	protected $fillable = array('client_id', 'campaign_name', 'status', 'user_id', 'start_date', 'end_date', 'campaign_type', 'param_value');
}
