      <!-- Trang nhập mã để xác nhận lấy lại mật khẩu -->

      <div class="container pb-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center font-weight-bold" style="font-size: 30px;">Forget password</div>
    
                    <div class="card-body">
                        <form action="" method="post" onsubmit="checkSign_in(event)">
                            <div class="form-group">
                                <label for="inputEmail">Insert code</label>
                                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Please enter the code I sent to your email">
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-dark" name="submit-signin" value="Submit">
                            </div>
                            <div class="form-group">
                            </div>
                            <?php
                               echo ''.$luutam.'';
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>