<?php
function connect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password, "bluebird");
    if ($conn->connect_error) 
    { 
    die("Connection failed: " . $conn->connect_error);
    } 

return $conn;
}
?>