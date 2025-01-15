<?php
include_once("controller/LSTV/cLSTV.php");

$p = new cLSTV;

$wait = 3; // Giả sử 0 là trạng thái chờ duyệt
$list_cauhoi  = $p->get_lichwait($wait);




?>
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
</style>

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
                            <h3 class="card-title">Danh sách chờ duyệt huỷ tư vấn</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <form action="" method="post">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; width: 5%;">STT</th>
                                           
                                            <th style="text-align:center; width: 20%;">Vấn Đề Cần Tư Vấn</th>
                                            <th style="text-align:center; width: 20%;">Phụ Huynh</th>
                                            <th style="text-align:center; width: 10%;">Chuyên Viên</th>
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
                                                   
                                                    <td style="text-align:center;"><?php echo $item['describe_problem'] ?></td>
                                                    <td style="text-align:center;"><?php echo $item['hoTenPH'] ?></td>
                                                    <td style="text-align:center;"><?php echo $item['hoTen'] ?></td>
                                                    <td style="text-align:center;"><input type="checkbox" name="idCauHoi[]" value="<?php echo $item['id_datlich'] ?>"></td>
                                                   <td style="text-align:center;"> <button class="btn btn-success"><a href="?uptuvan&id_datlich=<?php echo $item['id_datlich'] ?>" style="color: #fff;">Khôi phục lịch</a></button></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                </table>
                                
                                <input type="submit" value="Duyệt huỷ lịch" name="btn_duyet" class="btn btn-primary">
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

<?php

if (isset($_POST['btn_duyet'])) {
    if (isset($_POST['idCauHoi'])) {
        $idDatLich = $_POST['idCauHoi'];
        if (!empty($idDatLich)) {
            $p->AcceptLich($idDatLich);
            echo '<script>alert("Duyệt thành công")</script>';
            echo "<script>window.location.href='?qltv'</script>";
        } else {
            echo '<script>alert("Chưa chọn lịch để duyệt")</script>';
        }
    } else {
        echo '<script>alert("Chưa chọn lịch để duyệt")</script>';
    }
}
?>