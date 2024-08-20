<?php
include_once("Controller/cDish.php");
$p = new controlDish();

$idTraLoi = $_GET['idTraLoi'];
$idMonAn = $_GET['idMonAn'];
$date = $_GET['date'];
$kq = $p->DeleteTraLoiByIdTraLoi($idTraLoi);

if($kq){
    echo header("refresh: 0; url='index.php?mod=Dish&act=DishDetail&idMonAn=$idMonAn&date=$date&phanhoi=ok'");
} 
else {
    echo '<script>alert("Lỗi xóa trả lời")</script>';

    echo header("refresh: 0; url='index.php?mod=Dish&act=DishDetail&idMonAn=$idMonAn&date=$date&phanhoi=ok'");
}