@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading" style="font-size: 25px;">
                    Cập Nhật Hình Ảnh
                </header>
                <div class="panel-body">
                    @foreach ($edit_image as $key => $img)
                    <div class="position-center">
                        <form role="form" action = "{{URL::to('/save_image')}}" method = "post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputProduct">Tên Hình Ảnh</label>
                            <input type="text" name = "image_name" class="form-control" id="exampleInputProduct" value = "{{$img->image_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputProduct">URL</label>
                            <input type="text" name = "image_path" class="form-control" id="exampleInputProduct" value = "{{$img->image_path}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputProduct">Caption</label>
                            <input type="text" name = "image_caption" class="form-control" id="exampleInputProduct" value = "{{$img->image_caption}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputImage">Hình Ảnh</label>
                            <input type="file" name = "image_img" class="form-control" id="exampleInputImage">
                            <img src="{{URL::to('public/uploads/product/'.$img-> image_img)}}" height="150" width="150">
                        </div>
                        <button type="submit" name = "add_image" class="btn btn-info">Cập Nhật</button><br><br>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class = "text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>

                    </form>
                    </div>
                    @endforeach
                </div>
            </section>
    </div>
@endsection