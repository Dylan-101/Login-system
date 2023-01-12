<?php
include "library/db.php";
session_start();
$userID = $_SESSION['loggedin'];
if (!isset($_SESSION['loggedin'] )) {
  header('location: sign-in.php');
}
$conn = connect();
$query = "DELETE FROM messages WHERE messages.ID=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_POST['message_id']);
$stmt->execute();
header('location: index.php');