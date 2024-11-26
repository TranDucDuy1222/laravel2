@extends('admin.layoutadmin')
@section('title')
Thống Kê
@endsection
@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row content-body">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-end">
                        <div class="iq-header-title">
                            <form action="{{ url('/admin') }}" method="GET">
                                <div class="row g-3 align-items-center mt-2 mb-4">
                                    <!-- Bộ lọc chọn loại -->
                                    <div class="col-auto">
                                        <select class="form-select" name="filter" id="filter" onchange="updateFilterFields()">
                                            <option value="day" {{ request('filter') == 'day' ? 'selected' : '' }}>Ngày</option>
                                            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Tháng</option>
                                            <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>Năm</option>
                                        </select>
                                    </div>

                                    <!-- Bộ lọc ngày -->
                                    <div class="col-auto" id="filter-day" style="display: none;">
                                        <input type="date" name="filter_date" id="filter-date" class="form-control" value="{{ request('filter_date') }}">
                                    </div>

                                    <!-- Bộ lọc tháng -->
                                    <div class="col-auto" id="filter-month" style="display: none;">
                                        <input type="month" name="filter_month" id="filter-month-input" class="form-control" value="{{ request('filter_month') }}">
                                    </div>

                                    <!-- Bộ lọc năm -->
                                    <div class="col-auto" id="filter-year" style="display: none;">
                                        <input type="number" name="filter_year" id="filter-year-input" class="form-control" value="{{ request('filter_year') }}" placeholder="VD: 2024">
                                    </div>

                                    <!-- Nút Lọc -->
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Lọc</button>
                                        <a href="{{ url('/admin') }}" class="btn btn-secondary">Xóa lọc</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="iq-card-body row" >
                        <div class="col-3">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-card-body">
                                    <div class="row m-1 row m-1 pb-2 border-bottom">
                                        <div class="icon iq-icon-box iq-bg-primary rounded col-2">
                                            <i class="fa-solid fa-person"></i>
                                        </div>
                                        <div class="col-8">
                                            <h4 class="text-black">Khách hàng</h4>
                                            <h5 class="d-flex text-primary">{{$newCustomers}}</h5>
                                        </div>
                                    </div>
                                    <h8>Tổng số Khách hàng mới</h8>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-card-body">
                                    <div class="row m-1 pb-2 border-bottom">
                                        <div class="icon iq-icon-box iq-bg-danger rounded col-2">
                                            <i class="fa-solid fa-person"></i>
                                        </div>
                                        <div class="col-8">
                                            <h4 class="text-black">Đơn hàng</h4>
                                            <h5 class="d-flex text-danger">{{$orderCount}}</h5>
                                        </div>
                                    </div>
                                    <h8>Tổng số đơn hàng bán được</h8>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-card-body">
                                    <div class="row m-1 row m-1 pb-2 border-bottom">
                                        <div class="icon iq-icon-box iq-bg-primary rounded col-2">
                                            <i class="fa-solid fa-person"></i>
                                        </div>
                                        <div class="col-8">
                                            <h4 class="text-black">Doanh thu</h4>
                                            <h5 class="d-flex text-primary">{{number_format($totalRevenue, 0, ',' , '.' )}} VND</h5>
                                        </div>
                                    </div>
                                    <h8>Tổng số doanh thu</h8>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-card-body">
                                    <div class="row m-1 pb-2 border-bottom">
                                        <div class="icon iq-icon-box iq-bg-danger rounded col-2">
                                            <i class="fa-solid fa-person"></i>
                                        </div>
                                        <div class="col-8">
                                            <h4 class="text-black">Bán Được</h4>
                                            <h5 class="d-flex text-danger">{{$totalProductsSold}} sản phẩm</h5>
                                        </div>
                                    </div>
                                    <h8>Tổng sản phẩm bán được</h8>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Thống kê doanh thu</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <form action="{{ url('/admin') }}" method="GET">
                                <div class="row g-3 align-items-center mt-2 mb-4">
                                    <div class="col-auto">
                                        <select class="form-select" name="filter" id="filter" onchange="this.form.submit()">
                                            <option value="day" {{ request('filter') == 'day' ? 'selected' : '' }}>Ngày trong tháng</option>
                                            <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Tuần trong tháng</option>
                                            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Tháng trong năm</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" name="year" id="year" onchange="this.form.submit()">
                                            @for ($i = now()->year; $i >= 2020; $i--)
                                                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" name="month" id="month" onchange="this.form.submit()" {{ $filter == 'month' ? 'disabled' : '' }}>
                                            @foreach(range(1, 12) as $monthNum)
                                                <option value="{{ $monthNum }}" {{ request('month') == $monthNum ? 'selected' : '' }}>
                                                    {{ \Carbon\Carbon::createFromFormat('m', $monthNum)->format('F') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="iq-card-body" >
                        <canvas class="embed-responsive-item" style="max-height: 250px;" id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Số lượng đơn hàng theo trạng thái</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <canvas class="embed-responsive-item" style="max-height: 250px;" id="orderStatusChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Đơn hàng gần đây</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{url('admin/san-pham')}}" class="btn btn-outline-secondary"><i class="fa-regular fa-eye m-0 p-0"></i></a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                <thead class="shadow-sm sticky-top z-1 bg-white text-center">
                                    <tr>
                                        <th>ID đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dsDH as $dh)
                                    <tr>
                                        <td>{{$dh->id}}</td>
                                        <td>{{$dh->name}}</td>
                                        <td>
                                        {{number_format($dh->tong_dh, 0, ',' , '.' )}} VND
                                        </td>
                                        <td>
                                            <div class="">
                                                @if ($dh->trang_thai == 0)
                                                <span class="btn bg-warning">Chờ xử lý</span>
                                                @elseif ($dh->trang_thai == 1)
                                                <span class="btn bg-primary">Đã xác nhận đơn hàng</span>
                                                @elseif ($dh->trang_thai == 2)
                                                <span class="btn bg-info">Đã giao cho đơn vị vận chuyển</span>
                                                @elseif ($dh->trang_thai == 3)
                                                <span class="btn bg-success">Đã giao thành công</span>
                                                @elseif ($dh->trang_thai == 4)
                                                <span class="btn bg-dark">Đã đánh giá sản phẩm</span>
                                                @elseif ($dh->trang_thai == 5)
                                                <span class="btn bg-danger">Đã hủy</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Khách hàng mới</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{url('admin/tai-khoan')}}" class="btn btn-outline-secondary"><i class="fa-regular fa-eye m-0 p-0"></i></a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                <thead class="shadow-sm sticky-top z-1 bg-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Ngày tham gia</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dsKH as $kh)
                                    <tr>
                                        <td>#{{$kh->id}}</td>
                                        <td>{{$kh->name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($kh->created_at)->format('H:i d/m/Y') }}</td>
                                        <td><span class="tag tag-success">{{$kh->email}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Đánh giá mới nhất</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{url('admin/danh-gia')}}" class="btn btn-outline-secondary"><i class="fa-regular fa-eye m-0 p-0"></i></a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table id="recent-reviews-table" class="table table-striped table-bordered mt-4">
                                <thead class="shadow-sm sticky-top z-1 bg-white text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên khách hàng</th>
                                        <th>Sản phẩm</th>
                                        <th>Đánh giá</th>
                                        <th>Sao</th>
                                        <th>Thời điểm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dsDG as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->ten_khach_hang }}</td>
                                        <td>{{ $review->ten_sp }}</td>
                                        <td>{{ $review->noi_dung }}</td>
                                        <td class="text-center">
                                            {{-- Chuyển đổi quality_product thành số nguyên và tạo sao đánh giá --}}
                                            {{ str_repeat('★', intval($review->quality_product)) }}
                                            {{ str_repeat('☆', 5 - intval($review->quality_product)) }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($review->thoi_diem)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Sản phẩm sắp hết hàng</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{url('admin/san-pham?trangthai=1')}}" class="btn btn-outline-secondary"><i class="fa-regular fa-eye m-0 p-0"></i></a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table id="low-stock-products-table" class="table table-striped table-bordered mt-4">
                                <thead class="shadow-sm sticky-top z-1 bg-white text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Tổng số lượng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dsSP as $sp)
                                        <tr>
                                            <td>{{ $sp->id }}</td>
                                            <td class="text-center">
                                                <img class="rounded img-fluid avatar-70" src="{{ asset('/uploads/product/' . $sp->hinh) }}" onerror="this.src='/imgnew/{{$sp->hinh}}'" alt="">
                                            </td>
                                            <td>{{ $sp->ten_sp }}</td>
                                            <td class="text-center">
                                                <!-- Tính tổng số lượng của tất cả các size của sản phẩm -->
                                                @php
                                                    $totalQuantity = DB::table('sizes')
                                                        ->where('id_product', $sp->id)
                                                        ->sum('so_luong');
                                                @endphp
                                                <span>{{ $totalQuantity }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$sp->id}}">
                                                        Xem chi tiết
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Lọc tổng quát -->
<script>
    function updateFilterFields() {
        // Lấy giá trị của bộ lọc
        const filterType = document.getElementById('filter').value;

        // Ẩn tất cả các ô lọc
        document.getElementById('filter-day').style.display = 'none';
        document.getElementById('filter-month').style.display = 'none';
        document.getElementById('filter-year').style.display = 'none';

        // Hiển thị ô lọc phù hợp
        if (filterType === 'day') {
            document.getElementById('filter-day').style.display = 'block';
        } else if (filterType === 'month') {
            document.getElementById('filter-month').style.display = 'block';
        } else if (filterType === 'year') {
            document.getElementById('filter-year').style.display = 'block';
        }
    }

    // Khởi tạo hiển thị khi tải trang
    updateFilterFields();
