<?php

include_once("Controller/cOrder.php");
include_once("Controller/cManagement.php");
include_once("Controller/cMenu.php");

$us = new controlManagement();
$menu = new controlMenu();

$p = new controlOrder();

$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
$user = $us->getUserById($idTaiKhoan);

$duyetDon = '';
$trangThaiThanhToan = '';
if (isset($_GET['trangThaiTT']) || isset($_GET['duyetMon'])) {
    if (isset($_GET['duyetMon'])) {
        $duyetDon = $_GET['duyetMon'];
    }
    if (isset($_GET['trangThaiTT'])) {
        $trangThaiThanhToan = $_GET['trangThaiTT'];
    }
    $listOder = $p->getOrderByidTaiKhoanFind($idTaiKhoan, $trangThaiThanhToan, $duyetDon);
} else {
    $listOder = $p->getOrderByidTaiKhoan($idTaiKhoan);
}

$total = $p->getSumOrderByidTaiKhoan($idTaiKhoan);






    //////////Cập nhật lại tổng tiền và số lượng cho bảng đơn đặt món theo idDon;
    $OrderDetail = $p->getOrderDetail();

    $tongTienDonHang = array();
    foreach ($OrderDetail as $od) {
        $tongTien = $od['gia'] * $od['soLuong'];
        $od['tongTien'] = $tongTien;
        $tongTienDonHang[] = $od;
    }
    
    
    $totalByDonId = array();
    foreach ($tongTienDonHang as $item) {
        $idDon = $item['idDon'];
        $tongTien = $item['tongTien'];
        $tongSoLuong = $item['soLuong'];
    
    
        if (isset($totalByDonId[$idDon])) {
            $totalByDonId[$idDon]['TongTien'] += $tongTien;
            $totalByDonId[$idDon]['soLuong'] +=     $tongSoLuong; 
        } else {
            $totalByDonId[$idDon]['TongTien'] = $tongTien;
            $totalByDonId[$idDon]['soLuong'] =     $tongSoLuong; 
    
        }
    }
     
    if(!empty($totalByDonId)){
    $p->UpdateTotalAndQuantityOrder($totalByDonId);
    }


?>

<main id="main" class="main">

    <div class="pagetitle">


        <div class="col-lg-12 col-md-12 ">
            <nav class="navbar navbar-expand-sm bg-light navbar-light  shadow-lg p-3 mb-5 bg-body rounded  position-fixed" style="top: 60px; z-index: 10; margin-left: -45px; width: 100%;">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link  active" href="index.php?mod=Order&act=ListOrderUser">Tất cả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?mod=Order&act=ListOrderUser&duyetMon=0">Chờ nhận món</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?mod=Order&act=ListOrderUser&duyetMon=1">Đã nhận món</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php?mod=Order&act=ListOrderUser&trangThaiTT=0">Chưa thanh toán</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="index.php?mod=Order&act=ListOrderUser&trangThaiTT=1">Đã thanh toán</a>
                        </li>


                        <li class="nav-item mt-2" style="margin-left: 150px; width: 400px;">

                            <h5 class="text-warning float-right mb-3"><i class="bi bi-coin"></i> Tổng tiền cần thanh toán: <span class="text-danger "><b><?php if (!empty($total[0]['TongTien'])) {
                                                                                                                                                                echo currency_format($total[0]['TongTien']);
                                                                                                                                                            } else {
                                                                                                                                                                $total[0]['TongTien'] = 0;
                                                                                                                                                                echo currency_format($total[0]['TongTien']);
                                                                                                                                                            }
                                                                                                                                                            ?></span></b></h5>

                            <?php if (!empty($total[0]['TongTien'])) {
                                $total = $total[0]['TongTien'];
                            } else {
                                $total = 0;
                            }
                            $user = $user['hoTen'] . '-' . $user['maNhanVien'];
                            ?>
                            <?php if ($total != 0) { ?>
                                <button class="btn btn-danger mt-3" style="float: right;"><a class="text-light" href="index.php?mod=Order&act=Pay&total=<?php echo $total ?>&user=<?php echo $user ?>">Thanh toán</a></button>
                            <?php } ?>
                        </li>


                    </ul>
                </div>

            </nav>




            <?php
            $resultArray = array();
            if(!empty($listOder)){
            foreach ($listOder as $item) {
                $idDon = $item['idDon'];
                if (!isset($resultArray[$idDon])) {
                    // Nếu idDon chưa tồn tại trong mảng kết quả, thêm một mảng mới với khóa là idDon
                    $resultArray[$idDon] = array();
                }
                // Thêm phần tử vào mảng idDon tương ứng
                $resultArray[$idDon][] = $item;
            }
        }
            // Chuyển mảng kết quả thành mảng tuần tự nếu bạn muốn
            $resultArray = array_values($resultArray);
            ?>

<style>
     @keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    color: palevioletred;
  }
  60% {
    
  }
}

.noOrder  {
  display: inline-block;
  animation: bounce 1s infinite;
}

</style>
            <div style="margin-top: 150px;">
                <?php foreach ($resultArray as $index => $order) {

                ?>
                    <div class="container m-3 shadow-lg p-3 mb-5 bg-body rounded">
                        <?php
                        foreach ($order as $item) {
                            if ($item['duyetDon'] == 0) { ?>
                                <span class="badge bg-warning noOrder mb-3 p-1"><i class="bi bi-exclamation-triangle m-1"></i>Chưa nhận món</span>
                            <?php } else { ?>
                                <span class="badge bg-success   mb-3 p-1"><i class="bi bi-check-circle m-1"></i>Đã nhận món</span>
                            <?php }

                            if ($item['trangThaiThanhToan'] == 0) { ?>
                                <span class="badge bg-danger noOrder mb-3 p-1"><i class="bi bi-exclamation-triangle m-1"></i>Chưa thanh toán</span>
                            <?php } else { ?>
                                <span class="badge bg-success mb-3 p-1"><i class="bi bi-check-circle m-1"></i>Đã Thanh Toán</span>
                        <?php }
                            break;
                        } ?>

                        <?php foreach ($order as $item) { ?>

                            <div class="row border-top border-bottom">
                                <div class="col-md-1 p-2">
                                    <img src="./assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" class="img-fluid img-thumbnail" alt="">
                                </div>

                                <div class="col-md-8 d-flex flex-column ">
                                    <h5 class="name-product mt-3 mb-2"><b><?php echo $item['tenMon'] ?></b></h5>
                                    <p class="mb-2">x<?php echo $item['soLuong'] ?></p>
                                </div>

                                <div class="col-md-3 d-flex flex-column align-items-end justify-content-center p-2">
                                    <span class="text-danger"><?php echo currency_format($item['gia'] * $item['soLuong']) ?></span>
                                </div>
                            </div>

                        <?php }

                        $totalPrice = 0;
                        foreach ($order as $item) {
                            $totalPrice += $item['gia'] * $item['soLuong'];
                        }
                        ?>


                        <div class="row mt-3">
                            <div class="col-md-3 d-flex flex-column align-items-start justify-content-start p-2">
                                <span>Ngày nhận: <?php $ngayNhan = (new DateTime($item['ngayLenMon']))->format("d/m/Y");
                                                    echo $ngayNhan;
                                                    ?></span>
                            </div>
                            <div class="col-md-9 d-flex flex-column align-items-end justify-content-end p-2">
                                <h5>Thành tiền: <span class="text-danger"><?php echo currency_format($totalPrice) ?></span></h5>
                            </div>
                        </div>
                    </div>

                <?php } ?>


            </div>
        </div>
    </div>



</main>

