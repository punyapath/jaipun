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
$name = substr($location,6);
$url = "http://localhost/data/users?name=". $name;
$data = file_get_contents($url);

$k=json_decode($data,true);
echo $k[0][user_id]."<br>";
echo $k[0][name]."<br>";

?>



<!--  Edit Profile  -->
<form name="form3" method="post" action="/user/editprofile">
Edit Profile
<? session_start();echo "your user_id".$_SESSION[user_id];?>
<br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> &nbsp;user_id</td>
        <td>
          <input name="user_id" type="hidden" id="txtUsername" value="<?echo $k[0][user_id];?>">
        </td>
      </tr>
      <tr>
        <td> &nbsp;name</td>
        <td>
          <input name="name" type="text" id="txtUsername" value="<? echo $k[0][name]; ?>">
        </td>
      </tr>
      <tr>
        <td> &nbsp;detail</td>
        <td><input name="detail" type="text" id="txtPassword" value="<? echo $k[0][detail]; ?>">
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="edit">
</form>


