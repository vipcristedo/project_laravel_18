<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('orders')->truncate();
    	for($i=1;$i<=5;$i++){
    	DB::table('orders')->insert([
    		'money'=>$i.'00000',
    		'user_id'=>$i
        ]);
    	}
    }
}
