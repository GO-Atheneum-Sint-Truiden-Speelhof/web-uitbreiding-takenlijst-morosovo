<!doctype html>
<html lang="nl">

<body>
<h1>Login</h1>
<?php 
if (isset($_POST["username"]) && !empty($_POST["username"])) {
    // inloggen
    $servername = 'localhost';
    $database = 'takenlijst';
    $db_user = 'Elion';
    $db_pwd = 'Elion14';

    $conn = new mysqli($servername,$db_user,$db_pwd,$database);
    if ($conn->connect_errno){
        echo 'Failed to connect: '.$conn->connect_error;
    }

    $qry = "SELECT Wachtwoord FROM users WHERE Username = '".$POST_["username"]."'";
    echo $qry;
    $result = $conn ->query($qry);
    if($result->num_rows > 0){
        $rij = $result -> fetch_row();
        $p = $rij[0];
        echo password_verify($_POST["Wachtwoord"],$p);
    }
} else {
    // formulier tonen
    ?>
    <form action="login.php" method="post">
        <label for="username">Gebruikersnaam: </label>    
        <input name="username" id="username" type="text">
        <label for="password">Wachtwoord: </label>    
        <input name="password" id="password" type="password">
        <button type="submit">Login</button>
    </form>
    <?php
}
?>
</body>
</html>
