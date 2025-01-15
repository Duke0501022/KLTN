<?php
   include("controller/TreEm/cTreEm.php");

   if (isset($_REQUEST['idHoSo'])) {
       $idHoSo = $_REQUEST['idHoSo'];
   } else {
       // Handle the error, e.g., redirect or display a message
       echo "<script>alert('ID Hồ Sơ is missing.');</script>";
      
       exit;
   }

   $p = new cHoSoTreEm();
   $table = $p->select_treem_byid_xa($idHoSo);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Thông tin chi tiết</h3>
              </div>
              <div class="card-body">
                <?php
                  if ($table && mysqli_num_rows($table) > 0) {
                    $row = mysqli_fetch_assoc($table);
                ?>
                
                <form action="" method="post" enctype="multipart/form-data" novalidate>
                    <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                       
                        <?php
                          if($row["hinhAnh"] == NULL){
                            echo "<img src='/assets/uploads/images/user.png' alt='' class='img-fluid mb-2' style='max-height: 200px; border-radius: 50px;'>";
                          } else {
                            echo "<img src='admin/assets/uploads/images/".$row['hinhAnh']."' alt='' class='img-fluid mb-2' style='max-height: 200px; border-radius: 50px;'>";
                          }
                        ?>
                        
                      </div>
                    </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>Mã Hồ Sơ</label>
                            <input type='text' class='form-control' name='txtmakh' id='txtmakh' value="<?php echo $row['idHoSo']; ?>" readonly>
                            <span class="text-danger" id="txtmakh_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Họ và Tên</label>
                            <input type='text' class='form-control' name='txttenkh' id='txttenkh' value="<?php echo $row['hoTenTE']; ?>" readonly>
                            <span class="text-danger" id="txttenkh_error"></span>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>Tình Trạng</label>
                            <input type='text' class='form-control' name='txtTrang' id='txtTrang' value="<?php echo $row['tinhTrang']; ?>">
                            <span class="text-danger" id="txtTrang_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung Đánh Giá</label>
                            <input type='text' class='form-control' name='txtND' id='txtND' value="<?php echo $row['noiDungKetQua']; ?>">
                            <span class="text-danger" id="txtND_error"></span>
                        </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
                      <button type="reset" class="btn btn-secondary" name="reset">Hủy</button>
                    </div>
                  </div>
                    </form>
                <?php
                  } else {
                    echo "<p>No customer data found.</p>";
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<style>
  .content-wrapper {
    padding: 20px;
  }
  .card {
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  .form-group {
    margin-bottom: 1rem;
  }
  .btn {
    margin-right: 5px;
  }
</style>
<?php
// XỬ LÍ CẬP NHẬT KHÁCH HÀNG KHÔNG USERNAME
  if(isset($_REQUEST["submit"])){
    $idHoSo=$_REQUEST["txtmakh"];
    
    $tinhTrang=$_REQUEST["txtTrang"];
    $noiDungKetQua=$_REQUEST["txtND"];
   
  
    $p = new cHoSoTreEm();
   
  // Gọi phương thức cập nhật
  
  $update = $p->update_treem_id($idHoSo,$tinhTrang,$noiDungKetQua);

if ($update == 1) {
    echo "<script>alert('Cập nhật thành công');</script>";
    echo "<script>window.location.href='?xemlop'</script>";
} elseif($update == -2) {
    echo "<script>alert('Vui lòng chọn file có định dạng là hình ảnh');</script>"; // Include the error code
}else{
  echo "<script>alert('Cập nhật không thành công. Mã lỗi: $update');</script>"; // Include the error code
}
    
  }
?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const txtTrang = document.getElementById('txtTrang');
    const txtND = document.getElementById('txtND');

    txtTrang.addEventListener('blur', function() {
      const errorElem = document.getElementById('txtTrang_error');
      if (this.value.trim() === '') {
        errorElem.textContent = 'Tình Trạng không được để trống.';
        this.classList.add('is-invalid');
      } else {
        errorElem.textContent = '';
        this.classList.remove('is-invalid');
      }
    });

    txtND.addEventListener('blur', function() {
      const errorElem = document.getElementById('txtND_error');
      if (this.value.trim() === '') {
        errorElem.textContent = 'Nội Dung Đánh Giá không được để trống.';
        this.classList.add('is-invalid');
      } else {
        errorElem.textContent = '';
        this.classList.remove('is-invalid');
      }
    });
  });
</script>
