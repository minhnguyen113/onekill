<?php
include_once("Controller/cStatistic.php");


$p = new ControlStatistic();


if (!isset($_POST['sub_date'])) {
  $ngayHienTai = date('Y-m-d');
  $ngayLenMon = date('Y-m-d', strtotime($ngayHienTai));
} else {
  $ngayLenMon = date('Y-m-d', strtotime($_POST['date']));
}


$list = $p->gettOrderbyDate($ngayLenMon);
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Xem thực đơn nguyên liệu cần nấu</h1>

    <div class="row">
      <div class="col-md-3">

        <form style="margin: 15px 20px" action="" method="post">
          <input type="date" name="date" id="date" value="<?php if (!isset($_POST['sub_date'])) {
                                                            echo $ngayHienTai;
                                                          } else {
                                                            echo $_POST['date'];
                                                          } ?>">
          <input style="display: none;" type="submit" value="Submit" id="submitBtn" name="sub_date">
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th scope="col">STT</th>
              <th scope="col">Tên món</th>
              <th scope="col">Hình ảnh</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Chi tiết</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $Monan = array();
            if (!empty($list)) {
              foreach ($list as $index => $item) {
                $Monan[] = array(
                  'idMon' => $item['idMonAn'],
                  'soLuong' => $item['tongSoLuong'],
                );

            ?>
                <tr class="text-center">
                  <td><?php echo  $i++; ?></td>
                  <td><?php echo $item['tenMon'] ?></td>
                  <td class="text-center"><img style="width: 100px;" src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="" class="img-fluid max-width-100"></td>
                  <td><?php echo $item['tongSoLuong']; ?></td>
                  <td> <button type="button" class="btn btn-primary" data-bs-target="#frm<?php echo $index ?>" data-bs-toggle="modal">Xem</button></td>
                </tr>
            <?php }
            } ?>
          </tbody>

          <tfoot>
            <tr class="text-center">
              <td colspan="5"> <button type="button" class="btn btn-success" data-bs-target="#total" data-bs-toggle="modal">Tổng thống kê</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>



    <?php

    $tongTK = array();

    foreach ($Monan as $index => $monan) {
      $idMonAn = $monan['idMon'];
      $list_ngl =  $p->getIngredientsOfDish($ngayLenMon, $idMonAn); ?>

      <div class="modal" id="frm<?php echo $index ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Thống kê nguyên liệu</h5>
              <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                    <th scope="col">STT</th>
                    <th scope="col">Tên nguyên liệu</th>
                    <th scope="col">Khối lượng</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($list_ngl as $item) {

                  ?>
                    <tr class="text-center">
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $item['tenNguyenLieu'] ?></td>
                      <td><?php echo currency_format($item['soLuong'] * $monan['soLuong'], 'g') ?><span></span></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php } 
    
    
    foreach ($Monan as $index => $monan) {
      $idMonAn = $monan['idMon'];
      $list_ngl =  $p->getIngredientsOfDish($ngayLenMon, $idMonAn);

      foreach ($list_ngl as $item) {

        $tongTK[] = array(
          'tenNguyenLieu' =>  $item['tenNguyenLieu'],
          'Tong' => $item['soLuong'] * $monan['soLuong'],
        );
      }
     

    }

    $sumByTenNguyenLieu = array();

    foreach ($tongTK as $item) {
      $tenNguyenLieu = $item["tenNguyenLieu"];
      $tong = $item["Tong"];

      if (isset($sumByTenNguyenLieu[$tenNguyenLieu])) {
        $sumByTenNguyenLieu[$tenNguyenLieu] += $tong;
      } else {
        $sumByTenNguyenLieu[$tenNguyenLieu] = $tong;
      }
    }
    ?>

    <!-- modal Tổng kết -->
    <div class="modal" id="total" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nguyên liệu cần chuẩn bị</h5>
            <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <table class="table table-bordered">
              <thead>
                <tr class="text-center">
                  <th scope="col">STT</th>
                  <th scope="col">Tên nguyên liệu</th>
                  <th scope="col">Tổng khối lượng(g)</th>
         

                </tr>
              </thead>
              <tbody>

                <?php
                $i = 1;
                foreach ($sumByTenNguyenLieu as $index=>$item) { ?>
                  <tr class="text-center">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $index; ?></td>
                    <td><?php echo currency_format($item, 'g'); ?><span></span></td>
                

                  </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <?php



    ?>
</main>
<?php

