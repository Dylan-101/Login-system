<?php
    if($_SESSION["admin"] === 1){
      $adminlink = '<li class="nav-item">
      <a class="nav-link" href="admin-action.php"?>Admin</a>
    </li>';

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
    <script src="index.js"> </script>
</head>
<body>
<script>
  
</script>
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
                        <a class="nav-link active" href="#">Home
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
                      <?php echo "$adminlink"?>
                    </ul>
                    <form class="d-flex">
                      <input class="form-control me-sm-2" type="text" placeholder="Search">
                      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                  </div>
                </div>
            </nav>
        </div>