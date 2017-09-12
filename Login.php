<?php
require_once('config.php');

if (!empty($_POST)) {
    $errors = array();
    $email = trim($_POST["email1"]);
    $password = trim($_POST["pwd1"]);

    //Perform some validation

    if ($email == "") {
        $errors[] = "enter email";
    }
    if ($password == "") {
        $errors[] = "enter password";
    }

    if (count($errors) == 0) {
        //retrieve the records of the user who is trying to login
        $userdetails = fetchUserDetails($email);
        if ($password != $userdetails["password"]) {

            echo "<script type='text/javascript'>alert('Oops!!Incorrect Password');</script>";
            header("Location: index.php");

        }
        else {
            //Passwords match! we're good to go'
            //Transfer some db data to the session object
            $loggedInUser = new loggedInUser();
            $loggedInUser->id = $userdetails["id"];
            $loggedInUser->name = $userdetails["name"];
            $loggedInUser->email = $userdetails["email"];
            $loggedInUser->phone = $userdetails["phone"];
            $loggedInUser->pwd = $userdetails["password"];
            $_SESSION["ThisUser"] = $loggedInUser;
            $usershoppingcart = new usershoppingcart();
            $_SESSION["shoppingcart"] = $usershoppingcart->items;


            //now that a session for this user is created
            //Redirect to this users account page
            header("Location: myAccount.php");
            die();

        }
    }
}