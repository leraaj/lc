<?php
require_once '../back/conn.php';
require_once '../back/cdn.php';
include_once "../front/modals.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Settings</title>
</head>

<body class="d-flex">
    <?php include_once '../front/nav.php'; ?>
    <aside class="col">
        <nav class="nav navbar py-3 shadow-sm aside-nav">
            <div class="container-fluid row mx-0">
                <div class="col"><a href="#" class="navbar-brand">Settings</a></div>
                <div class="col d-flex justify-content-end gap-2">
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row mx-0 gap-2 pt-3">
                <div class="col-12 p-0">
                    <div class="input-group">
                        <span class="input-group-text">School</span>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-lg p-0">
                    <div class="input-group mb-2">
                        <span class="input-group-text">Terminology</span>
                        <input type="text" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Position</span>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-lg p-0">
                    <div class="input-group mb-2">
                        <span class="input-group-text">Terminology</span>
                        <input type="text" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Position</span>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

        </div>
        </div>
    </aside>
</body>

</html>