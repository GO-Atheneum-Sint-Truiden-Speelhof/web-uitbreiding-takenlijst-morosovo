<!doctype html>
<html lang="nl">

<body>
<h1>Login</h1>
<?php 
if (isset($_POST["Username"]) && !empty($_POST["Username"])) {
    // inloggen
    $servername = "localhost";
    $db_user = "nermine";
    $db_pwd = "0417";
    $database = "takenlijst";

    $conn = new mysqli($servername,$db_user,$db_pwd,$database);
    if ($conn->connect_errno){
        echo 'verbinding mislukt: '.$conn->connect_error;
    }

    $qry = "SELECT Wachtwoord FROM users WHERE Username = '".$_POST["Username"]."'";
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
        <label for="Username">Gebruikersnaam: </label>    
        <input name="Username" id="Username" type="text">
        <label for=">Password">Wachtwoord: </label>    
        <input name="Password" id="Password" type="Password">
        <button type="submit">Login</button>
    </form>
    <?php
}
?>
</body>
</html>