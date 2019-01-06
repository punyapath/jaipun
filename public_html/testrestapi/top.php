<h1>feed TOP</h1>
<?
/*
*
*  ระบบ feed เรียงตาม จำนวนกดไลค์ ของเนื้อหา 
*  ตัว load ของ feed
*  feed tag + load tag เรียงตามจำนวน tag_id 
*/


/**************feed Like Start****************/
$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$location = $_SERVER['REQUEST_URI'];
if ($_SERVER['QUERY_STRING']) {
  $location = substr($location, 0, strrpos($location, $_SERVER['QUERY_STRING']) - 1);
}
$url = $protocol.'://'.$_SERVER['HTTP_HOST'].$location;

$url = "http://localhost/feed/feed_top";
$data = file_get_contents($url);

$k=json_decode($data,true);

for ($i = 0; $i < 8; $i++ ) {
    echo "<a href='story/".md5($k[$i][content_id]), "'>".$k[$i][content_id]."</a>", "contentLike : ";        
    echo $k[$i][contentLike], "contentDate : ";
    echo $k[$i][contentDate], "<br>";
}

/**************feed Like End****************/

?>
<h1>LOAD</h1>

<?
/**************load Like Start****************/

$url = "http://localhost/feed/load_top?contentLike=1";
$data = file_get_contents($url);

$k=json_decode($data,true);

for ($i = 0; $i < 8; $i++ ) {
    echo "<a href='story/".md5($k[$i][content_id]), "'>".$k[$i][content_id]."</a>", "contentLike : ";            
    echo $k[$i][contentLike], "contentDate : ";
    echo $k[$i][contentDate], "<br>";
}
/**************load Like End****************/
?>


<h1>TAG</h1>

<?
/**************tag new Start****************/

$url = "http://localhost/feed/tag_new";
$data = file_get_contents($url);

$k=json_decode($data,true);

for ($i = 0; $i < 8; $i++ ) {
    echo $k[$i][tag_id], "tagname : ";
    echo $k[$i][tagname], "  tagStories : ";
    echo $k[$i][tagStories], "<br>";
}
/**************tag new End****************/

?>

<h1>LOAD TAG</h1>

<?
/**************tagload new Start****************/

$url = "http://localhost/feed/tagload_new?tag_id=16";
$data = file_get_contents($url);

$k=json_decode($data,true);

for ($i = 0; $i < 8; $i++ ) {
    echo $k[$i][tag_id], "tagname : ";
    echo $k[$i][tagname], "  tagStories : ";
    echo $k[$i][tagStories], "<br>";
}
/**************tagload new End****************/

?>
