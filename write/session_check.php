<?php
session_start();
require('db_config.php');
if(empty($_SESSION['user_id'])){
     print "Expired";
}else{
     $sql = "SELECT * FROM tbluser WHERE user_id = $_SESSION[user_id]"; 
     $result = $conn->query($sql);
     $tbluser = $result->fetch_assoc();
     echo $tbluser[name];
}



?>