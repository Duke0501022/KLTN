<?php
    include_once("model/ChuyenVien/mChuyenVien.php");
    include_once("model/LoaiBaiViet/mTinTuc.php");
    include_once("model/LienHe/mLienHe.php");
    include_once("model/LSTV/mLSTV.php");
    // Khởi tạo các đối tượng cần thiết
    
    $p = new mLienHe();
    $nvpp = new mCV(); 
    $ncc = new mloaibaiviet();
    $lstv = new mLSTV();

    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01'); // Ngày đầu tiên của tháng hiện tại
    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d'); 

    $data1 = $lstv->count_datlich($start_date, $end_date);
    $data2 = $lstv->count_dtdatlich($start_date, $end_date);
    $dnn    = $lstv->count_hoso();
    $dates1 = [];
    $counts = [];
    foreach ($data1 as $row) {
        $dates1[] = $row['date'];
        $counts[] = $row['count'];
    }

    $dates2 = [];
    $totals = [];
    foreach ($data2 as $row) {
        $dates2[] = $row['create_at'];
        $totals[] = $row['total'];
    }
    $total_revenue = 0;
$total_appointments = 0;

// Tính tổng doanh thu
foreach ($data2 as $row) {
    $total_revenue += $row['total'];
}

// Tính tổng số lượng đặt lịch
foreach ($data1 as $row) {
    $total_appointments += $row['count'];
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    /* Main container styles */
.container-fluid {
    padding: 1.5rem;
    background-color: #f8f9fa;
}

/* Card styles */
.card {
    background-color: #fff;
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    margin-bottom: 1.5rem;
}

.card-header {
    padding: 1.5rem;
    background-color: transparent;
    border-bottom: 1px solid #eee;
}

.card-body {
    padding: 1.5rem;
}

/* Date range picker styles */
#daterange {
    background-color: #fff;
    border: 1px solid #dee2e6;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    cursor: pointer;
}

/* Custom grid layout */
.row {
    margin-bottom: 1.5rem;
}

/* Typography */
h6 {
    font-size: 1rem;
    font-weight: 600;
    color: #344767;
    margin-bottom: 1rem;
}

.text-sm {
    font-size: 0.875rem;
}

.font-weight-bold {
    font-weight: 600;
}

/* Colors */
.text-success {
    color: #2dce89;
}

/* Progress bars */
.progress {
    height: 0.5rem;
    border-radius: 0.25rem;
    background-color: #f6f9fc;
    margin: 0.5rem 0;
}

.progress-bar {
    border-radius: 0.25rem;
}

/* Stats cards */
.stats-card {
    padding: 1rem;
    border-radius: 1rem;
    background: linear-gradient(310deg, #7928CA, #FF0080);
}

.stats-card .icon {
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,0.1);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stats-card .stats-number {
    font-size: 1.25rem;
    font-weight: 600;
    color: #fff;
    margin: 1rem 0 0.25rem;
}

.stats-card .stats-text {
    color: rgba(255,255,255,0.8);
    font-size: 0.875rem;
}

/* Responsive tables */
.table-responsive {
    border-radius: 0.5rem;
}

.table {
    margin-bottom: 0;
}

.table th {
    font-weight: 600;
    padding: 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    border-bottom-width: 1px;
}

.table td {
    padding: 1rem;
    font-size: 0.875rem;
    border-top: 1px solid #eee;
}
    </style>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                                            <?php $sl = $lstv->count_hoso(); ?>
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                <h3><?php echo $sl; ?></h3>
                                                <p>Số lượng Hồ Sơ Tư Vấn</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-bag"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <?php $sl = $p->count_lh(); ?>
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h3><?php while($row = mysqli_fetch_array($sl)){ echo $row['count(*)']; } ?></h3>
                                                    <p>Số lượng yêu cầu phản hồi</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-stats-bars"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <?php $sl = $nvpp->count_nhanvien(); ?>
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3><?php while($row = mysqli_fetch_array($sl)){ echo $row['count(*)']; } ?></h3>
                                                    <p>Số lượng Chuyên Viên</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-person-add"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <?php $sl = $ncc->count_tt(); ?>
                                            <div class="small-box bg-danger">
                                                <div class="inner">
                                                    <h3><?php while($row = mysqli_fetch_array($sl)){ echo $row['count(*)']; } ?></h3>
                                                    <p>Số lượng tin tức</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-pie-graph"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                <h4>Tổng Doanh Thu: <?php echo number_format($total_revenue); ?> VNĐ</h4>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="revenueChart" style="height:230px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                <h4>Tổng Số Lượng Đặt Lịch: <?php echo $total_appointments; ?></h4>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="appointmentChart" style="height:230px"></canvas>
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
        var ctx1 = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dates2); ?>,
                datasets: [{
                    label: 'Doanh thu',
                    data: <?php echo json_encode($totals); ?>,
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

        var ctx2 = document.getElementById('appointmentChart').getContext('2d');
        var appointmentChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dates1); ?>,
                datasets: [{
                    label: 'Số lượng đặt lịch tư vấn',
                    data: <?php echo json_encode($counts); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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