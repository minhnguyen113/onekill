
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>onekill</title>
 
  <!-- 
    - favicon
  -->
  <link href="assets/admin/img/favicon.png" rel="icon">
  <link href="assets/admin/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="assets/css/index.css">

  <!-- 
    - google font link
  -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-banner.png" media="min-width(768px)">
  <link rel="preload" as="image" href="./assets/images/hero-banner-bg.png" media="min-width(768px)">
  <link rel="preload" as="image" href="./assets/images/hero-bg.jpg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <h1>
        <a href="index.php" class="logo">ONEKILL</a>
      </h1>


      <form action="" method="get">
        <div class="search">
          <input type="search" name="search" id="search" placeholder="search...">
          <input type="submit" value="Search" name="btn_search" id="btn_search">
        </div>
      </form>


      <nav class="navbar" data-navbar>
        <ul class="navbar-list">
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
          <?php  if (isset($_SESSION['login'])) {
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
            <li class="nav-item">
            <a href="index.php?mod=Dish&act=list&date=<?php echo $ngay_ngay_mai ?>" class="navbar-link" data-nav-link>Vào bếp ăn</a>
          </li>
         <?php } ?>
         
          <li class="nav-item">
            <a href="" class="navbar-link" data-nav-link>Trang chủ</a>
          </li>

          <li class="nav-item">
            <a href="#about" class="navbar-link" data-nav-link>Giới thiệu</a>
          </li>

          <li class="nav-item">
            <a href="#food-menu" class="navbar-link" data-nav-link>Món ăn</a>
          </li>


          <?php if (isset($_SESSION['is_login']['hoTen'])) { ?>

            <li class="nav-item">
            <a href="#" class="navbar-link" data-nav-link><?php echo  $_SESSION['is_login']['hoTen']; ?></a>
          
            </li>
          <?php } else { ?>
            <li class="nav-item"> <a href="index.php?mod=login" id="login">LOGIN</a></li>
          <?php } ?>
        </ul>
      </nav>

      <div class="header-btn-group">




        <button class="nav-toggle-btn" aria-label="Toggle Menu" data-menu-toggle-btn>
          <span class="line top"></span>
          <span class="line middle"></span>
          <span class="line bottom"></span>
        </button>
      </div>

    </div>
  </header>


  <div class="search-container" data-search-container>

    <div class="search-box">
      <input type="search" name="search" aria-label="Search here" placeholder="Type keywords here..." class="search-input">

      <button class="search-submit" aria-label="Submit search" data-search-submit-btn>
        <ion-icon name="search-outline"></ion-icon>
      </button>
    </div>

    <button class="search-close-btn" aria-label="Cancel search" data-search-close-btn></button>

  </div>