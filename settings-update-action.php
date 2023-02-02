<?php
session_start();
if (isset($_POST['darkmodecheck'])) {
    $darkmodevalue = 1;
    $_SESSION["isdark"] = 1;
    echo "on";
}
elseif (!isset($_POST['darkmodecheck'])) {
    $darkmodevalue = 0;
    $_SESSION["isdark"] = 0;
    echo "off";
}
include "library/db.php";
$conn = connect();
$query = "UPDATE settings SET Isdark=? WHERE userID=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $darkmodevalue, $_POST['ID']);
$stmt->execute();
header('location: settings.php')
?>
</body>
</html>