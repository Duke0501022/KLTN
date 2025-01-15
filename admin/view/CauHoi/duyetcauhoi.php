<?php
include_once("controller/CauHoi/cCauHoi.php");

$p = new cCauHoi;

$wait = 0; // Giả sử 0 là trạng thái chờ duyệt
$list_cauhoi  = $p->select_cauhoiwait($wait);




?>
<!-- Thêm vào phần header của trang -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    /* Improved styling for rounded images */
    .rounded-image {
        border-radius: 8px; /* Slightly smaller border radius for a cleaner look */
        object-fit: cover; /* Ensures the image fits well within the container */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition effects */
    }

    .rounded-image:hover {
        transform: scale(1.05); /* Slight zoom effect on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds shadow to make the image stand out */
    }

    /* Improved styling for the search form */
    .search-form {
        display: flex;
        justify-content: flex-end; /* Aligns the form to the right */
        align-items: center;
        margin-bottom: 20px; /* Adds more space below the form */
    }

    .search-form input[type="text"] {
        width: 220px; /* Slightly wider input field */
        padding: 8px 12px; /* Adds more padding inside the input */
        border: 1px solid #ced4da; /* Light grey border */
        border-radius: 6px; /* Slightly larger border radius for a modern look */
        margin-right: 10px; /* Space between input field and button */
        font-size: 14px; /* Increases font size for better readability */
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for focus effects */
    }

    .search-form input[type="text"]:focus {
        border-color: #007bff; /* Blue border color on focus */
        outline: none; /* Removes the default outline */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Adds a subtle shadow */
    }

    .search-form button {
        padding: 8px 16px; /* Increases padding for a more button-like appearance */
        background-color: #007bff; /* Blue background color */
        color: white; /* White text color */
        border: none; /* Removes default border */
        border-radius: 6px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        font-size: 14px; /* Increases font size for better readability */
        transition: background-color 0.3s ease; /* Smooth transition for hover effect */
    }

    .search-form button:hover {
        background-color: #0056b3; /* Darker blue background on hover */
    }

    /* General table styling */
    .table {
        width: 100%; /* Full width table */
        margin: 20px 0; /* Adds margin for spacing */
        border-collapse: collapse; /* Collapses table borders */
    }

    .table th, .table td {
        padding: 12px; /* Adds padding inside table cells */
        text-align: center; /* Centers text in table cells */
        border-bottom: 1px solid #dee2e6; /* Light grey border for rows */
    }

    .table th {
        background-color: #f8f9fa; /* Light grey background for header cells */
        font-weight: bold; /* Makes header text bold */
    }

    .table tr:hover {
        background-color: #f1f1f1; /* Light grey background on row hover */
    }

    .btn-secondary a {
        color: #fff;
        text-decoration: none;
    }

    .btn-secondary a:hover {
        text-decoration: underline;
    }

    .breadcrumb {
        background: none;
        padding: 0;
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
    .modal-dialog {
    max-width: 800px;
}

.btn-view-details {
    padding: 6px 12px;
    transition: all 0.3s ease;
}

.btn-view-details:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.modal-body img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.modal-body p {
    margin-bottom: 10px;
    line-height: 1.5;
}

.modal-body strong {
    color: #333;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Duyệt Câu Hỏi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
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
                            <h3 class="card-title">Danh sách câu hỏi chờ duyệt</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <form action="" method="post">
                            <table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th style="text-align:center; width: 5%;">STT</th>
            <th style="text-align:center; width: 20%;">Câu Hỏi</th>
            <th style="text-align:center; width: 10%;">Hình Ảnh</th>
            <th style="text-align:center; width: 10%;">Xem chi tiết</th>
            <th style="text-align:center; width: 10%;">Duyệt</th>
            <th style="text-align:center; width: 10%;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (!empty($list_cauhoi)) {
            foreach ($list_cauhoi as $item) { ?>
                <tr>
                    <th scope="row" style="text-align:center;"><?php echo  $i++ ?></th>
                    <td style="text-align:center;"><?php echo $item['cauHoi'] ?></td>
                    <td style="text-align:center;">
                        <img src="admin/assets/uploads/images/<?php echo $item['hinhAnh'] ?>" alt="Hình ảnh" class="rounded-image" style="width: 100px; height: 100px;">
                    </td>
                    <td style="text-align:center;">
                        <button type="button" class="btn btn-info btn-view-details" data-toggle="modal" data-target="#detailModal<?php echo $item['idcauHoi']; ?>">
                            Xem chi tiết
                        </button>
                    </td>
                    <td style="text-align:center;"><input type="checkbox" name="idCauHoi[]" value="<?php echo $item['idcauHoi'] ?>"></td>
                    <td style="text-align:center;">
                        <button class="btn btn-secondary">
                            <a href="?delch&&idcauHoi=<?php echo $item['idcauHoi'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a>
                        </button>
                    </td>
                </tr>

                <!-- Modal cho mỗi câu hỏi -->
                <div class="modal fade" id="detailModal<?php echo $item['idcauHoi']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Chi tiết câu hỏi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Câu hỏi:</strong> <?php echo $item['cauHoi']; ?></p>
                                        <p><strong>Đáp án 1:</strong> <?php echo $item['cau1']; ?></p>
                                        <p><strong>Đáp án 2:</strong> <?php echo $item['cau2']; ?></p>
                                        <p><strong>Đáp án 3:</strong> <?php echo $item['cau3']; ?></p>
                                        <p><strong>Lĩnh vực:</strong> <?php echo $item['tenLinhVuc']; ?></p>
                                        <p><strong>Unit:</strong> <?php echo $item['tenUnit']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Hình ảnh:</strong></p>
                                        <?php if($item['hinhAnh']): ?>
                                            <img src="admin/assets/uploads/images/<?php echo $item['hinhAnh']; ?>" 
                                                 alt="Hình ảnh câu hỏi" 
                                                 class="img-fluid rounded">
                                        <?php else: ?>
                                            <p>Không có hình ảnh</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
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
                                <input type="submit" value="Duyệt câu hỏi" name="btn_duyet" class="btn btn-primary">
                            </form>
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
<!-- Modal -->

<?php

if (isset($_POST['btn_duyet'])) {
    if (isset($_POST['idCauHoi'])) {
        $idCauHoi = $_POST['idCauHoi'];
        if (!empty($idCauHoi)) {
            $p->AcceptCauHoi($idCauHoi);
            echo '<script>alert("Duyệt thành công")</script>';
            echo "<script>window.location.href='?qlbt'</script>";
        } else {
            echo '<script>alert("Chưa chọn câu hỏi để duyệt")</script>';
        }
    } else {
        echo '<script>alert("Chưa chọn câu hỏi để duyệt")</script>';
    }
}
?>
<script>
$(document).ready(function() {
    $('.btn-view-details').on('click', function() {
        var targetModal = $(this).data('target');
        $(targetModal).modal('show');
    });
});
</script>