<?php
session_start();
if (($_SESSION["admin"] === 1) or ($_SESSION["admin"] === 2)) {
    $_SESSION['adminpass'] = true;
    header('location: admin.php');
}
  else {
    $_SESSION['admin'] = false;
    header('location: index.php');
}   
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
</body>
</html>
