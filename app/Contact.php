<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    protected $table='contacts';
    use SoftDeletes;
    protected $fillable=[
    	'name','mail','phone','subject', 'message'
    ];
}
