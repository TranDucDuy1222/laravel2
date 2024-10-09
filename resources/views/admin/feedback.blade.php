@extends('admin.layoutadmin')

@section('title')
Đánh giá
@endsection

@section('content')

<!-- sa-app__body -->
<div id="top" class="sa-app__body">
    <div class="mx-xxl-3 px-4 px-sm-5">
        <div class="py-5">
            <div class="row g-4 align-items-center">
                <div class="col">
                    <h1 class="h3 m-0">Đánh Giá</h1>
                </div>
            </div>
        </div>
    </div>
    <select id="an_hien" class="form-select" aria-label="Default select example" style="height: 50px;"
                    onchange="loctrangthai(this.value)">
                    <option value="0" {{$an_hien == "0" ? "selected" : ""}}>Đã ẩn</option>
                    <option value="1" {{$an_hien == "1" ? "selected" : ""}}>Đang hiện</option>
    </select>

                    <!--Lọc trạng thái bằng JS-->
                    <script>
                    function loctrangthai(trang_thai) {
                        document.location = `/admin/danh-gia?an_hien=${trang_thai}`;
                    }
                </script>

    <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
        <div class="sa-layout">
            <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
            <div class="sa-layout__content">
                <div class="card table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10%;">Khách hàng</th>
                                <th style="width: 8%;">Phân loại</th>
                                <th style="width: 15%;">Chất lượng</th>
                                <th style="width: 25%;">Đánh giá</th>
                                <th style="width: 10%;">Ngày</th>
                                <th style="width: 12%;">Phản hồi</th>
                                <th style="width: 5%;"></th>
                                <th style="width: 5%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showall_review as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <a href="#" class="text-reset">{{$item->name}}</a>
                                            <div class="sa-meta mt-0">
                                                <ul class="sa-meta__list">
                                                    <li class="sa-meta__item">ID:
                                                        <span title="Click to copy product ID" class="st-copy">{{$item->id}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="sa-price">
                                        <span class="sa-price__integer">{{$item->size}} - {{$item->color}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="sa-price">
                                        <span class="sa-price__integer">{{$item->quality_product}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="sa-price">
                                        <span class="sa-price__integer">{{$item->noi_dung}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="sa-price">
                                        <span class="sa-price__integer">{{$item->thoi_diem}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="sa-price">
                                        <span class="sa-price__integer">{{$item->feedback}}</span>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" data-id="{{ $item->id }}" onclick="toggleForm(this)" style="background-color: white; color: black; border: 2px solid black; border-radius: 10px;">Xem</button>
                                </td>
                                <td>
                                    @if ($item->an_hien == 1)
                                        <form action="{{route('danh-gia.hide', $item->id)}}">
                                            @csrf
                                            <button style="background-color: white; color: red; border: 2px solid red; border-radius: 10px;">Ẩn</button>
                                        </form>
                                    @else
                                        <form action="{{route('danh-gia.show', $item->id)}}">
                                            @csrf
                                            <button style="background-color: white; color: green; border: 2px solid green; border-radius: 10px;">Hiện</button>
                                        </form>
                                    @endif
                                </td>
                                <!-- Form phản hồi -->

                                <div id="fph{{$item->id}}" style="display: none;" class="pt-4" >
                                    <div style="display: flex; justify-content: center; align-items: center; height: 250px;">
                                        <div>
                                            <div>
                                                <h5>Phản hồi người mua: {{$item->id}}</h5>
                                            </div>
                                            <form action="{{route('danh-gia.update', $item->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <h8 style="display: block; text-align: center; font-size: larger;">Chuẩn bị thông tin</h8>
                                                    <textarea readonly class="form-control my-2">{{$item->noi_dung}}</textarea>
                                                    <input type="text" name="feedback" class="form-control" id="inputPH{{$item->id}}" placeholder="Vui lòng nhập phản hồi hoặc chọn từ các phản hồi có sẵn" style="margin-bottom: 10px;">
                                                    <select name="" id="selectOption{{$item->id}}" style="width: 100%; height: 35px;">
                                                        <option value="">Chọn câu trả lời có sẵn:</option>
                                                        <option value="">Cảm ơn vì bạn đã mua hàng.</option>
                                                        <option value="">Xin lỗi vì bạn đã có trải nghiệm không tốt. Nếu bạn cần hỗ trợ, vui lòng liên hệ với tôi:</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div style="text-align: center;">
                                                    <input type="submit" name="feedbacks" class="btn btn-outline-secondary" value="Gửi">
                                                    <button type="button" data-id="{{ $item->id }}" class="btn btn-outline-secondary" onclick="toggleForm(this)">
                                                        Đóng
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--Phân trang-->
                    <div class="text-center p-2 d-flex">{{$showall_review->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    // Lấy tất cả các thẻ select
    var selects = document.querySelectorAll('select');

    // Thêm sự kiện cho mỗi thẻ select
    selects.forEach(function(select) {
        select.addEventListener('change', function() {
            // Lấy ID của thẻ select
            var id = this.id.replace('selectOption', '');

            // Tìm thẻ input tương ứng
            var input = document.getElementById('inputPH' + id);

            // Cập nhật giá trị của thẻ input
            if (input) {
                input.value = this.options[this.selectedIndex].innerText;
            }
        });
    });

    // function showForm(madg) {
    //     document.getElementById('fph' + madg).style.display = 'block';
    // }

    // function hideForm(madg) {
    //     document.getElementById('fph' + madg).style.display = 'none';
    // }
    function toggleForm(element) {
        var id_dg = element.getAttribute('data-id');
        var form = document.getElementById('fph' + id_dg);

        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
@endsection