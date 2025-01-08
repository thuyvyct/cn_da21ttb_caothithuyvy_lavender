@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Kích Cỡ Sản Phẩm
                </header>
                <div class="panel-body">
                    @foreach($edit_size as $key => $edit_value)
                    <div class="position-center">
                        <form role="form" action = "{{URL::to('/update_size/'.$edit_value->id)}}" method = "post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputSize">Tên Kích Cỡ</label>
                            <input type="text" value="{{$edit_value->size_name}}" name = "size_name" class="form-control" id="exampleInputSize">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô Tả Kích Cỡ</label>
                            <textarea style ="resize: none" rows = "8" name = "size_desc" class="form-control" id="exampleInputDesc" >{{$edit_value->size_desc}} </textarea>
                        </div>
                        <button type="submit" name = "update_size" class="btn btn-info">Cập Nhật</button><br><br>
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