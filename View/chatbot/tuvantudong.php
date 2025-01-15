<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

include('Controller/cTuvanTudong.php');
// session_start();
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
} else {
	$username = null;
}
$tuvan = new cTuvanTudong();
$res1 = $tuvan->select_message($username);
?>
<style>
	body {
		background-color: #f8f9fa;
		font-family: Arial, sans-serif;
	}

	.messages-box {
		max-height: 400px;
		overflow-y: auto;
		background-color: #fff;
		border: 1px solid #dee2e6;
		border-radius: 5px;
		padding: 10px;
	}

	.message-img {
		width: 40px;
		height: 40px;
		overflow: hidden;
		border-radius: 50%;
	}

	.message-img img {
		width: 40px;
		height: 40px;
		float: right;
	}

	.message-body {
		margin-left: 10px;
	}

	/* Tin nhắn của user */
	.messages-me .message-body {
		margin-left: auto;
		margin-right: 10px;
		/* Đặt margin-right để tin nhắn của user nằm bên phải */
		background-color: #70D6F5;
		padding: 10px;
		border-radius: 10px;
		float: right;
	}

	/* Tin nhắn của bot */
	.messages-you .message-body {
		margin-left: 10px;
		/* Đặt margin-left để tin nhắn của bot nằm bên trái */
		background-color: #F8FAFA;
		/* Đặt màu nền cho tin nhắn của bot */
		padding: 10px;
		border-radius: 10px;
		float: left;
	}

	/* Hình ảnh của tin nhắn của bot */
	.messages-you .message-img {
		float: left;
		/* Đảm bảo hình ảnh nằm bên trái của tin nhắn của bot */
		margin-right: 10px;
		/* Tạo khoảng cách giữa hình ảnh và nội dung tin nhắn */
	}

	/* Thẻ input cho việc nhập tin nhắn */
	.input-group {
		margin-bottom: 20px;
	}

	/* Nút gửi tin nhắn */
	.input-group-append button {
		border-radius: 0 5px 5px 0;
		/* Định dạng góc của nút gửi tin nhắn */
	}
</style>
</head>

<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body messages-box">
						<ul class="list-unstyled messages-list">
							<?php
							$class = '';
							// $class = ($type == 'user') ? 'messages-me' : 'messages-you'; // Xác định lớp CSS cho tin nhắn
							if (isset($type)) {
								$class = ($type == 'user') ? 'messages-me' : 'messages-you'; // Xác định lớp CSS cho tin nhắn nếu $type tồn tại
							} else {
								$class = 'default-class'; // Gán một lớp CSS mặc định
							}
							$html = '';
							if (mysqli_num_rows($res1) > 0) {
								while ($row = mysqli_fetch_assoc($res1)) {
									$noiDung = $row['noiDung'];
									$added_on = $row['added_on'];
									$strtotime = strtotime($added_on);
									$time = date('h:i A', $strtotime);
									$type = $row['type'];
									if ($type == 'user') {
										$class = "messages-me";
										$imgAvatar = "user_avatar.png";
										$name = "Tôi";
									} else {
										$class = "messages-you";
										$imgAvatar = "bot_avatar.png";
										$name = "Chatbot";
									}
									// $html .= '<li class="' . $class . ' clearfix"><span class="message-img"><img style="width: 50px; height: 50px; src="img/' . $imgAvatar . '" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">' . $name . '</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' . $time . '</span></small> </div><p class="messages-p">' . $noiDung . '</p></div></li>';
									$html .= '<li class="' . $class . ' clearfix">';
									$html .= '<span class="message-img"><img style="width: 50px; height: 50px;" src="img/' . $imgAvatar . '" class="avatar-sm rounded-circle"></span>';
									$html .= '<div class="message-body clearfix">';
									$html .= '<div class="message-header"><strong class="messages-title">' . $name . '</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' . $time . '</span></small> </div>';
									$html .= '<p class="messages-p">' . $noiDung . '</p>';
									$html .= '</div></li>';
								}
								echo $html;
							} else {
							?>
								<li " class=" messages-me clearfix start_chat">
									Hãy bắt đầu
								</li>
							<?php
							}
							?>
						</ul>
					</div>
					<div class="card-footer">
						<div class="input-group">
							<input id="input-me" type="text" name="noiDung" class="form-control" placeholder="Hãy nhập tin nhắn ở đây..." onkeydown="if (event.keyCode == 13) send_msg()">
							<div class="input-group-append">
								<button class="btn btn-primary" type="button" onclick="send_msg()">Send</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script>
		// Function to get current time
		function getCurrentTime() {
			var now = new Date();
			var hh = now.getHours();
			var min = now.getMinutes();
			var ampm = (hh >= 12) ? 'PM' : 'AM';
			hh = hh % 12;
			hh = hh ? hh : 12;
			hh = hh < 10 ? '0' + hh : hh;
			min = min < 10 ? '0' + min : min;
			var time = hh + ":" + min + " " + ampm;
			return time;
		}

		function convert_vi_to_en(str) {
			str = str.toLowerCase();
			str = str.replace(/á|à|ạ|ả|ã|â|ấ|ầ|ậ|ẩ|ẫ|ă|ắ|ằ|ặ|ẳ|ẵ/g, "a");
			str = str.replace(/é|è|ẹ|ẻ|ẽ|ê|ế|ề|ệ|ể|ễ/g, "e");
			str = str.replace(/í|ì|ị|ỉ|ĩ/g, "i");
			str = str.replace(/ó|ò|ọ|ỏ|õ|ô|ố|ồ|ộ|ổ|ỗ|ơ|ớ|ờ|ợ|ở|ỡ/g, "o");
			str = str.replace(/ú|ù|ụ|ủ|ũ|ư|ứ|ừ|ự|ử|ữ/g, "u");
			str = str.replace(/ý|ỳ|ỵ|ỷ|ỹ/g, "y");
			str = str.replace(/đ/g, "d");
			return str;
		}

		// Function to send message
		function send_msg() {
			$('.start_chat').hide();
			var txt = $('#input-me').val();
			var normalized_txt = convert_vi_to_en(txt);
			var html = '<li class="messages-me clearfix"><span class="message-img"><img src="img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + txt + '</p></div></li>';
			$('.messages-list').append(html);
			$('#input-me').val('');
			if (txt) {
				$.ajax({
					url: 'get_bot_message.php',
					type: 'post',
					data: 'txt=' + normalized_txt,
					success: function(result) {
						var html = '<li class="messages-you clearfix"><span class="message-img"><img src="img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + result + '</p></div></li>';
						$('.messages-list').append(html);
						$('.messages-box').scrollTop($('.messages-box')[0].scrollHeight);
					}

				});
			}
		}
	</script>
</body>