<?php
require 'db_connect.php';

// Controleer of er een ID is meegegeven
if (isset($_GET['username'])) {

    // Verwijder de taak uit de database
    $stmt = $conn->prepare("DELETE FROM tasks WHERE username = '".$_POST["username"]."'");
    $stmt->bind_param('i', $id);
    
    if ($stmt->execute()) {

        header('Location: index.php');
        exit;
    } else {
        echo "Fout bij verwijderen van taak.";
    }
} else {
    echo "Geen geldige username opgegeven.";
}
?>
