<?php
require_once "vendor/autoload.php";
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

$data = json_decode(file_get_contents('php://input'), true);
$text = isset($data['text']) ? $data['text'] : '';

if ($text) {
    $client = new Client("");
    $response = $client->geminiPro()->generateContent(
        new TextPart($text)
    );
    echo $response->text();
} else {
    echo "Error: No text provided.";
}
?>