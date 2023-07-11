<?php

    session_start();
    //Destroy all session variables
    session_unset();

    header('Location: index.php');
    
?>