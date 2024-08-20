<?php
include_once("ketnoi.php");
class modelManagement
{

    function SelectAllRole()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM `role` ORDER BY idRole DESC";
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


    function SelectUsers()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM `taikhoan` ";
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




    function SelectUsersDiffByIdTaiKhoan($idTaiKhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM `taikhoan` WHERE idTaiKhoan != $idTaiKhoan";
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


    function SelectUserById($idtaikhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM `taikhoan` WHERE idTaiKhoan = $idtaikhoan ";
        $table = mysqli_query($connect, $tbl);
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_user = $row;
            }
            return $list_user;
        }
        $p->dongketnoi($connect);
    }


    function SelectAllKitchenStaff()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT * FROM taikhoan INNER JOIN `Role` ON taikhoan.role = Role.idRole Where `role` != 4 AND trangThai = 1";
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

    function SelectAllCustomer()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT * FROM taikhoan  Where `role` = 4 AND trangThai = 1 ";
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

    function SelectAllKitchenDelete()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT * FROM taikhoan INNER JOIN `Role` ON taikhoan.role = Role.idRole Where `role` != 4 AND trangThai = 0";
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

    function SelectAllCustomerDelete()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tblUsers = "SELECT * FROM taikhoan  Where `role` = 4 AND trangThai = 0 ";
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
    
    


    function SelectAllHoatDong($id_taikhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl = "SELECT * FROM `hoatdong` where `id_taikhoan` =  $id_taikhoan ORDER BY thoigian DESC";
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

    function InsertHoatDong($thoigian, $id_taikhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT into `hoatdong`(`thoigian`,`id_taikhoan`)
        VALUES('$thoigian', '$id_taikhoan')";
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }



    function InsertManager($tenDangNhap, $matKhau, $maNhanVien, $hoTen, $soDienThoai, $email, $hinhAnh, $ngayTao, $Role)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = " INSERT INTO taikhoan(`tenDangNhap`, `matKhau`, `maNhanVien`, `hoTen`, `soDienThoai`, `email`, `hinhAnh`, `ngayTao`, `Role`) 
        VALUES ('$tenDangNhap', '$matKhau', '$maNhanVien', '$hoTen', '$soDienThoai', '$email', '$hinhAnh', '$ngayTao', '$Role')";
        $kq = mysqli_query($connect, $insert);
        $p->dongketnoi($connect);
        return $kq;
    }


    function DeleteUserTemporary($idTaiKhoan){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete =  "UPDATE  taikhoan SET trangThai = 0 WHERE idTaiKhoan = '$idTaiKhoan'";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq; 
    } 

    function RestoreUser($idTaiKhoan){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete =  "UPDATE  taikhoan SET trangThai = 1 WHERE idTaiKhoan = '$idTaiKhoan'";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq; 
    } 

    function DeleteUser($idTaiKhoan)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = " DELETE FROM taikhoan WHERE idTaiKhoan = '$idTaiKhoan'";
        $kq = mysqli_query($connect, $delete);
        $p->dongketnoi($connect);
        return $kq;
    }



    function InsertManagerExcel($sheetData)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO taiKhoan(tenDangNhap, matKhau, maNhanVien, hoTen, soDienThoai, email, ngayTao, `Role`) VALUES";
        for ($i = 1; $i < count($sheetData); $i++) {
            $tenDangNhap  = $sheetData[$i][0];
            $matKhau = $sheetData[$i][1];
            $maNhanVien = $sheetData[$i][2];
            $hoTen = $sheetData[$i][3];
            $soDienThoai = $sheetData[$i][4];
            $email = $sheetData[$i][5];
            $Role = $sheetData[$i][6];

            $ngayTao = date('Y-m-d H:i:s');

            $insert .= "('$tenDangNhap', '$matKhau', '$maNhanVien', '$hoTen', '$soDienThoai', '$email', '$ngayTao', '$Role'), ";
        }

        $insert = rtrim($insert, ", ");

        $kq = mysqli_query($connect, $insert);
        $p->dongketnoi($connect);
        return $kq;
    }    	
  

    function UpdateUser($idTaiKhoan	, $matKhau, $maNhanVien, $hoTen, $soDienThoai, $email, $hinhAnh, $Role)
    {
        
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "UPDATE taikhoan SET   matKhau = '$matKhau', maNhanvien= '$maNhanVien', hoTen='$hoTen', soDienThoai = '$soDienThoai',
        email = '$email', hinhAnh = '$hinhAnh', `Role` = '$Role'
         WHERE idTaiKhoan = $idTaiKhoan";
        $kq = mysqli_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }


    function ChangePassword($idTaiKhoan, $matKhau){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $update = "UPDATE taikhoan SET matKhau =  $matKhau WHERE idTaiKhoan = $idTaiKhoan";
        $kq = mysqli_query($connect, $update);
        $p->dongketnoi($connect);
        return $kq;
    }
}
