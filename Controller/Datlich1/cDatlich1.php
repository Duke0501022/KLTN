<?php
include_once("../Model/Datlich1/mDatlich1.php");
include_once("../Model/ChuyenVien1/mChuyenVien1.php");

class AppointmentController1 {
    private $model;
    private $chuyenVienModel;

    public function __construct() {
        $this->model = new AppointmentModel1();
        $this->chuyenVienModel = new ChuyenVienModel1();
    }

    public function listAppointments1($date) {
        return $this->model->getAppointmentsByDate1($date);
    }

    public function viewAppointment1($id) {
        return $this->model->getAppointmentById1($id);
    }

    public function listSpecialists() {
        return $this->chuyenVienModel->select_nhanvien();
    }

    public function createAppointment1($data) {
        $date = $data['date'];
        $hour = $data['hour'];
        $idChuyenVien = $data['idChuyenVien'];
        
        $dayOfWeek = date('N', strtotime($date)); // Lấy ngày trong tuần (1 = Thứ 2, 7 = Chủ nhật)

        if ($dayOfWeek == 6 || $dayOfWeek == 7) {
            return "Không thể đăng ký lịch vào thứ 7 và chủ nhật.";
        } else {
            if (!$this->model->isHourAvailable($date, $hour, $idChuyenVien)) {
                return "Giờ đã được chọn. Vui lòng chọn giờ khác.";
            }
            return $this->model->createAppointment1($data);
        }
    }

    public function isHourAvailable($date, $hour, $idChuyenVien) {
        return $this->model->isHourAvailable($date, $hour, $idChuyenVien);
    }
    public function getBookedSlotsByDoctor($date, $idChuyenVien) {
        return $this->model->getBookedSlotsByDoctor($date, $idChuyenVien);
    }
}
?>