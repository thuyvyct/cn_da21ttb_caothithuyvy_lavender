@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        {{-- <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
              <li class="active">Thanh Toán Giỏ Hàng</li>
            </ol>
        </div><!--/breadcrums--> --}}
        <div class="review-payment">
            <h3>Xem Lại Giỏ Hàng</h3>
        </div>

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

    <div class="payment-options">
        <h4 style="margin: 10px 0;">Chọn Hình Thức Thanh Toán</h4>
        <form method="POST" action="{{URL::to('/order-place')}}">
            {{csrf_field()}}
            <span>
                <label><input name="payment_option" value="1" type="radio"> <strong>Thanh Toán MoMo</strong></label>
            </span>
            <span>
                <label><input name="payment_option" value="2" type="radio"> <strong>Thanh Toán Khi Nhận Hàng</strong></label>
            </span>
            <span>
                <label><input name="payment_option" value="3" type="radio"> <strong>Thanh Toán VNPay</strong></label>
            </span>

            <!-- Thêm nút thanh toán VNPay -->
            <div class="order-button" style="margin-top: 20px;">
                <input type="submit" value="Đặt Hàng" name="send_order_place" class="btn btn-primary btn-sm">
            </div>
        </form>
    </div>
</section> <!--/#cart_items-->
@endsection
