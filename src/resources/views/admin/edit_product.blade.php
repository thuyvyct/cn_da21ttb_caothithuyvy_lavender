@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading" style="font-size: 25px;">
                    Cập Nhật Sản Phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($edit_product as $key => $pro)
                        <form role="form" action = "{{URL::to('/update_product/'.$pro->product_id)}}" method = "post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputStatus">Danh Mục Sản Phẩm</label>
                            <select name = "product_cate" class="form-control m-bot15">
                                @foreach ($cate_product as $key => $cate)
                                @if ($cate->id == $pro->category_id)
                                <option selected value = "{{$cate->id}}">{{$cate->category_name}}</option>
                                @else
                                <option value = "{{$cate->id}}">{{$cate->category_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputProduct">Tên Sản Phẩm</label>
                            <input type="text" name = "product_name" class="form-control" id="exampleInputProduct" value = "{{$pro->product_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô Tả Sản Phẩm</label>
                            <textarea style ="resize: none" rows = "8" name = "product_desc" class="form-control" id="ckeditor">{{$pro->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPrice">Giá Sản Phẩm</label>
                            <input type="number" name = "product_price" class="form-control" id="exampleInputPrice" value = "{{$pro->product_price}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputImage">Hình Ảnh Sản Phẩm</label>
                            <input type="file" name = "product_image" class="form-control" id="exampleInputImage">
                            <img src="{{URL::to('public/uploads/product/'.$pro -> product_image)}}" height="150" width="150">
                        </div>
                        <div class="form-group">
                            <label>Kích cỡ:</label>
                            @foreach($size_product as $size)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="product_size[]" value="{{ $size->id }}"
                                        {{ isset($selected_sizes) && in_array($size->id, $selected_sizes) ? 'checked' : '' }}>
                                    {{ $size->size_name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="exampleInputColor">Màu Sắc Sản Phẩm</label>
                            <select name = "product_color" class="form-control m-bot15">
                                @foreach ($color_product as $key => $color)
                                @if ($color->id == $pro->product_color)
                                <option selected value = "{{$color->id}}">{{$color->color_name}}</option>
                                @else
                                <option value = "{{$color->id}}">{{$color->color_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStatus">Trạng Thái</label>
                            <select name = "product_status" class="form-control m-bot15">
                                <option value = "1">Hiển Thị</option>
                                <option value = "0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name = "add_product" class="btn btn-info">Cập Nhật</button><br><br>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class = "text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>

                    </form>
                        @endforeach
                    </div>
                </div>
            </section>

</div>
@endsection