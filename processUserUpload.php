<?php
include "navHeader.php";
require_once ("config.php");

if((isset($_POST['upload']) && isset($_SESSION['ThisUser']))){
    $image= $_FILES['image'];
    $title =$_POST['title'];
    $des = $_POST['des'];
    $price=$_POST['price'];
    $userId=$_SESSION['ThisUser']->id;

    ############ Configuration ##############
//$destination_folder		= 'G:/path/to/uploads/folder/'; //upload directory ends with / (slash)
    $currentfolder = getcwd();
    //echo $currentfolder;
    $destination_folder = $currentfolder . '/FileUploads/'; //upload directory ends with / (slash)
    //echo $destination_folder;
    define("UPLOAD_DIR", $destination_folder);

##########################################


    if (!isset($_FILES['image']) || !is_uploaded_file($_FILES['image']['tmp_name']) || $_FILES['image']['error'] > 0) {

        //$errors = lang("FILE MISSING"); // output error when above checks fail.
        header("Location: ".$baseURL."/myAccount.php?er=fm"); /* Redirect browser */
        exit();

    }
    else
    {
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];

        //$file_ext=strtolower(end(explode('.',$file_name)));
        $path_parts = pathinfo($file_name);

        $file_basename =  strtolower($path_parts['basename']);
        $file_name_new= strtolower($path_parts['filename']);
        $file_ext=strtolower($path_parts['extension']);


//        $extensions = array("jpg","gif","rtf","png");
//
//        if(in_array($file_ext,$extensions )=== false){
//            //$errors[]="extension not allowed, please choose a .";
//            header("Location: ".$baseURL."/myAccount.php?er=ex"); /* Redirect browser */
//            exit();
//
//        }
//        if($file_size > 2097152){
//            //$errors[]='File size must not be greater than 2MB';
//            header("Location: ".$baseURL."/myAccount.php?er=lg"); /* Redirect browser */
//            exit();
//
//        }
//
//        if ($file_error !== UPLOAD_ERR_OK) {
//            //$errors[]='an error occurred';
//            header("Location: ".$baseURL."/myAccount.php?er=ue"); /* Redirect browser */
//            exit();
//
//        }

        $character_array = array_merge(range(a, z), range(0, 99));
        $rand_string = "";
        for ($i = 0; $i < 9; $i++) {
            $rand_string .= $character_array[rand(0, (count($character_array) - 1))];
        }

        // ensure a safe filename
        $name = preg_replace("/[^A-Z0-9._-]/i", "_", $file_name_new);

        //create a random name for new image (Eg: fileName_293749.jpg) ;
        $new_file_name = $name . '_' . rand(0, 99999999999) . '.' . $file_ext;

        if(empty($errors)==true) {
            //preserve file from temporary directory
            $success = move_uploaded_file($file_tmp, UPLOAD_DIR . $new_file_name);
            // set proper permissions on the new file
            chmod(UPLOAD_DIR . $new_file_name, 0644);
//            if (!$success) {
//                //$errors[] = 'unable to save file';
//                header("Location: ".$baseURL."/myAccount.php"); /* Redirect browser */
//                exit();
//            }
//
//        }
//        else{
//            // print_r($errors);
//            header("Location: ".$baseURL."/myAccount.php"); /* Redirect browser */
//            exit();
//
        }



    }


    $actual_url = "$baseURL/Home.php?rid=$rand_string";

    $uploadedData= uploadData($rand_string,$currentfolder,$destination_folder,$new_file_name,$title,$des,$price);
    if($uploadedData){
        echo "<div class = 'jumbotron'>
              <h3> Your Product is available in Marketplace</h3>
              </div>";
    }
    else {
        echo "<div class = 'jumbotron'>
              <h3> Your product upload is failed</h3>
              </div>";
    }
}


?>