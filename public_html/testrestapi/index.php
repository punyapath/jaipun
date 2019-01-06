<h1>header</h1>
<?php
//header('Access-Control-Allow-Origin: *');

$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$location = $_SERVER['REQUEST_URI'];
if ($_SERVER['QUERY_STRING']) {
  $location = substr($location, 0, strrpos($location, $_SERVER['QUERY_STRING']) - 1);
}
$url = $protocol.'://'.$_SERVER['HTTP_HOST'].$location;
$location = strtolower(trim(str_replace("/","",$location)));;
echo $url;
if(strpos($location,"write")!==FALSE){
    echo "write";
}else if(strpos($location,"story")!==FALSE){
    include('story.php');   
}else if(strpos($location,"profile")!==FALSE){
    include('profile.php');      
}else if(strpos($location,"register")!==FALSE){
    include('register.php');      
}else if(strpos($location,"top")!==FALSE){
    include('top.php');      
}else{
    include('feed.php');     
}
?>