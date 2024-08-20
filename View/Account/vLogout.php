<?php
include_once("Controller/cManagement.php");

$p = new controlManagement();


$now = new DateTime();
$thoigian  = $now->format('Y-m-d H:i:s');

$id_taikhoan =  $_SESSION['is_login']['idTaiKhoan'];
$p->addHoatDong($thoigian, $id_taikhoan);

unset($_SESSION['login']);
unset($_SESSION['is_login']);
 header("refresh: 0; url='index.php'");

?>
