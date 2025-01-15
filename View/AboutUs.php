<?php
require_once('Controller/ChuyenVien/cChuyenVien.php');
require_once('Controller/GiaoVien/cGiaoVien.php');
$c = new cGVien();
$p = new cCV();
$giaovien = $c->getGV();
$menu = $p->getCV();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kider - Preschool Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</head>
<style>
/* Màu sắc và theme hiện đại */
/* Color Scheme */
:root {
    --primary-color: #4A90E2;
    --secondary-color: #7ED957;
    --accent-color: #f0932b;
    --text-color: #333;
    --bg-light: #F7F9FC;
}

body {
    
    background-color: var(--bg-light);
    color: var(--text-color);
    line-height: 1.6;
}

/* General Container Styling */
.container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 20px;
}

/* Header Section */
h1 {
    color: var(--primary-color);
    font-weight: 700;
    margin-bottom: 20px;
}

/* Team Section Styling */
.team-item {
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    overflow: hidden;
    margin: 20px;
    padding: 20px;
}

.team-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
}

.team-item img {
    width: 250px;
    height: 300px;
    object-fit: cover;
    border-radius: 15px;
    border: 4px solid var(--primary-color);
    transition: transform 0.3s ease;
}

.team-item:hover img {
    transform: scale(1.05);
}

.team-text {
    padding: 20px;
    text-align: center;
}

.team-text h3 {
  
    font-weight: 600;
    margin-bottom: 10px;
}

.team-text p {
    color: #6c757d;
    font-size: 1rem;
    margin: 0;
}

/* Carousel Navigation */
#teamCarousel .owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
}

#teamCarousel .owl-nav button {
    background: var(--accent-color) !important;
    color: white !important;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

#teamCarousel .owl-nav button:hover {
    background: var(--primary-color) !important;
    transform: scale(1.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .team-item {
        margin: 10px;
        transform: scale(0.9);
    }
}
.icon-primary {
    color: #FF5733; /* Example Color 1 */
}

.icon-secondary {
    color: #33C1FF; /* Example Color 2 */
}

.icon-success {
    color: #28A745; /* Example Color 3 */
}

.icon-warning {
    color: #FFC107; /* Example Color 4 */
}

</style>
<body>
    <div class="container-xxl bg-white p-0">
        




        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="mb-4">Tầm nhìn và Sứ mệnh</h1>
                        <p>CHILDCARE tập trung vào các đổi mới sáng tạo, kết hợp các tiến bộ kỹ thuật, xã hội và doanh nghiệp để cải thiện cuộc sống của trẻ em có Rối loạn phổ tự kỷ và các rối loạn phát triển khác và gia đình các em.</p>
                        <p class="mb-4">CHILDCARE kết nối và giúp các chuyên gia có đam mê, cam kết và có tinh thần học tập có cơ hội phát triển
                        CHILDCARE hướng tới hợp tác về các giải pháp khoa học và giáo dục để thúc đẩy một xã hội hòa nhập</p>
                     
                    </div>
                    <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img class="img-fluid w-75 rounded-circle bg-light p-3" src="img/about-1.jpg" alt="">
                            </div>
                            <div class="col-6 text-start" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="./img/tam-nhin-su-menh.png" alt="">
                            </div>
                            <div class="col-6 text-end" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="img/about-3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Call To Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100 rounded" src="img/treem1.jpg" style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Giá trị cốt lõi</h1>
                                <p class="mb-4">Có bằng chứng khoa học

                                  Các giải pháp ứng dụng dựa trên các bằng chứng khoa học và thực tiễn                    
                                </p>
                                <p class="mb-4">Dễ dàng tiếp cận

                                    Mọi đối tượng, đặc biệt là những gia đình có khó khăn về mặt tài chính có thể dễ dàng tiếp cận
                                </p>
                                <p class="mb-4">Tính cam kết

                                Cam kết hỗ trợ trẻ và gia đình các em
                                </p>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h1 class="mb-3">Lợi Ích Khi Đăng Ký Tài Khoản</h1>
        <p class="mb-4">Đăng ký tài khoản để tận hưởng những tiện ích đặc biệt mà chúng tôi cung cấp:</p>
    </div>
            <div class="row">
        <div class="col-lg-3 wow fadeIn" data-wow-delay="0.3s">
            <div class="feature-item text-center rounded p-4">
                <i class="fa fa-user-plus fa-3x mb-3 icon-primary"></i>
                <h4 class="mb-3">Quản Lý Hồ Sơ</h4>
                <p>Thao tác dễ dàng với hồ sơ cá nhân, theo dõi tiến độ và cập nhật thông tin mọi lúc mọi nơi.</p>
            </div>
        </div>
        <div class="col-lg-3 wow fadeIn" data-wow-delay="0.5s">
            <div class="feature-item text-center rounded p-4">
                <i class="fa fa-calendar-alt fa-3x mb-3 icon-secondary"></i>
                <h4 class="mb-3">Lịch Học Tập</h4>
                <p>Quản lý thời khóa biểu, nhận thông báo về các sự kiện và lịch học mới nhất.</p>
            </div>
        </div>
        <div class="col-lg-3 wow fadeIn" data-wow-delay="0.7s">
        <div class="feature-item text-center rounded p-4">
            <i class="fa fa-comments fa-3x mb-3"></i>
            <h4 class="mb-3">Hỗ Trợ Trực Tuyến</h4>
            <p>Nhận hỗ trợ từ đội ngũ chăm sóc khách hàng nhanh chóng và hiệu quả khi cần thiết.</p>
        </div>
    </div>
        <div class="col-lg-3 wow fadeIn" data-wow-delay="0.7s">
            <div class="feature-item text-center rounded p-4">
                <i class="fa fa-clipboard-check fa-3x mb-3 icon-success"></i>
                <h4 class="mb-3">Làm Bài Kiểm Tra Sàng Lọc</h4>
                <p>Thực hiện các bài kiểm tra sàng lọc để đánh giá và nhận được các đề xuất phù hợp với nhu cầu của bạn.</p>
            </div>
        </div>
        <div class="col-lg-3 wow fadeIn" data-wow-delay="0.9s">
            <div class="feature-item text-center rounded p-4">
                <i class="fa fa-calendar-check fa-3x mb-3 icon-warning"></i>
                <h4 class="mb-3">Đặt Lịch Tư Vấn Trực Tiếp</h4>
                <p>Dễ dàng đặt lịch tư vấn trực tiếp với các chuyên gia của chúng tôi để nhận được sự hỗ trợ tốt nhất.</p>
            </div>
        </div>
        
    </div>
