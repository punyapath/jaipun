<!--  Write Story  -->
<? session_start(); ?>
<form name="form5" method="post" action="user/poststory">
POST Story
<br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> &nbsp;tag_id</td>
        <td>
          <input name="tag_id" type="text" id="txtUsername" >
        </td>
      </tr>

          <input name="user_id" type="hidden" id="txtUsername" value="<? echo $_SESSION[user_id] ?>" >

      <tr>
        <td> &nbsp;title</td>
        <td>
          <input name="title" type="text" id="txtUsername" >
        </td>
      </tr>
      <tr>
        <td> &nbsp;content</td>
        <td>
          <input name="content" type="text" id="txtUsername" >
        </td>
      </tr>
      <tr>
        <td> &nbsp;type</td>
        <td>
          <input name="type" type="text" id="txtUsername" >
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="post">
  <br>
</form>