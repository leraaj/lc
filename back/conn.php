<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'lc_db'; // change to lc_db later
// Try and connect using the info above. 
try {
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (!$conn) {
        header("HTTP/1.0 404 Not Found");
    } else {
        header("HTTP/1.0 200 OK");
    }
} catch (Exception $e) {
    header("HTTP/1.0 500 Internal Server Error");
    die();
}
