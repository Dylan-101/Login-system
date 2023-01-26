<?php
if ($_POST['InputPassword'] == $_POST['InputPasswordConfirm']) {
    include "library/db.php";
    $conn = connect();
    $query = "SELECT * FROM users WHERE username=? AND ID!=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $_POST['username'], $_POST["ID"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user) {
        session_start();
        $_SESSION['settingsusererror'] = true;
        header('location: settings.php');
    } else {
        $query = "SELECT * FROM users WHERE email=? AND ID!=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $_POST['email'], $_POST["ID"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $email = $result->fetch_assoc();
        if ($email) {
            session_start();
            $_SESSION['settingsemailerror'] = true;
            header('location: settings.php');
        }
        else {
            $query = "SELECT * FROM users WHERE ID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $_POST["ID"]);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            var_dump($user);
            if (password_verify($_POST['InputPasswordCurrent'], $user['password'])){
                if ($_POST['InputPassword'] != "") {
                    $password = password_hash($_POST['InputPassword'], PASSWORD_DEFAULT);
                    $query = "UPDATE users SET username=?, password=?, email=? WHERE ID=?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssi", $_POST['username'], $password, $_POST['email'], $_POST["ID"]);
                    $stmt->execute();
                    header('location: settings.php'); }
                else {
                        $query = "UPDATE users SET username=?, email=? WHERE ID=?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ssi", $_POST['username'], $_POST['email'], $_POST["ID"]);
                        $stmt->execute();
                        header('location: settings.php'); }


                }
            else{
                session_start();
                $_SESSION['settingscurrentpasserror'] = true;
                header('location: settings.php');
                }
            }
        }
    }
  else {
    session_start();
    $_SESSION['settingspasserror'] = true;
    header('location: settings.php');
}   
?>
</body>
</html>