<?php
include_once("Controller/cDish.php");
$p = new controlDish();

$idPhanHoi = '';
$noiDung ='';
foreach($_POST as $index=>$item){
    $idPhanHoi = $index;
    $noiDung = $item;

}



$idPhanHoi = preg_replace("/[^0-9]/", "", $idPhanHoi);



$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
$noiDung = $noiDung ;
$ngayTraLoi = date('Y-m-d H:i:s');
$traloi= $p->InsertTraLoi($idTaiKhoan,$noiDung,$idPhanHoi,$ngayTraLoi);

$date = $_GET['date'];
$idMonAn = $_GET['idMonAn'];

if($traloi){

  $hoten = $_SESSION['is_login']['hoTen'];
  if($_SESSION['is_login']['Role']==1 || $_SESSION['is_login']['Role']== 2){
    $hoten = 'Quản trị viên';
  }
  $noiDungThu= "$hoten vừa trả lời đánh giá của bạn";
  $thoiGian = date('Y-m-d H:i:s');
  $idTaiKhoanGuiDen = $_POST['idTaiKhoanGuiDen'];
  $idMonAn = $_GET['idMonAn'];
  $ngayLenMon =$_GET['date'];
  $idTaiKhoanNoiDung =  $_SESSION['is_login']['idTaiKhoan'];
  $p->InsertHopThu($noiDungThu,$thoiGian,$idTaiKhoanGuiDen, $idMonAn, $ngayLenMon, $idTaiKhoanNoiDung);
  echo header("refresh: 0; url='index.php?mod=Dish&act=DishDetail&idMonAn=$idMonAn&date=$date&phanhoi=ok'");

} else {
    echo '<script>alert("Lỗi đánh giá")</script>';

  echo header("refresh: 0; url='index.php?mod=Dish&act=DishDetail&idMonAn=$idMonAn&date=$date&phanhoi=ok'");

}
