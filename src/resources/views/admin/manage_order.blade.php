@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Đơn Hàng
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
              </th>
              <th>Tên Người Đặt</th>
              <th>Tổng Giá Tiền</th>
              <th>Trạng Thái</th>
              <th>Hiển Thị</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_order as $key => $order)
            <tr>
              <td style="font-size:16px">{{$order -> customer_name}}</td>
              <td style="font-size:16px">{{$order -> order_total}}</td>
              <td style="font-size:16px">{{$order -> order_status}}</td>
              <td>
                <a href= "{{URL::to('/view-order/'.$order->order_id)}}" class="active" style="font-size:20px;" ui-toggle-class="">
                  <i class="fa-solid fa-circle-info" style="color:forestgreen;"></i><br>
                </a>
                <a onclick="return confirm('Bạn Có Thật Sự Muốn Xóa??')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active" style="font-size:20px;"  ui-toggle-class="">
                  <i class="fa-solid fa-trash-can" style="color:red;"></i>
                </a>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection