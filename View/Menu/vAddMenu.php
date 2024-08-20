<?php
include_once("Controller/cDish.php");
include_once("Controller/cMenu.php");
include_once("lib/price.php");

$p = new controlDish();
$menu = new controlMenu();
$list_loai  = $p->getAllDish();
$LatestMenu = $menu->getLatestMenu();
$list_menu = $menu->getAlltMenu();


?>
<style>
    .form-container {
        display: none;
    }
</style>
<div class="container-fluid px-4 add">
    <div class="upload">
        <h2 class="mt-4 m-3">Thêm món vào thực đơn</h2>
        <table class="admin_upload">
            <form action="" method="post">
                <tr>
                    <th>Chọn ngày lên món:</th>
                    <th><input type="date" name="date" id="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'] ?>" required>
                        <input style="display: none;" type="submit" value="Submit" id="submitBtn" name="sub_date">
                    </th>
                </tr>
                <tr>
                    <th>Chọn món </th>
                    <th>
                        <div style="display: flex; flex-wrap:wrap">

                            <?php

                            if (isset($_POST['date'])) {
                                $ngay = $_POST['date'];
                                $date =  new DateTime($ngay);
                                $date = $date->format('Y-m-d H:i:s');


                                $ngaymoi = (new DateTime($ngay))->modify('+1 day')->format('Y-m-d');
                                $thu = date('l', strtotime($date));

                                if ($thu == 'Monday') {
                                    $ngaycu = (new DateTime($ngay))->modify('-3 day')->format('Y-m-d');
                                } else {
                                    $ngaycu = (new DateTime($ngay))->modify('-1 day')->format('Y-m-d');
                                }

                                $menu = new controlMenu();
                                $cu = $menu->getMenuByDate($ngaycu);
                                $moi = $menu->getMenuByDate($ngaymoi);
                                $today = $menu->getMenuByDate($date);

                                $mon = array();


                                $ngayHientai =  (new DateTime())->format('Y-m-d H:i:s');


                                if ($thu == 'Saturday' || $thu == 'Sunday') {
                                    echo "<script>alert('không được lên lịch cuối tuần ')</script>";
                                } elseif ($date <= $ngayHientai) {
                                    echo "<script>alert('Chỉ được phép lên lịch cho thời gian sau ngày hôm nay!')</script>";
                                } else {

                                    foreach ($list_loai as $index => $monan) {
                                        $found = true;

                                        if (!empty($cu)) {
                                            foreach ($cu as $item) {
                                                if ($monan['idMonAn'] == $item['idMonAn']) {
                                                    $found = false;
                                                }
                                            }
                                        }

                                        if (!empty($moi)) {
                                            foreach ($moi as $item) {
                                                if ($monan['idMonAn'] == $item['idMonAn']) {
                                                    $found = false;
                                                }
                                            }
                                        }
                                        if (!empty($today)) {
                                            foreach ($today as $item) {
                                                if ($monan['idMonAn'] == $item['idMonAn']) {
                                                    $found = false;
                                                }
                                            }
                                        }

                                        if ($found == true) { ?>
                                            <div style="border-radius: 5px; padding:5px; margin: 5px 5px; border:1px solid; width:150px" class="dish_mon">
                                                <label for="checkbox<?php echo $index ?>"><?php echo $monan['tenMon'] ?></label>
                                                <input type="checkbox" class="show-form" data-form="form<?php echo $index ?>" id="checkbox<?php echo $index ?>" style="margin-right:20px; float: right; margin-top: 5px;" name="monan[]" id="" value="<?php echo $monan['idMonAn'] ?>">
                                            </div>
                            <?php      }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </th>
                </tr>




                <tr>

                    <td>


                    </td>
                    <td>
                        <input type="submit" value="Thêm" id="submit" name="btn_addmenu" onclick="return validateCheckbox()">
                        <input type="reset" value="Hủy" id="reset" name="" >


                    </td>
                </tr>

                <tr>
                    <?php
                    // Xử lý insert thêm thực đơn khi chọn ngày
                    $menu = new controlMenu();
                    if (isset($_POST['sub_date'])) {
                        if (isset($_POST['date'])) {
                            $isAllowed = true;

                            if (!empty($list_menu)) {
                                foreach ($list_menu as $index => $item) {
                                    $as = (new DateTime($item['ngayTao']))->format('Y-m-d');

                                    if ($_POST['date'] == $as) {
                                        $isAllowed = false;
                                        break;
                                    }
                                }
                            }
                            if ($isAllowed && $_POST['date'] >  $ngayHientai  && $thu != 'Saturday' && $thu != 'Sunday') {
                                $ngayTao = (new DateTime($_POST['date']))->format('Y-m-d H:i:s');
                                $menu->InsertMenu($ngayTao);
                            } else {
                                $isAllowed = false;
                            }
                        }
                    }



                    ?>

                </tr>
            </form>
        </table>
    </div>
</div>

</body>

</html>
<?php
//Thêm món ăn và idThucDon và chitietthucdon


if (isset($_POST['btn_addmenu'])) {
    $idMonAn = array();
    $idMonAn =  $_POST['monan'];
    $ngayTao = $_POST['date'];

    $menu = new controlMenu();
    $ThucDon = $menu->getOneMenuByDate($ngayTao);
    $idThucDon =  $ThucDon['idThucDon'];
   
    $ins = $menu->InsertMenuDetails($idThucDon, $idMonAn);
    if ($ins == 1) {
        echo '<script>alert("thêm món thành công")</script>';
        echo header("refresh: 0; url='admin.php?mod=addMenu'");
    } else {
        echo '<script>alert("thêm món thất bại")</script>';
    }
}



?>