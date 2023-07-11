<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['password']))){
    header('Location: index.php');
    exit();
}

require_once "connect.php";

try{
    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0){
        throw new Exception(mysqli_connect_errno());
    }
    else{
        $login =$_POST['login'];
        $password =$_POST['password'];

        //htmlentities — Convert all applicable characters to HTML entities
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        //mysqli_real_escape_string - Escapes special characters in a string for use in an SQL
        if ($result = $connection->query(
        sprintf("SELECT * FROM users WHERE user='%s'",
        mysqli_real_escape_string($connection,$login))))
        {
            $how_many_users = $result->num_rows;

            if($how_many_users>0){
                $row = $result->fetch_assoc();
                if (password_verify($password,$row['pass'])){
                    $_SESSION['logged'] = true;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['user'] = $row['user'];
                    $_SESSION['wood'] =$row['wood'];
                    $_SESSION['stone'] =$row['stone'];
                    $_SESSION['gold'] =$row['gold'];
                    $_SESSION['premiumdays'] =$row['premiumdays'];
                    $_SESSION['email'] =$row['email'];
        
                    unset($_SESSION['error']);
                    $result->free_result();
                    header('Location: game.php');
                }
                else{
                    $_SESSION['error'] = '<span style="color:red">Incorrect password!</span>';
                    header('Location: index.php');
                }

            }
            else{
                $_SESSION['error'] = '<span style="color:red">Incorrect login or password!</span>';
                header('Location: index.php');
            }
        } 
        else{
            throw new Exception($connection->error);
        }

        $connection->close();

    }
}
catch(Exception $e){
    echo '<span style="color:red;"> Login error! Try again later!</span>';
    echo '<br/>Development information: '.$e;
}

?>