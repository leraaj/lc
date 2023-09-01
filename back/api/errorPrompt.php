<?php
// ERROR MESSAGES
function errorMessage($message)
{
    $data = [
        'status' => 400,
        'message' => $message,
    ];
    header(`HTTP/1.0 400 $message`);
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit();
}
function error($error_code)
{
    switch ($error_code) {
        case '200':
            header("HTTP/1.0 200 Success");
            break;
        case '201':
            header("HTTP/1.0 201 Created");
            break;
        case '404':
            header("HTTP/1.0 404 Not Found");
            break;
        case '405':
            header("HTTP/1.0 Method Not Allowed");
            break;
        case '500':
            header("HTTP/1.0 500 Internal Server Error");
            break;
        case '400':
            header("HTTP/1.0 400 Bad Request");
            break;
    }
}
