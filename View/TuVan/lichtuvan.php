<?php
require_once("Controller/LSTV/cLichSuTuVan.php");
require_once("Controller/KhachHangDoanhNghiep/cKhachHangDoanhNghiep.php");

$c = new cKHDN();
if (!isset($_SESSION['LoginSuccess']) || $_SESSION['LoginSuccess'] !== true) {
    header('Location: index.php?login');
    exit();
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $idPhuHuynh = $_SESSION['idPhuHuynh'] ?? null;
} else {
    $username = null;
    $idPhuHuynh = null;
}

$check = isset($_GET['check']) ? $_GET['check'] : null;
$payment_status = isset($_GET['payment_status']) ? $_GET['payment_status'] : null;
$p = new cLSTV();
$appointments = $p->getLichTVbyIDPH($idPhuHuynh, $username, $check, $payment_status);

if (isset($_GET['deleteAppointment'])) {
    $idDatLich = $_GET['deleteAppointment'];
    $result = $p->get_deldatlich($idDatLich);
    if ($result === true) {
        echo "<script>alert('Đã huỷ đặt lịch.'); window.location.href='index.php?xemlichtuvan';</script>";
    } else {
        echo "<script>alert('Error: $result'); window.location.href='index.php?xemlichtuvan';</script>";
    }
}

// Gọi hàm cancelUnpaidAppointments để hủy các cuộc hẹn chưa thanh toán sau 2 phút

