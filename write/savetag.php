<?
require('db_config.php');

  $tagname=$_POST['tagname'];
  $tagDetail=$_POST['tagDetail'];  
  $tagDraw=$_POST['tagDraw'];    
  $result = $conn->query("SELECT * FROM tbltag WHERE tagname='$tagname'");
  
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $tag_id=$row['tag_id'];
    echo $tag_id; 
}else{
    $sql="INSERT INTO `tbltag` (`tagname`, `tagDetail`, `tagDraw`) VALUES ('$tagname', '$tagDetail', '$tagDraw');";
    $conn->query($sql);
    $result = $conn->query("SELECT * FROM tbltag WHERE tagname='$tagname'");
    $row = $result->fetch_assoc();
    $tag_id=$row['tag_id'];
    echo $tag_id; 
}
$conn->close();

?>