<h1>profile</h1>
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
$user_id = substr($location,9);
$url = "http://localhost/data/users?user_id=". $user_id;
$data = file_get_contents($url);

$k=json_decode($data,true);
echo $k[0][user_id]."<br>";
echo $k[0][name]."<br>";

?>