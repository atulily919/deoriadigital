<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class CentraluserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=[['name'=>'central_admin','email'=>'admin@gmail.com','Status'=>'Active','admin_status'=>'1','password'=>Hash::make('admin123')]];

        User::insert($arr);
    }
}
