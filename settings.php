<?php  
    include "library/db.php";
    session_start();
    $adminlink = "";
    $userID = $_SESSION['loggedin'];
    if (!isset($_SESSION['loggedin'] )) {
      header('location: sign-in.php');
    }
    if($_SESSION["admin"] === false) {
      echo '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <strong>Oh snap!</strong><span><p class="mb-0">Sorry you are not an admin</p></span>
      </div>';
      $_SESSION["admin"] = 0;
    }
    if(($_SESSION["admin"] === 1) or ($_SESSION["admin"] === 2)){
      $adminlink = '<li class="nav-item">
      <a class="nav-link" href="admin-action.php"?>Admin</a>
    </li>';
    }
$useralert = "hidden";
$userinvalid = "form-control";
if (isset($_SESSION['settingsusererror'])) {
    $useralert = "";
    $userinvalid = "form-control is-invalid";
    unset($_SESSION['settingsusererror']);
}
$passalert = "hidden";
$passinvalid = "form-control";
if (isset($_SESSION['settingspasserror'])) {
    $passalert = "";
    $passinvalid = "form-control is-invalid";
    unset($_SESSION['settingspasserror']);
}
$emailalert = "hidden";
$emailinvalid = "form-control";
if (isset($_SESSION['settingsemailerror'])) {
    $emailalert = "";
    $emailinvalid = "form-control is-invalid";
    unset($_SESSION['settingsemailerror']);
}
$currentpassalert = "hidden";
$currentpassinvalid = "form-control";
if (isset($_SESSION['settingscurrentpasserror'])) {
    $currentpassalert = "";
    $currentpassinvalid = "form-control is-invalid";
    unset($_SESSION['settingscurrentpasserror']);
}
$darkmodecss = "bootstrap-5.0.2-dist-lightmode/css/bootstrap.css";
$darkmodejs ="bootstrap-5.0.2-dist-lightmode/js/bootstrap.js";
$isdarkchecked = "";
if($_SESSION["isdark"] === 1) {
  $darkmodecss = "bootstrap-5.0.2-dist-darkmode/css/bootstrap.css";
  $darkmodejs ="bootstrap-5.0.2-dist-darkmode/js/bootstrap.js";
  $isdarkchecked = "checked";
}
$conn = connect();
$sql = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['loggedin']);
$row = $stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blue bird</title>
    <link rel="stylesheet" href="<?= $darkmodecss?>">
    <script src="<?= $darkmodejs?>"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="settings.css">
    <script src="settings.js"> </script>
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
                        <a class="nav-link" href="index.php">Home
                          <span class="visually-hidden">(current)</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="settings.php"?>Settings</a>
                      </li>
                      <?php echo "$adminlink"?>
                      <li class="nav-item">
                        <a class="nav-link" href="logout-action.php">Logout</a>
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
<h1 style="margin-top: 1%; margin-left: 45.2%; margin-right: auto; width: 25%; display:block">Settings</h1>
<h2 style="margin-top: 1%; margin-left: 43%; margin-right: auto; width: 15%; display:block">Account Settings</h2>
<form action="uploader-action.php" method="post" enctype="multipart/form-data">
<div id="profile-container" style="margin-left: 45%; margin-top: 3% border-radius: 25px; border: 5px solid #2780e3">
   <image id="profileImage" src="<?= $users['profileimage']; ?>" />
</div>
  <div style="margin-left: 40%; margin-top: 1%;">
  Select image to upload: <input style="margin-left: 1%; width: 200px;" required type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
  <input type="hidden" name="userID" value="<?=$_SESSION['loggedin']?>">
  </div>
</div>
</form>
<form action="settings-edit-action.php" method="POST">
    <div class="mb-3">
    <label for="inputUsername" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block; font-size: 20px;" >Username</label>
    <input type="text" disabled class="<?php echo "$userinvalid" ?>" id="InputUsername" aria-describedby="usernameHelp" name="username" value="<?= $users["username"] ?>" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;" required>
    <div id="Usernamehelp" class="form-text" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block;" >Enter a cool username!</div>
    <div class='alert alert-danger' role='alert' <?php echo "$useralert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Username Already Taken</div>
