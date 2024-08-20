<?php

include_once("Model/mDish.php");
class controlDish
{
    function getAllDish()
    {
        $p = new modelDish();
        $tbl = $p->SelectAllDish();
        return  $tbl;
    } 
    function getNguyenLieu()
    {
        $p = new modelDish();
        $tbl = $p->SelectNguyenLieu();
        return  $tbl;
    }
    function getPhanHoiByIdMonAn($idMonAn)
    {
        $p = new modelDish();
        $tbl = $p->SelectPhanHoiByIdMonAn($idMonAn);
        return  $tbl;
    }

    function getTraLoiByIdPhanHoi($idPhanHoi)
    {
        $p = new modelDish();
        $tbl = $p->SelectTraLoiByIdPhanHoi($idPhanHoi);
        return  $tbl;
    }

    function getNguyenLieuDelete()

    {
        $p = new modelDish();
        $tbl = $p->SelectNguyenLieuDelete();
        return  $tbl;
    }
    function getAllNguyenLieu()
    {
        $p = new modelDish();
        $tbl = $p->SelectAllNguyenLieu();
        return  $tbl;
    }
    function getAllDishByIdLoai($id)
    {
        $p = new modelDish();
        $tbl = $p->SelectAllDishByIdLoai($id);
        return  $tbl;
    }
    function getAllLoaiMonAn()
    {
        $p = new modelDish();
        $tbl = $p->SelectAllLoaiMonAn();
        return  $tbl;
    }
    function getDishNew()
    {
        $p = new modelDish();
        $tbl = $p->SelectDishNew();
        return  $tbl;
    }

    function getAllDishWait($wait)
    {
        $p = new modelDish();
        $tbl = $p->SelectAllDishWait($wait);
        return  $tbl;
    }


    function DishSearch($search)
    {
        $p = new modelDish();
        $tbl = $p->Dish_search($search);
        return  $tbl;
    }

    function getLoaiMonAnById($id)
    {
        $p = new modelDish();
        $tbl = $p->SelectLoaiMonAnById($id);
        return  $tbl;
    }
    function  getAllDishMenu()
    {
        $p = new modelDish();
        $tbl = $p->SelectAllDishMenu();
        return  $tbl;
    }
    function   getAllDishMenuByDate($ngayTao)
    {
        $p = new modelDish();
        $tbl = $p->SelectAllDishMenuByDate($ngayTao);
        return  $tbl;
    }
    function getAllDishMenuidMonAn($idMonAn)
    {
        $p = new modelDish();
        $tbl = $p->SelectAllDishMenuidMonAn($idMonAn);
        return  $tbl;
    }
    function gettAllDishIngredient($idMonAn)
    {
        $p = new modelDish();
        $tbl = $p->SelectAllDishIngredient($idMonAn);
        return  $tbl;
    }

