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

    <div class="container mt-2">
        <div class="text-dark">
            <h3>Mẹo chọn size</h3>
            <h6>Kích thước áo cao (khoảng 6'-6'5"/183-196cm):  dài hơn áo thông thường khoảng 1,75"/4,5cm. 
                <br>
                Chiều dài tay áo được điều chỉnh theo tỷ lệ tùy theo dáng người.
                Kích thước cao chỉ có sẵn cho một số kiểu dáng nhất định. <br> <br>
                Nếu bạn đang ở ranh giới giữa hai kích thước,
                hãy đặt hàng kích thước nhỏ hơn để vừa vặn hơn hoặc kích thước lớn hơn để vừa vặn hơn. <br>
                Nếu số đo vòng ngực và vòng eo của bạn tương ứng với hai kích thước được đề xuất khác nhau, <br>
                hãy đặt hàng kích thước được chỉ định theo số đo vòng ngực của bạn.</h6> <br>
    
            <h3>Cách đo</h3>
                <h6>NGỰC: Đo quanh phần đầy nhất của ngực, giữ thước dây theo chiều ngang. <br>
                    EO: Đo quanh phần hẹp nhất (thường là nơi cơ thể bạn uốn cong sang hai bên), giữ thước dây theo chiều ngang. <br>
                    MÔNG: Đo quanh phần đầy nhất của hông, giữ thước dây theo chiều ngang.</h6>
        </div>
        <hr/>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kích Cỡ Áo</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Kích Cỡ Giày</button>
        </div>
    </div>
    
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Size</th>
                            <th scope="col">Vòng ngực (cm)</th>
                            <th scope="col">Vòng bụng (cm)</th>
                            <th scope="col">Vòng hông (cm)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">XXS</th>
                            <td>&lt; 81.5</td>
                            <td>&lt; 69.5</td>
                            <td>&lt; 83.5</td>
                        </tr>
                        <tr>
                            <th scope="row">XS</th>
                            <td>81.5 - 86.5</td>
                            <td>69.5 - 74.5</td>
                            <td>83.5 - 88.5</td>

                        </tr>
                        <tr>
                            <th scope="row">S</th>
                            <td>86.5 - 91.5</td>
                            <td>74.5 - 79.5</td>
                            <td>88.5 - 93.5</td>
                        </tr>
                        <tr>
                            <th scope="row">M</th>
                            <td>91.5 - 97</td>
                            <td>79.5 - 86</td>
                            <td>93.5 - 98.5</td>
                        </tr>
                        <tr>
                            <th scope="row">L</th>
                            <td>97 - 103</td>
                            <td>85 - 91</td>
                            <td>98.5 - 103.5</td>
                        </tr>
                        <tr>
                            <th scope="row">XL</th>
                            <td>103 - 109</td>
                            <td>81 - 97</td>
                            <td>103.5 - 108.5</td>
                        </tr>
                        <tr>
                            <th scope="row">XXL</th>
                            <td>109 - 115</td>
                            <td>97 - 103</td>
                            <td>108.5 - 113.5</td>
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
                        <th scope="col">Chiều dài (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>35.5</td>
                        <td>&lt; 22.5 cm</td>
                    </tr>
                    <tr>
                        <td>36</td>
                        <td>23 cm</td>
                    </tr>
                    <tr>
                        <td>36.5</td>
                        <td>23.5 cm</td>
                    </tr>
                    <tr>
                        <td>37</td>
                        <td>23.5 cm</td>
                        
                    </tr>
                    <tr>
                        <td>38</td>
                        <td>24 cm</td>
                    </tr>
                    <tr>
                        <td>38.5</td>
                        <td> 24 cm</td>
                    </tr>
                    <tr>
                        <td>39</td>
                        <td>24.5 cm</td>
                    </tr>
                    <tr>
                        <td>40</td>
                        <td>25 cm</td>
                    </tr>
                    <tr>
                        <td>40</td>
                        <td>25 cm</td>
                    </tr>
                    <tr>
                        <td>40.5 </td>
                        <td>25.5 cm</td>
                    </tr>
                    <tr>
                        <td>41</td>
                        <td>26 cm</td>
                    </tr>
                    <tr>
                        <td>42</td>
                        <td>26.5 cm</td>
                    </tr>
                    <tr>
                        <td>42.5</td>
                        <td>27 cm</td>
                    </tr>
                    <tr>
                        <td>43</td>
                        <td>27.5 cm</td>
                    </tr>
                    <tr>
                        <td>44</td>
                        <td>28 cm</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection