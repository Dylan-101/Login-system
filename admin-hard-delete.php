<?php
session_start();
if ($_SESSION['admin'] === 0) {
    header('location: admin-action.php');
}
include "library/db.php";
$conn = connect();
//and admin=0 is used to ensure an admin can't try and delete another admin using the URL
$sql = "DELETE FROM users WHERE ID=? and admin=0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$_GET["id"]);
$stmt->execute();
header('location: admin.php');
?>