<?php
include_once("model/Import/mImport.php");

class cImport
{
    //     function ImportController()
    //     {
    //         if (isset($_POST['save'])) {
    //             // Kiểm tra xem có tệp được tải lên không
    //             if ($_FILES['file']['name']) {
    //                 // Nạp tệp đã tải lên
    //                 $file = $_FILES['file']['tmp_name'];

    //                 // Tạo một đối tượng PhpSpreadsheet
    //                 require 'vendor/autoload.php'; // Import thư viện PhpSpreadsheet
    //                 $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

    //                 // Lấy bảng tính đầu tiên
    //                 $worksheet = $spreadsheet->getActiveSheet();

    //                 // Lấy số hàng cao nhất
    //                 $highestRow = $worksheet->getHighestRow();

    //                 // Tạo đối tượng model Import
    //                 $importModel = new mImport();

    //                 // Biến để kiểm tra việc nhập liệu
    //                 $success = true;

    //                 // Duyệt qua từng hàng
    //                 for ($row = 1; $row <= $highestRow; $row++) {
    //                     // Lấy giá trị các ô
    //                     $cauHoi = $worksheet->getCell('A' . $row)->getValue();
    //                     $cau1 = $worksheet->getCell('B' . $row)->getValue();
    //                     $cau2 = $worksheet->getCell('C' . $row)->getValue();
    //                     $cau3 = $worksheet->getCell('D' . $row)->getValue();
    //                     $idUnit = $worksheet->getCell('E' . $row)->getValue();

    //                     // Thực hiện thêm dữ liệu vào cơ sở dữ liệu
    //                     // $result = $importModel->submitDA(['Câu Hỏi' => $cauHoi, 'Câu 1' => $cau1, 'Câu 2' => $cau2, 'Câu 3' => $cau3, 'Unit' => $idUnit]);
    //                     $result = $importModel->submitDA(['cauHoi' => $cauHoi, 'cau1' => $cau1, 'cau2' => $cau2, 'cau3' => $cau3, 'idUnit' => $idUnit]);
    //                     // Kiểm tra kết quả
    //                     if (!$result) {
    //                         $success = false; // Đánh dấu lỗi
    //                         break; // Thoát khỏi vòng lặp
    //                     }
    //                 }
    //                 // Kiểm tra kết quả cuối cùng
    //                 if ($success) {
    //                     echo "Dữ liệu đã nhập thành công!";
    //                 } else {
    //                     echo "Có lỗi xảy ra khi nhập dữ liệu!";
    //                 }
    //             } else {
    //                 echo "Không có tệp nào được tải lên!";
    //             }
    //         }
    //         include_once("View/Import/vImport.php"); // Bao gồm tệp view
    //     }
    // }
    function ImportController()
    {
        $message = "";
        if (isset($_POST['save'])) {
            if ($_FILES['file']['name']) {
                $file = $_FILES['file']['tmp_name'];

                require 'assets/vendor/autoload.php';
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
                $worksheet = $spreadsheet->getActiveSheet();

                $highestRow = $worksheet->getHighestRow();

                $importModel = new mImport();
                $connect = new ketnoi(); // Instantiate the connect class

                $success = true;

                for ($row = 1; $row <= $highestRow; $row++) {
                    $cauHoi = $worksheet->getCell('A' . $row)->getValue();
                    $cau1 = $worksheet->getCell('B' . $row)->getValue();
                    $cau2 = $worksheet->getCell('C' . $row)->getValue();
                    $cau3 = $worksheet->getCell('D' . $row)->getValue();
                    $idUnit = $worksheet->getCell('E' . $row)->getValue();

                    $result = $importModel->submitDA(array(
                        'cauHoi' => $cauHoi,
                        'cau1' => $cau1,
                        'cau2' => $cau2,
                        'cau3' => $cau3,
                        'idUnit' => $idUnit
                    ), $connect);

                    if (!$result) {
                        $success = false;
                        break;
                    }
                }

                if ($success) {
                    $message = 1; // Success
                } else {
                    $message = 0; // Error
                }
            } else {
                $message = -1; // No file uploaded
            }
        }
        include_once("view/Import/vImport.php");
        return $message;
    }
}
