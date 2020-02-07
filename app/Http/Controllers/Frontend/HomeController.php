<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    var $categories;
    function __construct(){
        $this->categories = Category::all();
    }
    public function index(){
    	return view('frontend.index')->with([
            'categories'=>$this->categories
        ]);
    }
    public function show(){
    	return view('frontend.product.show')->with([
            'categories'=>$this->categories
        ]);
    }
    public function about(){
    	return view('frontend.about')->with([
            'categories'=>$this->categories
        ]);
    }
    public function services(){
    	return view('frontend.services')->with([
            'categories'=>$this->categories
        ]);
    }
    public function checkout(){
    	return view('frontend.checkout')->with([
            'categories'=>$this->categories
        ]);
    }
}
