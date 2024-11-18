<?php
$tmp = '$2y$10$QD8OlLDH4QpTxqdkEomI8eOH8d1U5jJxT7rhYXKU5ZVIbPSVu4bji';
    if(isset($_GET["pwd"]) && !empty($_GET["pwd"])){
       if(password_verify($_GET["pwd"], $tmp)){
        echo "LOGIN SUCCESS";
       }
    }
?>
<html>
    <head></head>
    <body>
        <form action="pwd.php" method="get">
            <input type="text" name="pwd">
            <button type="submit" value="Klik">Klik</button>
</form>
</body>
</html>