<?php
// FETCHED A LEAVECARD OF USER based on ID
function getLeavecard($userInput)
{
    global $conn;
    $userId = mysqli_real_escape_string($conn, $userInput['id']);
    $query = "SELECT
                leave_type.id AS leavetype_id,
                leave_type.type AS leavetype_type,
                leavecard.id AS leavecard_id,
                user.id AS user_id,
                leavecard.* 
            FROM
                leavecard
            INNER JOIN
                user ON leavecard.user_id = user.id
            INNER JOIN
                leave_type ON leavecard.leavetype_id = leave_type.id
            WHERE
                user_id ='$userId'";
    $result =  mysqli_query($conn, $query);
    if (isset($userInput['id'])) {
        if ($result) {
            if (mysqli_num_rows($result) >= 0) {
                $response = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $data = [
                    'status' => 200,
                    'message' => "Leavecard Record Fetched Successfully",
                    'data' => $response
                ];
                error(200);
                return json_encode($data, JSON_PRETTY_PRINT);
            } else {
                $data = [
                    'status' => 404,
                    'message' => "Leavecard Record ID has no records",
                ];
                error(404);
                return json_encode($data, JSON_PRETTY_PRINT);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            error(500);
            return json_encode($data, JSON_PRETTY_PRINT);
        }
    } else {
        $data = [
            'status' => 404,
            'message' => "Empty Leavecard Record ID",
        ];
        error(404);
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
function deleteLeavecardRecord($userParams)
{
    global $conn;
    $leavecard_id = mysqli_real_escape_string($conn, $userParams['id']);
    if (empty(trim($leavecard_id))) {
        return errorMessage('Enter Leave Record ID');
    } else {
        $query = "DELETE FROM leavecard WHERE id = $leavecard_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            if (mysqli_affected_rows($conn) > 0) {
                $data = [
                    'status' => 200,
                    'message' => "Leave Record Deleted Successfully",
                ];
                error(200);
            } else {
                $data = [
                    'status' => 404,
                    'message' => "Leave Record ID not found",
                ];
                error(404);
            }
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
// Use this when fetching single record
// SELECT leavecard.id AS leavecard_id, user.id AS user_id, leavecard.* , user.fname,user.mname,user.lname,user.fdsdate,user.bdate FROM leavecard INNER JOIN user ON leavecard.user_id = user.id;
//  Use this for inserting
// INSERT INTO `leavecard` (`id`, `user_id`, `dateoffiling`, `previousbalance`, `earned`, `used`, `totalbalance`, `inclusivedates`, `dhm`, `leavetype_id`, `remarks`) VALUES (NULL, '58', '2023-08-01', '1', '1', '1', '1', '1', '1', '2', '1');