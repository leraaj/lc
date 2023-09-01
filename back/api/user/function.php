<?php
// FETCH USERS
function getUserList()
{
    global $conn;
    $query = "SELECT user.*,user_type.position FROM user INNER JOIN user_type ON user.position_id = user_type.id";
    $result =  mysqli_query($conn, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $response = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => "User List Fetched Successfully",
                'data' => $response
            ];
            error(200);
            return json_encode($data, JSON_PRETTY_PRINT);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Users not found',
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
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
// FETCH USER
function getUser($userInput)
{
    global $conn;
    $userId = mysqli_real_escape_string($conn, $userInput['id']);
    $query = "SELECT * FROM user WHERE id = '$userId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($userId != '') {
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $response = mysqli_fetch_assoc($result);
                $data = [
                    'status' => 200,
                    'message' => "User Information Fetched Successfully",
                    'data' => $response
                ];
                error(200);
                return json_encode($data, JSON_PRETTY_PRINT);
            } else {
                $data = [
                    'status' => 404,
                    'message' => "User ID not found",
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
            'message' => "Empty User ID",
        ];
        error(404);
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
// CREATE USER   
function createUser($userInput)
{
    global $conn;
    $fname = mysqli_real_escape_string($conn, $userInput['fname']); // $_GET - For Getting the input array
    $mname = mysqli_real_escape_string($conn, $userInput['mname']);
    $lname = mysqli_real_escape_string($conn, $userInput['lname']);
    $bdate = mysqli_real_escape_string($conn, $userInput['bdate']);
    $fdsdate = mysqli_real_escape_string($conn, $userInput['fdsdate']);
    $username = mysqli_real_escape_string($conn, $userInput['username']);
    $password = mysqli_real_escape_string($conn, $userInput['password']);
    $position_id = mysqli_real_escape_string($conn, $userInput['position_id']);

    $fields = ['fname', 'mname', 'lname', 'bdate', 'fdsdate', 'username', 'password', 'position_id'];
    $errors = [];

    foreach ($fields as $field) {
        $value = mysqli_real_escape_string($conn, $userInput[$field]);
        if (empty(trim($value))) {
            $errors[] = ['name' => $field, 'message' => "This field is required"];
        }
    }

    if (empty(trim($position_id)) || $position_id === 0) {
        $errors[] = ['name' => 'position_id', 'message' => 'Select a position'];
    }

    if (!empty($errors)) {
        $data = ['status' => 400, 'message' => 'Validation errors', 'errors' => $errors];
        http_response_code(400);
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit();
    }

    $query = "INSERT INTO user (id, fname, mname, lname, bdate, fdsdate, username, password, position_id) 
        VALUES (NULL, '$fname', '$mname', '$lname', '$bdate', '$fdsdate', '$username', '$password', '$position_id')";
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
// UPDATE USER
function updateUser($userInput, $userParams)
{
    global $conn;
    if (!isset($userParams['id'])) {
        return errorMessage("User not found in the URL");
    } else if ($userParams['id'] == '') {
        return errorMessage("Enter the User ID");
    }
    $userId = mysqli_real_escape_string($conn, $userParams['id']); // $_POST - For getting the ID only
    $fname = mysqli_real_escape_string($conn, $userInput['fname']); // $_GET - For Getting the input array
    $mname = mysqli_real_escape_string($conn, $userInput['mname']);
    $lname = mysqli_real_escape_string($conn, $userInput['lname']);
    $bdate = mysqli_real_escape_string($conn, $userInput['bdate']);
    $fdsdate = mysqli_real_escape_string($conn, $userInput['fdsdate']);
    $username = mysqli_real_escape_string($conn, $userInput['username']);
    $password = mysqli_real_escape_string($conn, $userInput['password']);
    $position_id = mysqli_real_escape_string($conn, $userInput['position_id']);
    if (empty(trim($fname))) {
        $errors[] = ['name' => 'fname', 'message' => 'Enter your first name'];
    }
    if (empty(trim($mname))) {
        $errors[] = ['name' => 'mname', 'message' => 'Enter your middle name'];
    }
    if (empty(trim($lname))) {
        $errors[] = ['name' => 'lname', 'message' => 'Enter your last name'];
    }
    if (empty(trim($bdate))) {
        $errors[] = ['name' => 'bdate', 'message' => 'Enter your birth date'];
    }
    if (empty(trim($fdsdate))) {
        $errors[] = ['name' => 'fdsdate', 'message' => 'Enter your F.D.S date'];
    }
    if (empty(trim($username))) {
        $errors[] = ['name' => 'username', 'message' => 'Enter your username'];
    }
    if (empty(trim($password))) {
        $errors[] = ['name' => 'password', 'message' => 'Enter your password'];
    }
    if (empty(trim($position_id)) || $position_id === 0) {
        $errors[] = ['name' => 'position_id', 'message' => 'Select a position'];
    }
    // Terminates the script if above errors serverside-validations are triggered
    if (!empty($errors)) {
        $data = [
            'status' => 400,
            'message' => 'Validation errors',
            'errors' => $errors,
        ];
        http_response_code(400);
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit();
    }
    $query = "UPDATE user SET fname='$fname', 
        mname='$mname', 
        lname='$lname', 
        bdate='$bdate', 
        fdsdate='$fdsdate', 
        username='$username', 
        password='$password', 
        position_id='$position_id' WHERE id = '$userId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $data = [
            'status' => 200,
            'message' => "User Updated Successfully",
        ];
        error(200);
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
// DELETE USER
function deleteUser($userParams)
{
    global $conn;
    $delete_id = mysqli_real_escape_string($conn, $userParams['id']);
    if (empty(trim($delete_id))) {
        return errorMessage('Enter User ID');
    } else {
        $query = "DELETE FROM user WHERE user.id = $delete_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            if (mysqli_affected_rows($conn) > 0) {
                $data = [
                    'status' => 200,
                    'message' => "User Deleted Successfully",
                ];
                error(200);
            } else {
                $data = [
                    'status' => 404,
                    'message' => "User ID not found",
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
