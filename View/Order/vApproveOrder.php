<?php

include_once("Controller/cOrder.php");


$p = new controlOrder();




if (isset($_POST['sub_date'])) {
  $ngayLenMon = date('Y-m-d', strtotime($_POST['date']));
}elseif (isset($_POST['btn_duyet'])) {
  $ngayLenMon = date('Y-m-d', strtotime($_POST['date']));
} elseif (isset($_GET['date'])) {
  $ngayLenMon = date('Y-m-d', strtotime($_GET['date']));
} else {
  $ngayHienTai = date('Y-m-d');
  $ngayLenMon = date('Y-m-d', strtotime($ngayHienTai));
}



$_SESSION['ngayDuyet'] = $ngayLenMon;
$listOder = $p->getOrderByNgayLenMon($ngayLenMon);
$list = array();
?>
<main id="main" class="main">

  <div class="pagetitle">

    <h1>Duyệt đơn đơn đặt món</h1>

    <nav>
      <ol class="breadcrumb">

        <li class="breadcrumb-item"><?php echo $_SESSION['ngayDuyet']   ?></li>

      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div style="display: flex;">
              <h5 class="card-title">Chọn ngày xem:</h5>

              <form style="margin: 15px 20px" action="" method="post">
                <input type="date" name="date" id="date" value="<?php echo $_SESSION['ngayDuyet'] ?>">
                <input style="display: none;" type="submit" value="Submit" id="submitBtn" name="sub_date">
              </form>
            </div>
            <form action="" method="post">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Điện thoại</th>
                    <th scope="col">Tên món</th>
                    <th scope="col">Số lượng</th>

                    <th scope="col">Duyệt món</th>


                  </tr>
                </thead>
                <tbody>

                  <?php

                  if (!empty($listOder)) {

                    foreach ($listOder as $item) {
                      $idTaiKhoan = $item['idTaiKhoan'];
                      if (isset($result[$idTaiKhoan])) {
                        $result[$idTaiKhoan]['soLuong'] += $item['soLuong'];
                        $result[$idTaiKhoan]['tenMon'] .= ', ' . $item['tenMon'];
                      } else {

                        $result[$idTaiKhoan] = [
                          'idTaiKhoan' => $idTaiKhoan,
                          'maNhanVien' =>  $item['maNhanVien'],
                          'hoTen' => $item['hoTen'],
                          'soDienThoai' => $item['soDienThoai'],
                          'soLuong' => $item['soLuong'],
                          'tenMon' => $item['tenMon'],
                          'duyetDon' => $item['duyetDon'],
                        ];

                        $list[] =  $result[$idTaiKhoan];
                      }
                    }
                  }


                  if (!empty($result)) {
                    $i = 1;
                    foreach ($result as $order) {

                  ?>

                      <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $order['maNhanVien']; ?></td>
                        <td><?php echo $order['hoTen']; ?></td>
                        <td><?php echo $order['soDienThoai']; ?></td>

                        <td><?php echo $order['tenMon']; ?></td>
                        <td><?php echo $order['soLuong']; ?></td>
                        <td>
                          <?php if ($order['duyetDon'] == 1) { ?>
                            <input checked type="checkbox" name="<?php echo  $order['idTaiKhoan']; ?>">
                          <?php } else {
                          ?>
                            <input type="checkbox" name="<?php echo  $order['idTaiKhoan']; ?>">
                          <?php } ?>
                        </td>
                      </tr>
                  <?php }
                  }  ?>



                </tbody>
              </table>
              <input type="hidden" name="date" value="<?php echo $_SESSION['ngayDuyet']  ?>">
              <input type="submit" value="Duyệt" name="btn_duyet">

            </form>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>

<?php

if (isset($_POST['btn_duyet'])) {

 

  $approve = array();
  foreach ($list as $index => $item) {
    $check = $item['idTaiKhoan'];
    if (isset($_POST["$check"])) {
      if ($_POST["$check"] == 'on') {
        $approve[] = array(
          'idTaiKhoan' => $item['idTaiKhoan'],
          'duyeton' => 1
        );
      }
    } else {
      $approve[] = array(
        'idTaiKhoan' => $item['idTaiKhoan'],
        'duyeton' => 0
      );
    }
  }

  $ngayLenMon = $_SESSION['ngayDuyet'];
$p->ApproveOrder($approve, $ngayLenMon);

echo header("refresh: 0; url='admin.php?mod=ApproveOrder&date=$ngayLenMon'");
}

