<?php

include_once("Controller/cDish.php");


$p = new controlDish();

$list_loai  = $p->getAllLoaiMonAn();

if (isset($_REQUEST['idLoai'])) {
    $id = $_REQUEST['idLoai'];
    $list_user = $p->getAllDishByIdLoai($id);
} elseif (isset($_REQUEST['search'])) {
    $search = $_REQUEST['search'];
    $list_user = $p->DishSearch($search);
} elseif (isset($_REQUEST['date'])) {
    $ngayTao = $_REQUEST['date'];
    $list_user = $p->getAllDishMenuByDate($ngayTao);
} else {
    $list_user = $p->getAllDishMenu();
}

if (isset($_GET['date'])) {
    $_SESSION['dateOfDish'] = $_GET['date'];
}

?>


<style>

</style>


<main id="main" class="main">

    <div class="pagetitle">


    <div class="col-lg-12 col-md-7">
                <div class="product__discount">
                    
                    <?php
                    $today = date("Y-m-d");

                    // Kiểm tra xem ngày hôm nay có phải là thứ 6 hay không (5 là thứ 6)
                    if (date("N", strtotime($today)) == 5 || date("N", strtotime($today)) == 6) {
                        // Nếu ngày hôm nay là thứ 6, thì lấy ngày thứ 2 của tuần tới
                        $tomorrow = date("Y-m-d", strtotime("next Monday", strtotime($today)));
                    } else {
                        // Ngược lại, tăng ngày thêm 1
                        $tomorrow = date("Y-m-d", strtotime($today . " +1 day"));
                    }

                    $tomorrow_full = date("l, d/m/Y", strtotime($tomorrow));
                    $ngaytt = date("d/m/Y", strtotime($tomorrow));



                    ?>
                    <div class="section-title product__discount__title">
                        <h2>Món ăn cho ngày tiếp theo: <?php echo $ngaytt  ?></h2>


                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            <?php
                            $menuToday = $p->getAllDishMenuByDate($tomorrow);
                            if (!empty($menuToday)) {
                                foreach ($menuToday as $item) { ?>
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg" data-setbg="./assets/imageDish/<?php echo $item['hinhAnhMon'] ?>">

                                                <ul class="product__item__pic__hover">

                                                    <li><a href="index.php?mod=Cart&act=Add&idMonAn=<?php echo $item['idMonAn'] ?>&date=<?php echo $_GET['date'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <a href="">
                                                    <span><?php echo $tomorrow_full; ?></span>
                                                    <h5><?php echo $item['tenMon'] ?></h5>
                                                    <div class="product__item__price"><?php echo currency_format($item['gia']) ?>
                                                      
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>


                        </div>
                    </div>
                </div>
                <div class="filter__item" id="filter__item">
                    <div class="row">

                        <div class="col-lg-2 col-md-3">
                            <div class="filter__found">
                                <h4><span><?php if (!empty($list_user)) {
                                                echo  count($list_user);
                                            } else {
                                                echo "0";
                                            }  ?></span> Món ăn</h4>
                            </div>

                        </div>

                        <div class="col-lg-10 col-md-9">
                            <div class="filter__sort">
                                
                                <a style="pointer-events: none;" href="#">Đặt món ăn cho ngày: <?php $dateTime = new DateTime($_GET['date']);
                                $ngayDaDoiDinhDang = $dateTime->format('d/m/Y');
                                echo $ngayDaDoiDinhDang;
                                ?></a>
                            </div>
                        </div>
                    </div>
                    <h5 style="text-align: right; margin: 10px 0px;">Thời gian còn lại đặt món:</h5>
                    <div class="countdown">

                        <div>
                            <div id="days">00</div><span>ngày</span>
                        </div>
                        <div>
                            <div id="hours">00</div><span>giờ</span>
                        </div>
                        <div>
                            <div id="minutes">00</div><span>phút</span>
                        </div>
                        <div>
                            <div id="seconds">00</div><span>giây</span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php if (!empty($list_user)) {

                        foreach ($list_user as $item) { ?>
                            <div class="col-lg-3 col-md-6 col-sm-6 dishfoodproduct">
                                <?php
                                $product = true;
                                $ngayHientai =  (new DateTime())->format('Y-m-d H:i:s');
                                if ($item['ngayTao'] <=  $ngayHientai) {
                                    $product = false;
                                ?>

                                    <div style="pointer-events: none;" class="product__item">
                                    <?php } else { ?>
                                        <div class="product__item">
                                        <?php } ?>
                                        <a href="index.php?mod=Dish&act=DishDetail&idMonAn=<?php echo $item['idMonAn'] ?>&date=<?php echo $_GET['date'] ?>">
                                            <div class="product__item__pic set-bg" data-setbg="./assets/imageDish/<?php echo $item['hinhAnhMon'] ?>">
                                                <?php if ($product == false) { ?>
                                                    <h3 class="ban_food">Không được phép đặt món</h3>
                                                    
                                                <?php } ?>
                                            </div>
                                            <div class="product__item__text">
                                                <h6><?php echo $item['tenMon'] ?></h6>
                                                <h5><?php echo currency_format($item['gia']) ?>
                                                    
                                                </h5>
                                            </div>
                                        </a>
                                        <a class="cart" href="index.php?mod=Cart&act=Add&idMonAn=<?php echo $item['idMonAn'] ?>&date=<?php echo $_GET['date'] ?>"><i class="fa-solid fa-cart-plus"></i></a>
                                        </div>

                                    </div>
                            <?php }
                    } else {
                        echo "<h1>không có món ăn nào</h1>";
                    } ?>

                            </div>
                            <div class="product__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>

                            </div>

                </div>
            </div>



</main>

<script>
    function countdown() {
        <?php $ngayTao = $_REQUEST['date'];
        $ngay_truoc_do = date('Y-m-d', strtotime($ngayTao . ' -1 day'));


        $ngayTaoFormatted = (new DateTime($ngay_truoc_do))->format('Y-m-d 19:00:00'); ?>
        const endDate = new Date('<?php echo $ngayTaoFormatted ?>').getTime();
        const now = new Date().getTime();
        const timeRemaining = endDate - now;


        if (timeRemaining <= 0) {
            document.getElementById('days').textContent = '00';
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
        } else {
            const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = formatTime(days);
            document.getElementById('hours').textContent = formatTime(hours);
            document.getElementById('minutes').textContent = formatTime(minutes);
            document.getElementById('seconds').textContent = formatTime(seconds);
        }
    }

    function formatTime(time) {
        return time < 10 ? `0${time}` : time;
    }

    setInterval(countdown, 1000);
</script>