    function InsertDish($tenMon, $gia, $Mota, $hinhAnh, $idLoaiMon, $tmpimg, $typeimg, $sizeimg)
    {
        if ($hinhAnh != '') {
            $type_array = explode('/',   $typeimg);
            $image_type = $type_array[0];
            if ($image_type == "image") {
                if ($sizeimg <= 10 * 1024 * 1024) {
                    if (move_uploaded_file($tmpimg, "assets/imageDish/" . $hinhAnh)) {
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
            $hinhAnh = 'error.png';
        }
        $p = new modelDish();
        $ins = $p->InsertDishNew($tenMon, $gia, $Mota, $hinhAnh, $idLoaiMon);
        if ($ins) {
            return 1;
        } else {
            return 0;
        }
    }

    function InsertChiTietNguyenLieuMonAn($listNlWeight, $idMonAn)
    {
        $p = new modelDish();
        $ins = $p->InsertChiTietNguyenLieuMonAn($listNlWeight, $idMonAn);
        return $ins;
    }

    function  InsertUpdateChiTietNguyenLieuMonAn($listNlWeight, $idMonAn)
    {
        $p = new modelDish();
        $ins = $p->InsertUpdateChiTietNguyenLieuMonAn($listNlWeight, $idMonAn);
        return $ins;
    }

    function DeleteTemporaryDish($idMonAn)
    {
        $p = new modelDish();
        $delete = $p->DeleteTemporaryDish($idMonAn);
        if ($delete) {
            return 1;
        } else {
            return 0;
        }
    }

    function  getDeleteTemporaryDish()
    {
        $p = new modelDish();
        $delete = $p->SelectDeleteTemporaryDish();
        return $delete;
    }

    function   RestoreDish($idMonAn)
    {
        $p = new modelDish();
        $delete = $p->RestoreDish($idMonAn);
        return $delete;
    }

    function DeletePermanentlyDish($idMonAn)
    {
        $p = new modelDish();
        $delete = $p->DeletePermanentlyDish($idMonAn);
        if ($delete) {
            return 1;
        } else {
            return 0;
        }
    }

    function  UpdateDishById($idMonAn, $tenMon, $gia, $Mota, $hinhAnhMon, $idLoaiMon, $tmpimg = '', $typeimg = '', $sizeimg = '')

    {
        $upload_success = false;
        if ($typeimg != '') {
            $type_array = explode('/',   $typeimg);
            $image_type = $type_array[0];
            if ($image_type == "image" && $sizeimg <= 10 * 1024 * 1024) {
                if (move_uploaded_file($tmpimg, "assets/imageDish/" . $hinhAnhMon)) {
                    $upload_success = true;
                } else {
                    return -1;
                }
            } else {
                return -2;
            }
        }else {
            $hinhAnhMon = 'error.png';
        }
        $p = new modelDish();
        $update =  $p->UpdateDishById($idMonAn, $tenMon, $gia, $Mota, $hinhAnhMon, $idLoaiMon);
        if ($update) {
            return 1;
        } else {
            return 0;
        }
    }

    function DeleteNguyenLieuByIdMonAn($idMonAn)
    {
        $p = new modelDish();
        $delete = $p->DeleteNguyenLieuByIdMonAn($idMonAn);
        return $delete;
    }
    function DeleteTemporaryIngredient($idNguyenLieu)
    {
        $p = new modelDish();
        $delete = $p-> DeleteTemporaryIngredient($idNguyenLieu);
        if($delete){
            return 1;
        } else {
            return 0;
        }
    }

    function RestoreIngredient($idNguyenLieu)
    {
        $p = new modelDish();
        $delete = $p-> RestoreIngredient($idNguyenLieu);
        return $delete;
    }

    function InsertIngerdienthNew($tenNguyenLieu, $hinhAnh, $ngayTao, $typeimg, $tmpimg, $sizeimg)
    {
        $upload_success = false;
        if ($typeimg != '') {
            $type_array = explode('/',   $typeimg);
            $image_type = $type_array[0];
            if ($image_type == "image" && $sizeimg <= 10 * 1024 * 1024) {
                if (move_uploaded_file($tmpimg, "assets/imageIngredient/" . $hinhAnh)) {
                    $upload_success = true;
                } else {
                    return -1;
                }
            } else {
                return -2;
            }
        }else {
            $hinhAnh = 'error.png';
        }
        $p = new modelDish();
        $update =  $p->InsertIngerdienthNew($tenNguyenLieu, $hinhAnh, $ngayTao);
        if ($update) {
            return 1;
        } else {
            return 0;
        }
    }

    function AcceptDish($idMonAn)
    {
        $p = new modelDish();
        $update = $p->AcceptDish($idMonAn);
        return $update;
    }

    function InsertPhanHoi($idTaiKhoan,$idMonAn,$noiDungPhanHoi,$danhGia,$ngayDanhGia)
    {
        $p = new modelDish();
        $update = $p->InsertPhanHoi($idTaiKhoan,$idMonAn,$noiDungPhanHoi,$danhGia, $ngayDanhGia);
        return $update;
    }
    function InsertTraLoi($idTaiKhoan,$noiDung,$idPhanHoi,$ngayTraLoi)
    {
        $p = new modelDish();
        $update = $p->InsertTraLoi($idTaiKhoan,$noiDung,$idPhanHoi,$ngayTraLoi);
        return $update;
    }

    function InsertHopThu($noiDungThu,$thoiGian,$idTaiKhoanGuiDen, $idMonAn, $ngayLenMon, $idTaiKhoanNoiDung)
    {
        $p = new modelDish();
        $update = $p->InsertHopThu($noiDungThu,$thoiGian,$idTaiKhoanGuiDen, $idMonAn, $ngayLenMon, $idTaiKhoanNoiDung);
        return $update;
    }
    
    function DeleteTraLoiByIdTraLoi($idTraLoi)

    {
        $p = new modelDish();
        $delete = $p->DeleteTraLoiByIdTraLoi($idTraLoi);
        return $delete;
    }
    function DeletePhanHoiByIdPhanHoi($idPhanHoi)


    {
        $p = new modelDish();
        $delete = $p->DeletePhanHoiByIdPhanHoi($idPhanHoi);
        return $delete;
    }
} 