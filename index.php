<?php

session_start();

if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true)){
header('Location: game.php');
exit();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Game title">
    <meta name="author" content="Radoslaw B">
    <title>WebGame!</title>
</head>

<body>
    <b><h2>Login Form</h2></b>
    <form action="login.php" method="post">
        Login:<br>
        <input type="text" name ="login"/><br>
        Password:<br>
        <input type="password" name ="password"/><br>
        <input type="submit" value = "Log in"/><br>
    </form>

    <?php
        if(isset($_SESSION['error'])) echo $_SESSION['error'];
    ?>

    <form>
        <button type="button" onclick="window.location.href='registration.php'">Registration - create your account</button>
    </form>
    
</body>
</html>