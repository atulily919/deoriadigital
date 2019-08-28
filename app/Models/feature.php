<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class feature extends Model
{
    //table name
    protected $table = 'features';
	protected $fillable = array('features_name','status');

	 public function subfeatures()
    {
        return $this->hasMany('App\Models\sub_feature','features_id')->where('status','1');
    }

}
