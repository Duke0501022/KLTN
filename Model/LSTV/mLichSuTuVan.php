<?php
include_once("Model/Connect.php");

class mLSTV {
    public function count_lichsu($check = null) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT COUNT(*) as total FROM datlich";
            if ($check !== null) {
                $string .= " WHERE datlich.check = $check";
            }
            $result = mysqli_query($conn, $string);
            $row = mysqli_fetch_assoc($result);
            $p->dongketnoi($conn);
            return (int)$row['total'];
        } else {
            return 0;
        }
    }
        public function count_datlich() {
            $p = new clsketnoi();
            if ($p->ketnoiDB($conn)) {
                $string = "SELECT date, COUNT(*) as count FROM datlich GROUP BY date";
                
                $result = mysqli_query($conn, $string);
                $data = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                $p->dongketnoi($conn);
                return $data;
            } else {
                return [];
            }
        }
   public function selectAppointmentById($id_datlich) {
    $p = new clsketnoi();
    if ($p->ketnoiDB($conn)) {
        $string = "SELECT datlich.* , phuhuynh.* , chuynvien.* FROM datlich
        INNER JOIN phuhuynh ON phuhuynh.idPhuHuynh = datlich.idPhuHuynh
        INNER JOIN chuyenvien ON chuyenvien.idChuyenVien = datlich.idChuyenVien
        where id_datlich = $id_datlich";
        
        $result = mysqli_query($conn, $string);
        $row = mysqli_fetch_assoc($result);
        $p->dongketnoi($conn);
        return $row;
    } else {
        return 0;
    }
}

    public function select_lichsu($check = null) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $query = "SELECT *, 
            chuyenvien.hoTen as fullNameChuyenVien, 
            phuhuynh.hoTenPH as fullNamePhuHuynh,
            phuhuynh.email as emailPhuHuynh, 
            phuhuynh.gioiTinh as genderPhuHuynh, 
            phuhuynh.soDienThoai as phuHuynhPhone,
            datlich.date as appointmentDate,
            phuhuynh.hinhAnh as phuHuynhImage
            FROM phuhuynh
            INNER JOIN datlich ON phuhuynh.idPhuHuynh = datlich.idPhuHuynh 
            INNER JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien";
            
            if ($check !== null) {
                $query .= " WHERE datlich.check = $check";
            }

            $query .= " ORDER BY datlich.date ASC";

            $result = mysqli_query($conn, $query);
            $p->dongketnoi($conn);
            return $result;
        } else {
            return false;
        }
    }
    function SelectLichTVbyIDPH($idPhuHuynh, $username, $check = null,$pay = null) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            // Start building the base query
            $query = "SELECT *, 
                chuyenvien.hoTen,
                phuhuynh.hoTenPH,
                phuhuynh.email,
                phuhuynh.gioiTinh,
                phuhuynh.soDienThoai,
                datlich.date,
                phuhuynh.hinhAnh,
                datlich.hour as appointmentHour
                FROM datlich
                INNER JOIN phuhuynh ON phuhuynh.idPhuHuynh = datlich.idPhuHuynh 
                INNER JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien";
    
            $params = []; // This will store the parameters for prepared statements
            $types = ""; // This will store the types of the parameters
    
            // Check for $idPhuHuynh condition
            if ($idPhuHuynh) {
                $query .= " WHERE phuhuynh.idPhuHuynh = ?";
                $params[] = $idPhuHuynh;
                $types .= "i"; // 'i' for integer
            }
    
            // Check for $username condition
            if ($username) {
                if ($idPhuHuynh) {
                    $query .= " AND phuhuynh.username = ?";
                } else {
                    $query .= " WHERE phuhuynh.username = ?";
                }
                $params[] = $username;
                $types .= "s"; // 's' for string
            }
    
            // Check for $check condition
            if ($check !== null) {
                if ($idPhuHuynh || $username) {
                    $query .= " AND datlich.check = ?";
                } else {
                    $query .= " WHERE datlich.check = ?";
                }
                $params[] = $check;
                $types .= "i"; // 'i' for integer
            }
            if ($pay !== null) {
                if ($idPhuHuynh || $username) {
                    $query .= " AND datlich.pay = ?";
                } else {
                    $query .= " WHERE datlich.pay = ?";
                }
                $params[] = $pay;
                $types .= "i"; // 'i' for integer
            }
    
            // Add the ORDER BY clause
            $query .= " ORDER BY datlich.date ASC";
    
            // Prepare the query
            $stmt = mysqli_prepare($conn, $query);
    
            if ($stmt) {
                // Bind parameters dynamically
                if ($types) {
                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                }
    
                // Execute the statement
                mysqli_stmt_execute($stmt);
    
                // Get the result
                $result = mysqli_stmt_get_result($stmt);
    
                $list_users = [];
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $list_users[] = $row;
                    }
                }
    
                // Close the statement and the connection
                mysqli_stmt_close($stmt);
                $p->dongketnoi($conn);
    
                return $list_users;
            }
    
            $p->dongketnoi($conn);
            return false;
        }
    
        return false;
    }
    public function del_lichtuvan($idDatLich) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $idDatLich = mysqli_real_escape_string($conn, $idDatLich); // Sanitize input
            $query = "DELETE FROM datlich WHERE id_datlich='$idDatLich'";
            
            $result = mysqli_query($conn, $query);
            if ($result) {
                $p->dongketnoi($conn);
                return true;
            } else {
                $error = mysqli_error($conn);
                $p->dongketnoi($conn);
                return "Error: " . $error;
            }
        } else {
            return false;
        }
    }
    public function cancelUnpaidAppointments() {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $query = "SELECT id_datlich, date, hour FROM datlich WHERE payment_status = 'Unpaid'";
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $appointmentDateTime = strtotime($row['date'] . ' ' . $row['hour']);
                    $currentDateTime = time();
                    
                    if (($currentDateTime - $appointmentDateTime) > 120) {
                        $idDatLich = $row['id_datlich'];
                        
                        // Start transaction
                        mysqli_begin_transaction($conn);
                        
                        try {
                            // Delete from hosotuvan first
                            $deleteHosotuvan = "DELETE FROM hosotuvan WHERE id_datlich = ?";
                            $stmt = mysqli_prepare($conn, $deleteHosotuvan);
                            mysqli_stmt_bind_param($stmt, 'i', $idDatLich);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            
                            // Then delete from datlich
                            $deleteDatlich = "DELETE FROM datlich WHERE id_datlich = ?";
                            $stmt = mysqli_prepare($conn, $deleteDatlich);
                            mysqli_stmt_bind_param($stmt, 'i', $idDatLich);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            
                            // Commit transaction
                            mysqli_commit($conn);
                        } catch (Exception $e) {
                            mysqli_rollback($conn);
                            echo "Error deleting appointment: " . $e->getMessage();
                        }
                    }
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            
            $p->dongketnoi($conn);
        }
    }

    function SelectHSTVbyIDPH($idPhuHuynh, $username) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            // Start building the base query
            $query = "SELECT hosotuvan.*, datlich.*, 
                            datlich.date as date, 
                             chuyenvien.hoTen AS hoTen, chuyenvien.hinhAnh AS hinhAnh, chuyenvien.ngaySinh as ngaySinh
                      FROM hosotuvan
                      INNER JOIN datlich ON hosotuvan.id_datlich = datlich.id_datlich
                      INNER JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien
                      INNER JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh";
                      
            $params = [];  // Store parameters for prepared statement
            $types = "";   // Store types for binding
            
            // Check if $idPhuHuynh is set
            if ($idPhuHuynh) {
                $query .= " WHERE phuhuynh.idPhuHuynh = ?";
                $params[] = $idPhuHuynh;
                $types .= "i"; // 'i' for integer
            }
    
            // Check if $username is set
            if ($username) {
                if ($idPhuHuynh) {
                    $query .= " AND phuhuynh.username = ?";
                } else {
                    $query .= " WHERE phuhuynh.username = ?";
                }
                $params[] = $username;
                $types .= "s"; // 's' for string
            }
    
            // Add ORDER BY clause
            $query .= " ORDER BY hosotuvan.date_create ASC";
    
            // Prepare the query
            if ($stmt = mysqli_prepare($conn, $query)) {
                // Bind the parameters dynamically if present
                if ($types) {
                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                }
    
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    // Get the result
                    $result = mysqli_stmt_get_result($stmt);
    
                    $list_users = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $list_users[] = $row;
                    }
    
                    // Close the statement
                    mysqli_stmt_close($stmt);
    
                    // Close the connection
                    $p->dongketnoi($conn);
    
                    // Return the result set
                    return $list_users;
                } else {
                    // Handle query execution failure
                    echo "Failed to execute query: " . mysqli_error($conn);
                }
            } else {
                // Handle query preparation failure
                echo "Failed to prepare query: " . mysqli_error($conn);
            }
    
            // Close the connection in case of failure
            $p->dongketnoi($conn);
            return false;
        }
    
        return false;
    }
    function search_hoso($idPhuHuynh, $username,$search_query) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            // Start building the base query
            $query = "SELECT hosotuvan.*, datlich.*, phuhuynh.hoTenPH, phuhuynh.gioiTinh, 
                            datlich.date as date, 
                             chuyenvien.hoTen AS hoTen, chuyenvien.hinhAnh AS hinhAnh, chuyenvien.ngaySinh as ngaySinh
                      FROM hosotuvan
                      INNER JOIN datlich ON hosotuvan.id_datlich = datlich.id_datlich
                      INNER JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien
                      INNER JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh
                        hoTen LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
                        OR loiDan LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
                        OR chuanDoan LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%'
                        OR (gioiTinh = " . ($search_query == 'Nam' ? 0 : ($search_query == 'Nữ' ? 1 : -1)) . ")";
                      
            $params = [];  // Store parameters for prepared statement
            $types = "";   // Store types for binding
            
            // Check if $idPhuHuynh is set
            if ($idPhuHuynh) {
                $query .= " WHERE phuhuynh.idPhuHuynh = ?";
                $params[] = $idPhuHuynh;
                $types .= "i"; // 'i' for integer
            }
    
            // Check if $username is set
            if ($username) {
                if ($idPhuHuynh) {
                    $query .= " AND phuhuynh.username = ?";
                } else {
                    $query .= " WHERE phuhuynh.username = ?";
                }
                $params[] = $username;
                $types .= "s"; // 's' for string
            }
    
            // Add ORDER BY clause
            $query .= " ORDER BY hosotuvan.date_create ASC";
    
            // Prepare the query
            if ($stmt = mysqli_prepare($conn, $query)) {
                // Bind the parameters dynamically if present
                if ($types) {
                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                }
    
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    // Get the result
                    $result = mysqli_stmt_get_result($stmt);
    
                    $list_users = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $list_users[] = $row;
                    }
    
                    // Close the statement
                    mysqli_stmt_close($stmt);
    
                    // Close the connection
                    $p->dongketnoi($conn);
    
                    // Return the result set
                    return $list_users;
                } else {
                    // Handle query execution failure
                    echo "Failed to execute query: " . mysqli_error($conn);
                }
            } else {
                // Handle query preparation failure
                echo "Failed to prepare query: " . mysqli_error($conn);
            }
    
            // Close the connection in case of failure
            $p->dongketnoi($conn);
            return false;
        }
    
        return false;
    }
    
}
?>