</div>
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Phát Triển Dự Án CHILDCARE</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative text-center">
                        <img class="img-fluid rounded-circle team-img mx-auto" src="img/h1.jpg" alt="">
                        <div class="team-text">
                            <br>
                            <h3>Lường Anh Đức</h3>
                            <p class="mb-4">Sinh Viên Ngành Hệ Thống Thông Tin Khoá 16 Trường Đại Học Công Nghiệp Thành Phố Hồ Chí Minh</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative text-center">
                        <img class="img-fluid rounded-circle team-img mx-auto" src="img/z5477893738553_47621c554658bac4205893f2f4a34929 (1).jpg" alt="">
                        <div class="team-text">
                            <br>
                            <h3>Nguyễn Xuân Hậu</h3>
                            <p class="mb-4">Sinh Viên Ngành Hệ Thống Thông Tin Khoá 16 Trường Đại Học Công Nghiệp Thành Phố Hồ Chí Minh</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>

        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Đội ngũ Chuyên Viên của hệ thống CHILDCARE</h1>
        </div>
        <div id="teamCarousel" class="owl-carousel owl-theme">
            <?php
            foreach ($menu as $unit) {
                $idChuyenVien = $unit['idChuyenVien'];
                $hinhAnh = $unit['hinhAnh'];
                $ChuyenVienName = $unit['hoTen'];
                $moTaChuyenVien = $unit['moTa'];
                ?>
                <div class="item">
                    <div class="team-item position-relative text-center">
                        <img class="img-fluid rounded-circle team-img mx-auto" src="<?php echo $hinhAnh ? 'admin/admin/assets/uploads/images/' . $hinhAnh : 'admin/admin/assets/uploads/images/default.png'; ?>" alt="">
                        <div class="team-text">
                            <br>
                            <h3><?php echo $ChuyenVienName; ?></h3>
                            <p class="mb-4"><?php echo $moTaChuyenVien; ?></p>
                        </div>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
            <br>
            <br>
       <!-- Thay đổi ID từ teamCarousel thành teacherCarousel -->
       <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Đội ngũ Giáo Viên của hệ thống CHILDCARE</h1>
        </div>
            <div id="teacherCarousel" class="owl-carousel owl-theme">
                <?php
                foreach ($giaovien as $unit1) {
                    $idGiaoVien = $unit1['idGiaoVien'];
                    $hinhAnh = $unit1['hinhAnh'];
                    $GiaoVienName = $unit1['hoTen'];
                    
                    ?>
                    <div class="item">
                        <div class="team-item position-relative text-center">
                            <img class="img-fluid rounded-circle team-img mx-auto" src="<?php echo $hinhAnh ? 'admin/admin/assets/uploads/images/' . $hinhAnh : 'admin/admin/assets/uploads/images/default.png'; ?>" alt="">
                            <div class="team-text">
                                <br>
                                <h3><?php echo $GiaoVienName ; ?></h3>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
$(document).ready(function(){
  $("#teamCarousel").owlCarousel({
    // Cấu hình cho carousel chuyên viên
    loop: true,
    margin: 10,
    nav: true,
    navText: [
      '<i class="fas fa-chevron-left"></i>',
      '<i class="fas fa-chevron-right"></i>'
    ],
    autoplay: true,
    autoplayTimeout: 3000,
    responsive: {
      0: { items: 1 },
      600: { items: 2 },
      1000: { items: 3 }
    }
  });

  // Thêm carousel cho giáo viên
  $("#teacherCarousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    navText: [
      '<i class="fas fa-chevron-left"></i>',
      '<i class="fas fa-chevron-right"></i>'
    ],
    autoplay: true,
    autoplayTimeout: 3000,
    responsive: {
      0: { items: 1 },
      600: { items: 2 },
      1000: { items: 3 }
    }
  });
});
</script>
</body>

</html>