<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['task'])) {
        $task = $conn->real_escape_string($_POST['task']);
        $status = !empty($_POST['status']) ? $conn->real_escape_string($_POST['status']) : 'Niet voltooid';
        $instructies = !empty($_POST['instructies']) ? $conn->real_escape_string($_POST['instructies']) : null;
        $deadline = !empty($_POST['deadline']) ? $conn->real_escape_string($_POST['deadline']) : null;

        $query = "INSERT INTO todos (task, status, instructies, deadline) VALUES ('$task', '$status', '$instructies', ";
        $query .= $deadline ? "'$deadline')" : "NULL)";
        $conn->query($query);
    }
}

header('Location: index.php');
exit;
?>