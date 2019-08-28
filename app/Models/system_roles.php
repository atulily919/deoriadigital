<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class system_roles extends Model
{
    protected $table = 'system_roles';
	protected $fillable = array('cid','rolename','status');
}