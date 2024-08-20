<?php

include_once("Controller/cOrder.php");


while (ob_get_level())
    ob_end_clean();
header("Content-Encoding: None", true);


$p = new controlOrder();
$idTaiKhoan = $_GET['idTaiKhoan'];
$idThanhToan = $_GET['idThanhToan'];
$order  = $p->getThanhToanByIdTaiKhoanAndIdDonHang($idTaiKhoan, $idThanhToan);




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
        margin-top: -12px;
        text-align: center;
        font-size: 14px;
    }

    .inforOrder p {
        margin-top: -10px;
    }
    
</style>
<main id="main" class="main">

    <div class="pagetitle">


        <div class="col-lg-8 col-md-8 ">
            <div class="order-container" style="width: 90%;">
                <div class="row">
                    <div class="col-md-12" style="position: relative;">
                        <div class="infor" style="border-bottom: 1px solid;">
                            <img src="assets/admin/img/favicon.png" alt="" class="" style="margin-left:48%; width: 50px;"><br>
                            <h2 style=" margin-top: 10px; text-align: center; color: red; font-size: 40px;"><i><b>ONEKILL</b></i></h2>
                            <p style="margin-top: -35px;">BẾP ĂN TẬP ĐOÀN DOANH NGHIỆP ONEKILL</p>
                            <p>12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, TP.HCM</p>
                            <p>Mã số thuế: 123456789</p>
                            <p>email: onekill@gmail.com</p>
                            <p>Hotline: 0123456789</p>

                        </div>
                        <h5 style="text-align: center; font-size: 20px; margin-top: 5px;"><b>Thông Tin Đơn Hàng</b></h5>
                        <p style="font-size: 12px; margin-top: -30px; text-align: center; color: blue;"><b><i>(Thanh toán tại bếp ăn ONEKILL)</i></b></p>
                        <div class="inforOrder" style="border-bottom: 1px solid;">


                            <h6 style="font-size: 16px;"><span>Tên khách hàng:</span> <span style="position: absolute; right: 20px;"><?php echo $order[0]['hoTen'] ?></span></h6>
                            <h6 style="font-size: 16px; margin-top: -30px;"><span>Mã Đơn hàng:</span> <span style="position: absolute; right: 20px;"><?php echo $order[0]['idThanhToan'] ?></span></h6>
                            <?php $date = date('H:i:s d/m/Y'); ?>
                            <h6 style="font-size: 16px; margin-top: -30px;"><span>Ngày giờ:</span> <span style="position: absolute; right: 20px;"><?php echo $date ?></span></h6>


                            <?php foreach ($order as $index => $od) { ?>

                                <h6 style="font-size: 16px; margin-bottom: 10px; margin-top: -5px;"><?php echo $od['tenMon'] ?>:</h6>
                                <p style="font-size: 16px;"><span><?php echo $od['soLuong'] . ' x ' . currency_format($od['gia']) ?> </span> <span style="position: absolute; right: 20px;"><?php echo currency_format($od['soLuong'] * $od['gia']) ?></span></p>

                            <?php } ?>
                            

                        </div>

                        <h6 style="font-size: 16px; margin-top: 10px;"><span>Tổng cộng</span> <span style="position: absolute; right: 20px;"><?php echo currency_format($order[0]['soTien']) ?></span></h6>

                        <h6 style="text-align: center; font-size: 18px; color: red;"><i>Cảm ơn quý khách <br> Hẹn gặp lại !</i></h6>
                        <p style="text-align: center; margin-top: -30px;">Phiếu tính tiền chỉ có giá trị trong ngày <br>
                            <b>|||||</b>||||<b>||||</b>|||||<b>|||</b>||||||||<b>||||||||||||||||</b>|||||<b>|||||</b>||||<b>||||</b><b>||||||||||||||||</b>|||||<b>|||||</b>||||<b>||||</b>  <br>
                            0766270100000120001381231111113000032
                        </p>

                    </div>


                </div>

            </div>
        </div>
    </div>



</main>
<?php
