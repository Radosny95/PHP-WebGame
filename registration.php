<?php

    session_start();

    if(isset($_POST['email'])){
        //Validation check
        $all_OK = true;

        $nick = $_POST['nickname'];

        if ((strlen($nick)<3) || (strlen($nick)>20)){
            $all_OK=false;
            $_SESSION['e_nick']="Nickname must be between 3 and 20 characters long!";
        }
        //checking if all characters in string are alphanumeric
        if (ctype_alnum($nick)==false){
            $all_OK=false;
            $_SESSION['e_nick']="Nickname can only consist of letters and numbers!";
        }

        $email = $_POST['email'];
        //sanitizes and checking if the format of email is correct
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    
        if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==FALSE) || ($emailB!=$email)){
            $all_OK=false;
            $_SESSION['e_email']="Please enter a valid email!";
        }

        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        if ((strlen($password1)<8) || (strlen($password1)>20)){
            $all_OK=false;
            $_SESSION['e_password1']="The password must be between 8 and 12 characters long!";
        }
        
        if ($password1 != $password2){
            $all_OK=false;
            $_SESSION['e_password2']="Passwords are different!";
        }
        //bcrypt algorithm
        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
        
        if (!isset($_POST['terms'])){
            $all_OK=false;
            $_SESSION['e_terms']="Accept the terms!";
        }

        //Remember the entered data
        $_SESSION['fr_nick'] = $nick;
        $_SESSION['fr_email'] = $email;
        $_SESSION['fr_password1'] = $password1;
        $_SESSION['fr_password2'] = $password2;
        if (isset($_POST['terms'])){
            $_SESSION['fr_terms'] = true;
        }

        //RECAPTCHA
        // $secret = "6Le9k9QmAAAAAL9lsVpZj62Frtc64fViA_J7D-lt";
        // $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='
        // .$secret.'&response='.$_POST['g-recaptcha-response']);
        // $response = json_decode($check);
        // if ($response->success==false)
        // {
        //     $all_OK=false;
        //     $_SESSION['e_bot']="Please confirm you are not a robot!";
        // }

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        
        try{
            $connestion = new mysqli($host, $db_user, $db_password, $db_name);
            
            if($connestion->connect_errno!=0){
            throw new Exception(mysqli_connect_errno()); //exception throwing
            }
            else{
            //Does email exist?
            $result = $connestion->query("SELECT id FROM users WHERE email='$email'");

            if(!$result) throw new Exception($connestion->error);

            $how_many_emails = $result->num_rows;
            if($how_many_emails>0){
                $all_OK=false;
                $_SESSION['e_email']="There is already an account assigned to this email address!";
            }

            //Does nick already exist?
            $result = $connestion->query("SELECT id FROM users WHERE user='$nick'");

            if(!$result) throw new Exception($connestion->error);

            $how_many_nick = $result->num_rows;
            if($how_many_nick>0){
                $all_OK=false;
                $_SESSION['e_nick']="An account with this name already exists!";
            }

            if($all_OK == true){
                if($connestion->query("INSERT INTO users VALUES (NULL, 
                '$nick', '$password_hash', '$email', 100, 100, 100, now() + INTERVAL 14 DAY)")){
                    $_SESSION['success_registration']=true;
                    header('Location: welcome.php');
                }
            }

            $connestion->close();
            }
        }
        catch(Exception $e){
            echo '<span style="color:red;">Server error! Try again later!</span>';
            echo '<br/>Developer information: '.$e;
        }
    }

?>

<!DOCTYPE HTML>
<html>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Description">
        <title>Create free account!</title>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <style>
            .error
            {
                color:red;
                margin-top: 10px;
                margin-bottom:10px;
            }
        </style>       
</head>

<body>
    <form method="post">
        Nickname:<br> <input type="text" value ="<?php
        if (isset($_SESSION['fr_nick'])){
            echo $_SESSION['fr_nick'];
            unset($_SESSION['fr_nick']);
        }
        ?>" name ="nickname"/><br>

        <?php
        if(isset($_SESSION['e_nick'])){
            echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
            unset($_SESSION['e_nick']);
        }
        ?>

        Email:<br> <input type="text" value ="<?php
        if (isset($_SESSION['fr_email'])){
            echo $_SESSION['fr_email'];
            unset($_SESSION['fr_email']);
        }
        ?>" name ="email"/><br>

        <?php
        if(isset($_SESSION['e_email'])){
            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
            unset($_SESSION['e_email']);
        }
        ?>

        Your password:<br> <input type="password"  value ="<?php
        if (isset($_SESSION['fr_password1'])){
            echo $_SESSION['fr_password1'];
            unset($_SESSION['fr_password1']);
        }
        ?>" name ="password1"/><br>

        <?php
        if(isset($_SESSION['e_password1'])){
            echo '<div class="error">'.$_SESSION['e_password1'].'</div>';
            unset($_SESSION['e_password1']);
        }
        ?>

        Repeat password:<br> <input type="password" value ="<?php
        if (isset($_SESSION['fr_password2'])){
            echo $_SESSION['fr_password2'];
            unset($_SESSION['fr_password2']);
        }
        ?>" name ="password2"/><br>

        <?php
        if(isset($_SESSION['e_password2'])){
            echo '<div class="error">'.$_SESSION['e_password2'].'</div>';
            unset($_SESSION['e_password2']);
        }
        ?>

        <label>
            <input type="checkbox" name ="terms" 
            <?php 
            if (isset($_SESSION['fr_terms'])){
                echo "checked";
                unset($_SESSION['fr_password2']);
            }
            ?>>I accept the terms<br>
        </label>

        <?php
        if(isset($_SESSION['e_terms'])){
            echo '<div class="error">'.$_SESSION['e_terms'].'</div>';
            unset($_SESSION['e_terms']);
        }
        ?>

        <!-- RECAPTCHA -->
        <!-- <div class="g-recaptcha" data-sitekey="6Le9k9QmAAAAACU1H808w5X4SQ9nGdHOtQcXvn90"></div><br> -->
        <?php
        // if(isset($_SESSION['e_bot']))
        // {
        //     echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
        //     unset($_SESSION['e_bot']);
        // }
        ?>
        <input type="submit" value = "Register"/>
    </form>

</body>
</html>