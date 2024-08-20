<?php


include_once("Controller/cCart.php");

$p = new controlCart();

$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];

$list_buy = $p->getAllCartByIdTaiKhoan($idTaiKhoan);

$ngayHomNay = date('y-m-d');
$p->DeleteDishCartOutDate($ngayHomNay);
?>
<style>
    td {
        border-left: none !important;
        border-right: none !important;

    }
</style>
<?php if (isset($_SESSION['login'])) { ?>
    <main id="main" class="main">
    

        <div class="pagetitle">

        <h1 class="text-center m-3 p-3"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng </h1>
            <div class="col-lg-12 col-md-7">
                <?php


                if (!empty($list_buy)) {
                ?>
                    <div class="container">


                        <div class="row">

                            <?php
                            $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];

                            foreach ($daysOfWeek as $index => $day) {
                                $timestamp = strtotime('this week ' . $day);
                                $friday = strtotime('this week Friday');
                                $ngayHientai = new DateTime();
                                $ngayHientaiTimestamp = $ngayHientai->getTimestamp();

                                if ($ngayHientaiTimestamp >= $friday) {
                                    $timestamp = strtotime('next week ' . $day);
                                }

                                $ngaydat = date('d/m/Y', $timestamp);
                                $ngayLenMMon = date('Y-m-d 00:00:00', $timestamp);

                                $hasVisibleContent = false; // Biến kiểm tra xem có nội dung hiển thị hay không

                                foreach ($list_buy as $item) {
                                    if ($item['ngayLenMon'] === $ngayLenMMon) {
                                        $hasVisibleContent = true; // Có nội dung hiển thị
                                        break;
                                    }
                                }

                                if ($hasVisibleContent) {
                            ?>
                                    <div class="col-lg-12">

                                        <h6><b>Đặt cho thứ <?php echo $index + 2; ?> ngày <?php echo $ngaydat; ?></b></h6>
                                        <div class="shoping__cart__table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Ảnh</th>
                                                        <th>Tên món</th>
                                                        <th>Đơn giá</th>
                                                        <th>Số lượng</th>
                                                        <th>Tổng tiền</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    $tongTien = 0;
                                                    $total = array();
                                                    foreach ($list_buy as $item) {
                                                        if ($item['ngayLenMon'] === $ngayLenMMon) {

                                                    ?>
                                                            <tr>
                                                                <td><?php echo $i++ ?></td>
                                                                <td class="shoping__cart__item">
                                                                    <img src="assets/imageDish/<?php echo $item['hinhAnhMon']; ?>" alt="">
                                                                </td>
                                                                <td class="shoping__cart__title">
                                                                    <h5><?php echo $item['tenMon']; ?></h5>
                                                                </td>
                                                                <td class="shoping__cart__price">
                                                                    <?php echo currency_format($item['gia']); ?>
                                                                    <sup>đ</sup>
                                                                </td>
                                                                <td class="shoping__cart__quantity">

                                                                    <form id="myForm" action="" method="post">
                                                                        <input type="number" name="slcart" min='1' value="<?php echo $item['soLuong']; ?>" id="slcart<?php echo $item['idMonAn'] . $timestamp; ?>">
                                                                        <input type="hidden" name="idMonAn" value="<?php echo $item['idMonAn']; ?>">
                                                                        <input type="hidden" name="ngayLenMon" value="<?php echo $item['ngayLenMon']; ?>">

                                                                        <input style="display: none;" type="submit" value="Submit" id="btn_sl<?php echo $item['idMonAn'] . $timestamp; ?>" name="btn_sl<?php echo $item['idMonAn'] . $timestamp; ?>">
                                                                    </form>
                                                                </td>
                                                                <td class="shoping__cart__total">
                                                                    <?php echo currency_format($item['soLuong'] * $item['gia']); ?>
                                                                    <sup>đ</sup>
                                                                    <?php
                                                                    $tongTien += $item['soLuong'] * $item['gia'];


                                                                    ?>
                                                                </td>
                                                                <td class="shoping__cart__item__close">
                                                                    <a style="border-radius: 5px; background-color: #ccc; padding:2px 5px; color:#000; " href="index.php?mod=cart&act=DeleteNgayTaoGio&ngayTaoGio=<?php echo $item['ngayTaoGio'] ?>">X</a>
                                                                </td>
                                                            </tr>

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td colspan="3">
                                                            <a style="border-radius:10px; background-color: #249BC8; padding: 5px 10px; color: #fff;" href="index.php?mod=Order&act=OrderDate&ngayLenMon=<?php echo $item['ngayLenMon'] ?>"><b>Đặt món</b></a>


                                                            <a style="border-radius:10px; background-color: red;  padding: 5px 10px; color: #fff;" href="index.php?mod=cart&act=DeleteNgayLenMon&ngayLenMon=<?php echo $item['ngayLenMon'] ?>"><b>Hủy món</b></a>
                                                        </td>
                                                        <td colspan="2">

                                                            <h6>Tổng tiền đơn thứ <?php echo $index + 2; ?> ngày <?php echo $ngaydat; ?>:</h6>
                                                        </td>
                                                        <td>

                                                            <h5><b><?php echo currency_format($tongTien) ?> <sup>đ</sup></b></h5>
                                                        </td>


                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>


                        </div>
                     

                        <?php
                               $tongCong = 0;
                               $soLuong = 0;
                        if (!empty($list_buy)) {
                            foreach ($list_buy as $item) {
                                $tongCong += $item['soLuong'] * $item['gia'];
                                $soLuong += $item['soLuong'];
                            }
                        }
                        ?>
                        <div class="row">


                            <div class="col-lg-12">
                                <div class="shoping__checkout">
                                    <h5>Tổng thanh toán:</h5>


                                    <ul>
                                        <li>Tổng tiền:<span><?php echo currency_format($tongCong) ?> </span></li>
                                        <li>Số lượng:<span>x <?php echo $soLuong ?></span></li>


                                    </ul>
                                    <a href="index.php?mod=Order&act=Order" class="primary-btn">Đặt món</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>
                    <h1 style="text-align:center; margin-top: 10%; margin-bottom: 10%;">Không có món ăn nào !</h1>
                <?php } ?>

            </div>
        </div>



    </main>

<?php

} else {

    echo header("refresh: 0; url='?mod=404");
}

if (!empty($list_buy)) {
    foreach ($list_buy as $item) {
        $timestamp = strtotime($item['ngayLenMon']);

        $post = 'btn_sl' . $item['idMonAn'] .  $timestamp;



        if (isset($_POST["$post"])) {
            $soLuong = $_POST['slcart'];
            $idMonAn = $_POST['idMonAn'];
            $ngayLenMon = $_POST['ngayLenMon'];


            $success = $p->UpdateShopCartDetails($soLuong, $idMonAn, $ngayLenMon);
            if ($success) {
                echo header("refresh: 0; url='index.php?mod=cart'");
            }
        }
    }
}
?>

<?php
if (!empty($list_buy)) {
    foreach ($list_buy as $item) {
        $timestamp = strtotime($item['ngayLenMon']);
?>
        <script>
            var slcartInput<?php echo $item['idMonAn'] . $timestamp ?> = document.getElementById('slcart<?php echo $item['idMonAn'] . $timestamp; ?>');
            var submitButton<?php echo $item['idMonAn'] . $timestamp; ?> = document.getElementById('btn_sl<?php echo $item['idMonAn'] . $timestamp; ?>');

            // Xử lý sự kiện onchange cho trường nhập
            slcartInput<?php echo $item['idMonAn'] . $timestamp; ?>.onchange = function() {
                submitButton<?php echo $item['idMonAn'] . $timestamp; ?>.click();
            };
        </script>
<?php }
} ?>
<script>
    // Lưu vị trí cuộn khi rời khỏi trang
    window.addEventListener('unload', function() {
        localStorage.setItem('scrollPos', window.pageYOffset);
    });

    // Khôi phục vị trí cuộn khi tải lại trang
    window.addEventListener('load', function() {
        const scrollPos = parseInt(localStorage.getItem('scrollPos'), 10);
        if (!isNaN(scrollPos)) {
            window.scrollTo(0, scrollPos);
            localStorage.removeItem('scrollPos');
        }
    });
</script>

