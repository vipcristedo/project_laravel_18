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
                        <h1 class="m-0 text-dark">Danh sách đơn hàng</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách đơn hàng</li>
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
                        <h3 class="card-title">Danh sách đơn hàng</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>User ID</th>
                                <th>Tổng tiền</th>
                                <th>thời gian đặt</th>
                                <th  style="text-align: center;">Trạng thái</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="{{ route('backend.user.show',$order->user_id) }}">{{ \DB::table('users')->where('id',$order->user_id)->value('name') }}</a></td>
                                <td>{{number_format($order->money)}}</td>
                                <td>{{ $order->created_at }}</td>
                                <td style="text-align: center;">
                                    @if($order->status==0)
                                        <a href="#" class="btn btn-warning" data-toggle="tooltip" title="Chờ xác nhận" data-placement="top" ><i class="fas fa-clock"></i></a>
                                    @elseif($order->status==1)
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" title="Đang giao" data-placement="top" ><i class="fas fa-truck"></i></a>
                                    @else
                                        <a href="#" class="btn btn-success" data-toggle="tooltip" title="Đã hoàn thành" data-placement="top" ><i class="fas fa-check"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('backend.order.showProducts',$order->id)}}" class="btn btn-primary">Chi tiết</a>
                                    @if($order->status==1)
                                    <form action="{{ route('backend.order.complete', $order->id ) }}" method="POST" style="display: inline;">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button type="submit" class="btn btn-success">
                                            Hoàn thành
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('backend.order.delete', $order->id ) }}" method="POST" style="display: inline;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        @can('delete',$order)
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
                        {!! $orders->links() !!}
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