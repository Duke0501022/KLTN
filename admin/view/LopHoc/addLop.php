<?php
include_once("controller/LopHoc/cLopHoc.php");

$cLop = new cLopHoc();
$dsGV = $cLop->get_gv();

$dsTE = $cLop->get_treem();

include_once("model/connect.php");
$p = new ketnoi();
$conn = $p->moketnoi($conn);

$added_students = [];
$sql_added_students = "SELECT idHoSo FROM chitietlophoc";
$result_added_students = mysqli_query($conn, $sql_added_students);
while ($row_added = mysqli_fetch_assoc($result_added_students)) {
    $added_students[] = $row_added['idHoSo'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenlop = $_POST['tenlop'];
    $giaovien = $_POST['giaovien'];
    $hoc_sinh = $_POST['hoc_sinh']; // mảng học sinh
   

   

    if ($conn) {
        // Kiểm tra tên lớp đã tồn tại chưa
        $sql_check = "SELECT COUNT(*) AS count FROM lophoc WHERE tenLop = '$tenlop'";
        $result_check = mysqli_query($conn, $sql_check);
        $row_check = mysqli_fetch_assoc($result_check);

        if ($row_check['count'] > 0) {
            echo "<script>alert('Tên lớp đã tồn tại. Vui lòng chọn tên khác.');</script>";
        } else {
            // Bắt đầu thêm vào bảng lophoc
            $sql_lophoc = "INSERT INTO lophoc (tenLop) VALUES ('$tenlop')";
            if (mysqli_query($conn, $sql_lophoc)) {
                $idLopHoc = mysqli_insert_id($conn); // Lấy id của lớp vừa thêm

                // Thêm vào bảng chitietlophoc cho từng học sinh và phụ huynh
                foreach ($hoc_sinh as $idHoSo) {
                    
                        $sql_chitiet = "INSERT INTO chitietlophoc (idLopHoc, idHoSo, idGiaoVien) 
                                        VALUES ('$idLopHoc',  '$idHoSo', '$giaovien')";
                        if (!mysqli_query($conn, $sql_chitiet)) {
                            echo "<script>alert('Lỗi thêm chi tiết lớp học: " . mysqli_error($conn) . "');</script>";
                        }
                    
                }

                echo "<script>alert('Thêm lớp học thành công!');</script>";
                echo "<script>window.location.href='?qllop'</script>";
            } else {
                echo "<script>alert('Lỗi thêm lớp học: " . mysqli_error($conn) . "');</script>";
            }
        }
        $p->dongketnoi($conn);
    } else {
        echo "<script>alert('Không thể kết nối đến cơ sở dữ liệu.');</script>";
    }
}

// Lấy danh sách học sinh đã được thêm vào lớp học

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Lớp Học</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    width: 90%;
    max-width: 800px;
    margin: auto;
    overflow: hidden;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-top: 20px;
}

h1 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

.checkbox-group {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px;
    max-height: 150px;
    overflow-y: auto;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 4px;
    background-color: #f9f9f9;
}

.checkbox-group label {
    margin-bottom: 5px;
    display: flex;
    align-items: center;
    gap: 10px;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #0056b3;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #007bff;
}

.error, .success {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.error {
    color: #ff0000;
    background-color: #ffe6e6;
    border: 1px solid #ff0000;
}

.success {
    color: #4CAF50;
    background-color: #e6ffe6;
    border: 1px solid #4CAF50;
}

@media (max-width: 768px) {
    .form-group {
        flex-direction: column;
    }
}

    </style>
</head>
<body>
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý Lớp Học</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý lớp học</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    <div class="container">
        <h1>Thêm Lớp Học</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="tenlop">Tên Lớp:</label>
                <input type="text" id="tenlop" name="tenlop" required>
            </div>
            <div class="form-group">
                <label for="giaovien">Giáo Viên:</label>
                <select id="giaovien" name="giaovien" required>
                    <option value="">Chọn Giáo Viên</option>
                    <?php while ($row = mysqli_fetch_assoc($dsGV)) { ?>
                        <option value="<?= htmlspecialchars($row['idGiaoVien']) ?>"><?= htmlspecialchars($row['hoTen']) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Học Sinh:</label>
                <div class="checkbox-group">
                    <?php while ($row = mysqli_fetch_assoc($dsTE)) { 
                        if (!in_array($row['idHoSo'], $added_students)) { ?>
                        <label>
                            <input type="checkbox" name="hoc_sinh[]" value="<?= htmlspecialchars($row['idHoSo']) ?>">
                            <?= htmlspecialchars($row['hoTenTE']) ?>
                        </label>
                    <?php } } ?>
                </div>
            </div>
           
            <button type="submit">Thêm Lớp</button>
        </form>
    </div>
                    </div>
</body>
</html>