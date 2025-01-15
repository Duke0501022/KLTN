<?php
include_once("controller/LSTV/cLSTV.php");



$menu = new cLSTV();
$wait = 1;
$date = new DateTime();
$date = $date->format('Y-m-d');

$ngayXemLich = $date;



$monday = strtotime('this week monday');
$thu2 = date('d/m/Y', $monday);

$tuesday = strtotime('this week tuesday');
$thu3  = date('d/m/Y', $tuesday);

$thursday = strtotime('this week wednesday');
$thu4  = date('d/m/Y', $thursday);

$thursday = strtotime('this week thursday');
$thu5  = date('d/m/Y', $thursday);

$friday = strtotime('this week friday');
$thu6  = date('d/m/Y', $friday);

$saturday = strtotime('this week saturday');
$thu7  = date('d/m/Y', $saturday);

$sunday = strtotime('this week sunday');
$thu8  = date('d/m/Y', $sunday);

if (!isset($_SESSION['t2'])) {
    $_SESSION['t2']  = $thu2;
    $_SESSION['t3']  = $thu3;
    $_SESSION['t4']  = $thu4;
    $_SESSION['t5']  = $thu5;
    $_SESSION['t6']  = $thu6;
    $_SESSION['t7']  = $thu7;
    $_SESSION['t8']  = $thu8;
}

if (isset($_POST['next'])) {
    $t2 = DateTime::createFromFormat('d/m/Y', $_SESSION['t2']);
    $t3 = DateTime::createFromFormat('d/m/Y', $_SESSION['t3']);
    $t4 = DateTime::createFromFormat('d/m/Y', $_SESSION['t4']);
    $t5 = DateTime::createFromFormat('d/m/Y', $_SESSION['t5']);
    $t6 = DateTime::createFromFormat('d/m/Y', $_SESSION['t6']);
    $t7 = DateTime::createFromFormat('d/m/Y', $_SESSION['t7']);
    $t8 = DateTime::createFromFormat('d/m/Y', $_SESSION['t8']);

    $t2->modify('+7 days');
    $t3->modify('+7 days');
    $t4->modify('+7 days');
    $t5->modify('+7 days');
    $t6->modify('+7 days');
    $t7->modify('+7 days');
    $t8->modify('+7 days');

    $_SESSION['t2'] = $t2->format('d/m/Y');
    $_SESSION['t3'] = $t3->format('d/m/Y');
    $_SESSION['t4'] = $t4->format('d/m/Y');
    $_SESSION['t5'] = $t5->format('d/m/Y');
    $_SESSION['t6'] = $t6->format('d/m/Y');
    $_SESSION['t7'] = $t7->format('d/m/Y');
    $_SESSION['t8'] = $t8->format('d/m/Y');

    $ngayXemLich  = $t2->format('Y-m-d');
} elseif (isset($_POST['prev'])) {
    $t2 = DateTime::createFromFormat('d/m/Y', $_SESSION['t2']);
    $t3 = DateTime::createFromFormat('d/m/Y', $_SESSION['t3']);
    $t4 = DateTime::createFromFormat('d/m/Y', $_SESSION['t4']);
    $t5 = DateTime::createFromFormat('d/m/Y', $_SESSION['t5']);
    $t6 = DateTime::createFromFormat('d/m/Y', $_SESSION['t6']);
    $t7 = DateTime::createFromFormat('d/m/Y', $_SESSION['t7']);
    $t8 = DateTime::createFromFormat('d/m/Y', $_SESSION['t8']);

    $t2->modify('-7 days');
    $t3->modify('-7 days');
    $t4->modify('-7 days');
    $t5->modify('-7 days');
    $t6->modify('-7 days');
    $t7->modify('-7 days');
    $t8->modify('-7 days');

    $_SESSION['t2'] = $t2->format('d/m/Y');
    $_SESSION['t3'] = $t3->format('d/m/Y');
    $_SESSION['t4'] = $t4->format('d/m/Y');
    $_SESSION['t5'] = $t5->format('d/m/Y');
    $_SESSION['t6'] = $t6->format('d/m/Y');
    $_SESSION['t7'] = $t7->format('d/m/Y');
    $_SESSION['t8'] = $t8->format('d/m/Y');

    $ngayXemLich  = $t2->format('Y-m-d');
} elseif (isset($_POST['current'])) {
    $_SESSION['t2'] = $thu2;
    $_SESSION['t3'] = $thu3;
    $_SESSION['t4'] = $thu4;
    $_SESSION['t5'] = $thu5;
    $_SESSION['t6'] = $thu6;
    $_SESSION['t7'] = $thu7;
    $_SESSION['t8'] = $thu8;
}

