<?php
// chatbot.php

// Thay thế bằng khóa API OpenAI của bạn
$apiKey = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['txt'];

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $input],
        ],
        'max_tokens' => 150,
        'temperature' => 0.7,
    ];
    

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    if (isset($response['choices']) && isset($response['choices'][0]['text'])) {
        echo $response['choices'][0]['text'];
    } else {
        // In toàn bộ phản hồi để gỡ lỗi
        echo 'Error: Invalid response from API. Response: ' . $result;
    }
}
?>