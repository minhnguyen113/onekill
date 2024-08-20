<?php
include_once("Controller/cDish.php");
include_once("lib/price.php");
$p = new controlDish();

$idMonAn = $_GET['idMonAn'];
$monan =$p->getLoaiMonAnById($idMonAn);


$_SESSION['$idMonAn']= $idMonAn;



?>
<section class="product-details spad  product_bep">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="./assets/imageDish/<?php echo $monan['hinhAnhMon'] ?>" alt="">
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
                            <span>(18 nhận xét)</span>
                        </div>
                        <div class="product__details__price"><?php echo currency_format( $monan['gia']) ?><sup>đ</sup></div>
                        <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam
                            vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet
                            quam vehicula elementum sed sit amet dui. Proin eget tortor risus.</p>
                        
                        <a href="#" class="primary-btn">Đặt món</a>
                        <a href="#" class="heart-icon"><i class="fa-solid fa-cart-plus"></i></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                        
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả tóm tắt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Mô tả chi tiết</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Đánh giá<span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả tóm tắt</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                        suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                        vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                        accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                        pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                        elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                        et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                        vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                        <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                        porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                        sed sit amet dui. Proin eget tortor risus.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả chi tiết</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="feedback ">
                                    <h2>Phản hồi món ăn</h2>

                                    <div class="comments">
                                        <form id="commentForm" method="get" action="#">
                                            <label for="name">Tên đánh giá:</label>
                                            <input type="text" id="name" value="Huân" placeholder="Tên đánh giá..." required><br><br>

                                            <label for="comment">Nội dung đánh giá:</label>
                                            <textarea id="comment" rows="4" cols="150" placeholder="Nội dung..."></textarea><br><br><br>

                                            <label for="rating">Đánh giá món ăn:</label>
                                            <div id="rating" class="rating"><br>

                                                <input type="radio" name="rating" id="star5" value="5" />
                                                <label for="star5" class="star" data-value="5">
                                                    <div class="stas"><span class="sta">&#9733;&#9733;&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Xuất sắc)</div>
                                                </label><br>
                                                <input type="radio" name="rating" id="star4" value="4" />
                                                <label for="star4" class="star" data-value="4">
                                                    <div class="stas"><span class="sta">&#9733;&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Tốt)</div>
                                                </label><br>
                                                <input type="radio" name="rating" id="star3" value="3" />
                                                <label for="star3" class="star" data-value="3">
                                                    <div class="stas"><span class="sta">&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Tạm được)</div>
                                                </label><br>
                                                <input type="radio" name="rating" id="star2" value="2" />
                                                <label for="star2" class="star" data-value="2">
                                                    <div class="stas"><span class="sta">&#9733;&#9733;</span>&nbsp;&nbsp;(Tệ)</div>
                                                </label><br>
                                                <input type="radio" name="rating" id="star1" value="1" />
                                                <label for="star1" class="star" data-value="1">
                                                    <div class="stas"><span class="sta">&#9733;</span>&nbsp;&nbsp;(Rất tệ)</div>
                                                </label>
                                            </div><br><br>

                                            <input type="submit" name="btn_sub" value="Gửi">
                                        </form>
                                    </div>
                                </div>

                                <div id="commentsList">
                                    <h4 style="text-align: center;">Đánh giá và bình luận</h4>
                                    <div class="comment">
                                        <img class="avatar" src="avatar.png" alt="Avatar">
                                        <div class="content"><span class="name">Huân</span>
                                            <span class="date">14:49:12 21/10/2023</span>
                                            <p class="message">ww</p>
                                            <button class="reply-button" onclick="showReplyForm(this)">Trả lời</button>
                                            <div class="rating">
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                            </div>
                                            <div class="replies">
                                                <div class="comment reply">
                                                    <img class="avatar" src="avatar.png" alt="Avatar">
                                                    <div class="content">
                                                        <span class="name">Bạn</span>
                                                        <span class="date">14:49:18 21/10/2023</span>
                                                        <p class="message">qqq</p>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            

                                            
                                            <div class="reply-form" style="display: none;">
                                                <label for="reply">Trả lời:</label>
                                                <br>
                                                <textarea class="reply-input" rows="4" cols="50"></textarea>
                                                <br><br>
                                                <input type="button" value="Gửi trả lời" onclick="replyToComment(this)">
                                            </div>
                                        </div>
                                    </div>
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
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>