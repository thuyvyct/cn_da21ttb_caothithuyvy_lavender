@extends('welcome')
@section('content')
<div class="container">
    <div class="row">
        <div class="container col-sm-9" style="margin-top: 20px;" >
            <h2>Liên hệ với chúng tôi</h2>
            <p>Hãy để lại thông tin và chúng tôi sẽ phản hồi sớm nhất có thể.</p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/contact') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="message">Nội dung:</label>
                    <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
</div>
@endsection

