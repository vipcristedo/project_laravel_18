<?php

namespace App\Http\Controllers\Backend\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	//$users = \DB::table('users')->get();
    	//$users = User::get();

    	$users = \App\User::paginate(15);

    	//$users = User::simplePaginate(15);

    	return view('backend.user.index')->with('users', $users);
    }
    public function create(){
    	return view('backend.user.create');
    }
}
