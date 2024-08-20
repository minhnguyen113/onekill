<?php
include_once("Controller/cOrder.php");
include_once("Controller/cManagement.php");
$p = new controlOrder();
$us = new controlManagement();

$list = $p->getSumOrder();

$user = $us->SelectUsers();


$listNoPay = $p->SelectOrderNoPay();
?>

<main id="main" class="main">

  <div class="pagetitle">

    <h1>Tính phí ăn nhân viên theo tháng</h1>

    <nav>
      <ol class="breadcrumb">

        <li class="breadcrumb-item">phí ăn</li>

      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
  <a href="admin.php?mod=PayKitchen" class="btn btn-primary m-3">Thanh toán phí ăn tại bếp</a>

    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">


            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">STT</th>
                  <th scope="col">Mã nhân viên</th>
                  <th scope="col">Họ tên</th>
                  <th scope="col">Điện thoại</th>
                  <th scope="col">Email</th>
                  <th scope="col">Tổng số đơn </th>
                  <th scope="col">Số Tiền cần trả</th>
                  <th scope="col">Chi tiết đơn</th>
                  <th scope="col">Thời hạn thanh toán</th>



                </tr>
              </thead>
              <tbody>
                <?php

                $i = 1;

                if (!empty($user)) {
                  foreach ($user as $us) {
                    $foundMatch = false;

                    if(!empty($list)){
                      
                    foreach ($list as $order) {
                      if ($us['maNhanVien'] == $order['maNhanVien']) {
                        $foundMatch = true;
                ?>
                        <tr>
                          <th scope="row"><?php echo $i++; ?></th>
                          <td><?php echo $order['maNhanVien']; ?></td>
                          <td><?php echo $order['hoTen']; ?></td>
                          <td><?php echo $order['soDienThoai']; ?></td>
                          <td><?php echo $order['email']; ?></td>
                          <td><?php echo $order['TongSoDon']; ?></td>
                          <td><?php echo currency_format($order['TongTien']); ?></td>
                          <td><button type="button" class="btn btn-primary" data-bs-target="#frm<?php echo $order['idTaiKhoan'] ?>" data-bs-toggle="modal">Xem</button>

                            <?php foreach ($listNoPay as $item) {
                              if ($order['idTaiKhoan'] == $item['idTaiKhoan']) {
                            ?>
                                <div class="modal" id="frm<?php echo $item['idTaiKhoan'] ?>" tabindex="-1">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Chi tiết đơn đặt</h5>
                                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>

                                      <div class="modal-body">
                                        <table class="table table-bordered">
                                          <thead>
                                            <tr class="text-center">
                                              <th scope="col">STT</th>
                                              <th scope="col">Số Đơn</th>
                                              <th scope="col">Số tiền</th>
                                              <th scope="col">Ngày đặt</th>
                                              <th scope="col">Ngày ăn</th>
                                           


                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($listNoPay as $item) {
                                              if ($order['idTaiKhoan'] == $item['idTaiKhoan']) {
                                              
                                              
                                               
                                            ?>
                                                <tr class="text-center">
                                                  <td><?php echo $i++ ?></td>
                                                  <td><?php echo $item['tongSoLuong'] ?></td>
                                                  <td><?php echo currency_format($item['tongTien']); ?><span></span></td>
                                                  <td><?php
                                                      $ngayDat = (new DateTime($item['ngayDat']))->format("H:i:s d/m/Y ");
                                                      echo  $ngayDat  ?><span></span></td>
                                                  <td><?php
                                                      $ngayLenMon = (new DateTime($item['ngayLenMon']))->format("d/m/Y ");
                                                      echo  $ngayLenMon;
                                                      ?><span></span></td>
                                                  
                                                      
                                                     


                                                </tr>
                                            <?php 
                                               }
                                            } ?>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php }
                            } ?>
                          </td>
                          <th><?php $thangHienTai = date('m');
                              $namHienTai = date('Y'); 

                              $soNgayTrongThang = cal_days_in_month(CAL_GREGORIAN, $thangHienTai, $namHienTai);
                              $ngayCuoiCung = date('d-m-Y', strtotime($namHienTai . '-' . $thangHienTai . '-' . $soNgayTrongThang));
                              echo $ngayCuoiCung; ?></th>
                        </tr>
                      <?php
                      }
                    }
                  }

                    if ($foundMatch==false) {
                      ?>
                      <tr>
                        <th scope="row"><?php echo $i++; ?></th>
                        <td><?php echo $us['maNhanVien']; ?></td>
                        <td><?php echo $us['hoTen']; ?></td>
                        <td><?php echo $us['soDienThoai']; ?></td>
                        <td><?php echo $us['email']; ?></td>
                        <td>0</td>
                        <td><?php echo currency_format(0); ?></td>
                        <td></td>
                        <td><span class="badge bg-success">Thanh toán hoàn tất</span></td>
                      </tr>
                <?php
                    }
                  }
                }
                ?>

              </tbody>
            </table>

          </div>
        </div>


      </div>
    </div>
  </section>

</main>

<?php

