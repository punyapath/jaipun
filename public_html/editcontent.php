

<?php
include('db_config.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$checkedit =  $conn->query("SELECT * FROM `tblcontent` WHERE content_id = $_GET[content_id] and user_id = '$_SESSION[user_id]'");
if($checkedit->num_rows == 0){
    echo "<script>window.history.back()</script>";
    exit();
}


$sql = "UPDATE `tblcontent` SET `contentName` = '$_POST[contentName]', `content` = '$_POST[content]' WHERE `tblcontent`.`content_id` = $_POST[content_id]";

if ($conn->query($sql) === TRUE) {
    header('Location: story.php?id='.$_POST[content_id]);
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>


