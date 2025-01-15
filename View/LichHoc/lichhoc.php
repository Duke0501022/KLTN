<?php
include_once("Controller/LichHoc/cLichHoc.php");

$menu = new cLichHoc();

$date = new DateTime();
$date = $date->format('Y-m-d');

$ngayXemLich = $date;

// Initialize idHoSo
$idHoSo = null;

// Check if a student is selected
if (isset($_POST['submit']) && isset($_POST['idHoSo'])) {
    $idHoSo = $_POST['idHoSo'];
    // Store the selected idHoSo in session for persistence
    $_SESSION['selectedIdHoSo'] = $idHoSo;
} elseif (isset($_SESSION['selectedIdHoSo'])) {
    // Use the previously selected idHoSo from session
    $idHoSo = $_SESSION['selectedIdHoSo'];
}

// Date calculations for the week
$monday = strtotime('this week monday');
$thu2 = date('d/m/Y', $monday);

$tuesday = strtotime('this week tuesday');
$thu3  = date('d/m/Y', $tuesday);

$wednesday = strtotime('this week wednesday');
$thu4  = date('d/m/Y', $wednesday);

$thursday = strtotime('this week thursday');
$thu5  = date('d/m/Y', $thursday);

$friday = strtotime('this week friday');
$thu6  = date('d/m/Y', $friday);

$saturday = strtotime('this week saturday');
$thu7  = date('d/m/Y', $saturday);

$sunday = strtotime('this week sunday');
$thu8  = date('d/m/Y', $sunday);

// Initialize or update session dates
if (!isset($_SESSION['t2'])) {
    $_SESSION['t2']  = $thu2;
    $_SESSION['t3']  = $thu3;
    $_SESSION['t4']  = $thu4;
    $_SESSION['t5']  = $thu5;
    $_SESSION['t6']  = $thu6;
    $_SESSION['t7']  = $thu7;
    $_SESSION['t8']  = $thu8;
}

