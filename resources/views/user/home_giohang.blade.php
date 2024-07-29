@extends('user.layout')
@section('title')
 Giỏ Hàng - Nike
@endsection

@section('category')
@foreach ($danhmuc as $category)
  <li class="nav-item">
  <a class="nav-link fz" href="/category/{{$category->madm}}">
    {{$category->tendm}}
  </a>
  </li>
@endforeach
@endsection


@section('content')
<!-- giohang -->
<div style="padding-bottom: 170px; padding-top: 55px;">

<!-- giỏ hàng -->
<div class="container"> 
    <h2 class="text-center font-weight-bold" style="letter-spacing: 1px;">Giỏ Hàng Của Tôi</h2>
<form action="/thanh_toan" method="post">
    <table id="cart" class="table table-hover table-condensed"> 
        <thead> 
            <tr> 
                <th style="width:5%"></th>
                <th style="width:40%">Tên sản phẩm</th>
                <th style="width:10%">Kích cở</th>
                <th style="width:10%">Màu sắc</th>
                <th style="width:10%">Giá</th>
                <th style="width:10%">Số lượng</th>
                <th style="width:30%" class="text-center">Thành tiền</th>
                <th style="width:10%"> </th>
            </tr> 
        </thead>
        
        @php 
            $tongs = 0;
            $tong = 0;
            if (isset($cart)) {
                echo '<tbody>';
                //var_dump($_SESSION['cart']);
                foreach ($cart as $item) {
                        extract($item);
                        // Tổng tiền 1 sản phẩm
                        $tongtien = (int)$giasp * (int)$soluong;
                        // Tổng tất cả sản phẩm
                        $tong += $tongtien;
                        $tongtiens = number_format($tongtien,0,'', '.');
                        $tongs = number_format($tong,0,'', '.');
                        $gias = number_format($giasp,0,'', '.');
                        echo '
                        <form action="/thanh_toan" method="post">
                            <input type="hidden" name="l_masp" value="'.$masp.'">
                            <input type="hidden" name="l_color" value="">
                            <input type="hidden" name="l_size" value="">
                        </form>
                        <tr data-masp="'.$masp.'">
                        <td><input id="checkbox" type="checkbox" name="select_product[]" value="'.$masp.'" checked></td>
                        <td data-th="Product"> 
                            <div class="row"> 
                                <div class="col-sm-2 hidden-xs">
                                    <img src="/img/'.$anhsp.'"  alt="Sản phẩm '.$masp.'" class="img-responsive" width="80">
                                </div> 
                                <div class="col-sm-10"> 
                                    <h4 class="nomargin font-weight-bold" style="letter-spacing: 1px; font-size: 18px;">'.$ten_sp.'</h4> 
                                </div> 
                            </div> 
                        </td>
                        <td >'.$size.'</td>
                        <td >'.$color.'</td>
                        <td data-th="Price">'.$gias.'</td> 
                        <td data-th="Quantity">
                            <form action="/quality" method="post">
                                <input type="hidden" name="l_masp" value="'.$masp.'">
                                <input type="hidden" name="l_color" value="'.$color.'">
                                <input type="hidden" name="l_size" value="'.$size.'">
                                <input class="form-control text-center" name="soluong" value="'.$soluong.'" type="number" min="1" onchange="this.form.submit()">
                            </form>
                        </td>

                        <td data-th="Subtotal" class="text-center">'.$tongtiens.'</td> 
                        <td class="actions" data-th="">
                            <form action="/deletecart" method="post">
                                <input type="hidden" name="d_masp" value="'.$masp.'">
                                <input type="hidden" name="d_size" value="'.$size.'">
                                <input type="hidden" name="d_color" value="'.$color.'">
                                <button class="btn btn-outline-dark" type="submit">Xóa</button>
                            </form>
                        </td>
                        </tr>';
                }
                echo'
                    <tr>
                    <td colspan="5"></td>
                    <td class="text-center" style="padding: 0px; padding-top: 25px; padding-right: 30px;"><button type="button" style="width: 250px;" class="btn btn-dark">Tổng tiền: '.$tongs.' VNĐ</button></td>
                    <td class="text-center" style="padding: 0px; padding-top: 25px;" >
                        <input type="hidden" name="giatong" value="'.$tong.'">
                        <button name="submit-order" type="submit" style="width: 100px;" class="btn btn-dark" >Mua</button>
                    </td>
                    </tr>';
                echo'</tbody>';
            }
        @endphp
    </table>
    
</form>
</div>
</div>
@endsection
