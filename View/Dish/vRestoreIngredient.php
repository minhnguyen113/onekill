<?php
include_once("Controller/cDish.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlDish();


$idNguyenLieu = $_GET['idNguyenLieu'];
$Restore =  $p->RestoreIngredient($idNguyenLieu);
if($Restore == 1){
    $noiDung = "Bạn đã khôi phục nguyên liệu";
    $thoiGian =  date('Y-m-d H:i:s');
    $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
    $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
    echo '<script>alert("Khôi phục nguyên liệu thành công")</script>';
  
}else{
    echo '<script>alert("Khôi phục nguyên liệu thất bại")</script>';
    
}

echo header("refresh:0; url='admin.php?mod=ListIngredient'");


?>
