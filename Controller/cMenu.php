<?php

include_once("Model/mMenu.php");
class controlMenu
{
    function getLatestMenu()
    {
        $p = new modelMenu();
        $tbl = $p->SelectLatestMenu();
        return  $tbl;
    }

    function getAlltMenu()
    {
        $p = new modelMenu();
        $tbl = $p->SelectAllMenu();
        return  $tbl;
    }

    
    function   getAllMenuDetailMenu()

    {
        $p = new modelMenu();
        $tbl = $p->SelectAllMenuDetailMenu();
        return  $tbl;
    }
    function InsertMenuDetails($idThucDon, $idMonAn)
    {
        $p = new modelMenu();
        $tbl = $p->InsertMenuDetails($idThucDon, $idMonAn);
        if ($tbl) {
            return 1;
        } else {
            return 0;
        }
    }

    function InsertMenu($ngayTao)
    {
        $p = new modelMenu();
        $tbl = $p->InsertMenu($ngayTao);
        return  $tbl;
    }

    function getMenuByDate($ngayTao)
    {

        $p = new modelMenu();
        $tbl = $p->SelectMenuByDate($ngayTao);
        return  $tbl;
    }
    function getOneMenuByDate($ngayTao)
    {

        $p = new modelMenu();
        $tbl = $p->SelectOneMenuByDate($ngayTao);;
        return  $tbl;
    }

    function  DeletedDishByidMonAnAndByIdThucDon($idMonAn, $idThucDon)
    {

        $p = new modelMenu();
        $tbl = $p->DeletedDishByidMonAnAndByIdThucDon($idMonAn, $idThucDon);
        return  $tbl;
    }
}
