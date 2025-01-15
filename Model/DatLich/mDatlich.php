<?php
include_once("Model/Connect.php");

class AppointmentModel {
    private $conn;

    public function __construct() {
        $database = new clsketnoi();
        $this->conn = $database->ketnoiDB($conn);
    }

    public function getAppointments() {
        $query = "SELECT * FROM datlich";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAppointmentById($id) {
        $query = "SELECT * FROM datlich WHERE id_datlich = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createAppointment($data) {
        $query = "INSERT INTO datlich (date, hour, describe_problem, idPhuHuynh, idChuyenVien, `check`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssiii", $data['date'], $data['hour'], $data['describe_problem'], $data['idPhuHuynh'], $data['idChuyenVien'], $data['check']);
        return $stmt->execute();
    }
}
?>