<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require 'db_connect.php';

$result = $conn->query("SELECT * FROM todos");
if (!$result) {
    die("Fout in de query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takenlijst</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Takenlijst</h1>
        <!-- formulier voor nieuwe taak -->
        <form action="taaak.php" method="post" class="mb-4">
            <div class="mb-3">
                <label for="task" class="form-label">Taaknaam:</label>
                <input type="text" name="task" id="task" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-select">
                    <option value="Niet voltooid">Niet voltooid</option>
                    <option value="Voltooid">Voltooid</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="instructies" class="form-label">Instructies:</label>
                <textarea name="instructies" id="instructies" class="form-control" placeholder="Voeg instructies toe (optioneel)"></textarea>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>

        <!-- Takenlijst -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Taaknaam</th>
                    <th>Status</th>
                    <th>Instructies</th>
                    <th>Deadline</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>" . htmlspecialchars($row['task']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                            <td>" . htmlspecialchars($row['instructies']) . "</td>
                            <td>" . htmlspecialchars($row['deadline']) . "</td>
                            <td>
                                <a href='bewerk.php?id=" . $row['Id'] . "' class='btn btn-sm btn-primary'>Bewerken</a>
                                <a href='verwijder.php?id=" . $row['Id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Weet je zeker dat je deze taak wilt verwijderen?');\">Verwijderen</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Geen taken gevonden.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>