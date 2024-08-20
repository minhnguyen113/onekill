<?php
include_once("Controller/cOrder.php");

$p = new controlOrder();
$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
$pay = $p->getThanhToanByIdTaiKhoan($idTaiKhoan);


?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: #fff;
        border-radius: 10px;
        margin-top: 50px;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: #fff;
    }

    tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
</style>
</head>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="text-center">Danh sách hóa đơn đã thanh toán</h1>

            <div class="col-lg-12 col-md-12 ">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Thời gian thanh toán</th>
                            <th>Số tiền</th>
                            <th>In hóa đơn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $groupedPay = array(); // Mảng để nhóm các bản ghi theo idThanhToan
                        if (!empty($pay)) {
                            foreach ($pay as $item) {
                                $idThanhToan = $item['idThanhToan'];

                                // Nếu chưa có nhóm cho idThanhToan này, tạo mới
                                if (!isset($groupedPay[$idThanhToan])) {
                                    $groupedPay[$idThanhToan] = array();
                                }

                                // Thêm bản ghi vào nhóm tương ứng
                                $groupedPay[$idThanhToan][] = $item;
                            }

                            // Hiển thị từng nhóm
                            foreach ($groupedPay as $group) {
                        ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $group[0]['idThanhToan'] ?></td>
                                    <td><?php 
                                   $thoiGian = (new DateTime($group[0]['ngayThanhToan']))->format('H:i:s d/m/Y');
                                    echo $thoiGian ?></td>
                                    <td><?php echo currency_format($group[0]['soTien']) ?></td>


                                    <td>
                                        <!-- Đặt link in hóa đơn ở đây -->
                                        <a href="index.php?mod=Order&act=PrintOrderPDF&idThanhToan=<?php echo $group[0]['idThanhToan'] ?>" target="_blank">In hóa đơn</a>
                                    </td>
                                </tr>
                        <?php }
                        }else { ?>
                        <tr>
                            <td colspan="5"><h1 class="text-center">Chưa thanh toán đơn nào</h1></td></tr>

                        <?php }?>

                    </tbody>
                </table>


            </div>
        </div>



    </main>