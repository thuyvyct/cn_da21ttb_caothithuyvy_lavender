@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Sản Phẩm
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
              <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>
              <th>ID</th>
              <th>Danh Mục Sản Phẩm</th>
              <th>Tên Sản Phẩm</th>
              <th>Thư Viện Ảnh</th>
              <th>Mô Tả</th>
              <th>Giá</th>
              <th>Kích Cỡ</th>
              <th>Màu</th>
              <th>Hình Ảnh</th>
              <th>Trạng Thái</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_product as $key => $product)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td style="font-size:16px">{{$product -> product_id}}</td>
              <td style="font-size:16px">{{$product -> category_id}}</td>
              <td style="font-size:16px">{{$product -> product_name}}</td>
              <td><a href="{{URL::to('/add_image/'.$product -> product_id)}}">Thư Viện Ảnh</a></td>
              <td style="font-size:16px">{{$product -> product_desc}}</td>
              <td style="font-size:16px">{{$product -> product_price}}</td>
              <td style="font-size:16px">{{$product -> product_size}}</td>
              <td style="font-size:16px">{{$product -> product_color}}</td>
              <td style="font-size:16px"><img src="public/uploads/product/{{$product -> product_image}}" height="100"; width="100"></td>
              <td><span class="text-ellipsis">
                <?php
                  if($product->product_status == 0){
                ?>
                  <a href = "{{URL::to('/unactive_product/'.$product->product_id)}}"><span class = "fa-regular fa-eye-slash" style="color: red; font-size:20px;"></span></a>
                <?php
                  }else{
                ?>
                  <a href = "{{URL::to('/active_product/'.$product->product_id)}}"><span class = "fa-regular fa-eye" style="font-size:20px"></span></a>
                <?php
                  }
                ?>
              </span></td>
              <td>
                <a href= "{{URL::to('/edit_product/'.$product->product_id)}}" class="active" style="font-size:20px;" ui-toggle-class="">
                  <i class="fa-solid fa-pen-to-square" style="color:forestgreen;"></i>
                </a>
                <a onclick="return confirm('Bạn Có Thật Sự Muốn Xóa??')" href="{{URL::to('/delete_product/'.$product->product_id)}}" class="active" style="font-size:20px;"  ui-toggle-class="">
                  <i class="fa-solid fa-trash-can" style="color:red;"></i>
                </a>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          {{-- <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div> --}}
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>

@endsection