<form action="" method="post" enctype="multipart/form-data">
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">
                <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                    <div class="container">
                        <div class="py-5">
                            <div class="row g-4 align-items-center">
                                <div class="col">
                                    <h1 class="h3 m-0">Add Product</h1>
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
                                        <div class="card-body p-5">
                                            <div class="mb-5">
                                                <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                            </div>
                                            <div class="mb-4">
                                                <label for="form-product/name" class="form-label">Name</label><input
                                                    type="text" class="form-control" id="form-product/name"
                                                    name="hoten" />
                                            </div>
                                            <div class="mb-4">
                                                <label for="form-product/name" class="form-label">Password</label><input
                                                    type="text" class="form-control" id="form-product/name"
                                                    name="matkhau" />
                                            </div>
                                            <div class="mb-4">
                                                <label for="form-product/name" class="form-label">Email</label><input
                                                    type="text" class="form-control" id="form-product/name"
                                                    name="email" />
                                            </div>
                                            <div class="mb-4">
                                                <label for="form-product/name" class="form-label">Phone number</label><input
                                                    type="text" class="form-control" id="form-product/name"
                                                    name="sodienthoai" />
                                            </div>
                                            <div class="mb-4">
                                                <label for="form-product/name" class="form-label">Address</label><input
                                                    type="text" class="form-control" id="form-product/name"
                                                    name="diachi" />
                                            </div>
                                            <div class="card w-100 mt-5">
                                        <div class="card-body p-5">
                                            <div class="mb-5">
                                                <h2 class="mb-0 fs-exact-18">Permission</h2>
                                            </div>
                                            <select class="sa-select2 form-select " name="quyen">
                                                <?php foreach($data['dsaccount'] as $tk):?>
                                                    <option value="<?=$tk['quyen']?>">
                                                        <?=$tk['quyen']?>
                                                    </option>
                                                <?php endforeach; ?>
                                                
                                                <!-- <option value="2">giày</option> -->
                                            </select>
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                <div class="sa-entity-layout__sidebar">
                                    <div class="card">
                                        <div class="card-body p-5">
                                            <div class="mb-5">
                                                <h2 class="mb-0 fs-exact-18">Images</h2>
                                            </div>
                                        </div>
                                        <div class="mt-n5">
                                            <input type="file" class="form-controller" name="anhtk">
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
</form>
           
          