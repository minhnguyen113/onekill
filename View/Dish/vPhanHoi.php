<?php
include_once("Controller/cDish.php");
$p = new controlDish();


$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];;
$idMonAn = $_GET['idMonAn'];
if(isset($_POST['noidungphanhoi'])){
  $noiDungPhanHoi = $_POST['noidungphanhoi'];
}else {
  $noiDungPhanHoi ='';
}

if(isset($_POST['rating'])){
  $danhGia = $_POST['rating'];
}else {
  $danhGia='';
} 


$ngayDanhGia = date('Y-m-d H:i:s');
 $phaihoi= $p->InsertPhanHoi($idTaiKhoan,$idMonAn,$noiDungPhanHoi,$danhGia,$ngayDanhGia);

$date = $_GET['date'];
$idMonAn = $_GET['idMonAn'];

if($phaihoi){
  echo header("refresh: 0; url='index.php?mod=Dish&act=DishDetail&idMonAn=$idMonAn&date=$date&phanhoi=ok'");

} else {
    echo '<script>alert("Lỗi đánh giá")</script>';

  echo header("refresh: 0; url='index.php?mod=Dish&act=DishDetail&idMonAn=$idMonAn&date=$date&phanhoi=ok'");

}
