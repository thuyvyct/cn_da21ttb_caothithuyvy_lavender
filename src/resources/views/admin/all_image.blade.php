@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Hình Ảnh
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
              <th>Tên Ảnh</th>
              <th>URL</th>
              <th>Caption</th>
              <th>Hình Ảnh</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_image as $key => $image)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td style="font-size:16px">{{$image -> image_name}}</td>
                <td style="font-size:16px">{{$image -> image_path}}</td>
                <td style="font-size:16px">{{$image -> image_caption}}</td>
                <td style="font-size:16px"><img src="public/uploads/product/{{$image -> image_img}}" height="100"; width="100"></td>
              <td><span class="text-ellipsis">
              </span></td>
              <td>
                <a href= "{{URL::to('/edit_image/'.$image->id)}}" class="active" style="font-size:20px;" ui-toggle-class="">
                  <i class="fa-solid fa-pen-to-square" style="color:forestgreen;"></i>
                </a><br>
                <a onclick="return confirm('Bạn Có Thật Sự Muốn Xóa??')" href="{{URL::to('/delete_image/'.$image->id)}}" class="active" style="font-size:20px;"  ui-toggle-class="">
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