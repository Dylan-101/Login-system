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
$terminate = 1;
include "library/db.php";
$conn = connect();
$query = "UPDATE users SET deleted=? WHERE ID=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $terminate, $_POST['ID']);
$stmt->execute();
$_SESSION['adminedit'] = true;
header('location: admin.php')
?>
</body>
</html>