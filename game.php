<?php

session_start();

if(isset($_SESSION['logged'])==FALSE){
    header('Location: index.php');
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
    <title>WebGame!</title>
</head>

<body onload="counting()">
<?php

    echo "<p><h1>Welcome ".$_SESSION['user']."!</h1>";
    echo "<p><b>Wood: </b>".$_SESSION['wood'];
    echo "| <b>Stone: </b>".$_SESSION['stone'];
    echo "| <b>Gold: </b>".$_SESSION['gold'];
    echo "<p><b>E-mail: </b>".$_SESSION['email'];
    echo "<p><b>End date of premium: </b>".$_SESSION['premiumdays']."</p>";
    
    

    $datatime = new DateTime();
    // $datatime = new DateTime('2025-01-01 22:10:13');
    
    echo "<p><b>Server datatime: </b>"."<span id='clock'></span><p>";
    $end = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['premiumdays']);
   
    //diff() computes differences
    $difference = $datatime->diff($end);
    
    //Does premium is active?
    if($datatime<$end){
        echo "<p><b>Premium will be active for </b>". $difference->format('%y years, %m months, %d days, %h hours')."</p>";
    }
    else{
        echo "<p><b>Your premium account is no longer active : </b>". $difference->format('%y years, %m months, %d days, %h hours')."</p>";
    }

    echo<<<END
        <form action="logout.php" method="post">
            <input type="submit" value = "Log out"/>
        </form>
    END;

    ?>
    
    <script src="clock.js" defer></script>

</body>
</html>