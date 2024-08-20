<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("lib/price.php");



require "Classes/PHPExcel.php";
require("tFPDF/tfpdf.php");


if (isset($_SESSION['login'])) {
    /////////////////////////////////QUẢN LÝ BẾP\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ 


    if ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'addUser') {
        require "inc/headerAdmin.php";
        require "View/Admin/vAddUser.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'KitchenManager') {
        require "inc/headerAdmin.php";
        require "View/Admin/vKitchenManager.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'CustomerManagement') {
        require "inc/headerAdmin.php";
        require "View/Admin/vCustomerManagement.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'DeleteUser') {
        require "inc/headerAdmin.php";
        require "View/Admin/vDeleteUser.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'DeleteUserTemporary') {
        require "inc/headerAdmin.php";
        require "View/Admin/vDeleteUserTemporary.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'ListCustomerDelete') {
        require "inc/headerAdmin.php";
        require "View/Admin/vListCustomerDelete.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'ListKitchenDelete') {
        require "inc/headerAdmin.php";
        require "View/Admin/vListKitchenDelete.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'UpdateUser') {
        require "inc/headerAdmin.php";
        require "View/Admin/vUpdateUser.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'RestoreUser') {
        require "inc/headerAdmin.php";
        require "View/Admin/vRestoreUser.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'AddIngredient') {
        require "inc/headerAdmin.php";
        require "View/Dish/vAddIngredient.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'ListIngredient') {
        require "inc/headerAdmin.php";
        require "View/Dish/vListIngredient.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'ListIngredientDelete') {
        require "inc/headerAdmin.php";
        require "View/Dish/vListIngredientDelete.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'DeleteIngredient') {
        require "inc/headerAdmin.php";
        require "View/Dish/vDeleteIngredient.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'RestoreIngredient') {
        require "inc/headerAdmin.php";
        require "View/Dish/vRestoreIngredient.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'ListDishWait') {
        require "inc/headerAdmin.php";
        require "View/Dish/vListDishWait.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'DeleteDish') {
        require "inc/headerAdmin.php";
        require "View/Dish/vDeleteDish.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'BinTemporary') {
        require "inc/headerAdmin.php";
        require "View/Dish/vBinTemporary.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'UpDateIngredient') {
        require "inc/headerAdmin.php";
        require "View/Dish/vUpDateIngredient.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'RestoreDish') {
        require "inc/headerAdmin.php";
        require "View/Dish/vRestoreDish.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'DeletePermanently') {
        require "inc/headerAdmin.php";
        require "View/Dish/vDeletePermanently.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'UpdateDish') {
        require "inc/headerAdmin.php";
        require "View/Dish/vUpdateDish.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'addMenu') {
        require "inc/headerAdmin.php";
        require "View/Menu/vAddMenu.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'listMenu') {
        require "inc/headerAdmin.php";
        require "View/Menu/vListMenu.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'ListPay') {
        require "inc/headerAdmin.php";
        require "View/Order/vListPay.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'DeleteDishMenu') {
        require "inc/headerAdmin.php";
        require "View/Menu/vDeleteDishMenu.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'ListMealFee') {
        require "inc/headerAdmin.php";
        require "View/Order/vListMealFee.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'PayKitchen') {
        require "inc/headerAdmin.php";
        require "View/Order/vPayKitchen.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'PayKitchenSuccess') {
        require "inc/headerAdmin.php";
        require "View/Order/vPayKitchenSuccess.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'PrintOrderKitChenPDF') {
        require "inc/headerAdmin.php";
        require "View/Order/vPrintOrderKitChenPDF.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'ListInvoiceKitchen') {
        require "inc/headerAdmin.php";
        require "View/Order/vListInvoiceKitchen.php";
        require "inc/footerAdmin.php";
    } elseif ($_SESSION['is_login']['Role'] == 1 && isset($_GET['mod']) && $_GET['mod'] == 'sendmailDeleteMenu') {
        require "inc/headerAdmin.php";
        require "View/Menu/sendmailDeleteMenu.php";
        require "inc/footerAdmin.php";
    }

    /////////////////////////////////////QUẢN LÝ BẾP VÀ NHÂN VIÊN PHỤC VỤ VÀ NHÂN VIÊN BẾP////////////////////////////////
    elseif (($_SESSION['is_login']['Role'] == 1 || $_SESSION['is_login']['Role'] == 2 || $_SESSION['is_login']['Role'] == 3) && !isset($_GET['mod'])) {
        require "inc/headerAdmin.php";
        require "View/Admin/vAdmin.php";
        require "inc/footerAdmin.php";
    }

    ///////////////////////////////// QUẢN LÝ BẾP VÀ NHÂN VIÊN BẾP \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ 
    elseif (($_SESSION['is_login']['Role'] == 1 || $_SESSION['is_login']['Role'] == 2) && isset($_GET['mod']) && $_GET['mod'] == 'ListDishAdmin') {
        require "inc/headerAdmin.php";
        require "View/Dish/vListDishAdmin.php";
        require "inc/footerAdmin.php";
    } elseif (($_SESSION['is_login']['Role'] == 1 || $_SESSION['is_login']['Role'] == 2) && isset($_GET['mod']) && $_GET['mod'] == 'addDish') {
        require "inc/headerAdmin.php";
        require "View/Dish/vAddDish.php";
        require "inc/footerAdmin.php";
    }elseif (($_SESSION['is_login']['Role'] == 1 || $_SESSION['is_login']['Role'] == 2) && isset($_GET['mod']) && $_GET['mod'] == 'Ingredient') {
        require "inc/headerAdmin.php";
        require "View/Statistics/vIngredient.php";
        require "inc/footerAdmin.php";
    }



    /////////////////////////////////////QUẢN LÝ BẾP VÀ NHÂN VIÊN PHỤC VỤ////////////////////////////////
    elseif (($_SESSION['is_login']['Role'] == 1 || $_SESSION['is_login']['Role'] == 3) && isset($_GET['mod']) && $_GET['mod'] == 'ApproveOrder') {
        require "inc/headerAdmin.php";
        require "View/Order/vApproveOrder.php";
        require "inc/footerAdmin.php";
    } elseif (($_SESSION['is_login']['Role'] == 1 || $_SESSION['is_login']['Role'] == 3) && isset($_GET['mod']) && $_GET['mod'] == 'listOrder') {
        require "inc/headerAdmin.php";
        require "View/Order/vListOrder.php";
        require "inc/footerAdmin.php";
    }




    ///////////////////Tất cả /////////////////////////////
    elseif (isset($_GET['mod']) && $_GET['mod'] == 'Support') {
        require "inc/headerAdmin.php";
        require "View/Statistics/vSupport.php";
        require "inc/footerAdmin.php";
    } elseif (isset($_GET['mod']) && $_GET['mod'] == 'Profile') {
        require "inc/headerAdmin.php";
        require "View/Admin/vProfile.php";
        require "inc/footerAdmin.php";
    } else {
        include_once('./View/v404.php');
    }
} else {
    include_once('./inc/headerMain.php');
    include_once('./View/Main/vIndex.php');
    include_once('./inc/footerMain.php');;
}
