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
}
