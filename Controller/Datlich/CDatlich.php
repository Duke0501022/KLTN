<?php
include_once("Model/Datlich/mDatlich.php");
include_once("Model/ChuyenVien/mChuyenVien.php");

class AppointmentController {
    private $model;
    private $chuyenVienModel;

    public function __construct() {
        $this->model = new AppointmentModel();
        $this->chuyenVienModel = new ChuyenVienModel();
    }

    public function listAppointments() {
        return $this->model->getAppointments();
    }

    public function viewAppointment($id) {
        return $this->model->getAppointmentById($id);
    }

    public function createAppointment($data) {
        return $this->model->createAppointment($data);
    }

    public function listSpecialists() {
        return $this->chuyenVienModel->select_nhanvien();
    }
}
?>