</div>
  </div>
  <div class="mb-3">
    <label for="inputEmail" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block; font-size: 20px;" >Email address</label>
    <input type="email" disabled class="<?php echo "$emailinvalid" ?>" id="InputEmail" aria-describedby="emailHelp" name="email" value="<?= $users["email"] ?>" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;" required>
    <div id="emailHelp" class="form-text" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block" >We'll never share your email with anyone else.</div>
    <div class='alert alert-danger' role='alert' <?php echo "$emailalert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Email already in use</div>
  </div>
  <div class="mb-3">
    <label for="InputPasswordCurrent" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block; font-size: 20px;">Current Password</label>
</div>
  <div class="input-group mb-3">
    <input type="password" disabled class="<?php echo "$currentpassinvalid" ?>" id="InputPasswordCurrent" name="InputPasswordCurrent" placeholder="Password" style="margin-top: 1%; margin-left: 40%; margin-right: auto; width: 50px;" required>
    <button class="btn btn-primary" style="margin-right: 35%; background-color: #373a3c; border-color: #373a3c; margin-top: 1%" type="button" onclick="toggleeditpass()" id="passwordeditbutton" disabled>Change Password</button>
    <div class='alert alert-danger' role='alert' <?php echo "$currentpassalert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Passwords is incorrect</div>
  </div>
<div id="passwords" hidden>
  <div class="mb-3">
    <label for="InputPassword" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block; font-size: 20px;">New Password</label>
    <input type="password" class="form-control" id="InputPassword" name="InputPassword" placeholder="Password" value="" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;">
  </div>
  <div class="mb-3">
    <label for="InputPasswordConfirm" class="form-label" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block; font-size: 20px;">Confirm New Password</label>
    <input type="password" class="<?php echo "$passinvalid" ?>" id="InputPasswordConfirm" name="InputPasswordConfirm" placeholder="Password" value="" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%;">
    <div class='alert alert-danger' role='alert' <?php echo "$passalert" ?> style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">Passwords do not match</div>
  </div>
</div>
  <div class="mb-3">
    <input type="button" value="Edit" class="btn btn-primary" onclick="toggleeditform()" class="form-control" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">
  </div>
  <div>
      <input type="hidden" name="ID" value="<?= $users["ID"] ?>">
  </div>
  <div class="mb-3">
    <input type="submit" hidden id="submitbutton" class="btn btn-primary" class="form-control" style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 20%; display:block">
</div>
</form>
</div>
</div>
</div>
</div>
<h2 style="margin-top: 1%; margin-left: 43%; margin-right: auto; width: 15%; display:block">Website Settings</h2>
<form action="settings-update-action.php" style="margin-top: 1%; margin-left: 39%; margin-right: auto; width: 15%; display:block" method="POST">
<div class="form-check">
        <input class="form-check-input" style="margin: auto;" onchange="this.form.submit()" type="checkbox" name="darkmodecheck" id="darkmodecheck" <?=$isdarkchecked?>>
        <label class="form-check-label" style="margin-left: 3%;" for="darkmodecheck">Darkmode</label>
        <input type="hidden" name="ID" value="<?= $users["ID"] ?>">
</div>
</div>
</form>
</body>    
<script>
  function toggleeditform() {
  let Username = document.getElementById('InputUsername');
  toggledisable(Username)
  let Email = document.getElementById('InputEmail');
  toggledisable(Email)
  let PasswordCurrent = document.getElementById('InputPasswordCurrent');
  toggledisable(PasswordCurrent)
  let Submitbutton = document.getElementById("submitbutton");
  togglehidden(Submitbutton)
  let Passbutton = document.getElementById('passwordeditbutton');
  toggledisable(Passbutton);
  }
  function toggleeditpass() {
    let Passwords = document.getElementById('passwords');
    togglehidden(Passwords)
    let inputpassword = document.getElementById('InputPassword');
    togglerequired(inputpassword)
    let inputpasswordconfirm = document.getElementById('InputPasswordConfirm');
    togglerequired(inputpasswordconfirm)
    
  }
  function toggledisable(inputs){
  if (inputs.hasAttribute('disabled')) {
    inputs.removeAttribute("disabled","");
  } else {
    inputs.setAttribute("disabled", "");
  }
}
function togglehidden(inputs){
  if (inputs.hasAttribute('hidden')) {
    inputs.removeAttribute("hidden","");
  } else {
    inputs.setAttribute("hidden", "");
  }
}
function togglerequired(inputs){
  if (inputs.hasAttribute('required')) {
    inputs.removeAttribute("required","");
  } else {
    inputs.setAttribute("required", "");
  }
}
</script>
</html>