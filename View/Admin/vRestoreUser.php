<?php
include_once("Controller/cManagement.php");

$p = new controlManagement();


$idTaiKhoan = $_GET['idTaiKhoan'];

$res = $p->RestoreUser($idTaiKhoan);
if ($res== 1) {
    echo '<script>alert("Khôi phục người dùng thành công")</script>';
} else {
    echo '<script>alert("Khôi phục người dùng thất bại")</script>';
}

if ($_GET['po'] == 'Kitchen') {
    echo header("refresh:0; url='admin.php?mod=ListKitchenDelete'");
} else {
    echo header("refresh:0; url='admin.php?mod=ListCustomerDelete'");
}
