<?php


   require('db_config.php');
   $sql = "SELECT * FROM `tbltag`
         WHERE tag_id < '".$_GET['last_id']."' 
         ORDER BY tagStories DESC LIMIT 8"; 
   $result = $conn->query($sql);
   $json = include('datatag.php');
   if($json != 1){echo json_encode($json);}
   
?>