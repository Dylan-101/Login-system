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
$deletedusername = uniqid("DeletedUser", FALSE);
$terminate = 1;
include "library/db.php";
$conn = connect();
$query = "UPDATE users SET deleted=?, deleteduser=? WHERE ID=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("isi", $terminate, $deletedusername, $_POST['ID']);
$stmt->execute();
$_SESSION['adminedit'] = true;
header ("location: admin.php")
?>
</body>
</html>