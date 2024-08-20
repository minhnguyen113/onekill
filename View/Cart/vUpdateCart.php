<?php
include_once("Controller/cCart.php");
$p = new controlCart();


date_default_timezone_set('Asia/Ho_Chi_Minh');


if (isset($_SESSION['is_login']['idTaiKhoan'])) {
  $idTaiKhoan =  $_SESSION['is_login']['idTaiKhoan'];
  $ngayLenMon = $_SESSION['dateOfDish'];
  $idTK = $p->getTaiKhoanChiTietGioHangAndNgayLenMon($idTaiKhoan, $ngayLenMon);


 
    foreach ($idTK as $item) {
        $idMonAn = $item['idMonAn'];
      $SL = $item['soLuong'];

      if (isset($foods[$idMonAn])) {
        $foods[$idMonAn]['soLuong'] += $SL;
      } else {
        $foods[$idMonAn] = $item;
      }
    }

    $soLuong =  $foods[$idMonAn]['soLuong'];
    $currentDate = new DateTime();
    $ngayTao = $currentDate->format('Y-m-d H:i:s');


    $p->UpdateShopCartDetails($soLuong, $idMonAn, $ngayLenMon);
    
 
}
$date = $_GET['date'];


 echo header("refresh: 0; url='index.php?mod=Cart&act=DeleteDuplicate&date=$date'");
