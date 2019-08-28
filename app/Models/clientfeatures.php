<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clientfeatures extends Model
{
    //table name
    protected $table = 'clientfeatures_details';
	protected $fillable = array('client_id','features_id','subfeatures_id','status');

}
