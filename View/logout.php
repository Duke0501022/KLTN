<?php
if (!isset($_SESSION)) {
    session_start();
}

// Revoke Google token if it exists
if (isset($_SESSION['user_token'])) {
    require_once('vendor/autoload.php');
    
    $clientID = '261635437098-n1pvvqirnhufvvu844r5blrse47h8q3a.apps.googleusercontent.com';
    $clientSecret = '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';
    
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->revokeToken($_SESSION['user_token']);
}

unset($_SESSION['user_token']);
session_destroy();
header("Location: index.php");
exit;
?>