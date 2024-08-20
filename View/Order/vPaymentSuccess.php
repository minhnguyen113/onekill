<?php

include_once("Controller/cOrder.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlOrder();
$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];


$idThanhToan = $_SESSION['maDon'];
$ngayThanhToan = date('Y-m-d H:i:s');
$soTien =  $_SESSION['soTien'];
$hinhThucThanhToan = $_GET['payType'];

$dish = array();
$dish = $_SESSION['dish'];



$p->InsertThanhToan($idThanhToan, $ngayThanhToan, $soTien, $idTaiKhoan, $hinhThucThanhToan);
$p->InsertChiTietThanhToan($dish, $idThanhToan);
$pay = $p->PaymentSuccess($idTaiKhoan);
if ($pay == 1) {
    $tien = currency_format($soTien);
    $noiDung = "Bạn đã thanh toán món ăn với số tiền $tien";
    $thoiGian =  date('Y-m-d H:i:s');
    $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
    echo header("refresh: 1; url='index.php?mod=Order&act=ListOrderUser'");
} else {
    echo '<script>alert("Thanh toán lỗi")</script>';
    echo header("refresh: 0; url='index.php?mod=Order&act=ListOrderUser'");
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh toán thành công</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #ecf0f1;
    }

    .success-container {
      position: relative;
      background-color: rgb(2, 212, 128);
      color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 50%;
      text-align: center;
      overflow: hidden;
    }

    #firework {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }

    #moneyAmount {
      font-size: 24px;
      margin-top: 20px;
      color: #fff;
      font-weight: bold;
    }
    .pyro > .before, .pyro > .after {
  position: absolute;
  width: 7px;
  height: 7px;
  pointer-events: none;
  z-index: 99999999;
  border-radius: 50%;
  box-shadow: -120px -218.66667px blue, 248px -16.66667px #00ff84, 190px 16.33333px #002bff, -113px -308.66667px #ff009d, -109px -287.66667px #ffb300, -50px -313.66667px #ff006e, 226px -31.66667px #ff4000, 180px -351.66667px #ff00d0, -12px -338.66667px #00f6ff, 220px -388.66667px #99ff00, -69px -27.66667px #ff0400, -111px -339.66667px #6200ff, 155px -237.66667px #00ddff, -152px -380.66667px #00ffd0, -50px -37.66667px #00ffdd, -95px -175.66667px #a6ff00, -88px 10.33333px #0d00ff, 112px -309.66667px #005eff, 69px -415.66667px #ff00a6, 168px -100.66667px #ff004c, -244px 24.33333px #ff6600, 97px -325.66667px #ff0066, -211px -182.66667px #00ffa2, 236px -126.66667px #b700ff, 140px -196.66667px #9000ff, 125px -175.66667px #00bbff, 118px -381.66667px #ff002f, 144px -111.66667px #ffae00, 36px -78.66667px #f600ff, -63px -196.66667px #c800ff, -218px -227.66667px #d4ff00, -134px -377.66667px #ea00ff, -36px -412.66667px #ff00d4, 209px -106.66667px #00fff2, 91px -278.66667px #000dff, -22px -191.66667px #9dff00, 139px -392.66667px #a6ff00, 56px -2.66667px #0099ff, -156px -276.66667px #ea00ff, -163px -233.66667px #00fffb, -238px -346.66667px #00ff73, 62px -363.66667px #0088ff, 244px -170.66667px #0062ff, 224px -142.66667px #b300ff, 141px -208.66667px #9000ff, 211px -285.66667px #ff6600, 181px -128.66667px #1e00ff, 90px -123.66667px #c800ff, 189px 70.33333px #00ffc8, -18px -383.66667px #00ff33, 100px -6.66667px #ff008c;
  -moz-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
  -webkit-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
  -o-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
  -ms-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
  animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards; }

.pyro > .after {
  -moz-animation-delay: 1.25s, 1.25s, 1.25s;
  -webkit-animation-delay: 1.25s, 1.25s, 1.25s;
  -o-animation-delay: 1.25s, 1.25s, 1.25s;
  -ms-animation-delay: 1.25s, 1.25s, 1.25s;
  animation-delay: 1.25s, 1.25s, 1.25s;
  -moz-animation-duration: 1.25s, 1.25s, 6.25s;
  -webkit-animation-duration: 1.25s, 1.25s, 6.25s;
  -o-animation-duration: 1.25s, 1.25s, 6.25s;
  -ms-animation-duration: 1.25s, 1.25s, 6.25s;
  animation-duration: 1.25s, 1.25s, 6.25s; }

@-webkit-keyframes bang {
  from {
    box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white; } }
@-moz-keyframes bang {
  from {
    box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white; } }
@-o-keyframes bang {
  from {
    box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white; } }
@-ms-keyframes bang {
  from {
    box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white; } }
@keyframes bang {
  from {
    box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white; } }
@-webkit-keyframes gravity {
  to {
    transform: translateY(200px);
    -moz-transform: translateY(200px);
    -webkit-transform: translateY(200px);
    -o-transform: translateY(200px);
    -ms-transform: translateY(200px);
    opacity: 0; } }
@-moz-keyframes gravity {
  to {
    transform: translateY(200px);
    -moz-transform: translateY(200px);
    -webkit-transform: translateY(200px);
    -o-transform: translateY(200px);
    -ms-transform: translateY(200px);
    opacity: 0; } }
