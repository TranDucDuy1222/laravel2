
            <!-- sa-app__body -->
            <div id="top" class="sa-app__body">
                <div class="mx-xxl-3 px-4 px-sm-5">
                    <div class="py-5">
                        <div class="row g-4 align-items-center">
                            <div class="col">
                                <h1 class="h3 m-0">Order details</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
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
                                            <th>ID detail</th>
                                            <th>Category</th>
                                            <th>Quanlity</th>
                                            <th class="w-min"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data['dsdetail'] as $sp): ?>   
                                            <tr>
                                            <td><input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block"
                                                    aria-label="..." /></td>

                                            <td>
                                                <div class=" "><?=$sp['mactdh']?></div>
                                            </td>
                                                   
                                            <td>
                                                <div><?=$sp['madh']?></div>
                                            </td>
                                            <td>
                                                <div><?=$sp['matk']?></div>
                                            </td>

                                            <div class="card w-100 mt-5">
                                        <div class="card-body p-5">
                                            <div class="mb-5">
                                        
                                                <h2 class="mb-0 fs-exact-18">Status</h2>
                                            </div>
                                            <select class="sa-select2 form-select " name="matt">
                                                <?php foreach($data['dstrangthai'] as $tt):?>
                                                    
                                                    <option  value="<?=$tt['matt']?>">
                                                        <?=$tt['trangthai']?>
                                                    </option>
                                                <?php endforeach; ?>
                                                
                                                <!-- <option value="2">giày</option> -->
                                            </select>
                                        </div>
                                    </div>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sa-app__body / end -->
           <script>
            function deleteProduct(id){
                var kq = confirm("Are you sure you want to delete this product?");
                if(kq){
                    window.location.search='?mod=product&act=delete&id='+id; 
                }
            }
           </script>
