<?php
include_once("App/views/admin/template_admin_head.php");
include_once("App/views/admin/template_admin_header.php");
?>
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">
                <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                    <div class="container">
                        <div class="py-5">
                            <div class="row g-4 align-items-center">
                                <div class="col">
                                    <h1 class="h3 m-0">Edit order</h1>
                                </div>

                                        </div>
                                    </div>
                                    <div class="sa-entity-layout"
                                        data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
                                        <div class="sa-entity-layout__body">
                                        <div class="sa-entity-layout__main">
                                            <div class="card">
                                                <div class="card-body p-5">
                                                    <div id="trangthaidh">
                                                        <label>Trạng thái :</label>
                                                            <button id="select_tt" value="3">Chờ vận chuyển</button>
                                                            <button id="select_tt" value="4">Đã gởi hàng</button>
                                                            <button id="select_tt" value="5">Đang giao hàng</button>
                                                            <!-- <a href="<?=Base_url?>/admin/order_admin/edit/3" id="select_tt" >Chờ vận chuyển</a>
                                                            <a href="<?=Base_url?>/admin/order_admin/edit/4" id="select_tt" >Đã gởi hàng</a>
                                                            <a href="<?=Base_url?>/admin/order_admin/edit/5" id="select_tt" >Đang giao hàng</a>
                                                            <a href="<?=Base_url?>/admin/order_admin/6" id="select_tt" >Đã giao hàng</a>
                                                            <a href="<?=Base_url?>/admin/order_admin/8" id="select_tt" >Đã đánh giá</a> -->
                                                    </div>
                                                    <br>
                                                    <?php
                                                    $show_tt_ht = '';
                                                        //var_dump($data["trangthai_ht"]);
                                                        foreach ($data["trangthai_ht"] as $item) {
                                                            $key = $item['matrangthai'];
                                                            if ($key == 1) {
                                                                $show_tt_ht = 'Chờ xử lý';
                                                            }elseif ($key == 3) {
                                                                $show_tt_ht = 'Chờ đơn vị vận chuyển';
                                                            }elseif ($key  == 4) {
                                                                $show_tt_ht = 'Đã gởi hàng';
                                                            }elseif ($key  == 5) {
                                                                $show_tt_ht = 'Đang giao hàng';
                                                            }elseif ($key  == 6) {
                                                                $show_tt_ht = 'Đã giao hàng';
                                                            }elseif ($key  == 7) {
                                                                $show_tt_ht = 'Đã đánh giá';
                                                            }elseif ($key  == 8) {
                                                                $show_tt_ht = 'Đã hủy';
                                                            }

                                                        }
                                                    echo '';    
                                                    ?>
                                                    <p style="font-size: 20px; color: red;" >Trạng thái hiện tại : <?=$show_tt_ht?></p> 
                                                    <form method="post">
                                                        <div class="col-auto d-flex">
                                                            <input type="hidden" name="update_tt_order" value="">
                                                            <input type="submit" class="btn btn-primary" name="edit_detail" value="Save">
                                                        </div>
                                                    </form>                   
                                            </div>
                                            </div>
                                            <div class="card mt-5">
                                            <div class="card-body p-5">
                                            <div>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Name product</th>
                                                <th>Quanlity</th>
                                                <th>Price</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Total amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $tong = 0;
                                    $order_detail = $data['order_detail'];
                                    if (isset($order_detail)) {
                                        //var_dump($data['order']);
                                        foreach ($order_detail as $ctsp) {
                                            $tong = $ctsp['giasp'] * $ctsp['soluong'];
                                            echo'<tr>';
                                            echo'<td>
                                                <p class="me-4">
                                                    <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                                        <img src="'.Base_url.'/public/img/' .$ctsp['anhsp']. '" alt="Sản phẩm ' .$ctsp['madh']. '" width="40" height="40" />
                                                    </div>
                                                </p>
                                                <div>
                                                    <h6 class="text-reset">' .$ctsp['tensp']. '</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            
                                                <span class="sa-price__integer">' .$ctsp['soluong']. '</span>
                                           
                                        </td>
                                        <td>
                                            <div class="sa-price">
                                                <span class="sa-price__integer">' .$ctsp['giasp']. '</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="sa-price">
                                                <span class="sa-price__integer">' .$ctsp['color']. '</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="sa-price">
                                                <span class="sa-price__integer">' .$ctsp['size']. '</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="sa-price">
                                                <span class="sa-price__integer">' . $tong. '</span>
                                            </div>
                                        </td>
                                       ';
                                       echo '</tr>';
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- sa-app__body / end -->

<?php
include_once("App/views/admin/template_admin_footer.php");
?>
<script src="<?php echo Base_url;?>/public/js/change_tt.js"></script>