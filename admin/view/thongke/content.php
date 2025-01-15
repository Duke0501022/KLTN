<?php
    include_once("model/GiaoVien/mGiaoVien.php");
    include_once("model/CauHoi/mCauHoi.php");
    include_once("model/LopHoc/mLopHoc.php");
    include_once("model/LichDay/mLichDay.php");
    include_once("model/TreEm/mTreEm.php");
    include_once("model/HocPhi/mHocPhi.php");  
    // Khởi tạo các đối tượng cần thiết

    $p = new mLop();
    $nvpp = new mGV(); 
    $ncc = new mCauHoi();
    $ncc1 = new mHoSoTreEM();
    $lichDay = new mLichDay();
    $hocphi = new mHocPhi();
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01'); // Ngày đầu tiên của tháng hiện tại
    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d'); 
    // Fetch schedule data
    $schedule_data = $lichDay->count_schedules_by_date($start_date, $end_date);
    $schedule_labels = [];
    $schedule_counts = [];
    foreach ($schedule_data as $row) {
        $schedule_labels[] = $row['ngayTao'] . ' - ' . $row['hoTen'];
        $schedule_counts[] = $row['total'];
    }
    // Fetch hoc phi data
    $hocphi_total = $hocphi->count_hocphi1($start_date, $end_date);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .content-wrapper {
            max-width: 100%;
            overflow-x: hidden;
        }
        .container-fluid {
            padding: 15px;
        }
        .card {
            margin-bottom: 20px;
        }
        .small-box {
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .small-box .inner {
            padding: 10px;
        }
        .small-box .icon {
            top: 10px;
            right: 10px;
        }
        .small-box-footer {
            display: block;
            padding: 3px 0;
            color: #fff;
            background: rgba(0,0,0,0.1);
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DASHBOARD</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Add your content here -->
                    </div>
                    <div class="col-md-6">
                        <!-- Add your content here -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <section class="content">
                            <div class="container">
                            <script>
$(function() {
    $('#daterange').daterangepicker({
        startDate: moment('<?php echo $start_date; ?>'),
        endDate: moment('<?php echo $end_date; ?>'),
        ranges: {
           'Hôm nay': [moment(), moment()],
           '7 ngày qua': [moment().subtract(6, 'days'), moment()],
           '30 ngày qua': [moment().subtract(29, 'days'), moment()],
           'Tháng này': [moment().startOf('month'), moment().endOf('month')],
           'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        var start = picker.startDate.format('YYYY-MM-DD');
        var end = picker.endDate.format('YYYY-MM-DD');
        
        // Chuyển hướng với các tham số ngày
        window.location.href = window.location.pathname + 
            '?start_date=' + start + 
            '&end_date=' + end;
    });
});
</script>

<form method="GET" action="" class="date-filter-form">
    <div class="form-row align-items-center">
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                </div>
                <input type="text" name="daterange" id="daterange" 
                       class="form-control" 
                       value="<?php echo $start_date . ' - ' . $end_date; ?>"
                       placeholder="Chọn khoảng thời gian">
            </div>
        </div>
    </div>
</form>
                            </div>

                        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

                      
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <?php $sl =  $ncc1->count_te(); ?>
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                <h3><?php echo $sl; ?></h3>
                                                <p>Số lượng Trẻ</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-bag"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <?php $sl = $p->count_lop(); ?>
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h3><?php while($row = mysqli_fetch_array($sl)){ echo $row['count(*)']; } ?></h3>
                                                    <p>Số lượng Lớp Học</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-stats-bars"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <?php $sl = $nvpp->count_GV(); ?>
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3><?php while($row = mysqli_fetch_array($sl)){ echo $row['count(*)']; } ?></h3>
                                                    <p>Số lượng Giáo Viên</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-person-add"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <?php $sl = $ncc->count_cauhoi(); ?>
                                            <div class="small-box bg-danger">
                                                <div class="inner">
                                                    <h3><?php while($row = mysqli_fetch_array($sl)){ echo $row['count(*)']; } ?></h3>
                                                    <p>Số lượng Câu Hỏi</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-pie-graph"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                <h4>Số Lịch Giảng Dạy Theo Ngày</h4>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="scheduleChart" style="height:230px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                <h4>Doanh Thu Học Phí</h4>
                                                </div>
                                                <div class="card-body">
                                                    <h3><?php echo number_format($hocphi_total); ?> VNĐ</h3>
                                                    <canvas id="hocphiChart" style="height:230px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx3 = document.getElementById('scheduleChart').getContext('2d');
        var scheduleChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($schedule_labels); ?>,
                datasets: [{
                    label: 'Số lượng lịch giảng dạy theo ngày',
                    data: <?php echo json_encode($schedule_counts); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx4 = document.getElementById('hocphiChart').getContext('2d');
        var hocphiChart = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Doanh Thu Học Phí'],
                datasets: [{
                    label: 'Doanh Thu Học Phí',
                    data: [<?php echo $hocphi_total; ?>],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>