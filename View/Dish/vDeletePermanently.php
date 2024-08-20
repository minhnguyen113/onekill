<?php
include_once("Controller/cDish.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlDish();


$idMonAn = $_GET['idMonAn'];
$delete =  $p->DeletePermanentlyDish($idMonAn);
if ($delete  == 1) {
    $noiDung = "Bạn đã xóa món ăn";
    $thoiGian =  date('Y-m-d H:i:s');
    $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];

    $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);

    echo '<script>alert("Xóa món ăn thành công")</script>';
} else {
    echo '<script>alert("Xóa món ăn thất bại")</script>';
}

echo header("refresh:0; url='admin.php?mod=ListDishAdmin'");
