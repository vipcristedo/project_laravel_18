@extends('frontend.layouts.master')
@section('title')
Tìm kiếm sản phẩm
@endsection

@section('banner_content')
	<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
		<h3>Kết quả cho "{{ $key }}"</h3>
		<div class="w3ls_w3l_banner_nav_right_grid1">
			@foreach($products as $product)
			<div class="col-md-3 w3ls_w3l_banner_left">
				<div class="hover14 column">
				<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
					<div class="agile_top_brand_left_grid1">
						<figure>
							<div class="snipcart-item block">
								<div class="snipcart-thumb">
									<a href="{{ route('frontend.product.show',$product->id) }}"><img src="{{ $images[$product->id]->path }}" alt=" " class="img-responsive" style="max-height: 140px; max-width: 140px;" /></a>
									<p>{{ $product->name }}</p>
									<h4>{{ number_format($product->sale_price) }}VNĐ <span>{{ number_format($product->origin_price) }}</span></h4>
								</div>
								<div class="snipcart-details">
									<a href="{{ route('frontend.cart.add',$product->id) }}" class="btn btn-danger">Thêm Vào Giỏ</a>
								</div>
							</div>
						</figure>
					</div>
				</div>
				</div>
			</div>
			@endforeach
			<div class="clearfix"> </div>
		</div>
	</div>
@endsection

@section('newletter')
	<div class="newsletter">
		<div class="container">
			<div class="w3agile_newsletter_left">
				<h3>Đăng ký ngay để nhận những tin mới nhất</h3>
			</div>
			<div class="w3agile_newsletter_right">
				<form action="#" method="post">
					<input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
					<input type="submit" value="subscribe now">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
@endsection