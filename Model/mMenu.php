<?php
include_once("ketnoi.php");
class modelMenu
{
  
     function SelectLatestMenu()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl= "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idThucDon = chitietthucdon.idThucDon
        JOIN monan ON chitietthucdon.idMonAn = monan.idMonAn
        ORDER BY thucdon.NgayTao DESC LIMIT 1";
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

    function SelectAllMenuDetailMenu()
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl= "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idThucDon = chitietthucdon.idThucDon";
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



    function SelectAllMenu(){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl= "SELECT * FROM thucdon";
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

    
    function SelectMenuByDate($ngayTao){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl= "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idThucDon = chitietthucdon.idThucDon
        JOIN monan ON chitietthucdon.idMonAn = monan.idMonAn where thucdon.ngayTao = '$ngayTao' ";
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

    function SelectOneMenuByDate($ngayTao){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $tbl= "SELECT * FROM thucdon WHERE ngayTao = '$ngayTao' ";
        $table = mysqli_query($connect, $tbl);
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }

    function InsertMenuDetails($idThucDon, $idMonAn)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO chitietthucdon (`idThucDon`, `idMonAn`)
        VALUES ";
        foreach ($idMonAn as $item) {
            $insert .= "('$idThucDon', '$item'), ";
        }
        $insert = rtrim($insert, ", ");
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }

    function InsertMenu($ngayTao)
    {
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $insert = "INSERT INTO thucdon (`ngayTao`) VALUES('$ngayTao')";
        $kq = mysqli_query($connect,  $insert);
        $p->dongketnoi($connect);
        return $kq;
    }



    function DeletedDishByidMonAnAndByIdThucDon($idMonAn, $idThucDon){
        $p = new clsketnoi();
        $connect = $p->ketnoiDB();
        $delete = "DELETE FROM chitietthucdon WHERE idThucDon= $idThucDon AND idMonAn = $idMonAn";
        $kq = mysqli_query($connect,  $delete);
        $p->dongketnoi($connect);
        return $kq;
    }


   

}