<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if ($_POST['password'] == $_POST['confirmpassword']) {
    include "library/db.php";
    $conn = connect();
    $query = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user) {
        session_destroy();
        session_unset();
        session_start();
        $_SESSION['usererror'] = true;
        header('location: register.php');
    } else {
        session_destroy();
        session_unset();
        session_start();
        $query = "SELECT * FROM users WHERE email=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_POST['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        $email = $result->fetch_assoc();
        if ($email) {
            $_SESSION['emailerror'] = true;
            header('location: register.php');
        }
        else {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, password, email, Admin) VALUES (?, ?, ?, 0)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
            header('location: sign-in.php?msg=Registered successfully'); }
        }
    }
  else {
    session_destroy();
    session_unset();
    session_start();
    $_SESSION['passerror'] = true;
    header('location: register.php');
}   
?>
</body>
</html>
