<?php
if(isset($_GET['controller'])) {
    $controllerName = $_GET['controller'];
    $controllerFileName = $controllerName . '.php';
    if(file_exists($controllerFileName)) {
        require_once $controllerFileName;
        $controller = new $controllerName();
        if(isset($_GET['action'])) {
            $action = $_GET['action'];
            if(method_exists($controller, $action)) {
                if($action == 'luuKetQua') {
                    // Xử lý dữ liệu trả về từ form
                    $idTaiKhoan = $_SESSION['idPhuHuynh']; // Thay thế giá trị này bằng ID tài khoản thực tế
                    $ketQuaList = $_POST['ketQuaList']; // Tham số này phải được cung cấp từ form
                    $result = $controller->$action($idTaiKhoan, $ketQuaList);
                    if($result) {
                        echo "Kết quả bài trắc nghiệm đã được lưu thành công.";
                    } else {
                        echo "Đã xảy ra lỗi khi lưu kết quả bài trắc nghiệm.";
                    }
                }
            }
        }
    }
}

?>
<form action="index.php?controller=KetQuaController&action=luuKetQua" method="post">
    <?php foreach ($res as $key => $cauHoi): ?>
        <!-- Các trường câu hỏi và câu trả lời -->
        <!-- Các trường ẩn chứa ID câu hỏi và ID kết quả -->
        <input type="hidden" name="idcauHoi[]" value="<?php echo $cauHoi['idcauHoi']; ?>">
        <input type="hidden" name="idKetQua[]" value="<?php echo $cauHoi['idKetQua']; ?>">
        <!-- Các trường radio button để chọn câu trả lời -->
    <?php endforeach; ?>
    <button type="submit" class="btn btn-primary px-4">Nộp bài</button>
</form>
