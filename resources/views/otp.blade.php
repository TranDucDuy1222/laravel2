@extends('user.layout')
@section('title')
    Nhập mã OTP
@endsection
@section('category')
    @foreach ($loai as $category)
        <li class="nav-item dropdown">
            <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                href="{{ route('loai-san-pham', $category->slug) }}">
                {{$category->ten_loai}}
            </a>
            <ul class="dropdown-menu" id="userDropdown">
                @foreach ($danh_muc as $dm)
                    @if ($dm->id_loai == $category->id)
                        <li class="hover-dm"><a class="dropdown-item" href="{{ route('danh-muc-san-pham', $dm->slug)}}">{{$dm->ten_dm}}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
@endsection
@section('content')
<div class="app-content">
    <div class="py-5">
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">
                                <a href="{{ url('/') }}">Trang chủ</a>
                            </li>
                            <li class="is-marked">
                                <a href="{{ route('password.request') }}">Xác nhận mã OTP</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-5">
        <div class="section__intro mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">XÁC NHẬN MÃ OTP</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="container">
                <div class="row row--center">
                    <div class="col-lg-6 col-md-8 mb-3">
                        <div class="l-f-o border">
                            <div class="l-f-o__pad-box">
                                <span class="gl-text mb-4 text-center text-dark">Nhập mã OTP gồm 6 chữ số đã gửi đến email của bạn.</span>
                                <form class="l-f-o__form" method="POST" action="{{ route('verify.otp') }}">
                                    @csrf
                                    <div class="otp-inputs mb-4">
                                        <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(event, 1)" required>
                                        <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(event, 2)" required>
                                        <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(event, 3)" required>
                                        <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(event, 4)" required>
                                        <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(event, 5)" required>
                                        <input type="text" name="otp[]" maxlength="1" oninput="moveFocus(event, 6)" required>
                                    </div>
                                    <input type="hidden" name="email" value="{{ session('email') }}">
                                    @if (session('expires_at'))
                                        <div class="section__text-wrap">
                                            <p class="gl-link">Mã OTP sẽ hết hạn sau: <span class="text-danger" id="otp-timer"></span>.</p>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const expiresAt = @json(session('expires_at'));

                                                if (expiresAt) {
                                                    const expiresAtTime = new Date(expiresAt).getTime();

                                                    // Hàm cập nhật đếm ngược
                                                    function updateTimer() {
                                                        const now = new Date().getTime();
                                                        const distance = expiresAtTime - now;

                                                        if (distance <= 0) {
                                                            document.getElementById('otp-timer').textContent = "Mã OTP đã hết hạn!";
                                                            clearInterval(timer);
                                                        } else {
                                                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                            document.getElementById('otp-timer').textContent = `${minutes} phút ${seconds} giây`;
                                                        }
                                                    }

                                                    // Cập nhật đếm ngược mỗi giây
                                                    const timer = setInterval(updateTimer, 1000);
                                                    updateTimer();
                                                } else {
                                                    document.getElementById('otp-timer').textContent = "Không có thời gian hết hạn!";
                                                }
                                            });
                                        </script>
                                    @endif

                                    <div class="mb-3">
                                        <button type="submit" class="l-f-o__create-link btn btn--e-brand-b-2">Xác nhận</button>
                                    </div>
                                </form>
                                <div class="row my-3">
                                    <div class="col-lg-12">
                                        <div class="section__text-wrap">
                                            <form action="{{ route('resendOtp') }}" method="POST">
                                                @csrf
                                                <p class="gl-link">Chưa nhận được mã? <button type="submit" class="text-danger btn gl-link p-0">Gửi lại</button></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function moveFocus(event, nextIndex) {
        const inputs = document.querySelectorAll('.otp-inputs input');
        const currentInput = event.target;

        // Chuyển sang ô tiếp theo khi nhập
        if (currentInput.value.length === 1 && nextIndex < inputs.length) {
            inputs[nextIndex].focus();
        }

        // Quay lại ô trước nếu xóa
        if (event.inputType === 'deleteContentBackward' && currentInput.value.length === 0 && nextIndex - 2 >= 0) {
            inputs[nextIndex - 2].focus();
        }
    }
</script>
@endsection