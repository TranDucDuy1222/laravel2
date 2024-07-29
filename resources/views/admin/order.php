<?php
include_once("App/views/admin/template_admin_head.php");
include_once("App/views/admin/template_admin_header.php");
?>
            <!-- sa-app__body -->
            <div id="top" class="sa-app__body">
                <div class="mx-xxl-3 px-4 px-sm-5">
                    <div class="py-5">
                        <div class="row g-4 align-items-center">
                            <div class="col">
                                <h1 class="h3 m-0">Orders</h1>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
                    <div id="trangthaidh">
                        <label>Trạng thái :</label>
                            <a href="<?=Base_url?>/admin/order_admin/" id="trangthai" hidden></a>
                            <a href="<?=Base_url?>/admin/order_admin/1" id="select_tt" >Chờ xử lý</a>
                            <a href="<?=Base_url?>/admin/order_admin/3" id="select_tt" >Chờ vận chuyển</a>
                            <a href="<?=Base_url?>/admin/order_admin/4" id="select_tt" >Đã gởi hàng</a>
                            <a href="<?=Base_url?>/admin/order_admin/5" id="select_tt" >Đang giao hàng</a>
                            <a href="<?=Base_url?>/admin/order_admin/6" id="select_tt" >Đã giao hàng</a>
                            <a href="<?=Base_url?>/admin/order_admin/8" id="select_tt" >Đã đánh giá</a>
                            <a href="<?=Base_url?>/admin/order_admin/7" id="select_tt">Đã hủy</a>
                    </div>
                    <hr>
                    <div class="sa-layout">
                        <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
                        <div class="sa-layout__content">
                            <div class="card table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="w-min">
                                                <input type="checkbox"
                                                    class="form-check-input m-0 fs-exact-16 d-block" />
                                            </th>
                                            <th class="min-w-20x">Account</th>
                                            <th>Phone Number</th>
                                            <th>Order date</th>
                                            <th>Address</th>
                                            <th class="w-min"></th>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                    <?php
                                        $order_tt = $data["showall_order_tt"];
                                        $madh_seen = array(); // Mảng để theo dõi madh đã xuất hiện
                                        foreach ($order_tt as $sp) {
                                            $madh = $sp['madh'];
                                            $matrangthai = $sp['matrangthai'];
                                            // Kiểm tra xem đã hiển thị đơn hàng với madh này chưa
                                            if (!in_array($madh, $madh_seen)) {
                                                echo '<tr>
                                                        <td><input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block"
                                                                aria-label="..." />
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <a href="#" class="text-reset">'.$sp['hoten'].'</a>
                                                                    <div class="sa-meta mt-0">
                                                                        <ul class="sa-meta__list">
                                                                            <li class="sa-meta__item">ID:
                                                                                <span title="Click to copy product ID"
                                                                                    class="st-copy">'.$madh.'</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="sa-price">                                              
                                                                <span class="sa-price__integer">'.$sp['diachichitiet'].'</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="sa-price">                                              
                                                                <span class="sa-price__integer">'.$sp['sdt'].'</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="sa-price">                                              
                                                                <span class="sa-price__integer">';
                                                if ($matrangthai == 1) {
                                                    echo 'Chờ xử lý';
                                                }elseif ($matrangthai == 2) {
                                                    echo 'Đã chuẩn bị xong đơn hàng';
                                                }elseif ($matrangthai == 3) {
                                                    echo 'Chờ đơn vị vận chuyển';
                                                }elseif ($matrangthai == 4) {
                                                    echo 'Đã giao cho đơn vị vận chuyển';
                                                }elseif ($matrangthai == 5) {
                                                        echo 'Đang giao hàng';
                                                }elseif ($matrangthai == 6) {
                                                            echo 'Đã giao hàng';
                                                }elseif ($matrangthai == 7) {
                                                    echo 'Đã hủy';
                                                }elseif ($matrangthai == 8) {
                                                    echo 'Đã đánh giá';
                                                }
                                                echo'</span>
                                                    </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">';
                                                                if ($matrangthai == 8 || $matrangthai == 7 || $matrangthai == 5 || $matrangthai == 6) {
                                                                    echo '
                                                                        <a onclick="deleteorder('.$madh.')" class="dropdown-item text-danger" href="#">Hidden</a>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                                            }else {
                                                                echo '
                                                                <a style="text-align: center;" class="dropdown-item" href="'.Base_url.'/admin/order_admin/edit/'.$madh.'">Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                                               
                                                }   
                                                                    

                                                // Đánh dấu madh đã xuất hiện
                                                $madh_seen[] = $madh;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sa-app__body / end -->
<script>
// function deleteorder(id){
//     var kq = confirm("Are you sure you want to delete this product?");
//     if(kq){
//         window.location.search='?mod=order&act=delete&id='+id; 
//     }
// }
</script>
<?php
include_once("App/views/admin/template_admin_footer.php");
?>
<script src="<?php echo Base_url;?>/public/js/add_dc.js"></script>