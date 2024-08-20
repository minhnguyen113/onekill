<?php
include_once("ketnoi.php");
class modelStatistic
{

    function SelectOrderbyDate($ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT chitietdon.idMonAn, monan.tenMon, monan.hinhAnhMon, chitietdon.ngayLenMon, 
        SUM(soLuong) AS tongSoLuong FROM chitietdon INNER JOIN monan ON chitietdon.idMonAn = monAn.idMonAn
         WHERE chitietdon.ngayLenMon = '$ngayLenMon' GROUP BY idMonAn, ngayLenMon";
        $table = mysqli_query($connect, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function SelectingredientsOfDish($ngayLenMon, $idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT nguyenlieu.tenNguyenLieu, chitietnguyelieumonan.soLuong FROM chitietdon 
        INNER JOIN monan ON chitietdon.idMonAn = monan.idMonAn INNER JOIN chitietnguyelieumonan
         ON monan.idMonAn = chitietnguyelieumonan.idMonAn
         INNER JOIN nguyenlieu ON chitietnguyelieumonan.idNguyenLieu = nguyenlieu.idNguyenLieu 
         WHERE chitietdon.ngayLenMon = '$ngayLenMon' AND chitietdon.idMonAn= $idMonAn GROUP BY tenNguyenLieu, soLuong;";
        $table = mysqli_query($connect, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }





  
     function SelectTotalQuantityByDishAndByDay()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT idMonAn, ngayLenMon, SUM(soLuong) AS TongSoLuong FROM chitietdon GROUP BY idMonAn, ngayLenMon ORDER BY ngayLenMon, idMonAn";
        $table = mysqli_query($connect, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function SelectTotalQuantityByDay($ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT ngayLenMon, SUM(soLuong) AS TongSoLuongTheoNgay FROM chitietdon WHERE ngayLenMon= '$ngayLenMon' GROUP BY ngayLenMon";
        $table = mysqli_query($connect, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function SelectTotalQuantityOrder($ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT idTaiKhoan, ngayLenMon FROM dondatmon  WHERE ngayLenMon= '$ngayLenMon' GROUP BY idTaiKhoan, ngayLenMon;";
        $table = mysqli_query($connect, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }



    
    function SelectProceedsByDate($ngayLenMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT monan.tenMon, chitietdon.idMonAn, chitietdon.ngayLenMon, 
        SUM(soLuong) AS TongSoLuong, SUM(soLuong)*monan.gia as TongTien FROM chitietdon
         INNER JOIN monan on chitietdon.idMonAn = monan.idMonAn WHERE chitietdon.ngayLenMon = '$ngayLenMon' 
         GROUP BY chitietdon.idMonAn, chitietdon.ngayLenMon;";
        $table = mysqli_query($connect, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }


    function InsertThongBao($noiDung, $thoiGian, $idTaiKhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();

        $insert = "INSERT INTO thongbao(noiDung, thoiGian, idTaiKhoan)
        VALUES ('$noiDung', '$thoiGian', $idTaiKhoan)";

        $kq = mysqli_query($connect, $insert);
        $p->dongketnoi($connect);
        return $kq;
    }

    function SelectThongBao($trangThaiXem, $idTaiKhoan){
    
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $ttx ='';
        if($trangThaiXem !=''){
                $ttx = "AND trangThaiXem = $trangThaiXem";
        }
        $tblUsers = "SELECT *FROM thongbao WHERE idTaiKhoan = $idTaiKhoan $ttx  ORDER BY thoiGian DESC";
        $table = mysqli_query($connect, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function UpdateThongBao($idTaiKhoan){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
            $update = "UPDATE `thongbao` SET `trangThaiXem` = 1 WHERE idTaiKhoan=$idTaiKhoan";
            $kq = mysqli_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }

    function InsertChat($noiDung, $idTaiKhoanChat, $idTaiKhoanGuiDen, $thoiGian)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();

        $insert = "INSERT INTO chat(noiDung, idTaiKhoanChat, idTaiKhoanGuiDen, thoiGian)
        VALUES ('$noiDung', '$idTaiKhoanChat', '$idTaiKhoanGuiDen', '$thoiGian')";

        $kq = mysqli_query($connect, $insert);
        $p->dongketnoi($connect);
        return $kq;
    }




    function SelectHopThu($trangThaiXem, $idTaiKhoan){
    
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $ttx ='';
        if($trangThaiXem !=''){
                $ttx = "AND trangThaiXem = $trangThaiXem";
        }
        $tblUsers = "SELECT *FROM hopthu INNER JOIN taiKhoan ON hopthu.idTaiKhoanNoiDung = taikhoan.idTaiKhoan WHERE idTaiKhoanGuiDen = $idTaiKhoan $ttx ORDER BY thoiGian DESC";
        $table = mysqli_query($connect, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }


    function UpdateHopThu($idTaiKhoan){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
            $update = "UPDATE `hopthu` SET `trangThaiXem` = 1 WHERE idTaiKhoanGuiDen=$idTaiKhoan";
            $kq = mysqli_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }


}