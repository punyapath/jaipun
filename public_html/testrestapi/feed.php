<h1>feed</h1>
<?

/*
*
*  ระบบ feed เรียงตามความใหม่ของเนื้อหา 
*  ตัว load ของ feed
*  feed tag + load tag เรียงตามจำนวน tag_id 
*/


/**************feed new Start****************/

$url = "http://jaipun.com/testrestapi/feed/feed_new";
$data = file_get_contents($url);

$k=json_decode($data,true);

for ($i = 0; $i < 8; $i++ ) {
    echo "<a href='story/".md5($k[$i][content_id]), "'>".$k[$i][content_id]."</a>", "contentDate : ";    
    echo $k[$i][contentDate], "<br>";
}

/**************feed new end****************/

?>
<h1>LOAD</h1>

<?

/**************load new Start****************/

$url = "http://jaipun.com/testrestapi/feed/load_new?content_id=47";
$data = file_get_contents($url);

$k=json_decode($data,true);

for ($i = 0; $i < 8; $i++ ) {
    echo "<a href='story/".md5($k[$i][content_id]), "'>".$k[$i][content_id]."</a>", "contentDate : ";        
    echo $k[$i][contentDate], "<br>";
}
/**************load new End****************/

?>


<h1>TAG</h1>

<?

/**************tag new Start****************/

$url = "http://jaipun.com/testrestapi/feed/tag_new";
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

$url = "http://jaipun.com/testrestapi/feed/tagload_new?tag_id=16";
$data = file_get_contents($url);

$k=json_decode($data,true);

for ($i = 0; $i < 8; $i++ ) {
    echo $k[$i][tag_id], "tagname : ";
    echo $k[$i][tagname], "  tagStories : ";
    echo $k[$i][tagStories], "<br>";
}
/**************tagload new End****************/

?>

