<?php
$servername = "localhost";
$db_user = "root";
$db_pwd = "";
$database = "takenlijst";

// Verbind met de database
$conn = new mysqli($servername, $db_user, $db_pwd, $database);

// Controleer verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
