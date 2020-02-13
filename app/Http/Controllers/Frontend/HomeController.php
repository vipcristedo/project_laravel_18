<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    var $categories;
    function __construct(){
        $this->categories = Category::all();
    }
    public function index(){
        // $array = array();
        // $category = new Category();
        // // $category->id = 1;
        // // $category->parent_id=1;
        // // $category->name='hi';
        // $array=[
        //     '0'=>1,
        //     '1'=>2
        // ];
        // $value = Cache::put('view',1);
        
        // $value =Cache::put('key',$category,now()->addHour(24));
        // dd($value);
        

    	return view('frontend.index');
    }
    public function show(){
        // if(Cache::has('key')){
        //     $category = Cache::get('key');
        // }else{
        //     $category = Category::all();
        // }
        // $value = Cache::increment('view',1);
        // return $value;
        // $value = Cache::pull('view');
        // $value = Cache::forget('view');
        // $view = Cache::get('view');
        // dd($view);

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
