
<? 
//<!--  เพิ่มตาราง usedraw เข้ามาใหม่ ใน tbluser  -->
session_start();
echo '<title> write your story | Jaipun</title>';
if($_SESSION["user_id"] == "")
{
  echo"<script>window.location.href='/register.php';</script>";
  //header("location:register.php");
  exit();
}
require('db_config.php');
$conn->query("DELETE FROM `tbldrawuse` WHERE `tbldrawuse`.`user_id` = $_SESSION[user_id]");
  $drawname_id = $_GET[drawname_id];
  if(isset($drawname_id)){
    $sql="INSERT INTO `tbldrawuse` (`user_id`, `drawname_id`) VALUES ('$_SESSION[user_id]', '$drawname_id')";
    $conn->query($sql);
 } 
 ?>
  