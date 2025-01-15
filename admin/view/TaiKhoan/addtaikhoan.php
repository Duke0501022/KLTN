 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý Thông Tin Tài Khoản</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý thông tin tài khoản</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">


            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
             
              <h3 style="text-align:center">Thêm Tài Khoản</h3>
              <form action="#" method="post" onsubmit="return validateForm()">
                <div class="row">
                  <div class="col">
                    <td>Mã vai trò</td>
                    <!-- <input type="text" class="form-control" id="mavaitro" placeholder="Enter Số điện thoại" name="mavaitro"></br> -->
                    <select name="role" id="role" placeholder="chọn mã vai trò" class="form-control">
                        <option value="2">Phụ Huynh</option>;
                        <option value="3">Chuyên Viên</option>;
                        <option value="5">Giáo Viên</option>;
                        <option value="4">Quản trị chuyên viên</option>;
                        <option value="6">Quản trị giáo viên</option>;
                        
                    </select>
                    <td>Username</td>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required></br>
                    <span class="error" id="usernameError"></span>
                    <td>Password</td>
                     <input type="text" class="form-control" id="registerPassword" placeholder="Enter password" name="password"></br>
                     <span class="error" id="passwordError"></span>
                  </div>

                   
                    <!--  -->
                 
                </div>
</br>
                <button type="submit" class="btn btn-primary" name="btnsubmit" style="margin-left:45%">Submit</button>
                <button type="reset" class="btn btn-primary"  >Reset</button>
                <!-- <input type="submit" value="Thêm Doanh Nghiệp" style="text-align:center"> -->
              </form>
              
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    include ("controller/TaiKhoan/ctaikhoan.php");
    if(isset($_REQUEST["btnsubmit"])){
        $Role=$_REQUEST['role'];
        // echo $Mavaitro;
        $username=$_REQUEST['username'];
        $password=$_REQUEST['password'];
        $p=new ctaikhoan();
        if ($p->check_taikhoan($username)) {
          echo "<script>alert('Tài khoản đã tồn tại')</script>";
      } else {
       
        $table=$p->add_taikhoan($username,$password,$Role);
        if ($table==1) {
            echo "<script>alert('Thêm tài khoản thành công')</script>";
        }else {
            echo "<script>alert('Thêm tài khoản không thành công')</script>";
        }
      }
        
    }else {
        echo 123;
    }
  ?>
     <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');

        // Các trường input cần kiểm tra
        const inputs = {
    username: { input: document.getElementById('username'), errorId: 'usernameError', validate: validateUsername },
    password: { input: document.getElementById('registerPassword'), errorId: 'passwordError', validate: validatePassword },
};

        // Thêm sự kiện cho từng input
        for (const key in inputs) {
            const field = inputs[key];
            field.input.addEventListener('input', field.validate);
        }

        // Kiểm tra form khi submit
        form.addEventListener('submit', function (e) {
            let isValid = true;

            for (const key in inputs) {
                const field = inputs[key];
                if (!field.validate()) {
                    isValid = false;
                }
            }

            if (!isValid) {
                e.preventDefault(); // Ngăn không cho form submit nếu có lỗi
            }
        });

        // Hàm hiển thị lỗi
        function showError(input, errorId, message) {
            const errorElement = document.getElementById(errorId);
            errorElement.textContent = message;
            errorElement.style.display = 'block';
            input.classList.add('is-invalid');
        }

        // Hàm ẩn lỗi
        function hideError(input, errorId) {
            const errorElement = document.getElementById(errorId);
            errorElement.textContent = '';
            errorElement.style.display = 'none';
            input.classList.remove('is-invalid');
        }

        // Hàm kiểm tra họ tên
        function validateUsername() {
            const username = inputs.username.input.value.trim();
            if (username === '') {
                showError(inputs.username.input, inputs.username.errorId, 'Vui lòng nhập tên tài khoản');
                return false;
            } else {
                hideError(inputs.username.input, inputs.username.errorId);
                return true;
            }
        }

        

        // Hàm kiểm tra mật khẩu
        function validatePassword() {
            const password = inputs.password.input.value;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                showError(inputs.password.input, inputs.password.errorId, 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt');
                return false;
            } else {
                hideError(inputs.password.input, inputs.password.errorId);
                return true;
            }
        }

        // Hàm kiểm tra ngày sinh
        
    });
</script>
<style>
     .error {
            color: red;
            display: none;
        }
        .is-invalid {
            border-color: red;
        }
</style>