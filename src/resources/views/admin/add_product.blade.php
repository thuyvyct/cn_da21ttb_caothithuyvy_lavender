@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading" style="font-size: 25px;">
                    Thêm Sản Phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action = "{{URL::to('/save_product')}}" method = "post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputStatus">Danh Mục Sản Phẩm</label>
                            <select name = "product_cate" class="form-control m-bot15">
                                @foreach ($cate_product as $key => $cate)
                                <option value = "{{$cate->id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputProduct">Tên Sản Phẩm</label>
                            <input type="text" name = "product_name" class="form-control" id="exampleInputProduct" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô Tả Sản Phẩm</label>
                            <textarea style ="resize: none" rows = "8" name = "product_desc" class="form-control" id="ckeditor" placeholder="Mô tả sản phẩm"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPrice">Giá Sản Phẩm</label>
                            <input type="number" name = "product_price" class="form-control" id="exampleInputPrice" placeholder="Giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputImage">Hình Ảnh Sản Phẩm</label>
                            <input type="file" name = "product_image" class="form-control" id="exampleInputImage">
                            <br>
                            <img id="preview" src="#" alt="Hình ảnh sản phẩm" style="max-width: 200px; max-height: 200px; display: none;"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSize">Kích Cỡ Sản Phẩm</label>
                            <select name = "product_size" class="form-control m-bot15">
                                @foreach ($size_product as $key => $size)
                                <option value = "{{$size->id}}">{{$size->size_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group">
                            <label>Kích cỡ:</label>
                            @foreach($size_product as $key => $size)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="product_size[]" value="{{ $size->id }}"
                                        {{ isset($selected_sizes) && in_array($size->id, $selected_sizes) ? 'checked' : '' }}>
                                    {{ $size->size_name }}
                                </label>
                            </div>
                            @endforeach
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputSize">Màu Sản Phẩm</label>
                            <select name = "product_color" class="form-control m-bot15">
                                @foreach ($color_product as $key => $color)
                                <option value = "{{$color->id}}">{{$color->color_name}}</option>
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
                        <button type="submit" name = "add_product" class="btn btn-info">Thêm</button><br><br>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class = "text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>

                    </form>
                    </div>
                </div>
            </section>
    </div>
    <script>
    function previewImage(event) {
        var preview = document.getElementById('preview');
        var file = event.target.files[0];
        
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "#";
            preview.style.display = 'none';
        }
    }
</script>
@endsection