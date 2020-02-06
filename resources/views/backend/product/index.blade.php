@extends('backend.layouts.master')
@section('title')
Danh sách sản phẩm
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
                        <h1 class="m-0 text-dark">Danh sách sản phẩm</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
@endsection
@section('main-content')
        <section class="content">
            <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-12">
                <a href="{{ route('backend.product.create') }}" class="btn btn-primary">Tạo mới</a>
                @if ( Session::has('msg') )
                <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách sản phẩm</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->amount}}</td>
                                <td>
                                    <form action="{{ route('backend.product.delete', $product->id ) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        @can('update',$product)
                                        <a href="{{ route('backend.product.edit',$product->id)}}" class="btn btn-info">Sửa</a>
                                        @endcan
                                        <a href="{{ route('backend.product.show',$product->id)}}" class="btn btn-primary">Chi tiết</a>
                                        <a href="{{ route('backend.product.showImages',$product->id)}}" class="btn btn-success">Ảnh</a>
                                        @can('delete',$product)
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-btn fa-trash"></i>Xoá
                                        </button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $products->links() !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
        </section>
@endsection