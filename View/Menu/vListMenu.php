<?php

include_once("Controller/cMenu.php");
include_once("Controller/cOrder.php");


$menu = new controlMenu();
$order = new controlOrder();

$date =  new DateTime();
$date = $date->format('Y-m-d');


    //////////Cập nhật lại tổng tiền và số lượng cho bảng đơn đặt món theo idDon;
    $OrderDetail = $order->getOrderDetail();

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
     
    $order->UpdateTotalAndQuantityOrder($totalByDonId);
    }
///////////////////////////////////////////


$ngayXemLich = $date;






$monday = strtotime('this week monday');
$thu2 = date('d/m/Y', $monday);

$tuesday = strtotime('this week tuesday');
$thu3  = date('d/m/Y', $tuesday);

$thursday = strtotime('this week wednesday');
$thu4  = date('d/m/Y', $thursday);

$thursday = strtotime('this week thursday');
$thu5  = date('d/m/Y', $thursday);

$friday = strtotime('this week friday');
$thu6  = date('d/m/Y', $friday);

$saturday = strtotime('this week saturday');
$thu7  = date('d/m/Y', $saturday);

$sunday = strtotime('this week sunday');
$thu8  = date('d/m/Y', $sunday);
if (!isset($_SESSION['t2'])) {

    $_SESSION['t2']  = $thu2;
    $_SESSION['t3']  = $thu3;
    $_SESSION['t4']  = $thu4;
    $_SESSION['t5']  = $thu5;
    $_SESSION['t6']  = $thu6;
    $_SESSION['t7']  = $thu7;
    $_SESSION['t8']  = $thu8;
}

if (isset($_POST['next'])) {
    $t2 = DateTime::createFromFormat('d/m/Y', $_SESSION['t2']);
    $t3 = DateTime::createFromFormat('d/m/Y', $_SESSION['t3']);
    $t4 = DateTime::createFromFormat('d/m/Y', $_SESSION['t4']);
    $t5 = DateTime::createFromFormat('d/m/Y', $_SESSION['t5']);
    $t6 = DateTime::createFromFormat('d/m/Y', $_SESSION['t6']);
    $t7 = DateTime::createFromFormat('d/m/Y', $_SESSION['t7']);
    $t8 = DateTime::createFromFormat('d/m/Y', $_SESSION['t8']);

    $t2->modify('+7 days');
    $t3->modify('+7 days');
    $t4->modify('+7 days');
    $t5->modify('+7 days');
    $t6->modify('+7 days');
    $t7->modify('+7 days');
    $t8->modify('+7 days');

    $_SESSION['t2'] = $t2->format('d/m/Y');
    $_SESSION['t3'] = $t3->format('d/m/Y');
    $_SESSION['t4'] = $t4->format('d/m/Y');
    $_SESSION['t5'] = $t5->format('d/m/Y');
    $_SESSION['t6'] = $t6->format('d/m/Y');
    $_SESSION['t7'] = $t7->format('d/m/Y');
    $_SESSION['t8'] = $t8->format('d/m/Y');


    $ngayXemLich  = $t2->format('Y-m-d');
} elseif (isset($_POST['prev'])) {
    $t2 = DateTime::createFromFormat('d/m/Y', $_SESSION['t2']);
    $t3 = DateTime::createFromFormat('d/m/Y', $_SESSION['t3']);
    $t4 = DateTime::createFromFormat('d/m/Y', $_SESSION['t4']);
    $t5 = DateTime::createFromFormat('d/m/Y', $_SESSION['t5']);
    $t6 = DateTime::createFromFormat('d/m/Y', $_SESSION['t6']);
    $t7 = DateTime::createFromFormat('d/m/Y', $_SESSION['t7']);
    $t8 = DateTime::createFromFormat('d/m/Y', $_SESSION['t8']);

    $t2->modify('-7 days');
    $t3->modify('-7 days');
    $t4->modify('-7 days');
    $t5->modify('-7 days');
    $t6->modify('-7 days');
    $t7->modify('-7 days');
    $t8->modify('-7 days');

    $_SESSION['t2'] = $t2->format('d/m/Y');
    $_SESSION['t3'] = $t3->format('d/m/Y');
    $_SESSION['t4'] = $t4->format('d/m/Y');
    $_SESSION['t5'] = $t5->format('d/m/Y');
    $_SESSION['t6'] = $t6->format('d/m/Y');
    $_SESSION['t7'] = $t7->format('d/m/Y');
    $_SESSION['t8'] = $t8->format('d/m/Y');

    $ngayXemLich  = $t2->format('Y-m-d');
} elseif (isset($_POST['current'])) {
    $_SESSION['t2'] = $thu2;
    $_SESSION['t3'] = $thu3;
    $_SESSION['t4'] = $thu4;
    $_SESSION['t5'] = $thu5;
    $_SESSION['t6'] = $thu6;
    $_SESSION['t7'] = $thu7;
    $_SESSION['t8'] = $thu8;
}

