@extends('admin.layoutadmin')
@section('title')
Thống Kê
@endsection
@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row content-body">
            <div class="col-lg-12 row m-0 p-0">
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body d-flex">
                            <div class="icon iq-icon-box iq-bg-primary rounded">
                                <i class="fa-solid fa-person"></i>
                            </div>
                            <div>
                                <h5 class="text-black">khách hàng</h5>
                                <h3 class="d-flex text-primary">{{$user_quantity}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body d-flex">
                        <div class="icon iq-icon-box iq-bg-danger rounded" data-wow-delay="0.2s">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        <div>
                            <h5 class="text-black">Sản phẩm</h5>
                            <h3 class="d-flex text-danger">{{$product_quantity}}</h3>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body d-flex">
                            <div class="icon iq-icon-box iq-bg-primary rounded" data-wow-delay="0.2s">
                                <i class="sa-nav__icon fa-solid fa-cart-shopping"></i>
                            </div>
                            <div>
                                <h5 class="text-black">Đơn hàng</h5>
                                <h3 class="d-flex text-primary">{{$order_quantity}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body d-flex">
                            <div class="icon iq-icon-box iq-bg-danger rounded" data-wow-delay="0.2s">
                                <i class='sa-nav__icon fa-solid fa-comment'></i>
                            </div>
                            <div>
                                <h5 class="text-black">Đánh giá</h5>
                                <h3 class="d-flex text-danger">{{$review_quantity}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Thống kê doanh thu</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <form action="{{ url('/admin') }}" method="GET" id="filterForm">
                            <div class="row g-3 align-items-center mt-2 mb-4">
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
                    </div>
                </div>
                <div class="iq-card-body" >
                    <canvas class="embed-responsive-item" style="max-height: 250px;" id="revenueChart"></canvas>
                </div>
                </div>
            </div>
            <!-- <div class="col-lg-5">
                <div class="iq-card bg-danger iq-card-block iq-card-stretch iq-card-height-half">
                <div class="iq-card-body box iq-box-relative">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="col-7 p-0">
                            <div class="float-left progress-round income-progress mr-3" data-value="80">
                            <span class="progress-left">
                            <span class="progress-bar border-white" style="transform: rotate(108deg);"></span>
                            </span>
                            <span class="progress-right">
                            <span class="progress-bar border-white" style="transform: rotate(180deg);"></span>
                            </span>
                            <div class="progress-value w-100 h-100 rounded d-flex align-items-center justify-content-center text-center">
                                <div class="h4 mb-0">75</div>
                            </div>
                            </div>
                            <h5 class="d-block mt-2 text-white font-weight-500">Storage<br> Usage</h5>
                        </div>
                        <div class="col-5 pr-0 right-border-block position-relative">
                            <h5 class="text-white mt-2">594875625</h5>
                            <span class="text-white">Online Users</span>
                        </div>
                    </div>
                </div>
                </div>
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height-half iq-background-image">
                <div class="iq-card-body box iq-box-relative rounded">
                    <div class="d-flex justify-content-between align-items-left">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="float-left progress-round income-progress" data-value="80">
                            <span class="progress-left">
                            <span class="progress-bar border-primary" style="transform: rotate(108deg);"></span>
                            </span>
                            <span class="progress-right">
                            <span class="progress-bar border-success" style="transform: rotate(180deg);"></span>
                            </span>
                            </div>
                            <div class="pl-3">
                            <ul class="float-right d-inline-block p-0 m-0 list-inline">
                                <li class="line-height-3">
                                    <span class="text-danger total-progress position-relative pl-2">
                                    <span class="bg-danger rounded"></span>Total Processes: 61<i class="ri-arrow-up-line"></i>
                                    </span>
                                </li>
                                <li class="line-height-3">
                                    <span class="text-primary total-progress position-relative pl-2">
                                    <span class="bg-primary rounded"></span>Total Threands: 993<i class="ri-arrow-down-line"></i>
                                    </span>
                                </li>
                                <li class="line-height-3">
                                    <span class="text-success total-progress position-relative pl-2">
                                    <span class="bg-success rounded"></span>Total Handles: 26957<i class="ri-arrow-up-line"></i>
                                    </span>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-7">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Bandwidth Public</h4>
                    </div>
                    <div class="mt-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void();" class="d-flex align-items-center mr-4">
                            <span class="bg-danger p-1 rounded mr-2"></span>
                            <p class="text-danger mb-0">Lowest Speed </p>
                            </a>
                            <a href="javascript:void();" class="d-flex align-items-center">
                            <span class="bg-primary p-1 rounded mr-2"></span>
                            <p class="text-primary mb-0">Highest Speed</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div id="iq-income-chart"></div>
                </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-primary rounded background-image-overlap">
                <div class="iq-card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div><img class="rounded" src="images/page-img/38.png" alt=""></div>
                        <h5 class="pl-3 text-white">Unauthorized Threats has been Terminated</h5>
                    </div>
                    <p class="mb-2"><span class="text-white">5</span> Unnecessary Data</p>
                    <p class="mb-2"><span class="text-white">12</span> Undentified Source Data</p>
                    <p class="mb-3"><span class="text-white">8</span> Unused Images</p>
                    <button type="submit" class="btn w-100 btn-white mt-4 text-primary viwe-more">View More</button>
                </div>
                </div>
            </div> -->
            <div class="col-lg-7">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Đơn hàng gần đây</h4>
                    </div>
                    <!-- <div class="iq-card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle text-primary" id="dropdownMenuButton2" data-toggle="dropdown">
                            <i class="ri-more-2-fill"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                            <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                            <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                            <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                            </div>
                        </div>
                    </div> -->
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
                                    {{number_format($dh->tong_dh, 0, ',' , '.' )}} đ
                                    </td>
                                    <td>
                                    <div class="d-flex justify-content-center">
                                        @if ($dh->trang_thai == 0)
                                        <span class="btn bg-warning">Chờ xử lý</span>
                                        @elseif ($dh->trang_thai == 1)
                                        <span class="btn bg-primary">Đã xử lý</span>
                                        @elseif ($dh->trang_thai == 2)
                                        <span class="btn bg-info">Đã giao cho đơn vị vận chuyển</span>
                                        @elseif ($dh->trang_thai == 3)
                                        <span class="btn bg-success">Giao hàng thành công</span>
                                        @elseif ($dh->trang_thai == 4)
                                        <span class="btn bg-danger">Đã hủy</span>
                                    @endif
                                </div>
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
                    <!-- <div class="iq-card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle text-primary" id="dropdownMenuButton2" data-toggle="dropdown">
                            <i class="ri-more-2-fill"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                            <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                            <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                            <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                            </div>
                        </div>
                    </div> -->
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
        </div>
    </div>
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