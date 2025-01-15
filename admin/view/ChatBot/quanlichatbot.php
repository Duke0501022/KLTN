<?php
include_once("controller/ChatBot/cChatbot.php");

$p = new cChatbot();
$table = $p->select_chatbot();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Chatbot</title>
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
                    <h1>Quản lý CHAT BOT</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý CHATBOT</li>
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
                            <h3 class="card-title">Danh sách chatbot</h3> | <a href="index.php?addcb">Thêm chat bot</a> | 
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
                            <table id="chatbotTable" class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th class="border-bottom-header">STT</th>
                                    <th class="border-bottom-header">Câu hỏi</th>
                                    <th style="text-align:center">Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($table) {
                                    $i = 1;
                                    if (mysqli_num_rows($table) > 0) {
                                        while ($row = mysqli_fetch_assoc($table)) {
                                            echo "<tr>";
                                            echo "<td>" . $i++ . "</td>";
                                            echo "<td>" . $row['query'] . "</td>";
                                            echo "<td style='text-align:center'><button type='button' class='btn btn-info view-details' data-query='" . $row['query'] . "' data-answer='" . htmlspecialchars($row['answer'], ENT_QUOTES) . "'>Xem chi tiết</button> | <a href='?updatecb&&idChatBot=" . $row['idChatBot'] . "'><i class='fa fa-pen' aria-hidden='true'></i></a> | <a href='?delcb&&idChatBot=" . $row['idChatBot'] . "'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal for displaying chatbot details -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Chi tiết Chatbot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="modal-query">Câu hỏi</label>
                    <input type="text" class="form-control" id="modal-query" readonly>
                </div>
                <div class="form-group">
                    <label for="modal-answer">Trả lời</label>
                    <textarea class="form-control" id="modal-answer" rows="5" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;
    const table = document.querySelector("#chatbotTable tbody");
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

    // Modal functionality
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function () {
            const query = this.getAttribute('data-query');
            const answer = this.getAttribute('data-answer');
            document.getElementById('modal-query').value = query;
            document.getElementById('modal-answer').value = answer;
            $('#detailsModal').modal('show');
        });
    });
});
</script>
</body>
</html>
