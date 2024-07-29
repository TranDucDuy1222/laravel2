<?php foreach($data['dstk'] as $sp): ?>   
<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">personal information</h2>
<div class="row" style="padding-bottom: 50px;  padding-top: 20px; margin-left: 0; margin-right: 0;">
    
    <body style=" background-color: #F5F5F5;">
        <div class="col-8 container" >
               <div class="row" style="border: 1px solid #DCDCDC; height: 70vh;">
                    <div class="col-3" style="background-color:	#DCDCDC;">
                        <ul class="list-unstyled" style="padding-top: 50px;">
                        <li><a class="text-decoration-none text-dark dropdown-item " data-target="#collapseExample"   data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">My profile</a></li>
                              <div class="collapse" id="collapseExample">
                                    <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=xndoipass&id=<?=$sp['matk']?>">Change Password</a></li>
                                    <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=doisdt&id=<?=$sp['matk']?>">Change phone number</a></li>
                                    <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=doiten&id=<?=$sp['matk']?>">Change username</a></li>
                                    <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=doigmail&id=<?=$sp['matk']?>">Change Gmail</a></li>
                              </div>
                          <li><a class="text-decoration-none text-dark dropdown-item " href="index.php?mod=thongtin&act=order">Purchased order</a></li>
                            <li><a class="text-decoration-none text-dark dropdown-item " href="#">Request account deletion</a></li>

                        </ul>
                    </div>
                    <div class="col-9">
                        <div style="padding-top: 30px; padding-left: 30px;">
                            <div style="display: flex;">
                            <img style="border-radius: 50%;" src="upload/product/<?=$sp['anhtk']?>" width="100" height="100" alt="" />
                        <div style="padding-top: 15px; padding-left: 15px;">
                            <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Username: </span> 
                        <a><?=$sp['hoten']?></a>
                        <br>
                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">ID: </span>
                        <a><?=$sp['matk']?></a>
                        </div>
                        </div>
                        <br>
                        <br>
                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Gmail: </span>
                        <a><?=$sp['email']?></a>
                        <br>
                        <br>
                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Phone number: </span>
                        <a><?=$sp['sodienthoai']?></a>
                        <br>
                        <br>
                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Date of birth: </span>
                        <a><?=$sp['ngaysinh']?></a>
                        <br>
                        <br>
                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Registration Date: </span>
                        <a><?=$sp['ngaydangky']?></a>
                        </div>
                    </div>
                     </div>
            </div>
    </body>
</div>
<?php endforeach; ?>
<!-- 
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
</script>  -->