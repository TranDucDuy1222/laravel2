@extends('user.layout')
@section('title')
Thanh toán
@endsection

@section('category')
    @foreach ($loai as $category)
        <li class="nav-item dropdown">
            <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                href="{{ url('/category/' . $category->slug) }}">
                {{$category->ten_loai}}
            </a>
            <ul class="dropdown-menu" id="userDropdown">
                @foreach ($danh_muc as $dm)
                    @if ($dm->id_loai == $category->id)
                        <li class="hover-dm"><a class="dropdown-item" href="{{$dm->slug}}">{{$dm->ten_dm}}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
@endsection

@section('content')

@endsection
@php
if (empty($_SESSION['buy'])) {
  $show = '';
  $arlert = 'Vui lòng thêm sản phẩm từ trang giỏ hàng';
}else{
  $show = '<button style="width: 150px;" type="submit" name="order" class="btn btn-dark container btn-buy">Thanh toán</button>';
  $arlert = '';
}
@endphp
<div class="container">
    <h2 class="text-center font-weight-bold" style="padding-top: 30px; letter-spacing: 1px;">Thanh toán</h2>
    <div class="row">
    <div class="col">
        <!-- phương thức thanh toán  -->
      <!-- giohang -->
<!-- diachi giao hang -->
<p id="error-message" style="color: red; font-size: 22px;"><?=$arlert?></p>
<a class="font-weight-bold" style="font-size: 20px; letter-spacing: 1px; text-decoration: none; color: black;">Địa chỉ giao hàng</a> 
<a style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal">(Thêm địa chỉ)</a>
 @foreach($data['get_diachi'] as $sp)   
    <div class="container" style="display: grid; grid-template-columns: 60% 40%;" >
            <div>
              <input type="radio" name="select_address" value="<?=$sp['madc']?>">
              <span style="font-size: 16px; letter-spacing: 1px;">- <?=$sp['hoten']?>, <?=$sp['sdt']?>, <?=$sp['diachichitiet']?>, <?=$sp['quan']?>, <?=$sp['tp']?></span>  
            </div>
            <div style="" >
              <a type="submit" class="btn btn-outline-secondary" href="<?=$sp['madc']?>">Sửa</a>
              <a onclick="deletediachi(<?=$sp['madc']?>)" class="btn btn-outline-secondary" href="#">Xóa</a>
            </div>
           <script>
            function deletediachi(id){
                var kq = confirm("Are you sure you want to delete this address?");
                if(kq){
                    window.location.search='?mod=thanhtoan&act=delete&id='+id; 
                }
            }
           </script>
      </div>
