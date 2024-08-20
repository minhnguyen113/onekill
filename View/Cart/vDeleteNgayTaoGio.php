<?php
include_once("Controller/cCart.php");
$p = new controlCart();


$ngayTaoGio = $_GET['ngayTaoGio'];
$p->DeleteMonAnByNgayTaoGio($ngayTaoGio);


echo header("refresh: 0; url='index.php?mod=cart'");

