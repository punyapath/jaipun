<?php
session_start();
	//require_once("Rest.inc.php");
		/*
		 * Class สำหรับทำงานกับผู้ใช้
		 * ระบบ login , register , editprofile
		 * ระบบจัดการเนื้อหา editstory , deletestory
		*/	


		class user_api
		{
	
			private $db = NULL;
			public $_content_type = "application/json";
			private $_code = 200;
	
	
			public function __construct(){
				$host="localhost";
				$user="jaipunco";    
				$pass="P10oct2540M##"; 
				$dbname="jaipunco_db"; 
				
				$this->db=new mysqli($host,$user,$pass,$dbname); 
				if($this->db->connect_error) {
				  die("connection failed:" . $conn->connect_error);
				}
				
			}
			public function get_request_method(){
				return $_SERVER['REQUEST_METHOD'];
			}
			
		   public function processApi()
		   {
				$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
				if((int)method_exists($this,$func) > 0)
				  $this->$func();
				  else
				  header("HTTP/1.1 404 Not Found");
		   }
	


		private function poststory(){
			$tag_id=$_POST['tag_id'];                        //$_GET['tag_id'];
			$user_id=$_SESSION['user_id'];                            //$_SESSION['user_id'];
			$contentname=$_POST['title'];
			$content=$_POST['content'];
			$type=$_POST['type'];
			$str=htmlspecialchars($content,ENT_QUOTES);
			
			date_default_timezone_set("Asia/Bangkok");
			$time= time();
			
			
			if (getenv(HTTP_X_FORWARDED_FOR))
			$ip=getenv(HTTP_X_FORWARDED_FOR);
			else
			$ip=getenv(REMOTE_ADDR);
			
			
			
			$sql="INSERT INTO tblcontent VALUES (0,'$user_id','$tag_id','$type','$contentname','$str','$time','$ip','0','0')";
			
			if($this->db->query($sql) === TRUE){
			$result = $this->db->query("SELECT * FROM tblcontent WHERE contentName='$contentname' and contentDate = '$time'");
			$row = $result->fetch_assoc();
			$content_id=$row['content_id'];
			$this->db->query("UPDATE  tbltag SET tagStories = tagStories + 1 WHERE tag_id='$row[tag_id]'");
			$this->db->query("UPDATE  tbluser SET Stories = Stories + 1 WHERE user_id='$_SESSION[user_id]'");
			$Updatedraw = $this->db->query("SELECT * FROM tbldrawuse WHERE user_id = '$_SESSION[user_id]'");
			if ($Updatedraw->num_rows > 0){
				$tbldrawuse = $Updatedraw->fetch_assoc();
				$drawname_id = $tbldrawuse[drawname_id];
				$this->db->query("UPDATE tbldrawname SET drawuseCount = drawuseCount + 1 WHERE drawname_id=$drawname_id");
			}
			
				echo $content_id; 
			}else{
				echo "<font color=#FF0000>ไม่สามารถบันทึกฐานข้อมูลได้</font>";
			}
		}




}

		

		
	$api = new user_api();
	$api->processApi();
	
	
	
?>