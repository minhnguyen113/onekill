<?php


include_once("Controller/cCart.php");
include_once("Controller/cDish.php");
include_once("Controller/cManagement.php");
include_once("Controller/cStatistic.php");

$cart = new controlCart();
$p = new controlDish();

$sta = new ControlStatistic();

$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];


$list_buy = $cart->getAllCartByIdTaiKhoan($idTaiKhoan);

$list_loai  = $p->getAllLoaiMonAn();
$thongbao =  $sta->getThongBao($trangThaiXem = '', $idTaiKhoan);
$soLuongThongBao =  $sta->getThongBao(0, $idTaiKhoan);
$hopThu = $sta->getHopThu($trangThaiXem = '', $idTaiKhoan);
$soLuongHopThu = $sta->getHopThu(0, $idTaiKhoan);


$mn = new controlManagement();
$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
$user  = $mn->getUserById($idTaiKhoan);





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OneKill</title>




  <link href="assets/admin/img/favicon.png" rel="icon">
  <link href="assets/admin/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>



  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Css Styles -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="assets/css/nice-select.css" type="text/css">
  <link rel="stylesheet" href="assets/css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <link rel="stylesheet" href="assets/css/dish.css" type="text/css">
  <link href="assets/admin/css/style.css" rel="stylesheet">
  <link href="assets/admin/css/Menu.css" rel="stylesheet">
  <link href="assets/admin/css/Menu.css" rel="stylesheet">