@endforeach
    
        <div>
            <a class="font-weight-bold" style="font-size: 20px; letter-spacing: 1px; text-decoration: none; color: black;">Chọn một Phương thức thanh toán: </a>
            <select name="pttt" id="paymentMethod" onchange="updatePay()">
                <option value="1">Thanh toán khi nhận hàng</option>
                <option value="2">Thanh toán qua ngân hàng</option>
                <option value="3">Thanh toán bằng thẻ tín dụng/thẻ ghi nợ</option>
            </select>
            <!-- Button trigger modal -->
            </div>

        <div class="container" style="padding: 30px 0px;">
            <table id="cart" class="table table-hover table-condensed">
            
                <thead> 
                     <tr> 
                        <th style="width:50%">Tên Sản Phẩm</th> 
                        <th style="width:10%">Size</th>
                        <th style="width:10%">Màu sắc</th>
                        <th style="width:10%">Giá</th> 
                        <th style="width:8%">Số lượng</th> 
                        <th style="width:32%" class="text-center">Thành tiền</th> 
                    </tr>
                    
                </thead> 
                <tbody>
                
                @php
                    $tongs=0;
                    $tong = 0;
                        if (isset($_SESSION['buy'])) {
                          //var_dump($_SESSION['buy']);
                            foreach ($_SESSION['buy'] as $item) {
                                extract($item);
                                $tongtien = $giasp * $soluong;
                                $tong +=$tongtien; 
                                $tongtiens = number_format($tongtien,0,'', '.');
                                $tongs = number_format($tong,0,'', '.');
                                $gias = number_format($giasp,0,'', '.');  
                                    echo '
                                      
                                        <tr data-masp="'.$madh.'"> 
                                                <td data-th="Product"> 
                                                <div class="row"> 
                                                    <div class="col-sm-2 hidden-xs">
                                                        <img src="'.Base_url.'/public/img/'.$anhsp.'" alt="Sản phẩm '.$masp.'" class="img-responsive" width="70">
                                                    </div> 
                                                    <div class="col-12"> 
                                                        <h5 class="nomargin font-weight-bold" style="letter-spacing: 1px; font-size: 16px;">'.$tensp.'</h5> 
                                                    </div> 
                                                </div> 
                                            </td> 
                                            <td >'.$size.'</td>
                                            <td >'.$color.'</td>
                                            <td data-th="Price">'.$gias.'</td> 
                                            <td data-th="Quantity"><input class="form-control text-center" value="'.$soluong.'" type="number" min="1" max="'.$soluong.'" onchange="updateQuantity(this, '.$masp.')"></td>
                                            <td data-th="Subtotal" class="text-center">'.$tongtiens.'</td> 
                                            
                                            <td class="actions" data-th="">
                                                  <form method="post" action="'.Base_url.'/return_cart">
                                                    <input type="hidden" name="mactdh" value="'.$mactdh.'">
                                                    <input type="hidden" name="masp" value="'.$masp.'">
                                                    <input type="hidden" name="size" value="'.$size.'">
                                                    <input type="hidden" name="color" value="'.$color.'">
                                                    <input type="hidden" name="gia" value="'.$giasp.'">
                                                    <button type="submit" style="width: 115px;" class="btn btn-outline-dark">Return cart</button>
                                                  </form>
                                            </td>
                                            
                                        </tr>
                                      ';
                            }
                            
                        }
                        @endphp
                      <!-- <a href="Base_url/deleteall_buy"> Xóa</a> -->
                </tbody>
                
                </table>
         
           <div class="row container" >
              <div class="col-6">
                
              </div>
              <div class="col-6">
                <div class="row">
                    <div class="col-7">
                        <button type="button" class="btn btn-dark btn-tongtien">Tổng tiền: <?php echo $tongs; ?> VNĐ</button>  
                      </div>
                      <div class="col-3">
                        
                        <form action="<?php echo Base_url?>/order" method="post" id="myForm">
                            <input hidden name="madh" value="<?=$madh?>">
                            <input hidden id="add_address" name="add_address" value="">
                            <input hidden name="matk" value="<?=$sp['matk']?>">
                            <input hidden id="phuongthuc" name="pttt" value="Payment on delivery">
                            <input hidden name="giatong" value="<?=$tong?>">
                            <?php
                                if (isset($_SESSION['buy'])) {
                                    foreach ($_SESSION['buy'] as $item) {
                                        extract($item);
                                        echo'<input type="hidden" name="soluong[]" value="'.$soluong.'">';  
                                    }
                                }
                              ?>
                              <!-- Button thanh toán -->
                            <?=$show?>
                        </form>
                      </div>
                </div>
            </div>
           </div>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New address</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="col">
            <form style="padding: 50px 0px;" method="post" onsubmit="check(event)">
                <h4 class="text-center font-weight-bold" style="letter-spacing: 1px;">Please enter your delivery information</h4>
                  <div class="form-group">
                    <label for="inputEmail4">Full name</label>
                    <input type="text" class="form-control" id="inputName" name="hoten" placeholder="Please enter your full name">
                  </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" id="sdt" name="sdt" placeholder="Please enter your phone number">
                      </div>
                        <div class="form-group">
                            <label for="inputCity">Province Or City</label>
                            <select id="inputCity" name="tp" class="form-control">
                              <option selected></option>
                              <option value="Hà Nội">Hà Nội</option>
                                <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                                <option value="Hải Phòng">Hải Phòng</option>
                                <option value="Đà Nẵng">Đà Nẵng</option>
                                <option value="Cần Thơ">Cần Thơ</option>
                                <option value="Quảng Ninh">Quảng Ninh</option>
                                <option value="Bình Dương">Bình Dương</option>
                                <option value="Đồng Nai">Đồng Nai</option>
                                <option value="Khánh Hòa">Khánh Hòa</option>
                                <option value="Hải Dương">Hải Dương</option>
                                <option value="Gia Lai">Gia Lai</option>
                                <option value="Long An">Long An</option>
                                <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                                <option value="Bắc Ninh">Bắc Ninh</option>
                                <option value="Nam Định">Nam Định</option>
                                <option value="Cà Mau">Cà Mau</option>
                                <option value="Quảng Ngãi">Quảng Ngãi</option>
                                <option value="Vĩnh Long">Vĩnh Long</option>
                                <option value="Ninh Bình">Ninh Bình</option>
                                <option value="Bình Thuận">Bình Thuận</option>
                                <option value="Phú Thọ">Phú Thọ</option>
                                <option value="Thái Nguyên">Thái Nguyên</option>
                                <option value="Bắc Giang">Bắc Giang</option>
                                <option value="Hòa Bình">Hòa Bình</option>
                                <option value="An Giang">An Giang</option>
                                <option value="Bình Phước">Bình Phước</option>
                                <option value="Tây Ninh">Tây Ninh</option>
                                <option value="Lào Cai">Lào Cai</option>
                                <option value="Đắk Lắk">Đắk Lắk</option>
                                <option value="Cao Bằng">Cao Bằng</option>
                                <option value="Yên Bái">Yên Bái</option>
                                <option value="Quảng Bình">Quảng Bình</option>
                                <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                                <option value="Bắc Kạn">Bắc Kạn</option>
                                <option value="Tuyên Quang">Tuyên Quang</option>
                                <option value="Thái Bình">Thái Bình</option>
                                <option value="Điện Biên">Điện Biên</option>
                                <option value="Lạng Sơn">Lạng Sơn</option>
                                <option value="Thanh Hóa">Thanh Hóa</option>
                                <option value="Hà Tĩnh">Hà Tĩnh</option>
                                <option value="Nghệ An">Nghệ An</option>
                                <option value="Quảng Nam">Quảng Nam</option>
                                <option value="Quảng Trị">Quảng Trị</option>
                                <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                                <option value="Bình Định">Bình Định</option>
                                <option value="Kon Tum">Kon Tum</option>
                                <option value="Gia Lai">Gia Lai</option>
                                <option value="Lâm Đồng">Lâm Đồng</option>
                                <option value="Đắk Nông">Đắk Nông</option>
                                <option value="Sơn La">Sơn La</option>
                                <option value="Hà Giang">Hà Giang</option>
                                <option value="Bạc Liêu">Bạc Liêu</option>
                                <option value="Bắc Ninh">Bắc Ninh</option>
                                <option value="Lai Châu">Lai Châu</option>
                                <option value="Điện Biên">Điện Biên</option>
                                <option value="Hà Nam">Hà Nam</option>
                                <option value="Hưng Yên">Hưng Yên</option>
                                <option value="Nam Định">Nam Định</option>
                                <option value="Phú Yên">Phú Yên</option>
                                <option value="Hà Tĩnh">Hà Tĩnh</option>
                                <option value="Ninh Thuận">Ninh Thuận</option>
                                <option value="Nghệ An">Nghệ An</option>
                                <option value="Sóc Trăng">Sóc Trăng</option>
                                <option value="Kon Tum">Kon Tum</option>
                                <option value="Quảng Trị">Quảng Trị</option>
                                <option value="Trà Vinh">Trà Vinh</option>
                                <option value="Tuyên Quang">Tuyên Quang</option>
                                <option value="Vĩnh Long">Vĩnh Long</option>
                                <option value="Hòa Bình">Hòa Bình</option>
                                <option value="Tây Ninh">Tây Ninh</option>
                                <option value="Bến Tre">Bến Tre</option>
                                <option value="Đồng Tháp">Đồng Tháp</option>
                                <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                                <option value="Bình Thuận">Bình Thuận</option>
                                <option value="Long An">Long An</option>
                                <option value="Cà Mau">Cà Mau</option>
                            </select>
                          </div>
                        <div class="form-group">
                          <label for="inputCity">District</label>
                          <select id="inputDistrict" name="quan" class="form-control">
                            <option selected></option>
                            <option>QUAN 1</option>
                            <option>QUAN 2</option>
                            <option>QUAN 3</option>
                            <option>QUAN 4</option>
                            <option>QUAN 5</option>
                            <option>QUAN 6</option>
                            <option>QUAN 7</option>
                            <option>QUAN 8</option>
                            <option>QUAN 9</option>
                            <option>QUAN 10</option>
                            <option>QUAN 11</option>
                            <option>QUAN 12</option>
                          </select>
                        </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" id="inputAddress" name="diachichitiet" placeholder="Please enter your address"> 
                  
                </div>
                <button type="submit" class="btn btn-outline-dark" name="submit-diachi">save</button>
              </form>
        </div>
        </div>
      </div>
    </div>
  </div>
<!-- code khác -->
<!-- Hàm chọn địa chỉ -->

<script src="<?php echo Base_url;?>/public/js/add_dc.js"></script>
<script src="<?php echo Base_url;?>/public/js/thanhtoan.js"></script>