<?php
require '../vendor/autoload.php';

use Pusher\Pusher;

include_once("../Controller/Datlich1/cDatlich1.php");

session_start();


$controller = new AppointmentController1();
$appointment = [];

// Bắt đầu session nếu chưa bắt đầu

$today = new DateTime(date('Y-m-d'));
$selectedDate = isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day']) 
    ? new DateTime("{$_GET['year']}-{$_GET['month']}-{$_GET['day']}") 
    : null;

if ($selectedDate && $selectedDate < $today) {
    echo "<script>
        alert('Không thể đặt lịch cho ngày đã qua. Vui lòng chọn ngày khác.');
        window.location.href = 'AppointmentDetail.php';
    </script>";
    exit;
}
$showForm = true; // Biến để kiểm soát việc hiển thị form

if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {
    $date = "{$_GET['year']}-{$_GET['month']}-{$_GET['day']}";
    $dayOfWeek = date('N', strtotime($date)); // Lấy ngày trong tuần (1 = Thứ 2, 7 = Chủ nhật)

    if ($dayOfWeek == 6 || $dayOfWeek == 7) {
        echo "<script>alert('Không thể đăng ký lịch vào thứ 7 và chủ nhật.');</script>";
        $showForm = false; // Không hiển thị form nếu là cuối tuần
    } else {
        $appointment = $controller->listAppointments1($date);
    }
}

$errorMessages = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = isset($_POST['date']) ? $_POST['date'] : null;
    $hour = isset($_POST['hour']) ? $_POST['hour'] : null;
    $idChuyenVien = isset($_POST['idChuyenVien']) ? $_POST['idChuyenVien'] : null;
    $idPhuHuynh = isset($_SESSION['idPhuHuynh']) ? $_SESSION['idPhuHuynh'] : null;

    if (!$date) {
        $errorMessages[] = 'Vui lòng chọn ngày.';
    }
    if (!$hour) {
        $errorMessages[] = 'Vui lòng chọn giờ.';
    }
    if (!$idChuyenVien) {
        $errorMessages[] = 'Thiếu thông tin chuyên viên.';
    }
    if (!$idPhuHuynh) {
        $errorMessages[] = 'Thiếu thông tin phụ huynh.';
        error_log('idPhuHuynh is missing. Session data: ' . print_r($_SESSION, true));
    }
    

    if (empty($errorMessages)) {
        $dayOfWeek = date('N', strtotime($date)); // Lấy ngày trong tuần (1 = Thứ 2, 7 = Chủ nhật)

        if ($dayOfWeek == 6 || $dayOfWeek == 7) {
            $errorMessages[] = 'Không thể đăng ký lịch vào thứ 7 và chủ nhật.';
        } else {
            // Kiểm tra xem giờ đã được chọn có còn trống hay không
            if (!$controller->isHourAvailable($date, $hour, $idChuyenVien)) {
                $errorMessages[] = 'Giờ đã được chọn. Vui lòng chọn giờ khác.';
            } else {
                $data = [
                    'date' => $date,
                    'hour' => $hour,
                    'describe_problem' => $_POST['describe_problem'],
                    'idPhuHuynh' => $idPhuHuynh,
                    'idChuyenVien' => $idChuyenVien,
                    'created_at' => date('Y-m-d H:i:s'),
                    'check' => 0, // Đặt giá trị mặc định cho check là 0
                    'status'=>1,
                    'payment_status'=>'Unpaid',
                    
                ];
                $result = $controller->createAppointment1($data);
                if ($result === true) {
                    // Gửi sự kiện đến Pusher
                    $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                    );
                    $pusher = new Pusher(
                        '03dc77ca859c49e35e41',
                        '5f7dc7d158c95e25a5e2',
                        '1873489',
                        $options
                    );
                
                    $eventData = [
                        'hour' => $hour,
                        'date' => $date,
                        'idChuyenVien' => $idChuyenVien
                    ];
                
                    $pusher->trigger('my-channel', 'my-event', $eventData);
                
                    // Thêm log để kiểm tra sự kiện được gửi
                    error_log('Pusher event sent: ' . print_r($eventData, true));
                
                    echo "<script>alert('Đăng ký lịch thành công.');</script>";
                    echo "<script>window.location.href='http://localhost/KLTN_PJ/index.php?xemlichtuvan'</script>";
                } else {
                    $errorMessages[] = $result;
                }
            }
        }
    }
}
?>

<style>
/* Reset và các biến CSS */
:root {
  --primary-color: #007bff;
  --secondary-color: #99ccff;
  --success-color: #28a745;
  --light-gray: #f8f9fa;
  --border-radius: 8px;
  --box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}