</script>

<!-- Modal xem chi tiết -->
@foreach($dsSP as $sp)
    <div class="modal fade" id="exampleModalCenter{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{$sp->id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle{{$sp->id}}">Chi tiết sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion-body text-black">
                        <div class="row">
                            <div class="col-6">
                                <img class="rounded img-fluid avatar-70" src="{{ asset('/uploads/product/' . $sp->hinh) }}" onerror="this.src='/imgnew/{{$sp->hinh}}'" alt="">
                            </div>
                            <div class="col-6">
                                <div class="danh-muc">
                                    <label for="" class="fw-semibold">{{$sp -> ten_sp}}</label>
                                </div>
                                <div class="danh-muc">
                                    <label for="">Danh mục: {{$sp -> ten_dm}}</label>
                                </div>
                                <div class="mau">
                                    <label for="">Màu: {{$sp -> color}}</label>
                                </div>
                                <div class="gia">
                                    <label for="">Giá: <span class="text-bg-dark">{{number_format($sp->gia, 0, ',' , '.' )}} đ</span></label>
                                </div>
                                <div class="gia-km">
                                    <label for="">Giá khuyến mãi: <span class="text-danger">{{number_format($sp->gia_km, 0, ',' , '.' )}} đ</span></label>
                                </div>
                                <div class="trang-thai">
                                    <label for="">Trạng thái:
                                        @if ($sp->trang_thai == 0) Còn hàng
                                        @elseif ($sp->trang_thai == 1) Sắp hết hàng
                                        @elseif ($sp->trang_thai == 2) Ngừng kinh doanh
                                        @elseif ($sp->trang_thai == 3) Sắp về hàng
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-semibold">Mô tả ngắn:</label>
                                <div class="motangan">
                                    {{$sp -> mo_ta_ngan}}
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-semibold">Kích thước và số lượng sắp hết:</label>
                                <div class="size_soluong">
                                    @foreach ($sp->sizes as $size)  <!-- Duyệt qua các size của sản phẩm -->
                                        @if ($size->so_luong < 10)  <!-- Chỉ hiển thị các size có số lượng nhỏ hơn 5 -->
                                            <button class="btn btn-outline-dark mb-1">
                                                {{$size->size_product}} : {{$size->so_luong}}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a id="continueButton" href="{{route('san-pham.edit', $sp->id)}}">
                        <button type="button" class="btn btn-primary">Chỉnh sửa <i class="fa-solid fa-arrow-right fa-beat"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Biểu đồ doanh thu -->
