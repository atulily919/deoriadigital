<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customerrecord extends Model
{
     protected $table = 'records';
	protected $fillable = array('firstname','lastname','mobile','email','keyval_id','peopledata','modifylog','dirty','currentstatus','legalstatus','camp_name','status','clientinternalid','clientcode','dialer_status','dialer_substatus','dialer_callback','dialer_lastcall','crm_id','LeadID');
}
