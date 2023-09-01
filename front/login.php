<?php
require_once '../back/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body class="h-100 d-flex justify-content-center align-items-center">
    <div class="card">
        <div class="card-header">CARLOS L. ALBERT HIGH SCHOOL</div>
        <div class="card-body row mx-0 gy-2">
            <div class="input-group">
                <input type="text" name="" id="" class="form-control form-control-sm" placeholder="username">
            </div>
            <div class="input-group">
                <input type="password" name="" id="" class="form-control form-control-sm" placeholder="password">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end gap-2">
            <button class="btn btn-sm btn-outline-secondary">Back</button>
            <button class="btn btn-sm btn-success">Sign-in</button>
        </div>
    </div>
</body>

</html>