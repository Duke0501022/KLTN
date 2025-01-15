<?php 
include_once("controller/CauHoi/cCauHoi.php");

$p = new cCauHoi();
$wait = 1;
$table = $p->select_cauhoiwait($wait);
$list_duyet = $p->getAllCHWait(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Câu Hỏi</title>
    <!-- Include necessary styles and scripts here -->
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
    .modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 800px;
  border-radius: 8px;
  position: relative;
}

.close {
  position: absolute;
  right: 20px;
  top: 10px;
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.info-row {
  margin-bottom: 15px;
  border-bottom: 1px solid #eee;
  padding-bottom: 10px;
}

.info-row label {
  font-weight: bold;
  color: #333;
  display: block;
  margin-bottom: 5px;
}

.info-row p {
  margin: 0;
  color: #666;
}

.view-detail-btn {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.view-detail-btn:hover {
  background-color: #0056b3;
}
    </style>
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý Câu Hỏi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý Câu Hỏi</li>
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
                <h3 class="card-title">Danh sách câu hỏi</h3>  | <a href="index.php?addcauhoi">Thêm câu hỏi</a> | <button  class="btn btn-primary"><a href="?duyetcauhoi" style="color: #fff;">Duyệt câu hỏi</a></button>
            <?php if(!empty($list_duyet)){ ?>
              <span class="text-danger duyet">Có <?php echo count($list_duyet); ?> Câu hỏi cần duyệt</span>

           <?php }else { ?>
            <span>Không có câu hỏi cần duyệt</span>
            <?php } ?>   
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
                <table id="questionsTable" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>STT</th>
                      <th>Câu Hỏi</th>
                      <th>Hình Ảnh</th>
                      <div id="questionModal" class="modal">
                        <div class="modal-content">
                          <span class="close">&times;</span>
                          <h2>Chi tiết câu hỏi</h2>
                          <div class="modal-body">
                            <div class="info-row">
                              <label>Câu hỏi:</label>
                              <p id="modalCauHoi"></p>
                            </div>
                            <div class="info-row">
                              <label>Hình ảnh:</label>
                              <img id="modalHinhAnh" src="" alt="Hình ảnh câu hỏi" height="200">
                            </div>
                            <div class="info-row">
                              <label>Câu trả lời 1:</label>
                              <p id="modalCau1"></p>
                            </div>
                            <div class="info-row">
                              <label>Câu trả lời 2:</label>
                              <p id="modalCau2"></p>
                            </div>
                            <div class="info-row">
                              <label>Câu trả lời 3:</label>
                              <p id="modalCau3"></p>
                            </div>
                            <div class="info-row">
                              <label>Lĩnh vực:</label>
                              <p id="modalLinhVuc"></p>
                            </div>
                            <div class="info-row">
                              <label>Unit:</label>
                              <p id="modalUnit"></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <th>Lĩnh vực</th>
                      <th>Unit</th>
                      
                      <th style="text-align:center">Tác vụ</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                   if($table){
                    $i = 1;
                    if(mysqli_num_rows($table) > 0){
                        while($row = mysqli_fetch_assoc($table)) {
                            echo "<tr>";
                            echo "<td>" .$i++.  "</td>";
                            echo "<td class='cauHoi'>".$row['cauHoi']."</td>";
                            echo "<td><a href='" . ($row['hinhAnh'] ? 'admin/assets/uploads/images/' . $row['hinhAnh'] : 'admin/assets/uploads/images/user.png') . "' class='popup-link'><img class='rounded-image' src='" . ($row['hinhAnh'] ? 'admin/assets/uploads/images/' . $row['hinhAnh'] : 'admin/assets/uploads/images/user.png') . "' alt='' height='100px' width='150px'></a></td>";
                            // Lưu các câu trả lời vào data attributes
                            echo "<td class='tenLinhVuc'>".$row['tenLinhVuc']."</td>";
                            echo "<td class='tenUnit'>".$row['tenUnit']."</td>";
                            
                            // Thêm data attributes để lưu các câu trả lời
                            echo "<td style='text-align:center'>
                                    <a href='?updatecauhoi&idcauHoi=".$row['idcauHoi']."'><i class='fa fa-pen' aria-hidden='true'></i></a> | 
                                    <a href='?delch&idcauHoi=".$row['idcauHoi']."' onclick='return confirm(\"Bạn chắc chắn muốn xóa chứ?\")'><i class='fa fa-trash' aria-hidden='true'></i></a>
                                    
                                  </td>";
                           
                             echo "<td style='text-align:center'>
                            <button class='view-detail-btn' 
                                            data-cau1='".$row['cau1']."'
                                            data-cau2='".$row['cau2']."'
                                            data-cau3='".$row['cau3']."'>
                                        Xem chi tiết
                                    </button>
                                         </td>";
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Add this at the bottom of your page, before the closing </body> tag -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;
    const table = document.querySelector("#questionsTable tbody");
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
  <script>
// Get modal elements first
const modal = document.getElementById("questionModal");
const span = document.getElementsByClassName("close")[0];

document.querySelectorAll(".view-detail-btn").forEach(button => {
    button.addEventListener("click", function() {
        const row = this.closest("tr");
        
        // Get data from row and data attributes
        const cauHoi = row.querySelector(".cauHoi").textContent;
        const hinhAnh = row.querySelector("img").src;
        const cau1 = this.getAttribute("data-cau1");
        const cau2 = this.getAttribute("data-cau2");
        const cau3 = this.getAttribute("data-cau3");
        const linhVuc = row.querySelector(".tenLinhVuc").textContent;
        const unit = row.querySelector(".tenUnit").textContent;

        // Update modal content
        document.getElementById("modalCauHoi").textContent = cauHoi;
        document.getElementById("modalHinhAnh").src = hinhAnh;
        document.getElementById("modalCau1").textContent = cau1;
        document.getElementById("modalCau2").textContent = cau2;
        document.getElementById("modalCau3").textContent = cau3;
        document.getElementById("modalLinhVuc").textContent = linhVuc;
        document.getElementById("modalUnit").textContent = unit;

        // Show modal
        modal.style.display = "block";
    });
});

// Close modal when clicking on X
span.onclick = function() {
    modal.style.display = "none";
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>