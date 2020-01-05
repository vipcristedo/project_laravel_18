<?php

namespace App\Http\Controllers\Backend\Product;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    public function index(){
    	$products= Product::paginate(8);
    	return view('backend.product.index')->with('products', $products);
    }
    public function create(){
    	return view('backend.product.create');
    }
    public function show($id){
    	$product = Product::findOrFail($id);
    	return view('backend.product.show')->with('product',$product);
    }
    
    public function showImages($product_id){
    	$images=\App\Product::find($product_id)->images()->paginate(15);
    	return view('backend.product.images')->with('images',$images);
    }
    public function showOrders($product_id){
    	$orders=\App\Product::findOrFail($product_id)->orders;
    	foreach ($orders as $order) {
    		echo $order->id.": ".$order->money."<br>";
    	}
    }
}
