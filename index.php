<?php
session_start(); // Start sessie
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Stuur niet-ingelogde gebruikers naar login.php
    exit;
}


require 'db_connect.php';

// Controleer of de query werkt
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
        <!-- Formulier voor nieuwe taak -->
        <form action="taaak.php" method="post" class="mb-4">
            <div class="input-group">
                <input type="text" name="task" class="form-control" placeholder="Nieuwe taak toevoegen" required>
                <button type="submit" class="btn btn-primary">Toevoegen</button>
            </div>
        </form>
        <!-- Takenlijst -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Taaknaam</th>
                    <th>Title</th>
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
                                <a href='bewerk.php?id=" . $row['Id'] . "' class='btn btn-sm btn-primary' title='Bewerken'>
                                    <img src='images/potlood.png' alt='Bewerken' width='20' height='20'>
                                </a>
                                <a href='verwijder.php?id=" . $row['Id'] . "' class='btn btn-sm btn-danger' title='Verwijderen' onclick=\"return confirm('Weet je zeker dat je deze taak wilt verwijderen?');\">
                                    <img src='images/delete_icon.png' alt='Verwijderen' width='20' height='20'>
                                </a>
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