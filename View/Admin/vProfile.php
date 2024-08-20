<?php

include_once("Controller/cManagement.php");
$p = new controlManagement();
$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
$user  = $p->getUserById($idTaiKhoan);
$taiKhoan   = $p->getUsersDiffByIdTaiKhoan($idTaiKhoan);


$error = array();
if (isset($_POST['btn_pass'])) {
  $password = $_POST['password'];
  $newpassword = $_POST['newpassword'];
  $renewpassword = $_POST['renewpassword'];


  if ($password != $user['matKhau']) {
    $error['password'] = 'Mật khẩu nhập sai';
  } else {
    unset($error['password']);
  }
  if ($newpassword == $user['matKhau']) {
    $error['newpassword'] = 'Mật khẩu mới không được trùng với mật khẩu hiện tại!';
  } elseif (strlen($newpassword) < 6) {
    $error['newpassword'] = 'Mật khẩu phải có ít nhất 6 kí tự !';
  } else {
    unset($error['newpassword']);
  }

  if ($newpassword != $renewpassword) {
    $error['renewpassword'] = 'Mật khẩu không khớp';
  } else {
    unset($error['renewpassword']);
  }


  if (empty($error)) {
    $matKhau = $renewpassword;
    $pas = $p->ChangePassword($idTaiKhoan, $matKhau);
    if ($pas == 1) {
      echo '<script>alert("Thay đổi mật khẩu thành công. Vui lòng đăng nhập lại")</script> ';
      echo header("refresh: 0; url='index.php?mod=logout'");
    } else {
      echo '<script>alert("Không thể thay đổi mật khẩu")</script>';
    }
  }
}



if (isset($_REQUEST["btn_luu"])) {
  unset($error);


  if (empty($_REQUEST['hoten'])) {
    $error['empty']['hoten'] = 'Chưa nhập họ tên *';
  } else {
   // unset($error['empty']['hoten']);
  }
  if (empty($_REQUEST['sodt'])) {
    $error['empty']['phone'] = 'Chưa nhập số điện thoại *';
  } else {
    // unset($error['empty']['phone']);
  }
  if (empty($_REQUEST['email'])) {
    $error['empty']['email'] = 'Chưa nhập email *';
  } else {
   // unset($error['empty']['email']);
  }
  if (!(strlen($_REQUEST['sodt']) == 10)) {
    $error['phone']  = "Số điện thoại phải bắt đầu từ số 0 và có 10 số!";
  } else {
  //  unset($error['phone']);
  }
  $regexEmail = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
  if (!preg_match($regexEmail, $_REQUEST['email'], $matchs)) {
    $error['email']  = "Email không đúng định dạng!";
  } else {
 //   unset($error['email']);
  }
  $regexHoTen = "/^([A-Z][a-zÀ-ỹ]*\s)+[A-Z][a-zÀ-ỹ]*$/";
  if (!preg_match($regexHoTen, $_REQUEST['hoten'], $matchs)) {
    $error['fullname']  = "Họ tên phải có từ 2 chữ trở lên, mỗi từ phải viết hoa ký tự đầu!";
  } else {
  //  unset($error['fullName']);
  }
  foreach ($taiKhoan as $item) {

    if ($_REQUEST["sodt"] == $item['soDienThoai']) {
      $error['phone'] = 'Số điện thoại đã tồn tại !';
    } else {

   //   unset($error['phone']);
    }
    if ($_REQUEST["email"] == $item['email']) {
      $error['email'] = 'Email đã tồn tại !';
    }else {
   //   unset($error['email']);

    }
  }
}

