<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
session_start();
if ($_SESSION['admin'] === 0) {
    header('location: admin-action.php');
}
include "library/db.php";
$conn = connect();
$query = "UPDATE users SET username=?, email=?, admin=? WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssii", $_POST['username'], $_POST['email'], $_POST['admin'], $_POST['ID']);
$stmt->execute();
$_SESSION['adminedit'] = true;
header('location: admin.php')
?>
</body>
</html>