$t2 = $_SESSION['t2'];
$t3 = $_SESSION['t3'];
$t4 = $_SESSION['t4'];
$t5 = $_SESSION['t5'];
$t6 = $_SESSION['t6'];
$t7 = $_SESSION['t7'];
$t8 = $_SESSION['t8'];







?>

<style>
    .calendar [type="submit"] {
        padding: 8px 10px;
        font-weight: 600;
        background-color: #1da1f2;
        color: #fff;
        border-radius: 5px;
        border: none;
        font-size: 14px;

    }

    .calendar td p a {

        color: #000;
        padding: 5px;
        font-size: 12px;
        margin-left: 10px;



    }

    .calendar td .delete {
        padding: 0px 10px;
    }

    .calendarDish {
        margin-left: auto;
        margin-right: auto;
        border: 1px solid;
        width: 60%;
        margin-top: 20px;
        min-height: 125px;
        padding: 10px;
    }

    .calendarDish img {
        width: 100%;
        height: 100px;
    }
</style>

<div class="container-fluid px-4 calendar">

    <h3>Danh sách thực đơn</h3><br>
    <form action="" method="post">
        <input type="date" id="selectedDate" name="date" value="<?php echo $ngayXemLich  ?>">
        <input type="submit" value="Trở vể" id="previousWeekButton" name="prev">
        <input type="submit" value="Hiện Tại" id="currentDateButton" name="current">
        <input type="submit" value="Tiếp" id="nextWeekButton" name="next">
    </form>


    <div>
        <table class="calendartable">
            <tr>


                <th id="day">Thứ 2 <?php echo $t2;  ?></th>


                <th id="day">Thứ 3 <?php echo $t3; ?></th>


                <th id="day">Thứ 4 <?php echo $t4; ?></th>


                <th id="day">Thứ 5 <?php echo $t5; ?></th>


                <th id="day">Thứ 6 <?php echo $t6; ?></th>


                <th id="day">Thứ 7 <?php echo $t7; ?></th>


                <th id="day">Chủ nhật <?php echo $t8; ?></th>






            </tr>
            <tr>
                <td>
                    <?php
                    $newDate = date_format(date_create_from_format('d/m/Y', $t2), 'Y-m-d');
                    $list_menu = $menu->getMenuByDate($newDate);
                    if (!empty($list_menu)) {
                        foreach ($list_menu as $item) { ?>
                            <div class="calendarDish">
                            <img src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="">
                                <a><?php echo $item['tenMon'] ?></a>
                                <br>
                                <button class="btn btn-danger delete"> <a class="text-light" href="admin.php?mod=DeleteDishMenu&idThucDon=<?php echo $item['idThucDon'] ?>&idMonAn=<?php echo $item['idMonAn'] ?>&ngayLenMon=<?php echo $item['ngayTao'] ?>">Xóa</a></button>
                            </div>
                    <?php  }
                    } ?>
                </td>
                <td>
                    <?php
                    $newDate = date_format(date_create_from_format('d/m/Y', $t3), 'Y-m-d');
                    $list_menu = $menu->getMenuByDate($newDate);
                    if (!empty($list_menu)) {
                        foreach ($list_menu as $item) { ?>
                            <div class="calendarDish">
                            <img src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="">
                                <a><?php echo $item['tenMon'] ?></a>
                                <br>
                                <button class="btn btn-danger delete"> <a class="text-light" href="admin.php?mod=DeleteDishMenu&idThucDon=<?php echo $item['idThucDon'] ?>&idMonAn=<?php echo $item['idMonAn'] ?>&ngayLenMon=<?php echo $item['ngayTao'] ?>">Xóa</a></button>
                            </div>
                    <?php  }
                    } ?>
                </td>

                <td>
                    <?php
                    $newDate = date_format(date_create_from_format('d/m/Y', $t4), 'Y-m-d');
                    $list_menu = $menu->getMenuByDate($newDate);
                    if (!empty($list_menu)) {
                        foreach ($list_menu as $item) { ?>
                            <div class="calendarDish">
                            <img src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="">
                                <a><?php echo $item['tenMon'] ?></a>
                                <br>
                                <button class="btn btn-danger delete"> <a class="text-light" href="admin.php?mod=DeleteDishMenu&idThucDon=<?php echo $item['idThucDon'] ?>&idMonAn=<?php echo $item['idMonAn'] ?>&ngayLenMon=<?php echo $item['ngayTao'] ?>">Xóa</a></button>
                            </div>
                    <?php  }
                    } ?>
                </td>

                <td>
                    <?php
                    $newDate = date_format(date_create_from_format('d/m/Y', $t5), 'Y-m-d');
                    $list_menu = $menu->getMenuByDate($newDate);
                    if (!empty($list_menu)) {
                        foreach ($list_menu as $item) { ?>
                            <div class="calendarDish">
                            <img src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="">
                                <a><?php echo $item['tenMon'] ?></a>
                                <br>
                                <button class="btn btn-danger delete"> <a class="text-light" href="admin.php?mod=DeleteDishMenu&idThucDon=<?php echo $item['idThucDon'] ?>&idMonAn=<?php echo $item['idMonAn'] ?>&ngayLenMon=<?php echo $item['ngayTao'] ?>">Xóa</a></button>
                            </div>
                    <?php  }
                    } ?>
                </td>

                <td>
                    <?php
                    $newDate = date_format(date_create_from_format('d/m/Y', $t6), 'Y-m-d');
                    $list_menu = $menu->getMenuByDate($newDate);
                    if (!empty($list_menu)) {
                        foreach ($list_menu as $item) { ?>
                            <div class="calendarDish">
                            <img src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="">
                                <a><?php echo $item['tenMon'] ?></a>
                                <br>
                                <button class="btn btn-danger delete"> <a class="text-light" href="admin.php?mod=DeleteDishMenu&idThucDon=<?php echo $item['idThucDon'] ?>&idMonAn=<?php echo $item['idMonAn'] ?>&ngayLenMon=<?php echo $item['ngayTao'] ?>">Xóa</a></button>
                            </div>
                    <?php  }
                    } ?>
                </td>

                <td>
                    <?php
                    $newDate = date_format(date_create_from_format('d/m/Y', $t7), 'Y-m-d');
                    $list_menu = $menu->getMenuByDate($newDate);
                    if (!empty($list_menu)) {
                        foreach ($list_menu as $item) { ?>
                            <div class="calendarDish">
                            <img src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="">
                                <a><?php echo $item['tenMon'] ?></a>
                                <br>
                                <button class="btn btn-danger delete"> <a class="text-light" href="admin.php?mod=DeleteDishMenu&idThucDon=<?php echo $item['idThucDon'] ?>&idMonAn=<?php echo $item['idMonAn'] ?>&ngayLenMon=<?php echo $item['ngayTao'] ?>">Xóa</a></button>
                            </div>
                    <?php  }
                    } ?>
                </td>

                <td>
                    <?php
                    $newDate = date_format(date_create_from_format('d/m/Y', $t8), 'Y-m-d');
                    $list_menu = $menu->getMenuByDate($newDate);
                    if (!empty($list_menu)) {
                        foreach ($list_menu as $item) { ?>
                            <div class="calendarDish">
                                <img src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt="">
                                <a><?php echo $item['tenMon'] ?></a>
                                <br>
                                <button class="btn btn-danger delete"> <a class="text-light" href="admin.php?mod=DeleteDishMenu&idThucDon=<?php echo $item['idThucDon'] ?>&idMonAn=<?php echo $item['idMonAn'] ?>&ngayLenMon=<?php echo $item['ngayTao'] ?>">Xóa</a></button>
                            </div>
                    <?php  }
                    } ?>
                </td>

            </tr>
        </table >

    </div>
</div>



<?php
if (isset($_REQUEST['next'])) {
    $date =  new DateTime();
    $date = $date->modify('+7 days');
}


?>






<script>
    document.getElementById('selectedDate').addEventListener('change', function() {
        document.getElementById('submitBtn').click();
    });
</script>