</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <?php


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

    ?>
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php?mod=Dish&act=list&date=<?php echo $ngay_ngay_mai  ?>" class="logo d-flex align-items-center">
        <img src="assets/admin/img/logo.png" alt="">
        <span class="d-none d-lg-block">ONEKILL</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>


    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>

        <div class="header__cart" style="margin-right: -10px;">
          <li class="mt-2">

            <a href="index.php?mod=Order&act=ListOrderUser" style="font-weight: 1000; color: #000e96e3;"><b>ĐƠN ĐẶT</b></a>
          </li>
          <li class="mt-2">
            <a href="index.php?mod=Order&act=ListInvoice" style="font-weight: 1000; color: #000e96e3;"><b>HÓA ĐƠN</b></a>
          </li>
          <li class="cart">
            <?php
            $tongCong = 0;
            $soLuong = 0;
            if (!empty($list_buy)) {
              foreach ($list_buy as $item) {
                $tongCong += $item['soLuong'] * $item['gia'];
                $soLuong += $item['soLuong'];
              }
            }
            ?>
            <a style="color: #000e96e3;" href="index.php?mod=cart"><i style="font-size: 24px;" class="bi bi-bag-fill"></i> <span class="sum"><?php echo $soLuong;
                                                                                                                                              $_SESSION['soLuongCart'] = $soLuong ?></span>
              <span style="margin-top: 5px; "><?php
                                              if (!empty($tongCong)) {
                                                echo currency_format($tongCong);
                                                $_SESSION['cart'] = $tongCong;
                                              } else {
                                                $_SESSION['cart'] = 0;
                                                echo '0 đ';
                                              }
                                              ?></span>
            </a>
          </li>
        </div>



        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="" data-bs-toggle="dropdown" id="myLink">
            <i class="bi bi-bell"></i>
            <span style="top: 6px; right: 8px;" class="badge bg-primary badge-number"><?php
                                                                                      if (!empty($soLuongThongBao)) {
                                                                                        echo count($soLuongThongBao);
                                                                                      } else {
                                                                                        echo 0;
                                                                                      } ?></span>
          </a>
          <script>
            var myLink = document.getElementById('myLink');


            myLink.addEventListener('click', function() {

              var badgeNumber = myLink.querySelector('.badge-number');

              badgeNumber.innerText = '0';
            });



            document.getElementById("myLink").addEventListener("click", function() {

              var xhr = new XMLHttpRequest();
              xhr.open("GET", "index.php?mod=Proccess", true);




              xhr.send();

            });
          </script>
                
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="max-height: 300px; overflow-y: scroll;">
            <li class="dropdown-header">
              bạn có <?php
                      if (!empty($soLuongThongBao)) { ?>
              
              <?php echo count($soLuongThongBao);
                      } else {
                        echo 0;
                      } ?> thông báo mới
              <a href="index.php?mod=Notification"><span class="badge rounded-pill bg-primary p-2 ms-2">Xem tất cả</span></a>

            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php
            $thoiGianTru = array();
            if(!empty($thongbao)){
            foreach ($thongbao as $index => $item) { ?>
              <li class="notification-item">
                <i class="bi bi-check-circle text-success"></i>
                <div>

                  <p style="font-size: 16px; font-family: sans-serif; color:#000"><b><?php echo $item['noiDung'] ?></b></p>
                  <p><?php

                      $currentTime = new DateTime();

                      // Thời gian cần trừ đi
                      $thoigianTao[$index] = new DateTime($item['thoiGian']);

                      // Tính khoảng thời gian giữa thời gian hiện tại và thời gian cần trừ đi
                      $thoiGianTru[$index] = $currentTime->diff($thoigianTao[$index]);
                      if ($thoiGianTru[$index]->format('%D') > 0) {
                        $thoiGian = $thoiGianTru[$index]->format('%D ngày trước');;
                      } elseif ($thoiGianTru[$index]->format('%H') > 00) {
                        $thoiGian = ltrim($thoiGianTru[$index]->format('%H giờ trước'));
                      } else {
                        $thoiGian = $thoiGianTru[$index]->format('%I phút trước');;
                      }

                      echo $thoiGian;

                      ?></p>
                </div>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
            <?php }} ?>






          </ul><!-- End Notification Dropdown Items -->

        </li>

        <li class="nav-item dropdown" style="margin: 0px -30px;">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" id="thongbao">
            <i class="bi bi-chat-left-text"></i>
            <span style="top: 6px; right: 8px;" class="badge bg-success badge-number numbertt"><?php
                                                                                                if (!empty($soLuongHopThu)) {
                                                                                                  echo count($soLuongHopThu);
                                                                                                } else {
                                                                                                  echo 0;
                                                                                                } ?></span>
          </a>
          <script>
            document.getElementById('thongbao').addEventListener('click', function() {

              var spanElement = document.querySelector('.numbertt');


              spanElement.textContent = '0';
            });




            document.getElementById("thongbao").addEventListener("click", function() {

              var xhr = new XMLHttpRequest();
              xhr.open("GET", "index.php?mod=ProccessHopThu", true);

              xhr.send();

            });
          </script>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages" style="max-height: 300px; overflow-y: scroll;">
            <li class="dropdown-header">
              Bạn có <?php
                      if (empty($soLuongHopThu)) {
                        echo 0;
                      } else {
                        echo count($soLuongHopThu);
                      } ?> thư mới
              <a href=""><span class="badge rounded-pill bg-primary p-2 ms-2">Xem tất cả</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <?php
            if (!empty($hopThu)) {
              foreach ($hopThu as $item) { ?>
                <li class="message-item">
                  <a href="index.php?mod=Dish&act=DishDetail&idMonAn=<?php echo $item['idMonAn'] ?>&date=<?php echo $item['ngayLenMon'] ?>&phanhoi=ok">
                  <?php  ?>
                    <img src="assets/imageProfile/<?php echo $item['hinhAnh'] ?>" alt="" class="rounded-circle">
                    <div>
                      <p style="font-size: 16px;"><?php echo $item['noiDungThu'] ?></p>
                      <p><i><?php

                            $currentTime = new DateTime();

                            // Thời gian cần trừ đi
                            $thoigianTao[$index] = new DateTime($item['thoiGian']);

                            // Tính khoảng thời gian giữa thời gian hiện tại và thời gian cần trừ đi
                            $thoiGianTru[$index] = $currentTime->diff($thoigianTao[$index]);
                            if ($thoiGianTru[$index]->format('%D') > 0) {
                              $thoiGian = $thoiGianTru[$index]->format('%D ngày trước');;
                            } elseif ($thoiGianTru[$index]->format('%H') > 00) {
                              $thoiGian = ltrim($thoiGianTru[$index]->format('%H giờ trước'));
                            } else {
                              $thoiGian = $thoiGianTru[$index]->format('%I phút trước');;
                            }

                            echo $thoiGian;

                            ?></i></p>
                    </div>
                  </a>
                </li>
            <?php }
            } ?>
            <li>
              <hr class="dropdown-divider">
            </li>





          </ul>

        </li>

        <li class="nav-item dropdown pe-3 profile-user">

          <a class="nav-link nav-profile d-flex align-items-center pe-0 profile-main" href="#" data-bs-toggle="dropdown">
            <img src="assets/imageProfile/<?php echo $user['hinhAnh'] ?>" alt="Profile" class="rounded-circle">
            <?php if (isset($_SESSION['is_login']['hoTen'])) { ?>
              <span style="font-family: sans-serif;" class="d-none d-md-block dropdown-toggle ps-2"> <?php echo $user['hoTen'] ?></span>
            <?php } ?>
          </a>

          <ul style="background-color: #fff; position: absolute; top:60px; right: 10px; box-shadow: 1px 2px 3px #000; display: none;" class="profle-main-menu">
            <i class="fa-solid fa-sort-up text-light" style="position: absolute; top:-10px; font-size: 32px; right: 10px;"></i>
            <li class="dropdown-header">
              <?php
              if (isset($_SESSION['is_login']['hoTen'])) {
              ?>


                <h6 class="text-center"><b> <?php echo $user['hoTen'] ?></b> </h6>
                <p class="text-center"> <?php echo   $_SESSION['is_login']['tenRole']; ?> </p>

              <?php } ?>
            </li>
            <?php

            if (isset($_SESSION['login'])) {
              if ($_SESSION['is_login']['Role'] != 4) {

            ?>
                <li>

                  <a class="dropdown-item d-flex align-items-center" href="admin.php">
                    <i class="fa-solid fa-gear"></i>
                    <span class="ml-2"> Thực hiện chức năng</span>
                  </a>
                </li>
            <?php }
            } ?>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="admin.php?mod=Profile">
                <i class="bi bi-person"></i>
                <span class="ml-2"> Thông tin tài khoản</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="admin.php?mod=Support">
                <i class="bi bi-question-circle"></i>
                <span class="ml-2"> Trợ giúp ?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="index.php?mod=logout">
                <i class="bi bi-box-arrow-right"></i>
                <span class="ml-2">Đăng xuất</span>
              </a>
            </li>

          </ul>
        </li>



        <script>
          $(document).ready(function() {
            $(".profile-main").click(function(e) {
              e.stopPropagation(); // Prevent the click event from propagating to the document
              $(".profle-main-menu").slideToggle("slow");
            });

            // Close the menu when clicking outside of it
            $(document).click(function(e) {
              if (!$(e.target).closest(".profile-main").length && !$(e.target).closest(".profle-main-menu").length) {
                $(".profle-main-menu").slideUp("slow");
              }
            });
          });
        </script>


      </ul>
    </nav>
    <i class="bi bi-list toggle-sidebar-btn toggle-user"></i>

    <div class="user-responsive" style="position: absolute; top: 60px; right: 0px; background-color: #fff; box-shadow: 1px 2px 3px #000; display: none;">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="./assets/imageProfile/Huan.png" alt="Profile" class="rounded-circle " style="width: 30px;">
        <span class="ml-1"> Nguyễn Hồ Minh Huân</span>
      </a><!-- End Profile Iamge Icon -->

      <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
        <i class="bi bi-person"></i>
        <span>Thông tin tài khoản</span>
      </a>

      <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
        <i class="bi bi-gear"></i>
        <span>Bếp ăn</span>
      </a>

      <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <span>Đơn đặt</span>
      </a>


      <a class="dropdown-item d-flex align-items-center" style="position: relative;" href="#">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="sum" style="position: absolute; left: 3px; top: -5px; background-color: red; padding: 0px 5px; border-radius: 50%; font-size: 10px; color: #fff;">3</span>
        <span style="margin-left: 15px; ">Giỏ hàng</span>
      </a>


      <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
        <i class="fa-brands fa-artstation"></i>
        <span>Cài đặt tài khoản</span>
      </a>



      <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
        <i class="bi bi-question-circle"></i>
        <span>Trợ giúp ?</span>
      </a>




      <a class="dropdown-item d-flex align-items-center" href="#">
        <i class="bi bi-box-arrow-right"></i>
        <span>Đăng xuất</span>
      </a>



    </div>
    <script>
      $(document).ready(function() {
        $(".toggle-user").click(function() {
          $(".user-responsive").slideToggle("slow");
        });
      });
    </script>
  </header>



  <aside id="sidebar" class="sidebar">

    <div class="col-lg-3 col-md-5">
      <div class="sidebar">
        <div class="sidebar__item">
          <h4>Lịch đặt món tuần này:</h4>
          <ul>
            <?php

            $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday');

            $menu = array();

            foreach ($days as $index => $day) {

              $timestamp = strtotime('this week ' . $day);


              $friday = strtotime('this week friday');
              $ngayHientai = new DateTime();
              $ngayHientaiTimestamp = $ngayHientai->getTimestamp();

              if ($ngayHientaiTimestamp >= $friday) {
                $timestamp = strtotime('next week ' . $day);
              }





              $menu[$index] = date('d/m/Y', $timestamp);

              $newDate[$index] = date_format(date_create_from_format('d/m/Y',  $menu[$index]), 'Y-m-d');
            ?>

              <li><a href="index.php?mod=Dish&act=list&date=<?php echo $newDate[$index] ?>">Thứ <?php echo $index + 2 ?>, Ngày <?php echo $menu[$index];  ?></a></li>

            <?php

            } ?>
          </ul>
        </div>



        <div class="sidebar__item">
          <div class="latest-product__text">
            <h4>Món ăn hôm nay</h4>
            <?php $today = date("Y-m-d");


            $menuToday = $p->getAllDishMenuByDate($today);
            if ($menuToday) {
              foreach ($menuToday as $item) {

            ?>
                <div class="latest-product__slider owl-carousel">

                  <div class="latest-prdouct__slider__item">
                    <a href="#" class="latest-product__item">
                      <div class="latest-product__item__pic">
                        <img style="width: 150px;" src="./assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="">
                      </div>
                      <div class="latest-product__item__text">
                        <h6><?php echo $item['tenMon'] ?></h6>
                        <span><?php echo currency_format($item['gia']) ?>
                        </span>
                      </div>
                    </a>

                  </div>


                </div>
            <?php }
            } ?>


          </div>
        </div>
      </div>

  </aside>
 
  <audio id="notificationSound" src="assets/audio/thongbao.mp3"  autoplay="true"
    muted="muted"></audio>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Lấy thẻ audio
      var audio = document.getElementById('notificationSound');

      // Phát âm thanh
      audio.play();
    });
  </script>


