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
