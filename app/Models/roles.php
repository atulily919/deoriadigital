<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $table = 'roles';
	protected $fillable = array('client_id','rolename','status','module_permission','group_permission','rolegroup','default','group');
}