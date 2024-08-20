<?php
include_once("Controller/cDish.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlDish();


$idNguyenLieu = $_GET['idNguyenLieu'];
$delete =  $p->DeleteTemporaryIngredient($idNguyenLieu);
if($delete  == 1){
    $noiDung = "Bạn đã xóa nguyên liệu";
    $thoiGian =  date('Y-m-d H:i:s');
$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
    $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
    echo '<script>alert("Xóa món nguyên liệu thành công")</script>';
  
}else{
    echo '<script>alert("Xóa nguyên liệu thất bại")</script>';
    
}

echo header("refresh:0; url='admin.php?mod=ListIngredient'");

?>