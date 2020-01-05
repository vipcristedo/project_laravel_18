<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function __construct(){


	}
    public function index(){
    	if (Auth::user()->role==0) {
			return redirect()->route('index');
		}else
    	return view('backend.dashboard');
    }
}
