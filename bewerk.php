<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM todos WHERE id = $id");
    $task = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $task = $conn->real_escape_string($_POST['task']);
    $conn->query("UPDATE todos SET task = '$task' WHERE id = $id");
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taak Bewerken</title>
</head>
<body>
    <form action="bewerk.php" method="post">
        <input type="hidden" name="Id" value="<?= $task['Id'] ?>">
        <input type="text" name="task" value="<?= htmlspecialchars($task['task']) ?>" required>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
