@extends('user.layout')
@section('title')
Đăng Nhập
@endsection

@section('category')
@foreach ($danhmuc as $category)
  <li class="nav-item">
    <a class="nav-link fz" href="/category/{{$category->madm}}">
    {{$category->ten_dm}}
    </a>
  </li>
@endforeach
@endsection

@section('content')
<!-- đăng nhập -->
<div class="container pb-5">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
          role="tab" aria-controls="nav-home" aria-selected="true">Khách Hàng</button>
        <div class="border border-bottom-0 rounded-top">
          <button class="nav-link" id="nav-profile-tab" type="button">
            <a href="{{url('admin/login_admin')}}">
            Quản Trị
            </a>
          </button>
        </div>
        <div class="border border-bottom-0 rounded-top">
          <button class="nav-link" id="nav-profile-tab" type="button">
            <a href="{{url('/login/google')}}">
              Đăng Nhập <i class="fa-brands fa-google fa-beat-fade"></i>
            </a>
          </button>
        </div>
      </div>
      <div class="card">
        <div class="tab-content" id="nav-tabContent">
          <!-- Đăng nhập cho khách hàng -->
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
            tabindex="0">
            <div class="card-header text-center font-weight-bold" style="font-size: 30px;">Đăng Nhập</div>
              @if(Session::exists('thongbao'))
                <h5 class="alert alert-danger text-center"> {{ Session::get('thongbao') }} </h5>
              @endif
            <div class="card-body">
              <form action="{{route('login_form')}}" method="post">
                <div class="form-group">
                  <label for="inputEmail">Email của bạn</label>
                  <input type="email" name="email" value="{{old('email')}}" class="form-control" id="inputEmail"
                    placeholder="Vui lòng nhập địa chỉ email">
                  @error('email')
                    <span class=" text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="inputPassword">Mật khẩu</label>
                  <input type="password" name="pass" value="{{old('pass')}}" class="form-control" id="password"
                    placeholder="Vui lòng nhập mật khẩu">
                  @error('pass')
                    <span class=" text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-check-label font-weight-bold d-flex justify-content-end" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
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
          <!-- End đăng nhập cho khách hàng -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Quên mật khẩu -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Quên Mật Khẩu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="inputEmail">Email của bạn</label>
            <input type="email" name="email" class="form-control" id="inputEmail"
              placeholder="Vui lòng nhập email của bạn">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="submit-forget" class="btn btn-outline-secondary" value="Gửi Yêu Cầu">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Our terms</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="letter-spacing: 1px;">
        Tại Trang web Nike, chúng tôi cam kết mang lại trải nghiệm mua sắm trực tuyến tốt nhất cho khách hàng. Để đảm
        bảo hành trình mua sắm liền mạch, chúng tôi đã nêu ra những nguyên tắc cần thiết dành cho khách hàng khi mua
        hàng:

        Chất lượng sản phẩm:
        Chúng tôi đảm bảo với bạn rằng tất cả giày Nike của chúng tôi đều là chính hãng và được sản xuất với tiêu chuẩn
        chất lượng cao nhất. Mỗi danh sách sản phẩm bao gồm thông tin chi tiết, cho phép bạn hiểu các tính năng và chất
        liệu độc đáo được sử dụng trong giày dép.

        Giá cả và thanh toán:
        Giá được liệt kê trên trang web của chúng tôi phản ánh giá gốc của sản phẩm và không bao gồm phí vận chuyển hoặc
        thuế hiện hành. Quá trình thanh toán sẽ được hướng dẫn trong quá trình thanh toán.

        Vận chuyển và giao hàng:
        Chúng tôi cung cấp các tùy chọn vận chuyển khác nhau để phục vụ cho nhu cầu cụ thể của bạn. Thời gian giao hàng
        có thể thay đổi tùy theo địa chỉ giao hàng của bạn và phương thức giao hàng đã chọn.

        Chính sách hoàn trả:
        Chúng tôi chấp nhận trả lại trong vòng 30 ngày kể từ ngày mua. Để đủ điều kiện được trả lại, sản phẩm phải ở
        tình trạng ban đầu và kèm theo hóa đơn mua hàng.

        Quyền riêng tư và bảo mật dữ liệu:
        Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn. Chúng tôi chỉ sử dụng dữ liệu của bạn để xử lý đơn hàng và
        sẽ không tiết lộ dữ liệu đó cho bất kỳ bên thứ ba nào.

        Hỗ trợ khách hàng:
        Nhóm hỗ trợ khách hàng của chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc mà bạn có thể có. Bạn có thể liên hệ
        với chúng tôi qua số điện thoại hoặc email được cung cấp trên trang web của chúng tôi.

        Khuyến mãi và ưu đãi đặc biệt:
        Chúng tôi thường xuyên cung cấp các chương trình khuyến mãi độc quyền và ưu đãi đặc biệt cho khách hàng của
        mình. Hãy theo dõi trang web của chúng tôi để tận dụng những cơ hội này.

        Chúng tôi hy vọng bạn có trải nghiệm mua sắm thú vị tại Cửa hàng giày Nike. Vui lòng liên hệ nếu bạn cần hỗ trợ
        thêm hoặc có bất kỳ câu hỏi nào. Chúng tôi chân thành cảm ơn sự tin tưởng và lựa chọn của bạn đối với sản phẩm
        của chúng tôi.
      </div>
    </div>
  </div>
</div>

@endsection