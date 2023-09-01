<?php
require_once '../back/conn.php';
require_once '../back/cdn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
</head>

<body>
  <nav class="nav navbar bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand text-light">Leavecard</a>
      <div class="flex-end">
        <button class="btn btn-sm btn-secondary">Login</button>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <nav class="nav navbar py-3">
      <div class="container-fluid row mx-0">
        <div class="col"><a href="#" class="navbar-brand">Home</a></div>
        <div class="col">
          <input type="search" name="" id="" class="form-control form-control-sm" placeholder="search" />
        </div>
      </div>
    </nav>
    <table class="table table-bordered table-sm table-hover text-center align-middle">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Birth Date</th>
          <th scope="col">First Day of Service</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>John</td>
          <td>Doe</td>
          <td>06/15/1999</td>
          <td>06/15/1999</td>
          <td>
            <div class="btn-group gap-1">
              <button class="btn btn-sm btn-dark rounded-0">view</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>