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
                        <p><b>56 khách hàng</b></p>
                        <p class="info-tong">Tổng số khách hàng được quản lý.</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-small info coloured-icon"><i class='icon bx bxs-data fa-3x'></i>
                    <div class="info">
                        <h4>Tổng sản phẩm</h4>
                        <p><b>1850 sản phẩm</b></p>
                        <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
                    <div class="info">
                        <h4>Tổng đơn hàng</h4>
                        <p><b>247 đơn hàng</b></p>
                        <p class="info-tong">Tổng số hóa đơn bán hàng trong tháng.</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-small danger coloured-icon"><i class='icon bx bxs-error-alt fa-3x'></i>
                    <div class="info">
                        <h4>Sắp hết hàng</h4>
                        <p><b>4 sản phẩm</b></p>
                        <p class="info-tong">Số sản phẩm cảnh báo hết cần nhập thêm.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="row">   
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Tình trạng đơn hàng</h3>
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
                                        <tr>
                                            <td>AL3947</td>
                                            <td>Phạm Thị Ngọc</td>
                                            <td>
                                                19.770.000 đ
                                            </td>
                                            <td><span class="badge bg-info">Chờ xử lý</span></td>
                                        </tr>
                                        <tr>
                                            <td>ER3835</td>
                                            <td>Nguyễn Thị Mỹ Yến</td>
                                            <td>
                                                16.770.000 đ	
                                            </td>
                                            <td><span class="badge bg-warning">Đang vận chuyển</span></td>
                                        </tr>
                                        <tr>
                                            <td>MD0837</td>
                                            <td>Triệu Thanh Phú</td>
                                            <td>
                                                9.400.000 đ	
                                            </td>
                                            <td><span class="badge bg-success">Đã hoàn thành</span></td>
                                        </tr>
                                        <tr>
                                            <td>MT9835</td>
                                            <td>Đặng Hoàng Phúc	</td>
                                            <td>
                                                40.650.000 đ	
                                            </td>
                                            <td><span class="badge bg-danger border-0">Đã hủy</span></td>
                                        </tr>
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
                                            <th>Ngày sinh</th>
                                            <th>Số điện thoại</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#183</td>
                                            <td>Hột vịt muối</td>
                                            <td>21/7/1992</td>
                                            <td><span class="tag tag-success">0921387221</span></td>
                                        </tr>
                                        <tr>
                                            <td>#219</td>
                                            <td>Bánh tráng trộn</td>
                                            <td>30/4/1975</td>
                                            <td><span class="tag tag-warning">0912376352</span></td>
                                        </tr>
                                        <tr>
                                            <td>#627</td>
                                            <td>Cút rang bơ</td>
                                            <td>12/3/1999</td>
                                            <td><span class="tag tag-primary">01287326654</span></td>
                                        </tr>
                                        <tr>
                                            <td>#175</td>
                                            <td>Hủ tiếu nam vang</td>
                                            <td>4/12/20000</td>
                                            <td><span class="tag tag-danger">0912376763</span></td>
                                        </tr>
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