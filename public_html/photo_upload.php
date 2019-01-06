<?php

session_start();
if(isset($_GET['profile'])){
    $data = $_POST['photo'];
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
//echo $_SERVER['DOCUMENT_ROOT'] ;
    //mkdir($_SERVER['DOCUMENT_ROOT'] . "/crop2/images");
    $filename = $_SERVER['DOCUMENT_ROOT'] . "/"."profile/".$_SESSION[user_id].'.jpeg';
    if (file_exists($filename)) {
        unlink($filename);
    }
    
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/"."profile/".$_SESSION[user_id].'.jpeg', $data);
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