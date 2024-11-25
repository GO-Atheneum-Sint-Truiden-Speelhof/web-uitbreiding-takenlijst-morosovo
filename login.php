<!doctype html>
<html lang="nl">

<body>
<h1>Login</h1>
<?php 
if (isset($_POST["username"]) && !empty($_POST["username"])) {
    echo "LOGIN FUNCTIE<br>";
    // inloggen
    $servername = "localhost";
    $db_user = "root";
    $db_pwd = "";
    $database = "takenlijst";

    $conn = new mysqli($servername,$db_user,$db_pwd,$database);
    if ($conn->connect_errno){
        echo 'verbinding mislukt: '.$conn->connect_error;
    }

    $qry = "SELECT Wachtwoord FROM users WHERE username = '".$_POST["username"]."'";
    
    $result = $conn ->query($qry);
    if($result->num_rows > 0){
        $rij = $result -> fetch_row();
        $p = $rij[0];
        if(password_verify($_POST["password"],$p)){
            //Goede login
            echo 'OK';
        }
        else {
            //fout paswoord
            echo 'FOUT';
        }
    }else {
        //fout gebruiker
        echo 'FOUT';
    }
} else {
    // formulier tonen
    ?>
    <form action="login.php" method="post">
        <label for="username">Gebruikersnaam: </label>    
        <input name="username" id="username" type="text">
        <label for=">password">Wachtwoord: </label>    
        <input name="password" id="password" type="password">
        <button type="submit">Login</button>
    </form>
    <?php
}
?>
</body>
</html>