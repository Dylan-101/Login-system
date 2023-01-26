<?php
session_start();
if ($_SESSION['admin'] === 0) {
    header('location: admin-action.php');
}
include "library/db.php";
$conn = connect();
$sql = "DELETE FROM users WHERE ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$_POST["ID"]);
$stmt->execute();
header('location: admin.php');
?>