@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Kết quả tìm kiếm</h2>
						@foreach ($search_product as $key => $product)
						<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
											<h3>{{number_format($product->product_price).' '.'VNĐ'}}</h3>
											<p>{{$product->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa-solid fa-cart-shopping"></i>Thêm Giỏ Hàng</a>
										</div>
								</div>
							</div>
						</div>	
						@endforeach
</div><!--features_items-->
@endsection