
<? 
//<!--  เพิ่มตาราง usedraw เข้ามาใหม่ ใน tbluser  -->
session_start();
echo '<title> write your story | Jaipun</title>';
if($_SESSION["member_id"] == "")
{
  echo"<script>window.location.href='/register.php';</script>";
  //header("location:register.php");
  exit();
}
require('db_config.php');
$result = $conn->query("SELECT COUNT(*) AS countdrawuse FROM tbldrawuse WHERE `user_id`= $_SESSION[member_id]");
$tbldrawuse = $result->fetch_assoc();
$drawname_id = $_GET[drawname_id];

$checkdrawname = $conn->query("SELECT * FROM `tbldrawuse` WHERE user_id = '$_SESSION[member_id]' and drawname_id = '$drawname_id'");
if ($checkdrawname->num_rows == 0) {
  if(isset($drawname_id) and $tbldrawuse['countdrawuse'] < 3){
      $sql="INSERT INTO `tbldrawuse` (`user_id`, `drawname_id`) VALUES ('$_SESSION[member_id]', '$drawname_id')";
      $conn->query($sql);
  } else if($tbldrawuse['countdrawuse'] >= 3){
      $conn->query("DELETE FROM `tbldrawuse` WHERE `tbldrawuse`.`user_id` = $_SESSION[member_id] limit 1");
      $sql="INSERT INTO `tbldrawuse` (`user_id`, `drawname_id`) VALUES ('$_SESSION[member_id]', '$drawname_id')";
      $conn->query($sql);
  }
}
 ?>
  