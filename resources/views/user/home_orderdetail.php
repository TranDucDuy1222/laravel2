<?php
include_once("App/views/user/head.php");
include_once("App/views/user/header.php");
?>
<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">Chi tiết đơn hàng</h2>
<div class="row" style="padding-bottom: 50px;  padding-top: 20px; margin-left: 0; margin-right: 0;">

    <body style=" background-color: #F5F5F5;">
        <div class="col-8 container">
            <div class="row" style="border: 1px solid #DCDCDC; height: 70vh;">
                <div class="col-3" style="background-color:	#DCDCDC;">
                    <ul class="list-unstyled" style="padding-top: 50px;">
                        <li data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample"><a
                                class="text-decoration-none text-dark dropdown-item " data-target="#collapseExample"
                                href="index.php?mod=thongtin&act=thongtin">My profile <i class="fa-solid fa-angle-down"></i></a></li>
                        <div class="collapse" id="collapseExample">
                            <li><a class="text-decoration-none text-dark dropdown-item "
                                    href="index.php?mod=thongtin&act=doipass&id=<?=$sp['matk']?>">Change Password</a>
                            </li>
                            <li><a class="text-decoration-none text-dark dropdown-item "
                                    href="index.php?mod=thongtin&act=doisdt&id=<?=$sp['matk']?>">Change phone number</a>
                            </li>
                            <li><a class="text-decoration-none text-dark dropdown-item "
                                    href="index.php?mod=thongtin&act=doiten&id=<?=$sp['matk']?>">Change username</a>
                            </li>
                        </div>
                        <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=order">Purchased order </a></li>
                        <li><a class="text-decoration-none text-dark dropdown-item " href="#">Request account
                                deletion</a></li>

                    </ul>
                </div>
           
                <div class="col-9" style="padding-top: 30px; ">
    
        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
            <div class="sa-layout">
                <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
                <div class="sa-layout__content">
                    <div class="card table-responsive" style="height: 400px; overflow-y: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Màu sắc</th>
                                    <th>Size</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
    $tong = 0;
    if (isset($_SESSION['order-detail'])) {
        foreach ($_SESSION['order-detail'] as $item) {
            extract($item);
            $tongtien = $gia * $soluong;
            $tong += $tongtien;

            // Display product information
            echo '<tr>
            <td>
            <div class="d-flex align-items-center">
                <p class="me-4">
                    <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                        <img src="'.Base_url.'/public/img/' . $anhsp . '" alt="Sản phẩm ' . $madh . '" width="40" height="40" />
                    </div>
                </p>
                <div>
                    <h6 class="text-reset">' . $tensp . '</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="sa-price">
                <span class="sa-price__integer">' . $soluong . '</span>
            </div>
        </td>
        <td>
            <div class="sa-price">
                <span class="sa-price__integer">' . $gia . '</span>
            </div>
        </td>
        <td>
            <div class="sa-price">
                <span class="sa-price__integer">' . $color . '</span>
            </div>
        </td>
        <td>
            <div class="sa-price">
                <span class="sa-price__integer">' . $size . '</span>
            </div>
        </td>
        <td>
            <div class="sa-price">
                <span class="sa-price__integer">' . $tongtien . '</span>
            </div>
        </td></tr>';
        
        }
        // Hiển thị trạng thái từng chi tiết đơn hàng
        echo '<tr>
        <td colspan="6">
        <div class="row">
            <div class="col-7">
                <div class="sa-price">
                    <span class="sa-price__integer font-weight-bold">Trạng Thái : </span> <span style="color: green; letter-spacing: 1px; font-weight: bold;">';
        if ($matrangthai == 1) {
        echo 'Đang xử lý';
        } elseif ($matrangthai == 2) {
        echo 'Shop đã xác nhận đơn hàng';
        } elseif ($matrangthai == 3) {
        echo 'Chờ đơn vị vận chuyển';
        }elseif ($matrangthai == 4) {
        echo 'Đang trên đường tới chỗ bạn';
        } elseif ($matrangthai == 5) {
        echo 'Đang giao hàng';
        }elseif ($matrangthai == 6) {
        echo 'Hàng đã được nhận';
        }elseif ($matrangthai == 7) {
            echo 'Đã hủy';
        }elseif ($matrangthai == 8) {
            echo 'Đánh giá sản phẩm';
        }
        echo '</span>
                </div>
            </div>
            
            <div class="col-5">
                <div class="sa-price">
            ';
        if ($matrangthai == 1 ) {
            echo '<form action="'.Base_url.'/cancel_order" method="POST">
                        <input hidden name="madh" value="' .$madh. '">
                        <div class="col-6">
                        <input type="submit" class="btn btn-outline-danger" name="cancel-order" value="Hủy đơn hàng">
                        </div>
                    </form>';
        } elseif ($matrangthai == 2 || $matrangthai == 3 || $matrangthai == 4 || $matrangthai == 5) {
            echo '<a class="btn btn-outline-danger">Đơn hàng đang được giao</a>';
        }elseif ($matrangthai == 7){
            echo '<a class="btn btn-outline-danger">Đã hủy đơn hàng</a>';
        }elseif($matrangthai == 6) {
            echo '
                <input data-toggle="modal" data-target="#fdg" type="submit" class="btn btn-outline-danger" name="review" value="Reviews">
            ';
        }elseif ($matrangthai == 8) {
            echo '
                <a href="" class="btn btn-outline-danger">Đánh giá</a>
            ';
        }

        echo '</div>
            </div>
            
        </div>
        </td>
        </tr>';
        
    }
    ?>
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
            </div>
        </div>
    </body>
</div>


<!-- Form đánh giá -->
<div class="modal fade" id="fdg" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
        if (isset($_SESSION['order-detail'])) {
            echo' <form action="?mod=thongtin&act=review" method="POST" enctype="multipart/form-data">';
            foreach ($_SESSION['order-detail'] as $item) {
                $mactdh = $item['mactdh'];
                $tensp = $item['tensp'];
                echo '
               
                    <input hidden name="madh" value ="'.$madh.'">
                    <input hidden name="mactdh[]" value ="'.$mactdh.'">
                    <input hidden name="matk[]" value ="'.$matk.'">
                    <label style="width: 500px; text-align: center; font-size: larger;">Name product : '.$tensp.'</label>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputEmail">Product quality</label>
                            <input type="type" name="ndbl[]" class="form-control" id="inputEmail" placeholder="Please enter product quality">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Evaluate the material of the product</label>
                            <input type="text" name="chatluong[]" class="form-control" id="" placeholder="Please enter product material">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Does the product match the description?</label><br>
                            <select name="truemt[]" id="" class="form-control">
                                <option value="Đúng với mô tả">Đúng với mô tả</option>
                                <option value="Không đúng với mô tả">Không đúng với mô tả</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Add product photos</label><br>
                            <input name="anhbl[]" type="file">
                        </div>       
                    </div>
                    
                
                ';
            }
            echo '
            <div class="modal-footer">
                        <input type="submit" name="review" class="btn btn-outline-secondary" value="Submit review">
                    </div>
            </form>';
        }
      ?>
      
    </div>
  </div>
</div>
<?php
include_once("App/views/user/footer.php");
?>