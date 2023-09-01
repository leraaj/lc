<?php
error_reporting(0);
include_once '../../conn.php'; // DB-Connection
include_once '../../api/header.php'; // Required For API
include_once '../../api/errorPrompt.php'; // Error Prompts
include_once '../../api/User/function.php'; // Functions 
// Get request method
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET") {
    if (isset($_GET['id'])) { //Fetch Employee List
        $user = getUser($_GET);
        echo $user;
    } else {  //Fetch an Employee
        $userList = getUserList();
        echo $userList;
    }
} else if ($method == 'POST') {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $createUser = createUser($_POST);
    } else {
        $createUser = createUser($inputData);
    }
    echo $createUser;
} else if ($method == 'PUT') {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $updateUser = updateUser($_POST, $_GET);
    } else {
        $updateUser = updateUser($inputData, $_GET);
    }
    echo $updateUser;
} else if ($method == "DELETE") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $deleteUser = deleteUser($_GET);
    } else {
        $createUser = deleteUser($inputData);
    }
    echo $deleteUser;
} else {
    $data = [
        'status' => 405,
        'message' => $method . " Not Allowed",
    ];
    echo json_encode($data, JSON_PRETTY_PRINT);
}
