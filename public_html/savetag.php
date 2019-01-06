<?
require('db_config.php');

  $tagname=$_POST['tagname'];
  $result = $conn->query("SELECT * FROM tbltag WHERE tagname='$tagname'");
  
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $tag_id=$row['tag_id'];
    echo $tag_id; 
}else{
    $sql="INSERT INTO tbltag VALUES (0,'$tagname','','')";
    $conn->query($sql);
    $result = $conn->query("SELECT * FROM tbltag WHERE tagname='$tagname'");
    $row = $result->fetch_assoc();
    $tag_id=$row['tag_id'];
    echo $tag_id; 
}
$conn->close();

?>