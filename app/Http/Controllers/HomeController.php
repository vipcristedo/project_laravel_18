<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test(){
        // $flag = Storage::move('old2/test1.txt', 'new/test1.txt');
        // dd($flag);
        // $url = Storage::disk('local')->url('test1.txt');
        // dd($url);
        // $files = Storage::files();
        // dd($files);
        Storage::disk('public')->makeDirectory('images');
        dd(1);
    }
}
