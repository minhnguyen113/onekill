<?php
include_once("ketnoi.php");
class modelLogin
{
    public function SelectAllUser()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $users = "SELECT * FROM taikhoan INNER JOIN `Role` ON taikhoan.role = Role.idRole WHERE trangThai = 1";
        $table = mysqli_query($connect,  $users);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }


    public function SelectUserByEmailMaNV($email, $maNhanVien)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $users = "SELECT * FROM taikhoan WHERE email = '$email' AND  maNhanVien = '$maNhanVien' ";
        $table = mysqli_query($connect,  $users);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }



}
