<?php 

include_once("controller/LinhVuc/cLinhVuc.php");

$p = new cLinhVuc();

$table = $p->get_LinhVuc();
$list_p = $p->getunit();

?>
<style>
    /* Bo góc và hiệu ứng hover cho hình ảnh */
    .thumbnail {
        overflow: hidden;
        width: 150px; /* Độ rộng của hình ảnh */
        height: 100px; /* Độ cao của hình ảnh */
        border-radius: 5px;
    }

    .thumbnail img {
        width: 100%; /* Đảm bảo hình ảnh chiếm toàn bộ không gian của phần tử cha */
        height: auto; /* Đảm bảo tỷ lệ chiều cao phù hợp */
        transition: transform 0.3s ease;
    }

    /* Hiệu ứng hover */
    .thumbnail img:hover {
        transform: scale(1.05);
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lý Lĩnh Vực</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý Lĩnh Vực</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <style>
 @keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-5px);
  }
  60% {
    transform: translateY(-3px);
  }
}

.duyet {
  display: inline-block;
  animation: bounce 1s infinite;
}

</style>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
               <button  class="btn btn-primary"><a href="?addlv" style="color: #fff;">Thêm Lĩnh Vực mới</a></button> 
         
              
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
              <table id="newsTable" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th style="text-align:center">STT</th>
                    <th style="text-align:center">Tên Lĩnh Vực</th>
                     <th style="text-align:center">Tên Unit</th>
                    <th style="text-align:center">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php
                    if ($table) {
                      $stt = 1;
                      if (mysqli_num_rows($table) > 0) {
                        while ($row = mysqli_fetch_assoc($table)) {
                          echo "<tr>";
                          echo "<td style='text-align:center'>" . $stt++ . "</td>"; // Tăng giá trị của biến đếm và hiển thị nó
                          echo "<td style='text-align:center'>" . $row['tenLinhVuc'] . "</td>";
               
                          $tenUnit = 'N/A';
                          foreach ($list_p as $unit) {
                            if ($unit['idUnit'] == $row['idUnit']) {
                              $tenUnit = $unit['tenUnit'];
                              break;
                            }
                          }
                          echo "<td style='text-align:center'>" . $tenUnit . "</td>";
                          echo "<td style='text-align:center'><a href='?uplv&&idLinhVuc=".$row['idLinhVuc']."'><i class='fa fa-pen' aria-hidden='true'></i></a> | <a href='?dellv&&idLinhVuc=".$row['idLinhVuc']."' onclick='return confirm_delete();'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                          
                          echo "</tr>";

                          // Modal
                          
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
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
function confirm_delete() {
  return confirm('Bạn có chắc chắn muốn xóa?');
}

document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;
    const table = document.querySelector("#newsTable tbody");
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