<?php
session_start();
$_SESSION["adminedit"] = 0;
if ($_SESSION['admin'] === 0) {
    header('location: admin-action.php');
}
include "library/db.php";
$conn = connect();
if($_SESSION["adminedit"] === false) {
    echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Oh snap!</strong><span><p class="mb-0">Sorry something went wrong :(</p></span>
    </div>';
    $_SESSION["adminedit"] = 0;
}
if($_SESSION["adminedit"] === true){
    echo '<div class="alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Success!</strong><span><p class="mb-0">Updated the database!</p></span>
    </div>';
    $_SESSION["adminedit"] = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blue bird</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="index.css">
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
<h1 style="margin-left: 42%;">Registered Users</h1>

<table class="table">
  <thead class="bg-primary">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Admin</th>
      <th scope="col">Edit</th>
      <th scope="col">Hard Delete</th>
    </tr>
  </thead>
<?php

$sql = "SELECT * FROM users where admin=0";
$result = $conn->query($sql);
?>

<?php while ($row = $result->fetch_array(MYSQLI_ASSOC)): ?>
    <tr>
        <td><?= $row["ID"] ?></td>
        <td><?= $row["username"] ?></td>
        <td><?= $row["email"] ?></td>
        <td><?= $row["admin"] ?></td>
        <td><a href='admin-edit.php?id=<?= $row["ID"] ?>'>Edit</a></td>
        <td><a href='admin-hard-delete.php?id=<?= $row["ID"] ?>'>Hard Delete</a></td>
    </tr>
<?php endwhile; ?>

<?php
$result->free_result();
$conn->close();
?>

</body>
</html>
</body>
</html>