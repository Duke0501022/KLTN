<?php
session_start();

if (isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $fileName = uniqid() . '_' . $file['name'];
    $uploadPath = '../uploads/' . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        echo json_encode([
            'success' => true,
            'image_url' => 'uploads/' . $fileName
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Failed to upload image'
        ]);
    }
}