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
        	'path'=>'/storage/images/'.$i.'.png',
        	'type'=>'png',
        	'size'=>100+$i,
            'product_id'=>$i
        ]);
    	}
    }
}
