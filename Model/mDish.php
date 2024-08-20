<?php
include_once("ketnoi.php");
class modelDish
{

    function SelectAllDish()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM monan WHERE trangThai =1";
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


    function SelectAllDishIngredient($idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM monan INNER JOIN chitietnguyelieumonan ON monan.idMonAn = chitietnguyelieumonan.idMonAn 
        INNER JOIN nguyenlieu ON chitietnguyelieumonan.idNguyenLieu = nguyenlieu.idNguyenLieu
        WHERE monan.idMonAn = $idMonAn";
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



    function SelectAllDishWait($wait)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM monan INNER JOIN loaimonan on monan.idLoaiMon = loaimonan.idLoaiMon Where monan.trangThai =$wait AND monan.hoatDong =1 ORDER BY idMonAn ASC";
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

    function SelectDishNew()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM monan ORDER BY idMonAn DESC LIMIT 1;";
        $table = mysqli_query($connect, $tbl);
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_user = $row;
            }
            return $list_user;
        }
        $p->dongketnoi($connect);
    }


    function SelectAllNguyenLieu()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM nguyenlieu WHERE trangThai =1 ";
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

    function SelectAllDishByIdLoai($id)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM monan where idLoaiMon = $id";
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

    function SelectAllLoaiMonAn()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM loaimonan ";
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


    public function Dish_search($search)
    {


        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $search = "SELECT * FROM monan where tenMon LIKE '%$search%' OR gia like '%$search%' OR Mota like '%$search%' ORDER BY gia ASC";
        $table = mysqli_query($connect, $search);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }


    function SelectLoaiMonAnById($id)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM monan where idMonAn = $id ";
        $table = mysqli_query($connect, $tbl);
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function SelectNguyenLieu()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM `nguyenlieu` Where trangThai = 1";
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

    function SelectNguyenLieuDelete()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM `nguyenlieu` Where trangThai = 0";
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

    function SelectAllDishMenu()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idThucDon = chitietthucdon.idThucDon
        JOIN monan ON chitietthucdon.idMonAn = monan.idMonAn ";
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

    function SelectAllDishMenuByDate($ngayTao)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idThucDon = chitietthucdon.idThucDon
        JOIN monan ON chitietthucdon.idMonAn = monan.idMonAn WHERE ngayTao = '$ngayTao'";
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


    public function  SelectAllDishMenuidMonAn($idMonAn)
    {

        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM monan INNER JOIN chitietthucdon ON monan.idMonAn = chitietthucdon.idMonAn
         INNER JOIN thucdon ON chitietthucdon.idThucDon = thucdon.idThucDon where monan.idMonAn = '$idMonAn'";
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


    function InsertDishNew($tenMon, $gia, $Mota, $hinhAnhMon, $idLoaiMon)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO monan (tenMon ,gia,Mota, hinhAnhMon,idLoaiMon)
        VALUES  ('$tenMon',$gia,'$Mota', '$hinhAnhMon',$idLoaiMon)";
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }

    function InsertIngerdienthNew($tenNguyenLieu, $hinhAnh, $ngayTao)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO nguyenlieu (tenNguyenLieu ,hinhAnh,ngayTao)
        VALUES  ('$tenNguyenLieu','$hinhAnh','$ngayTao')";
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }

    function InsertChiTietNguyenLieuMonAn($listNlWeight, $idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO chitietnguyelieumonan (`idNguyenLieu`, `idMonAn`,  `soLuong`) VALUES ";

        foreach ($listNlWeight as $index => $item) {

            $idNL = $item['nguyenlieu'][$index];
            $Weight = $item['weight'];
            $insert .= "($idNL, $idMonAn, $Weight), ";
        }
        $insert = rtrim($insert, ", ");
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }

    function InsertUpdateChiTietNguyenLieuMonAn($listNlWeight, $idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO chitietnguyelieumonan (`idNguyenLieu`, `idMonAn`,  `soLuong`) VALUES ";

        foreach ($listNlWeight as $index => $item) {

            $idNL = $item['nguyenlieu'];
            $Weight = $item['weight'];
            $insert .= "($idNL, $idMonAn, $Weight), ";
        }
        $insert = rtrim($insert, ", ");
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }


    function DeleteTemporaryDish($idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "UPDATE monan SET hoatDong = 0 Where idMonAn = $idMonAn";
        $kq = mysqli_query($connect,  $update);
        $p->dongketnoi($connect);
        return $kq;
    }

    function RestoreDish($idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "UPDATE monan SET hoatDong = 1 Where idMonAn = $idMonAn";
        $kq = mysqli_query($connect,  $update);
        $p->dongketnoi($connect);
        return $kq;
    }

    function DeletePermanentlyDish($idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "DELETE FROM monan  Where idMonAn = $idMonAn";
        $kq = mysqli_query($connect,  $update);
        $p->dongketnoi($connect);
        return $kq;
    }

    function DeleteTemporaryIngredient($idNguyenLieu)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "UPDATE nguyenlieu SET trangThai = 0 Where idNguyenLieu = $idNguyenLieu";
        $kq = mysqli_query($connect,  $update);
        $p->dongketnoi($connect);
        return $kq;
    }

    function RestoreIngredient($idNguyenLieu)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "UPDATE nguyenlieu SET trangThai = 1 Where idNguyenLieu = $idNguyenLieu";
        $kq = mysqli_query($connect,  $update);
        $p->dongketnoi($connect);
        return $kq;
    }



    function SelectDeleteTemporaryDish()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM monan INNER JOIN loaimonan on monan.idLoaiMon = loaimonan.idLoaiMon WHERE hoatDong = 0";
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



    function UpdateDishById($idMonAn, $tenMon, $gia, $Mota, $hinhAnhMon, $idLoaiMon)
    {

        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "UPDATE monan SET  tenMon = '$tenMon', gia = '$gia', Mota = '$Mota', hinhAnhMon='$hinhAnhMon', idLoaiMon = '$idLoaiMon'
         WHERE idMonAn = $idMonAn";
        $kq = mysqli_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }

    function DeleteNguyenLieuByIdMonAn($idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = "DELETE FROM chitietnguyelieumonan WHERE idMonAn = $idMonAn";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq;
    }



    function AcceptDish($idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = '';
        foreach ($idMonAn as $id) {
            $update .= "UPDATE monan SET `trangThai` = 1 WHERE idMonAn = $id; ";
        }

        $kq = mysqli_multi_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }


    function InsertPhanHoi($idTaiKhoan,$idMonAn,$noiDungPhanHoi,$danhGia, $ngayDanhGia)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO phanhoi (idTaiKhoan, idMonAn, noiDungPhanHoi, danhGia, ngayDanhGia)
        VALUES  ('$idTaiKhoan','$idMonAn','$noiDungPhanHoi','$danhGia','$ngayDanhGia')";
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }

    function InsertTraLoi($idTaiKhoan,$noiDung,$idPhanHoi,$ngayTraLoi)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO traloiphanhoi (idTaiKhoan,noiDung,idPhanHoi, ngayTraLoi)
        VALUES  ('$idTaiKhoan','$noiDung','$idPhanHoi','$ngayTraLoi')";
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }

    function InsertHopThu($noiDungThu,$thoiGian,$idTaiKhoanGuiDen, $idMonAn, $ngayLenMon, $idTaiKhoanNoiDung)
    {	
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO hopthu (noiDungThu, thoiGian, idTaiKhoanGuiDen,idMonAn, ngayLenMon,idTaiKhoanNoiDung)
        VALUES  ('$noiDungThu', '$thoiGian', '$idTaiKhoanGuiDen','$idMonAn', '$ngayLenMon',$idTaiKhoanNoiDung)";
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }


    function SelectPhanHoiByIdMonAn($idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM phanhoi INNER JOIN taikhoan ON phanhoi.idTaiKhoan = taikhoan.idTaiKhoan WHERE phanhoi.idMonAn = $idMonAn ORDER BY ngayDanhGia DESC";
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

    function SelectTraLoiByIdPhanHoi($idPhanHoi)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM traloiphanhoi INNER JOIN taikhoan ON traloiphanhoi.idTaiKhoan = taikhoan.idTaiKhoan WHERE traloiphanhoi.idPhanHoi = $idPhanHoi ORDER BY ngayTraLoi DESC";
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


    function DeleteTraLoiByIdTraLoi($idTraLoi)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = "DELETE FROM traloiphanhoi WHERE idTraLoi = $idTraLoi";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq;
    }

    function DeletePhanHoiByIdPhanHoi($idPhanHoi)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = "DELETE FROM phanhoi WHERE idPhanHoi = $idPhanHoi";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq;
    }
}
