@extends('backend.layouts.master')
@section('title')
Danh sách hạng mục
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách danh mục</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Danh sách danh mục</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>
</div>
@endsection
@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ( Session::has('msg') )
                <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('backend.category.create') }}" class="btn btn-primary">Tạo mới</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Thời gian tạo</th>
                                <th>Danh mục cha</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td><a href="{{ route('backend.category.show',$category->id)}}">{{$category->name}}</a></td>
                                <td>{{$category->created_at}}</td>
                                <td>{{$category->parent_id}}</td>
                                <td>
                                    <form action="{{ route('backend.category.delete', $category->id ) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('backend.category.edit',$category->id)}}" class="btn btn-info">Sửa</a>
                                        <a href="{{ route('backend.category.showProducts',$category->id)}}" class="btn btn-success">Sản phẩm</a>
                                        
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-btn fa-trash"></i>Xoá
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $categories->links('vendor.pagination.bootstrap-4') !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection