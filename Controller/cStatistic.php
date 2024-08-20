<?php

include_once("Model/mStatistic.php");
class ControlStatistic
{
    function getTotalQuantityByDay($ngayLenMon)
    {
        $p = new modelStatistic();
        $tbl = $p->SelectTotalQuantityByDay($ngayLenMon);
        return  $tbl;
    }

    function getTotalQuantityOrder($ngayLenMon)
    {
        $p = new modelStatistic();
        $tbl = $p->SelectTotalQuantityOrder($ngayLenMon);
        return  $tbl;
    }

    function getProceedsByDate($ngayLenMon)
    {
        $p = new modelStatistic();
        $tbl = $p->SelectProceedsByDate($ngayLenMon);
        return  $tbl;
    }

    function gettOrderbyDate($ngayLenMon)
    {
        $p = new modelStatistic();
        $tbl = $p->SelectOrderbyDate($ngayLenMon);
        return  $tbl;
    }
    function getIngredientsOfDish($ngayLenMon, $idMonAn)
    {
        $p = new modelStatistic();
        $tbl = $p->SelectingredientsOfDish($ngayLenMon, $idMonAn);
        return  $tbl;
    }

    function InsertThongBao($noiDung, $thoiGian, $idTaiKhoan)
    {
        $p = new modelStatistic();
        $tbl = $p->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
        return  $tbl;
    }


    
    function  getThongBao($trangThaiXem, $idTaiKhoan)
    {
        $p = new modelStatistic();
        $tbl = $p->SelectThongBao($trangThaiXem, $idTaiKhoan);
        return  $tbl;
    }

    function  UpdateThongBao($idTaiKhoan)

    {
        $p = new modelStatistic();
        $tbl = $p->UpdateThongBao($idTaiKhoan);
        return  $tbl;
    }

    function  InsertChat($noiDung, $idTaiKhoanChat, $idTaiKhoanGuiDen, $thoiGian)

    {
        $p = new modelStatistic();
        $tbl = $p->InsertChat($noiDung, $idTaiKhoanChat, $idTaiKhoanGuiDen, $thoiGian);
        return  $tbl;
    }

    function getHopThu($trangThaiXem, $idTaiKhoan)

    {
        $p = new modelStatistic();
        $tbl = $p->SelectHopThu($trangThaiXem, $idTaiKhoan);
        return  $tbl;
    }

    function UpdateHopThu($idTaiKhoan)
    {
        $p = new modelStatistic();
        $tbl = $p->UpdateHopThu($idTaiKhoan);
        return  $tbl;
    }
}
