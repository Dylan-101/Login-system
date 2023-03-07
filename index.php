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
    $darkmodecss = "bootstrap-5.0.2-dist-lightmode/css/bootstrap.css";
    $darkmodejs ="bootstrap-5.0.2-dist-lightmode/js/bootstrap.js";
    $darkbutton = "";
    if($_SESSION["isdark"] === 1) {
      $darkmodecss = "bootstrap-5.0.2-dist-darkmode/css/bootstrap.css";
      $darkmodejs ="bootstrap-5.0.2-dist-darkmode/js/bootstrap.js";
      $darkbutton = '--bs-btn-bg: #000; --bs-btn-border-color: #000; --bs-btn-hover-bg: #858181;"';
    }
    $_SESSION["badword"] = false;
    $invalidtext = "form-control";
    if($_SESSION["badword"] === TRUE){
      $invalidtext = "form-control is-invalid";
      $_SESSION["badword"] = false;
    }
?>
<!DOCTYPE html>
<html> 
<head>
    <title>Blue bird</title>
    <link rel="stylesheet" href="<?= $darkmodecss?>">
    <script src="<?= $darkmodejs?>"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <script src="index.js"> </script>
</head>
<body>
<script>
function addEmoji(emoji) {
  let input = document.getElementById('userinput');
  
  input.value += emoji;
}

function toggleEmojiDrawer() {
  let drawer = document.getElementById('drawer');

  if (drawer.classList.contains('hidden')) {
    drawer.classList.remove('hidden');
  } else {
    drawer.classList.add('hidden');
  }

  return false;
}
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
                        <a class="nav-link active" href="index.php">Home
                          <span class="visually-hidden">(current)</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="settings.php"?>Settings</a>
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
<h1 style="margin-top: 1%; margin-left: 44%; margin-right: auto; width: 25%; display:block">Message Board</h1>
<div id="messageboard">
        <?php
            $conn = connect();
            $select = "SELECT message,time,username,profileimage,deleted,deleteduser,userID,messages.ID AS message_id FROM messages LEFT join users on messages.userID = users.ID ORDER BY time DESC";
            $q = mysqli_query($conn, $select);
              while ($row = mysqli_fetch_array($q)): {
                if ($row['userID'] == $userID) {
                  $cardinfo = "card text-white bg-primary mb-3";
                  $cardstyle = "max-width: 25rem; margin-left: 51%;";
                  $messageid = $row['message_id'];
                  $delete = '<form action="delete-action.php" method="POST"><input type="submit" value="Delete" class="btn btn-secondary" class="form-control" style="float: right;">';
                  if($_SESSION["isdark"] === 1) {
                    $delete = '<form action="delete-action.php" method="POST"><input type="submit" value="Delete" class="btn btn-secondary" class="form-control" style="float: right;' . $darkbutton . '>';
                  }
                  $messagehiddenid = '<input type="hidden" name="message_id" value="'. $messageid.'"></form>';
                  $msgusername = $row['username'];
                  $pfp = $row['profileimage'];
                }
                else {
                  $cardinfo = "card bg-light mb-3";
                  $cardstyle = "max-width: 25rem; margin-left: 38%;";
                  $messagehiddenid = "";
                  $messageid = $row['message_id'];
                  if ($row['deleted'] == 1) {
                    $msgusername = $row['deleteduser'];
                    $pfp = 'image-uploads/default.png';
                  }
                  else {
                    $msgusername = $row['username'];
                    $pfp = $row['profileimage'];
                  }
                  if ($_SESSION['admin'] === 1 or $_SESSION['admin'] === 2) {
                    $delete = '<form action="delete-action.php" method="POST"><input type="submit" value="Delete" class="btn btn-secondary" class="form-control" style="float: right;' . $darkbutton . '>';
                    $messagehiddenid = '<input type="hidden" name="message_id" value="'. $messageid.'"></form>';
                  }
                  else {
                    $delete = "";
                  }
                }
              
            ?>
              <div class="<?php echo "$cardinfo"?>" style="<?php echo "$cardstyle"?>">
                <div class="card-header" style="font-size:100vm;">
                  <image id="profileImage" style="width: 50px; height: 50px; margin-right: 2%;" src='<?= $pfp; ?>' />
                  <?= $msgusername ?>
                  <?= $delete ?> <?= $messagehiddenid ?>
                </div>
                <div class="card-body">
                  <h4 class="card-title"><?= $row['message']; ?></h4>
                  <p class="card-text"><?= $row['time']; ?></p>
                </div>
            </div>
            <?php } endwhile; ?>
</div>
  <div class="row fixed-bottom" style ="height: 40px; margin-bottom: 10px;">
    <div class="row">
      <div style="width: 100%;">
        <form action="index-action.php" method="POST" id="userinputform">
          <div class="input-group">
            <textarea class="<?=$invalidtext?>" style="max-width: 50rem; margin-left: 33%; height: 10px" name="messageinput" rows="1" id="userinput"></textarea>
            <span><input type="submit" value="Send" class="btn btn-secondary" class="form-control" style="margin-left: 2%; position: inline; <?=$darkbutton?>"></span>
            <span><div class="dropup" style="width: 80px; height:40px; margin-right:5px; margin-left: 0%;"></span>
            <button type="button" class="dropbtn" style="height:38px;">Emoji's</button>
              <div class="dropup-content">
                <a class="emoji" onclick="addEmoji(this.innerHTML)">😀</a>
                <a class="emoji" onclick="addEmoji(this.innerHTML)">😃</a>
                <a class="emoji" onclick="addEmoji(this.innerHTML)">😄</a>
                <a class="emoji" onclick="addEmoji(this.innerHTML)">😁</a>
                <a class="emoji" onclick="addEmoji(this.innerHTML)">😆</a>
              </div>
            </div>
          </div>
          </form>
</div>
</div>
</div>
</div>
</body>
<script>
$("#userinput").keypress(function (e) {
    if(e.which === 13 && !e.shiftKey) {
        e.preventDefault();
    
        $(this).closest("form").submit();
    }
});        
</script>
</html>