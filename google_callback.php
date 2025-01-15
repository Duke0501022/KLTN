<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once('vendor/autoload.php');
require_once('config.php');

// Check database connection
if (!isset($conn) || $conn->connect_error) {
    die("Database connection failed: " . ($conn->connect_error ?? "Connection variable not set"));
}

// Google OAuth configuration
$clientID = '';
$clientSecret = '';
$redirectUri = '';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);

function saveGoogleImage($imageUrl, $username) {
    $uploadDir = 'admin/admin/assets/uploads/images/';
    
    // Tạo tên file mới
    $filename = $username . '_' . time() . '.jpg';
    
    // Lấy nội dung hình từ Google
    $imageContent = file_get_contents($imageUrl);
    
    if ($imageContent !== false) {
        // Lưu file
        if (file_put_contents($uploadDir . $filename, $imageContent)) {
            // Chỉ trả về tên file, không trả về đường dẫn đầy đủ
            return $filename;  // Thay đổi chỗ này
        }
    }
    return false;
}
// Function to convert Vietnamese names
function convertVietnameseName($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    return $str;
}

// Handle the OAuth flow
if (isset($_GET['code'])) {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        
        if (!isset($token['access_token'])) {
            throw new Exception("Access token not received");
        }

        $client->setAccessToken($token['access_token']);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Prepare user info
        $userinfo = [
            'email' => $google_account_info->email,
            'gioiTinh' => $google_account_info->gender ?? '',
            'hoTenPH' => convertVietnameseName($google_account_info->name),
            'hinhAnh' => '', // Will be updated after saving image
            'verifiedEmail' => $google_account_info->verifiedEmail ? '1' : '0',
            'token' => $google_account_info->id,
            'username' => $google_account_info->email,
            'diaChi' => 'HCM'
        ];

        // Lưu hình ảnh Google
        $googleImageUrl = $google_account_info->picture;
       $savedImagePath = saveGoogleImage($googleImageUrl, $userinfo['username']);

if ($savedImagePath) {
    $userinfo['hinhAnh'] = $savedImagePath;  // Giờ chỉ lưu tên file thôi
} else {
    $userinfo['hinhAnh'] = 'default.jpg';
}

        // BƯỚC 1: Kiểm tra và tạo tài khoản trong bảng taikhoan1
        $stmt = $conn->prepare("SELECT * FROM taikhoan1 WHERE username = ?");
        $stmt->bind_param("s", $userinfo['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Chưa có tài khoản -> tạo mới trong taikhoan1
            $defaultPassword = password_hash('GoogleLogin@2024', PASSWORD_DEFAULT);
            $defaultRole = 2;
            
            $stmt = $conn->prepare("INSERT INTO taikhoan1 (username, password, Role) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $userinfo['username'], $defaultPassword, $defaultRole);
            
            if (!$stmt->execute()) {
                throw new Exception("Error creating account in taikhoan1: " . $stmt->error);
            }
        }

        // BƯỚC 2: Kiểm tra và xử lý bảng phuhuynh
        $stmt = $conn->prepare("SELECT * FROM phuhuynh WHERE email = ?");
        $stmt->bind_param("s", $userinfo['email']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Đã có trong bảng phuhuynh -> cập nhật thông tin
            $stmt = $conn->prepare("UPDATE phuhuynh SET 
                hinhAnh = ?, 
                hoTenPH = ?, 
                gioiTinh = ?, 
                diaChi = ?,
                token = ?,
                verifiedEmail = ?
                WHERE email = ?");
            $stmt->bind_param("sssssss", 
                $userinfo['hinhAnh'], 
                $userinfo['hoTenPH'], 
                $userinfo['gioiTinh'], 
                $userinfo['diaChi'],
                $userinfo['token'],
                $userinfo['verifiedEmail'],
                $userinfo['email']
            );
            
            if (!$stmt->execute()) {
                throw new Exception("Error updating user in phuhuynh: " . $stmt->error);
            }
        } else {
            // Chưa có trong bảng phuhuynh -> tạo mới
            $stmt = $conn->prepare("INSERT INTO phuhuynh (email, gioiTinh, hoTenPH, hinhAnh, verifiedEmail, token, username, diaChi) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", 
                $userinfo['email'],
                $userinfo['gioiTinh'],
                $userinfo['hoTenPH'],
                $userinfo['hinhAnh'],
                $userinfo['verifiedEmail'],
                $userinfo['token'],
                $userinfo['username'],
                $userinfo['diaChi']
            );
            
            if (!$stmt->execute()) {
                throw new Exception("Error creating user in phuhuynh: " . $stmt->error);
            }
        }
        $stmt = $conn->prepare("SELECT idPhuHuynh FROM phuhuynh WHERE email = ?");
        $stmt->bind_param("s", $userinfo['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()) {
            $_SESSION['idPhuHuynh'] = $row['idPhuHuynh'];
        } else {
            // Nếu không tìm thấy idPhuHuynh, thử tìm bằng username
            $stmt = $conn->prepare("SELECT idPhuHuynh FROM phuhuynh WHERE username = ?");
            $stmt->bind_param("s", $userinfo['username']);
            $stmt->execute();
            $result = $stmt->get_result();
            if($row = $result->fetch_assoc()) {
                $_SESSION['idPhuHuynh'] = $row['idPhuHuynh'];
            }
        }

            // Kiểm tra xem đã có idPhuHuynh chưa
            if (!isset($_SESSION['idPhuHuynh'])) {
                error_log("Missing idPhuHuynh for user: " . $userinfo['email']);
                // Có thể thêm xử lý lỗi ở đây
            }

// Debug log
error_log("Session data after Google login: " . print_r($_SESSION, true));
        // Set session variables
        $_SESSION['user_token'] = $userinfo['token'];
        $_SESSION['username'] = $userinfo['username'];
        $_SESSION['hinhAnh'] = $userinfo['hinhAnh'];
        $_SESSION['LoginSuccess'] = true;
        $_SESSION['login_with_google'] = true;

        // Redirect to home page
        header("Location: https://quanlychuyenbiet.pro.vn/index.php");
        exit;

    } catch (Exception $e) {
        error_log("Error in Google OAuth process: " . $e->getMessage());
        header("Location: https://quanlychuyenbiet.pro.vn/error.php?message=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    exit;
}
?>