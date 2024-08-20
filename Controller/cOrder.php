
<?php

include_once("Model/mOrder.php");
class controlOrder
{


    function InsertOrder($idTaiKhoan, $result, $tongTien, $ngayDat)
    {
        $p = new modelOrder();
        $tbl = $p->InsertOrder($idTaiKhoan, $result, $tongTien, $ngayDat);
        return  $tbl;
    }

    function InsertOrderDetail($listCart, $listOrder)
    {
        $p = new modelOrder();
        $tbl = $p->InsertOrderDetail($listCart, $listOrder);
        return  $tbl;
    }

    function  getThanhToanByIdTaiKhoan($idTaiKhoan)
    {
        $p = new modelOrder();
        $tbl = $p->SelectThanhToanByIdTaiKhoan($idTaiKhoan);
        return  $tbl;
    }
    
    function getOrderDetailByNgayLenMon($ngayLenMon)
    {
        $p = new modelOrder();
        $tbl = $p->SelectOrderDetailByNgayLenMon($ngayLenMon);
        return  $tbl;
    }

    function  getThanhToan()
    {
        $p = new modelOrder();
        $tbl = $p->SelectThanhToan();
        return  $tbl;
    }
    function getThanhToanByIdTaiKhoanAndIdDonHang($idTaiKhoan, $idThanhToan)

    {
        $p = new modelOrder();
        $tbl = $p->SelectThanhToanByIdTaiKhoanAndIdDonHang($idTaiKhoan, $idThanhToan);
        return  $tbl;
    }

    function  getOrderByNgayLenMon($ngayLenMon)
    {
        $p = new modelOrder();
        $tbl = $p->SelectOrderByNgayLenMon($ngayLenMon);
        return  $tbl;
    }
    function  getOrderByidTaiKhoan($idTaiKhoan)
    {
        $p = new modelOrder();
        $tbl = $p->SelectOrderByidTaiKhoan($idTaiKhoan);
        return  $tbl;
    }
    function  getSumOrderPayByidTaiKhoan($idTaiKhoan)
    {
        $p = new modelOrder();
        $tbl = $p->SelectSumOrderPayByidTaiKhoan($idTaiKhoan);
        return  $tbl;
    }


    function getOrderByidTaiKhoanFind($idTaiKhoan, $trangThaiThanhToan, $duyetDon)
    {
        $p = new modelOrder();
        $tbl = $p->SelectOrderByidTaiKhoanFind($idTaiKhoan, $trangThaiThanhToan, $duyetDon);
        return  $tbl;
    }
    function getSumOrderByidTaiKhoan($idTaiKhoan)
    {
        $p = new modelOrder();
        $tbl = $p->SelectSumOrderByidTaiKhoan($idTaiKhoan);
        return  $tbl;
    }

    function getSumOrder()

    {
        $p = new modelOrder();
        $tbl = $p->SelectSumOrder();
        return  $tbl;
    }

    function getOrder()
    {
        $p = new modelOrder();
        $tbl = $p->SelectOrder();
        return  $tbl;
    }

    function gettOrderSumTotal($ngayLenMon)
    {
        $p = new modelOrder();
        $tbl = $p->SelectOrderSumTotal($ngayLenMon);
        return  $tbl;
    }

    function getOrderNewCreateByIdTaiKhoan($idTaiKhoan)
    {
        $p = new modelOrder();
        $tbl = $p->SelectOrderNewCreateByIdTaiKhoan($idTaiKhoan);
        return  $tbl;
    }

    function  ApproveOrder($approve, $ngayLenMon)
    {
        $p = new modelOrder();
        $tbl = $p->ApproveOrder($approve, $ngayLenMon);
        return  $tbl;
    }


    function getOrderDetail()
    {
        $p = new modelOrder();
        $tbl = $p->SelectOrderDetail();
        return  $tbl;
    }

    function  SelectOrderNoPay()

    {
        $p = new modelOrder();
        $tbl = $p->SelectOrderNoPay();
        return  $tbl;
    }

    function getAllOrder()
    {
        $p = new modelOrder();
        $tbl = $p->SelectAllOrder();
        return  $tbl;
    }

    function UpdateTotalOrder($totalByDonId)
    {
        $p = new modelOrder();
        $tbl = $p->UpdateTotalOrder($totalByDonId);
        return  $tbl;
    }
    function UpdateTotalAndQuantityOrder($totalByDonId)

    {
        $p = new modelOrder();
        $tbl = $p->UpdateTotalAndQuantityOrder($totalByDonId);
        return  $tbl;
    }

    function PaymentSuccess($idTaiKhoan)
    {
        $p = new modelOrder();
        $pay = $p->PaymentSuccess($idTaiKhoan);
        if ($pay) {
            return 1;
        } else {
            return 0;
        }
    }

    function  PaymentMultipleSuccess($TaiKhoan)
    {
        $p = new modelOrder();
        $pay = $p->PaymentMultipleSuccess($TaiKhoan)
        ;
        if ($pay) {
            return 1;
        } else {
            return 0;
        }
    }

    function InsertThanhToan($idThanhToan, $ngayThanhToan, $soTien, $idTaiKhoan, $hinhThucThanhToan)
    {
        $p = new modelOrder();
        $tbl = $p->InsertThanhToan($idThanhToan, $ngayThanhToan, $soTien, $idTaiKhoan, $hinhThucThanhToan);
        return  $tbl;
    }

    function InsertChiTietThanhToan($dish, $idThanhToan)
    {
        $p = new modelOrder();
        $tbl = $p->InsertChiTietThanhToan($dish, $idThanhToan);
        return  $tbl;
    }

    function InsertThanhToanKitChen($result){
 
        $p = new modelOrder();
        $tbl = $p->InsertThanhToanKitChen($result);
        return  $tbl;
    }

    function InsertChiTietThanhToanKitChen($paymentInfo){
        $p = new modelOrder();
        $tbl = $p->InsertChiTietThanhToanKitChen($paymentInfo);
        return  $tbl;
    }

    function DeleteDishNoMenu($idMonAn, $ngayLenMon)
    {
        $p = new modelOrder();
        $tbl = $p->DeleteDishNoMenu($idMonAn, $ngayLenMon);
        return  $tbl;
    }
}
