<?php
// Keeps track of
// USER- Login, Logout  | USER- create, update, delete  | LEAVECARD- create, update, delete
function addLog($userInput)
{
    global $conn;
    $user_id = mysqli_real_escape_string($conn, $userInput['user_id']);
    $activity = mysqli_real_escape_string($conn, $userInput['activity']);
    $occurrence = date("Y-m-d H:i:s");
    if (empty(trim($user_id))) {
        return errorMessage('Enter your user_id');
    } else if (empty(trim($activity))) {
        return errorMessage('Enter your Activity');
    } else {
        $query = "INSERT INTO log (id, user_id, activity, occurrence) 
        VALUES (NULL, '$user_id', '$activity', '$occurrence')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $data = [
                'status' => 201,
                'message' => "User Created Successfully",
            ];
            error(201);
            return json_encode($data, JSON_PRETTY_PRINT);
        } else {
            $data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            error(500);
            return json_encode($data, JSON_PRETTY_PRINT);
        }
    }
}
