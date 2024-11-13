@extends('admin.layoutadmin')
@section('title')
Thống Kê
@endsection

@section('content')
<div id="top" class="sa-app__body px-2 px-lg-4 my-3">
    <main>
        <div class="row my-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
                    <div class="info">
                        <h4>Tổng khách hàng</h4>
                        <p><b>{{$user_quantity}}</b></p>
                        <p class="info-tong">Tổng số khách hàng được quản lý.</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-small info coloured-icon"><i class='icon bx bxs-data fa-3x'></i>
                    <div class="info">
                        <h4>Tổng sản phẩm</h4>
                        <p><b>{{$product_quantity}} sản phẩm</b></p>
                        <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
                    <div class="info">
                        <h4>Tổng đơn hàng</h4>
                        <p><b>{{$order_quantity}} đơn hàng</b></p>
                        <p class="info-tong">Tổng số hóa đơn bán hàng trong tháng.</p>
                    </div>
                    </div>
                </div>
                <!-- <div class="col-md-3">
                    <div class="widget-small danger coloured-icon"><i class='icon bx bxs-error-alt fa-3x'></i>
                    <div class="info">
                        <h4>Sắp hết hàng</h4>
                        <p><b>4 sản phẩm</b></p>
                        <p class="info-tong">Số sản phẩm cảnh báo hết cần nhập thêm.</p>
                    </div>
                    </div>
                </div> -->
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="row">   
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Đơn hàng gần đây</h3>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
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
                                            {{number_format($dh->tong_dh, 0, ',' , '.' )}} đ
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ ($dh->trang_thai == 0) ? 'warning' : (
                                                                            ($dh->trang_thai == 1) ? 'info' : (
                                                                            ($dh->trang_thai == 2) ? 'secondary text-black' : (
                                                                            ($dh->trang_thai == 3) ? 'success' : 'danger'))) }}">
                                                    {{ ($dh->trang_thai == 0) ? 'Chờ xử lý' : (
                                                                            ($dh->trang_thai == 1) ? 'Đã xử lý' : (
                                                                            ($dh->trang_thai == 2) ? 'Đã giao cho đơn vị vận chuyển' : (
                                                                            ($dh->trang_thai == 3) ? 'Giao hàng thành công' : 'Đã hủy'))) }}
                                                </span>
                                            </td>
                                        </tr>   
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Khách hàng mới</h3>
                            <div>
                                <table class="table  table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên khách hàng</th>
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
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Thống kê doanh thu</h3>
                            <form action="{{ url('/admin/test') }}" method="GET" id="filterForm">
                                <div class="row g-3 align-items-center mb-5 ">
                                    <div class="col-auto">
                                        <select class="form-select" name="filter" onchange="document.getElementById('filterForm').submit()">
                                            <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Theo tháng</option>
                                            <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Theo năm</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" name="year" onchange="document.getElementById('filterForm').submit()">
                                            @foreach(range(now()->year - 5, now()->year + 5) as $y) <!-- 5 năm trước và sau -->
                                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>Năm {{ $y }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" name="month" onchange="document.getElementById('filterForm').submit()" {{ $filter != 'week' ? 'disabled' : '' }}>
                                            @foreach(range(1, 12) as $m)
                                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>Tháng {{ $m }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="embed-responsive embed-responsive-16by9">
                                <canvas class="embed-responsive-item" id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    const labels = {!! json_encode($data->pluck($filter == 'day' ? 'date' : ($filter == 'week' ? 'week' : 'month'))) !!};
    const data = {
        labels: labels,
        datasets: [{
            label: 'Doanh thu theo ' + @json($filter == 'day' ? 'Ngày' : ($filter == 'week' ? 'Tháng' : 'Năm')),
            data: {!! json_encode($data->pluck('revenue')) !!},
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
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


@endsection