@extends('welcome')
@section('content')
@foreach ($product_details as $key => $product)
<div class="product-details"><!--product-details-->
    <style>
        li.active{
            border: 2px solid #16d116;
        }
    </style>
    <div class="col-sm-5">
        <ul id="imageGallery">
            @foreach ($gallery as $key => $gal)
            <li data-thumb="{{asset('public/uploads/gallery/'.$gal->image_img)}}" 
                data-src="{{asset('public/uploads/gallery/'.$gal->image_img)}}">
                <img width="100%" src="{{asset('public/uploads/gallery/'.$gal->image_img)}}" />
              </li>
            @endforeach
          </ul>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$product->product_name}}</h2>
            <p>Sản Phẩm ID: {{$product->product_id}}</p>
            <img src="{{URL::to('/public/frontend/images/rating.png')}}" alt="" />

            <form action="{{URL::to('/save-cart')}}" method="POST">
                {{ csrf_field() }}
            <span>
                <span>{{number_format($product->product_price).'VNĐ'}}</span>
                <label>Số Lượng:</label>
                <input name="qty" type="number" min="1" max="5" value="1" />
                <input name="productid_hidden" type="hidden" value="{{$product->product_id}}" />
                <button type="submit" class="btn btn-fefault cart">
                   + <i class="fa fa-shopping-cart"></i>
                </button>
                {{-- <label>Kích Cỡ:</label>
                <select name="size" required>
                    <option value="">Chọn kích cỡ</option>
                    @foreach ($sizes as $size)
                    <option value="{{$size->size_name}}">{{$size->size_name}}</option>
                    @endforeach
                </select> --}}
            </span>
            </form>
            <p><b>Tình Trạng:</b> Còn Hàng</p>
            <p><b>Danh Mục:</b> {{$product->category_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi Tiết</a></li>
            {{-- <li><a href="#reviews" data-toggle="tab">Đánh Giá (5)</a></li> --}}
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <p>{{$product->product_desc}}</p>
        </div>

        {{-- <div class="tab-pane fade " id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Gửi
                    </button>
                </form>
            </div>
        </div> --}}
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản Phẩm Liên Quan</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ($relate as $key => $lienquan)
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $lienquan->product_id) }}" style="text-decoration: none;">
                                    <img src="{{ URL::to('public/uploads/product/' . $lienquan->product_image) }}" alt="" />
                                    <h3>{{ number_format($lienquan->product_price) . ' VNĐ' }}</h3>
                                    <p>{{ $lienquan->product_name }}</p>
                                </a>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa-solid fa-cart-shopping"></i> Thêm Giỏ Hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach	
            </div>
        </div>		
    </div>
</div><!--/recommended_items-->

@endsection