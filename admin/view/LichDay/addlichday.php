<?php
// FILE: ADDLICHDAY.PHP

include_once("controller/LichDay/cLichDay.php");
include_once("controller/GiaoVien/cGiaoVien.php");
include_once("controller/PhongHoc/cPhongHoc.php");
include_once("controller/TietHoc/cTietHoc.php");
include_once("controller/LopHoc/cLopHoc.php");

$c = new cPH();
$h = new cTH();
$p = new cGV();
$l = new cLopHoc();
$menu = new cLichDay();

$list_lh = $l->get_lop_lay();
$list_h = $h->getAllTH();
$list_ph = $c->getAllPH();
$list_loai = $p->getAllGV();
$list_menu = $menu->getAlltMenu();

$selected_date = isset($_POST['date']) ? $_POST['date'] : null;
$errors = [];
$today = (new DateTime())->format('Y-m-d H:i:s');

if (isset($_POST['btn_addmenu'])) {
    $selected_teachers = $_POST['monan'] ?? [];
    $selected_ph = $_POST['phonghoc'] ?? [];
    $selected_th = $_POST['tiethoc'] ?? [];
    $selected_lh = $_POST['lophoc'] ?? [];

    if (empty($selected_teachers)) {
        $errors[] = 'Vui lòng chọn ít nhất 1 giáo viên.';
    }
    if (empty($selected_ph)) {
        $errors[] = 'Vui lòng chọn ít nhất 1 phòng học.';
    }
    if (empty($selected_th)) {
        $errors[] = 'Vui lòng chọn ít nhất 1 tiết học.';
    }

    if (empty($errors)) {
        // Tạo một đối tượng DateTime với ngày đã chọn
        $start_date = new DateTime($selected_date);
        $interval = new DateInterval('P1W'); // khoảng thời gian 1 tuần
        $weeks_to_schedule = 16; // số tuần muốn tạo lịch (4 tháng = 16 tuần)
        
        $insert_success = true;

        for ($i = 0; $i < $weeks_to_schedule; $i++) {
            // Lấy ngày hiện tại cho tuần này
            $current_date = $start_date->format('Y-m-d');

            $menuData = $menu->getOneMenuByDate($current_date);

            // Kiểm tra nếu $menuData là một mảng và chứa khóa 'idLichGD'
            if (is_array($menuData) && isset($menuData['idLichGD'])) {
                $menu_id = $menuData['idLichGD'];
            } else {
                // Chèn một menu mới vì chưa tồn tại
                if (!$menu->InsertMenu($current_date)) {
                    $errors[] = "Không thể tạo lịch giảng dạy cho ngày $current_date.";
                    continue;
                }

                // Lấy lại dữ liệu menu sau khi chèn
                $menuData = $menu->getOneMenuByDate($current_date);
                
                if (is_array($menuData) && isset($menuData['idLichGD'])) {
                    $menu_id = $menuData['idLichGD'];
                } else {
                    $errors[] = "Không thể lấy thông tin lịch giảng dạy cho ngày $current_date.";
                    continue;
                }
            }
           
            $teachers = $p->getAllGV(); // Thêm phương thức này trong lớp mLichDay
            $teacher_names = array();
            if ($teachers) {
                foreach ($teachers as $t) {
                    $teacher_names[$t['idGiaoVien']] = $t['hoTen']; // Thay 'hoTen' bằng trường tên thực tế
                }
            }
            
            // Lấy danh sách tất cả phòng học
            $rooms = $c->getAllPH(); // Thêm phương thức này trong lớp mLichDay
            $room_names = array();
            if ($rooms) {
                foreach ($rooms as $ph) {
                    $room_names[$ph['idPhongHoc']] = $ph['tenPhong']; // Thay 'tenPhong' bằng trường tên thực tế
                }
            }
            
            // Lấy danh sách tất cả tiết học
            $tiethocs = $h->getAllTH(); // Thêm phương thức này trong lớp mLichDay
            $tiethoc_names = array();
            if ($tiethocs) {
                foreach ($tiethocs as $th) {
                    $tiethoc_names[$th['idTietHoc']] = $th['tenTiet']; // Thay 'tenTiet' bằng trường tên thực tế
                }
            }
            
            // Lấy danh sách tất cả lớp học
            $lophocs = $l->get_lop_lay();
            $lophoc_names = array();
            if ($lophocs) {
                foreach ($lophocs as $lh) { // Rename loop variable from $l to $lh
                    $lophoc_names[$lh['idLopHoc']] = $lh['tenLop']; // Thay 'tenLop' bằng trường tên thực tế
                }
            }
            
            // Khởi tạo các mảng để theo dõi lỗi độc nhất
            $teacher_conflicts = array();
            $room_conflicts = array();
            $class_conflicts = array();
            
            // Thêm chi tiết lịch giảng dạy
            foreach ($selected_teachers as $teacher) {
                $teacher_name = isset($teacher_names[$teacher]) ? $teacher_names[$teacher] : "ID $teacher";
                foreach ($selected_ph as $phonghoc) {
                    $room_name = isset($room_names[$phonghoc]) ? $room_names[$phonghoc] : "ID $phonghoc";
                    foreach ($selected_th as $tiethoc) {
                        $tiethoc_name = isset($tiethoc_names[$tiethoc]) ? $tiethoc_names[$tiethoc] : "ID $tiethoc";
                        foreach ($selected_lh as $lophoc) {
                            $lophoc_name = isset($lophoc_names[$lophoc]) ? $lophoc_names[$lophoc] : "ID $lophoc";
                            
                            // Kiểm tra xung đột lịch cho giáo viên
                            if ($menu->hasTeacherConflict($teacher, $current_date, $tiethoc)) {
                                if (!isset($teacher_conflicts[$teacher])) {
                                    $errors[] = "Giáo viên $teacher_name đã có lớp vào tiết $tiethoc_name ngày $current_date.";
                                    $teacher_conflicts[$teacher] = true;
                                }
                                continue;
                            }
                            
                            // Kiểm tra xung đột lịch cho phòng học
                            if ($menu->hasRoomConflict($phonghoc, $current_date, $tiethoc)) {
                                if (!isset($room_conflicts[$phonghoc])) {
                                    $errors[] = "Phòng học $room_name đã được sử dụng vào tiết $tiethoc_name ngày $current_date.";
                                    $room_conflicts[$phonghoc] = true;
                                }
                                continue;
                            }
                            
                            // Kiểm tra xung đột lịch cho lớp học
                            if ($menu->hasClassConflict($lophoc, $current_date, $tiethoc)) {
                                if (!isset($class_conflicts[$lophoc])) {
                                    $errors[] = "Lớp học $lophoc_name đã có lịch vào tiết $tiethoc_name ngày $current_date.";
                                    $class_conflicts[$lophoc] = true;
                                }
                                continue;
                            }
                            
                            // Insert lịch giảng dạy
                            if (!$menu->InsertMenuDetails($menu_id, $teacher, $phonghoc, $tiethoc, $lophoc)) {
                                $errors[] = "Không thể thêm lịch cho giáo viên $teacher_name vào ngày $current_date.";
                            }
                        }
                    }
                }
            }

            // Tăng ngày lên 1 tuần
            $start_date->add($interval);
        }

                // Hiển thị lỗi nếu có
            // Hiển thị lỗi nếu có
            if (!empty($errors)) {
                echo '
                <div class="alert-container">
                    <div class="alert-custom">
                        <button type="button" class="close-btn" onclick="this.parentElement.style.display=\'none\';" aria-label="Close">
                            &times;
                        </button>
                        <ul class="mb-0">';
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo '
                        </ul>
                    </div>
                </div>';
            } else {
                echo '
                <div class="alert-container">
                    <div class="alert-custom alert-success-custom">
                        <button type="button" class="close-btn" onclick="this.parentElement.style.display=\'none\';" aria-label="Close">
                            &times;
                        </button>
                        <p>Thêm lịch giảng dạy thành công.</p>
                    </div>
                </div>';
            }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Giảng Dạy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Add this to the <head> section -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
       body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
    transition: background-color 0.3s ease;
}
.alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: 300px; /* Điều chỉnh độ rộng theo nhu cầu */
        }

