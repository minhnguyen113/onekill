<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("lib/price.php");
require("tFPDF/tfpdf.php");


if (isset($_SESSION['login'])) { 
if (isset($_GET['mod']) && $_GET['mod'] == 'logout') {
  require "View/Account/vLogout.php";
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Proccess') {
  require "View/Main/vProccess.php";
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'ProccessHopThu') {
  require "View/Main/vProccessHopThu.php";
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Notification') {
  include_once('./inc/header.php');
  require "View/Main/vNotification.php";
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Dish' &&  $_GET['act'] == 'DishDetail') {
  include_once('./inc/header.php');
  require "View/Dish/vDishDetail.php";
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Dish' && $_GET['act'] == 'list') {
  include_once('./inc/header.php');
  require "View/Dish/vDish.php";
  include_once('./inc/footer.php');
}elseif (isset($_GET['mod']) && $_GET['mod'] == 'Dish' && $_GET['act'] == 'PhanHoi') {
  
  require "View/Dish/vPhanHoi.php";

}elseif (isset($_GET['mod']) && $_GET['mod'] == 'Dish' && $_GET['act'] == 'DeleteTraLoi') {
  
  require "View/Dish/vDeleteTraLoi.php";

}elseif (isset($_GET['mod']) && $_GET['mod'] == 'Dish' && $_GET['act'] == 'DeletePhanHoi') {
  
  require "View/Dish/vDeletePhanHoi.php";

}elseif (isset($_GET['mod']) && $_GET['mod'] == 'Dish' && $_GET['act'] == 'TraLoi') {
  
  require "View/Dish/vTraLoi.php";

}  elseif (isset($_GET['mod']) && $_GET['mod'] == 'cart' && !isset($_GET['act'])) {
  include_once('./inc/header.php');
  include_once('./View/Cart/vCart.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Cart' &&  $_GET['act'] == 'Add') {
  include_once('./inc/header.php');
  include_once('./View/Cart/vAddCart.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Cart' &&  $_GET['act'] == 'Update') {
  include_once('./inc/header.php');
  include_once('./View/Cart/vUpdateCart.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Cart' &&  $_GET['act'] == 'DeleteDuplicate') {
  include_once('./inc/header.php');
  include_once('./View/Cart/vDeleteDuplicate.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'cart' &&  $_GET['act'] == 'DeleteNgayTaoGio') {
  include_once('./inc/header.php');
  include_once('./View/Cart/vDeleteNgayTaoGio.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'cart' &&  $_GET['act'] == 'DeleteNgayLenMon') {
  include_once('./inc/header.php');
  include_once('./View/Cart/vDeleteOrder.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' &&  $_GET['act'] == 'Order') {
  include_once('./inc/header.php');
  include_once('./View/Order/vAddOrder.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' &&  $_GET['act'] == 'AddDetailOrder') {
  include_once('./inc/header.php');
  include_once('./View/Order/vAddOrderDetail.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' &&  $_GET['act'] == 'OrderDate') {
  include_once('./inc/header.php');
  include_once('./View/Order/vAddOrderDate.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' &&  $_GET['act'] == 'AddDetailOrderDate') {
  include_once('./inc/header.php');
  include_once('./View/Order/vAddOrderDetailDate.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' &&  $_GET['act'] == 'ListInvoice') {
  include_once('./inc/header.php');
  include_once('./View/Order/vListInvoice.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' &&  $_GET['act'] == 'ListOrderUser') {
  include_once('./inc/header.php');
  include_once('./View/Order/vListOrderUser.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' &&  $_GET['act'] == 'Pay') {
  include_once('./inc/header.php');
  include_once('./View/Order/vPay.php');
  include_once('./inc/footer.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' && $_GET['act'] == 'XuLyThanhToanMomo') {
  include_once('./View/Order/vXuLyThanhToanMomo.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' &&  $_GET['act'] == 'XuLyThanhToanMomo_atm') {
  include_once('./View/Order/vXuLyThanhToanMomo_atm.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' && $_GET['act'] == 'PaymentSuccess') {
  include_once('./View/Order/vPaymentSuccess.php');
} elseif (isset($_GET['mod']) && $_GET['mod'] == 'Order' && $_GET['act'] == 'PrintOrderPDF') {
  include_once('./View/Order/vPrintOrderPDF.php');
}    elseif (isset($_GET['mod']) && $_GET['mod'] == 'insertChat') {
  include_once('./View/Main/vinsertChat.php');
}elseif (!isset($_GET['mod'])) {
  include_once('./inc/headerMain.php');
  include_once('./View/Main/vIndex.php');
  include_once('./inc/footerMain.php');
} else {
  include_once('./View/v404.php');
}


}elseif (isset($_GET['mod']) && $_GET['mod'] == 'ConfirmEmail') {
  include_once('./View/Account/vConfirmEmail.php');
}elseif (isset($_GET['mod']) && $_GET['mod'] == 'NewPassword') {
  include_once('./View/Account/vNewPassword.php');
}elseif (isset($_GET['mod']) && $_GET['mod'] == 'login') {
  include_once('View/Account/vLogin.php');
} else {
  include_once('./inc/headerMain.php');
  include_once('./View/Main/vIndex.php');
  include_once('./inc/footerMain.php');;

}

