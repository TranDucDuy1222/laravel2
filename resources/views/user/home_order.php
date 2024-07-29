<?php
include_once("App/views/user/head.php");
include_once("App/views/user/header.php");
?>
<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">Thông tin cá nhân</h2>
<div class="row" style="padding-bottom: 50px;  padding-top: 20px; margin-left: 0; margin-right: 0;">
    <body style=" background-color: #F5F5F5;">
        <div class="col-8 container">
            <div class="row" style="border: 1px solid #DCDCDC; height: 70vh;">
                <div class="col-3" style="background-color:	#DCDCDC;">
                    <ul class="list-unstyled" style="padding-top: 50px;">
                        <li data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample"><a
                                class="text-decoration-none text-dark dropdown-item " data-target="#collapseExample"
                                href="index.php?mod=thongtin&act=thongtin">Thông tin của tôi<i class="fa-solid fa-angle-down"></i></a></li>
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
                        <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=order">Đơn hàng </i></a></li>
                        <li><a class="text-decoration-none text-dark dropdown-item " href="#">Yêu cầu xóa tài khoản</a></li>

                    </ul>
                </div>
           
                <div class="col-9" style="padding-top: 30px; ">
        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
            <div class="sa-layout">
                <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
                <div class="sa-layout__content">
                    <div class="card table-responsive" style="height: 450px; overflow-y: auto;">
                            <?php
                                    if (isset($_SESSION['order'])) {
                                        foreach ($_SESSION['order'] as $item) {
                                            extract($item);
                                            echo'';
                                            echo'
                                            <form action="'.Base_url.'/order/detail_order/'.$madh.'" method="post">
                                                <div class="container">
                                                    <div class="row gach" style="padding-top: 40px;">
                                                        <div class="col-10">
                                                            <i class="font-weight-bold">Code orders:</i> <i style="letter-spacing: 1px;"> '.$madh.'</i>
                                                            <br>
                                                            <i class="font-weight-bold">Consignee information:</i> <i style="letter-spacing: 1px;">'.$hoten.', '.$sdt.', '.$diachichitiet.', '.$quan.', '.$tp.' </i>
                                                            <br>
                                                            <i class="font-weight-bold">Payment methods:</i> <i style="letter-spacing: 1px;">  '.$pttt.'</i>
                                                            <br>
                                                            <i class="font-weight-bold" >Order date:</i> <i style="letter-spacing: 1px;">'.$ngaydathang.'</i>
                                                            <input hidden name="madh" value="'.$madh.'">
                                                        </div>
                                                        <div class="col-2" style="padding-top: 40px;">
                                                            <button type="submit" name="order-detail" class="btn btn-outline-secondary">Xem</button><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>';
                                            echo'';
                                        }
                                    }
                                ?>
                    </div>
                </div>
            </div>
    </div>
</div>
            </div>
        </div>
    </body>
</div>

<?php
include_once("App/views/user/footer.php");
?>
<!-- <!?php foreach(get_orders() as $sp): ?>   
    <li>
        <a onclick="deleteProduct(<!?=$sp['madh']?>)" class="dropdown-item text-danger" href="#">Delete</a>
   </li>
<!?php endforeach; ?>
<script>
            function deleteProduct(id){
                var kq = confirm("Are you sure you want to delete this product?");
                if(kq){
                    window.location.search='?mod=thongtin&act=delete&id='+id; 
                }
            }
           </script> -->