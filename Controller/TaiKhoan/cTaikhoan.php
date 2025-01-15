<?php



include_once('Model/TaiKhoan/mTaiKhoan.php');
// session_start(); // Đảm bảo rằng session đã được khởi tạo

class cTaiKhoan
{
    // Hàm lấy thông tin chi tiết tài khoản cho phụ huynh
    public function get_tt_dangnhap($username)
    {
        $p = new mTaiKhoan();
        $tt = $p->select_tt_taikhoan($username, 2); // Chỉ lấy thông tin cho phụ huynh với Role = 2
        while ($row1 = mysqli_fetch_assoc($tt)) {
            $_SESSION['idPhuHuynh'] = $row1['idPhuHuynh'];
            $_SESSION['email'] = $row1['email'];
            $_SESSION['hinhAnh'] = $row1['hinhAnh'];
            $_SESSION['hoTenPH'] = $row1['hoTenPH'];
            $_SESSION['soDienThoai'] = $row1['soDienThoai'];
            $_SESSION['gioiTinh'] = $row1['gioiTinh'];
        }
    }

    public function login($username, $password)
    {
        $password = md5($password);
        $p = new mTaiKhoan();
        $user = $p->login($username, $password);
        $row = mysqli_fetch_assoc($user);

        if ($row && $row['Role'] == 2) { // Kiểm tra Role và chỉ cho phép phụ huynh đăng nhập
            // Lưu thông tin đăng nhập vào session
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['Role'] = $row['Role'];
            $_SESSION['LoginSuccess'] = true;

            
            // Lấy thông tin chi tiết tài khoản
            $this->get_tt_dangnhap($username);
            echo "<script>alert('Đăng nhập thành công')</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Đăng nhập thất bại hoặc bạn không có quyền truy cập')</script>";
            echo "<script>window.location.href = 'index.php?login';</script>";
        }
    }

    // Thêm tài khoản cho phụ huynh
    public function them_taikhoan($username, $password)
    {
        $p = new mTaiKhoan();
        $insert = $p->add_taikhoan($username, $password, 2); // Chỉ thêm tài khoản với Role = 2

        // Gọi hàm chèn tài khoản từ model
        if ($insert) {
            return 1; // Chèn thành công
        } else {
            return 0; // Chèn không thành công
        }
    }

    // Đổi mật khẩu tài khoản
    public function ChangePassword($username, $matKhau)
    {
        $p = new mTaiKhoan();
        return $p->ChangePassword($username, $matKhau);
    }
}