<?php

session_start();

if(isset($_POST["submit"]))
{

    // Grabbing the data
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];        
    $address = $_POST["address"];    
    $phone = $_POST["phone"];
    $degree = $_POST["degree"];

    // Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($email, $pwd, $pwdRepeat, $firstName, $lastName, $address, $phone, $degree);

    // Running error handlers and user signup
    $signup->signupUser();

    // Going to back to front page
    echo "<h1>Sucessful Registration. Redirecting you to the Login page.</h1>";
    header("location: ../login.php?error=none");
}