<html>
<head>
<title>System API</title>
</head>
<body>

<!--  Login  -->
<form name="form1" method="post" action="user/login">
  Login<br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> &nbsp;Username</td>
        <td>
          <input name="email" type="text" id="txtUsername">
        </td>
      </tr>
      <tr>
        <td> &nbsp;Password</td>
        <td><input name="password" type="password" id="txtPassword">
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="Login">
</form>
<br>
<br>

<!--  Register  -->
<form name="form2" method="post" action="user/register">
  Register<br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> &nbsp;Username</td>
        <td>
          <input name="email" type="text" id="txtUsername">
        </td>
      </tr>
      <tr>
        <td> &nbsp;Password</td>
        <td><input name="password" type="password" id="txtPassword">
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="Register">
</form>


<!--  Edit Profile  -->
<form name="form3" method="post" action="user/editprofile">
Edit Profile
<? session_start();$_SESSION[user_id]=47;echo $_SESSION[user_id];?>
<br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> &nbsp;user_id</td>
        <td>
          <input name="user_id" type="hidden" id="txtUsername" value="<?echo $_SESSION[user_id];?>">
        </td>
      </tr>
      <tr>
        <td> &nbsp;name</td>
        <td>
          <input name="name" type="text" id="txtUsername">
        </td>
      </tr>
      <tr>
        <td> &nbsp;detail</td>
        <td><input name="detail" type="text" id="txtPassword">
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="edit">
</form>




<!--  Edit Story  -->
<form name="form3" method="post" action="user/editstory">
Edit Story
<br>
<? $content_id = 43; echo $content_id?>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> &nbsp;content_id</td>
        <td>
          <input name="content_id" type="hidden" id="txtUsername" value="<?echo $content_id;?>">
        </td>
      </tr>
      <tr>
        <td> &nbsp;content</td>
        <td><input name="content" type="text" id="txtPassword">
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="edit Story">
</form>




<!--  Delete Story  -->
<form name="form4" method="get" action="user/deletestory">
Delete Story
<br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> &nbsp;content_id</td>
        <td>
          <input name="content_id" type="text" id="txtUsername" >
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="delete">
  <br>
<a href="https://passwordsgenerator.net/md5-hash-generator/">md5</a>
</form>

</body>
</html>