<?php
include_once("Controller/cDish.php");
include_once("Controller/cOrder.php");

$or = new controlOrder();
$p = new controlDish();

$idMonAn = $_GET['idMonAn'];
$monan = $p->getLoaiMonAnById($idMonAn);


$_SESSION['idMonAn'] = $idMonAn;
if (isset($_GET['date'])) {
    $_SESSION['dateOfDish'] = $_GET['date'];
}

$date = $p->getAllDishMenuidMonAn($idMonAn);
$menu = $p->getAllDishMenuByDate($_GET['date']);
$nl = $p->gettAllDishIngredient($idMonAn);
$idMonAn = $_GET['idMonAn'];
$phanhoi = $p->getPhanHoiByIdMonAn($idMonAn);


$order = $or->getOrderByidTaiKhoan($idTaiKhoan);
?>

<main id="main" class="main">

    <div class="pagetitle">


        <div class="col-lg-12 col-md-7">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img class="product__details__pic__item--large" src="./assets/imageDish/<?php echo $monan['hinhAnhMon'] ?>" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3><?php echo $monan['tenMon'] ?></h3>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(<?php if (!empty($phanhoi)) {
                                            echo count($phanhoi);
                                        } else {
                                            echo 0;
                                        } ?> nhận xét)</span>
                            </div>
                            <div class="product__details__price"><?php echo currency_format($monan['gia']) ?></div>
                            <label for="">Chọn thời gian đặt món:</label>
                            <div style="display: flex; align-items: center;">
                                <div class="dropdown">
                                    <button class="dropbtn">Chọn thời gian đặt món</button>
                                    <div class="dropdown-content">


                                        <?php

                                        $ngayTaoFormatted = array();
                                        $ngayTaoLink = array();


                                        foreach ($date as $index => $item) {
                                            $ngayTao =  $item['ngayTao'];
                                            $ngayTaoFormatted[] = (new DateTime($ngayTao))->format('d/m/Y');
                                            $ngayTaoLink[] = (new DateTime($ngayTao))->format('Y-m-d');
                                            $ht = date('Y-m-d H:i:s');
                                            if ($ngayTao > $ht) {
                                        ?>

                                                <a href="index.php?mod=Dish&act=DishDetail&idMonAn=<?php echo $_SESSION['idMonAn'] ?>&date=<?php echo $ngayTaoLink[$index] ?>">
                                                    <?php echo   'Ngày ' . $ngayTaoFormatted[$index] ?></a>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>

                                <a href="index.php?mod=Cart&act=Add&idMonAn=<?php echo $monan['idMonAn'] ?>&date=<?php echo $_GET['date'] ?>" class="primary-btn">Thêm món vào giỏ</a>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Mô tả tóm tắt</a>
                                </li>


                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Mô tả tóm tắt</h6>
                                        <p><?php echo $monan['Mota'] ?></p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
            <!-- Product Details Section End -->

            <!-- Related Product Section Begin -->
            <section class="related-product">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title related__product__title">
                                <h2>Món ăn khác</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php
                        if (!empty($menu)) {
                            foreach ($menu as $index => $item) { ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="./assets/imageDish/<?php echo $item['hinhAnhMon'] ?>">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#"><?php echo $monan['tenMon'] ?></a></h6>
                                            <h5><?php echo currency_format($monan['gia']) ?></h5>
                                        </div>
                                    </div>
                                </div>
                        <?php if ($index == 3) break;
                            }
                        } ?>
                    </div>
                </div>
            </section>


        </div>
    </div>















    <style>
        .replies {
            border-radius: 14px;
            background-color: #e0e0e0;
            width: 90%;
            height: 90px;
            margin-left: 8%
        }

        .tab-pane {
            position: fixed;
            top: 60px;
            right: -38%;
            width: 40%;
            bottom: 0px;
            overflow-y: scroll;
            background-color: #fff;
            box-shadow: -2px 3px 3px #000;
            border-radius: 10px;
            z-index: 600;

        }

        .tab-pane-show {
            right: 0px;
        }

        .danhgia {
            position: fixed;
            top: 60px;
            width: 40%;
            background-color: #fff;
            box-shadow: 1px 3px 4px #000;
        }

        .danhgia button {
            width: 90%;

        }

        .tab-pane_active {

            animation: show 1s forwards;

        }

        .tab-pane_hide {

            animation: hide 1s forwards;

        }

        @keyframes show {
            0% {
                right: -38%;
            }

            100% {
                right: 0px;
            }
        }

        @keyframes hide {
            0% {
                right: 0px;
            }

            100% {
                right: -38%;

            }
        }

        .chevron {
            position: fixed;
            top: 50%;
            right: 4%;
            z-index: 600;
            text-align: center;
        }

        .chevron {
            font-size: 32px;
        }

        .chevron p {
            margin-bottom: -5px;
        }

        @keyframes color1 {
            0% {
                color: #ccc;
            }

            100% {
                color: blue;
                text-shadow: -5px 0px 5px blue;

            }
        }

        @keyframes color2 {
            0% {
                color: #ccc;
            }

            100% {
                color: rgb(26, 37, 252);
                text-shadow: -5px 0px 5px rgb(26, 37, 252);
            }
        }

        @keyframes color3 {
            0% {
                color: #ccc;
            }

            100% {
                color: rgb(126, 185, 253);
                text-shadow: -5px 0px 5px rgb(126, 185, 253);

            }
        }

        .chevron .chevron1 {
            animation: color1 linear 1s infinite;

        }

        .chevron .chevron2 {
            animation: color2 linear 1s infinite;

        }

        .chevron .chevron3 {
            animation: color3 linear 1s infinite;

        }
    </style>
    <script>
        function myShow() {
            var element = document.getElementById('tabs-3');
            element.classList.add("tab-pane_active");
            element.classList.remove("tab-pane_hide");

        }

        function myHide() {
            var element = document.getElementById('tabs-3');
            element.classList.add("tab-pane_hide");
            element.classList.remove("tab-pane_active");
            element.classList.remove("tab-pane-show");
        }
    </script>

    <div onclick="myShow()" class="chevron">
        <p class="text-primary"><b>Đánh giá</b></p>
        <i class="fa-solid fa-chevron-left chevron1"></i>
        <i class="fa-solid fa-chevron-left chevron2"></i>
        <i class="fa-solid fa-chevron-left chevron3"></i>
    </div>
    <?php if (isset($_GET['phanhoi'])) { ?>
        <div class="tab-pane tab-pane-show" id="tabs-3" role="tabpanel">
        <?php } else { ?>
            <div class="tab-pane " id="tabs-3" role="tabpanel">

            <?php  } ?>
            <div class="container" style="border-radius: 14PX; background-color: #F3F6FA; width: 100%;">
                <div class="cmt">

                    <div class="border-top  border-bottom mb-4" style="margin-top: 140px;">

                        <?php
                        if (!empty($phanhoi)) {
                            foreach ($phanhoi as $item) { ?>
                                <div class="comment shadow-lg p-3 mb-5 bg-body" style="border-radius: 20px; position: relative;" id="<?php echo $item['idPhanHoi'] ?>">

                                    <div class="row">
                                        <div class="col-md-12 avatar" style="display: flex; align-items: center;">

                                            <img class="avatar rounded-circle ml-4 mt-1" src="assets/imageProfile/<?php echo $item['hinhAnh'] ?>" alt="Avatar" style="width: 32px;">
                                            <span class="name " style="font-weight: bold;"><?php echo $item['hoTen'] ?></span>&nbsp;
                                            <span class="date ml-1"><?php
                                                                    $ngay =  date(" H:i d/m/Y", strtotime($item['ngayDanhGia']));
                                                                    echo $ngay ?></span>
                                            <?php if ( $item['idTaiKhoan'] == $_SESSION['is_login']['idTaiKhoan']) { ?>
                                                <a href="index.php?mod=Dish&act=DeletePhanHoi&idMonAn=<?php echo $_GET['idMonAn'] ?>&date=<?php echo  $_GET['date'] ?>&idPhanHoi=<?php echo $item['idPhanHoi'] ?>" style="position: absolute; right: 10px; color: red;"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="row ml-3">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4 rating">
                                            <?php for ($i = 0; $i < $item['danhGia']; $i++) {  ?>
                                                <span class="star text-warning">★</span>
                                            <?php }   ?>
                                        </div>
                                    </div>

                                    <div class="row ml-3">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-8">
                                            <p class="message"><?php echo $item['noiDungPhanHoi'] ?></p>
                                        </div>
                                    </div>

                                    <button class="reply-button btn btn-secondary" style="position: absolute; top: 50px; right: 25px;" onclick="showReplyForm(this)">Trả
                                        lời</button>

                                    <?php
                                    $idPhanHoi = $item['idPhanHoi'];
                                    $traloi = $p->getTraLoiByIdPhanHoi($idPhanHoi);

                                    if (!empty($traloi)) {
                                        foreach ($traloi as $tl) {
                                    ?>
                                            <div class="phanhoi">
                                                <div class="row replies  mb-4">
                                                    <div class="col-md-12 comment reply">
                                                        <div class="row">

                                                            <div class="col-md-12 avatar" style="display: flex; align-items: center;">
                                                                <?php if ($tl['Role'] == 1 || $tl['Role'] == 2) { ?>
                                                                    <img class="avatar rounded-circle ml-3 mt-1" src="assets/admin/img/apple-touch-icon.png" alt="Avatar" style="width: 22px;">

                                                                    <span class="name badge bg-danger" style="font-weight: bold; font-size: 12px;">Quản trị viên <i class="fa-solid fa-circle-check ml-2"></i></span>&nbsp;
                                                                <?php } else { ?>
                                                                    <img class="avatar rounded-circle ml-3 mt-1" src="assets/imageProfile/<?php echo $tl['hinhAnh'] ?>" alt="Avatar" style="width: 22px;">
                                                                    <span class="name" style="font-weight: bold; font-size: 12px;"><?php echo $tl['hoTen'] ?></span>&nbsp;
                                                                <?php } ?>
                                                                <span class="date" style="font-size: 12px;"><?php
                                                                                                            $ngay =  date(" H:i d/m/Y", strtotime($tl['ngayTraLoi']));
                                                                                                            echo $ngay;
                                                                                                            ?></span>

                                                            </div>
                                                        </div>


                                                        <div class="col-md-12" style="margin-left: 30px;">
                                                            <p class="message"><?php echo $tl['noiDung'] ?></p>
                                                        </div>
                                                        <?php if ($tl['idTaiKhoan'] == $_SESSION['is_login']['idTaiKhoan']) { ?>
                                                            <a href="index.php?mod=Dish&act=DeleteTraLoi&idMonAn=<?php echo $_GET['idMonAn'] ?>&date=<?php echo  $_GET['date'] ?>&idTraLoi=<?php echo $tl['idTraLoi'] ?>" style="position: absolute; bottom: 10px; right: 10px; color: red;"><i class="fa-solid fa-trash-can"></i></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                    <div class="row reply-form" style="display: none;">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-9">
                                            <form action="index.php?mod=Dish&act=TraLoi&idMonAn=<?php echo $_GET['idMonAn'] ?>&date=<?php echo  $_GET['date'] ?>" method="post">
                                                <label for="reply">Trả lời:</label>
                                                <br>
                                                <input type="hidden" name="idTaiKhoanGuiDen" value="<?php echo $item['idTaiKhoan'] ?>">

                                                <div style="height: 100px; width: 445px; border: 1px solid #00c; border-radius:10px ; position: relative;">
                                                    <textarea class="reply-input" name="traloi<?php echo $item['idPhanHoi'] ?>" id="noidungtraloi" rows="3" cols="50" style="border-radius: 12px; border: none;" required maxlength="200" oninput="updateRemainingCharacters()"></textarea><br>
                                                    <p style="position: absolute; bottom: -15px; left: 5px;" id="remainingCharacters">0/200</p>
                                                </div>



                                                <br>
                                                <input class="btn btn-primary" type="submit" value="Gửi trả lời" onclick="replyToComment(this)">
                                            </form>
                                        </div>
                                    </div>


                                </div>

                        <?php }
                        } else {
                            echo "<h4 class='text-center'>chưa có đánh giá nào</h4>";
                        } ?>








                        <br><br>
                        <div class="row d-flex justify-content-center danhgia">
                            <div class="row col-md-12 mt-3">
                                <h4 class="mt-2 namefood text-center"><b>Phản hồi món
                                        ăn</b></h4>
                            </div>
                            <div onclick="myHide()" style="position: absolute; top: 10px; left: 10px; font-size: 24px; display: flex; align-items: center;">

                                <i class="fa-solid fa-angles-right text-danger"></i>
                                <span class="text-danger ml-1" style="font-size: 12px; cursor: pointer;"><b>tắt phản hồi</b></span>

                            </div>
                            <?php
                            $check = false;
                            if (isset($order)) {
                                foreach ($order as $or) {
                                    if ($or['idMonAn'] == $_GET['idMonAn']) {
                                        $check = true;
                                    }
                                }
                            } ?>
                            <?php if ($check == true) { ?>
                                <button type="button" class="btn btn-primary m-3" data-bs-target="#frm" data-bs-toggle="modal">Viết
                                    đánh giá</button>
                            <?php } ?>
                        </div>

                    </div>




                </div>
            </div>
            </div>

            <!-- modal đánh gía món -->
            <div class="modal" id="frm" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Đánh giá món ăn</h5>
                            <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row d-flex justify-content-center">
                                        <img src="./assets/imageDish/<?php echo $monan['hinhAnhMon'] ?>" alt="" style="width: 160px; height: 160px; border-radius: 50%;">
                                    </div>
                                    <div class="row text-center m-3">
                                        <h5 style="margin-left: auto; margin-right: auto;"><b><?php echo $monan['tenMon'] ?></b></h5>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <form id="selectRating" method="post" action="index.php?mod=Dish&act=PhanHoi&idMonAn=<?php echo $_GET['idMonAn'] ?>&date=<?php echo  $_GET['date'] ?>" onsubmit="return validateForm()">
                                        <label for="rating">Đánh giá món ăn:</label>
                                        <div id="rating" class="rating"><br>

                                            <input type="radio" name="rating" id="star5" value="5" />
                                            <label for="star5" class="star" data-value="5">
                                                <div class="stas"><span class="sta text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Xuất
                                                    sắc)
                                                </div>
                                            </label><br>
                                            <input type="radio" name="rating" id="star4" value="4" />
                                            <label for="star4" class="star" data-value="4">
                                                <div class="stas"><span class="sta text-warning">&#9733;&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Tốt)
                                                </div>
                                            </label><br>
                                            <input type="radio" name="rating" id="star3" value="3" />
                                            <label for="star3" class="star" data-value="3">
                                                <div class="stas "><span class="sta text-warning">&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Tạm
                                                    được)</div>
                                            </label><br>
                                            <input type="radio" name="rating" id="star2" value="2" />
                                            <label for="star2" class="star" data-value="2">
                                                <div class="stas "><span class="sta text-warning">&#9733;&#9733;</span>&nbsp;&nbsp;(Tệ)</div>
                                            </label><br>
                                            <input type="radio" name="rating" id="star1" value="1" />
                                            <label for="star1" class="star" data-value="1">
                                                <div class="stas "><span class="sta text-warning">&#9733;</span>&nbsp;&nbsp;(Rất
                                                    tệ)</div>
                                            </label>
                                        </div>

                                </div>
                            </div>

                            <div class="feedback">

                                <div class="form-group mt-2">
                                    <label for="" class="col-9 text-left mb-1">Nội dung đánh giá:</label>
                                    <div class="col-12" style="height: 130px; border: 1px solid #00c; border-radius:10px ; position: relative;">
                                        <textarea rows="4" cols="50" name="noidungphanhoi" id="noidungphanhoi" placeholder="Mời bạn chia sẻ thêm cảm nhận..." style="border-radius: 12px; border: none;" maxlength="200" oninput="updateRemaining()"></textarea><br>
                                        <p style="position: absolute; bottom: -15px;" id="remaining">0/200</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="row d-flex justify-content-center">
                                <input type="submit" name="btn_sub" class="btn btn-primary" value="Gửi">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>



            <script>
                function showReplyForm(button) {

                    var container = button.closest('.comment');

                    var replyForm = container.querySelector('.reply-form');
                    replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
                }
            </script>

            <script>
                function updateRemainingCharacters() {
                    const textarea = document.getElementById('noidungtraloi');
                    const remainingCharactersDisplay = document.getElementById('remainingCharacters');

                    const maxLength = parseInt(textarea.getAttribute('maxlength'));
                    const currentLength = textarea.value.length;

                    // Hiển thị số ký tự còn lại dưới dạng "0/200"
                    const remainingCharacters = Math.max(0, maxLength - currentLength);
                    remainingCharactersDisplay.textContent = `${currentLength}/${maxLength}`;

                    // Thêm màu sắc cho thông báo dựa trên giá trị remainingCharacters
                    remainingCharactersDisplay.style.color = remainingCharacters < 0 ? 'red' : 'black';
                }

                function updateRemaining() {
                    const textarea = document.getElementById('noidungphanhoi');
                    const remainingCharactersDisplay = document.getElementById('remaining');

                    const maxLength = parseInt(textarea.getAttribute('maxlength'));
                    const currentLength = textarea.value.length;

                    // Hiển thị số ký tự còn lại dưới dạng "0/200"
                    const remainingCharacters = Math.max(0, maxLength - currentLength);
                    remainingCharactersDisplay.textContent = `${currentLength}/${maxLength}`;

                    // Thêm màu sắc cho thông báo dựa trên giá trị remainingCharacters
                    remainingCharactersDisplay.style.color = remainingCharacters < 0 ? 'red' : 'black';
                }
            </script>

            <script>
                function validateForm() {
                    var ratingRadios = document.getElementsByName('rating');
                    var ratingChecked = false;

                    // Check if at least one radio button is checked
                    for (var i = 0; i < ratingRadios.length; i++) {
                        if (ratingRadios[i].checked) {
                            ratingChecked = true;
                            break;
                        }
                    }

                    // Check if the text area is not empty
                    var noidungphanhoi = document.getElementById('noidungphanhoi').value.trim();
                    var noidungValid = noidungphanhoi !== '';

                    // Display error message if necessary
                    if (!ratingChecked && !noidungValid) {
                        alert('Hãy chọn ít nhất một đánh giá hoặc nhập nội dung đánh giá.');
                        return false;
                    }

                    return true; // Allow form submission
                }
            </script>




</main>