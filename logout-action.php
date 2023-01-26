<?php
   session_destroy($_SESSION["admin"]);
   session_destroy($_SESSION["loggedin"]);
   session_destroy($_SESSION["terminated"]);
   header('location: sign-in.php');
?>