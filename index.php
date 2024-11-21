<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
</head>
<body>
    <h1>To-Do List</h1>

    <form action="taak.php" method="post">
        <label for="task">Nieuwe taak:</label>
        <input type="text" id="task" name="task" required>
        <button type="submit">Toevoegen</button>
    </form>
</body>
</html>
