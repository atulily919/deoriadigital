<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sub_feature extends Model
{
    //table name
    protected $table = 'sub_features';
	protected $fillable = array('sub_features_name','features_id','status');
}
