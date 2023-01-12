<?php
include "library/db.php";
session_start();
$userID = $_SESSION['loggedin'];
if (!isset($_SESSION['loggedin'] )) {
  header('location: sign-in.php');
}
$conn = connect();
$select = "SELECT message,time,username,userID FROM messages LEFT join users on messages.userID = users.ID ORDER BY time DESC";
$q = mysqli_query($conn, $select);
    while ($row = mysqli_fetch_array($q)): {
        if ($row['userID'] == $userID) {
            $cardinfo = "card text-white bg-primary mb-3";
            $cardstyle = "max-width: 25rem; margin-left: 40%;";
            $delete = '<form action="delete-action.php" method="POST"><input type="hidden" name="message_id" value="<?=$row["ID"]?>"><input type="submit" value="Delete" class="btn btn-secondary" class="form-control" style="margin-left: 60%;"></form>';
        }
        else {
            $cardinfo = "card bg-light mb-3";
            $cardstyle = "max-width: 25rem; margin-left: 25%;";
            $delete = "";
            }
?>
<div class="<?php echo "$cardinfo"?>" style="<?php echo "$cardstyle"?>">
    <div class="card-header" style="font-size:30px;"><?= $row['username'] ?><?= $delete ?></div>
    <div class="card-body">
        <h4 class="card-title"><?= $row['message']; ?></h4>
        <p class="card-text"><?= $row['time']; ?></p>
    </div>
</div>
<?php } endwhile; ?>