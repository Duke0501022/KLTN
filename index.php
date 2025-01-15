<?php
//session
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
//define connect
// require_once("config/config.php");
//


include_once("Controller/TaiKhoan/cTaikhoan.php");
$account = new cTaikhoan();
if (isset($_POST['username'])) {
    $us = $_POST['username'];
}
if (isset($_POST['password'])) {
    $pw = $_POST['password'];
}

if (isset($_POST['submit']) && ($_REQUEST['submit'] == 'login')) {
    $account->login($us, $pw);
}
if (isset($_REQUEST['logout'])) {
    include_once("View/logout.php");
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>CHILDCARE - Quản lý trường học chuyên biệt</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="./img/childcare.png" rel="icon">
<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<style>

        #chatbot {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            max-height: 500px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 5px 40px rgba(0, 0, 0, 0.16);
            border-radius: 18px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            background-color: #fff;
            display: flex;
            flex-direction: column;
        }
        .navbar-nav .btn-primary:first-child {
            margin-right: 10px; /* Adds 10 pixels of space to the right of the first button */
        }

        .navbar-brand, .nav-link {
            font-family: 'Nunito', sans-serif;
        }
        #chatbot-header {
            background-color: #4CAF50; /* Màu xanh lá */
            color: #fff; /* Màu chữ trắng để tương phản với nền xanh */
            padding: 15px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border-radius: 18px 18px 0 0;
        }

        #chatbot-header i {
            font-size: 24px;
            margin-right: 10px;
        }

        #chatbot-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 500;
        }

        #chatbot-body {
            display: none;
            flex: 1;
            flex-direction: column;
            max-height: 400px;
            transition: max-height 0.3s ease;
        }

        #chatbot-body.active {
            display: flex;
        }

        #chatbot-messages {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: #f7f7f7;
        }

        #chatbot-input-container {
            display: flex;
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #e0e0e0;
        }

        #chatbot-input-container input {
            flex: 1;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            margin-right: 10px;
            font-size: 14px;
        }

        #chatbot-input-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        #chatbot-input-container button:hover {
            background-color: #0056b3;
        }

        .user-message, .bot-message {
            max-width: 80%;
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.4;
        }

        .user-message {
            align-self: flex-end;
            background-color: #007bff;
            color: #fff;
            border-bottom-right-radius: 4px;
        }
        
        .bot-message {
            align-self: flex-start;
            background-color: #e0e0e0;
            color: #333;
            border-bottom-left-radius: 4px;
        }
        #chatbot-messages {
            display: flex;
            flex-direction: column;
            /* other existing styles */
        }
        .pastel-green-icon {
            color: #78dec8; /* Pastel green color */
        }
        
        .modal-content {
            border-radius: 10px;
        }
        .navbar {
            padding: 15px 0;
        }
        
        .navbar-nav {
            align-items: center;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
        }
        
        .navbar-collapse {
            align-items: center;
        }
        .navbar-nav .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .navbar {
          border-bottom: 1px solid #e0e0e0;
        }
        .navbar-nav .nav-link:before {
            content: "";
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #007bff;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }
        
        .navbar-nav .nav-link:hover:before {
            visibility: visible;
            width: 100%;
        }
        
        .navbar-nav .nav-link.active:before {
            visibility: visible;
            width: 100%;
        }
        /* Điều chỉnh khoảng cách giữa các phần tử */
        .nav-link {
            padding: 0.5rem 1rem !important;
            display: flex;
            align-items: center;
        }

        /* Căn chỉnh icon thông báo */
        #notificationDropdown {
            display: flex;
            align-items: center;
        }

        /* Điều chỉnh badge thông báo */
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(25%, -25%);
        }
        
        /* Đảm bảo responsive */
        @media (max-width: 991.98px) {
            .navbar-nav {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .navbar-nav.ml-auto {
                margin-top: 1rem;
            }
        }

        /* Active Link Styling */
        .nav-link.active {
            color: #17a2b8 !important;
            background-color: rgba(23, 162, 184, 0.1);
        }
        
        /* Dropdown Menu Styling */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 10px;
        }
        
        .dropdown-item {
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
            transform: translateX(5px);
        }
        /* Notification Styles */
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 10px;
            padding: 3px 5px;
            border-radius: 50%;
            background-color: #dc3545;
        }
        
        .notifications-header {
            padding: 8px 12px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .notifications-body {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .dropdown-menu {
            min-width: 300px;
        }
        
        .notification-item {
            padding: 10px 15px;
            border-bottom: 1px solid #e9ecef;
            white-space: normal;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-time {
            font-size: 12px;
            color: #6c757d;
        }
        @media (max-width: 768px) {
            .navbar-nav.ml-auto {
                display: flex;
                flex-direction: column;
                align-items: stretch;
            }
            
            .navbar-nav .btn-primary {
                margin-bottom: 10px; /* Adds vertical spacing between buttons */
                width: 100%; /* Make buttons full width */
            }
        }
        .notifications-footer {
    padding: 10px;
    border-top: 1px solid #e9ecef;
}
    </style>

<body>
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-xl-5 py-lg-0">
    <a href="index.php" class="navbar-brand">
        <img src="./img/childcare.png" alt="Logo" style="width: 60px; height: auto; margin-right: 10px;">
        <span class="text-primary">CHILDCARE</span>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
    <div class="navbar-nav font-weight-bold mx-auto py-0">
        <a href="index.php?about" class="nav-item nav-link">Về chúng tôi</a>
        <?php
        if (isset($_SESSION['LoginSuccess']) && $_SESSION['LoginSuccess'] == true) {
            echo '<a href="index.php?tracnghiem" class="nav-item nav-link">Theo dõi phát triển</a>';
            echo '<a href="index.php?appointment" class="nav-item nav-link">Đặt lịch hẹn tại trường</a>';
            echo '<a href="index.php?xemlichtuvan" class="nav-item nav-link">Thanh toán đặt lịch tại trường</a>';
            echo '<a href="index.php?chuyengia" class="nav-item nav-link">Chat trực tuyến với chuyên viên</a>';
            echo '<a href="index.php?hosotreem" class="nav-item nav-link">Hồ sơ của trẻ</a>';
        }
        ?>
        <a href="index.php?tintuc" class="nav-item nav-link">Tin tức</a>
        <a href="index.php?lienhe" class="nav-item nav-link">Liên hệ</a>
    </div>
    
    <?php if (isset($_SESSION['LoginSuccess']) && $_SESSION['LoginSuccess'] == true) : ?>
        <div class="navbar-nav ml-auto">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#accountModal">Xin chào, <?php echo $_SESSION['username']; // Assuming you store username in session ?></a>
            <div class="nav-item dropdown">
                <a class="nav-link" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-danger notification-badge">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                    <div class="notifications-header">
                        <h6 class="dropdown-header">Thông báo</h6>
                    </div>
                    <div class="notifications-body">
                        <!-- Notifications will be loaded here -->
                    </div>
                    <div class="notifications-footer text-center">
                        <a href="index.php?allNotifications" class="dropdown-item">Xem tất cả thông báo</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="navbar-nav ml-auto">
            <a href="index.php?login" class="btn btn-primary px-4">Đăng nhập</a>
            <a href="index.php?register" class="btn btn-primary px-4">Đăng ký</a>
        </div>
    <?php endif; ?>
    </nav>
</div>
<!-- Navbar End -->

<!-- Account Modal -->
<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="accountModalLabel">Tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a class="dropdown-item" href="index.php?info"><i class="fas fa-user pastel-green-icon"></i> Thông tin cá nhân</a>
                <a class="dropdown-item" href="index.php?xemlichsu"><i class="fas fa-history pastel-green-icon"></i> Lịch sử kiểm tra sàng lọc</a>

                    <a class="dropdown-item" href="index.php?xemlichhoc"><i class="fas fa-user pastel-green-icon"></i> Lịch học của bé</a>
                    <a class="dropdown-item" href="index.php?xemlichtuvan"><i class="fas fa-user pastel-green-icon"></i> Lịch đăng kí tư vấn</a>
                    <a class="dropdown-item" href="index.php?xemlichsutuvan"><i class="fas fa-user pastel-green-icon"></i> Xem lịch sử tư vấn</a>
                    <a class="dropdown-item" href="index.php?hocphi"><i class="fas fa-user pastel-green-icon"></i>Học phí</a>
              
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?logout"><i class="fas fa-sign-out-alt pastel-green-icon"></i> Đăng xuất</a>
            </div>
        </div>
    </div>
</div>
    <!-- Navbar End -->
    <!-- Navbar End -->
    <?php
  
    if (isset($_REQUEST['tuvantudong'])) {
        include('View/chatbot/tuvantudong.php');
    } else if (isset($_REQUEST['phanhoi'])) {
        include('View/phanhoi.php');
    } else if (isset($_REQUEST['chuyengia'])) {
        include('View/chuyengia.php');
    } else if (isset($_REQUEST['tintuc'])) {
        include('View/tintuc/tintuc.php');
    } else if (isset($_REQUEST['showtintuc'])) {
        include('View/tintuc/showtintuc.php');
    } else if (isset($_REQUEST['lienhe'])) {
        include('View/lienhe.php');
    } else if (isset($_REQUEST['login'])) {
        include('View/login.php');
    }else if (isset($_REQUEST['googlelogin'])) {
            include('View/logingoogle.php');
    } else if (isset($_REQUEST['register'])) {
        include('View/register.php');
    } else if (isset($_REQUEST['xemlichsu'])) {
        include('View/xemls.php');
    } else if (isset($_REQUEST['xemlichsutuvan'])) {
        include('View/TuVan/Medicalhistory.php');
    } else if (isset($_REQUEST['xemlichtuvan'])) {
        include('View/TuVan/lichtuvan.php');
    } else if (isset($_REQUEST['tuvanchuyengia'])) {
        include('View/tuvanchuyengia.php');
    } else if (isset($_REQUEST['phanhoigiaovien'])) {
        include('View/phanhoigiaovien.php');
    }  else if (isset($_REQUEST['tracnghiem'])) {
        include('View/tracnghiem.php');
    } else if (isset($_REQUEST['lambaitracnghiem'])) {
        include('View/lambaitracnghiem.php');
    }else if (isset($_REQUEST['xemlichhoc'])) {
        include('View/LichHoc/lichhoc.php');
    } else if (isset($_REQUEST['info'])) {
        include('View/vInfo.php');
    } else if (isset($_REQUEST['forgot'])) {
        include('View/forgotpass.php');
    } else if (isset($_REQUEST['newpass'])) {
        include('View/newpass.php');
    } else if (isset($_REQUEST['hosotreem'])) {
        include('View/TreEm/quanlyhosotreem.php');
    }else if (isset($_REQUEST['addTreEm'])) {
        include('View/TreEm/addTreEm.php');
    }else if (isset($_REQUEST['updatetreem'])) {
        include('View/TreEm/updatetreem.php');
    }else if (isset($_REQUEST['deleteTreEm'])) {
        include('View/TreEm/deltreem.php');
    }else if (isset($_REQUEST['about'])) {
        include('View/AboutUs.php');
    }else if(isset($_REQUEST['appointment'])) {
        include_once("View/Home/Appointment.php");
    } else if (isset($_REQUEST['appointmentDetail'])) {
        include_once("View/AppointmentDetail.php");
    } else if (isset($_REQUEST['listAppointment'])) {
        include_once("View/TuVan/listAppointmentPDF.php");
    }else if (isset($_REQUEST['allNotifications'])) {
        include_once("View/thongBao.php");
    }else if (isset($_REQUEST['orderC'])) {
        include_once("View/order.php");
    }else if (isset($_REQUEST['hocphi'])) {
        include_once("View/HocPhi/quanlyhocphi.php");
    }
     else {
        include('View/main.php');
    }

    ?>
    <!-- Footer Start -->
    
    <div id="chatbot">
        <div id="chatbot-header">
        <img src="./img/childcare.png" alt="Logo" style="width: 60px; height: auto; margin-right: 10px;">
            <h2>CHILDCARE</h2>
        </div>
        <div id="chatbot-body">
            <div id="chatbot-messages"></div>
            <div id="chatbot-input-container">
                <input type="text" id="text" placeholder="Nhập câu hỏi ở đây ...">
                <button><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>

    <script src="./js/srcchat.js"></script>
</div>
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row justify-content-center align-items-center pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0" style="font-size: 40px; line-height: 40px;">
                    <img src="./img/childcare.png" alt="Logo" style="width: 60px; height: auto; margin-right: 10px;">
                    <span class="text-primary " style=" font-size: 30px;">CHILDCARE</span>
                </a>
                <p>CHILDCARE là một nền tảng trực tuyến được thiết kế đặc biệt để hỗ trợ và tư vấn cho trẻ tự kỷ và gia đình của họ.
                    Chúng tôi cung cấp các nguồn tài nguyên, thông tin và dịch vụ chuyên môn nhằm giúp trẻ tự kỷ phát triển toàn diện và tối đa
                    hóa tiềm năng của họ trong môi trường học tập và xã hội.</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Liên lạc</h3>
                <div class="d-flex">
                    <h4 class="fa fa-map-marker-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Địa chỉ</h5>
                        <p>12 Nguyễn Văn Bảo, phường 4, Gò Vấp.</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-envelope text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Email</h5>
                        <p>Xuanhauk16@gmail.com</p>
                        <p>duc200251@gmail.com</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-phone-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Số điện thoại</h5>
                        <p>035 2594 707</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>


<!-- Template Javascript -->
<script src="js/main.js"></script>
<script>
 // Function to generate response
function generateResponse() {
    var text = document.getElementById("text");
    var response = document.getElementById("chatbot-messages");
    
    if (text.value.trim() === "") return; // Prevent empty messages

    var userMessage = document.createElement("div");
    userMessage.className = "user-message";
    userMessage.innerText = text.value;
    response.appendChild(userMessage);

    fetch("api.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            text: text.value
        }),
    })
    .then((res) => res.text())
    .then((res) => {
        var botMessage = document.createElement("div");
        botMessage.className = "bot-message";
        botMessage.innerText = res;
        response.appendChild(botMessage);

        text.value = "";
        response.scrollTop = response.scrollHeight;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

// Event listener for the send button
document.querySelector("#chatbot-input-container button").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default button behavior
    generateResponse();
});

// Event listener for the Enter key
document.getElementById("text").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Prevent default Enter behavior
        generateResponse();
    }
});

