<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
// Passing `true` enables exceptions 
try {
    //Server settings
    $mail->SMTPDebug = 0;                           //Enable verbose debug output

    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->CharSet = "utf-8"; // set charset to utf8
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->Port = 587; // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username   = 'minhhuan190102@gmail.com';                     //SMTP username
    $mail->Password   = 'vcho tlpc agae yome';                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('minhhuan190102@gmail.com', 'ONEKILL');
    $mail->addAddress("$email", "$hoTen");     //Add a recipient // người nhận
    //   $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('minhhuan190102@gmail.com', 'ONEKILL');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //  $mail->addAttachment('Huan.jpg');         //Add attachments
    //  $mail->addAttachment('Huan.jpg', 'new.jpg');    //Optional name

    //Content
    

    if($Role==1){
        $chucvu = 'Quản lý bếp';
    } elseif($Role==2){
        $chucvu = 'Nhân viên bếp';
    }elseif($Role ==3){
        $chucvu = 'Nhân viên phục vụ';
    }elseif($Role ==4){
        $chucvu = 'Nhân viên công ty';
    } else {
        $chucvu = 'Bạn chưa có chức vụ';

    }
  
    $html = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Example Email</title>
        <style>

            body {
                font-family: Arial, sans-serif;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: rgb(241, 205, 134);
            }
            p {
                font-size: 16px;
                font-weight: 700;
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            h1 {
                color :red;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
            <h2>Xin chào, $hoTen !</h2>
                <h1>Đây là thông tin của bạn</h1>
            </div>
            <div class='content'>
            <p>Họ tên : $hoTen</p>
            <p>Tên đăng nhập:     $tenDangNhap</p>
            <p>Mật khẩu: $matKhau</p>
            <p>Mã nhân viên : $maNhanVien</p>
            <p>Số điện thoại:  $soDienThoai</p>
            <p>Email:  $email</p>
            <p>Chức vụ:  $chucvu</p>
                
            </div>
        </div>
    </body>
    </html>
    ";

    $mail->isHTML(true);
    $mail->Subject = "Xin chào $hoTen !";
    $mail->Body = $html;

    $mail->send();
    echo '<script>alert("Thông tin đã được gửi về email")</script>';

} catch (Exception $e) {
    echo "Email không được gửi. Chi tiết lỗi: {$mail->ErrorInfo}";
}
