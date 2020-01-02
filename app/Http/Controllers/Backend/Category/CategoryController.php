<?php

namespace App\Http\Controllers\Backend\Category;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function index(){
    	$categories= Category::paginate(8);
    	return view('backend.category.index')->with('categories', $categories);
    }
    public function showProducts($category_id){
    	$products= Category::find($category_id)->products;
    	return view('backend.category.products')->with('products', $products);
    }
}
