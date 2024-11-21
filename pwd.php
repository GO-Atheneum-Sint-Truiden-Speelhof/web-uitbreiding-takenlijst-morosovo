<?php echo password_hash("pwd",PASSWORD_DEFAULT); ?>
<br>
<?php 
$hash = '$2y$10$id2/midY05a.i29/0RF6Lu9by1.J2U0TZ0oIZkhA86b/.RPBGWKZi';
if(password_verify('pwd', $hash)){
    echo "CORRECT";
} ?>