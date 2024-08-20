<?php

include_once("Model/mManagement.php");
class controlManagement
{
    function getAllRole()
    {
        $p = new modelManagement();
        $tblRole = $p->SelectAllRole();
        return $tblRole;
    }
    function getUserById($idtaikhoan)

    {
        $p = new modelManagement();
        $tblRole = $p->SelectUserById($idtaikhoan);
        return $tblRole;
    }
    function getUsersDiffByIdTaiKhoan($idTaiKhoan)
    {
        $p = new modelManagement();

        $tblRole = $p->SelectUsersDiffByIdTaiKhoan($idTaiKhoan);
        return $tblRole;
    }

    function SelectUsers()
    {
        $p = new modelManagement();
        $tblRole = $p->SelectUsers();
        return $tblRole;
    }

    function getAllHoatDong($id_taikhoan)
    {
        $p = new modelManagement();
        $tblRole = $p->SelectAllHoatDong($id_taikhoan);
        return $tblRole;
    }

    function getAllKitchenStaff()
    {
        $p = new modelManagement();
        $tblUsers = $p->SelectAllKitchenStaff();
        return    $tblUsers;
    }

    function getAllCustomer()
    {
        $p = new modelManagement();
        $tblUsers = $p->SelectAllCustomer();
        return    $tblUsers;
    }


    function getAllCustomerDelete()
    {
        $p = new modelManagement();
        $tblUsers = $p->SelectAllCustomerDelete();
        return    $tblUsers;
    }



    function getAllKitchenDelete()
    {
        $p = new modelManagement();
        $tblUsers = $p->SelectAllKitchenDelete();
        return    $tblUsers;
    }


    function addManager(
        $tenDangNhap,
        $matKhau,
        $maNhanVien,
        $hoTen,
        $soDienThoai,
        $email,
        $hinhAnh = '',
        $ngayTao,
        $Role,
        $tmpimg,
        $typeimg,
        $sizeimg
    ) {
        if ($hinhAnh != '') {
            $type_array = explode('/',   $typeimg);
            $image_type = $type_array[0];
            if ($image_type == "image") {
                if ($sizeimg <= 10 * 1024 * 1024) {
                    if (move_uploaded_file($tmpimg, "assets/imageProfile/" . $hinhAnh)) {
                    } else {
                        return -1;
                    }
                } else {
                    return -2;
                }
            } else {
                return -3;
            }
        } else {
            $hinhAnh = 'user.jpg';
        }
        $p = new modelManagement();
    
        $ins = $p->InsertManager($tenDangNhap, $matKhau, $maNhanVien, $hoTen, $soDienThoai, $email, $hinhAnh, $ngayTao, $Role);
        if ($ins) {
            return 1;
        } else {
            return 0;
        }
    }


    function addHoatDong($thoigian, $id_taikhoan)
    {
        $p = new modelManagement();
        $tblRole = $p->InsertHoatDong($thoigian, $id_taikhoan);
        return $tblRole;
    }


    function DeleteUser($idTaiKhoan)
    {
        $p = new modelManagement();
        $delete = $p->DeleteUser($idTaiKhoan);
        if ($delete) {
            return 1;
        } else {
            return 0;
        }
    }


    function InsertManagerExcel($sheetData)
    {
        $p = new modelManagement();
        $tblRole = $p->InsertManagerExcel($sheetData);
        if ($tblRole) {
            return 1;
        } else {
            return 0;
        }
    }

   
    function  DeleteUserTemporary($idTaiKhoan)
    {
        $p = new modelManagement();
        $tblRole = $p->DeleteUserTemporary($idTaiKhoan);
        return $tblRole;
    }

    function  RestoreUser($idTaiKhoan)
    {
        $p = new modelManagement();
        $tblRole = $p->RestoreUser($idTaiKhoan);
        return $tblRole;
    }


    function  UpdateUser($idTaiKhoan, $matKhau, $maNhanVien, $hoTen, $soDienThoai, $email, $hinhAnh, $Role, $tmpimg = '', $typeimg = '', $sizeimg = '')
    {
        $upload_success = false;
        if ($typeimg != '') {
            $type_array = explode('/',   $typeimg);
            $image_type = $type_array[0];
            if ($image_type == "image" && $sizeimg <= 10 * 1024 * 1024) {
                if (move_uploaded_file($tmpimg, "assets/imageProfile/" . $hinhAnh)) {
                    $upload_success = true;
                } else {
                    return -1;
                }
            } else {
                return -2;
            }
        }
        $p = new modelManagement();
        $update =  $p->UpdateUser($idTaiKhoan, $matKhau, $maNhanVien, $hoTen, $soDienThoai, $email, $hinhAnh, $Role);
        if ($update) {
            return 1;
        } else {
            return 0;
        }
    }

    function  ChangePassword($idTaiKhoan, $matKhau)
    {
        $p = new modelManagement();
        $tblRole = $p->ChangePassword($idTaiKhoan, $matKhau);
        return $tblRole;
    }
}
