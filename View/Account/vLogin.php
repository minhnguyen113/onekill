<?php
include_once("Controller/cLogin.php");

include_once("Controller/cManagement.php");
$user = new controlLogin();
$p = new controlManagement();

$TK = $user->getAllUser();


$fail = array();

if (isset($_REQUEST['btn_login'])) {
    unset($fail['fail']);
    $username =  $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $tblUser = $user->getAllLogin($username, $password);



    if ($tblUser  == 1) {

      
        $ngay_hien_tai = date('Y-m-d');

        // Lấy mã số ngày trong tuần (1 là thứ 2, 7 là Chủ Nhật)
        $ngay_trong_tuan = date('N', strtotime($ngay_hien_tai));
    
        if ($ngay_trong_tuan >= 5) {
          // Nếu hôm nay là thứ 6, thứ 7 hoặc Chủ Nhật, lấy ngày của thứ 2 tuần tiếp theo
          $ngay_ngay_mai = date('Y-m-d', strtotime('next Monday', strtotime($ngay_hien_tai)));
        } else {
          // Ngược lại, lấy ngày tiếp theo sau 1 ngày
          $ngay_ngay_mai = date('Y-m-d', strtotime('+1 day', strtotime($ngay_hien_tai)));
        }
        header("refresh: 0; url='index.php?mod=Dish&act=list&date=$ngay_ngay_mai");
        unset($fail['fail']);
    } else {
        $fail['fail'] = 'Tên đăng nhập hoặc mật khẩu sai !';
    }
}

if (isset($_POST['btn_forgot'])) {
    foreach ($TK as $item) {
        if ($_POST['manv'] == $item['maNhanVien'] && $_POST['email'] == $item['email']) {
            $email = $_POST['email'];
            $maNhanVien = $_POST['manv'];
            $ac = $user->getUserByEmailMaNV($email, $maNhanVien);
            $emailSuccess = $ac[0]['email'];
            $maNhanVienSuccess =  $ac[0]['maNhanVien'];
            $hoTenSuccess =  $ac[0]['hoTen'];
            $idTaiKhoanSuccess =  $ac[0]['idTaiKhoan'];

            

        
            require 'sendmailPas.php';

            unset($fail['check']);
         echo header("refresh: 0; url='index.php?mod=ConfirmEmail");

            break;
        } else {
            $fail['check'] = 'Mã nhân viên hoặc email sai!';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post">
                <h1>Quên mật khẩu</h1>
                <input type="text" placeholder="Mã nhân viên" name="manv" required>

                <input type="email" placeholder="Email" name="email" required>
                <p class="text-danger"><?php if (isset($fail['check'])) {
                                            echo $fail['check'];
                                        } ?></p>

                <input type="submit" value="Gửi yêu cầu" class="form-submit" name="btn_forgot">

            </form>
        </div>
        <div class="form-container sign-in-container">

            <form action="" id="form-login" method="post">
                <h1 class="form-heading">ĐĂNG NHẬP</h1>

                <div class="form-group">
                    <i class="far fa-user"></i>
                    <input type="text" class="form-input" placeholder="Tên đăng nhập" name="username" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input type="password" class="form-input" placeholder="Mật khẩu" name="password" required>
                    <div id="eye">
                        <i class="far fa-eye"></i>
                    </div>
                </div>

                <p style="color: red;"><?php if (isset($fail['fail'])) {
                                            echo $fail['fail'];
                                        } ?></p>
                <input type="submit" value="Đăng nhập" class="form-submit" name="btn_login">
            </form>




        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Xin chào !</h1>
                    <p>Chào mừng bạn đến với bếp ăn của chúng tôi</p>
                    <button id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Xin chào !</h1>
                    <p>Chào mừng bạn đến với bếp ăn của chúng tôi</p>
                    <button type="button" class="btn btn-secondary" id="signUp">Quên mật khẩu</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="assets/js/login.js"></script>

</html>
<!-- Add the following script to the end of your HTML file -->
<script>
    // Check if there is a stored state in sessionStorage
    const currentState = sessionStorage.getItem('currentPanel');

    // If there is a stored state, set the appropriate panel to be displayed
    if (currentState === 'signUp') {
        showSignUpPanel();
    } else {
        showSignInPanel();
    }

    // Function to show the sign up panel
    function showSignUpPanel() {
        document.getElementById('container').classList.add('right-panel-active');
    }

    // Function to show the sign in panel
    function showSignInPanel() {
        document.getElementById('container').classList.remove('right-panel-active');
    }

    // Event listener for the "Quên mật khẩu" button
    document.getElementById('signUp').addEventListener('click', function() {
        showSignUpPanel();
        // Store the current state in sessionStorage
        sessionStorage.setItem('currentPanel', 'signUp');
    });

    // Event listener for the "Đăng nhập" button
    document.getElementById('signIn').addEventListener('click', function() {
        showSignInPanel();
        // Store the current state in sessionStorage
        sessionStorage.setItem('currentPanel', 'signIn');
    });
</script>