<script>
    const labels = {!! json_encode($filter == 'day' ? $data->pluck('day') : ($filter == 'week' ? $data->pluck('week') : $data->pluck('month'))) !!};
    
    const data = {
        labels: labels,
        datasets: [{
            label: 'Doanh thu theo ' + @json($filter == 'day' ? 'Ngày' : ($filter == 'week' ? 'Tuần' : 'Tháng')),
            data: {!! json_encode($data->pluck('revenue')) !!},
            backgroundColor: 'rgba(150, 75, 88, 0.5)',
            borderColor: 'rgba(150, 75, 88, 0.5)',
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const revenueChart = new Chart(
        document.getElementById('revenueChart'),
        config
    );
</script>
<!-- Biểu đồ trạng thái -->
<script>
    const ctx = document.getElementById('orderStatusChart');
    const orderStatusData = {!! json_encode($orderStatusData) !!};

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: orderStatusData.map(data => {
                switch(data.trang_thai) {
                    case 0: return 'Chờ xử lý';
                    case 1: return 'Đã xác nhận đơn hàng';
                    case 2: return 'Đã giao cho đơn vị vận chuyển';
                    case 3: return 'Đã giao thành công';
                    case 4: return 'Đã đánh giá sản phẩm';
                    case 5: return 'Đã hủy';
                    default: return 'Khác';
                }
            }),
            datasets: [{
                data: orderStatusData.map(data => data.count),
                backgroundColor: ['#ffc107', '#0d6efd', '#0dcaf0', '#198754', '#212529', '#dc3545' ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });
</script>

@endsection