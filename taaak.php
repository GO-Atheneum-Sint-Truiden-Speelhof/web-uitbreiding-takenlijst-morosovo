<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of de taak niet leeg is
    if (!empty($_POST['task'])) {
        $task = $_POST['task'];

        // Voeg de taak toe aan de database
        $stmt = $conn->prepare("INSERT INTO todos (taak, status) VALUES (?, 'Niet voltooid')");
        $stmt->bind_param('s', $task);

        if ($stmt->execute()) {
            // Succesvol toegevoegd, terug naar index.php
            header('Location: index.php');
            exit;
        } else {
            echo "Fout bij toevoegen van taak.";
        }
    } else {
        echo "De taak mag niet leeg zijn.";
    }
}
?>
