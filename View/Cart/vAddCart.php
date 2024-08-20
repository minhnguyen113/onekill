
<?php
include_once("Controller/cCart.php");
$p = new controlCart();
$idTaiKhoan =  $_SESSION['is_login']['idTaiKhoan'];
$foods = array();
$idGioHang = $idTaiKhoan.rand(0, 1000000);

date_default_timezone_set('Asia/Ho_Chi_Minh');


if (isset($_SESSION['is_login']['idTaiKhoan'])) {
  $idTaiKhoan =  $_SESSION['is_login']['idTaiKhoan'];

  $idTK = $p->getIdTaiKhoanChiTietGioHang($idTaiKhoan);
  if (!$idTK) {

    $currentDate = new DateTime();
    $ngayTao = $currentDate->format('Y-m-d H:i:s');
    $tongTien = 0;
    $p->CreateShopCart($idGioHang, $ngayTao, $tongTien);
  }

  $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];



 
$idMonAn = $_GET['idMonAn'];
$_SESSION['idMonAn'] = $idMonAn;


  $idMonAn =  $_SESSION['idMonAn'];
 
  $soLuong =  1;
  $currentDate = new DateTime();
  $ngayLenMon = $_SESSION['dateOfDish'];
  $ngayTao = $currentDate->format('Y-m-d H:i:s');

  if ($idTK) {
    $idGioHang = $idTK[0]['idGioHang'];
  
  } 

  $_SESSION['idGioHang'] = $idGioHang;
  $p->CreateShopCartDetails($idGioHang, $idTaiKhoan, $idMonAn, $soLuong, $ngayLenMon , $ngayTao);

$date = $_GET['date'];
  echo header("refresh: 0; url='index.php?mod=Cart&act=Update&date=$date'");
}




?>

