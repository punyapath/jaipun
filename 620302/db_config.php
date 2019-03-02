<?php
$host="localhost";
$user="jaipunco";    
$pass="P10oct2540M##"; 
$dbname="jaipunco_db"; 

$conn=new mysqli($host,$user,$pass,$dbname); 
if($conn->connect_error) {
  die("connection failed:" . $conn->connect_error);
}

?>

