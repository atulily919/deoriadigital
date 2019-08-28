<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class skillgroup extends Model
{
    protected $table = 'skillgroups';
	protected $fillable = array('group_name','status','users_id');
}