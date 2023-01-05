<?php  

    include "library/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blue bird</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.js"> </script>
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
                        <a class="nav-link" href="#">Home
                          <span class="visually-hidden">(current)</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="register.php">Sign up</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="sign-in.php">Login</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
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
<h1 style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 27%; display:block">Logged in</h1>
<div class="container" style="margin-top: 10%;">
  <div class="row">
    <div class="col">
    </div>
    <div class="col" id="thread">
        <?php
            $conn = connect();
            $select = "SELECT message,time,username FROM messages LEFT join users on messages.userID = users.ID ORDER BY time DESC";
            $q = mysqli_query($conn, $select);
            while ($row = mysqli_fetch_array($q)) {
                echo $row['username'] . " " . $row['time'] . " " . $row['message'];
            }
        ?>
    </div>
    <div class="col">
    </div>
  </div>
</div>
</body>
</html>