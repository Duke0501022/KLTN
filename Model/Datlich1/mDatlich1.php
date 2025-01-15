<?php
class AppointmentModel1 {
    private $conn;

    public function __construct() {
        // Kết nối cơ sở dữ liệu
        $this->conn = new mysqli("localhost", "root", "", "coidata");
        $this->conn->set_charset("utf8");
    }

    public function getAppointments1() {
        $query = "SELECT * FROM datlich";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAppointmentById1($id) {
        $query = "SELECT * FROM datlich WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    
    public function isHourAvailable($date, $hour, $idChuyenVien) {
        $query = "SELECT COUNT(*) as count FROM datlich WHERE date = ? AND hour = ? AND idChuyenVien = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $date, $hour, $idChuyenVien);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] == 0;
    }
    public function getBookedSlotsByDoctor($date, $idChuyenVien) {
        $query = "SELECT hour FROM datlich WHERE date = ? AND idChuyenVien = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $date, $idChuyenVien);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createAppointment1($data) {
        try {
            // Start transaction
            $this->conn->begin_transaction();
    
            // First, check if the slot is already booked
            $checkQuery = "SELECT COUNT(*) as count FROM datlich 
                           WHERE date = ? AND hour = ? AND idChuyenVien = ?";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bind_param("ssi", $data['date'], $data['hour'], $data['idChuyenVien']);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            $row = $result->fetch_assoc();
    
            // If slot is already booked, rollback and return false
            if ($row['count'] > 0) {
                $this->conn->rollback();
                error_log("Slot already booked by another user: " . json_encode($data));
                return "Slot đã được đặt bởi người khác";
            }
    
            // If slot is free, proceed with insertion
            $query = "INSERT INTO datlich (date, hour, describe_problem, idPhuHuynh, idChuyenVien,created_at, `check`, status, payment_status) 
                      VALUES (?, ?, ?, ?, ?, ?, ?,?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssssiisis", 
                $data['date'], 
                $data['hour'], 
                $data['describe_problem'], 
                $data['idPhuHuynh'], 
                $data['idChuyenVien'], 
                $data['created_at'],
                $data['check'], 
                $data['status'], 
                $data['payment_status']
            );
            
            // Execute the insertion
            $executeResult = $stmt->execute();
    
            // If insertion fails, rollback
            if (!$executeResult) {
                $this->conn->rollback();
                error_log("Insertion failed: " . $stmt->error);
                return false;
            }
    
            // Commit the transaction
            $this->conn->commit();
            return true;
    
        } catch (Exception $e) {
            // Rollback in case of any error
            $this->conn->rollback();
            error_log("Appointment creation error: " . $e->getMessage());
            return false;
        }
    }

    public function getAppointmentsByDate1($date) {
        $query = "SELECT * FROM datlich WHERE date = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    }
}
?>