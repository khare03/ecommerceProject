<?php
include "config.php";
require_once "navHeader.php";

if(isset($_POST['register']))
{
    $name=$_POST['fname'];
    $email =$_POST['email'];
    $phone = $_POST['mobile'];
    $pwd=$_POST['password'];

    $userCreated = registerUser($name,$email,$phone,$pwd);

    if ($userCreated) {
        echo "    <div class='jumbotron'>
                    <div class 'panel-heading'>
                    <h2>Registration Sucessfull !! </h2>
                    </div>
                  </div>";
        }
else
    echo "    <div class='jumbotron'>
                    <div class 'panel-heading'>
                    <h2>Please try Again </h2>
                    </div>
                  </div>";

}

?>