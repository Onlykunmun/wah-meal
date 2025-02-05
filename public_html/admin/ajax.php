<?php

require '../conn.php'; 

session_start();
$me = $_SESSION["admin-login"];
if(!isset($me))
{
  header("location: index.php");
}

if(isset($_POST['del_img']))
{
    $del_id = $_POST['del_img'];
    if(mysqli_query($conn, "DELETE FROM `food_images` WHERE id = '$del_id'"))
    {
      echo 1;
      exit();
    }
    else
    {
      echo 0;
      exit();
    }
}



?>