<?php
require('db_config.php');
session_start();
if(isset($_GET['profile'])){
    $data = $_POST['photo'];
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
//echo $_SERVER['DOCUMENT_ROOT'] ;
    //mkdir($_SERVER['DOCUMENT_ROOT'] . "/crop2/images");
    $filename ="/"."profile/".time().'.jpeg';
    file_put_contents($_SERVER['DOCUMENT_ROOT'] .$filename , $data);

    
    $sql="UPDATE `tblmember` SET `profile`='$filename' WHERE member_id='$_SESSION[member_id]'";
    $result = $conn->query($sql);
    die;
    echo "<br>OK";

}else{
    $data = $_POST['photo'];
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/"."images/".time().'.jpeg', $data);
    $_SESSION[image]= time().'.jpeg';
    die;
    echo "<br>OK";
}
?>