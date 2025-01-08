@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Danh Mục Sản Phẩm
                </header>
                <div class="panel-body">
                    @foreach($edit_category_product as $key => $edit_value)
                    <div class="position-center">
                        <form role="form" action = "{{URL::to('/update_category_product/'.$edit_value->id)}}" method = "post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputCategory">Tên Danh Mục</label>
                            <input type="text" value="{{$edit_value->category_name}}" name = "category_product_name" class="form-control" id="exampleInputCategory">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô Tả Danh Mục</label>
                            <textarea style ="resize: none" rows = "8" name = "category_product_desc" class="form-control" id="exampleInputDesc" >{{$edit_value->category_desc}} </textarea>
                        </div>
                        <button type="submit" name = "update_category_product" class="btn btn-info">Cập Nhật</button><br><br>
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
</div>
@endsection