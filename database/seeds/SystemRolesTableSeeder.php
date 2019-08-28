<?php

use Illuminate\Database\Seeder;
use App\Models\system_roles;

class SystemRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=[['rolename'=>'Admin','status'=>'Active'],
              ['rolename'=>'Manager','status'=>'Active'],
			  ['rolename'=>'Supervisor','status'=>'Active'],
			  ['rolename'=>'User','status'=>'Active']];


			  system_roles::insert($arr);
    }
}
