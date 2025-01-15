<?php
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/KLTN_PJ/admin/');
include_once(BASE_PATH . "model/LD1/mLD1.php");


if (isset($_POST['teacherId'])) {
    $teacherId = $_POST['teacherId'];
    $l = new mLichDay1();
    $classes = $l->getClassesByTeacherId($teacherId);
    
    if ($classes) {
        $output = '';
        foreach ($classes as $index => $class) {
            $output .= '<div style="border-radius: 5px; padding: 5px; margin: 5px; border: 1px solid #dee2e6; width: 150px;" class="dish_mon">';
            $output .= '<label for="class_radio'.$index.'">'.htmlspecialchars($class['tenLop']).'</label>';
            $output .= '<input type="radio" class="show-form" id="class_radio'.$index.'" 
                              style="margin-right: 20px; float: right; margin-top: 5px;" 
                              name="lophoc[]" value="'.$class['idLopHoc'].'">';
            $output .= '</div>';
        }
        echo $output;
    } else {
        echo '<p>Không có lớp học nào cho giáo viên này</p>';
    }
    exit;
}
?>