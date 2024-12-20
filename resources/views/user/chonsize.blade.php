@extends('user.layout')
@section('title')
Hướng dẫn chọn size - TrendyU
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
        <li class="hover-dm"><a class="dropdown-item" href="{{ route('danh-muc-san-pham', $dm->slug)}}">{{$dm->ten_dm}}</a>
        </li>
        @endif
        @endforeach
    </ul>
</li>
@endforeach
@endsection

@section('content')

<nav>
    <div class="container">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kích Cỡ Áo</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Kích Cỡ Giày</button>
        </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="container">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Size</th>
                        <th scope="col">XXS</th>
                        <th scope="col">XS</th>
                        <th scope="col">S</th>
                        <th scope="col">M</th>
                        <th scope="col">L</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ngực</td>
                        <td>28.1cm - 31.5cm</td>
                        <td>31.5cm - 35cm</td>
                        <td>35cm - 37.5cm</td>
                        <td>37.5cm - 41cm</td>
                        <td>41cm - 44cm</td>
                    </tr>
                    <tr>
                        <td>Vòng eo</td>
                        <td>22.5cm - 25.5cm</td>
                        <td>25.5cm - 29cm</td>
                        <td>29cm - 32cm</td>
                        <td>32cm - 35cm</td>
                        <td>35cm - 38cm</td>
                    </tr>
                    <tr>
                        <td>Hông</td>
                        <td>28.5cm - 31.5cm</td>
                        <td>31.5cm - 35cm</td>
                        <td>35cm - 37.5cm</td>
                        <td>37.5cm - 41cm</td>
                        <td>41cm - 44cm</td>
                    </tr>
                    <tr>
                        <td>Chiều dài</td>
                        <td>&lt; 170cm</td>
                        <td>170cm - 180cm</td>
                        <td>170cm - 180cm</td>
                        <td>170cm - 180cm</td>
                        <td>170cm - 180cm</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
    <div class="container">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Size</th>
                    <th scope="col">Dài</th>
                    <th scope="col">Rộng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>36</td>
                    <td>23cm</td>
                    <td>10cm</td>

                </tr>
                <tr>
                    <td>37</td>
                    <td>23.2cm</td>
                    <td>12cm</td>

                </tr>
                <tr>
                    <td>38</td>
                    <td>24cm</td>
                    <td>14cm</td>

                </tr>
                <tr>
                    <td>39</td>
                    <td> 24.2cm</td>
                    <td>15cm</td>
                </tr>
                <tr>
                    <td>40</td>
                    <td>24.5cm</td>
                    <td>15.2cm</td>
                </tr>
                <tr>
                    <td>41</td>
                    <td>25cm</td>
                    <td>15.5cm</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="container">
    <div>
        <h3>Mẹo chọn size</h3>
        <h6>Kích thước áo cao (khoảng 6'–6'5"/183–196cm): dài hơn áo thông thường khoảng 1,75"/4,5cm.
            <br>
            Chiều dài tay áo được điều chỉnh theo tỷ lệ tùy theo dáng người.
            Kích thước cao chỉ có sẵn cho một số kiểu dáng nhất định. <br> <br>
            Nếu bạn đang ở ranh giới giữa hai kích thước,
            hãy đặt hàng kích thước nhỏ hơn để vừa vặn hơn hoặc kích thước lớn hơn để vừa vặn hơn. <br>
            Nếu số đo vòng ngực và vòng eo của bạn tương ứng với hai kích thước được đề xuất khác nhau, <br>
            hãy đặt hàng kích thước được chỉ định theo số đo vòng ngực của bạn.
        </h6> <br>

        <h3>Cách đo</h3>
        <h6>NGỰC: Đo quanh phần đầy nhất của ngực, giữ thước dây theo chiều ngang. <br>
            EO: Đo quanh phần hẹp nhất (thường là nơi cơ thể bạn uốn cong sang hai bên), giữ thước dây theo chiều ngang. <br>
            MÔNG: Đo quanh phần đầy nhất của hông, giữ thước dây theo chiều ngang.</h6>
    </div>
</div>


@endsection