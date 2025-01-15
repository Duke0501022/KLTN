<?php
// include_once("controller/Import/cImport.php");
// $cImport = new cImport();
// $cImport->ImportController();
?>
<!-- <div class="content-wrapper">
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
                            <h3 class="card-title">Danh sách câu hỏi</h3> | <a href="index.php?addcauhoi">Thêm câu hỏi</a> | <a href="index.php?import">Import câu hỏi</a>
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
                        <div class="card-body">
                            <h2>Import Data</h2>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file" name="file">
                                <input type="submit" name="save" value="Import">
                            </form>
                            <?php
                            // Hiển thị thông báo sau khi import dữ liệu
                            // if (isset($importResult)) {
                            //     if ($importResult == 1) {
                            //         echo '<div class="alert alert-success" role="alert">Dữ liệu đã nhập thành công!</div>';
                            //     } else {
                            //         echo '<div class="alert alert-danger" role="alert">Có lỗi xảy ra khi nhập dữ liệu!</div>';
                            //     }
                            // }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
 -->
<?php
include_once("controller/Import/cImport.php");
$cImport = new cImport();
$importResult = $cImport->ImportController(); // Assuming ImportController returns import result
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý CHATBOT</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý CHATBOT</li>
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
                            <h3 class="card-title">Danh sách chatbot</h3> | <a href="index.php?addcb">Thêm chatbot</a> | <a href="index.php?import">Import chatbot</a>
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
                        <div class="card-body">
                            <h2>Import Data</h2>
                            <form action="process_import.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="file">
                                <input type="submit" name="save" value="Import">
                            </form>
                            <?php
                            // Hiển thị thông báo sau khi import dữ liệu
                            if (isset($importResult)) {
                                if ($importResult == 1) {
                                    echo '<div class="alert alert-success" role="alert">Dữ liệu đã nhập thành công!</div>';
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">Có lỗi xảy ra khi nhập dữ liệu!</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>