$t2 = $_SESSION['t2'];
$t3 = $_SESSION['t3'];
$t4 = $_SESSION['t4'];
$t5 = $_SESSION['t5'];
$t6 = $_SESSION['t6'];
$t7 = $_SESSION['t7'];
$t8 = $_SESSION['t8'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teaching Schedule</title>
   <style>
    body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
    transition: background-color 0.3s ease;
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


/* Button Styles */
.btn-danger, .btn-info {
    display: inline-block;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    margin-top: 10px;
    cursor: pointer;
}

.btn-danger {
    background-color: #e74c3c;
    color: #fff;
    border: none;
}

.btn-danger:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-danger:active {
    transform: translateY(0);
    box-shadow: none;
}

.btn-info {
    background-color: #3498db;
    color: #fff;
    border: none;
}

.btn-info:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-info:active {
    transform: translateY(0);
    box-shadow: none;
}

.btn-danger a, .btn-info a {
    color: #fff;
    text-decoration: none;
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
}
.calendarDish {
    background-color: #ffffff;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.calendarDish:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transform: translateY(-3px);
}

.calendarDish a {
    display: block;
    color: #333;
    font-size: 14px;
    margin-bottom: 5px;
    text-decoration: none;
}

.calendarDish a:first-child {
    font-weight: bold;
    font-size: 16px;
    color: #3498db;
}

.calendarDish .btn-danger {
    background-color: #e74c3c;
    border: none;
    color: #fff;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

.calendarDish .btn-danger:hover {
    background-color: #c0392b;
}

.calendarDish .btn-danger a {
    color: #fff;
    text-decoration: none;
}

@media (max-width: 768px) {
    .calendarDish {
        padding: 10px;
    }

    .calendarDish a {
        font-size: 12px;
    }

    .calendarDish a:first-child {
        font-size: 14px;
    }
}
.modal-dialog {
            max-width: 800px;
        }
        .timetable {
            width: 100%;
        }
        .timetable th, .timetable td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .timetable th {
            background-color: #f8f9fa;
        }
          .calendarDish.completed {
        background-color: #d4edda;
        border-left: 5px solid #28a745;
    }

    .calendarDish.pending {
        background-color: #fff3cd;
        border-left: 5px solid #ffc107;
    }

    .legend {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-left: 20px;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }
  @media (max-width: 1000px) {
  .calendartable-container {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .calendartable {
    min-width: 1000px; /* Đảm bảo bảng không bị thu nhỏ */
  }
}
@media (max-width: 768px) {
  .calendartable th, .calendartable td {
    padding: 5px;
    font-size: 15px;
  }
}
.pending-approval {
    background-color: #4057a1; /* Light yellow background */
    border: 1px solid #ffeeba; /* Yellow border */
}
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                        <div class="legend">
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #fff3cd; border: 1px solid #ffc107;"></div>
                                <span>Chưa khám</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #d4edda; border: 1px solid #28a745;"></div>
                                <span>Đã khám</span>
                            </div>
                        </div>
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
                                <form action="" method="post">
                                    <input type="date" id="selectedDate" name="date" value="<?php echo $ngayXemLich  ?>">
                                    <input type="submit" value="Trở vể" id="previousWeekButton" name="prev">
                                    <input type="submit" value="Hiện Tại" id="currentDateButton" name="current">
                                    <input type="submit" value="Tiếp" id="nextWeekButton" name="next">
                                </form>
                                <div>
                                <div class="calendartable-container">
                                    <table class="calendartable">
                                        <tr>
                                            <th id="day">Thứ 2 <?php echo $t2;  ?></th>
                                            <th id="day">Thứ 3 <?php echo $t3; ?></th>
                                            <th id="day">Thứ 4 <?php echo $t4; ?></th>
                                            <th id="day">Thứ 5 <?php echo $t5; ?></th>
                                            <th id="day">Thứ 6 <?php echo $t6; ?></th>
                                            <th id="day">Thứ 7 <?php echo $t7; ?></th>
                                            <th id="day">Chủ nhật <?php echo $t8; ?></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php
                                                $newDate = date_format(date_create_from_format('d/m/Y', $t2), 'Y-m-d');
                                                $list_menu = $menu->getLichByDate($newDate,$wait);
                                                if (!empty($list_menu)) {
                                                    foreach ($list_menu as $item) {
                                                        $check = $item['check'] ?? 0; // Default to 0 if 'check' is not set
                                                        $statusClass = $check ? 'completed' : 'pending';
                                                ?>
                                                    <div class="calendarDish <?php echo $statusClass; ?>">
                                                        <a>Phụ Huynh: <?php echo $item['hoTenPH'] ?></a>
                                                        <a>Chuyên Viên: <?php echo $item['hoTen'] ?></a>
                                                        
                                                        <a>Số Điện Thoại: <?php echo $item['sdtPH'] ?></a>
                                                        <a>Vấn đề: <?php echo $item['describe_problem'] ?></a>
                                                        <a>Giờ: <?php echo $item['hour'] ?></a>
                                                        <a>Trạng thái: <?php echo $check ? 'Đã khám' : 'Chưa khám'; ?></a>
                                                        <br>
                                                        <?php if (!$check) { // Only show the button if not checked ?>
                                                        <button class="btn btn-danger delete">
                                                        <a class="text-light" href="?DeleteDL&id_datlich=<?php echo $item['id_datlich'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>

                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                               <td>
                                                <?php
                                                $newDate = date_format(date_create_from_format('d/m/Y', $t3), 'Y-m-d');
                                                $list_menu = $menu->getLichByDate($newDate,$wait);
                                                if (!empty($list_menu)) {
                                                    foreach ($list_menu as $item) {
                                                        $check = $item['check'] ?? 0; // Default to 0 if 'check' is not set
                                                        $statusClass = $check ? 'completed' : 'pending';
                                                ?>
                                                    <div class="calendarDish <?php echo $statusClass; ?>">
                                                        <a>Phụ Huynh: <?php echo $item['hoTenPH'] ?></a>
                                                        <a>Số Điện Thoại: <?php echo $item['sdtPH'] ?></a>
                                                        <a>Vấn đề: <?php echo $item['describe_problem'] ?></a>
                                                        <a>Giờ: <?php echo $item['hour'] ?></a>
                                                        <a>Trạng thái: <?php echo $check ? 'Đã khám' : 'Chưa khám'; ?></a>
                                                        <br>
                                                        <?php if (!$check) { // Only show the button if not checked ?>
                                                        <button class="btn btn-danger delete">
                                                        <a class="text-light" href="?DeleteDL&id_datlich=<?php echo $item['id_datlich'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>

                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            
                                               <td>
                                                <?php
                                                $newDate = date_format(date_create_from_format('d/m/Y', $t4), 'Y-m-d');
                                                $list_menu = $menu->getLichByDate($newDate,$wait);
                                                if (!empty($list_menu)) {
                                                    foreach ($list_menu as $item) {
                                                        $check = $item['check'] ?? 0; // Default to 0 if 'check' is not set
                                                        $statusClass = $check ? 'completed' : 'pending';
                                                ?>
                                                    <div class="calendarDish <?php echo $statusClass; ?>">
                                                        <a>Phụ Huynh: <?php echo $item['hoTenPH'] ?></a>
                                                        <a>Số Điện Thoại: <?php echo $item['sdtPH'] ?></a>
                                                        <a>Vấn đề: <?php echo $item['describe_problem'] ?></a>
                                                        <a>Giờ: <?php echo $item['hour'] ?></a>
                                                        <a>Trạng thái: <?php echo $check ? 'Đã khám' : 'Chưa khám'; ?></a>
                                                        <br>
                                                        <?php if (!$check) { // Only show the button if not checked ?>
                                                        <button class="btn btn-danger delete">
                                                        <a class="text-light" href="?DeleteDL&id_datlich=<?php echo $item['id_datlich'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>

                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            
                                               <td>
                                                <?php
                                                $newDate = date_format(date_create_from_format('d/m/Y', $t5), 'Y-m-d');
                                                $list_menu = $menu->getLichByDate($newDate,$wait);
                                                if (!empty($list_menu)) {
                                                    foreach ($list_menu as $item) {
                                                        $check = $item['check'] ?? 0; // Default to 0 if 'check' is not set
                                                        $statusClass = $check ? 'completed' : 'pending';
                                                ?>
                                                    <div class="calendarDish <?php echo $statusClass; ?>">
                                                        <a>Phụ Huynh: <?php echo $item['hoTenPH'] ?></a>
                                                        <a>Số Điện Thoại: <?php echo $item['sdtPH'] ?></a>
                                                        <a>Vấn đề: <?php echo $item['describe_problem'] ?></a>
                                                        <a>Giờ: <?php echo $item['hour'] ?></a>
                                                        <a>Trạng thái: <?php echo $check ? 'Đã khám' : 'Chưa khám'; ?></a>
                                                        <br>
                                                        <?php if (!$check) { // Only show the button if not checked ?>
                                                        <button class="btn btn-danger delete">
                                                        <a class="text-light" href="?DeleteDL&id_datlich=<?php echo $item['id_datlich'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>

                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            
                                               <td>
                                                <?php
                                                $newDate = date_format(date_create_from_format('d/m/Y', $t6), 'Y-m-d');
                                                $list_menu = $menu->getLichByDate($newDate,$wait);
                                                if (!empty($list_menu)) {
                                                    foreach ($list_menu as $item) {
                                                        $check = $item['check'] ?? 0; // Default to 0 if 'check' is not set
                                                        $statusClass = $check ? 'completed' : 'pending';
                                                ?>
                                                    <div class="calendarDish <?php echo $statusClass; ?>">
                                                        <a>Phụ Huynh: <?php echo $item['hoTenPH'] ?></a>
                                                        <a>Số Điện Thoại: <?php echo $item['sdtPH'] ?></a>
                                                        <a>Vấn đề: <?php echo $item['describe_problem'] ?></a>
                                                        <a>Giờ: <?php echo $item['hour'] ?></a>
                                                        <a>Trạng thái: <?php echo $check ? 'Đã khám' : 'Chưa khám'; ?></a>
                                                        <br>
                                                        <?php if (!$check) { // Only show the button if not checked ?>
                                                        <button class="btn btn-danger delete">
                                                        <a class="text-light" href="?DeleteDL&id_datlich=<?php echo $item['id_datlich'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>

                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            
                                               <td>
                                                <?php
                                                $newDate = date_format(date_create_from_format('d/m/Y', $t7), 'Y-m-d');
                                                $list_menu = $menu->getLichByDate($newDate,$wait);
                                                if (!empty($list_menu)) {
                                                    foreach ($list_menu as $item) {
                                                        $check = $item['check'] ?? 0; // Default to 0 if 'check' is not set
                                                        $statusClass = $check ? 'completed' : 'pending';
                                                ?>
                                                    <div class="calendarDish <?php echo $statusClass; ?>">
                                                        <a>Phụ Huynh: <?php echo $item['hoTenPH'] ?></a>
                                                        <a>Số Điện Thoại: <?php echo $item['sdtPH'] ?></a>
                                                        <a>Vấn đề: <?php echo $item['describe_problem'] ?></a>
                                                        <a>Giờ: <?php echo $item['hour'] ?></a>
                                                        <a>Trạng thái: <?php echo $check ? 'Đã khám' : 'Chưa khám'; ?></a>
                                                        <br>
                                                        <?php if (!$check) { // Only show the button if not checked ?>
                                                        <button class="btn btn-danger delete">
                                                        <a class="text-light" href="?DeleteDL&id_datlich=<?php echo $item['id_datlich'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>

                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            
                                               <td>
                                                <?php
                                                $newDate = date_format(date_create_from_format('d/m/Y', $t8), 'Y-m-d');
                                                $list_menu = $menu->getLichByDate($newDate,$wait);
                                                if (!empty($list_menu)) {
                                                    foreach ($list_menu as $item) {
                                                        $check = $item['check'] ?? 0; // Default to 0 if 'check' is not set
                                                        $statusClass = $check ? 'completed' : 'pending';
                                                ?>
                                                    <div class="calendarDish <?php echo $statusClass; ?>">
                                                        <a>Phụ Huynh: <?php echo $item['hoTenPH'] ?></a>
                                                        <a>Số Điện Thoại: <?php echo $item['sdtPH'] ?></a>
                                                        <a>Vấn đề: <?php echo $item['describe_problem'] ?></a>
                                                        <a>Giờ: <?php echo $item['hour'] ?></a>
                                                        <a>Trạng thái: <?php echo $check ? 'Đã khám' : 'Chưa khám'; ?></a>
                                                        <br>
                                                        <button class="btn btn-danger delete">
                                                            <a class="text-light" href="?DeleteDL&id_datlich=<?php echo $item['id_datlich'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>

                                                        </button>
                                                    </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            
                                        </tr>
                                    </table>
                                    </div>
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
        document.getElementById('selectedDate').addEventListener('change', function() {
            document.querySelector('form').submit();
        });
    </script>
</body>
</html>