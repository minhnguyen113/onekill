<?php

include_once("Controller/cOrder.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlOrder();







$Pays = array();


$tongTien = array();
foreach ($_POST as $key => $value) {
    $keySub = preg_replace('/[^0-9]/', '', $key); //lấy số bỏ chữ
    $index =  substr($key, 0, -1);
    $money = preg_replace('/\d+/', '', $key); //lấy chữ bỏ số
    if($money=='tongTien'){
        $tongTien[$keySub] = $value; //tạo mảng lấy key = idTaiKhoan
       
    }
    if ( $value =='on') {
     
      $ord = $p->getSumOrderPayByidTaiKhoan($key);
        foreach ($ord as $id => $or) {
            $Pays[$key][$id]['taiKhoan'] =  $key;
            $Pays[$key][$id]['tongTien'] =  $tongTien[$key];
            $Pays[$key][$id]['tenMon'] = $or['tenMon'];
            $Pays[$key][$id]['soLuong'] = $or['soLuong'];
            $Pays[$key][$id]['gia'] = $or['gia'];
        }
       
    }
}


$i = 0;
$result = array();
$paymentInfo = array();
foreach ($Pays as $index => $pay) {
    $idTaiKhoan = $pay[0]['taiKhoan'];
    $soTien = $pay[0]['tongTien'];
    $idThanhToan = $idTaiKhoan . rand(0, 10000);
    $hinhThucThanhToan = "Tại bếp ăn";
    $ngayThanhToan = date('Y-m-d H:i:s');

    $result[] = array(
        'idTaiKhoan' => $idTaiKhoan,
        'soTien' => $soTien,
        'idThanhToan' => $idThanhToan,
        'hinhThucThanhToan' => $hinhThucThanhToan,
        'ngayThanhToan' => $ngayThanhToan,

    );

    foreach ($pay as $item) {
        $tenMon = $item['tenMon'];
        $gia = $item['gia'];
        $soLuong = $item['soLuong'];

        $paymentInfo[] = array(
            'idThanhToan' => $idThanhToan,

            'tenMon' => $tenMon,
            'gia' => $gia,
            'soLuong' => $soLuong
        );
    }
}

if(!empty($Pays)){
    $TaiKhoan = array();
    foreach ($_POST as $index => $item) {
        if ($item == 'on') {
            $TaiKhoan[] = array(
                'idTaiKhoan' => $index
            );
        }
    }
    $p->InsertThanhToanKitChen($result);
    $p->InsertChiTietThanhToanKitChen($paymentInfo);
    $kq = $p->PaymentMultipleSuccess($TaiKhoan);
    if ($kq) {
        echo header("refresh: 0; url='admin.php?mod=PayKitchen'");
    } else {
        echo '<script>alert("Thanh toán lỗi")</script>';
        echo header("refresh: 0; url='admin.php?mod=PayKitchen'");
    }


}
echo header("refresh: 0; url='admin.php?mod=PayKitchen'");
