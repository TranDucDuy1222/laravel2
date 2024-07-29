<?php
include_once("app/views/user/head.php");
include_once("app/views/user/header.php");
?>
       <!-- đăng ký -->
       <div class="container pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="text-center card-header font-weight-bold" style="font-size: 30px;">SIGN UP</div>
            <div class="card-body">
            <form method="post" action="" onsubmit="checkSign_up(event)">
                <div class="form-group">
                    <label for="inputName">First and last name</label>
                    <input type="text" class="form-control" id="inputName" name="hoten" placeholder="Please enter your full name">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Your email</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="please enter email address">
                </div>
                <div class="form-group">
                    <label for="inputNgaySinh">Date of birth</label>
                    <input type="date" class="form-control" id="inputNgaySinh" name="ngaysinh">
                </div>
                <div class="form-group">
                    <label for="inputPassword">password</label>
                    <input type="password" class="form-control" id="inputPassword" name="matkhau" placeholder="Please enter a password">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Enter the password</label>
                    <input type="password" class="form-control" id="inputPassword2" name="matkhau" placeholder="Please enter a password">
                </div>
                <!-- <div class="form-group">
                    <label for="inputConfirmPassword">Xác nhận mật khẩu:</label>
                    <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Xác nhận mật khẩu" required>
                </div> -->
                <div class="d-flex justify-content-center">
                    <input type="submit" name="submit-signup" class="btn btn-dark" value="Sign Up">
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once("app/views/user/footer.php");
?>
<script>
    function checkSign_up(event){
        var hoten =document.getElementById('inputName').value;
        var email = document.getElementById('inputEmail').value;
        var ngaysinh = document.getElementById('inputNgaySinh').value;
        var matkhau = document.getElementById('inputPassword').value;
        var matkhau2 = document.getElementById('inputPassword2').value;
        // Kiểm tra tuổi
    var today = new Date();
    var birthDate = new Date(ngaysinh);
    var age = today.getFullYear() - birthDate.getFullYear();
// ho ten
        if(hoten==''){
            alert("You haven't entered your full name yet, please enter your full name!");
            event.preventDefault();
            return;
        }
        if(!isNaN(hoten)){
      alert('Full name must not contain a number, please re-enter full name!');
        event.preventDefault();
        return;
        /*/\d/.test(hoten) không được nhập số*/
        }
        if(/[!@#$%^&*(),;.?":{}|<>''"*+\-_/]/.test(hoten)){
        alert('Full name cannot contain special characters, please re-enter full name!');
        event.preventDefault();
        return;
        }
        if(email==''){
            alert("You haven't entered your email yet, please enter your email!");
            event.preventDefault();
            return;
        }
        if(ngaysinh==''){
            alert("You have not entered your date of birth, please enter your date of birth!");
            event.preventDefault();
            return;
        }
        if(age < 15 || age > 100){
        alert('Your age is too young to register!');
        event.preventDefault();
        return;
    }
    
        if(matkhau==''){
            alert("You haven't entered your password yet, please enter your password!");
            event.preventDefault();
            return;
        }
        if(matkhau.length<5){
            alert("Your password is too short! Please be longer than 5 characters!");
            event.preventDefault();
            return;
        }
        if(matkhau2!=matkhau){
            alert('Your confirmation password is incorrect, please re-enter!');
            event.preventDefault();
            return;
        }
// email
    }
</script>