@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Khách Hàng
      </div>
      <div class="table-responsive">
        <?php
        $message = Session::get('message');
        if($message){
            echo '<span class = "text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên Khách Hàng</th>
              <th>Email</th>
              <th>Số Điện Thoại</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
           
            <tr>
              <td style="font-size:16px">{{$order_by_id->customer_name}}</td>
              <td style="font-size:16px">{{$order_by_id->customer_email}}</td>
              <td style="font-size:16px">{{$order_by_id->customer_phone}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Chi Tiết Đơn Hàng
      </div>
      <div class="table-responsive">
        <?php
        $message = Session::get('message');
        if($message){
            echo '<span class = "text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên Sản Phẩm</th>
              <th>Giá Tiền</th>
              <th>Số Lượng</th>
              <th>Tổng Tiền</th>
              <th>Tổng Tiền Có Thuế</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-size:16px">{{$order_by_id->product_name}}</td>
              <td style="font-size:16px">{{$order_by_id->product_price}} VNĐ</td>
              <td style="font-size:16px">{{$order_by_id->product_sales_quantity}}</td>
              <td style="font-size:16px">{{$order_by_id->product_price*$order_by_id->product_sales_quantity}} VNĐ</td>
              <td style="font-size:16px">{{$order_by_id->order_total}} VNĐ</td>
            </tr>
          </tbody>
        </table>
        </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Vận Chuyển
      </div>
      <div class="table-responsive">
        <?php
        $message = Session::get('message');
        if($message){
            echo '<span class = "text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên Người Nhận</th>
              <th>Địa Chỉ</th>
              <th>Số Điện Thoại</th>
            </tr>
          </thead>
          <tbody>
           
            <tr>
              <td style="font-size:16px">{{$order_by_id->shipping_name}}</td>
              <td style="font-size:16px">{{$order_by_id->shipping_address}}</td>
              <td style="font-size:16px">{{$order_by_id->shipping_phone}}</td>
              {{-- <td>
                <a href= "" class="active" style="font-size:20px;" ui-toggle-class="">
                  <i class="fa-solid fa-pen-to-square" style="color:forestgreen;"></i>
                </a>
                <a onclick="return confirm('Bạn Có Thật Sự Muốn Xóa??')" href="" class="active" style="font-size:20px;"  ui-toggle-class="">
                  <i class="fa-solid fa-trash-can" style="color:red;"></i>
                </a>
              </td> --}}
            </tr>


          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          {{-- <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div> --}}
          {{-- <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div> --}}
        </div>
      </footer>
    </div>
</div>

@endsection