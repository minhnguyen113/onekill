<?php
include_once("Controller/cOrder.php");

$p = new controlOrder();

$pay = $p->getThanhToan();


?>
<main id="main" class="main">

    <div class="pagetitle">

        <h1>Thanh toán tại bếp</h1>

        <nav>
            <ol class="breadcrumb">

                <li class="breadcrumb-item">thanh toán</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">


                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã nhân viên</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Điện thoại</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Ngày thanh toán</th>
                                    <th scope="col">In hóa đơn</th>




                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 0;
                                if (!empty($pay)) {
                                    foreach ($pay as $item) { ?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $item['maNhanVien'] ?></td>
                                            <td><?php echo $item['hoTen'] ?></td>
                                            <td><?php echo $item['soDienThoai'] ?></td>
                                            <td><?php echo $item['email'] ?></td>
                                            <td><?php echo $item['ngayThanhToan'] ?></td>
                                            <td><a href="admin.php?mod=PrintOrderKitChenPDF&idThanhToan=<?php echo  $item['idThanhToan'] ?>&idTaiKhoan=<?php echo $item['idTaiKhoan'] ?>"><i class="fa-solid fa-print"></i></a></td>





                                        </tr>
                                <?php }
                                } ?>

                            </tbody>
                        </table>


                    </div>
                </div>


            </div>
        </div>
    </section>

</main>