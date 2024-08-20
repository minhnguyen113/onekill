<?php

include_once("Controller/cOrder.php");


$p = new controlOrder();
$idTaiKhoan =  $_SESSION['is_login']['idTaiKhoan'];
$maNhanVien =  $_SESSION['is_login']['maNhanVien'];

$order = $p->getSumOrderPayByidTaiKhoan($idTaiKhoan);


?>

<style>
    .order-container {
        max-width: 80%;
        margin: auto;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-top: 50px;
        padding: 30px;
    }

    h2 {
        color: #343a40;
    }

    label {
        color: #495057;
        font-weight: bold;
    }

    .order-item {
        margin-bottom: 20px;
    }

    .order-item span {
        color: #6c757d;
        display: block;
        margin-top: 8px;
    }



    .btn-confirm {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 15px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-confirm:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        .order-container {
            padding: 20px;
        }
    }

    .infor p {
        margin-top: -20px;
        text-align: center;
        font-size: 14px;
    }

    .inforOrder p {
        margin-top: -10px;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">


        <div class="col-lg-12 col-md-12 ">
            <div class="order-container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="infor" style="border-bottom: 1px solid;">
                            <img src="assets/admin/img/favicon.png" alt="" class="" style="margin-left:45%;">
                            <h2 class="text-center text-danger mb-3"><i><b>ONEKILL</b></i></h2>
                            <p>BẾP ĂN TẬP ĐOÀN DOANH NGHIỆP ONEKILL</p>
                            <p>12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, TP.HCM</p>
                            <p>Mã số thuế: 123456789</p>
                            <p>email: onekill@gmail.com</p>
                            <p>Hotline: 0123456789</p>

                        </div>
                        <h5 class="mt-2 text-center">Thông Tin Đơn Hàng</h5>
                        <div class="inforOrder" style="border-bottom: 1px solid;">
                            <?php $maDon = $idTaiKhoan . rand(0, 100000);
                            $_SESSION['maDon'] = $maDon;
                            if (isset($_GET['total'])) {
                                $_SESSION['soTien'] = $_GET['total'];
                            } else {
                                $_SESSION['soTien'] = 0;
                            }

                            ?>
                            <h6 class=""><span>Mã Đơn hàng:</span> <span style="position: absolute; right: 20px;"><?php echo $maDon ?></span></h6>
                            <?php $date = date('H:i:s d/m/Y'); ?>
                            <h6 class="mb-3"><span>Ngày giờ:</span> <span style="position: absolute; right: 20px;"><?php echo $date ?></span></h6>
                            <?php 
                            $dish = array();
                            foreach ($order as $index=>$od) {

                                $dish[] =  [
                                  'tenMon'=>  $od['tenMon'],
                                   'soLuong' =>$od['soLuong'],
                                   'gia' => $od['gia']
                                
                                 ] ;
                        
                                 $_SESSION['dish'] = $dish;
                            ?>


                                <h6><?php echo $od['tenMon'] ?>:</h6>
                                <p style="margin-top: -7px;"><span><?php echo $od['soLuong'] . ' x ' . currency_format($od['gia']) ?> </span> <span style="position: absolute; right: 20px;"><?php echo currency_format($od['soLuong'] * $od['gia']) ?></span></p>


                            <?php } ?>
                        </div>

                        <h6 class="mt-1 m-3"><span>Tổng cộng</span> <span style="position: absolute; right: 20px;"><?php if (isset($_GET['total'])) {
                                                                                                                        echo currency_format($_GET['total']);
                                                                                                                    } ?></span></h6>

                        <h6 class="text-center mt-3">Cảm ơn quý khách <br> Hẹn gặp lại</h6>
                        <p class="text-center">Phiếu tính tiền chỉ có giá trị trong ngày <br>
                            <b>|||||</b>||||<b>||||</b>|||||<b>|||</b>||||||||<b>||||||||||||||||</b>|||||<b>||||||||||</b>||||<b>||||||||||||</b>|||||<br>
                            0766270100000120001381231111113000032
                        </p>

                    </div>

                    <div class="col-md-6">
                        <h3 class="mb-4"><b><i>Hình Thức Thanh Toán</i></b></h3>
                        <img src="assets/images/atm.png" alt="" class="m-1" style="width: 65px;">
                        <img src="assets/images/visa.png" alt="" class="m-1" style="width: 55px; height: 34px;">
                        <img src="assets/images/napas.png" alt="" class="m-1" style="width: 55px; height: 34px;">
                        <img src="assets/images/momo.jpg" alt="" class="m-1" style="width: 55px; height: 34px;">
                        <img src="assets/admin/img/favicon.png" alt="" class="m-1" style="width: 55px; height: 34px;">

                        <form method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="index.php?mod=Order&act=XuLyThanhToanMomo">

                            <input type="hidden" name="infor" value="<?php if (isset($_GET['user'])) {
                                                                            echo $_GET['user'];
                                                                        } ?>">
                            <input type="hidden" name="total" value="<?php if (isset($_GET['total'])) {
                                                                            echo $_GET['total'];
                                                                        } ?>">

                            
                            <input class="btn btn-danger mt-3" type="submit" value="Thanh toán bằng MoMo" name="momo">
                        </form>
                        <form method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="index.php?mod=Order&act=XuLyThanhToanMomo_atm">
                            <input type="hidden" name="infor" value="<?php if (isset($_GET['user'])) {
                                                                            echo $_GET['user'];
                                                                        } ?>">
                            <input type="hidden" name="total" value="<?php if (isset($_GET['total'])) {
                                                                            echo $_GET['total'];
                                                                        } ?>">
                            <input class="btn btn-primary mt-3 " type="submit" value="Thanh toán qua thẻ Visa/Master/Napas" name="momo">
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>



</main>
