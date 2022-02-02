<?php

session_start();

if(isset($_POST["submit"]))
{

    // Grabbing the data
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    // Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($email, $pwd);

    // Running error handlers and user login
    $login->loginUser($email, $pwd);

    // Going to back to front page
    header("location: ../index.php?error=none");
}