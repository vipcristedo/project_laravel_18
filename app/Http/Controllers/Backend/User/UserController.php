<?php

namespace App\Http\Controllers\Backend\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserAdminRequest;
class UserController extends Controller
{
    public function index(Request $request){
    	//$users = \DB::table('users')->get();
    	//$users = User::get();

    	//$users = \App\User::paginate(15);

        $users = \App\User::orderByRaw('id asc');
        if($request->key){
            $users = $users->where('name', 'like', '%'.$request->key.'%')->orWhere('id', 'like', '%'.$request->key.'%');
        }
        $users = $users->paginate(15);
        if($request->key){
            $users = $users->appends(['key' => $request->key]);
        }

    	//$users = User::simplePaginate(15);

    	return view('backend.user.index')->with('users', $users);
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('backend.user.show')->with('user',$user);
    }

    public function create(){
    	return view('backend.user.create');
    }

    public function edit($id){
        $user=User::findOrFail($id);
        return view('backend.user.edit')->with([
            'user'=>$user
        ]);
    }
    public function edit1(){
        $user=User::findOrFail(\Auth::user()->id);
        return view('backend.user.edit1')->with([
            'user'=>$user
        ]);
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
    public function update(Request $request, $id ){
        
        $user = User::findOrFail($id);
        $user->role = $request->get('role')==null?\Auth::user()->role:$request->get('role');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->password = $request->get('password')==null?$user->password:bcrypt($request->get('password'));
        $user->save();
        Session::flash('msg', 'Cập nhật người dùng '.$user->name.' thành công');

        return redirect()->route('backend.user.index');
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        Session::flash('msg', 'Xóa người dùng '.$user->name.' thành công');
        $user->delete();
        return redirect()->route('backend.user.index');
    }
}
