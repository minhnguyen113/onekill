<?php

include_once("Controller/cDish.php");
include_once("lib/price.php");

$p = new controlDish();

$list_loai  = $p->getAllLoaiMonAn();

if (isset($_REQUEST['idLoai'])) {
  $id = $_REQUEST['idLoai'];
  $list_user = $p->getAllDishByIdLoai($id);
} elseif (isset($_REQUEST['search'])) {
  $search = $_REQUEST['search'];
  $list_user = $p->DishSearch($search);
} else {
  $list_user = $p->getAllDish();
}



?>





<main>

  <?php
  if (isset($_GET['main']) || isset($_REQUEST['search'])) {
    $a = true;
  } else {
  ?>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home" style="background-image: url('./assets/images/hero-bg.jpg')">
        <div class="container">

          <div class="hero-content">

            <p class="hero-subtitle">Xin chào bạn ! </p>

            <h2 class="h1 hero-title">"Mang ẩm thực tới trái tim của bạn!"</h2>


          </div>

          <figure style="margin: 0px 100px 200px" class="hero-banner">
            <img src="./assets/images/food-menu-3.png" width="820" height="716" alt="" aria-hidden="true" class="w-100 hero-img-bg">


          </figure>

        </div>
      </section>



      <section class="section section-divider gray about" id="about">
        <div class="container">

          <div class="about-banner">
            <img src="./assets/images/food-menu-5.png" width="509" height="459" loading="lazy" alt="Burger with Drinks" class="w-100 about-img">


          </div>

          <div class="about-content">

            <h2 class="h2 section-title">
              Bếp ăn tập đoàn
              <span class="span">ONEKILL !</span>
            </h2>

            <p class="section-text">
              Bếp ăn của công ty chúng tôi là nơi sản xuất những món ăn ngon và đa dạng cho đội ngũ nhân viên.
              Với đội ngũ đầu bếp chuyên nghiệp và thiết bị hiện đại,
              chúng tôi cam kết đem đến trải nghiệm ẩm thực tốt nhất cho mọi người.
            </p>

            <ul class="about-list">
              <li class="about-item">
                <ion-icon name="checkmark-outline"></ion-icon>

                <span class="span">Chất lượng vệ sinh an toàn thực phẩm</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-outline"></ion-icon>

                <span class="span">Đội ngũ đầu bếp và nhân viên chuyên nghiệp</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-outline"></ion-icon>

                <span class="span">Giá cả hợp lý</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-outline"></ion-icon>

                <span class="span">Phản hồi, ghi nhận và cam kết về sự hài lòng của nhân viên</span>
              </li>

            </ul>

          </div>

        </div>
      </section>
    <?php }  ?>





    <!-- 
        - #FOOD MENU
      -->

    <section class="section food-menu" id="food-menu">
      <div class="container">

        <p class="section-subtitle">MÓN ĂN</p>

        <h2 class="h2 section-title">
          Our Delicious <span class="span">Foods</span>
        </h2>

        <p class="section-text">
          "Chúng tôi tin rằng mỗi bữa ăn là một cách đặc biệt để chia sẻ yêu thương và kỷ niệm với những người thân
          yêu của bạn."
        </p>

        <ul class="fiter-list">


          <button class="filter-btn  active"><a href="index.php?main=find">Tất cả món ăn</a></button>
          <?php foreach ($list_loai as $item) { ?>
            <li>
              <button class="filter-btn  active"><a href="index.php?main=find&idLoai=<?php echo $item['idLoaiMon'] ?>"><?php echo $item['tenLoai'] ?></a></button>
            </li>
          <?php } ?>


        </ul>

        <ul class="food-menu-list">
          <?php if ($list_user) {
            foreach ($list_user as $item) { ?>
              <li>
                <a href="#">
                  <div class="food-menu-card">

                    <div class="card-banner">
                      <img src="./assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" width="300" height="300" loading="lazy" alt="Fried Chicken Unlimited" class="w-100">

                      <button class="btn food-menu-btn">Xem</button>
                    </div>
                    <h3 class="card-title"><?php echo $item['tenMon'] ?></h3>

                    <div class="price-wrapper">

                      <p class="price-text">Giá: <?php echo currency_format($item['gia']) ?>
                       
                      </p>




                    </div>

                  </div>
                </a>
              </li>
          <?php }
          } ?>

        </ul>


      </div>
    </section>







    <section class="section section-divider white cta" style="background-image: url('./assets/images/hero-bg.jpg')">
      <div class="container">

        <div class="cta-content">

          <h2 class="h2 section-title">
            <span class="span">"Chia sẻ yêu thương qua hương vị đặc biệt."</span>
          </h2>

          <p class="section-text">
            Mỗi bữa ăn tại đây không chỉ đáp ứng nhu cầu về dinh dưỡng,
            mà còn là một cảm xúc, một kỷ niệm đẹp trong cuộc sống của bạn. Chúng tôi muốn mang đến sự ấm áp,
            niềm hạnh phúc cho bạn
          </p>

        </div>

        <figure style="width: 300px; margin-bottom: 100px;" class="cta-banner">
          <img src="./assets/images/food-menu-5.png" width="700" height="637" loading="lazy" alt="Burger" class="w-100 cta-img">
        </figure>

      </div>
    </section>





    <!-- 
        - #DELIVERY
      -->

    <section class="section section-divider gray delivery">
      <div class="container">

        <div class="delivery-content">

          <h2 class="h2 section-title">
            <span class="span">"Như một cuộc hành trình, chúng tôi
              luôn chuyển động để đưa đến bạn những hương vị tươi ngon nhất."</span>
          </h2>

          <p class="section-text">

            "Bếp ăn lúc nào cũng tràn đầy năng lượng và động lực.
            Chúng tôi không chỉ nấu ăn, chúng tôi tạo nên những trải nghiệm ẩm thực đầy sáng tạo và độc đáo.
            Hãy đến và cùng chúng tôi khám phá những hương vị độc đáo trong mỗi bữa ăn,
            như một chuyến hành trình đầy phấn khích trên chiếc xe đạp của ẩm thực."
          </p>


        </div>

        <figure class="delivery-banner">
          <img src="./assets/images/delivery-banner-bg.png" width="700" height="602" loading="lazy" alt="clouds" class="w-100">

          <img src="./assets/images/delivery-boy.svg" width="1000" height="880" loading="lazy" alt="delivery boy" class="w-100 delivery-img" data-delivery-boy>
        </figure>

      </div>
    </section>





   















    </article>
</main>