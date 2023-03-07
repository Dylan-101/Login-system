<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['loggedin'] )) {
    header('location: sign-in.php');
  }
$currentuserID = $_SESSION['loggedin'];
$messageinput = $_POST['messageinput'];
$messageinputclean = filter_var($messageinput, FILTER_SANITIZE_STRING);
$messageinputclean = str_replace("\n","<br>", $messageinputclean);
$messagearray = explode(" ", $messageinputclean);
$lines = file('big_list_of_naughty_words.txt', FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
foreach ($messagearray as $words) {
  foreach($lines as $line) {
    if ($words == $line)
    {
      $badword = TRUE;
    }
  }
}
$indexcount = 0;
for ($x = 0; $x <= (count($messagearray)/2); $x++) {
  $messagecheck2 = ($messagearray[$indexcount]);

}
echo "$messagecheck2";
if ($badword == TRUE){
  $_SESSION["badword"] = TRUE;
  //header('location: index.php');
}
else{
  include "library/db.php";
  $conn = connect();
  $query = "INSERT INTO messages (message, time , userID) VALUES (?,NOW(),?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("si", $messageinputclean, $currentuserID);
  $stmt->execute();
  //header('location: index.php');
}

?>
</body>
</html>
