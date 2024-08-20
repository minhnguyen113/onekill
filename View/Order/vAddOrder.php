<?php
include_once("Controller/cOrder.php");
include_once("Controller/cCart.php");

$cart = new controlCart();

$p = new controlOrder();


// $idDon  = rand(0, 1000000);


$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
$currentDate = new DateTime();
$tongTien = 0;
$ngayDat = $currentDate->format('Y-m-d H:i:s');
$listbuy = $cart->getAllCartByIdTaiKhoan($idTaiKhoan);

if (!empty($listbuy)) {
    foreach ($listbuy as $item) {
        $idTaiKhoan = $item['idTaiKhoan'];
        $ngayLenMon = $item['ngayLenMon'];

        // Check if the result array already has an entry for the idTaiKhoan and ngayLenMon
        if (isset($result[$idTaiKhoan][$ngayLenMon])) {
            $result[$idTaiKhoan][$ngayLenMon]['soLuong'] += $item['soLuong'];
            $result[$idTaiKhoan][$ngayLenMon]['tenMon'] .= ', ' . $item['tenMon'];
        } else {
            // Create a new entry in the result array for the idTaiKhoan and ngayLenMon
            $result[$idTaiKhoan][$ngayLenMon] = [
                'idTaiKhoan' => $idTaiKhoan,
                'maNhanVien' => $item['maNhanVien'],
                'hoTen' => $item['hoTen'],
                'soDienThoai' => $item['soDienThoai'],
                'soLuong' => $item['soLuong'],
                'tenMon' => $item['tenMon'],
                'ngayLenMon' => $item['ngayLenMon']
            ];
        }
    }
}




$p->InsertOrder($idTaiKhoan,$result[$idTaiKhoan], $tongTien, $ngayDat);




echo header("refresh: 0; url='index.php?mod=Order&act=AddDetailOrder'");