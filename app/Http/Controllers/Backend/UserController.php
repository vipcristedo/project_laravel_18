<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	return view('backend.user');
    }
    public function create(){
    	return view('backend.user_create');
    }
}
