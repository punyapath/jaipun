<h1>Story</h1>
<?
$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$location = $_SERVER['REQUEST_URI'];
if ($_SERVER['QUERY_STRING']) {
  $location = substr($location, 0, strrpos($location, $_SERVER['QUERY_STRING']) - 1);
}
$url = $protocol.'://'.$_SERVER['HTTP_HOST'].$location;

function extract_int($str){
    preg_match('/[^0-9]*([0-9]+)[^0-9]*/', $str, $regs);
    return (intval($regs[1]));
}
$content_id = substr($location,19);
$url = "http://jaipun.com/testrestapi/data/stories?content_id=". $content_id;
$data = file_get_contents($url);

$k=json_decode($data,true);
echo $k[0][content_id]."<br>";
echo $k[0][contentName]."<br>";
echo $k[0][content]."<br>";
echo $k[0][contentDate]."<br>";
echo $k[0][contentLike]."<br>";


?>