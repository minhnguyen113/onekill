<?php
include_once("Controller/cManagement.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlManagement();


$idTaiKhoan = $_GET['idTaiKhoan'];

$del = $p->DeleteUser($idTaiKhoan);
if($del == 1){
  
    $noiDung = "Bạn đã xóa vĩnh viễn người dùng";
    $thoiGian =  date('Y-m-d H:i:s');
    $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
    $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
    echo '<script>alert("Xóa người dùng thành công")</script>';
  
}else{
    echo '<script>alert("Xóa người dùng thất bại")</script>';
    
}

if ($_GET['po'] == 'Kitchen') {
    echo header("refresh:0; url='admin.php?mod=ListKitchenDelete'");
} else {
    echo header("refresh:0; url='admin.php?mod=ListCustomerDelete'");
}