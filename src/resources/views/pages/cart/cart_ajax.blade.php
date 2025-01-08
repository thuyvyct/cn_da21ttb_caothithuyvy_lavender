@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="row">
        <div class="breadcrumbs col-sm-9">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
              <li class="active">Giỏ Hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info col-sm-9">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình Ảnh</td>
                        <td class="description">Tên Sản Phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số Lượng</td>
                        <td class="total">Thành Tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                   @php
                       echo '<pre>';
                       print_r(Session::get('cart'));
                       echo '</pre>';
                   @endphp
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="" width="100" alt="" /></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href=""></a></h4>
                            {{-- <p>Web ID: 1089772</p> --}}
                        </td>
                        <td class="cart_price">
                            <p></p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                {{-- <a class="cart_quantity_up" href=""> + </a> --}}
                                <input class="cart_quantity_input" type="text" name="quantity" value="" autocomplete="off" size="2">
                                {{-- <a class="cart_quantity_down" href=""> - </a> --}}
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                               
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                  
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
                        <li>Tổng <span></span></li>
                        <li>Thuế <span>Miễn Phí</span></li>
                        <li>Phí Vận Chuyển <span>Miễn Phí</span></li>
                        <li>Tổng Tiền <span></span></li>
                    </ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{-- <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh Toán</a> --}}
                       
							<a href="" class="btn btn-success check-out"> Thanh Toán</a>
						
							<a href="" class="btn btn-success check-out"> Thanh Toán</a>
						
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection