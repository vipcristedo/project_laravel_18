<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
	public function index(){
    	$orders= Order::orderByRaw('created_at DESC')->paginate(8);
    	return view('backend.order.index')->with('orders', $orders);
    }
    public function store(Request $request){

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->money = $request->get('money');
            $order->save();
            return redirect()->route('index');
    }
    public function showProducts($order_id){
    	$products= \App\Order::findOrFail($order_id)->products()->paginate(8);

    	return view('backend.order.products')->with('products',$products);
    }
    public function myOrder($user_id){
    	$orders = Order::findOrFail($user_id);
    }
    public function destroy($id){
        $order= Order::findOrFail($id);
        $order->delete();
        return redirect()->route('backend.order.index');
    }
}
