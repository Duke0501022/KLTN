<?php
include_once("controller/LopHoc/cLopHoc.php");

$idLopHoc = $_REQUEST['idLopHoc']; // Get the class ID

$p = new cLopHoc();
$table = $p->get_lop_id($idLopHoc); // Get class details
$dsGV = $p->get_gv(); // Get list of teachers
$dsTE = $p->get_treem(); // Get list of students

$p = new ketnoi();
$conn = $p->moketnoi($conn);

// Lấy danh sách học sinh đã được thêm vào bất kỳ lớp nào
$added_students = [];
$sql_added_students = "SELECT idHoSo FROM chitietlophoc WHERE idLopHoc != ?";
$stmt_added_students = mysqli_prepare($conn, $sql_added_students);
mysqli_stmt_bind_param($stmt_added_students, 'i', $idLopHoc);
mysqli_stmt_execute($stmt_added_students);
$result_added_students = mysqli_stmt_get_result($stmt_added_students);
while ($row_added = mysqli_fetch_assoc($result_added_students)) {
    $added_students[] = $row_added['idHoSo'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenlop = $_POST['tenLop']; // Note: 'tenLop' should match the input name in your form
    $giaovien = $_POST['giaovien'];
    $hoc_sinh = $_POST['hoc_sinh']; // Array of student IDs

    if ($conn) {
        // Update the `lophoc` table with the new class name
        $sql_lophoc = "UPDATE lophoc SET tenLop = ? WHERE idLopHoc = ?";
        $stmt_lophoc = mysqli_prepare($conn, $sql_lophoc);
        mysqli_stmt_bind_param($stmt_lophoc, 'si', $tenlop, $idLopHoc);

        if (mysqli_stmt_execute($stmt_lophoc)) {
            // First, delete existing entries in `chitietlophoc` for this class to replace them with new data
            $sql_delete = "DELETE FROM chitietlophoc WHERE idLopHoc = ?";
            $stmt_delete = mysqli_prepare($conn, $sql_delete);
            mysqli_stmt_bind_param($stmt_delete, 'i', $idLopHoc);
            mysqli_stmt_execute($stmt_delete);

            // Now, insert the updated details into `chitietlophoc` for each student
            $sql_chitiet = "INSERT INTO chitietlophoc (idLopHoc, idHoSo, idGiaoVien) VALUES (?, ?, ?)";
            $stmt_chitiet = mysqli_prepare($conn, $sql_chitiet);

            foreach ($hoc_sinh as $idHoSo) {
                mysqli_stmt_bind_param($stmt_chitiet, 'iii', $idLopHoc, $idHoSo, $giaovien);
                if (!mysqli_stmt_execute($stmt_chitiet)) {
                    echo "<script>alert('Lỗi cập nhật chi tiết lớp học: " . mysqli_error($conn) . "');</script>";
                }
            }

            echo "<script>alert('Cập nhật lớp học thành công!');</script>";
            echo "<script>window.location.href='?qllop'</script>";
        } else {
            echo "<script>alert('Lỗi cập nhật lớp học: " . mysqli_error($conn) . "');</script>";
        }

        $p->dongketnoi($conn);
    } else {
        echo "<script>alert('Không thể kết nối đến cơ sở dữ liệu.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật thông tin Lớp học</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Cập nhật thông tin Lớp học</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý Lớp Học</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Thông tin Lớp học</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if ($table && mysqli_num_rows($table) > 0) {
                                $row = mysqli_fetch_assoc($table);
                                ?>
                                <form action="" method="post">
                                    <!-- Class ID (readonly) -->
                                    <div class="form-group">
                                        <label for="idLopHoc">Mã Lớp Học</label>
                                        <input type="text" class="form-control" name="idLopHoc" value="<?= htmlspecialchars($row['idLopHoc']) ?>" readonly>
                                    </div>
                                    
                                    <!-- Class Name -->
                                    <div class="form-group">
                                        <label for="tenLop">Tên Lớp Học</label>
                                        <input type="text" class="form-control" name="tenLop" value="<?= htmlspecialchars($row['tenLop']) ?>" required>
                                    </div>
                                    
                                    <!-- Teacher Selection -->
                                    <div class="form-group">
                                        <label for="giaovien">Giáo Viên:</label>
                                        <select id="giaovien" name="giaovien" class="form-control" required>
                                            <option value="">Chọn Giáo Viên</option>
                                            <?php
                                            $selected_gv = isset($row['idGiaoVien']) ? $row['idGiaoVien'] : '';

                                            while ($rowGV = mysqli_fetch_assoc($dsGV)) { ?>
                                                <option value="<?= htmlspecialchars($rowGV['idGiaoVien']) ?>"
                                                    <?= ($selected_gv == $rowGV['idGiaoVien']) ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars($rowGV['hoTen']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Students Selection (Checkboxes) -->
                                    <div class="form-group">
                                        <label>Học Sinh</label>
                                        <div class="checkbox-group">
                                            <?php
                                            // Use an empty array if 'hoc_sinh_ids' is not set
                                            $selected_students = isset($row['hoc_sinh_ids']) ? explode(',', $row['hoc_sinh_ids']) : [];

                                            while ($rowTE = mysqli_fetch_assoc($dsTE)) { 
                                                if (!in_array($rowTE['idHoSo'], $added_students)) { ?>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="hoc_sinh<?= htmlspecialchars($rowTE['idHoSo']) ?>" name="hoc_sinh[]" value="<?= htmlspecialchars($rowTE['idHoSo']) ?>"
                                                        <?= in_array($rowTE['idHoSo'], $selected_students) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="hoc_sinh<?= htmlspecialchars($rowTE['idHoSo']) ?>">
                                                        <?= htmlspecialchars($rowTE['hoTenTE']) ?>
                                                    </label>
                                                </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <button type="reset" class="btn btn-secondary">Hủy</button>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    // JavaScript function to check if at least one student checkbox is checked
    document.querySelector("form").addEventListener("submit", function(event) {
        // Get all the checkboxes for students
        const studentCheckboxes = document.querySelectorAll('input[name="hoc_sinh[]"]');
        let isChecked = false;

        // Loop through all checkboxes and check if any is checked
        for (const checkbox of studentCheckboxes) {
            if (checkbox.checked) {
                isChecked = true;
                break;
            }
        }

        // If no checkbox is checked, prevent form submission and show an alert
        if (!isChecked) {
            event.preventDefault(); // Prevent the form from submitting
            alert("Vui lòng chọn ít nhất một học sinh.");
        }
    });
</script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>