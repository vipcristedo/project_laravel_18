<?php

namespace App\Http\Controllers\Backend\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function index(){
    	$categories= Category::orderByRaw('created_at DESC')->paginate(8);
    	return view('backend.category.index')->with('categories', $categories);
    }

    public function create(){
    	$categories= Category::where('parent_id', null)->get();
    	return view('backend.category.create')->with('categories', $categories);
    }

    public function store(StoreCategoryRequest $request ){
    	$category = new Category();
        $category->name = $request->get('name');
        $category->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $category->parent_id = $request->get('parent_id');
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect()->route('backend.category.index');
    }

    public function edit($id){
    	$categories= Category::where('parent_id', null)->get();
    	$category= Category::findOrFail($id);
    	return view('backend.category.edit')->with([
    		'categories'=> $categories,
    		'category'=>$category
    	]);
    }

    public function update(StoreCategoryRequest $request, $id ){

    	$category = Category::findOrFail($id);
        $category->name = $request->get('name');
        $category->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $category->parent_id = $request->get('parent_id');
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect()->route('backend.category.index');
    }

    public function destroy($id){
    	$category = Category::findOrFail($id);
    	$category->delete();
        return redirect()->route('backend.category.index');
    }

    public function showProducts($category_id){
    	$products= Category::findOrFail($category_id)->products;
    	return view('backend.category.products')->with('products', $products);
    }
}
