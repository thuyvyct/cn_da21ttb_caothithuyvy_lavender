<!DOCTYPE html>
<head>
<title> Admin | Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script> 
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Các thẻ meta và css khác -->
{{-- <script src="{{asset('/public/backend/ckeditor/ckeditor.js')}}"></script> --}}
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        LAVENDER
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            {{-- <input type="text" class="form-control search" placeholder=" Search"> --}}
            <form action="{{ URL::to('/admin/search') }}" method="GET" class="form-inline my-2 my-lg-0">
                <input class="form-control search" type="search" name="query" placeholder="Tìm kiếm..." aria-label="Search">

            </form>
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/1.png')}}">
                <span class="username">
					<?php
					$name = Session::get('admin_name');
					if($name){
						echo $name;
					}
					?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng Quan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
						<i class="fa-solid fa-dolly"></i>
                        <span>Đơn Hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản Lý Đơn Hàng</a></li>
						<li><a href="{{URL::to('#')}}">Liệt Kê</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa-solid fa-list"></i>
                        <span>Danh Mục Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add_categoryproduct')}}">Thêm Danh Mục</a></li>
						<li><a href="{{URL::to('/all_categoryproduct')}}">Liệt Kê Danh Mục</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa-solid fa-shirt"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add_product')}}">Thêm Sản Phẩm</a></li>
						<li><a href="{{URL::to('/all_product')}}">Liệt Kê Sản Phấm</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa-solid fa-tape"></i>
                        <span>Kích Cỡ</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add_size')}}">Thêm Kích Cỡ</a></li>
						<li><a href="{{URL::to('/all_size')}}">Liệt Kê Kích Cỡ</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa-solid fa-palette"></i>
                        <span>Màu Sắc</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add_color')}}">Thêm Màu Sắc</a></li>
						<li><a href="{{URL::to('/all_color')}}">Liệt Kê Màu Sắc</a></li>
                    </ul>
                </li>
            </ul>            
		</div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        
        @yield('admin_content')

    </section>
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        load_images();
        function load_images(){
           var pro_id = $('.pro_id').val();
           var _token =$('input[name="_token"]').val();
        //    alert(pro_id);
        
        $.ajax({
            url: "{{url('select-image')}}", // Đường dẫn route của bạn
            method: "POST",
            data: {
                pro_id: pro_id, _token:_token},
            success: function(data){
                $('#image_load').html(data);
            }
        }); 
        }
        $('#file').change(function({
            var error = '';
            var files = $('file')[0].files;

            if (files.length > 5) {
                error+='<p> Bạn Chỉ Được Chọn Tối Đa 5 Ảnh </p>';
            } else if(files.length == ''){
                error+='<p> Bạn Không Thể Để Trống Ảnh </p>';
            }else if(files.length > 2000000){
                error+='<p> File Ảnh Không Thể Vượt Quá 2MB </p>';
            }
            if(error == ''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                return false;
            }
        }))
    });
    $(document).ready(function () {
    // Xóa ảnh
    $(document).on('click', '.delete-image', function () {
        var img_id = $(this).data('img_id');
        var token = $("input[name='_token']").val();

        if (confirm('Bạn có chắc chắn muốn xóa hình ảnh này không?')) {
            $.ajax({
                url: '/delete-image',
                method: 'POST',
                data: {
                    _token: token,
                    img_id: img_id
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.success);
                        $('#image-row-' + img_id).remove();
                    } else {
                        alert(response.error);
                    }
                }
            });
        }
    });

    // Cập nhật tên ảnh
    $(document).on('change', '.image-name', function () {
        var img_id = $(this).data('img_id');
        var new_name = $(this).val();
        var token = $("input[name='_token']").val();

        $.ajax({
            url: '/update-image',
            method: 'POST',
            data: {
                _token: token,
                img_id: img_id,
                new_name: new_name
            },
            success: function (response) {
                if (response.success) {
                    alert(response.success);
                } else {
                    alert(response.error);
                }
            }
        });
    });
});

</script>

<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
