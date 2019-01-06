
     
<?
session_start();
require('db_config.php');



     if(isset($_POST[drawnamesave])){
        date_default_timezone_set("Asia/Bangkok");
        $date= time();  

        $fileupload = $_REQUEST['file']; //รับค่าไฟล์จากฟอร์ม  
        $fileinfo = @getimagesize($_FILES["file"]["tmp_name"]); 
        $width = $fileinfo[0]; echo $width;
        $height = $fileinfo[1]; echo $height;
        $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION); echo $file_extension;
        //โฟลเดอร์ที่จะ upload file เข้าไป  
        $path="drawtag/";   
      
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
         

        $sql="INSERT INTO tbldrawname VALUES (0,'$_SESSION[user_id]','$_POST[drawname]','$newname','$date','','')";  
       }
echo $sql;

        if($conn->query($sql) === TRUE){
            $result = $conn->query("SELECT * FROM tbldrawname WHERE drawname='$_POST[drawname]'");
            $row = $result->fetch_assoc();
            echo "<script>alert('++ Complete ++');window.location='draw.php?drawname_id=$row[drawname_id]'</script>"; 
        //$_SESSION['username']=$username;
            echo "<font color=#FF0000>บันทึกฐานข้อมูลได้</font>";
        }else{
            echo "<font color=#FF0000>ไม่สามารถบันทึกฐานข้อมูลได้</font>";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }
?>


<h1>เพิ่มภาพประกอบลงในเว็บ</h1>
<br>
<p>ใส่ชื่อภาพประกอบ</p>
<form action="" method="POST" enctype='multipart/form-data'>
<input type="text" name="drawname">
<input type="hidden" name="drawnamesave">
<input type='file' name='file' />
<input type="submit">
</form>
