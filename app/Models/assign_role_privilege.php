<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class assign_role_privilege extends Model
{
    protected $table = 'assign_role_privileges';
	protected $fillable = array('client_id','roles_id','features_id','subfeatures_id','status');
}