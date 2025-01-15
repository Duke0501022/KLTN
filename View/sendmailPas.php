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
    $mail->Username   = 'duc200251@gmail.com';                     //SMTP username
    $mail->Password   = 'modg eujh kxvx yegb';                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('duc200251@gmail.com', 'ONEKILL');
    $mail->addAddress("$email", "$hoTenSuccess");     //Add a recipient // người nhận
    //   $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('duc200251@gmail.com', 'ONEKILL');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //  $mail->addAttachment('Huan.jpg');         //Add attachments
    //  $mail->addAttachment('Huan.jpg', 'new.jpg');    //Optional name

    //Content
    

  
  
    $html = "
  <!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Example Email</title>
   <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            font-size: 24px;
        }

        h1 {
            color: #e74c3c;
            margin-bottom: 10px;
            font-size: 28px;
        }

        p {
            font-size: 16px;
            font-weight: 400;
            color: #555;
            line-height: 1.5;
        }

        .content {
            margin-top: 20px;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>Xin chào, $hoTenSuccess!</h2>
            <h1>Quên mật khẩu</h1>
        </div>
        <div class='content'>
            <p>Vui lòng <a href='http://localhost/Project-CNM-master/index.php?newpass&username=$username'>click vào đây</a> để tạo mật khẩu mới.</p>
        </div>
    </div>
</body>
</html>

    ";

    $mail->isHTML(true);
    $mail->Subject = "Xin chào $hoTenSuccess !";
    $mail->Body = $html;

    $mail->send();
    echo '<script>alert("Email đã được gửi,Vui lòng kiểm tra email của bạn")</script>';


} catch (Exception $e) {
    echo "Email không được gửi. Chi tiết lỗi: {$mail->ErrorInfo}";
}
