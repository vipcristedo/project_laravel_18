<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
	public function index(Request $request){
        $orders= Order::orderByRaw('created_at DESC');
        if($request->key){
            $orders = $orders->where('id', 'like', '%'.$request->key.'%');
        }
        $orders = $orders->paginate(8);
        if($request->key){
            $orders = $orders->appends(['key' => $request->key]);
        }
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
    	$products= $order->products()->get();
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
        $products= $order->products()->get();
        $amount = array();
        foreach ($products as $product) {
            $amount[$product->id] = \DB::table('order_product')->where([
                'order_id' => $order->id,
                'product_id' => $product->id
            ])->value('amount');
            if($amount[$product->id] > $product->amount) {
                alert()->warning('Xác nhận thất bại', 'số lượng sản phẩm '. $product->name .' trong kho không đủ');
                return redirect()->back();
            }
        }
        foreach ($products as $products) {
            $product->amount -= $amount[$product->id];
            $product->sold += $amount[$product->id];
            $product->save();
        }
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
        if($order->status == 1){
            $products= $order->products()->get();
            $amount = array();
            foreach ($products as $product) {
                $amount[$product->id] = \DB::table('order_product')->where([
                    'order_id' => $order->id,
                    'product_id' => $product->id
                ])->value('amount');
            }
            foreach ($products as $products) {
                $product->amount += $amount[$product->id];
                $product->sold -= $amount[$product->id];
                $product->save();
            }
        }
        $order->delete();
        return redirect()->route('backend.order.index');
    }
}
