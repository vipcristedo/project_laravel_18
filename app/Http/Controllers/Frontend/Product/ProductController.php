<?php

namespace App\Http\Controllers\Frontend\Product;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    var $categories;
    function __construct(){
        $this->categories=Category::all();
    }

    public function show($id){
    	$product = Product::findOrFail($id);
        $image= Product::findOrFail($id)->images()->first();
    	return view('frontend.product.show')->with([
            'product'=>$product,
            'categories'=>$this->categories,
            'image'=>$image
        ]);
    }
    
}
