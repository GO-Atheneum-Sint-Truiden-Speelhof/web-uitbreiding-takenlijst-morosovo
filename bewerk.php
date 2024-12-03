<?php 
require 'db_connect.php'; // Zorg dat dit correct is ingesteld en de database-verbinding maakt

// Haal de taak op via een GET-verzoek
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Zorg dat het ID een integer is voor veiligheid
    $result = $conn->query("SELECT * FROM todos WHERE id = $id");

    if ($result && $result->num_rows > 0) {
        $task = $result->fetch_assoc(); // Haal de taak op
    } else {
        die("Fout: Taak met ID $id is niet gevonden in de database."); // Toon een fout als de taak niet bestaat
    }
}

// Verwerk een POST-verzoek om wijzigingen op te slaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['task'], $_POST['status'], $_POST['instructies'], $_POST['deadline'])) {
        $id = intval($_POST['id']);
        $task = $conn->real_escape_string($_POST['task']);
        $status = $conn->real_escape_string($_POST['status']);
        $instructies = $conn->real_escape_string($_POST['instructies']);
        $deadline = $conn->real_escape_string($_POST['deadline']);

        // Update de taak in de database
        if ($conn->query("UPDATE todos SET task = '$task', status = '$status', instructies = '$instructies', deadline = '$deadline' WHERE id = $id") === FALSE) {
            die("Fout bij het updaten van de taak: " . $conn->error);
        }

        // Redirect naar index.php met een succesbericht
        header('Location: index.php?status=updated');
        exit;
    } else {
        die("Fout: Alle velden moeten worden ingevuld."); // Controleer of alle velden zijn ingevuld
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bewerk Taak</title>
    <meta charset="UTF-8">
</head>
<body>
    <form method="POST" action="bewerk.php">
        <?php if (isset($task)): ?>
            <!-- Hidden veld voor ID -->
            <input type="text" id="task" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>


            <!-- Veld voor taak -->
            <label for="task">Taak:</label>
            <input type="text" id="task" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
            
            <!-- Veld voor status -->
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Niet voltooid" <?php echo $task['status'] === 'Niet voltooid' ? 'selected' : ''; ?>>Niet voltooid</option>
                <option value="Voltooid" <?php echo $task['status'] === 'Voltooid' ? 'selected' : ''; ?>>Voltooid</option>
            </select>

            <!-- Veld voor instructies -->
            <label for="instructies">Instructies:</label>
            <textarea id="instructies" name="instructies"><?php echo htmlspecialchars($task['instructies']); ?></textarea>

            <!-- Veld voor deadline -->
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" value="<?php echo htmlspecialchars($task['deadline']); ?>">

            <!-- Opslaan knop -->
            <button type="submit">Opslaan</button>
        <?php else: ?>
            <p>Fout: Er is geen taak beschikbaar om te bewerken.</p>
        <?php endif; ?>
    </form>
</body>
</html>
