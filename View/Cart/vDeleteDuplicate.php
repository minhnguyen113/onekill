


<?php
include_once("Controller/cCart.php");
$p = new controlCart();

$p->DeleteDuplicateCartDatas();


$date = $_GET['date'];
echo header("refresh: 0; url='index.php?mod=Dish&act=list&date=$date'");