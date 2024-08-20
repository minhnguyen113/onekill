<?php

include_once("Controller/cMenu.php");
include_once("Controller/cOrder.php");
include_once("Controller/cCart.php");

$cart = new controlCart();

$p = new controlOrder();

$menu = new controlMenu();

$idMonAn = $_GET['idMonAn'];
$idThucDon = $_GET['idThucDon'];
$ngayLenMon = $_GET['ngayLenMon'];

$kq = $menu->DeletedDishByidMonAnAndByIdThucDon($idMonAn, $idThucDon);
if ($kq == 1) {
    echo '<script>alert("xóa món khỏi menu thành công")</script>';


    ///////////Xóa  món ăn đã đặt không có trong menu

    $p->DeleteDishNoMenu($idMonAn, $ngayLenMon);
    /////Xóa món ăn đã thêm vào giỏ hàng không có trong menu
    $cart->DeleteDishCartNoMenu($idMonAn, $ngayLenMon);
} else {
    echo '<script>alert("xóa món khỏi menu thất bại")</script>';
}
echo header("refresh: 0; url='admin.php?mod=listMenu'");
