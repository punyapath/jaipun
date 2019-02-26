<?
session_start();
require('db_config.php');
$tag_id=$_GET['tag_id'];
$member_id=$_SESSION['member_id'];
$contentname=$_POST['title'];
$content=$_POST['content'];
$type=$_POST['type'];
$str=htmlspecialchars($content,ENT_QUOTES);

date_default_timezone_set("Asia/Bangkok");
$time= time();


if (getenv(HTTP_X_FORWARDED_FOR))
$ip=getenv(HTTP_X_FORWARDED_FOR);
else
$ip=getenv(REMOTE_ADDR);



$sql="INSERT INTO tblcontent VALUES (0,'$member_id','$tag_id','$type','$contentname','$str','$time','$ip','0','0')";

if($conn->query($sql) === TRUE){
  $result = $conn->query("SELECT * FROM tblcontent WHERE contentName='$contentname' and contentDate = '$time'");
  $row = $result->fetch_assoc();
  $content_id=$row['content_id'];
  $conn->query("UPDATE  tbltag SET tagStories = tagStories + 1 WHERE tag_id='$row[tag_id]'");
  $conn->query("UPDATE  tblmember SET stories = stories + 1 WHERE member_id='$_SESSION[member_id]'");
  $Updatedraw = $conn->query("SELECT * FROM tbldrawuse WHERE user_id = '$_SESSION[member_id]'");
  if ($Updatedraw->num_rows > 0){
    $tbldrawuse = $Updatedraw->fetch_assoc();
    $drawname_id = $tbldrawuse[drawname_id];
    $conn->query("UPDATE tbldrawname SET drawuseCount = drawuseCount + 1 WHERE drawname_id=$drawname_id");
  }


if($_SESSION[image] != 0){
rename($_SERVER['DOCUMENT_ROOT'] . "/"."images/".$_SESSION[image],$_SERVER['DOCUMENT_ROOT'] . "/"."images/".$content_id.'.jpeg');$_SESSION[image]=0;}
echo $content_id; 
//$_SESSION['username']=$username;
}else{
  echo "<font color=#FF0000>ไม่สามารถบันทึกฐานข้อมูลได้</font>";
}

$conn->close();
?>