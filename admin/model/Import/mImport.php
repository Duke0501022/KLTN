<?php

// include_once("model/connect.php");

// class mImport
// {
// 	public function importModel()
// 	{
// 		if (isset($_POST['save'])) {
// 			// Kiểm tra xem có tệp được tải lên không
// 			if ($_FILES['file']['name']) {
// 				// Nạp tệp đã tải lên
// 				$file = $_FILES['file']['tmp_name'];

// 				// Tạo một đối tượng PhpSpreadsheet
// 				require 'vendor/autoload.php'; // Import thư viện PhpSpreadsheet
// 				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

// 				// Lấy bảng tính đầu tiên
// 				$worksheet = $spreadsheet->getActiveSheet();

// 				// Lấy số hàng và số cột cao nhất
// 				$highestRow = $worksheet->getHighestRow();
// 				$highestColumn = $worksheet->getHighestColumn();

// 				// Duyệt qua từng hàng
// 				for ($row = 1; $row <= $highestRow; $row++) {
// 					// Lấy giá trị của các ô
// 					$cauHoi = $worksheet->getCell('A' . $row)->getValue();
// 					$cau1 = $worksheet->getCell('B' . $row)->getValue();
// 					$cau2 = $worksheet->getCell('C' . $row)->getValue();
// 					$cau3 = $worksheet->getCell('D' . $row)->getValue();
// 					$idUnit = $worksheet->getCell('E' . $row)->getValue();

// 					// Lưu vào cơ sở dữ liệu sử dụng model
// 					$connect->submitDA($cauHoi, $cau1, $cau2, $cau3, $idUnit);
// 				}

// 				echo "Dữ liệu được nhập thành công!";
// 			} else {
// 				echo "Không có tệp nào được tải lên!";
// 			}
// 		}
// 		include 'import_data.php'; // Bao gồm tệp view
// 	}

// 	function submitDA($data) {
// 		// Kết nối đến cơ sở dữ liệu
// 		$conn = mysqli_connect("localhost", "root", "", "kinderdb");

// 		// Kiểm tra kết nối
// 		if (!$conn) {
// 			die("Connection failed: " . mysqli_connect_error());
// 		}
// 		// Escape các giá trị để tránh SQL injection
// 		$cauHoi = mysqli_real_escape_string($conn, $data['cauHoi']);
// 		$cau1 = mysqli_real_escape_string($conn, $data['cau1']);
// 		$cau2 = mysqli_real_escape_string($conn, $data['cau2']);
// 		$cau3 = mysqli_real_escape_string($conn, $data['cau3']);
// 		$idUnit = mysqli_real_escape_string($conn, $data['idUnit']);

// 		// Câu lệnh SQL để thêm dữ liệu vào cơ sở dữ liệu
// 		$sql = "INSERT INTO cauhoi (cauHoi, cau1, cau2, cau3, idUnit) 
// 				VALUES ('$cauHoi', '$cau1', '$cau2', '$cau3', '$idUnit')";

// 		// Thực thi câu lệnh SQL
// 		if (mysqli_query($conn, $sql)) {
// 			echo "Dữ liệu đã được thêm vào cơ sở dữ liệu thành công!";
// 		} else {
// 			echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
// 		}
// 		// Đóng kết nối
// 		mysqli_close($conn);
// 	}
// }
include_once("model/connect.php");

class mImport
{
    public function importModel($post, $files)
    {
        if (isset($post['save'])) {
            if ($files['file']['name']) {
                $file = $files['file']['tmp_name'];

                require 'assets/vendor/autoload.php';
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
                $worksheet = $spreadsheet->getActiveSheet();

                $connect = new ketnoi(); // Instantiate the connect class

                for ($row = 1; $row <= $worksheet->getHighestRow(); $row++) {
                    $cauHoi = $worksheet->getCell('A' . $row)->getValue();
                    $cau1 = $worksheet->getCell('B' . $row)->getValue();
                    $cau2 = $worksheet->getCell('C' . $row)->getValue();
                    $cau3 = $worksheet->getCell('D' . $row)->getValue();
                    $idUnit = $worksheet->getCell('E' . $row)->getValue();

                    $this->submitDA(array(
                        'cauHoi' => $cauHoi,
                        'cau1' => $cau1,
                        'cau2' => $cau2,
                        'cau3' => $cau3,
                        'idUnit' => $idUnit
                    ), $connect);
                }

                return "Dữ liệu được nhập thành công!";
            } else {
                return "Không có tệp nào được tải lên!";
            }
        }
    }

    function submitDA($data, $connect)
    {
        $conn = $connect->getConnection(); // Assuming getConnection() returns the database connection

        $cauHoi = mysqli_real_escape_string($conn, $data['cauHoi']);
        $cau1 = mysqli_real_escape_string($conn, $data['cau1']);
        $cau2 = mysqli_real_escape_string($conn, $data['cau2']);
        $cau3 = mysqli_real_escape_string($conn, $data['cau3']);
        $idUnit = mysqli_real_escape_string($conn, $data['idUnit']);

        $sql = "INSERT INTO cauhoi (cauHoi, cau1, cau2, cau3, idUnit) 
                VALUES ('$cauHoi', '$cau1', '$cau2', '$cau3', '$idUnit')";

        if (mysqli_query($conn, $sql)) {
            return "Dữ liệu đã được thêm vào cơ sở dữ liệu thành công!";
        } else {
            return "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}