?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Hồ sơ</h1>

  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="assets/imageProfile/<?php echo $user['hinhAnh'] ?>" alt="Profile" class="rounded-circle">
            <?php if (isset($_SESSION['is_login']['user_login'])) {
            ?>

              <h2> <?php echo  $_SESSION['is_login']['user_login']; ?> </h2>
              <h3> <?php echo   $_SESSION['is_login']['tenRole']; ?></h3>
            <?php } ?>

            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Tổng quan</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Chỉnh sửa hồ sơ</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Đổi mật khẩu</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">


                <h5 class="card-title">Chi tiết hồ sơ</h5>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Họ và tên</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['hoTen'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Mã nhân viên</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['maNhanVien'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Chức vụ</div>
                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['is_login']['tenRole'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Số điện thoại</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['soDienThoai'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['email'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Ngày đăng kí</div>
                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['is_login']['ngayTao'] ?></div>
                </div>



                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Tên đăng nhập</div>
                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['is_login']['tenDangNhap'] ?></div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Hình ảnh</label>
                    <div class="col-md-8 col-lg-9">
                      <img id="profileImage" src="assets/imageProfile/<?php echo $user['hinhAnh'] ?>" alt="Profile">

                      <img id="profileUser" src="assets/imageProfile/user.jpg" alt="Profile" style="display:none;">


                      <img id="imagePreview" src="#" alt="Ảnh preview" style="display:none; max-width: 120px; max-height: 117px;">

                      <div class="pt-2">

                        <label for="customFile" class="btn btn-secondary btn-sm text-light">
                          Cập nhật ảnh <i class="fas fa-upload"></i>
                        </label>
                        <input type="file" name="upfile" class="custom-file-input" id="customFile" style="display: none;" onchange="previewImage()">

                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ tên</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="hoten" type="text" class="form-control" id="fullName" value="<?php echo $user['hoTen'] ?>" onchange="validateFullName()">
                      <p class="text-danger" id="fullnameError"><?php if (!empty($error['empty']['fullName'])) {
                                                                  echo  $error['empty']['fullName'];
                                                                }
                                                                if (!empty($error['fullname'])) {
                                                                  echo $error['fullname'];
                                                                }  ?></p>
                    </div>
                  </div>



                  <div class="row mb-3" style="display: none;">
                    <label for="maNhanVien" class="col-md-4 col-lg-3 col-form-label">Mã nhân viên</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="manv" type="text" class="form-control" id="company" value="<?php echo $user['maNhanVien'] ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="soDT" class="col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="sodt" type="number" class="form-control" id="phone" value="<?php echo $user['soDienThoai'] ?>" onchange="validatePhone()">
                      <p class="text-danger" id="errsdt"><?php if (!empty($error['empty']['phone'])) {
                                                            echo  $error['empty']['phone'];
                                                          } elseif (!empty($error['phone'])) {
                                                            echo  $error['phone'];
                                                          }   ?></p>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email" value="<?php echo $user['email'] ?>" onchange="validateEmail()">
                      <p class="text-danger" id="erremail"><?php if (!empty($error['empty']['email'])) {
                                                              echo  $error['empty']['email'];
                                                            } elseif (!empty($error['email'])) {
                                                              echo  $error['email'];
                                                            }   ?></p>
                    </div>
                  </div>


                  <input name="old_img" type="hidden" class="form-control" id="Country" value="<?php echo $user['hinhAnh'] ?>">
                  <div class="text-center">
                    <input class="btn btn-primary " type="submit" value="Lưu thay đổi" name="btn_luu">

                  </div>
                </form><!-- End Profile Edit Form -->

              </div>


              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="" method="post">

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mật khẩu hiện tại</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword" required onblur="validateCurrentPassword()">
                      <span class="text-danger"> <?php
                                                  if (!empty($error['password'])) {
                                                    echo '<i class="bi bi-exclamation-circle"></i>' . $error['password'];
                                                  } ?></span>
                      <p class="text-danger" id="errCurrentPassword"><?php if (!empty($error['currentPassword'])) {
                                                                        echo  $error['currentPassword'];
                                                                      }   ?></p>

                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Mật khẩu mới</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword" required onblur="validateNewPassword()">
                      <p class="text-danger" id="errNewPassword"><?php if (!empty($error['newpassword'])) {
                                                                    echo  $error['newpassword'];
                                                                  }    ?></p>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Nhập lại mật khẩu mới</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword" required onblur="validateReNewPassword()">
                      <span class="text-danger"> <?php if (!empty($error['renewpassword'])) {
                                                    echo '<i class="bi bi-exclamation-circle"></i>' .  $error['renewpassword'];
                                                  } ?></span>
                      <p class="text-danger" id="errReNewPassword"><?php if (!empty($error['renewpassword'])) {
                                                                      echo  $error['renewpassword'];
                                                                    }    ?></p>
                    </div>

                  </div>

                  <div class="text-center">
                    <input class="btn btn-primary" type="submit" value="Đổi mật khẩu" name="btn_pass">

                  </div>
                </form>

              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>



<?php
if (isset($_REQUEST["btn_luu"])) {
  if (empty($error)) {
    $maNhanVien = $_REQUEST["manv"];

    $hoTen = $_REQUEST["hoten"];
    $soDienThoai = $_REQUEST["sodt"];
    $email = $_REQUEST["email"];
    $matKhau = $user['matKhau'];
    $Role = $user['Role'];
    if ($_FILES["upfile"]["name"] != '') {
      $tmpimg = $_FILES["upfile"]["tmp_name"];
      $typeimg = $_FILES["upfile"]["type"];
      $hinhAnh = $_FILES["upfile"]["name"];
      $sizeimg = $_FILES["upfile"]["size"];
    } else {
      $hinhAnh = $_REQUEST['old_img'];
      $tmpimg = '';
      $typeimg = '';
      $sizeimg = '';
    }



    $p = new controlManagement();
    $kq = $p->UpdateUser($idTaiKhoan, $matKhau, $maNhanVien, $hoTen, $soDienThoai, $email, $hinhAnh, $Role, $tmpimg, $typeimg, $sizeimg);
    if ($kq == 1) {
      echo '<script>alert("Cập nhật thông tin cá nhân thành công")</script> ';
      echo header("refresh: 0; url='admin.php?mod=Profile'");
    } elseif ($kq == 0) {
      echo '<script>alert("Không thể sửa nhân viên")</script>';
    } elseif ($kq == -1) {
      echo '<script>alert("Không thể Upload ảnh")</script>';
    } elseif ($kq == -2) {
      echo '<script>alert("File lỗi")</script>';
    } else {
      echo "Lỗi";
    }
  }
}


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/admin/js/Profile.js"></script>

<script>
  // Your JavaScript code here
  document.getElementById('removeImageBtn').addEventListener('click', function() {
    // Hide the profileImage and imagePreview
    document.getElementById('profileImage').style.display = 'none';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('profileUser').style.display = 'block';

  });

  function validateFullName() {
    let name = document.getElementById('fullName').value;
    var errorElement = document.getElementById("fullnameError");
    let patten = /^([A-Z]{1}[a-z][a-zA-ZÀ-ỹ]*\s)+([A-Z]{1}[a-z][a-zA-ZÀ-ỹ]*)$/;
    if (!name) {
      errorElement.textContent = "Họ tên không được để trống!";
    } else if (!patten.test(name)) {
      errorElement.textContent = "Họ tên phải có từ 2 chữ trở lên, mỗi từ phải viết hoa ký tự đầu!";
    } else {
      errorElement.textContent = "";
    }
  }


  function validatePhone() {
    let sdt = document.getElementById('phone').value;
    var errorElement = document.getElementById("errsdt");
    let patten = /^0\d{9}$/
    if (!sdt) {
      errorElement.textContent = "Số điện thoại không được để trống!";
    } else if (!patten.test(sdt)) {
      errorElement.textContent = "Số điện thoại phải bắt đầu từ số 0 và có 10 số !";
    } else {
      errorElement.textContent = "";
    }
  }


  function validateEmail() {
    var email = document.getElementById("email").value;
    var errorElement = document.getElementById("erremail");
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
      errorElement.textContent = "Không được để email trống!";
    } else if (!emailRegex.test(email)) {
      errorElement.textContent = "Email chưa đúng định dạng !";
    } else {
      errorElement.textContent = "";
    }
  }


  function validateCurrentPassword() {
    var ps = document.getElementById("currentPassword").value;
    var errorElement = document.getElementById("errCurrentPassword");
    if (!ps) {
      errorElement.textContent = "Không được để trống mục này!";
    } else {
      errorElement.textContent = "";
    }
  }


  function validateNewPassword() {
    var np = document.getElementById("newPassword").value;
    var ps = document.getElementById("currentPassword").value;
    var errorElement = document.getElementById("errNewPassword");
    if (!np) {
      errorElement.textContent = "Không được để trống mục này!";
    } else if (np === ps) {
      errorElement.textContent = "Mật khẩu mới không được trùng với mật khẩu hiện tại!";
    } else {
      errorElement.textContent = "";
    }

    var password = document.getElementById("newPassword").value;
    var errorElement = document.getElementById("errNewPassword");
    if (password.length < 6) {
      errorElement.textContent = "Mật khẩu phải có ít nhất 6 kí tự !";
    } else {
      errorElement.textContent = "";
    }
  }


  function validateReNewPassword() {
    var rn = document.getElementById("renewPassword").value;
    var np = document.getElementById("newPassword").value;
    var errorElement = document.getElementById("errReNewPassword");
    if (!rn) {
      errorElement.textContent = "Không được để trống mục này!";
    } else if (!(rn === np)) {
      errorElement.textContent = "Bạn nhập lại mật khẩu không khớp với mật khẩu mới!";
    } else {
      errorElement.textContent = "";
    }
  }
</script>
