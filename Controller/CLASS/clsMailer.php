<?php 

	//include_once("Model/DonHang/mHoaDon.php");
	require "admin/assets/vendor/PHPMailer-6.2.0/src/PHPMailer.php";
	require "admin/assets/vendor/PHPMailer-6.2.0/src/Exception.php";
	require "admin/assets/vendor/PHPMailer-6.2.0/src/OAuth.php";
	require "admin/assets/vendor/PHPMailer-6.2.0/src/POP3.php";
	require "admin/assets/vendor/PHPMailer-6.2.0/src/SMTP.php";
	class cPHPMailer{
		// -----------------
		// -----------------
		// -----------------
		// ----SEND EMAIL PHPMAILER 
		// ----Gửi mail đặt hàng nông sản 
		// -----------------
		// -----------------
		public function send_mail($hoTen,$email,$username,$password,$hinhAnh,$Role,$gioiTinh,$soDienThoai){
			

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
			    $mail->Username = 'duc200251@gmail.com';                 // SMTP username
			    $mail->Password = 'modg eujh kxvx yegb';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;                                    // TCP port to connect to
			 
			    //Recipients
			    $mail->setFrom('duc200251@gmail.com', 'CHILDCARE');
			    $mail->addAddress($email, $hoTen);     // Add a recipient
			    
				$noidung = "
				<div style='background-color: #f9f9f9; border: 1px solid #ddd; padding: 20px; border-radius: 10px; position: relative;'>
					<div style='position: absolute; top: 0; left: 0; border-radius: 50%;'>
					<img src='./img/childcare.png' alt='Logo' style='width: 60px; height: auto; margin-right: 10px;'>	
					<img src='admin/admin/assets/uploads/images/440943120_2188963681457292_7383826080244805221_n.jpg' alt='Logo' style='width: 100px; height: auto;'>
					</div>
					
					<h3 style='text-align: center; margin-bottom: 10px;'>Thông tin tài khoản CHILDCARE</h3>
					<hr style='border-color: #ddd;'>
					<table style='width: 100%;'>
						<tr>
							<td style='font-weight: bold; width: 30%;'>Tài khoản:</td>
							<td style='font-weight: bold; color: blue;'>".$username."</td>
						</tr>
						<tr>
							<td style='font-weight: bold;'>Mật Khẩu:</td>
							<td style='font-weight: bold; color: blue;'>".$password."</td>
						</tr>
						
					</table>
				</div>";
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = "Thông tin tài khoản của bạn ";
			    $mail->Body    = $noidung; 
			    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			 
			    $mail->send();
			    echo "<div class='alert alert-success'>
                                 Đã gửi phản hồi người dùng!<button type='button' name='alert' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
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
			    $mail->Username = 'nongsanviet8899@gmail.com';                 // SMTP username
			    $mail->Password = 'vyycplhrmobivrfb';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;                                    // TCP port to connect to
			 
			    //Recipients
			    $mail->setFrom('nongsanviet8899@gmail.com', 'Hệ thống phân phối nông sản');
			    $mail->addAddress('nongsanviet8899@gmail.com', 'Hệ thống phân phối nông sản');     // Add a recipient
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
	}


 ?>