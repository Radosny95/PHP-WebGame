<?php

    session_start();

    if(!isset($_SESSION['success_registration'])){
        header('Location: index.php');
        exit();
    }
    else{
        unset($_SESSION['success_registration']);
    }

    //Usuwamy zmienne session
    if(isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
    if(isset($_SESSION['fr_emali'])) unset($_SESSION['fr_emali']);
    if(isset($_SESSION['fr_password1'])) unset($_SESSION['fr_password1']);
    if(isset($_SESSION['fr_password2'])) unset($_SESSION['fr_password2']);
    if(isset($_SESSION['fr_term'])) unset($_SESSION['fr_term']);

    if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
    if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
    if(isset($_SESSION['e_password'])) unset($_SESSION['e_password']);
    if(isset($_SESSION['e_term'])) unset($_SESSION['e_term']);
    if(isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);


?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Description">
    <title>WebGame!!</title>
</head>

<body>

    Thank you for registering on the website! You can now log in to your account! <br>
    <a href="index.php">Log in to your account</a><br>

</body>
</html>