// Toggle chatbot visibility
document.getElementById("chatbot-header").onclick = function() {
    var chatbotBody = document.getElementById("chatbot-body");
    chatbotBody.classList.toggle("active");
};
</script>
<script>
function loadNotifications() {
    $.ajax({
        url: 'View/getThongBao.php',
        method: 'GET',
        success: function(response) {
            try {
                const notifications = JSON.parse(response);
                const notificationsBody = $('.notifications-body');
                const badge = $('.notification-badge');
                
                notificationsBody.empty();
                badge.text(notifications.length);

                if (notifications.length === 0) {
                    notificationsBody.append('<div class="dropdown-item">Không có thông báo mới</div>');
                } else {
                    notifications.forEach(notification => {
                        notificationsBody.append(`
                            <div class="dropdown-item notification-item">
                                <div>${notification.noiDung}</div>
                                <small class="notification-time">${notification.thoiGian}</small>
                            </div>
                        `);
                    });
                }
            } catch (e) {
                console.error('JSON Parse Error:', e);
                console.error('Response:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}
function markNotificationsAsRead() {
    // Add delay before sending request
    setTimeout(() => {
    $.ajax({
        url: 'View/markNotificationsAsRead.php',
        type: 'POST',
        success: function(response) {
            if(response.success) {
                // Update UI after successful marking
                $('.notification-badge').hide();
                // Add this line to refresh notifications immediately
                loadNotifications();
            }
        }
    });
}, 3000);
}
// Load notifications when page loads
$(document).ready(function() {
    if ($('#notificationDropdown').length) {
        loadNotifications();
        // Refresh notifications every 30 seconds
        setInterval(loadNotifications, 30000);
    }
});
</script>
</body>

</html>
