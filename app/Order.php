<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $fillable=[
    	'money','user_id','status'
    ];
    
    public function products(){
    	return $this->belongsToMany(\App\Product::class);	
    }
}
