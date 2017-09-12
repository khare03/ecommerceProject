<?php
function limit($arr, $limit) {
foreach ($arr as $key => $value) {
if (!$limit--) break;
yield $key => $value;
}
}

function myAccountDetails()
{
    global $loggedInUser,$mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
        unique_ID,
		title,
		description,
		price
		FROM ".$db_table_prefix."filesRepository
		JOIN ".$db_table_prefix."user
		ON filesRepository.user_id =user.id
		WHERE
		id = $loggedInUser->id
		");
    $stmt->execute();
    $stmt->bind_result($id,$title,$des,$price);
    while ($stmt->fetch()){
        $row[] = array(
            'unique_ID' =>$id,
            'title' => $title,
            'description' =>$des,
            'price' =>$price
        );
    }
    $stmt->close();
    return ($row);
}
#Inserts user registration info into DB
function registerUser($name,$email,$phone,$pwd)
{
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "user(
		name,
		email,
		phone,
		password
		)
		VALUES (
		?,
		?,
		?,
		?
		)"
    );
    $stmt->bind_param("ssis", $name,$email,$phone,$pwd);
    $result = $stmt->execute();
    $stmt->close();
    return $result;

}

function fetchUserDetails($email)
{
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		id,
		name,
		email,
		phone,
		password
		FROM ".$db_table_prefix."user
		WHERE
		email = ?
		LIMIT 1");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $stmt->bind_result($id,$name,$email,$phone,$pwd);
    while ($stmt->fetch()){
        $row = array('id' => $id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $pwd
            );
    }
    $stmt->close();
    return ($row);
}


function isUserLoggedIn()
{
global $loggedInUser,$mysqli,$db_table_prefix;
  $stmt = $mysqli->prepare("SELECT
		email,
		password
		FROM ".$db_table_prefix."user
		WHERE
		email = ?
		AND
		password = ?
		LIMIT 1");
  $stmt->bind_param("ss", $loggedInUser->email, $loggedInUser->pwd);
  $stmt->execute();
  $stmt->store_result();
  $num_returns = $stmt->num_rows;
  $stmt->close();

  if($loggedInUser == NULL)
  {
      return false;
  }
  else
  {
      if ($num_returns > 0)
      {
          return true;
      }
      else
      {
          destroySession("ThisUser");
          return false;
      }
  }
}

function destroySession($name)
{
    if(isset($_SESSION[$name]))
    {
        $_SESSION[$name] = NULL;
        unset($_SESSION[$name]);
    }
}

function uploadData($rand_string,$currentfolder,$destination_folder,$new_file_name,$title,$des,$price)
{
    global $loggedInUser,$mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("INSERT INTO " . $db_table_prefix . "filesRepository(
        file_ID,
        user_id,
        current_folder,
        destination_folder,
        new_file_name,
        title,
        description,
        price
        )
        VALUES (
        '" . $rand_string . "',
        '" . $loggedInUser->id . "',
        '" . $currentfolder . "',
        '" . $destination_folder . "',
        '" . $new_file_name . "',
        ?,
        ?,
        ?
        )"
    );
    $stmt->bind_param("ssi", $title,$des,$price);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function fetchThisProductDetails($pid)
{

    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		unique_ID,
		title,
		description,
		price
		FROM ".$db_table_prefix."filesRepository
		WHERE
		unique_ID = ?
		LIMIT 1");
    $stmt->bind_param("i", $pid);

    $stmt->execute();
    $stmt->bind_result($pid, $title,$des,$price);
    while ($stmt->fetch()){
        $row = array('unique_ID' => $pid,
            'title' => $title,
            'description' => $des,
            'price' => $price
        );
    }
    $stmt->close();
    return ($row);
}

function getUploadedDetails($prod)
{
    global $loggedInUser,$mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		new_file_name,
		title,
		price,
		unique_ID
		FROM ".$db_table_prefix."filesRepository
		WHERE title LIKE '%".$prod."%'
		");
    $stmt->execute();
    $stmt->bind_result($image,$title,$price,$id);

    while ($stmt->fetch()){
        $row[] = array(
            'new_file_name' => $image,
            'title' => $title,
            'price' => $price,
            'unique_ID'=>$id
        );
    }
    $stmt->close();
    return ($row);

}

function addToCart($id,$q)
{
    global $usershoppingcart;
     if(is_array($usershoppingcart->items)){
         $usershoppingcart->addToCart($id,$q);
         $_SESSION['shoppingcart'] = $usershoppingcart->items;
         }

     else{
         $usershoppingcart->addToCart($id,$q);
         $_SESSION['shoppingcart'] = $usershoppingcart->items;
/*         $_SESSION['shoppingcart'] = array();
         $_SESSION['shoppingcart'][0]['qty'] = $q;
         $_SESSION['shoppingcart'][0]['id'] = $id;*/
     }
}


function product_exists($pid){
    $max=count($_SESSION['shoppingcart']);
    $flag=0;
    for($i=0;$i<$max;$i++){
        if($pid==$_SESSION['shoppingcart'][$i]['id']){
            $flag=1;
            break;
        }
    }
    return $flag;
}


?>