<?php

namespace App\Http\Controllers\Backend\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserAdminRequest;
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
    public function store(StoreUserAdminRequest $request){
        $status = User::where('email',$request->get('email'))->firstOrFail();
        if ($status != null) {
            Session::flash('flash_error', 'Email đã tồn tại');
            return redirect()->route('backend.user.create');
        }
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->role = $request->get('role');
        $user->save();
        Session::flash('msg', 'Tạo mới người dùng '.$user->name.' thành công');
        return redirect()->route('backend.user.index');
    }
    public function update(StoreUserAdminRequest $request, $id ){

        $user = User::findOrFail($id);
        $user->role = $request->get('role');
        $user->save();
        Session::flash('msg', 'Cập nhật người dùng '.$user->name.' thành công');

        return redirect()->route('backend.user.index');
    }
    public function destroy($id){
        $user = Category::findOrFail($id);
        $user->delete();
        return redirect()->route('backend.user.index');
    }
}
