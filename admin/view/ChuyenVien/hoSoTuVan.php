<?php
include_once("controller/HoSoTuVan/cHSTV.php");

// Ensure $id_datlich is set from a valid source
$id_datlich = isset($_GET['id_datlich']) ? $_GET['id_datlich'] : null;

$p = new cHSTV();
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Livedoc | Landing, Responsive &amp; Business Template</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 30px;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        .back-link i {
            margin-right: 10px;
        }
        .alert {
            border-radius: 5px;
        }
    </style>
</head>
<body>
   
    <div class="container border p-4 mt-3">
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $time_create = $_POST['time_create'];
                $loiDan = $_POST['loiDan'];
                $chuanDoan = $_POST['chuanDoan'];
                $id_datlich = $_POST['id_datlich'];

                // Lấy ngày hôm nay
                $date_create = date('Y-m-d');
                $datetime_create = $date_create . ' ' . $time_create;

                $mHSTV = new cHSTV();
                $result = $mHSTV->insert_hoso($datetime_create, $loiDan, $chuanDoan, $id_datlich);

            if ($result) {
                // Update status to "đã khám" (check = 1)
                $update_result = $mHSTV->update_status($id_datlich, 1);
                if ($update_result) {
                    echo "<div class='alert alert-success'>Hồ sơ tư vấn đã được lưu thành công và trạng thái đã được cập nhật.</div>";
                    echo "<script>window.location.href='?lichtuvan'</script>";
                } else {
                    echo "<div class='alert alert-warning'>Hồ sơ tư vấn đã được lưu thành công nhưng có lỗi xảy ra khi cập nhật trạng thái.</div>";
                    echo "<script>window.location.href='?lichtuvan'</script>";
                }
            } else {
                echo "<div class='alert alert-danger'>Có lỗi xảy ra khi lưu hồ sơ tư vấn.</div>";
            }
        }
        ?>

<form action="" method="post">
            <input type="hidden" name="id_datlich" value="<?php echo htmlspecialchars($id_datlich); ?>">
            
            <div class="form-group">
                <label for="time_create">Giờ tạo:</label>
                <input type="time" class="form-control" name="time_create" required>
            </div>
            
            <div class="form-group">
                <label for="loiDan">Lời dặn:</label>
                <textarea class="form-control" name="loiDan" rows="4" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="chuanDoan">Chuẩn đoán:</label>
                <textarea class="form-control" name="chuanDoan" rows="4" required></textarea>
            </div>
            
            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary" value="Lưu hồ sơ tư vấn">
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</html>