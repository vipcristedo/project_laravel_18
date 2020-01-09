<?php

namespace App\Http\Controllers\Frontend\Product;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index(){
    	$products= Product::paginate(8);
    	return view('backend.product.index')->with('products', $products);
    }
    public function create(){
        $categories= \App\Category::all();
    	return view('backend.product.create')->with([
            'categories'=>$categories
        ]);
    }
    public function store(StoreProductRequest $request){
        
        // $validator = Validator::make($request->all(),
        //     [
        //         'name'=>'required|min:5|max:255',
        //         'origin_price'=>'required|numeric',
        //         'sale_price'=>'required|numeric|max:$request->origin_price',
        //         'amount'=>'required|numeric|min:0',
        //         'content'=>'required|min:10',
        //     ],
        //     [
        //         'required' => ':attribute Không được để trống',
        //         'min' => ':attribute Không được nhỏ hơn :min',
        //         'max' => ':attribute Không được lớn hơn :max'
        //     ],
        //     [
        //         'name' => 'Tên sản phẩm',
        //         'origin_price' => 'Giá gốc',
        //         'sale_price' => 'Giá bán',
        //         'amount' =>'Số lượng trong kho',
        //         'content' =>'Mô tả sản phẩm'
        //     ]
        // );
        // if ($validator->errors()){
        //     return back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $product = new Product();
        $product->name = $request->get('name');
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $request->get('category_id');
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->amount = $request->get('amount');
        $product->user_id = Auth::user()->id;
        $product->content = $request->get('content');
        $product->save();

        return redirect()->route('backend.product.index');
    }
    public function show($id){
    	$product = Product::findOrFail($id);
    	return view('frontend.product.show')->with('product',$product);
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
