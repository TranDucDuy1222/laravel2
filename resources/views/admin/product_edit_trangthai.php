<form action="" method="post" enctype="multipart/form-data">
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">
                <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                    <div class="container">
                        <div class="py-5">
                            <div class="row g-4 align-items-center">
                                <div class="col">
                                    <h1 class="h3 m-0">Status</h1>
                                </div>
                                <div class="col-auto d-flex">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                </div>
                            </div>
                        </div>
                        <div class="sa-entity-layout"
                            data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
                            <div class="sa-entity-layout__body">
                                <div class="sa-entity-layout__main">
                                    <div class="card">
                               
                <div>
    <div class="card-body p-5">
        <div class="mb-5">
            <h2 class="mb-0 fs-exact-18">Inventory</h2>
        </div>
        <div>
            <label for="form-product/quantity" class="form-label">
            Status
            </label>

            <?php
            if ($data['sp']['trangthai'] == 1) {
                echo '<div type="submit" class="form-control alert alert-success" id="form-product/quantity" name="trangthai">Stocking</div>';
            } elseif ($data['sp']['trangthai'] == 2) {
                echo '<div class="alert alert-success" role="alert">Out of stock</div>';
            } elseif ($data['sp']['trangthai'] == 3) {
                echo '<div class="alert alert-danger" role="alert">Stop selling</div>';
            }
            ?>
        </div>
    </div>
</div>
                                   
                                    <div class="card w-100 mt-5">
                                        <div class="card-body p-5">
                                            <div class="mb-5">
                                                <h2 class="mb-0 fs-exact-18">Status change</h2>
                                            </div>
                                            <select class="form-control" name="trangthai" >
                                                <option value="1">Stocking</option>
                                                <option value="2">Out of stock</option>
                                                <option value="3">Stop selling</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>
                
                    </div>
                </div>
            </div>
            </div>
            <!-- sa-app__body / end -->
</form>