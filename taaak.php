<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['task'])) {
        $task = $conn->real_escape_string($_POST['task']);
        $conn->query("INSERT INTO todos (task, status) VALUES ('$task', 'Niet voltooid')");
    }
}

header('Location: index.php');
exit;
?>
