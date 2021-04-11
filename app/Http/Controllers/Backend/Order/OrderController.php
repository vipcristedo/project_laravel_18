<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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
        $order = Order::findOrFail($order_id);
    	$products= $order->products()->paginate(8);
        $amount = array();
        foreach ($products as $product) {
            $amount[$product->id] = \DB::table('order_product')->where([
                'order_id' => $order->id,
                'product_id' => $product->id
            ])->value('amount');
        }

    	return view('backend.order.products')->with([
            'products'=>$products,
            'order'=>$order,
            'amount'=>$amount
        ]);
    }
    public function confirm($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = 1;
        $order->save();
        return redirect()->route('backend.order.index');
    }
    public function complete($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = 2;
        $order->save();
        $products = $order->products;
        foreach ($products as $product) {
            $sold = \DB::table('order_product')->where([
                'order_id'=>$order->id,
                'product_id'=>$product->id
            ])->value('amount');
            $product->amount = $product->amount -$sold;
            $product->sold =$product->sold +$sold; 
            $product->save();
         } 
        Session::flash('msg','Đã hoàn thành đơn hàng '.$order->id);
        return redirect()->back();
    }
    public function myOrder($user_id){
    	$orders = Order::findOrFail($user_id);
    }
    public function newOrders(){
        $orders = Order::where('status', 0)->orderByRaw('created_at DESC')->paginate(8);
        return view('backend.order.index')->with([
            'orders'=>$orders
        ]);
    }
    public function destroy($id){
        $order= Order::findOrFail($id);
        $order->delete();
        return redirect()->route('backend.order.index');
    }
}
