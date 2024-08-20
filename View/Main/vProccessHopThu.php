<?php
   include_once("Controller/cStatistic.php");
   $sta = new ControlStatistic();

$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
   $sta->UpdateHopThu($idTaiKhoan);


