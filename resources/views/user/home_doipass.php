
<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">personal information</h2>
<div class="row" style="padding-bottom: 50px;  padding-top: 20px; margin-left: 0; margin-right: 0;">
    
    <body style=" background-color: #F5F5F5;">
        <div class="col-8 container" >
               <div class="row" style="border: 1px solid #DCDCDC; height: 70vh;">
                    <div class="col-3" style="background-color:	#DCDCDC;">
                        <ul class="list-unstyled" style="padding-top: 50px;">
                        <li   data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample"><a class="text-decoration-none text-dark dropdown-item " data-target="#collapseExample" href="index.php?mod=thongtin&act=thongtin">My profile</a></li>
                              <div class="collapse" id="collapseExample">
                                    <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=doipass&id=<?=$sp['matk']?>">Change Password</a></li>
                                    <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=doisdt&id=<?=$sp['matk']?>">Change phone number</a></li>
                                    <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=doiten&id=<?=$sp['matk']?>">Change username</a></li>
                              </div>
                            <li><a class="text-decoration-none text-dark dropdown-item " href="#">Purchased order</a></li>
                            <li><a class="text-decoration-none text-dark dropdown-item " href="#">Request account deletion</a></li>

                        </ul>
                    </div>
                    <div class="col-9">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- sa-app__body -->
                        <div id="top" class="sa-app__body">
                                       <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                                           <div class="container">
                                               <div class="sa-entity-layout"
                                                   data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
                                                   <div class="sa-entity-layout__body">
                                                       <div class="sa-entity-layout__main">
                                                           <div class="card">
                                                           </div>
                                                           <div class="card mt-5">
                                                    <div class="card-body p-5">
                                                        <div>
                                                            <label for="form-product/short-description"
                                                                class="form-label font-weight-bold" style="letter-spacing: 1px; font-size: 18px;">Enter your new password</label>
                                                            <textarea id="form-product/short-description"
                                                                class="form-control" rows="2" name="matkhau"><?=$data['account']['matkhau']?></textarea>
                                                            <div style="padding-left: 85%; padding-top: 10px;">
                                                                <input type="submit"
                                                                    class="btn btn-outline-secondary" name="submit"
                                                                    value="Save">
                                                            </div>
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
                                  
                                 
                    </div>
                     </div>
            </div>
    </body>
</div>

</form>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var passwordField = document.getElementById('passwordField');
        var togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            // Toggle giữa kiểu 'password' và 'text'
            passwordField.type = (passwordField.type === 'password') ? 'text' : 'password';
            // Toggle giữa biểu tượng mắt mở và đóng
            togglePassword.innerText = (passwordField.type === 'password') ? '👁️‍🗨️' : '👁️‍🗨️';
        });
    });
</script> 