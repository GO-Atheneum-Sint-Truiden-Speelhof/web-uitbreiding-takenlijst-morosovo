<?php
require 'db_connect.php';

// Lees taken uit de database
$result = $conn->query("SELECT * FROM todos");
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Takenlijst</title>
</head>
<body>
    <h1>Takenlijst</h1>
    <form action="taaak.php" method="post">
        <input type="text" name="task" placeholder="Nieuwe taak toevoegen" required>
        <button type="submit">Toevoegen</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Taak</th>
                <th>Status</th>
                <th>Deadline</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['task'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="bewerk.php?id=<?= $row['id'] ?>">Bewerken</a>
                    <a href="verwijder.php?id=<?= $row['id'] ?>">Verwijderen</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
