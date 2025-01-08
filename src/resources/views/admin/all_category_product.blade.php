@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Danh Mục Sản Phẩm
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
              <th>Tên Danh Mục</th>
              <th>Mô Tả</th>
              <th>Trạng Thái</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_category_product as $key => $cate_pro)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td style="font-size:16px">{{$cate_pro -> category_name}}</td>
              <td style="font-size:16px">{{$cate_pro -> category_desc}}</td>
              <td><span class="text-ellipsis">
                <?php
                  if($cate_pro->category_status == 0){
                ?>
                  <a href = "{{URL::to('/unactive_category_product/'.$cate_pro->id)}}"><span class = "fa-regular fa-eye-slash" style="color: red; font-size:20px;"></span></a>
                <?php
                  }else{
                ?>
                  <a href = "{{URL::to('/active_category_product/'.$cate_pro->id)}}"><span class = "fa-regular fa-eye" style="font-size:20px"></span></a>
                <?php
                  }
                ?>
              </span></td>
              <td>
                <a href= "{{URL::to('/edit_category_product/'.$cate_pro->id)}}" class="active" style="font-size:20px;" ui-toggle-class="">
                  <i class="fa-solid fa-pen-to-square" style="color:forestgreen;"></i>
                </a>
                <a onclick="return confirm('Bạn Có Thật Sự Muốn Xóa??')" href="{{URL::to('/delete_category_product/'.$cate_pro->id)}}" class="active" style="font-size:20px;"  ui-toggle-class="">
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