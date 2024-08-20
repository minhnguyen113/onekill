<?php

include_once("Controller/cManagement.php");
include_once("Controller/cStatistic.php");

$p = new controlManagement();
$sta = new ControlStatistic();

$id_taikhoan =   $_SESSION['is_login']['idTaiKhoan'];
$list_user = $p->getAllHoatDong($id_taikhoan);





$ngayHomNay = date('d-m-Y');
if (isset($_POST['date'])) {
  $ngayLenMon = $_POST['date'];
} else {
  $ngayLenMon = date('Y-m-d');
}
$sumDishOrderDate = $sta->getTotalQuantityByDay($ngayLenMon);
$sumUserOrderDate = $sta->getTotalQuantityOrder($ngayLenMon);
$sumProceeds      = $sta->getProceedsByDate($ngayLenMon);

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Trang chủ</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Ngày Hôm nay: <?php echo $ngayHomNay ?></a></li>

      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="container mt-5 m-3">
      <form action="" method="post">
        <div class="form-group">
          <label for="date">Chọn ngày thống kê: </label>
          <input style="display: inline-block;" type="date" class="form-control p-2" name="date" id="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'] ?>">
        </div>
        <input style="display: none;" type="submit" value="Submit" id="submitBtn" name="sub_date">
      </form>
    </div>
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>

              </div>

              <div class="card-body">
                <h5 class="card-title">Số lượng món đặt<span> | <?php if (isset($_POST['date'])) {
                                                                  $ngay = $_POST['date'];
                                                                  $ngay =  date("d/m/Y", strtotime($ngay));
                                                                } else {
                                                                  $ngay = 'Hôm nay';
                                                                }  echo $ngay?></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php
                        if (!empty($sumDishOrderDate)) {
                          echo $sumDishOrderDate[0]['TongSoLuongTheoNgay'];
                        } else {
                          echo '0';
                        }

                        ?></h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->


          <!-- Customers Card -->
          <div class="col-xxl-6 col-xl-12">

            <div class="card info-card customers-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
               
              </div>

              <div class="card-body">
                <h5 class="card-title">Số người đặt <span>| <?php if (isset($_POST['date'])) {
                                                                  $ngay = $_POST['date'];
                                                                  $ngay =  date("d/m/Y", strtotime($ngay));
                                                                } else {
                                                                  $ngay = 'Hôm nay';
                                                                }  echo $ngay?></span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php
                        if (!empty($sumUserOrderDate)) {
                          echo count($sumUserOrderDate);
                        } else {
                          echo '0';
                        }
                        ?></h6>
                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

          <div class="col-xxl-12 col-md-6">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              
              </div>

              <div class="card-body">
                <h5 class="card-title">Doanh thu <span>| <?php if (isset($_POST['date'])) {
                                                                  $ngay = $_POST['date'];
                                                                  $ngay =  date("d/m/Y", strtotime($ngay));
                                                                } else {
                                                                  $ngay = 'Hôm nay';
                                                                }  echo $ngay?></span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>

                  </div>
                  <div class="ps-3">
                    <h6><?php
                        if (!empty($sumProceeds)) {
                          $Proceeds = 0;
                          foreach ($sumProceeds as $item) {
                            $Proceeds += $item['TongTien'];
                          }
                          echo currency_format($Proceeds);
                        } else {
                          echo '0';
                        }
                        ?> </h6>


                  </div>
                </div>

              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Reports -->


          <!-- Recent Sales -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>


            </div>
          </div><!-- End Recent Sales -->



        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Recent Activity -->
        <div class="card">


          <div class="card-body">
            <h5 class="card-title">Hoạt động gần đây</h5>


            <div class="activity">

              <div class="activity-item d-flex">

                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                <div class="activity-content">
                  Đang hoạt động
                </div>
              </div>

            </div>
            <br>
            <?php

            if (!empty($list_user)) {

              $ngay1 = new DateTime();
              $ngay2 = array();
              $thoiGianTru = array();
              $i = 0;
              foreach ($list_user as $item) {
                $ngay2[] = new DateTime($item['thoigian']);
                $thoiGianTru[] = $ngay1->diff($ngay2[$i]);
                $i++;
              }
              $count = count($list_user) < 6 ? count($list_user) : 6;
              for ($i = 0; $i < $count; $i++) {
                if ($thoiGianTru[$i]->format('%D') > 0) {
                  $thoiGian = $thoiGianTru[$i]->format('%D ngày');;
                } elseif ($thoiGianTru[$i]->format('%H') > 00) {
                  $thoiGian = ltrim($thoiGianTru[$i]->format('%H giờ'));
                } else {
                  $thoiGian = $thoiGianTru[$i]->format('%I phút');;
                }

            ?>
                <div class="activity">

                  <div class="activity-item d-flex">

                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                    <div class="activity-content " style="margin-right: 30px;">
                      Bạn đã đăng nhập:
                    </div>
                    <div class=" activite-label"><?php echo $thoiGian; ?> trước</div>
                  </div>

                </div>
                <br>
            <?php   }
            } ?>

          </div>

        </div>



      </div><!-- End Right side columns -->

    </div>
  </section>

</main><!-- End #main -->