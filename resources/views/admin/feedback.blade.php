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
    <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
        <select id="an_hien" class="form-select mb-4" aria-label="Default select example" style="height: 50px;"
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
        <div class="sa-layout">
            
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
                                    <!-- <button type="button" data-id="{{ $item->id }}" onclick="toggleForm(this)" style="background-color: white; color: black; border: 2px solid black; border-radius: 10px;">Xem</button> -->
                                    <button type="button" class="btn btn-outline-dark rounded" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                        Xem
                                    </button>
                                    <!-- Form phản hồi -->
                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('danh-gia.update', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Phản hồi đánh giá : ID {{$item->id}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="inputPH{{ $item->id }}">Phản hồi</label>
                                                            <input type="text" name="feedback" class="form-control" id="inputPH{{$item->id}}" placeholder="Vui lòng nhập phản hồi hoặc chọn từ các phản hồi có sẵn" style="margin-bottom: 10px;">
                                                            <select name="" id="selectOption{{$item->id}}" style="width: 100%; height: 35px;" class="form-control">
                                                                <option value="">Chọn câu trả lời có sẵn:</option>
                                                                <option value="">Cảm ơn vì bạn đã mua hàng.</option>
                                                                <option value="">Xin lỗi vì bạn đã có trải nghiệm không tốt. Nếu bạn cần hỗ trợ, vui lòng liên hệ với tôi:</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="id_user{{ $item->id }}">Đánh giá của người dùng</label>
                                                            <textarea class="form-control" id="id_user{{ $item->id }}" name="id_user" rows="2" readonly >{{ $item->noi_dung }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->an_hien == 1)
                                        <form action="{{route('danh-gia.hide', $item->id)}}">
                                            @csrf
                                            <button class="btn btn-outline-danger rounded">Ẩn</button>
                                        </form>
                                    @else
                                        <form action="{{route('danh-gia.show', $item->id)}}">
                                            @csrf
                                            <button class="btn btn-outline-success rounded">Hiện</button>
                                        </form>
                                    @endif
                                </td>
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
</script>
@endsection