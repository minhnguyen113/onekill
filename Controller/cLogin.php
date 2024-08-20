<?php

include_once("Model/mLogin.php");
class controlLogin{
    function getAllLogin($username, $password)
    {

        $p = new modelLogin();
        $tblLogin = $p->SelectAllUser();
        foreach($tblLogin as $item){
            if($username == $item['tenDangNhap'] && $password == $item['matKhau']){
                $_SESSION['login'] = true;
                $_SESSION['is_login'] = array();
                $_SESSION['is_login']['hoTen'] = $item['hoTen'];
                $_SESSION['is_login']['Role'] = $item['Role'];
                $_SESSION['is_login']['idTaiKhoan'] = $item['idTaiKhoan'];
                $_SESSION['is_login']['tenRole'] = $item['tenRole'];
                $_SESSION['is_login']['tenDangNhap'] = $item['tenDangNhap'];
                $_SESSION['is_login']['maNhanVien'] = $item['maNhanVien'];
                $_SESSION['is_login']['soDienThoai'] = $item['soDienThoai'];
                $_SESSION['is_login']['email'] = $item['email'];
                $_SESSION['is_login']['ngayTao'] = $item['ngayTao'];
                $_SESSION['is_login']['hinhAnh'] = $item['hinhAnh'];


                 return 1;
            } 
        } return 0;
    }


    function getAllUser()
    {

        $p = new modelLogin();
        $tblLogin = $p->SelectAllUser();
        return $tblLogin;
        
    }

    function getUserByEmailMaNV($email, $maNhanVien)
    {
        $p = new modelLogin();
        $tblLogin = $p->SelectUserByEmailMaNV($email, $maNhanVien);
        return $tblLogin;   
    }

   
    
}