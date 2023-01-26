<?php
session_start();
if (!isset($_SESSION['loggedin'] )) {
  header('location: sign-in.php');
}
if ($_SESSION['admin'] === 0) {
    header('location: admin-action.php');
}
include "library/db.php";
$conn = connect();
$sql = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['ID']);
$row = $stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<head>
    <title>Blue bird</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
</head>
<body>
<div class="bs-component">
              <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">Blue Bird</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="index.php">Home
                          <span class="visually-hidden">(current)</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="register.php">Sign up</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="logout-action.php">Logout</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="settings.php"?>Settings</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="admin-action.php"?>Admin</a>
                      </li>
                    </ul>
                    <form class="d-flex">
                      <input class="form-control me-sm-2" type="text" placeholder="Search">
                      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                  </div>
                </div>
            </nav>
        </div>
<br>
<h1 style="margin-left: 45%;">Editing <?= $users['username'] ?></h1>
<form action="admin-edit-action.php" method="POST">
<table class="table">
  <thead class="bg-primary">
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Admin</th>
      <th scope="col"></th>
    </tr>
  </thead>
<?php

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>
    <tr>
        <td><input type="text" name="username" value="<?= $users["username"] ?>"></td>
        <td><input type="text" name="email" value="<?= $users["email"] ?>"></td>
        <td><input type="text" name="admin" value="<?= $users["admin"] ?>"></td>
        <td><input type="submit"></td>
    </tr>
    <input type="hidden" name="ID" value="<?= $users["ID"] ?>">
</form>
</body>
</html>

<?php
$result->free_result();
$conn->close();