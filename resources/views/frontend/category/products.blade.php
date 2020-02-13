@extends('frontend.layouts.master')
@section('title')
Sản phẩm
@endsection
@section('banner_content')
	<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
		<h3>{{ $category->name }}</h3>
		<div class="w3ls_w3l_banner_nav_right_grid1">
			@foreach($products as $product)
			<div class="col-md-3 w3ls_w3l_banner_left">
				<div class="hover14 column">
				<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
					
					<div class="agile_top_brand_left_grid1">
						<figure>
							<div class="snipcart-item block">
								<div class="snipcart-thumb">
									<a href="{{ route('frontend.product.show',$product->id) }}"><img src="{{ $images[$product->id]->path }}" alt=" " class="img-responsive" /></a>
									<p>{{ $product->name }}</p>
									<h4>{{ number_format($product->sale_price) }}VNĐ <span>{{ number_format($product->origin_price) }}VNĐ</span></h4>
								</div>
								<div class="snipcart-details">
									<form action="#" method="post">
										<fieldset>
											<input type="hidden" name="cmd" value="_cart" />
											<input type="hidden" name="add" value="1" />
											<input type="hidden" name="business" value=" " />
											<input type="hidden" name="item_name" value="{{ $product->name }}" />
											<input type="hidden" name="amount" value="{{ $product->sale_price }}" />
											<input type="hidden" name="discount_amount" value="{{ $product->origin_price-$product->sale_price }}" />
											<input type="hidden" name="currency_code" value="VND" />
											<input type="hidden" name="return" value=" " />
											<input type="hidden" name="cancel_return" value=" " />
											<input type="submit" name="submit" value="Add to cart" class="button" />
										</fieldset>
									</form>
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
				<h3>sign up for our newsletter</h3>
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