@extends('frontend.layouts.master')
@section('title')
Tạp Hóa Online
@endsection
@section('banner_nav_right')
	{{-- <script type="text/javascript">
		$(function me(){
			swal("Thêm mới thành công!", "Thêm mới sản phẩm {{ "hihi" }} thành công", "success");
		})
	</script> --}}
	<section class="slider">
		<div class="flexslider">
			<ul class="slides">
				<li>
					<div class="w3l_banner_nav_right_banner">
						<h3>Ngũ Cốc</h3>
						<div class="more">
							<a href="{{ route('frontend.category.products',4) }}" class="button--saqui button--round-l button--text-thick" data-text="Xem ngay">Xem ngay</a>
						</div>
					</div>
				</li>
				<li>
					<div class="w3l_banner_nav_right_banner1">
						<h3>Thực phẩm tươi sạch</h3>
						<div class="more">
							<a href="{{ route('frontend.category.products',2) }}" class="button--saqui button--round-l button--text-thick" data-text="Xem ngay">Xem ngay</a>
						</div>
					</div>
				</li>
				<li>
					<div class="w3l_banner_nav_right_banner2">
						<h3>giảm tới<i>10%</i></h3>
						<div class="more">
							<a href="{{ route('frontend.category.products',3) }}" class="button--saqui button--round-l button--text-thick" data-text="Xem ngay">Xem ngay</a>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</section>
	<!-- flexSlider -->
		<link rel="stylesheet" href="frontend/css/flexslider.css" type="text/css" media="screen" property="" />
		<script defer src="frontend/js/jquery.flexslider.js"></script>
		<script type="text/javascript">
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
	<!-- //flexSlider -->
<div class="clearfix"></div>
@endsection

@section('content')
<div class="top-brands">
		<div class="container">
			<h3>Top Sản phẩm</h3>
			<div class="agile_top_brands_grids">
				@foreach($products as $product)
				<div class="col-md-3 w3ls_w3l_banner_left">
				<div class="hover14 column">
				<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
					<div class="agile_top_brand_left_grid1">
						<figure>
							<div class="snipcart-item block">
								<div class="snipcart-thumb">
									<a href="{{ route('frontend.product.show',$product->id) }}">
										<img src="{{ $images[$product->id]->path }}" alt=" " class="img-responsive" style="max-height: 140px; max-width: 140px;" />
									</a>
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
	</div>
<!-- //top-brands -->
@endsection

@section('newsletter')
	@if(null ==Auth::user())
	<div class="newsletter">
		<div class="container">
			<div class="w3agile_newsletter_left">
				<h3>Đăng kí để nhận những tin hot nhất</h3>
			</div>
			<div class="w3agile_newsletter_right">
				<form action="#" method="post">
					<input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
					<input type="submit" value="Đăng kí ngay">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	@endif
@endsection