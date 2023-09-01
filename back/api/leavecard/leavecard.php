<?php
error_reporting(0);
include_once '../../conn.php'; // DB-Connection
include_once '../../api/header.php'; // Required For API
include_once '../../api/errorPrompt.php'; // Error Prompts
include_once '../../api/leavecard/function.php'; // Functions 
// Get request method
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET") {
    if (isset($_GET['id'])) { //Fetch Employee List
        $leavecardRecord = getLeavecard($_GET);
        echo $leavecardRecord;
    } else {
        echo 'ID not present';
    }
} else if ($method == "DELETE") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $deleteRecord = deleteLeavecardRecord($_GET);
    } else {
        $deleteRecord = deleteLeavecardRecord($inputData);
    }
    echo $deleteRecord;
}