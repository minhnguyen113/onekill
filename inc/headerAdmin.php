<?php

include_once("Controller/cManagement.php");
include_once("Controller/cStatistic.php");

$p = new controlManagement();
$sta = new ControlStatistic();


$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
$user  = $p->getUserById($idTaiKhoan);

$thongbao =  $sta->getThongBao($trangThaiXem = '', $idTaiKhoan);
$soLuongThongBao =  $sta->getThongBao(0, $idTaiKhoan);
$hopThu = $sta->getHopThu($trangThaiXem = '', $idTaiKhoan);
$soLuongHopThu = $sta->getHopThu(0, $idTaiKhoan);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OneKill</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <link href="assets/admin/img/favicon.png" rel="icon">
  <link href="assets/admin/img/apple-touch-icon.png" rel="apple-touch-icon">


  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



  <link href="assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/admin/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/admin/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/admin/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/admin/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/update.css">


  <link href="assets/admin/css/style.css" rel="stylesheet">
  <link href="assets/admin/css/Menu.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/update.css">


  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/vi.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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

        <div class="header__cart">
          <li class="mt-2">
            <a href="index.php?mod=Order&act=ListOrderUser" style="font-weight: 1000; color: #000e96e3;"><b>ĐƠN ĐẶT</b></a>
          </li>
          <li class="mt-2">
            <a href="index.php?mod=Order&act=ListInvoice" style="font-weight: 1000; color: #000e96e3;"><b>HÓA ĐƠN</b></a>
          </li>
          <li class="cart">

            <a style="color: #000e96e3;" href="index.php?mod=cart"><i style="font-size: 24px;" class="bi bi-bag-fill"></i> <span class="sum"><?php if (isset($_SESSION['soLuongCart'])) echo  $_SESSION['soLuongCart']; ?></span>
              <span style="margin-top: 5px; "><?php
                                              if (isset($_SESSION['cart'])) {
                                                echo currency_format($_SESSION['cart']);
                                              } else {
                                                echo '0';
                                              }
                                              ?></span>
            </a>
          </li>

        </div>



        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="" data-bs-toggle="dropdown" id="myLink">
            <i class="bi bi-bell"></i>
            <span style="top: -2px; right: -8px;" class="badge bg-primary badge-number"><?php
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
         
                      if (!empty($soLuongThongBao)) {
                        echo count($soLuongThongBao);
                      } else {
                        echo 0;
                      } ?> thông báo mới
              <a href="index.php?mod=Notification"><span class="badge rounded-pill bg-primary p-2 ms-2">xem tất cả</span></a>
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
                        $thoiGian = $thoiGianTru[$index]->format('%D ngày');;
                      } elseif ($thoiGianTru[$index]->format('%H') > 00) {
                        $thoiGian = ltrim($thoiGianTru[$index]->format('%H giờ'));
                      } else {
                        $thoiGian = $thoiGianTru[$index]->format('%I phút');;
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


        <li class="nav-item dropdown" >

<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" id="thongbao">
  <i class="bi bi-chat-left-text"></i>
  <span style="top: -2px; right: -8px;" class="badge bg-success badge-number numbertt"><?php
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
  if(!empty($hopThu)){
  foreach ($hopThu as $item) { ?>
    <li class="message-item">
      <a href="index.php?mod=Dish&act=DishDetail&idMonAn=<?php echo $item['idMonAn'] ?>&date=<?php echo $item['ngayLenMon'] ?>&phanhoi=ok">
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
  <?php } }?>
  



  <li class="dropdown-footer">
    <a href="#">Xem tất cả thư</a>
  </li>

</ul>

</li>

        <li class="nav-item dropdown pe-3 profile-user profile-main">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/imageProfile/<?php echo $user['hinhAnh'] ?> " alt="Profile" class="rounded-circle">

            <?php if (isset($_SESSION['is_login']['hoTen'])) { ?>
              <span class="d-none d-md-block dropdown-toggle ps-2"> <?php echo  $_SESSION['is_login']['hoTen']; ?></span>
            <?php } ?>
          </a><!-- End Profile Iamge Icon -->

          <ul style="background-color: #fff; position: absolute; top: 60px !important; right: 10px !important; box-shadow: 1px 2px 3px #000; display: none; padding-top: 10px;" class="profile profle-main-menu">
            <i class="fa-solid fa-sort-up text-light" style="position: absolute; top:-10px; font-size: 32px; right: 10px;"></i>
            <li class="dropdown-header">
              <?php
              if (isset($_SESSION['is_login']['hoTen'])) {
              ?>


                <h6 style="margin-left: -25px;" class="text-center"><b> <?php echo $user['hoTen'] ?></b> </h6>
                <p style="margin-left: -25px; text-align: center;"> <?php echo   $_SESSION['is_login']['tenRole']; ?> </p>
                <p style="margin-left: -25px; margin-top: -15px; font-size: 12px;" class="text-center"><i style="font-size: 8px;" class='bi bi-circle-fill activity-badge text-success align-self-start'></i> đang hoạt động</p>
              <?php } ?>
            </li>
<?php
if (isset($_SESSION['login'])) {
  if ($_SESSION['is_login']['Role'] != 4) {

?>
            <li style="margin-left: -40px;">
              <a class="dropdown-item d-flex align-items-center" href="admin.php">
                <i class="fa-solid fa-gear"></i>
                <span>Thực hiện chức năng</span>

              </a>
            </li>
<?php
  }}
?>
            <li style="margin-left: -40px;">
              <hr class="dropdown-divider">
            </li>
            <li style="margin-left: -40px;">
              <a class="dropdown-item d-flex align-items-center" href="admin.php?mod=Profile">
                <i class="bi bi-person"></i>
                <span>Thông tin tài khoản</span>
              </a>
            </li>


            <li>
              <hr class="dropdown-divider">
            </li>

            <li style="margin-left: -40px;">
              <a class="dropdown-item d-flex align-items-center" href="admin.php?mod=Support">
                <i class="bi bi-question-circle"></i>
                <span>Trợ giúp ?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li style="margin-left: -40px;">
              <a class="dropdown-item d-flex align-items-center" href="index.php?mod=logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Đăng xuất</span>
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

    <div class="user-responsive" style="position: absolute; top: 60px; right: 0px; background-color: #fff; box-shadow: 1px 2px 3px #000;">
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


      <a style="position: relative;" href="#"><i class="fa-solid fa-cart-shopping"></i>
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


  <?php

if (isset($_SESSION['login'])) {
  if ($_SESSION['is_login']['Role'] != 4) {

?>
      <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
            <a class="nav-link " href="admin.php">
              <i class="bi bi-grid"></i>
              <span>Trang chủ</span>
            </a>
          </li><!-- End Dashboard Nav -->
          <li class="nav-heading">Chức năng</li>
          <?php

          if (isset($_SESSION['login'])) {
            if ($_SESSION['is_login']['Role'] == 1) {
          ?>

              <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-menu-button-wide"></i><span>Quản lý người dùng</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                    <a href="admin.php?mod=KitchenManager">
                      <i class="bi bi-circle"></i><span>Danh sách nhân viên bếp</span>
                    </a>
                  </li>

                  <li>
                    <a href="admin.php?mod=CustomerManagement">
                      <i class="bi bi-circle"></i><span>Danh sách nhân viên công ty</span>
                    </a>
                  </li>

                  <li>
                    <a href="admin.php?mod=addUser">
                      <i class="bi bi-circle"></i><span>Thêm người dùng</span>
                    </a>
                  </li>

                </ul>
              </li>
        
              <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>Quản lý món ăn</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                  <li>
                    <a href="admin.php?mod=ListDishAdmin">
                      <i class="bi bi-circle"></i><span>Danh Sách món ăn</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin.php?mod=ListDishWait">
                      <i class="bi bi-circle"></i><span>Món ăn đang chờ duyệt</span>
                    </a>
                  </li>


                  <li>
                    <a href="admin.php?mod=addDish">
                      <i class="bi bi-circle"></i><span>Thêm món ăn mới</span>
                    </a>
                  </li>
                </ul>
              </li>
         
              <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-layout-text-window-reverse"></i><span>Thực đơn</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                  <li>
                    <a href="admin.php?mod=listMenu">
                      <i class="bi bi-circle"></i><span>Danh sách thực đơn</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin.php?mod=addMenu">
                      <i class="bi bi-circle"></i><span>Thêm thực đơn mới</span>
                    </a>
                  </li>

                </ul>
              </li>
        
       
              <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-bar-chart"></i><span>Quản lý nguyên liệu</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                  <li>
                    <a href="admin.php?mod=Ingredient">
                      <i class="bi bi-circle"></i><span>Thực đơn nguyên liệu cần nấu</span>
                    </a>
                  </li>
                 
                      <a href="admin.php?mod=ListIngredient">
                        <i class="bi bi-circle"></i><span>Danh sách nguyên liệu</span>
                      </a>
                    </li>
                    <li>
                      <a href="admin.php?mod=AddIngredient">
                        <i class="bi bi-circle"></i><span>Thêm nguyên liệu</span>
                      </a>
                    </li>

                 
                </ul>
              </li>
         
       
              <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-gem"></i><span>Quản lý đơn</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                    <a href="admin.php?mod=listOrder">
                      <i class="bi bi-circle"></i><span>Danh sách đơn đặt món</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin.php?mod=ApproveOrder">
                      <i class="bi bi-circle"></i><span>Duyệt đơn đặt</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin.php?mod=ListMealFee">
                      <i class="bi bi-circle"></i><span>Tính phí ăn </span>
                    </a>
                  </li>

                  <li>
                    <a href="admin.php?mod=PayKitchen">
                      <i class="bi bi-circle"></i><span>Thanh toán tại bếp ăn</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin.php?mod=ListPay">
                      <i class="bi bi-circle"></i><span>Danh sách thanh toán</span>
                    </a>
                  </li>
                </ul>
              </li>
          <?php }
          } ?>




          <?php
          if (isset($_SESSION['login'])) {
            if ($_SESSION['is_login']['Role'] == 3) {
          ?>
              <li class="nav-item">
                <a class="nav-link collapsed" href="admin.php?mod=ApproveOrder">
                  <i class="bi bi-person"></i>
                  <span>Xem đơn đặt món</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link collapsed" href="admin.php?mod=listOrder">
                  <i class="bi bi-question-circle"></i>
                  <span>Duyệt đơn đặt món</span>
                </a>
              </li>
          <?php }
          } ?>
          <?php
          if (isset($_SESSION['login'])) {
            if ($_SESSION['is_login']['Role'] == 2) {
          ?>
              <li class="nav-item">
                <a class="nav-link collapsed" href="admin.php?mod=Ingredient">
                  <i class="bi bi-envelope"></i>
                  <span>Xem thực đơn cần nấu</span>
                </a>
              </li>

             

              <li class="nav-item">
                <a class="nav-link collapsed" href="admin.php?mod=addDish">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <span>Đề xuất món ăn</span>
                </a>
              </li>
          <?php }
          } ?>
          <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
              <i class="bi bi-dash-circle"></i>
              <span>Error 404</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
              <i class="bi bi-file-earmark"></i>
              <span>Blank</span>
            </a>
          </li> -->

        </ul>

      </aside><!-- End Sidebar-->

 
<?php
  }}