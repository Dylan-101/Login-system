<?php  
    include "library/db.php";
    session_start();
    $userID = $_SESSION['loggedin'];
    if (!isset($_SESSION['loggedin'] )) {
      header('location: sign-in.php');
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

<script>
   // $(document).ready(function() {
       // $('#messageboard').load('reload-messages.php');
       // var refreshId = setInterval(function() {
      //      $('#messageboard').load('reload-messages.php');
       // }, 1000);
      //  $.ajaxSetup({ cache: false });
   // })

function addEmoji(emoji) {
  let inputEle = document.getElementById('input');
  
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
                        <a class="nav-link active" href="#">Home
                          <span class="visually-hidden">(current)</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="register.php">Sign up</a>
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
<h1 style="margin-top: 1%; margin-left: auto; margin-right: auto; width: 25%; display:block">Message Board</h1>
<div id="messageboard">
        <?php
            $conn = connect();
            $select = "SELECT message,time,username,userID,messages.ID AS message_id FROM messages LEFT join users on messages.userID = users.ID ORDER BY time DESC";
            $q = mysqli_query($conn, $select);
              while ($row = mysqli_fetch_array($q)): {
                if ($row['userID'] == $userID) {
                  $cardinfo = "card text-white bg-primary mb-3";
                  $cardstyle = "max-width: 25rem; margin-left: 40%;";
                  $messageid = $row['message_id'];
                  $delete = '<form action="delete-action.php" method="POST"><input type="submit" value="Delete" class="btn btn-secondary" class="form-control" style="margin-left: 60%;">';
                  $messagehiddenid = '<input type="hidden" name="message_id" value="'. $messageid.'"></form>';
                }
                else {
                  $cardinfo = "card bg-light mb-3";
                  $cardstyle = "max-width: 25rem; margin-left: 25%;";
                  $delete = "";
                  $messagehiddenid = "";
                }

              
            ?>
              <div class="<?php echo "$cardinfo"?>" style="<?php echo "$cardstyle"?>">
                <div class="card-header" style="font-size:30px;"><?= $row['username'] ?><?= $delete ?> <?= $messagehiddenid ?></div>
                <div class="card-body">
                  <h4 class="card-title"><?= $row['message']; ?></h4>
                  <p class="card-text"><?= $row['time']; ?></p>
                </div>
            </div>
            <?php } endwhile; ?>

            <div id="drawer" class="emoji-drawer hidden"> 
            <select multiple="" class="form-select" style="width: 80px; heigh:40; margin-right:5px; margin-left: 1500%;">
            <option class="emoji" onclick="addEmoji(this.innerHTML)">😀</option>
            <option class="emoji" onclick="addEmoji(this.innerHTML)">😃</option>
            <option class="emoji" onclick="addEmoji(this.innerHTML)">😄</option>
            <option class="emoji" onclick="addEmoji(this.innerHTML)">😁</option>
            <option class="emoji" onclick="addEmoji(this.innerHTML)">😆</option>
            </select>
</div>
  <div class="row fixed-bottom" style ="height: 40px; margin-bottom: 10px;">
    <div class="row">
      <div style="width: 100%;">
        <form action="index-action.php" method="POST">
          <div class="input-group">
            <textarea class="form-control" style="max-width: 50rem; margin-left: 25%; height: 10px" name="messageinput" rows="1" id=input></textarea>
            <span><input type="submit" value="Send" class="btn btn-secondary" class="form-control" style="margin-left: 2%; position: inline;"></span>
            <button  type="button" onclick="toggleEmojiDrawer()" style="height: 30px">Emojis</button>
          </div>
          </form>
</div>
</div>
</div>
</div>
</body>
</html>