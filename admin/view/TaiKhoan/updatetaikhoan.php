<?php
    include("controller/TaiKhoan/ctaikhoan.php");
    $username = $_REQUEST['username'];
    $Role=$_REQUEST['Role'];
    $p = new ctaikhoan();
    $table = $p->select_taikhoan_byusername($username,$Role);
?> 
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Thông Tin Tài Khoản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý Thông Tin Tài Khoản</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 style="text-align:center">Cập nhật thông tin tài khoản</h3>
                            <form action="#" method="post" id="testForm">
                                <div class="row">
                                    <div class="col">
                                        <?php
                                            if($table){
                                                if(mysqli_num_rows($table)>0){
                                                    while ($row=mysqli_fetch_assoc($table)) {
                                                        echo "<tr>";
                                                        echo "<td>Loại tài khoản:</td>";
                                                        echo "<td><input type='text' class='form-control' name='role' readonly value='" .  $row['Role'] . "'></td>";
                                                        echo "</tr>";
                                                        echo "</br>";
                                                        echo "<td>Username</td>";
                                                        echo "<td><input type='text' class='form-control' name='username' readonly value='" . $row['username'] . "'></td>";
                                                        echo "<td>Password</td>";
                                                        echo "<input type='password' class='form-control' name='password' id='password' value='" . $row['password'] . "'> 
                                                        <button type='button' id='togglePassword' onclick='togglePasswordVisibility()'><i class='fa fa-eye'></i></button>
                                                        </td>";
                                                        
                                                    }
                                                }
                                            }
                                        ?>
                                        <br>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit" style="margin-left:45%">Submit</button>
                                <button type="reset" class="btn btn-primary" name="reset">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
    if(isset($_REQUEST["submit"])){
        $username=$_REQUEST["username"];
        $password=$_REQUEST["password"];
        $p=new ctaikhoan();
        $table=$p->update_matkhau_username($username,$password);
        if($table==1){
            echo "<script>alert('Cập nhật thành công')</script>";
        }else {
            echo "<script>alert('Cập nhật không thành công')</script>";
        }
    }
?>

<script>
    function togglePasswordVisibility() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function handleSubmit(event) {
    event.preventDefault(); // Prevent form submission
    var form = document.getElementById('testForm');
    var username = form.elements['username'].value;
    var password = form.elements['password'].value;
    
    // Perform validation here
    if(username === '' || password === '') {
        alert('Username and password cannot be empty');
    } else {
        // Make an AJAX request or perform any other action
        // For simplicity, just logging the values here
        console.log('Username:', username);
        console.log('Password:', password);
    }
}
</script>
