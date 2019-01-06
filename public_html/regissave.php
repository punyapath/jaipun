<?
session_start();
require('db_config.php');


$checkemail = $conn->query("SELECT * FROM tbluser WHERE email='$_POST[Email]'");

if($_POST['Email'] == "" or $_POST['password'] == "" or $_POST['confirmpassword'] == ""){

  echo "1";

}else if(!filter_var($_POST[Email], FILTER_VALIDATE_EMAIL)) {
  echo "3";
}else if($checkemail->num_rows>1){echo "2";}else{

  $username=$_POST['Email'];
  $password=$_POST['password'];
  $password=base64_encode($password);
  $name=substr($username, 0 ,strpos($username, "@"));



  if (getenv(HTTP_X_FORWARDED_FOR))
  $ip=getenv(HTTP_X_FORWARDED_FOR);
  else
  $ip=getenv(REMOTE_ADDR);
    
  $sql="INSERT INTO `tbluser` (`user_id`, `email`, `password`, `name`,`detail` ,`user_ip`, `stories`) VALUES (0,'$username','$password','$name','....','$ip','')";
    if($conn->query($sql)===TRUE){
      $result = $conn->query("SELECT * FROM tbluser WHERE email='$username'");
      $row = $result->fetch_assoc();
      $_SESSION['user_id']=$row['user_id'];   
      echo "4";
    }
} 


$conn->close();
?>