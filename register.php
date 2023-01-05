<?php
session_start();
$useralert = "hidden";
$userinvalid = "form-control";
if (isset($_SESSION['usererror'])) {
    $useralert = "";
    $userinvalid = "form-control is-invalid";
}
$passalert = "hidden";
$passinvalid = "form-control";
if (isset($_SESSION['passerror'])) {
    $passalert = "";
    $passinvalid = "form-control is-invalid";
}
$emailalert = "hidden";
$emailinvalid = "form-control";
if (isset($_SESSION['emailerror'])) {
    $emailalert = "";
    $emailinvalid = "form-control is-invalid";
}
?>
<!DOCTYPE html>
<html>
  <style>
    label{
      font-size: 20px;
      font-weight: bold;
      color: #000000;
    }
    h1 {
      font-weight: bold;
      color: #ffffff;
    }
  </style>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/mainstyle.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.js"> </script>
</heads>
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
                        <a class="nav-link active" href="register.php">Sign up</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="sign-in.php">Login</a>
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
<h1 style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 23%; display:block">Welcome, please register!</h1>
<form action="register-action.php" method="POST">
    <div class="mb-3">
    <label for="inputUsername1" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block" >Username</label>
    <input type="text" class="<?php echo "$userinvalid" ?>" id="InputUsername1" aria-describedby="usernameHelp" name="username" placeholder="Username" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;" required>
    <div id="Usernamehelp" class="form-text" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block" >Enter a cool username!</div>
    <div class='alert alert-danger' role='alert' <?php echo "$useralert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Username Already Taken</div>
</div>
  </div>
  <div class="mb-3">
    <label for="inputEmail1" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block" >Email address</label>
    <input type="email" class="<?php echo "$emailinvalid" ?>" id="InputEmail1" aria-describedby="emailHelp" name="email" placeholder="Email" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;" required>
    <div id="emailHelp" class="form-text" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block" >We'll never share your email with anyone else.</div>
    <div class='alert alert-danger' role='alert' <?php echo "$emailalert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Email already in use</div>
  </div>
  <div class="mb-3">
    <label for="InputPassword1" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Password</label>
    <input type="password" class="form-control" id="InputPassword1" name="password" placeholder="Password" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;" required>
  </div>
  <div class="mb-3">
    <label for="InputPassword1Confirm" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Confirm Password</label>
    <input type="password" class="<?php echo "$passinvalid" ?>" id="InputPassword1Confirm" name="confirmpassword" placeholder="Password" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;" required>
    <div class='alert alert-danger' role='alert' <?php echo "$passalert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Passwords do not match</div>
  </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary" class="form-control" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">
</div>
</form>
</body>
</html>
<?php
session_destroy();
?>