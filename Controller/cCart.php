<?php

include_once("Model/mCart.php");
class ControlCart
{
    function getAllCart($idTaiKhoan)
    {
        $p = new modelCart();
        $tbl = $p->SelectAllCart($idTaiKhoan);
        return  $tbl;
    }
    function getCart()
    {
        $p = new modelCart();
        $tbl = $p->SelectCart();
        return  $tbl;
    }


    function GetCartById($idGioHang)
    {
        $p = new modelCart();
        $tbl = $p->SelectCartById($idGioHang);
        return  $tbl;
    }

    function getAllCartByIdTaiKhoan($idTaiKhoan)
    {
        $p = new modelCart();
        $tbl = $p->SelectAllCartByIdTaiKhoan($idTaiKhoan);
        return  $tbl;
    }

    function getAllCartByIdTaiKhoanAndNgayLenMon($idTaiKhoan, $ngayLenMon)

    {
        $p = new modelCart();
        $tbl = $p-> SelectAllCartByIdTaiKhoanAndNgayLenMon($idTaiKhoan, $ngayLenMon);
        return  $tbl;
    }


    function getTaiKhoanChiTietGioHangAndNgayLenMon($idTaiKhoan, $ngayLenMon)
    {
        $p = new modelCart();
        $tbl = $p->SelectIdTaiKhoanChiTietGioHangAndNgayLenMon($idTaiKhoan, $ngayLenMon);
        return  $tbl;
    }

    function getIdTaiKhoanChiTietGioHang($idTaiKhoan)
    {
        $p = new modelCart();
        $tbl = $p->SelectIdTaiKhoanChiTietGioHang($idTaiKhoan);
        return  $tbl;
    }



    function CreateShopCart($idGioHang, $ngayTao, $tongTien)
    {
        $p = new modelCart();
        $tbl = $p->CreateCart($idGioHang, $ngayTao, $tongTien);
        return  $tbl;
    }

    function CreateShopCartDetails($idGioHang, $idTaiKhoan, $idMonAn, $soLuong, $ngayLenMon, $ngayTao)
    {
        $p = new modelCart();
        $tbl = $p->CreateCartDetails($idGioHang, $idTaiKhoan, $idMonAn, $soLuong, $ngayLenMon, $ngayTao);
        return  $tbl;
    }



    function UpdateShopCartDetails($soLuong, $idMonAn, $ngayLenMon)
    {

        $p = new modelCart();
        $tbl = $p->UpdateCartDetails($soLuong, $idMonAn, $ngayLenMon);
        return  $tbl;
    }




    function  DeleteDuplicateCartDatas()
    {
        $p = new modelCart();
        $tbl = $p->DeleteDuplicateCartData();
        return  $tbl;
    }

    function DeleteMonAnByNgayTaoGio($ngayTaoGio)
    {
        $p = new modelCart();
        $delete = $p->DeleteMonAnByNgayTaoGio($ngayTaoGio);
        return $delete;
    }

    function  DeleteMonAnByNgayLenMon($ngayLenMon)
    {
        $p = new modelCart();
        $delete = $p->DeleteMonAnByNgayLenMon($ngayLenMon);
        return $delete;
    }

    function DeleteAllCartbyidTaiKhoan($idTaiKhoan)
    {
        $p = new modelCart();
        $delete = $p->DeleteAllCartbyidTaiKhoan($idTaiKhoan);
        return $delete;
    }

    function DeleteCartbyidTaiKhoanByngayLenMon($idTaiKhoan, $ngayLenMon)
    {
        $p = new modelCart();
        $delete = $p->DeleteCartbyidTaiKhoanByngayLenMon($idTaiKhoan, $ngayLenMon);
        return $delete;
    }

    function DeleteDishCartOutDate($ngayHomNay)
    {
        $p = new modelCart();
        $delete = $p->DeleteDishCartOutDate($ngayHomNay);
        return $delete;
    }

    function DeleteDishCartNoMenu($idMonAn, $ngayLenMon)

    {
        $p = new modelCart();
        $delete = $p->DeleteDishCartNoMenu($idMonAn, $ngayLenMon);
        return $delete;
    }

}