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
include "library/db.php";
$conn = connect();
$query = "INSERT INTO messages (message, time , userID) VALUES (?,NOW(),?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $messageinputclean, $currentuserID);
$stmt->execute();
header('location: index.php');
?>
</body>
</html>
