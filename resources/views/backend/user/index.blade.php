@extends('backend.layouts.master')
@section('title')
Danh sách người dùng
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
                        <h1 class="m-0 text-dark">Danh sách người dùng</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách người dùng</li>
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
                @if ( Session::has('msg') )
                <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('backend.user.create') }}" class="btn btn-primary">Tạo mới</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Tên</th>
                                <th>Quyền</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            @if($user->id != Auth::user()->id)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('backend.user.show',$user->id) }}">{{ $user->name }}</a></td>
                                <td>
                                @if($user->role==1||$user->role==2)
                                Admin
                                @else
                                User
                                @endif
                                </td>
                                <td>
                                <form action="{{ route('backend.user.delete', $user->id ) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('backend.user.showProducts',$user->id)}}" class="btn btn-success">Sản phẩm</a>
                                    @can('update',$user)
                                    <a href="{{ route('backend.user.edit',$user->id)}}" class="btn btn-info">Sửa</a>
                                    @endcan
                                    @can('delete',$user)
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fa fa-btn fa-trash"></i>Xoá
                                    </button>
                                    @endcan
                                </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        {!! $users->links() !!}
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