<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Order;
use App\User;

class DashboardController extends Controller
{
	public function __construct(){

	}
    public function index(){
    	$products = Product::all()->count();
        $recent_products = Product::orderByRaw('created_at DESC')->get();
    	$orders = Order::all()->count();
    	$users = User::where('role', 0)->count();

    	if (Auth::user()->role==0) {
			return redirect()->route('index');
		}else
    	return view('backend.dashboard')->with([
    		'products' => $products,
            'recent_products' => $recent_products,
    		'orders' => $orders,
    		'users' => $users
    	]);
    }
}
