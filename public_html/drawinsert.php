
<? 
//<!--  เพิ่มตาราง usedraw เข้ามาใหม่ ใน tbluser  -->
session_start();
require('db_config.php');
$conn->query("DELETE FROM `tbldrawuse` WHERE `tbldrawuse`.`user_id` = $_SESSION[user_id]");
  $drawname_id = $_GET[drawname_id];
  if(isset($drawname_id)){
    $sql="INSERT INTO `tbldrawuse` (`user_id`, `drawname_id`) VALUES ('$_SESSION[user_id]', '$drawname_id')";
    $conn->query($sql);
 } 
 ?>
  