<?php
include "config.php";
GLOBAL $mysqli;
if(isset($_POST))
{
    $submit = $_GET['update'];
    $i = ($_POST['count']);
    $title =$_POST['title'];
    $des = $_POST['des'];
    $price=$_POST['price'];
    $uid=$_POST['id'];

    $count = count($_POST);
    for($i=0;$i<$count;$i++){

        $sql= "UPDATE filesRepository SET title='{$_POST['title'][$i]}',
                               description='{$_POST['des'][$i]}', 
                                  price='{$_POST['price'][$i]}'
                               WHERE unique_ID='{$_POST['id'][$i]}'";


        $rows = $mysqli->query($sql);
    }

    if($rows){
        header("location:myAccount.php");
        exit;
    }
}