.time-slot.selected {
  font-weight: bold;
  background: var(--primary-color);
  color: white;
}

/* Container chính */
.py-7 {
  padding: 4rem 0;
  background-color: var(--light-gray);
}

/* Tiêu đề trang */
h1.text-center {
  font-size: 2.5rem;
  color: var(--primary-color);
  margin-bottom: 2rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Card containers - Điều chỉnh để cột bằng nhau */
.col-lg-6.z-index-2 {
  background: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  padding: 2rem;
  margin-bottom: 2rem;
  min-height: 600px; /* Đảm bảo chiều cao tối thiểu */
  display: flex;
  flex-direction: column;
}

/* Container của calendar */
.calendar-container {
  height: 100%;
  display: flex;
  flex-direction: column;
}

/* Container của form */
.appointment-form-container {
  height: 100%;
  display: flex;
  flex-direction: column;
}

/* Điều chỉnh margin-top của cột bên phải */
.col-lg-6.z-index-2:nth-child(2) {
  margin-top: 0 !important;
}

/* Row container */
.row {
  display: flex;
  flex-wrap: wrap;
  align-items: stretch; /* Đảm bảo các cột có chiều cao bằng nhau */
}

/* Time slots grid */
.time-slots {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
  gap: 1rem;
  margin: 1.5rem 0;
}

/* Time slot items */
.time-slot {
  position: relative;
  background: white;
  border: 2px solid var(--primary-color);
  border-radius: var(--border-radius);
  padding: 0.8rem;
  text-align: center;
  transition: all 0.3s ease;
  cursor: pointer;
  font-weight: 500;
}

.time-slot:hover:not(.disabled) {
  background: var(--primary-color);
  color: white;
  transform: translateY(-2px);
}

.time-slot.disabled {
  background: #f5f5f5;
  border-color: #ddd;
  color: #999;
  cursor: not-allowed;
  opacity: 0.7;
}

.time-slot input[type="radio"] {
  position: absolute;
  opacity: 0;
}

/* Form elements */
.form-label {
  font-weight: 600;
  color: #333;
  margin-bottom: 0.5rem;
}

.form-control {
  border-radius: var(--border-radius);
  border: 1px solid #ddd;
  padding: 0.8rem;
  transition: border-color 0.3s ease;
}

.form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

textarea.form-control {
  min-height: 120px;
}

/* Submit button */
.btn-primary {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  border: none;
  padding: 1rem 2.5rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.3s ease;
  margin-top: 1.5rem;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
}

/* Back button */
.back-button {
  position: fixed;
  top: 20px;
  left: 20px;
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: var(--box-shadow);
  transition: all 0.3s ease;
  z-index: 1000;
}

.back-button:hover {
  transform: scale(1.1);
}

.back-button i {
  font-size: 1.25rem;
  color: white;
}

/* Error messages */
.alert-danger {
  background-color: #fff5f5;
  border-color: #fed7d7;
  color: #c53030;
  border-radius: var(--border-radius);
  padding: 1rem;
  margin-top: 1.5rem;
}

.alert-danger ul {
  margin: 0;
  padding-left: 1.5rem;
}

@media (max-width: 991px) {
  .col-lg-6.z-index-2 {
    min-height: auto;
  }
  
  .col-lg-6.z-index-2:nth-child(2) {
    margin-top: 2rem !important;
  }
   .col-md-12.bg-primary.p-2.rounded {
    padding: 0.5rem;
  }

  .col-md-12.bg-primary.p-2.rounded .text-center.text-light.display-5 {
    font-size: 1rem;
  }
}

@media (max-width: 768px) {
  .time-slots {
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
  }
   .col-md-12.bg-primary.p-2.rounded {
    padding: 0.5rem;
  }

  .col-md-12.bg-primary.p-2.rounded .text-center.text-light.display-5 {
    font-size: 1rem;
  }
  .col-lg-6.z-index-2 {
    padding: 1rem;
  }
  
  h1.text-center {
    font-size: 2rem;
  }

  .btn-primary {
    padding: 0.8rem 1.5rem;
    font-size: 1rem;
  }

  .back-button {
    width: 40px;
    height: 40px;
  }

  .back-button i {
    font-size: 1rem;
  }

  .form-control {
    padding: 0.6rem;
  }

  .time-slot {
    padding: 0.6rem;
  }
}

/* Additional adjustments for smaller screens */
@media (max-width: 576px) {
  .time-slots {
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
  }

  .col-lg-6.z-index-2 {
    padding: 0.5rem;
  }

  h1.text-center {
    font-size: 1.5rem;
  }

  .btn-primary {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }
 .col-md-12.bg-primary.p-2.rounded {
    padding: 0.5rem;
  }

  .col-md-12.bg-primary.p-2.rounded .text-center.text-light.display-5 {
    font-size: 1rem;
  }
  .back-button {
    width: 30px;
    height: 30px;
  }

  .back-button i {
    font-size: 0.875rem;
  }

  .form-control {
    padding: 0.5rem;
  }

  .time-slot {
    padding: 0.5rem;
  }
}

</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<section class="py-7" style="margin-bottom: 200px;">
  <h1 class="text-center">CHỌN THỜI GIAN KHÁM</h1>
   <a href="http://localhost/KLTN_PJ/index.php?appointment" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 z-index-2">
        <?php require '../View/Home/Calendar.php'; ?>
      </div>
      <div class="col-lg-6 z-index-2" style="margin-top:70px;">
        <?php if ($showForm): ?>
        <form class="row g-3" action="AppointmentDetail.php" method="POST">
       
          <input type="hidden" name="idChuyenVien" value="<?php echo htmlspecialchars($_SESSION['appointment']['idChuyenVien'] ?? ''); ?>">
          <input type="hidden" name="idPhuHuynh" value="<?php echo htmlspecialchars($_SESSION['appointment']['idPhuHuynh'] ?? ''); ?>">
          <input type="hidden" name="date" value="<?php echo isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year']) ? htmlspecialchars("{$_GET['year']}-{$_GET['month']}-{$_GET['day']}") : ''; ?>">
          <div class="col-md-12 bg-primary p-2 rounded">
            <p class="text-center text-light display-5">
              <?php
              if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {
                $year = htmlspecialchars($_GET['year']);
                $month = htmlspecialchars($_GET['month']);
                $day = htmlspecialchars($_GET['day']);
                echo "Ngày $day/$month/$year";
              } elseif (isset($_GET['month']) && isset($_GET['year'])) {
                $month = htmlspecialchars($_GET['month']);
                $year = htmlspecialchars($_GET['year']);
                echo "Tháng $month/$year";
              } else {
                echo "Ngày " . date("d/m/Y");
              }
              ?>
            </p>
          </div>
          
          <div class="col-md-12">
            <label for="hour" class="form-label">Chọn giờ:</label>
            <div class="time-slots">
              <?php
              $hours = array(
                '07:30:00' => '7h30',
                '08:00:00' => '8h',
                '08:30:00' => '8h30',
                '09:00:00' => '9h',
                '09:30:00' => '9h30',
                '10:00:00' => '10h',
                '10:30:00' => '10h30',
                '11:00:00' => '11h',
                '13:30:00' => '13h30',
                '14:00:00' => '14h',
                '14:30:00' => '14h30',
                '15:00:00' => '15h',
                '15:30:00' => '15h30',
                '16:00:00' => '16h',
                '16:30:00' => '16h30',
                '17:00:00' => '17h'
              );
              foreach ($hours as $time => $label) {
                $disabled = '';
                $class = 'time-slot';
                
                if (!empty($appointment)) {
                    foreach ($appointment as $item) {
                        if ($item['hour'] == $time && $item['idChuyenVien'] == $_SESSION['appointment']['idChuyenVien']) {
                            // Ẩn giờ nếu giờ đã được chọn và chuyên viên trùng khớp
                            $disabled = 'disabled';
                            $class .= ' disabled';
                            break;
                    }
                  }
                }
                ?>
                <label class="<?php echo $class; ?>">
                    <input type="radio" name="hour" value="<?php echo $time; ?>" <?php echo $disabled; ?>>
                    <?php echo $label; ?>
                </label>
                <?php
            }
            ?>
            </div>
          </div>
          <div class="col-md-12">
            <label for="describe_problem" class="form-label">Mô tả vấn đề:</label>
            <textarea class="form-control" id="describe_problem" name="describe_problem" rows="3" required></textarea>
          </div>
          <div class="col-12 text-center">
            <input type="submit" value="Đặt lịch" class="btn btn-primary rounded-pill">
          </div>
        </form>
        <?php endif; ?>
        <?php if (!empty($errorMessages)): ?>
          <div class="alert alert-danger mt-3">
            <ul>
              <?php foreach ($errorMessages as $message): ?>
                <li><?php echo $message; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
  Pusher.logToConsole = true;

  // Pusher setup
  var pusher = new Pusher('03dc77ca859c49e35e41', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('my-channel');

  function updateTimeSlot(hour, idChuyenVien) {
    var currentidChuyenVien = document.querySelector('input[name="idChuyenVien"]').value;
    if (idChuyenVien === currentidChuyenVien) { // Chỉ cập nhật nếu chuyên viên trùng khớp
        var timeSlot = document.querySelector(`input[name="hour"][value="${hour}"]`).closest('.time-slot');
        if (timeSlot) {
            timeSlot.classList.add('disabled');
            timeSlot.querySelector('input').disabled = true;
        }
    }
}
    channel.bind('my-event', function(data) {
        // Kiểm tra thời gian để loại bỏ các event trùng lặp
        const currentTime = new Date().getTime();
        const eventTime = data.timestamp;
        
        // Chỉ xử lý nếu event trong khoảng thời gian cho phép
        if (Math.abs(currentTime - eventTime) < 3000) { // 3 giây
            updateTimeSlot(data.hour, data.idChuyenVien);
    }
});
  channel.bind('my-event', function(data) {
    console.log('Received event:', data);

    var hour = data.hour;
    var date = data.date;
    var idChuyenVien = data.idChuyenVien;

    // Lấy thông tin ngày hiện tại
    var currentDate = document.querySelector('input[name="date"]').value;

    // Kiểm tra nếu sự kiện phù hợp với ngày hiện tại
    if (date === currentDate) {
      updateTimeSlot(hour, idChuyenVien);
    }
  });


</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
  const initialSlotStates = new Map();
  let currentidChuyenVien = document.querySelector('input[name="idChuyenVien"]').value;
  let currentDate = document.querySelector('input[name="date"]').value;
       

    

  function updateBookedSlots() {
    // Reset all time slots to their initial state
    document.querySelectorAll('.time-slot').forEach(slot => {
      const input = slot.querySelector('input');
      const isInitiallyDisabled = initialSlotStates.get(input.value) || false;
      slot.classList.toggle('disabled', isInitiallyDisabled);
      input.disabled = isInitiallyDisabled;
    });

    // Fetch and apply booked slots
    fetch(`/api/booked-slots?idChuyenVien=${currentidChuyenVien}&date=${currentDate}`)
      .then(response => response.json())
      .then(bookedSlots => {
        bookedSlots.forEach(slot => {
          const timeSlot = document.querySelector(`input[name="hour"][value="${slot.hour}"]`).closest('.time-slot');
          if (timeSlot) {
            timeSlot.classList.add('disabled');
            timeSlot.querySelector('input').disabled = true;
          }
        });
      });
  }
  

  // Save initial state of all time slots
  document.querySelectorAll('.time-slot input').forEach(input => {
    initialSlotStates.set(input.value, input.disabled);
  });

  // Update booked slots when date changes
  const dateInput = document.querySelector('input[name="date"]');
  if (dateInput) {
    dateInput.addEventListener('change', function() {
      currentDate = this.value;
      updateBookedSlots();
    });
  }

  // Pusher setup
  const pusher = new Pusher('03dc77ca859c49e35e41', { cluster: 'ap1' });
  const channel = pusher.subscribe('my-channel');

  channel.bind('my-event', function(data) {
    console.log('Received event:', data);
    if (data.date === currentDate && data.idChuyenVien === currentidChuyenVien) {
      const timeSlot = document.querySelector(`input[name="hour"][value="${data.hour}"]`).closest('.time-slot');
      if (timeSlot) {
        timeSlot.classList.add('disabled');
        timeSlot.querySelector('input').disabled = true;
      }
    }
  });

  // Initial update
  updateBookedSlots();
});


</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hàm để vô hiệu hóa các ngày đã qua trong lịch
    function disablePastDates() {
        var today = new Date();
        today.setHours(0, 0, 0, 0); // Đặt thời gian về 00:00:00

        var allDates = document.querySelectorAll('.calendar-day');
        allDates.forEach(function(dateElement) {
            var dateValue = dateElement.getAttribute('data-date');
            var currentDate = new Date(dateValue);
            if (currentDate < today) {
                dateElement.classList.add('disabled');
                dateElement.style.pointerEvents = 'none';
                dateElement.style.opacity = '0.5';
            }
        });
    }

    // Gọi hàm khi trang tải
    disablePastDates();

});
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const timeSlots = document.querySelectorAll('.time-slot input');

    timeSlots.forEach(slot => {
      slot.addEventListener('change', function() {
        // Xóa lớp 'selected' khỏi tất cả các time-slot
        document.querySelectorAll('.time-slot').forEach(ts => ts.classList.remove('selected'));

        // Thêm lớp 'selected' vào time-slot được chọn
        if (this.checked) {
          this.closest('.time-slot').classList.add('selected');
        }
      });
    });
  });
  
</script>
