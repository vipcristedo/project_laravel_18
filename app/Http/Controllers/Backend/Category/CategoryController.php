<?php

namespace App\Http\Controllers\Backend\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
class CategoryController extends Controller
{
    public function index(){
    	$categories= Cache::remember('categories', 50 ,function(){
            return Category::orderByRaw('created_at DESC')->paginate(8);
        });
    	return view('backend.category.index')->with('categories', $categories);
    }

    public function show($id){
        $category = Category::findOrFail($id);
        return view('backend.category.show')->with('category',$category);
    }

    public function create(){
    	$categories= Category::where('parent_id', null)->get();
    	return view('backend.category.create')->with('categories', $categories);
    }

    public function store(StoreCategoryRequest $request ){
    	$category = new Category();
        $category->name = $request->get('name');
        $category->slug = $request->get('slug')==null?\Illuminate\Support\Str::slug($request->get('name').time()):$request->get('slug');
        $category->parent_id = $request->get('parent_id');
        $category->user_id = Auth::user()->id;
        $category->save();
        Session::flash('msg', 'Tạo mới danh mục '.$category->name.' thành công');

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
        $category->slug = $request->get('slug')==null?\Illuminate\Support\Str::slug($request->get('name').time()):$request->get('slug');
        $category->parent_id = $request->get('parent_id');
        $category->user_id = Auth::user()->id;
        $category->save();
        Session::flash('msg', 'Cập nhật danh mục '.$category->name.' thành công');

        return redirect()->route('backend.category.index');
    }

    public function destroy($id){
    	$category = Category::findOrFail($id);
        Session::flash('msg', 'Xóa danh mục '.$category->name.' thành công');
    	$category->delete();
        return redirect()->route('backend.category.index');
    }

    public function showProducts($category_id){
    	$products= Category::findOrFail($category_id)->products;
    	return view('backend.category.products')->with('products', $products);
    }
}
