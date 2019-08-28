<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class central_users extends Model
{
    //table name
    protected $table = 'users';
	protected $fillable = array('client_id','location_id','server_id','username','password','fullname','email','status','organization','group','data','presence','timezone','invisible','usertype','diskuse','source','meta','reports_to','supervisior','passwordreset','remember_token','numbers','exten','extencontext','dialmode_assign','sel_campaign','current_dialmode');
}