// Handle week navigation
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
<html>
<head>
    <title>Lịch Giảng Dạy</title>
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
.calendarDish.normal {
        background-color: #d4edda; 
        border-left: 5px solid #28a745; 
    }

    .calendarDish.suspended {
        background-color: #e67784;
        border-left: 5px solid #ff072c; 
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
/* Switch Styles */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
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


/* Adjust padding for small screens */
@media (max-width: 576px) {
    .calendartable th, .calendartable td {
        padding: 10px;
    }
    
    .btn {
        width: 100%;
        margin-top: 5px;
    }
    
    .form-inline {
        flex-direction: column;
    }
    
    .form-control, .btn {
        width: 100%;
    }
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
        .legend {
        display: flex;
        align-items: center;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-right: 15px;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        margin-right: 5px;
        border-radius: 3px;
    }

    .btn-primary {
        margin-left: 15px;
    }
    /* Compact student selection styles */
.student-select {
    max-width: 200px;
    padding: 6px 8px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    background-color: #fff;
}

.student-select:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.select-container {
    display: inline-block;
    margin-right: 10px;
    vertical-align: middle;
}

/* Optional: Add a compact label */
.select-label {
    font-size: 14px;
    margin-bottom: 4px;
    color: #495057;
}
.timetable {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.timetable th {
    background-color: #4CAF50;
    color: white;
    padding: 12px;
    text-align: center;
    font-weight: bold;
}

.timetable td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.timetable tr {
    transition: all 0.3s ease;
}

.timetable tr:nth-child(even) {
    background-color: #f2f2f2;
}

.timetable tr:hover {
    background-color: #e9e9e9;
    transform: scale(1.01);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.timetable td:first-child {
    font-weight: bold;
    color: #333;
}
/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

/* Calendar Dish Styling */
.calendarDish {
    padding: 8px;
    border-radius: 5px;
    margin-bottom: 5px;
}

/* Normal Status */
.calendarDish.normal {
    background-color: #e0f7fa;
    color: #006064;
}

/* Suspended Status */
.calendarDish.suspended {
    background-color: #ffebee;
    color: #c62828;
    text-decoration: line-through;
}

/* Link Styling within Calendar Dish */
.calendarDish a {
    display: block;
    text-decoration: none;
    margin-bottom: 4px;
    font-size: 14px;
}
    </style>
</head>
<body>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
           
            <div class="col-sm-6">
                       
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#timetableModal">
                                    Xem Thời Gian Tiết Học
                                </button>
                    </div>
              
                     
             
            <div class="col-sm-6 text-right">
                <div class="legend d-inline-block">
                    <div class="legend-item d-inline-block mr-3">
                        <div class="legend-color" style="background-color: #e67784; border: 1px solid #ff072c;"></div>
                        <span>Lịch tạm ngưng giảng dạy</span>
                    </div>
                    <div class="legend-item d-inline-block">
                        <div class="legend-color" style="background-color: #d4edda; border: 1px solid #28a745;"></div>
                        <span>Lịch giảng dạy bình thường</span>
                    </div>
                </div>
               
            </div>
            
            
        </div>
    </div>
</section>
<div class="modal fade" id="timetableModal" tabindex="-1" role="dialog" aria-labelledby="timetableModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timetableModalLabel">Thời Gian Tiết Học</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="timetable">
                        <thead>
                            <tr>
                                <th>Tiết</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1 - 3</td>
                                <td>7:30 - 9:00</td>
                            </tr>
                            <tr>
                                <td>4 - 6</td>
                                <td>9:00 - 10:30</td>
                            </tr>

                            <tr>
                                <td>7 - 9</td>
                                <td>14:00 - 15:30</td>
                            </tr>

                            <tr>
                                <td>10 - 12</td>
                                <td>15:30 - 17:00</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div class="select-container">
    <form method="POST" action="">
    <label class="select-label">Chọn học sinh</label>
        <select name="idHoSo" id="idHoSo" class="student-select">
            <option value="">-- Chọn học sinh --</option>
            <?php
            $idPhuHuynh = $_SESSION['idPhuHuynh'];
            $mLichHoc = new cLichHoc();
            $list_hoSo = $mLichHoc->getIdHoSoByPhuHuynh($idPhuHuynh);

            if ($list_hoSo) {
                foreach ($list_hoSo as $hoSo) {
                    $selected = (isset($_POST['idHoSo']) && $_POST['idHoSo'] == $hoSo['idHoSo']) || 
                                (isset($_SESSION['selectedIdHoSo']) && $_SESSION['selectedIdHoSo'] == $hoSo['idHoSo']) 
                                ? 'selected' : '';
                    echo "<option value='" . $hoSo['idHoSo'] . "' $selected>" . $hoSo['hotenTE'] . " (" . $hoSo['idHoSo'] . ")</option>";
                }
            }
            ?>
        </select>
        <button type="submit" name="submit" class="btn btn-primary mt-2">Xem Lịch</button>
    </form>
    </div>
    <br>
    <br>
 
    <?php if ($idHoSo): ?>
        
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post">
                                    <input type="date" id="selectedDate" name="date" value="<?php echo $ngayXemLich; ?>">
                                    <input type="hidden" name="idHoSo" value="<?php echo $idHoSo; ?>">
                                    <input type="submit" value="Trở vể" id="previousWeekButton" name="prev">
                                    <input type="submit" value="Hiện Tại" id="currentDateButton" name="current">
                                    <input type="submit" value="Tiếp" id="nextWeekButton" name="next">
                                </form>

                                <table class="calendartable">
                                    <tr>
                                        <th>Thứ 2 <?php echo $t2; ?></th>
                                        <th>Thứ 3 <?php echo $t3; ?></th>
                                        <th>Thứ 4 <?php echo $t4; ?></th>
                                        <th>Thứ 5 <?php echo $t5; ?></th>
                                        <th>Thứ 6 <?php echo $t6; ?></th>
                                        <th>Thứ 7 <?php echo $t7; ?></th>
                                        <th>Chủ nhật <?php echo $t8; ?></th>
                                    </tr>
                                    <tr>
                                        <?php 
                                        $dates = [
                                            date_format(date_create_from_format('d/m/Y', $t2), 'Y-m-d'),
                                            date_format(date_create_from_format('d/m/Y', $t3), 'Y-m-d'),
                                            date_format(date_create_from_format('d/m/Y', $t4), 'Y-m-d'),
                                            date_format(date_create_from_format('d/m/Y', $t5), 'Y-m-d'),
                                            date_format(date_create_from_format('d/m/Y', $t6), 'Y-m-d'),
                                            date_format(date_create_from_format('d/m/Y', $t7), 'Y-m-d'),
                                            date_format(date_create_from_format('d/m/Y', $t8), 'Y-m-d')
                                        ];

                                        foreach ($dates as $date) {
                                            echo "<td>";
                                            $list_menu = $menu->getMenuByDatebyIDGV($date, $idHoSo);
                                            if (!empty($list_menu)) {
                                                foreach ($list_menu as $item) {
                                                    $statusClass = $item['check_lich'] == 0 ? 'normal' : 'suspended';
                                                    echo "<div class='calendarDish {$statusClass}'>";
                                                    echo "<a>Giáo Viên: " . htmlspecialchars($item['hoTen']) . "</a>";
                                                    echo isset($item['tenLop']) 
                                                        ? "<a>" . htmlspecialchars($item['tenLop']) . "</a>" 
                                                        : "<a>Lớp học không xác định</a>";
                                                    echo "<a>Phòng Học: " . htmlspecialchars($item['tenPhong']) . "</a>";
                                                    echo "<a>Tiết: " . htmlspecialchars($item['tenTiet']) . "</a>";
                                                    echo "</div>";
                                                }
                                            }
                                            echo "</td>";
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>

    <!-- Previous JavaScript and script tags remain the same -->
</body>
</html>