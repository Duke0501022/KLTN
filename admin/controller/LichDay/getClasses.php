<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("controller/LichDay/cLichDay.php");
include_once("controller/LopHoc/cLopHoc.php");

header('Content-Type: application/json');

if (isset($_POST['idGiaoVien'])) {
    $teacherId = $_POST['idGiaoVien'];
    var_dump($teacherId); // Kiểm tra giá trị của idGiaoVien
    $l = new cLichDay();
    $classes = $l->getClassesByTeacherId($teacherId);
    var_dump($classes); // Kiểm tra kết quả truy vấn
    
    if ($classes) {
        $lopHoc = new cLopHoc();
        $fullClassInfo = array();
        
        foreach ($classes as $class) {
            $classDetails = $lopHoc->get_lop_id($class['idLopHoc']);
            var_dump($classDetails); // Kiểm tra kết quả truy vấn chi tiết lớp học
            if ($classDetails) {
                $fullClassInfo[] = array(
                    'idLopHoc' => $classDetails['idLopHoc'],
                    'tenLop' => $classDetails['tenLop'],
                );
            }
        }
        
        echo json_encode($fullClassInfo);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(['error' => 'Missing teacher ID']);
}
exit; // Đảm bảo không có mã nào khác được thực thi sau khi phản hồi JSON