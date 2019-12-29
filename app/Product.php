<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable=[
    	'name','slug','origin_price','sale_price','content','user_id','category_id','tags_id','amount','rate','rate_count'
    ];
}