$p->cancelUnpaidAppointments();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Tư Vấn</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
     .calendar {
        margin-top: 50px;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .btn-primary, .btn-danger, .btn-success {
        margin-right: 10px;
    }

    .badge {
        font-size: 10px;
    }

    .modal-body {
        text-align: center;
    }

    .modal-footer .btn {
        padding: 10px 20px;
        border-radius: 5px;
    }

    .container {
        max-width: 1200px;
    }

    .card {
        margin-bottom: 20px;
    }

    .table td, .table th {
        padding: 1rem;
        font-weight: bold;
    }

    .modal-content {
        padding: 20px;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-footer {
        border-top: none;
    }

    .btn-close {
        margin: -1rem -1rem -1rem auto;
    }

    .pagination {
        justify-content: center;
    }

        /* Modal Styles */
        
        .info-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .info-group label {
            min-width: 150px;
            margin-bottom: 0;
        }

        .info-group span {
            padding: 5px 10px;
            background-color: white;
            border-radius: 5px;
            border: 1px solid #dee2e6;
            flex-grow: 1;
        }

        .pdf-viewer {
            margin-top: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            overflow: hidden;
        }

     
     

       
    </style>
   

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <br>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Lịch tư vấn</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-3">
                            <a href="index.php?xemlichtuvan" class="btn btn-primary">Tất cả</a>
                            <a href="index.php?xemlichtuvan&check=0" class="btn btn-danger">Chưa tư vấn</a>
                            <a href="index.php?xemlichtuvan&check=1" class="btn btn-success">Đã tư vấn</a>
                            <a href="index.php?xemlichtuvan&payment_status=Unpaid" class="btn btn-danger">Chưa Thanh Toán</a>
                            <a href="index.php?xemlichtuvan&payment_status=Paid" class="btn btn-success">Đã Thanh Toán</a>
                            <br>
                            <br>
                            
                            <table class="table table-striped table-hover table-bordered" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th><span>Thời gian khám</span></th>
                                        <th>Lịch khám</th>
                                    </tr>
                                </thead>
                                <tbody id="appointmentTableBody">
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                <ul class="pagination" id="pagination"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="appointmentModalLabel">Chi tiết lịch tư vấn</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="appointment-details p-3">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Thông tin lịch hẹn</h6>
                            <div class="info-group mb-2">
                                <label class="fw-bold">Ngày khám:</label>
                                <span id="modalDate"></span>
                            </div>
                            <div class="info-group mb-2">
                                <label class="fw-bold">Giờ khám:</label>
                                <span id="modalTime"></span>
                            </div>
                            <div class="info-group mb-2">
                                <label class="fw-bold">Phòng khám:</label>
                                <span id="modalRoom"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Thông tin chuyên viên</h6>
                            <div class="info-group mb-2">
                                <label class="fw-bold">Tên chuyên viên:</label>
                                <span id="modalDoctor"></span>
                            </div>
                            <div class="info-group mb-2">
                                <label class="fw-bold">Trạng thái tư vấn:</label>
                                <span id="modalStatus"></span>
                            </div>
                            <div class="info-group mb-2">
                                <label class="fw-bold">Trạng thái thanh toán:</label>
                                <span id="modalPayment"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">Tài liệu đính kèm</h6>
                            <div class="pdf-viewer">
                                <iframe id="pdfViewer" width="100%" height="500px" style="border: none;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a id="downloadPdf" href="#" target="_blank" class="btn btn-primary">
                    <i class="bi bi-download"></i> Tải PDF
                </a>
            </div>
        </div>
    </div>
</div>
    <?php
// In your PHP code
if (!empty($unpaidAppointments)) {
    $appointmentInfo = '';
    foreach ($unpaidAppointments as $apt) {
        $appointmentInfo .= "Ngày: {$apt['date']}<br>Giờ: {$apt['hour']}<br>";
    }
    
    echo "<script>
    Swal.fire({
        title: 'Thông báo đặt lịch!',
        html: `
            <div class='text-left'>
                <p><strong>Chi tiết lịch hẹn chưa thanh toán:</strong></p>
                {$appointmentInfo}
                <p>Vui lòng thanh toán trong vòng <span id='countdown'>02:00</span></p>
                <p>Lịch hẹn sẽ tự động hủy sau khi hết thời gian</p>
            </div>
        `,
        icon: 'warning',
        timer: 120000,
        timerProgressBar: true,
        showConfirmButton: true,
        confirmButtonText: 'Đã hiểu',
        allowOutsideClick: false
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            window.location.reload();
        }
    });

    // Countdown timer
    let timeLeft = 120;
    const countdownEl = document.getElementById('countdown');
    const timer = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        countdownEl.innerHTML = minutes.toString().padStart(2, '0') + ':' + 
                               seconds.toString().padStart(2, '0');
        if (timeLeft <= 0) {
            clearInterval(timer);
        }
        timeLeft--;
    }, 1000);
    </script>";
}
?>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const appointments = <?php echo json_encode($appointments); ?>;
        const recordsPerPage = 5;
        let currentPage = 1;

        function displayPage(page) {
            const start = (page - 1) * recordsPerPage;
            const end = start + recordsPerPage;
            const paginatedItems = appointments.slice(start, end);

            const tableBody = document.getElementById('appointmentTableBody');
            tableBody.innerHTML = '';

            if (paginatedItems.length > 0) {
                paginatedItems.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${new Date(item.date).toLocaleDateString('vi-VN')}</td>
                        <td>
                            <div class="container p-2 bg-body shadow-lg p-3 mb-5 bg-body rounded">
                                <div class="border-bottom mb-3">
                                    ${item.check == 1 ? 
                                        `<span class="badge bg-success mb-3 p-1"><i class="bi bi-check-circle m-1"></i>Đã khám</span>` : 
                                        `<span class="badge bg-danger mb-3 p-1"><i class="bi bi-exclamation-circle m-1"></i>Chưa khám</span>`
                                    }
                                    ${item.payment_status == 'Paid' ? 
                                        `<span class="badge bg-success mb-3 p-1"><i class="bi bi-check-circle m-1"></i>Đã thanh toán</span>` : 
                                        `<span class="badge bg-danger mb-3 p-1"><i class="bi bi-exclamation-circle m-1"></i>Chưa thanh toán</span>`
                                    }
                                    ${item.check == 0 ? 
                                        `<button type="button" class="btn btn-danger rounded-1 float-end" onclick="confirmDelete(${item.id_datlich})">
                                            <i class="bi bi-trash"></i> Hủy lịch
                                        </button>` : ''
                                    }
                                    ${item.payment_status == 'Unpaid' ? 
                                        `<button type="button" class="btn btn-warning rounded-1 float-end me-2" onclick="window.location.href='View/order.php?id_datlich=${item.id_datlich}'">
                                            <i class="bi bi-credit-card"></i> Thanh Toán
                                        </button>` : ''
                                    }
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Chuyên viên</th>
                                            <th>Giờ khám</th>
                                            <th>Chi tiết</th>
                                            <th>Phòng khám</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-info">
                                            <td>${item.hoTen}</td>
                                            <td>${new Date('1970-01-01T' + item.appointmentHour).toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' })}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning rounded-1" 
                                                    onclick="showAppointmentModal(this)" 
                                                    data-appointment='${JSON.stringify(item)}'>
                                                    <i class="bi bi-eye"></i> Xem
                                                </button>
                                            </td>
                                            <td>A 04</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>`;
                    tableBody.appendChild(row);
                });
            } else {
                tableBody.innerHTML = `<tr><td colspan="2" class="text-center">Không có lịch tư vấn</td></tr>`;
            }
        }
        
        function setupPagination() {
            const totalPages = Math.ceil(appointments.length / recordsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const pageItem = document.createElement('li');
                pageItem.className = `page-item ${currentPage === i ? 'active' : ''}`;
                pageItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                pagination.appendChild(pageItem);
            }
        }

        function changePage(page) {
            currentPage = page;
            displayPage(page);
            setupPagination();
        }

        function confirmDelete(id) {
            if (confirm('Bạn có chắc chắn muốn hủy lịch hẹn này không?')) {
                window.location.href = `index.php?xemlichtuvan&deleteAppointment=${id}`;
            }
        }

        function showAppointmentModal(button) {
    const appointmentData = JSON.parse(button.getAttribute('data-appointment'));
    const idPhuHuynh = <?php echo json_encode($_SESSION['idPhuHuynh']); ?>;
    
    // Cập nhật thông tin trong modal
    document.getElementById('modalDate').textContent = new Date(appointmentData.date).toLocaleDateString('vi-VN');
    document.getElementById('modalTime').textContent = new Date('1970-01-01T' + appointmentData.appointmentHour).toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
    document.getElementById('modalRoom').textContent = 'A 04';
    document.getElementById('modalDoctor').textContent = appointmentData.hoTen;
    
    // Cập nhật trạng thái tư vấn
    const statusBadge = appointmentData.check == 1 
        ? '<span class="badge bg-success">Đã khám</span>'
        : '<span class="badge bg-danger">Chưa khám</span>';
    document.getElementById('modalStatus').innerHTML = statusBadge;
    
    // Cập nhật trạng thái thanh toán
    const paymentBadge = appointmentData.payment_status == 'Paid'
        ? '<span class="badge bg-success">Đã thanh toán</span>'
        : '<span class="badge bg-danger">Chưa thanh toán</span>';
    document.getElementById('modalPayment').innerHTML = paymentBadge;

    // Cập nhật src của iframe PDF và link tải
    const pdfUrl = `View/TuVan/listAppointmentPDF.php?id_datlich=${appointmentData.id_datlich}`;
    document.getElementById('pdfViewer').src = pdfUrl;
    document.getElementById('downloadPdf').href = pdfUrl;
            
    // Hiển thị modal
    const modal = new bootstrap.Modal(document.getElementById('appointmentModal'));
    modal.show();
}
    
        // Thêm event listener cho sự kiện load trang
        window.addEventListener('load', function() {
            setupPagination();
            displayPage(currentPage);

            // Thêm event listener cho modal
            const appointmentModal = document.getElementById('appointmentModal');
            appointmentModal.addEventListener('hidden.bs.modal', function () {
                document.getElementById('pdfViewer').src = '';
            });
        });

        // Thêm function refresh dữ liệu
        function refreshAppointments() {
            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newAppointments = JSON.parse(doc.getElementById('appointments-data').textContent);
                    appointments.length = 0;
                    appointments.push(...newAppointments);
                    currentPage = 1;
                    setupPagination();
                    displayPage(currentPage);
                })
                .catch(error => console.error('Error refreshing appointments:', error));
        }
        

        // Optional: Tự động refresh sau mỗi 5 phút
        setInterval(refreshAppointments, 300000);
    </script>
    <script>
document.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default behavior
    console.log('Close button clicked');
    let modal = bootstrap.Modal.getInstance(document.getElementById('appointmentModal'));
    modal.hide();
});
</script>
</body>
</html>