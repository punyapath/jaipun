<h1>header</h1>
<?php
session_start();echo $_SESSION[user_id];
//header('Access-Control-Allow-Origin: *');

$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$location = $_SERVER['REQUEST_URI'];
if ($_SERVER['QUERY_STRING']) {
  $location = substr($location, 0, strrpos($location, $_SERVER['QUERY_STRING']) - 1);
}
$url = $protocol.'://'.$_SERVER['HTTP_HOST'].$location;
$location = strtolower(trim(str_replace("/","",$location)));;
/*
if(strpos($location,"write")!==FALSE){
    include('write.php'); 
}else if(strpos($location,"story")!==FALSE){
    include('story.php');   
}else if(strpos($location,"name")!==FALSE){
    include('name.php');      
}else if(strpos($location,"register")!==FALSE){
    //include('register.php');   
    include('register.html');   
}else if(strpos($location,"edit")!==FALSE){
    include('edit.php');      
}else if(strpos($location,"top")!==FALSE){
    include('top.php');      
}else {*/
    include('feed.html');     
//}
?>