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
}
