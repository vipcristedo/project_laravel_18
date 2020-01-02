<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->truncate();
        for($i=1;$i<=10;$i++){
        DB::table('images')->insert([
        	'name'=>'product '.$i,
        	'type'=>'jpg',
        	'size'=>100+$i,
            'product_id'=>1
        ]);
    	}
    }
}
