<?php 

	//include_once("Model/DonHang/mHoaDon.php");
	require "assets/vendor/PHPMailer-6.2.0/src/PHPMailer.php";
	require "assets/vendor/PHPMailer-6.2.0/src/Exception.php";
	require "assets/vendor/PHPMailer-6.2.0/src/OAuth.php";
	require "assets/vendor/PHPMailer-6.2.0/src/POP3.php";
	require "assets/vendor/PHPMailer-6.2.0/src/SMTP.php";
	class cPHPMailer{
		// -----------------
		// -----------------
		// -----------------
		// ----SEND EMAIL PHPMAILER 
		// ----Gửi mail đặt hàng nông sản 
		// -----------------
		// -----------------
		public function send_mail($to,$name,$subject,$body){
			

			// use PHPMailer\PHPMailer\PHPMailer;
			// use PHPMailer\PHPMailer\Exception;
			$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			//$mail = new PHPMailer(true);                        
			//print_r($mail);
			try {
			    //Server settings
			    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
			    $mail->isSMTP();
			    $mail->CharSet  = "utf-8";                                      // Set mailer to use SMTP
			    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'xuanhauk16@gmail.com';                 // SMTP username
			    $mail->Password = 'tppkrcmajdtzxafd';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;                                    // TCP port to connect to
			 
			    //Recipients
			    $mail->setFrom('xuanhauk16@gmail.com', 'Hệ thống phân phối nông sản');
			    $mail->addAddress($to, $name);     // Add a recipient
			    //$mail->addAddress('ellen@example.com');               // Name is optional
			    //$mail->addReplyTo('info@example.com', 'Information');
			    //$mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');
			 
			    //Attachments
			    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			 
			    //Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = $subject;
			    $mail->Body    = $body;
			    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			 
			    $mail->send();
			    echo "<div class='alert alert-success'>
                                   Đã gửi email thành công đến nhà cung cấp - ".$to." !!<button type='button' name='alert' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                             </div>";
			} catch (Exception $e) {
			    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}
		}
		// -----------------
		// -----------------
		// -----------------
		// ----SEND EMAIL PHPMAILER
		// ----Gửi mail chức năng liên hệ
		// -----------------
		// -----------------
		public function send_mail_lienhe($email,$sdt,$name,$tendn,$subject,$body){
			

			// use PHPMailer\PHPMailer\PHPMailer;
			// use PHPMailer\PHPMailer\Exception;
			$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			//$mail = new PHPMailer(true);                        
			//print_r($mail);
			try {
			    //Server settings
			    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
			    $mail->isSMTP();
			    $mail->CharSet  = "utf-8";                                      // Set mailer to use SMTP
			    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'xuanhauk16@gmail.com';                 // SMTP username
			    $mail->Password = 'tppkrcmajdtzxafd';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;                                    // TCP port to connect to
			 
			    //Recipients
			    $mail->setFrom('xuanhauk16@gmail.com', 'Hệ thống phân phối nông sản');
			    $mail->addAddress('xuanhauk16@gmail.com', 'Hệ thống phân phối nông sản');     // Add a recipient
			    //$mail->addAddress('ellen@example.com');               // Name is optional
			    //$mail->addReplyTo('info@example.com', 'Information');
			    //$mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');
			 
			    //Attachments
			    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			 
			    //Content
			    $noidung = "<div>
                	<h5>
                		This Message has been posted on your website!<hr>
                		Họ và tên: ".$name." <br>
                		Số điện thoại: ".$sdt." <br>
                		Email: ".$email." <br>
                		Tên doanh nghiệp (nếu có): ".$tendn." <br>
                		Nội dung: ".$body."
                	</h5>
                </div>";
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = $subject;
			    $mail->Body    = $noidung; 
			    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			 
			    $mail->send();
			    echo "<div class='alert alert-success'>
                                   Xin cảm ơn! Chúng tôi sẽ phản hồi trong thời gian sớm nhất!<button type='button' name='alert' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                             </div>";
			} catch (Exception $e) {
			    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}
		}
		// -----------------
		// -----------------
		// -----------------
		// ----SEND EMAIL PHPMAILER
		// ----GỬI MAIL CHỨC NĂNG GỬI YÊU CẦU KIỂM ĐỊNH
		// -----------------
		// -----------------
		public function send_mail_kiemdinh($to){
			

			// use PHPMailer\PHPMailer\PHPMailer;
			// use PHPMailer\PHPMailer\Exception;
			$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			//$mail = new PHPMailer(true);                        
			//print_r($mail);
			try {
			    //Server settings
			    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
			    $mail->isSMTP();
			    $mail->CharSet  = "utf-8";                                      // Set mailer to use SMTP
			    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'xuanhauk16@gmail.com';                 // SMTP username
			    $mail->Password = 'tppkrcmajdtzxafd';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;                                    // TCP port to connect to
			 
			    //Recipients
			    $mail->setFrom('xuanhauk16@gmail.com', 'Hệ thống phân phối nông sản');
			    $mail->addAddress($to, "Nhân viên kiểm định");     // Add a recipient
			    //$mail->addAddress('ellen@example.com');               // Name is optional
			    //$mail->addReplyTo('info@example.com', 'Information');
			    //$mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');
			 
			    //Attachments
			    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			 
			    //Content
			    $subject = "Thông báo mới";
			    $body = "Bạn vừa nhận một yêu cầu kiểm định từ người nông dân. Hãy mở website để kiểm tra!<br>";
			    $body .= "http://localhost/NongSan2023/kiem-dinh-nong-san";
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = $subject;
			    $mail->Body    = $body;
			    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			 
			    $mail->send();
			    // echo "<div class='alert alert-success'>
       //                             Đã gửi email thành công đến nhà cung cấp - ".$to." !!<button type='button' name='alert' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
       //                       </div>";
			} catch (Exception $e) {
			    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}
		}
		
	}


 ?>