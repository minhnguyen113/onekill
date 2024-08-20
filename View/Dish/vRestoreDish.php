<?php
include_once("Controller/cDish.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlDish();


$idMonAn = $_GET['idMonAn'];
$Restore =  $p->RestoreDish($idMonAn);
if($Restore == 1){
    $noiDung = "Bạn đã khôi phục món ăn";
    $thoiGian =  date('Y-m-d H:i:s');
    $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
    $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
    echo '<script>alert("Khôi phục món ăn thành công")</script>';
  
}else{
    echo '<script>alert("Khôi phục món ăn thất bại")</script>';
    
}

echo header("refresh:0; url='admin.php?mod=BinTemporary'");

?>
