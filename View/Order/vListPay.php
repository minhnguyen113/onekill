<?php

include_once("Controller/cOrder.php");


$p = new controlOrder();
if (isset($_POST['date'])) {
    $ngayLenMon = $_POST['date'];
}
$listOder = $p->gettOrderSumTotal($ngayLenMon);

?>
<style>
    .datatable-container {
        width: 1400px;
    }

    .card-body {
        overflow: scroll;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">

        <h1>Danh sách thanh toán & nhận món theo ngày</h1>

       
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div style="display: flex;">
                            <h5 class="card-title">Chọn ngày xem:</h5>

                            <form style="margin: 15px 20px" action="" method="post">
                                <input type="date" name="date" id="date" value="<?php if (!isset($_POST['sub_date'])) {
                                                                                    echo $ngayHienTai;
                                                                                } else {
                                                                                    echo $_POST['date'];
                                                                                } ?>">
                                <input style="display: none;" type="submit" value="Submit" id="submitBtn" name="sub_date">
                            </form>
                        </div>



                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã nhân viên</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Điện thoại</th>
                                    <th scope="col">Ngày ăn</th>
                                    <th scope="col">Số lượng món</th>
                                    <th scope="col">Trạng thái thanh toán</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Trạng thái đơn hàng</th>




                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                if(!empty($listOder)){
                                foreach ($listOder as $order) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $order['maNhanVien']; ?></td>
                                        <td><?php echo $order['hoTen']; ?></td>
                                        <td><?php echo $order['soDienThoai']; ?></td>

                                        <td><?php echo $order['ngayLenMon']; ?></td>
                                        <td><?php echo $order['TongSoLuong']; ?></td>
                                        <td>
                                            <?php if ($order['trangThaiThanhToan'] == 1) { ?>
                                                <span class="badge bg-primary">Đã thanh toán </span>


                                            <?php } else { ?>
                                                <span class="badge bg-warning">Chưa thanh toán</span>


                                            <?php } ?>
                                        </td>
                                        <td><?php echo currency_format($order['tongTien']); ?></td>

                                        <td>
                                            <?php if ($order['duyetDon'] == 1) { ?>
                                                <span class="badge bg-success">Đã nhận</span>


                                            <?php } else { ?>
                                                <span class="badge bg-danger">Chưa nhận</span>


                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php } }?>


                            </tbody>
                        </table>

                    </div>
                </div>
               

            </div>
        </div>
    </section>

</main>