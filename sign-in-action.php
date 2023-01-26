<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
include "classes.php";
$user = User::load($_POST['username'], $_POST['password']);

if (!$user) {
    header('location: sign-in.php');
} 
else {
    if ($user->terminated === 0) {
    session_start();
    $_SESSION['loggedin'] = $user->id;
    $_SESSION['admin'] = $user->admin;
    $_SESSION['terminated'] = $user->terminated;
    $_SESSION['pfp'] = $user->profileimage;
    header('location: index.php');
    }
    else {
    session_start();
    $_SESSION['terminated'] = 1;
    header('location: sign-in.php');
    }
}


?>
</body>
</html>
