<?php

namespace App\Http\Controllers\Backend\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
    	//$users = \DB::table('users')->get();
    	//$users = User::get();

    	//$users = \App\User::paginate(15);
        $users = \App\User::paginate(15);

    	//$users = User::simplePaginate(15);

    	return view('backend.user.index')->with('users', $users);
    }
    public function create(){
    	return view('backend.user.create');
    }
    
    public function showProducts($user_id){
        $products=\App\User::findOrFail($user_id)->products;
        return view('backend.user.products')->with('products', $products);
    }
    public function test($id){
        // $user_infor=User::find($id)->userInfor;
        // dd($user_infor->fullname);
        // $user=\App\UserInfor::find($id)->user;
        // dd($user->email);

        // $products = \App\Category::find($id)->products;
        // foreach ($products as $key => $value) {
        //     echo $value->name.'<br>';
        // }

        // $category = \App\Product::find($id)->category;
        // dd($category->name);

        // $products= \App\Order::find($id)->products;
        
        // foreach ($products as $key => $value) {
        //     echo $value->name.'<br>';
        // }

        $orders= \App\Product::findOrFail($id)->orders;
        foreach ($orders as $key => $value) {
            echo $value->money.'<br>';
        }
    }
}
