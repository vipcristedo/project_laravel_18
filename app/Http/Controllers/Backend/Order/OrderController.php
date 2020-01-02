<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    public function showProducts($order_id){
    	$products= \App\Order::find($order_id)->products;
    	foreach ($products as $product) {
    		echo $product->name.': '.$product->sale_price."<br>";
    	}
    }
}
