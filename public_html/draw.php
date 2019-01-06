<?php
session_start();
require('db_config.php');


if(isset($_POST['but_upload'])){
  
  $fileupload = $_REQUEST['file']; //รับค่าไฟล์จากฟอร์ม  
  $fileinfo = @getimagesize($_FILES["file"]["tmp_name"]); 
  $width = $fileinfo[0]; echo $width;
  $height = $fileinfo[1]; echo $height;
  $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION); echo $file_extension;
  //โฟลเดอร์ที่จะ upload file เข้าไป  
  $path="draw/".$_GET[drawname_id]."/";   
  if(!is_dir($path)){
    mkdir($path,"0777",true);  
    chmod($path,0777);
  }

  date_default_timezone_set('Asia/Bangkok'); 
  $date = date("Ymd");  
 //ฟังก์ชั่นสุ่มตัวเลข 
          $numrand = (mt_rand(10,100)); 
 //เพิ่มไฟล์ 
 $upload=$_FILES['file']; 
 if($upload <> ''&& $width < "370" && $height < "370" && $file_extension=="png") {   //not select file 
 //โฟลเดอร์ที่จะ upload file เข้าไป  
    
   
 //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล 
  $type = strrchr($_FILES['file']['name'],"."); 
   
 //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม 
    $newname = $date.$numrand.$type; 
    $path_copy=$path.$newname; 
    $path_link=$path.$newname; 
  
//คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์ 
move_uploaded_file($_FILES['file']['tmp_name'],$path_copy);
   // Insert record
   
   $conn->query("INSERT INTO tbldraw VALUES (0,'$_GET[drawname_id]','$newname')");
   
 
  }
  
 }
 ?>
 
 <form method="post" action="" enctype='multipart/form-data'>
   <input type='file' name='file' />
   <input type='submit' value='Save name' name='but_upload'>
 </form>


 <?php


$image = $row['name'];
$image_src = $path.$image;


$sql = "SELECT draw FROM tbldraw
WHERE drawname_id=$_GET[drawname_id]
ORDER BY draw_id DESC"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $i=1;
  ?>
  <table style="width:100%;">
  <?
  while($tbldraw = $result->fetch_assoc()) {
    ?>


    <tr><td><? echo $i ?></td></tr>
    <tr><td><?  echo "<img src='$path".$tbldraw[draw]."'/>"; ?></td></tr>



    <?
    
    $i++;
  }
  ?>
  </table>
  <?
} else {
  echo "0 results";
}
$conn->close();


?>



