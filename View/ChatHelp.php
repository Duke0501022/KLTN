<?php
class ChatImageHelper {
    private static $UPLOAD_BASE_DIR = 'uploads/chat/';
    
    /**
     * Process and store uploaded image
     */
    public static function processUploadedImage($file) {
        // Full server path to upload directory
        $upload_dir = __DIR__ . '/../../' . self::$UPLOAD_BASE_DIR;
        
        // Create directory if not exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Generate unique filename
        $filename = uniqid() . '_' . basename($file['name']);
        $upload_path = $upload_dir . $filename;
        
        // Store file and return relative path
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            return self::$UPLOAD_BASE_DIR . $filename;
        }
        
        return null;
    }
    
    /**
     * Get complete image URL based on user type
     */
    public static function getImageUrl($image_path, $is_admin = false) {
        if (empty($image_path)) {
            return null;
        }
        
        // For admin panel access
        if ($is_admin) {
            return '../' . $image_path;
        }
        
        // For frontend access 
        return $image_path;
    }
}
?>