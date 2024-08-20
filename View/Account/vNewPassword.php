<?php


include_once("Controller/cManagement.php");

$p = new controlManagement();



?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tạo mật khẩu mới</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  body {
    background: #1abc9c;
    overflow: hidden;
  }

  ::selection {
    background: rgba(26, 188, 156, 0.3);
  }

  .container {
    max-width: 440px;
    padding: 0 20px;
    margin: 170px auto;
  }

  .wrapper {
    width: 100%;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.1);
  }

  .wrapper .title {
    height: 90px;
    background: #16a085;
    border-radius: 5px 5px 0 0;
    color: #fff;
    font-size: 30px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .wrapper form {
    padding: 30px 25px 25px 25px;
  }

  .wrapper form .row {
    height: 45px;
    margin-bottom: 15px;
    position: relative;
  }

  .wrapper form .row input {
    height: 100%;
    width: 100%;
    outline: none;
    padding-left: 60px;
    border-radius: 5px;
    border: 1px solid lightgrey;
    font-size: 16px;
    transition: all 0.3s ease;
  }

  form .row input:focus {
    border-color: #16a085;
    box-shadow: inset 0px 0px 2px 2px rgba(26, 188, 156, 0.25);
  }

  form .row input::placeholder {
    color: #999;
  }

  .wrapper form .row i {
    position: absolute;
    width: 47px;
    height: 100%;
    color: #fff;
    font-size: 18px;
    background: #16a085;
    border: 1px solid #16a085;
    border-radius: 5px 0 0 5px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .wrapper form .pass {
    margin: -8px 0 20px 0;
  }

  .wrapper form .pass a {
    color: #16a085;
    font-size: 17px;
    text-decoration: none;
  }

  .wrapper form .pass a:hover {
    text-decoration: underline;
  }

  .wrapper form .button input {
    color: #fff;
    font-size: 20px;
    font-weight: 500;
    padding-left: 0px;
    background: #16a085;
    border: 1px solid #16a085;
    cursor: pointer;
  }

  form .button input:hover {
    background: #12876f;
  }

  .wrapper form .signup-link {
    text-align: center;
    margin-top: 20px;
    font-size: 17px;
  }

  .wrapper form .signup-link a {
    color: #16a085;
    text-decoration: none;
  }

  form .signup-link a:hover {
    text-decoration: underline;
  }


  .error-message {
    color: red;

  }
</style>

<body>
  <div class="container">
    <div class="wrapper">
      <div class="title"><span>Tạo mật khẩu mới</span></div>
      <form action="" method="post">
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Nhập mật khẩu mới" name="newpassword" id="newpassword" required  oninput="validatePassword()">
          <p style="color: red;" id="passwordError"></p>
        </div><br>
        <div class="row" >
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Nhập lại mật khẩu mới" name="repassword" id="repassword" required>
        </div>
        <p class="error-message" id="error-message"></p><br>
        <div class="row button">
          <input type="submit" value="Xác nhận" name="btn-xn">
        </div>

      </form>
    </div>
  </div>

</body>

</html>
<script>
  document.getElementById('repassword').addEventListener('input', function() {
    var newPassword = document.getElementById('newpassword').value;
    var confirmPassword = this.value;
    var errorMessage = document.getElementById('error-message');

    if (newPassword != confirmPassword) {
      errorMessage.textContent = 'Mật khẩu không khớp !';
    } else {
      errorMessage.textContent = '';
    }
  });
</script>
<?php
if (isset($_POST['btn-xn'])) {
  $newpassword = $_POST['newpassword'];
  $repassword = $_POST['repassword'];

  if ($newpassword == $repassword && $repassword != '') {
    $matKhau = $repassword;
    $idTaiKhoan = $_GET['idTaiKhoan'];
    $changer = $p->ChangePassword($idTaiKhoan, $matKhau);
    if ($changer == 1) {
      echo '<script>alert("Cập nhật mật khẩu mới thành công")</script>';
      echo header("refresh: 0; url='index.php?mod=login'");
    } else {
      echo '<script>alert("Cập nhật mật khẩu mới thất bại")</script>';
    }
  }
}



?>

<script>
   

    function validatePassword() {
        var password = document.getElementById("newpassword").value;
        var errorElement = document.getElementById("passwordError");
        if (password.length < 6) {
            errorElement.textContent = "Mật khẩu phải có ít nhất 6 kí tự !";
        } else {
            errorElement.textContent = "";
        }
    }

   
</script>