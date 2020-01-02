<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table='images';
    protected $fillable=[
    	'name','type','size','category_id','user_id','product_id'
    ];
}
