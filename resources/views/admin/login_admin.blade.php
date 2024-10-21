<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Đăng nhập cho quản trị -->
<div class="container pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center font-weight-bold" style="font-size: 30px;">Đăng Nhập Quản Trị</div>
                @if(session()->has('thongbao'))
                    <div class="toast show align-items-center text-bg-dark border-0 position-fixed top-3 end-0 p-3" role="alert"
                        aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {!! session('thongbao') !!}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{route('login_admin')}}" method="post">
                        <div class="form-group">
                            <label for="inputEmail">Email của bạn</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control"
                                id="inputEmail" placeholder="Vui lòng nhập địa chỉ email">
                            @error('email')
                                <span class=" text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Mật khẩu</label>
                            <input type="password" name="password" value="{{old('pass')}}" class="form-control"
                                id="password" placeholder="Vui lòng nhập mật khẩu">
                            @error('pass')
                                <span class=" text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-check-label font-weight-bold d-flex justify-content-end"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <u>Quên mật khẩu</u>
                            </label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label font-weight-bold" for="rememberMe" data-toggle="modal"
                                data-target="#exampleModal">Đồng ý với các điều khoản</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-dark" name="submit-signin" value="Đăng Nhập">
                        </div>
                        <div class="form-group">
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End đăng nhập cho quản trị -->