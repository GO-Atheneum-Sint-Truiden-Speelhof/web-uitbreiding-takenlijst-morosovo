Elion Sopa, Nu
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of gebruikersnaam en wachtwoord zijn ingevuld
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        require 'db_connect.php';

        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        $qry = "SELECT Wachtwoord FROM users WHERE Username = '$username'";
        $result = $conn->query($qry);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['Wachtwoord'];

            // Controleer het wachtwoord
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['username'] = $username; // Bewaren gebruikersnaam in sessie
                header('Location: index.php');
                exit;
            } else {
                $error = "Ongeldig wachtwoord.";
            }
        } else {
            $error = "Gebruiker niet gevonden.";
        }
    } else {
        $error = "Vul zowel gebruikersnaam als wachtwoord in.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Inloggen</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="login.php" method="post" class="w-50 mx-auto">
            <div class="mb-3">
                <label for="username" class="form-label">Gebruikersnaam</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Wachtwoord</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Inloggen</button>
        </form>
    </div>
</body>
</html>
