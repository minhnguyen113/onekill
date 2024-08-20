<?php
include_once("Controller/cCart.php");
$p = new controlCart();


$ngayLenMon= $_GET['ngayLenMon'];
$p->DeleteMonAnByNgayLenMon($ngayLenMon);


echo header("refresh: 0; url='index.php?mod=cart'");

