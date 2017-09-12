<?php
//error reporting and warning display.
error_reporting(E_ALL);
ini_set('display_errors', 'Off');

if (!ini_get('date.timezone')) {
    date_default_timezone_set('GMT');
    date_default_timezone_set('US/Eastern');
}


require_once("db-Setting.php"); //Require DB connection
require_once("function.php"); // database and other functions are written in this file
require_once("class.user.php");
require_once ("shoppingcart.php");
$base_URL = "project_khare.localhost";
session_start();

//loggedInUser can be used globally if constructed
if(isset($_SESSION["ThisUser"]) && is_object($_SESSION["ThisUser"]))
{
    $loggedInUser = $_SESSION["ThisUser"];
    $usershoppingcart = $_SESSION["shoppingcart"];

}
?>
