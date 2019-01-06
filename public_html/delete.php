<?php

/*********************ใส่ เงื่อนไข PHP***************************/
include('db_config.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$checkdelete =  $conn->query("SELECT * FROM `tblcontent` WHERE content_id = $_GET[content_id] and user_id = '$_SESSION[user_id]'");
if($checkdelete->num_rows == 0){
    echo "<script>window.history.back()</script>";
    exit();
}

// sql to delete a record
$sql = "DELETE FROM `tblcontent` WHERE `tblcontent`.`content_id` = $_GET[content_id]";

if ($conn->query($sql) === TRUE) {
    $conn->query("DELETE FROM  `tblcomment` WHERE content_id = $_GET[content_id]");
    //echo "Record deleted successfully";
    header('Location: index.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>