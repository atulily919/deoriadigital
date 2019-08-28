<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pages extends Model
{
    protected $table = 'pages';
	protected $fillable = array('id','page_name','subpage_name','status');
}