.alert-custom {
             border: 1px solid #f5c6cb;
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            max-height: 200px; /* Giới hạn chiều cao */
            overflow-y: auto; /* Cho phép cuộn dọc */
            position: relative;
        }

.alert-success-custom {
            border: 1px solid #c3e6cb;
            background-color: #d4edda;
            color: #155724;
            max-height: 200px; /* Giới hạn chiều cao */
            overflow-y: auto; /* Cho phép cuộn dọc */
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            font-weight: bold;
            color: inherit;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 10px;
        }

        ul {
            padding-left: 20px;
        }
.content-wrapper {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Header Styles */
.content-header {
    background-color: #fff;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    transition: box-shadow 0.3s ease;
}

.content-header:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.content-header h1 {
    color: #3c8dbc;
    font-size: 24px;
    margin: 0;
    transition: color 0.3s ease;
}

.content-header h1:hover {
    color: #2980b9;
}

/* Card Styles */
.card {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.card-header {
    background-color: #3c8dbc;
    color: #fff;
    padding: 15px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    transition: background-color 0.3s ease;
}

.card-header:hover {
    background-color: #2980b9;
}

/* Form Styles */
input[type="date"],
input[type="submit"],
input[type="reset"] {
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 14px;
    transition: all 0.3s ease;
}

input[type="date"]:focus,
input[type="submit"]:focus,
input[type="reset"]:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(60, 141, 188, 0.5);
}

input[type="submit"],
input[type="reset"] {
    background-color: #3c8dbc;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

input[type="submit"]:active,
input[type="reset"]:active {
    transform: translateY(0);
    box-shadow: none;
}
.error-messages {
    border: 1px solid #f5c6cb;
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.success-message {
    border: 1px solid #c3e6cb;
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}
/* Table Styles */
.calendartable {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.calendartable th, 
.calendartable td {
    border: 1px solid #dee2e6;
    padding: 15px;
    text-align: center;
    vertical-align: top;
    transition: all 0.3s ease;
}

.calendartable th {
    background-color: #3c8dbc;
    color: #fff;
}

.calendartable th:hover {
    background-color: #2980b9;
}

.calendartable td:hover {
    background-color: #f8f9fa;
    transform: scale(1.02);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* Calendar Dish Styles */
.calendarDish {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    padding: 10px;
    margin: 10px 0;
    transition: all 0.3s ease;
}

.calendarDish:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.calendarDish a {
    color: #3c8dbc;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.calendarDish a:hover {
    color: #2980b9;
}

/* Button Styles */
.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    font-size: 12px;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.btn-danger:active {
    transform: translateY(0);
    box-shadow: none;
}

/* Animation Keyframes */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Apply Animations */
.card, .calendarDish {
    animation: fadeIn 0.5s ease-out, slideIn 0.5s ease-out;
}

/* Responsive Design */
@media (max-width: 768px) {
    .calendar [type="date"] {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .calendar [type="submit"] {
        width: 100%;
        margin: 5px 0;
    }
    
    .calendartable th, .calendartable td {
        padding: 10px;
    }
    
    .calendarDish {
        margin: 10px 0;
    }
}  /* Your CSS styles */
    </style>
</head>
<body>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lịch Giảng Dạy</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Lịch Giảng Dạy</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        
                        </div>
                        <div class="card-body">
                            <div class="upload">
                                <h2 class="mt-4 m-3">Thêm giáo viên vào lịch</h2>
                                <form action="" method="post">
                                    <table class="admin_upload">
                                        <tr>
                                            <th>Chọn ngày lên lịch:</th>
                                            <th>
                                                <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($selected_date); ?>" required>
                                                <input type="submit" value="Xác nhận" id="submitBtn" name="sub_date">
                                            </th>
                                        </tr>
                                        <tr>
    <th>Chọn giáo viên</th>
    <th>
        <div style="display: flex; flex-wrap: wrap;">
            <?php
            if ($selected_date) {
                $date_obj = new DateTime($selected_date);
                $formatted_date = $date_obj->format('Y-m-d H:i:s');
                $day_of_week = $date_obj->format('l');

                $current_menu = $menu->getMenuByDate($formatted_date);

                foreach ($list_loai as $index => $teacher) {
                    ?>
                    <div style="border-radius: 5px; padding: 5px; margin: 5px; border: 1px solid #dee2e6; width: 150px;" class="dish_mon">
                        <label for="radio<?php echo $index ?>"><?php echo htmlspecialchars($teacher['hoTen']); ?></label>
                        <input type="radio" class="show-form teacher-select" data-form="form<?php echo $index ?>" 
                               id="checkbox<?php echo $index ?>" style="margin-right: 20px; float: right; margin-top: 5px;" 
                               name="monan[]" value="<?php echo $teacher['idGiaoVien']; ?>"
                               onchange="loadClasses(this.value)">
                    </div>
                <?php }
            }
            ?>
        </div>
    </th>
</tr>

<tr>
    <th>Chọn lớp học</th>
    <th>
        <div id="class-container" style="display: flex; flex-wrap: wrap;">
            <p>Vui lòng chọn giáo viên trước</p>
        </div>
    </th>
</tr>


                                        <tr>
                                            <th>Chọn phòng học</th> 
                                            <th>
                                                <div style="display: flex; flex-wrap: wrap;">
                                                    <?php
                                                    if ($selected_date) {
                                                        $date_obj = new DateTime($selected_date);
                                                        $formatted_date = $date_obj->format('Y-m-d H:i:s');
                                                        $day_of_week = $date_obj->format('l');

                                                        $current_menu = $menu->getMenuByDate($formatted_date);

                                                        foreach ($list_ph as $index => $teacher) {
                                                            ?>
                                                                <div style="border-radius: 5px; padding: 5px; margin: 5px; border: 1px solid #dee2e6; width: 150px;" class="dish_mon">
                                                                    <label for="radio<?php echo $index ?>"><?php echo htmlspecialchars($teacher['tenPhong']); ?></label>
                                                                    <input type="radio" class="show-form" data-form="form<?php echo $index ?>" id="checkbox<?php echo $index ?>" style="margin-right: 20px; float: right; margin-top: 5px;" name="phonghoc[]" value="<?php echo $teacher['idPhongHoc']; ?>">
                                                                </div>
                                                    <?php }
                                                        }
                                                    
                                                    ?>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Chọn tiết học </th>
                                            <th>
                                                <div style="display: flex; flex-wrap: wrap;">
                                                    <?php
                                                   if ($selected_date) {
                                                    $date_obj = new DateTime($selected_date);
                                                    $formatted_date = $date_obj->format('Y-m-d H:i:s');
                                                    $day_of_week = $date_obj->format('l');
                                                
                                                    $current_menu = $menu->getMenuByDate($formatted_date);
                                                
                                                    foreach ($list_h as $index => $teacher) {
                                                        // Không cần kiểm tra xem tiết học đã tồn tại hay chưa,
                                                        // vẫn hiển thị tất cả các tiết học cho mỗi lần thêm mới.
                                                        ?>
                                                        <div style="border-radius: 5px; padding: 5px; margin: 5px; border: 1px solid #dee2e6; width: 150px;" class="dish_mon">
                                                            <label for="checkbox<?php echo $index ?>"><?php echo htmlspecialchars($teacher['tenTiet']); ?></label>
                                                            <input type="checkbox" class="show-form" data-form="form<?php echo $index ?>" id="checkbox<?php echo $index ?>" style="margin-right: 20px; float: right; margin-top: 5px;" name="tiethoc[]" value="<?php echo $teacher['idTietHoc']; ?>">
                                                        </div>
                                                    <?php
                                                    }
                                                 }
                                                        
                                                    
                                                    ?>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="submit" value="Thêm" id="submit" name="btn_addmenu" onclick="return validateCheckbox()">
                                                <input type="reset" value="Hủy" id="reset" name="">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('date').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const day = selectedDate.getDay(); // 0: Chủ nhật, 6: Thứ Bảy

        if (day === 0 || day === 6) { // Nếu là thứ Bảy hoặc Chủ nhật
            alert('Không được lên lịch vào cuối tuần');
            this.value = ''; // Xóa ngày đã chọn
        }
    });
</script>
<script>
function loadClasses(teacherId) {
    if (!teacherId) return;

    // Tạo một đối tượng XMLHttpRequest
    const xhr = new XMLHttpRequest();
    const classContainer = document.getElementById('class-container');
    
    // Hiển thị loading message
    classContainer.innerHTML = '<p>Đang tải danh sách lớp...</p>';
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                classContainer.innerHTML = xhr.responseText;
            } else {
                classContainer.innerHTML = '<p>Có lỗi xảy ra khi tải danh sách lớp</p>';
            }
        }
    };
    
    // Gửi request
    xhr.open('POST', 'view/LichDay/getClassesByTeacher.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('teacherId=' + teacherId);
}

// Sửa lại hàm validateCheckbox để kiểm tra các trường bắt buộc
function validateCheckbox() {
    let teacherSelected = document.querySelector('input[name="monan[]"]:checked');
    let classSelected = document.querySelector('input[name="lophoc[]"]:checked');
    let classroomSelected = document.querySelector('input[name="phonghoc[]"]:checked');
    let lessonSelected = document.querySelectorAll('input[name="tiethoc[]"]:checked').length;

    if (!teacherSelected) {
        alert("Vui lòng chọn giáo viên.");
        return false;
    }
    if (!classSelected) {
        alert("Vui lòng chọn lớp học.");
        return false;
    }
    if (!classroomSelected) {
        alert("Vui lòng chọn phòng học.");
        return false;
    }
    if (!lessonSelected) {
        alert("Vui lòng chọn ít nhất một tiết học.");
        return false;
    }
    return true;
}
</script>

</body>
</html>