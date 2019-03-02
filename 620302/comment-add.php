<?php
session_start();
require_once ("db_config.php");

date_default_timezone_set("Asia/Bangkok");
$date= time();

if (getenv(HTTP_X_FORWARDED_FOR))
$ip=getenv(HTTP_X_FORWARDED_FOR);
else
$ip=getenv(REMOTE_ADDR);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/*******************เงื่อนไข PHP ถ้าว่างกลับหน้าเดิม****************************/

$sql = "INSERT INTO `tblcomment` (`comment_id`, `content_id`, `user_id`, `comment`, `commentDate`, `comment_ip`) 
VALUES ('0', '$_POST[id]', '$_SESSION[user_id]', '$_POST[comment]', '$date', '$ip')";

//$sql = "INSERT INTO tbl_comment(parent_comment_id,comment,comment_sender_name,date) VALUES ('" . $commentId . "','" . $comment . "','" . $commentSenderName . "','" . $date . "')";
$result = $conn->query($sql);

if (! $result) {
    $result = $conn->error;
}
echo $result;
?>
