<?php

namespace App\Http\Controllers\Frontend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
class CategoryController extends Controller
{
    public function products(Category $category){
    	$products= $category->products;
    	$categories = Category::get();
    	$images = array();
    	foreach ($products as $product) {
    		$images[$product->id]=$product->images()->first();
    	}
    	return view('frontend/category/products')->with([
    		'products'=>$products,
    		'categories'=>$categories,
    		'category'=>$category,
    		'images'=>$images
    	]);
    }
}
