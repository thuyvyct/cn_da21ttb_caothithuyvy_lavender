<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | Lavender</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">

	<link href="{{asset('/public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<link href="{{asset('/public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	{{-- <script src="{{asset('/public/backend/ckeditor/ckeditor.js')}}"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --}}
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/')}}"><img style="height: 70px; width:160px;" src="{{asset('public/frontend/images/logo2.png')}}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
								?>

								@if($customer_id == NULL)	
									<!-- Chưa đăng nhập -->
    								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa-solid fa-credit-card"></i> Thanh Toán</a></li>
								@else
    								@if($shipping_id == NULL)	
										<!-- Đã đăng nhập nhưng chưa có thông tin giao hàng -->
        								<li><a href="{{URL::to('/checkout')}}"><i class="fa-solid fa-credit-card"></i> Thanh Toán</a></li>
    								@else	
										<!-- Đã đăng nhập và có thông tin giao hàng -->
       								 	<li><a href="{{URL::to('/payment')}}"><i class="fa-solid fa-credit-card"></i> Thanh Toán</a></li>
   									@endif
								@endif

								<li><a href="{{URL::to('/show_cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>

								<?php
								$customer_id = Session::get('customer_id');
								if($customer_id!=NULL){
								?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa-solid fa-right-from-bracket"></i></i> Đăng Xuất</a></li>
								
								<?php
								}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập</a></li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/')}}">Trang Chủ</a></li> 
								{{-- <li class="dropdown"><a href="#">Tin Tức<i class="fa fa-angle-down"></i></a></li>  --}}
								<li><a href="{{URL::to('/show_cart')}}">Giỏ Hàng</a></li>
								<li><a href="{{URL::to('/contact')}}">Liên Hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-5">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							{{csrf_field()}}
						<div class="search_box pull-right">
							<input type="text" name="keywords_submit" placeholder="Tìm Kiếm"/>
							{{-- <input type="submit" name="search_items" class="btn btn-info btn-sm" value="Search"> --}}
							<button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i></button>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						{{-- <ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						 --}}
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-12">
									<img src="{{('public/frontend/images/B3.jpg')}}" class="girl img-responsive" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-12">
									<img src="{{('public/frontend/images/B2.jpg')}}" class="girl img-responsive" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-12">
									<img src="{{('public/frontend/images/B1.jpg')}}" class="girl img-responsive" alt="" />
								</div>
							</div>	
						</div>
						{{-- <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a> --}}
					</div>
				</div>
			</div>
		</div>
	</section><!--/slider-->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh Mục Sản Phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach ($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh_muc_san_pham/'.$cate->id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
						<h2>Màu Sản Phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach ($color as $key => $color)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/mau_san_pham/'.$color->id)}}">{{$color->color_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/color-products-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					
                    @yield('content')
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->	
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-1">
					</div>
					<div class="col-lg-1">
					</div>
					<div class="col-lg-3">
						<div class="single-widget">
							<h2>THỜI TRANG LAVENDER</h2>
							<p>Thời trang công sở Lavender</p>
							<p><strong>Trụ sở:</strong> Số 1, ngõ 40/12 Ngọc Trục, Đại Mỗ, Nam Từ Liêm, Hà Nội</p>
							<p><strong>Điện thoại:</strong> <a href="tel:0943316669">0943 316 669</a> / <a href="tel:0356875809">0356 875 809</a></p>
							<p><strong>Email:</strong> <a href="mailto:info@thoitranglavender.com">info@thoitranglavender.com</a></p>
						</div>
					</div>
					<div class="col-lg-3">
						{{-- <div class="single-widget">
							<h2>About Lavender</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div> --}}
					</div>
					<div class="col-lg-3 col-lg-offset-1">
						<div class="single-widget">
							<h2>ĐĂNG KÝ NHẬN TIN</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Địa chỉ email của bạn" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Đăng ký để nhận được thông tin cập nhật <br />mới nhất của chúng tôi...</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
    {{-- <script src="{{asset('public/frontend/js/jquery.js')}}"></script> --}}
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	{{-- <script src="{{asset('/public/frontend/js/sweetalert.min.js')}}"></script> --}}
	{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
	<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('/public/frontend/js/sweetalert.min.js')}}"></script>

	<script src="{{asset('/public/frontend/js/jquery.min.js')}}"></script>
	<script src="{{asset('/public/frontend/js/lightgallery-all.min.js')}}"></script>
	<script src="{{asset('/public/frontend/js/lightslider.js')}}"></script>
	<script src="{{asset('/public/frontend/js/prettify.js')}}"></script>

	<script type="text/javascript">
	  $(document).ready(function() {
   		 $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
	</script>

	{{-- <script type="text/javascript">
    $(document).ready(function(){
		$('.add-cart-ajax').click(function(){
			var id = $(this).data('id_product');
			var cart_product_id = $('.cart_product_id_' + id).val();
			var cart_product_name = $('.cart_product_name_' + id).val();
			var cart_product_image = $('.cart_product_image_' + id).val();
			var cart_product_price = $('.cart_product_price_' + id).val();
			var cart_product_qty = $('.cart_product_qty_' + id).val();
			var _token = $('input[name="_token"]').val();

			$.ajax({
				url:'{{url('/add-cart-ajax')}}',
				method:'POST',
				data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,
					cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},	
				success:function(){
					swal({
						title: "Đã thêm sản phẩm vào giỏ hàng",
						text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
						showCancelButton: true,
						cancelButtonText: "Xem tiếp",
						confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
						closeOnConfirm: false
						},
					function() { 
						window.location.href = "{{url('/gio-hang')}}";
					});
				}
			});
		});
	});
	</script> --}}
	
	<script>
		$(document).ready(function () {
		$('.add-to-cart').click(function () {
			var id = $(this).data('id_product');
			var cart_product_id = $('.cart_product_id_' + id).val();
			var cart_product_name = $('.cart_product_name_' + id).val();
			var cart_product_image = $('.cart_product_image_' + id).val();
			var cart_product_price = $('.cart_product_price_' + id).val();
			var cart_product_qty = $('.cart_product_qty_' + id).val();
			var _token = $('input[name="_token"]').val();

			$.ajax({
				url: '/add-to-cart',
				method: 'POST',
				data: {
					data:{cart_product_id:cart_product_id,
						cart_product_name:cart_product_name,
						cart_product_image:cart_product_image,
						cart_product_price:cart_product_price,
						cart_product_qty:cart_product_qty,
						_token:_token},	
				},
				success: function (response) {
					alert(response.success);
				},
				error: function () {
					alert('Có lỗi xảy ra. Vui lòng thử lại.');
				}
			});
		});
	});
	</script>
</body>
</html>