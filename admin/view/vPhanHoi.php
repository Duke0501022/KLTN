<?php

include_once("controller/LienHe/cLienHe.php");
include_once("controller/CLASS/clsMailer.php");
$mail = new cPHPMailer();
$p = new cLienHe();

$table = $p->get_lienhe();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Phản Hồi</title>
    <!-- Include necessary styles and scripts here -->
</head>
<body>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh sách phản hồi từ người dùng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Phản hồi</li>
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
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table id="feedbackTable" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th style="text-align:center">STT</th>
                    <th style="text-align:center">ID Tiêu đề</th>
                    <th style="text-align:center">Tiêu đề</th>
                    <th style="text-align:center; ">Nội dung</th>
                    <th style="text-align:center">Thời Gian</th>
                    <th style="text-align:center">Người Gửi</th>
                    <th style="text-align:center">Số điện thoại</th>
                    <th style="text-align:center">Email</th>
                    <th style="text-align:center">Trạng thái</th>
                    <th style="text-align:center">Tác vụ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($table) {
                    $stt = 1; // Khởi tạo biến $stt
                    if (mysqli_num_rows($table) > 0) {
                      while ($row = mysqli_fetch_assoc($table)) {
                        echo "<tr>";
                        echo "<td style='text-align:center'>" . $stt++ . "</td>"; // Hiển thị giá trị của biến $stt và sau đó tăng giá trị lên 1
                        echo "<td style='text-align:center'>" . $row['idTieuDe'] . "</td>";
                        echo "<td style='text-align:center'>" . $row['tieuDe'] . "</td>";
                        echo "<td style='text-align:center'>" . $row['noiDung'] . "</td>";
                        $formattedDate = date('d/m/Y', strtotime($row['thoiGian']));
                        echo "<td style='text-align:center'>" . htmlspecialchars($formattedDate) . "</td>";
                        echo "<td style='text-align:center'>" . $row['hoTen'] . "</td>";
                        echo "<td style='text-align:center'>" . $row['soDienThoai'] . "</td>";
                        echo "<td style='text-align:center'>" . $row['email'] . "</td>";
                        if ($row['status'] == 0) {
                          echo "<td style='text-align:center'><span class='badge badge-warning'>Chưa Phản Hồi</span></td>";
                          echo "<td style='text-align:center'><button type='submit' class='btn btn-primary send'>Gửi phản hồi</button></td>";
                        } else {
                          echo "<td style='text-align:center'><span class='badge badge-success'>Đã Phản Hồi</span></td>";
                          echo "<td style='text-align:center'></td>"; // Thay thế nút bằng một badge hoặc thông báo khác // Nếu đã phản hồi, không hiển thị nút
                        }
                        // Delete button with confirmation and trash icon
                        echo "<td style='text-align:center'>";
                        echo "<form method='post' action='' onsubmit=\"return confirm('Bạn có chắc chắn muốn xoá không?');\">";
                        echo "<input type='hidden' name='idTieuDe' value='" . $row['idTieuDe'] . "'>";
                        echo "<button type='submit' name='delete' class='btn btn-danger'><i class='fas fa-trash'></i></button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                      }
                    }
                  }
                  ?>
                </tbody>
              </table>
              <div id="pagination" class="pagination"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <!-- /.row -->
    <?php
    if (isset($_REQUEST['delete'])) {
      $idTieuDe = $_REQUEST['idTieuDe'];
      if (!empty($idTieuDe)) {
          $p->delete_lienhe($idTieuDe);
          echo '<script>alert("Xóa thành công")</script>';
          echo "<script>window.location.href='index.php?phanhoi'</script>";
      } else {
          echo '<script>alert("Chưa chọn liên hệ để xóa")</script>';
      }
  }
    if (isset($_REQUEST['submit'])) {
      $idTieuDe = $_REQUEST['idTieuDe'];
      $tieude = $_REQUEST['tieude'];
      $noidung = $_REQUEST['noidung'];
      $thoigian = $_REQUEST['thoigian'];
      $hoTen = $_REQUEST['hoTen'];
      $sodienthoai = $_REQUEST['sodienthoai'];
      $email = $_REQUEST['email'];
      $noidung_phanhoi = $_REQUEST['traloi'];
      
      if (!empty($idTieuDe)) {
        $p->AcceptPhanHoi($idTieuDe); // Update the status in the database
        $mail->send_mail_phanhoi($email, $sodienthoai, $hoTen, $tieude, $noidung, $noidung_phanhoi);
        echo '<script>alert("Duyệt thành công phản hồi")</script>';
        echo "<script>window.location.href='index.php?phanhoi'</script>";
    } else {
        echo '<script>alert("Chưa chọn liên hệ để duyệt")</script>';
    }
     
    }
    ?>
</div><!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Thông tin phản hồi</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="xemchitiet"></div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="diachi">ID Tiêu đề</label>
            <input type="text" class="form-control" id="idtieude" name="idTieuDe" value="" readonly>
          </div>
          <div class="form-group">
            <label for="diachi">Tiêu đề</label>
            <input type="text" class="form-control" id="tieude" name="tieude" value="" readonly>
          </div>
          <div class="form-group">
            <label for="diachi">Nội dung</label>
            <input type="text" class="form-control" id="noidung" name="noidung" value="" readonly>
          </div>
          <div class="form-group">
            <label for="diachi">Thời Gian</label>
            <input type="text" class="form-control" id="thoigian" name="thoigian" value="" readonly>
          </div>
          <div class="form-group">
            <label for="diachi">Người gửi</label>
            <input type="text" class="form-control" id="hoTen" name="hoTen" value="" readonly>
          </div>
          <div class="form-group">
            <label for="diachi">Số điện thoại</label>
            <input type="text" class="form-control" id="sodienthoai" name="sodienthoai" value="" readonly>
          </div>
          <div class="form-group">
            <label for="diachi">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="" readonly>
          </div>
          <div class="form-group">
            <label for="thongso">Câu trả lời</label>
            <textarea class="form-control" name="traloi" id="traloi" cols="30" rows="10" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" name="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.send').on('click', function() {
      $('#send').modal('show');
      var $row = $(this).closest('tr'); // Get the parent row of the button clicked
      var idTieuDe = $row.find('td:eq(1)').text().trim(); // Column index 1 (ID Tiêu đề)
      var tieude = $row.find('td:eq(2)').text().trim(); // Column index 2 (Tiêu đề)
      var noidung = $row.find('td:eq(3)').text().trim(); // Column index 3 (Nội dung)
      var thoigian = $row.find('td:eq(4)').text().trim(); // Column index 4 (Thời Gian)
      var hoTen = $row.find('td:eq(5)').text().trim(); // Column index 5 (Người gửi)
      var sodienthoai = $row.find('td:eq(6)').text().trim(); // Column index 6 (Số điện thoại)
      var email = $row.find('td:eq(7)').text().trim(); // Column index 7 (Email)

      // Set values to modal fields
      $('#idtieude').val(idTieuDe);
      $('#tieude').val(tieude);
      $('#noidung').val(noidung);
      $('#thoigian').val(thoigian);
      $('#hoTen').val(hoTen);
      $('#sodienthoai').val(sodienthoai);
      $('#email').val(email);
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
      const rowsPerPage = 5;
      const table = document.querySelector("#feedbackTable tbody");
      const rows = table.querySelectorAll("tr");
      const pageCount = Math.ceil(rows.length / rowsPerPage);
      const paginationContainer = document.querySelector("#pagination");

      function displayPage(page) {
          const start = (page - 1) * rowsPerPage;
          const end = start + rowsPerPage;

          rows.forEach((row, index) => {
              if (index >= start && index < end) {
                  row.style.display = "";
              } else {
                  row.style.display = "none";
              }
          });

          document.querySelectorAll(".page-link").forEach(link => {
              link.classList.remove("active");
          });

          document.querySelector(`.page-link[data-page='${page}']`).classList.add("active");
      }

      function createPagination() {
          for (let i = 1; i <= pageCount; i++) {
              const pageLink = document.createElement("button");
              pageLink.classList.add("page-link");
              pageLink.dataset.page = i;
              pageLink.textContent = i;
              pageLink.addEventListener("click", function () {
                  displayPage(i);
              });
              paginationContainer.appendChild(pageLink);
          }
      }

      createPagination();
      displayPage(1);
  });
</script>
</body>
</html>
