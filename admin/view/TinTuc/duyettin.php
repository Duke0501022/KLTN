<?php
include_once("controller/TinTuc/cTinTuc.php");
include_once("Controller/ThongBao/cThongBao.php");
$p = new cloaibaiviet;

$wait = 0;
$list_monan  = $p->select_tintucwait($wait);

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

        /* Đảm bảo bảng không bị kéo ngang */
        .table-responsive {
            overflow-x: auto;
        }

        .content-wrapper {
            overflow: hidden; /* Ngăn chặn cuộn ngang cho toàn bộ wrapper */
        }
    </style>

<body>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Duyệt Tin Tức</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Duyệt Tin Tức</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách tin tức</h3>  | <a href="?qltt">Tin đã duyệt</a>
              
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
            <div class="card-body table-responsive">
              <form action="" method="post">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th style="text-align:center; width: 5%;">STT</th>
                      <th style="text-align:center; width: 20%;">Tiêu Đề</th>
                      <th style="text-align:center; width: 15%;">Hình Ảnh</th>
                      <th style="text-align:center; width: 10%;">Danh mục</th>
                      <th style="text-align:center; width: 10%;">Nội dung</th>
                      <th style="text-align:center; width: 10%;">Duyệt</th>
                      <th style="text-align:center; width: 10%;">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    if (!empty($list_monan)) {
                      foreach ($list_monan as $item) { ?>
                        <tr>
                          <th scope="row" style="text-align:center;"><?php echo  $i++ ?></th>
                          <td style="text-align:center;"><?php echo $item['tieuDe'] ?></td>
                          <td style="text-align:center;"><img class="thumbnail" src="admin/assets/uploads/images/<?php echo $item['hinhAnh'] ?>" alt=""></td>
                          <td style="text-align:center;"><?php echo $item['idDanhMuc'] ?></td>
                          <td style="text-align:center;">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#contentModal<?php echo $item['idTinTuc']; ?>">
                              Xem
                            </button>
                          </td>
                          <td style="text-align:center;">
                            <input type="checkbox" name="idTinTuc[]" value="<?php echo $item['idTinTuc'] ?>">
                            <input type="hidden" name="tieuDe[<?php echo $item['idTinTuc'] ?>]" value="<?php echo $item['tieuDe'] ?>">
                          </td>
                          <td style="text-align:center;">
                            <button class="btn btn-secondary">
                              <a href="?deltintuc&idTinTuc=<?php echo $item['idTinTuc'] ?>" style="color: #fff;" onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a>
                            </button>
                          </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="contentModal<?php echo $item['idTinTuc']; ?>" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel<?php echo $item['idTinTuc']; ?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="contentModalLabel<?php echo $item['idTinTuc']; ?>">Nội dung chi tiết</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <?php echo $item['noiDung']; ?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php }
                    } ?>
                  </tbody>
                </table>
                <input type="submit" value="Duyệt tin tức" name="btn_duyet" class="btn btn-primary">
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>

<?php

if(isset($_POST['btn_duyet'])){
  if (isset($_POST['idTinTuc'])) {
    $idTinTuc = $_POST['idTinTuc'];
    if(!empty($idTinTuc)){
      $p->AcceptDish($idTinTuc);
      
      // Use the actual title from the submitted data
      $tieuDe = $_POST['tieuDe'][$idTinTuc[0]];
      
      $thongBaoModel = new thongBaoModel();
      $customers = $thongBaoModel->getAllCustomers();
      $thoiGian = date("Y-m-d H:i:s");
      
      if($customers) {
        foreach ($customers as $customer) {
          $result = $thongBaoModel->createNotification(
            $customer['username'],
            "Tin tức mới vừa được đăng: " . $tieuDe,
            $thoiGian
          );
          
          // Check if notification was successfully created
          if (!$result) {
            echo '<script>alert("Lỗi khi tạo thông báo")</script>';
            break;
          }
        }
        echo '<script>alert("Duyệt thành công")</script>';
        echo "<script>window.location.href='?qltt'</script>";
      } else {
        echo '<script>alert("Lỗi khi lấy danh sách người dùng")</script>';
      }
    } else {
      echo '<script>alert("Chưa chọn tin tức để duyệt")</script>';
    }
  } else {
    echo '<script>alert("Chưa chọn tin tức để duyệt")</script>'; 
  }
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
