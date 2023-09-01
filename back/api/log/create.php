<?php
error_reporting(0);
include_once '../../conn.php'; // DB-Connection
include_once '../../api/header.php'; // Required For API
include_once '../../api/errorPrompt.php'; // Error Prompts
include_once '../../api/log/function.php'; // Functions 
// Get request method
$method = $_SERVER['REQUEST_METHOD'];
// Response array
$response = array();

if ($method == 'POST') {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $createLog = addLog($_POST);
    } else {
        $createLog = addLog($inputData);
    }
    echo $createLog;
} else {
    $data = [
        'status' => 405,
        'message' => $method . " Not Allowed",
    ];
    echo json_encode($data, JSON_PRETTY_PRINT);
}
