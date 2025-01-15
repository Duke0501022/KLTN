<?php
include_once("../Model/Connect.php");
// Kết nối CSDL và kiểm tra thông tin học phí
class mHP1{
    function kiemTraHocPhi($idHocPhi) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM hocphi where idHocPhi = '$idHocPhi'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }

    function selectallHocPhi(){
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT hocphi.*, thanhtoan.* FROM hocphi JOIN thanhtoan on thanhtoan.idThanhToan = hocphi.idThanhToan";
            $table = mysqli_query($conn, $string);
            if (!$table) {
                echo "Query Error: " . mysqli_error($conn);
                $p->dongketnoi($conn);
                return false;
            }
            $result = [];
            while ($row = mysqli_fetch_assoc($table)) {
                $result[] = $row;
            }
            $p->dongketnoi($conn);
            return $result;
        } else {
            echo "Connection Error: " . mysqli_connect_error();
            return false;
        }
    }

    function selectHocPhi($idHocPhi){
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM hocphi WHERE idHocPhi = '$idHocPhi'";
            $table = mysqli_query($conn, $string);
            if (!$table) {
                echo "Query Error: " . mysqli_error($conn);
                $p->dongketnoi($conn);
                return false;
            }
            $result = [];
            while ($row = mysqli_fetch_assoc($table)) {
                $result[] = $row;
            }
            $p->dongketnoi($conn);
            return $result;
        } else {
            echo "Connection Error: " . mysqli_connect_error();
            return false;
        }
    }

    // Xử lý kết quả thanh toán
    function xuLyKetQuaThanhToan($idHocPhi, $soTien, $trangThai) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            // Insert vào bảng thanhtoan
            $stmt = $conn->prepare("INSERT INTO thanhtoan (soTien, ngayThanhToan, payment_status) VALUES (?, NOW(), ?)");
            $stmt->bind_param("is", $soTien, $trangThai);
            if ($stmt->execute()) {
                $idThanhToan = $conn->insert_id;
                $stmt->close();
    
                // Cập nhật idThanhToan và check_tt vào bảng hocphi
                $stmtUpdate = $conn->prepare("UPDATE hocphi SET idThanhToan = ?, check_tt = 1 WHERE idHocPhi = ?");
                $stmtUpdate->bind_param("ii", $idThanhToan, $idHocPhi);
                $resultUpdate = $stmtUpdate->execute();
                $stmtUpdate->close();
    
                $p->dongketnoi($conn);
                return $resultUpdate;
            } else {
                $stmt->close();
                $p->dongketnoi($conn);
                return false;
            }
        } else {
            return false;
        }
    }
}
?>