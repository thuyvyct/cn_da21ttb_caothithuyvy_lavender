@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading" style="font-size: 25px;">
                    Thêm Kích Cỡ Sản Phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action = "{{URL::to('/save_size')}}" method = "post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputSize">Tên Kích Cỡ</label>
                            <input type="text" name = "size_name" class="form-control" id="exampleInputSize" placeholder="Tên kích cỡ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô Tả Kích Cỡ</label>
                            <textarea style ="resize: none" rows = "8" name = "size_desc" class="form-control" id="exampleInputDesc" placeholder="Mô tả kích cỡ"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStatus">Trạng Thái</label>
                            <select name = "size_status" class="form-control m-bot15">
                                <option value = "1">Hiển Thị</option>
                                <option value = "0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name = "add_size" class="btn btn-info">Thêm</button><br><br>
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
@endsection