@-o-keyframes gravity {
  to {
    transform: translateY(200px);
    -moz-transform: translateY(200px);
    -webkit-transform: translateY(200px);
    -o-transform: translateY(200px);
    -ms-transform: translateY(200px);
    opacity: 0; } }
@-ms-keyframes gravity {
  to {
    transform: translateY(200px);
    -moz-transform: translateY(200px);
    -webkit-transform: translateY(200px);
    -o-transform: translateY(200px);
    -ms-transform: translateY(200px);
    opacity: 0; } }
@keyframes gravity {
  to {
    transform: translateY(200px);
    -moz-transform: translateY(200px);
    -webkit-transform: translateY(200px);
    -o-transform: translateY(200px);
    -ms-transform: translateY(200px);
    opacity: 0; } }
@-webkit-keyframes position {
  0%, 19.9% {
    margin-top: 10%;
    margin-left: 40%; }

  20%, 39.9% {
    margin-top: 40%;
    margin-left: 30%; }

  40%, 59.9% {
    margin-top: 20%;
    margin-left: 70%; }

  60%, 79.9% {
    margin-top: 30%;
    margin-left: 20%; }

  80%, 99.9% {
    margin-top: 30%;
    margin-left: 80%; } }
@-moz-keyframes position {
  0%, 19.9% {
    margin-top: 10%;
    margin-left: 40%; }

  20%, 39.9% {
    margin-top: 40%;
    margin-left: 30%; }

  40%, 59.9% {
    margin-top: 20%;
    margin-left: 70%; }

  60%, 79.9% {
    margin-top: 30%;
    margin-left: 20%; }

  80%, 99.9% {
    margin-top: 30%;
    margin-left: 80%; } }
@-o-keyframes position {
  0%, 19.9% {
    margin-top: 10%;
    margin-left: 40%; }

  20%, 39.9% {
    margin-top: 40%;
    margin-left: 30%; }

  40%, 59.9% {
    margin-top: 20%;
    margin-left: 70%; }

  60%, 79.9% {
    margin-top: 30%;
    margin-left: 20%; }

  80%, 99.9% {
    margin-top: 30%;
    margin-left: 80%; } }
@-ms-keyframes position {
  0%, 19.9% {
    margin-top: 10%;
    margin-left: 40%; }

  20%, 39.9% {
    margin-top: 40%;
    margin-left: 30%; }

  40%, 59.9% {
    margin-top: 20%;
    margin-left: 70%; }

  60%, 79.9% {
    margin-top: 30%;
    margin-left: 20%; }

  80%, 99.9% {
    margin-top: 30%;
    margin-left: 80%; } }
@keyframes position {
  0%, 19.9% {
    margin-top: 10%;
    margin-left: 40%; }

  20%, 39.9% {
    margin-top: 40%;
    margin-left: 30%; }

  40%, 59.9% {
    margin-top: 20%;
    margin-left: 70%; }

  60%, 79.9% {
    margin-top: 30%;
    margin-left: 20%; }

  80%, 99.9% {
    margin-top: 30%;
    margin-left: 80%; } }
  </style>
</head>
<body>
  <div style="margin-bottom: 1000px;" class="pyro"><div class="before"></div><div class="after"></div></div>
  <div style="position: absolute; left: 100px;" class="pyro"><div class="before"></div><div class="after"></div></div>
 

  <div class="success-container">
    <h2>Thanh toán thành công!</h2>
    <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
    <p id="moneyAmount">Số tiền: <span style="color: red;"><?php  echo currency_format($soTien); ?></span></p>
  </div>

  <canvas id="firework"></canvas>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <script>
    

    const fireworkCanvas = document.getElementById('firework');
    const ctx = fireworkCanvas.getContext('2d');

    const fireworks = [];

    function Firework() {
      this.x = Math.random() * window.innerWidth;
      this.y = window.innerHeight;
      this.radius = Math.random() * 2 + 1;
      this.color = `hsl(${Math.random() * 360}, 100%, 50%)`;
      this.velocity = {
        x: Math.random() * 4 - 2,
        y: Math.random() * -15 - 5
      };
      this.gravity = 0.1;
      this.life = true;
    }

    Firework.prototype.draw = function () {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
      ctx.fillStyle = this.color;
      ctx.fill();
    };

    Firework.prototype.update = function () {
      this.x += this.velocity.x;
      this.y += this.velocity.y;
      this.velocity.y += this.gravity;

      if (this.radius > 0.2) {
        this.radius -= 0.1;
      } else {
        this.life = false;
      }
    };

    function createFireworks() {
      for (let i = 0; i < 5; i++) {
        const firework = new Firework();
        fireworks.push(firework);
      }
    }

    function animateFireworks() {
      ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);

      fireworks.forEach((firework, index) => {
        firework.draw();
        firework.update();

        if (!firework.life) {
          fireworks.splice(index, 1);
        }
      });

      requestAnimationFrame(animateFireworks);
    }

    function startFireworks() {
      anime({
        targets: '.success-container',
        translateY: [-100, 0],
        opacity: [0, 1],
        easing: 'easeOutQuad',
        duration: 800
      });

      setInterval(createFireworks, 200);
      animateFireworks();
    }

    startFireworks();


    
    
  </script>
</body>
</html>



