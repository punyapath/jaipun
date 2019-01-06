<?

include('db_config.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$checkedit =  $conn->query("SELECT * FROM `tblcontent` WHERE content_id = $_GET[content_id] and user_id = '$_SESSION[user_id]'");
if($checkedit->num_rows == 0){
    echo "<script>window.history.back()</script>";
    exit();
}


$sql = "SELECT * FROM `tblcontent` WHERE content_id=$_GET[content_id]";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


?>


<!--- *********************ใส่ เงื่อนไข PHP***************************   -->


<form action="editcontent.php" method='POST'>
<input type="text" name="contentName" value="<?=$row[contentName]?>">
<input type="hidden" name="content_id" value="<?=$row[content_id]?>">
<textarea  name="content" rows="4" cols="50"><?echo $row[content];?></textarea>
<input type="submit">
</form>