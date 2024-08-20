<?php
include_once("ketnoi.php");
class modelCart
{

    function SelectAllCart($idTaiKhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM chitietgiohang INNER JOIN monan on chitietgiohang.idMonAn = monan.idMonAn
        INNER JOIN taikhoan on chitietgiohang.idTaiKhoan = taikhoan.idTaiKhoan Where taikhoan.idTaiKhoan = $idTaiKhoan
        ";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function SelectCart()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM chitietgiohang ";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    
    function SelectAllCartByIdTaiKhoan($idTaiKhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = " SELECT * FROM chitietgiohang INNER JOIN taikhoan on chitietgiohang.idTaiKhoan = taikhoan.idTaiKhoan 
    INNER JOIN monan on chitietgiohang.idMonAn = monan.idMonAn  where taikhoan.idTaiKhoan=$idTaiKhoan";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    
    function SelectAllCartByIdTaiKhoanAndNgayLenMon($idTaiKhoan, $ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = " SELECT * FROM chitietgiohang INNER JOIN taikhoan on chitietgiohang.idTaiKhoan = taikhoan.idTaiKhoan 
    INNER JOIN monan on chitietgiohang.idMonAn = monan.idMonAn  where taikhoan.idTaiKhoan=$idTaiKhoan and chitietgiohang.ngayLenMon = '$ngayLenMon'";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }




    function SelectCartById($idGioHang)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM giohang where idGioHang = $idGioHang";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }


    function SelectIdTaiKhoanChiTietGioHangAndNgayLenMon($idTaiKhoan, $ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM chitietgiohang where idTaiKhoan = $idTaiKhoan and ngayLenMon ='$ngayLenMon'";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function SelectIdTaiKhoanChiTietGioHang($idTaiKhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM chitietgiohang where idTaiKhoan = $idTaiKhoan";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function CreateCart($idGioHang, $ngayTao, $tongTien)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = " INSERT INTO giohang(idGioHang, ngayTao, tongTien) 
        VALUES ('$idGioHang','$ngayTao', '$tongTien') ";
        $kq = mysqli_query($connect, $insert);
        $p->dongketnoi($connect);
        return $kq;
    }

    function CreateCartDetails($idGioHang, $idTaiKhoan, $idMonAn, $soLuong, $ngayLenMon, $ngayTao)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = " INSERT INTO chitietgiohang(idGioHang, idTaiKhoan, idMonAn, soLuong,ngayLenMon,  ngayTaoGio) 
        VALUES ('$idGioHang', '$idTaiKhoan', '$idMonAn', '$soLuong','$ngayLenMon' ,'$ngayTao')";
        $kq = mysqli_query($connect, $insert);
        $p->dongketnoi($connect);
        return $kq;
    }





    function UpdateCartDetails($soLuong, $idMonAn, $ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "UPDATE chitietgiohang SET soLuong = $soLuong WHERE idMonAn = $idMonAn and ngayLenMon = '$ngayLenMon'";
        $kq = mysqli_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }








    function DeleteDuplicateCartData()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = " DELETE c1 FROM chitietgiohang c1 JOIN chitietgiohang c2 ON c1.idMonAn = c2.idMonAn and c1.ngayLenMon = c2.ngayLenMon WHERE c1.ngayTaoGio < c2.ngayTaoGio";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq;
    }


    function DeleteMonAnByNgayTaoGio($ngayTaoGio)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "DELETE FROM chitietgiohang WHERE ngayTaoGio= '$ngayTaoGio'";
        $kq = mysqli_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }


    function DeleteMonAnByNgayLenMon($ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "DELETE FROM chitietgiohang WHERE ngayLenMon= '$ngayLenMon'";
        $kq = mysqli_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }

    function DeleteAllCartbyidTaiKhoan($idTaiKhoan){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = "DELETE FROM chitietgiohang Where idTaiKhoan = $idTaiKhoan";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq;
    }

    function DeleteCartbyidTaiKhoanByngayLenMon($idTaiKhoan, $ngayLenMon){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = "DELETE FROM chitietgiohang Where idTaiKhoan = $idTaiKhoan and ngayLenMon	= '$ngayLenMon'";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq;
    }


    function DeleteDishCartOutDate($ngayHomNay){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = "DELETE FROM chitietgiohang Where  ngayLenMon	<= '$ngayHomNay' ";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq;
    }

 
    function DeleteDishCartNoMenu($idMonAn, $ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
  
            $Delete = "DELETE FROM chitietgiohang WHERE idMonAn =$idMonAn AND ngayLenMon='$ngayLenMon'";

        $kq = mysqli_multi_query($connect, $Delete);
        $p->dongketnoi($connect);
        return $kq;
    }

}
