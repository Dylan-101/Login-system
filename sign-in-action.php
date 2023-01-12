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
    header('location: index.php');
}

/*
include "library/db.php";
$conn = connect();
$query = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_POST['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user) {
    if (password_verify($_POST['password'], $user['password'])) {
        session_start();
        $_SESSION['loggedin'] = $user['ID'];
        header('location: index.php');
    } else {
        session_destroy();
        session_unset();
        session_start();
        $_SESSION['passloginfail'] = true;
        header('location: sign-in.php');
    }
} else {
    session_destroy();
    session_unset();
    session_start();
    $_SESSION['userloginfail'] = true;
    header('location: sign-in.php');
}
*/
?>
</body>
</html>
