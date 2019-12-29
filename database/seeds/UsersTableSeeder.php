<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->truncate();

    	for ($i=1;$i<=32;$i++){
    	DB::table('users')->insert([
        	'name'=>'admin'.$i,
        	'email'=>'vipcristedo'.$i.'@gmail.com',
        	'password'=>bcrypt('123456'),
        	'role'=>1,
        	'phone'=>'0984701585',
        	'address'=>'AL-HP'
        ]);
    	}
    }
}
