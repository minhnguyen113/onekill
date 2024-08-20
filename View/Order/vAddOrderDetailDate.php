<?php
include_once("Controller/cOrder.php");
include_once("Controller/cCart.php");
include_once("Controller/cStatistic.php");


$cart = new controlCart();

$p = new controlOrder();

$sta = new ControlStatistic();


$listOrder = $p->getOrderNewCreateByIdTaiKhoan($idTaiKhoan);
$listCart = $cart->getCart();



$p->InsertOrderDetail($listCart, $listOrder);

$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];

$ngayLenMon = $_SESSION['ngayLenMon'];



 $cart-> DeleteCartbyidTaiKhoanByngayLenMon($idTaiKhoan, $ngayLenMon);

// ------------------------------------Tỉnh tổng hóa đơn

$OrderDetail = $p->getOrderDetail();
$Order = $p->getAllOrder();




$tongTienDonHang = array();
foreach($OrderDetail as $od){
    $tongTien = $od['gia'] * $od['soLuong'];
    $od['tongTien'] = $tongTien;
    $tongTienDonHang[] = $od;
}


$totalByDonId = array();
foreach ($tongTienDonHang as $item) {
    $idDon = $item['idDon'];
    $tongTien = $item['tongTien'];
    
    if (isset($totalByDonId[$idDon])) {
        $totalByDonId[$idDon] += $tongTien;
    } else {
        $totalByDonId[$idDon] = $tongTien;
    }
}

$p->UpdateTotalOrder($totalByDonId);
$noiDung = "Bạn đã đặt món ăn";
$thoiGian =  date('Y-m-d H:i:s');

$sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
$date = date('Y-m-d');
header("refresh: 0; url='index.php?mod=Dish&act=list&date=$date'");