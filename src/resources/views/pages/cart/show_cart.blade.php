@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="row">
            {{-- <div class="breadcrumbs col-sm-9">
                <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
                <li class="active">Giỏ Hàng</li>
                </ol>
            </div> --}}
        </div>
        <div class="row">
            <div class="table-responsive cart_info col-sm-10">
                <?php
                $content = Cart::content();
                ?>
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td style="text-align: center;" class="image">Hình Ảnh</td>
                            <td style="text-align: center;" class="description">Tên Sản Phẩm</td>
                            <td style="text-align: center;" class="price">Giá</td>
                            <td style="text-align: center;" class="quantity">Số Lượng</td>
                            <td style="text-align: center;" class="total">Thành Tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($content as $v_content)
                        <tr>
                            <td class="cart_product">
                                <a href="">
                                    <img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="100" align="left"  alt="Sản phẩm">
                                </a>
                            </td>
                            <td class="cart_description">
                                <div class="product-details">
                                    <h4 style="text-align: center;"><a href="">{{$v_content->name}}</a></h4>
                                    {{-- <p style="text-align:">Sản Phẩm ID: {{$v_content->id}}</p> --}}
                                </div>
                            </td>
                            {{-- <td class="cart_description">
                                <h4><a href="">{{$v_content->size}}</a></h4>
                                <p>{{$v_content->options->size}}</p>
                            </td> --}}
                            <td class="cart_price" style="text-align: center;">
                                <p >{{number_format($v_content->price).' VNĐ'}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->qty}}" autocomplete="off" size="1">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p style="text-align: center;" class="cart_total_price">
                                    <?php
                                    $subtotal = $v_content->price * $v_content->qty;
                                    echo number_format($subtotal).' VNĐ';
                                    ?>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
            <div class="col-sm-5">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::subtotal().''.' VNĐ'}}</span></li>
                        {{-- <li>Thuế <span>Miễn Phí</span></li> --}}
                        <li>Phí Vận Chuyển <span>Miễn Phí</span></li>
                        <li>Tổng Tiền <span>{{Cart::subtotal().''.' VNĐ'}}</span></li>
                    </ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{-- <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh Toán</a> --}}
                        <?php
							$customer_id = Session::get('customer_id');
							if($customer_id!=NULL){
						?>
							<a href="{{URL::to('/checkout')}}" class="btn btn-success check-out"> Thanh Toán</a>
						<?php
						    }else{
						?>
							<a href="{{URL::to('/login-checkout')}}" class="btn btn-success check-out"> Thanh Toán</a>
						<?php
							}
						?>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection