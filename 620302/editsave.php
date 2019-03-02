<?php
  //require("checksession.php");
  session_start();
  require('db_config.php');

$name=htmlspecialchars($_POST['name'],ENT_QUOTES);
$detail=htmlspecialchars($_POST['detail'],ENT_QUOTES);
$user_id=$_SESSION['user_id'];
$sql="UPDATE `tbluser` SET  `name` = '$name', `detail` = '$detail' WHERE `tbluser`.`user_id` = $user_id";
$conn->query($sql);
    
$conn->close();

      
?>