<?php
session_start();
$useralert = "hidden";
$userinvalid = "form-control";
if (isset($_SESSION['userloginfail'])) {
    $useralert = "";
    $userinvalid = "form-control is-invalid";
}
$passalert = "hidden";
$passinvalid = "form-control";
if (isset($_SESSION['passloginfail'])) {
    $passalert = "";
    $passinvalid = "form-control is-invalid";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign in</title>
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
<h1 style="margin-top: 1%; margin-left: 40%; margin-right: auto; width: 27%; display:block">Welcome back, please sign in!</h1>

<form action="sign-in-action.php" method="POST">
    <div class="mb-3">
    <label for="inputUsername1" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block" >Username</label>
    <input type="text" class="<?php echo "$userinvalid" ?>" id="InputUsername1" aria-describedby="usernameHelp" name="username" placeholder="Username" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;" required>
    <div id="Usernamehelp" class="form-text" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block" ></div>
    <div class='alert alert-danger' role='alert' <?php echo "$useralert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Username does not exist</div>
</div>
  </div>
  <div class="mb-3">
    <label for="InputPassword1" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Password</label>
    <input type="password" class="<?php echo "$passinvalid" ?>" id="InputPassword1" name="password" placeholder="Password" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;" required>
    <div class='alert alert-danger' role='alert' <?php echo "$passalert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Incorrect Password</div>
    </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary" class="form-control" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">
</div>
</form>
</body>
</html>