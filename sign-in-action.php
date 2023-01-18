<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
include "classes.php";
$user = User::load($_POST['username'], $_POST['password']);

if (!$user) {
    session_destroy();
    session_unset();
    session_start();
    $_SESSION['passloginfail'] = true;
    header('location: sign-in.php');
} else {
    session_start();
    $_SESSION['loggedin'] = $user->id;
    $_SESSION['admin'] = $user->admin;
    header('location: index.php');
    }


?>
</body>
</html>
