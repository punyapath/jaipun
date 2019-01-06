<?php


   require('db_config.php');

   $sql = "SELECT * FROM `tblcontent`,`tbltag` 
      WHERE tblcontent.tag_id=tbltag.tag_id and content_id < '".$_GET['last_id']."' and user_id ='$_GET[profile]'
         ORDER BY content_id DESC LIMIT 8"; 
   $result = $conn->query($sql);
   $json = include('datauser.php');
if($json != 1){echo json_encode($json);}
?>