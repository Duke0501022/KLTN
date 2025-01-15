<?php
include_once('Controller/cTuvanTudong.php');

// Kiểm tra trạng thái đăng nhập của người dùng
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = null; 
}

if (isset($_POST['txt']) && !empty($_POST['txt'])) {
    $query = $_POST['txt'];

    $tuvan = new cTuvanTudong();

    // Gửi yêu cầu tới chatbot và nhận phản hồi
    $res = $tuvan->select_tuvan($query);

    if ($res) {
        // Kiểm tra xem có câu trả lời từ chatbot hay không
        if (mysqli_num_rows($res) > 0) {
            // Lấy câu trả lời từ kết quả truy vấn
            $row = mysqli_fetch_assoc($res);
            $html = $row['answer'];
        } else {
            // Nếu không tìm thấy câu trả lời phù hợp, thông báo lỗi
            $html = "Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.";
        }

        // Nếu người dùng đã đăng nhập, lưu tin nhắn từ người dùng và từ chatbot vào cơ sở dữ liệu
        if ($username) {
            $added_on = date('Y-m-d H:i:s');
            $insert_user = $tuvan->insert_message($query, $added_on, 'user', $username);
            $insert_bot = $tuvan->insert_message($html, $added_on, 'bot', $username); // Lưu tin nhắn của chatbot vào cơ sở dữ liệu
        }
        echo $html; // Trả lời tin nhắn từ chatbot cho người dùng
    } else {
        // Nếu có lỗi khi truy vấn cơ sở dữ liệu, thông báo lỗi
        $html = "Xin lỗi vì sự cố này, vui lòng thử lại sau.";
        echo $html;
    }
} else {
    // Nếu không có tin nhắn được nhập, trả về thông báo
    echo "Xin lỗi vui lòng nhập câu hỏi.";
}
?>