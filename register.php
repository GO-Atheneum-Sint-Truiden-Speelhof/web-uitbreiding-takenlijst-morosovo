<?php
session_start(); // Start the sessionn

function checkRegisterAndFetchMatch() {
    $servername = "localhost";
    $username = "Elion";
    $password = "Elion1234";
    $dbname = "takenlijst";

    // Verbinding maken met de database
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!isset($_SESSION['registerd']) || $_SESSION['registerd'] !== true) {
        // Sanitize user input to prevent SQL injection
        $username = $conn->real_escape_string($_POST['username']);
        $wachtwoord = $conn->real_escape_string($_POST['wachtwoord']);

        // Check if the login exists
        $sql = "SELECT * FROM gebruikers WHERE Username = '$username' AND Wachtwoord = '$password'";
        $result = $conn->query($sql);
    }
}