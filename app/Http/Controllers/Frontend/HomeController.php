<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::all();
    	return view('frontend.index')->with([
            'categories'=>$categories,
            'categories1'=>$categories
        ]);
    }
    public function show(){
    	return view('frontend.product.show');
    }
    public function about(){
    	return view('frontend.about');
    }
    public function services(){
    	return view('frontend.services');
    }
    public function checkout(){
    	return view('frontend.checkout');
    }
}
