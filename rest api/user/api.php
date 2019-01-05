<?php

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
	
		   /************** login Start********************/
		   private function login(){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				
				$email = $_POST['email'];		
				$password = $_POST['password'];
				$password = base64_encode($password);
				if(!empty($email) and !empty($password)){
					if(filter_var($email, FILTER_VALIDATE_EMAIL)){
						$sql = $this->db->query("SELECT * FROM tbluser WHERE email = '$email' AND password = '".$password."' LIMIT 1");
						if($sql->num_rows > 0){
							$result = $sql->fetch_assoc();
							session_start();
							$_SESSION['user_id']=$result['user_id']; 
							echo json_encode($result);
							//header('Location: /home');
							exit();
						}
					}
				}
				// If invalid inputs "Bad Request" status message and reason
				//$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
				//echo json_encode($error);
				echo"<script>alert('Invalid Email address or Password');history.back();</script>";
		   }

		   /************** login End********************/

		/************** Register Start********************/
		private function register(){	
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$email= $_POST['email'];
			$password= $_POST['password'];
			$password=base64_encode($password);
			$name=substr($username, 0 ,strpos($username, "@"));
			
			if (getenv(HTTP_X_FORWARDED_FOR))
			$ip=getenv(HTTP_X_FORWARDED_FOR);
			else
			$ip=getenv(REMOTE_ADDR);

			$checkemail = $this->db->query("SELECT * FROM tbluser WHERE email='$email'");			
			if(!empty($email) and !empty($password)){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$sql = "INSERT INTO `tbluser` (`user_id`, `email`, `password`, `name`,`detail` ,`user_ip`, `stories`) VALUES (0,'$email','$password','$name','....','$ip','')";
					if($checkemail->num_rows>1){              
             			 echo"<script>alert('!! ชื่ออีเมลซ้ำ !!');history.back();</script>";
					}else if($this->db->query($sql)){
						$sql = $this->db->query("SELECT * FROM tbluser WHERE email='$email'");
						$result = $sql->fetch_assoc();
						session_start();
						$_SESSION['user_id']=$result['user_id']; 
						// If success everythig is good send header as "OK" and user details
						echo json_encode($result);
						//header('Location: /home');
						exit();
					}
				}
			}
		}
		/************** Register End********************/


		/************** Editprofile Start********************/
		private function editprofile(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$user_id = $_POST['user_id'];					
			$name = $_POST['name'];		
			$detail = $_POST['detail'];
			$name=htmlspecialchars($name,ENT_QUOTES);
			$detail=htmlspecialchars($detail,ENT_QUOTES);
			
			// Input validations
			if(!empty($name) and !empty($detail)){
					$sql="UPDATE `tbluser` SET  `name` = '$name', `detail` = '$detail' WHERE `tbluser`.`user_id` = $user_id";
					if($this->db->query($sql)){
						$sql = $this->db->query("SELECT * FROM tbluser WHERE user_id='$user_id'");
						$result = $sql->fetch_assoc();
						
						// If success everythig is good send header as "OK" and user details
						echo json_encode($result);
						exit();
					}
			}

		}
		/************** Editprofile End********************/


		/************** EditStory Start********************/
		private function editstory(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$content_id = $_POST['content_id'];					
			$content =  $_POST['content'];		
			
			// Input validations
			if(!empty($content_id) and !empty($content)){
					$sql="UPDATE `tblcontent` SET  `content` = '$content' WHERE `tblcontent`.`content_id` = $content_id";
					if($this->db->query($sql)){
						$sql = $this->db->query("SELECT * FROM tblcontent WHERE content_id='$content_id'");
						$result = $sql->fetch_assoc();
												
						// If success everythig is good send header as "OK" and user details
						echo json_encode($result);
						exit();
					}
					$this->response('', 204);	// If no records "No Content" status
			}

		}
		/************** EditStory End********************/


		/************** deleteStory Start********************/		
		private function deletestory(){
			// Cross validation if the request method is DELETE else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$content_id = $_GET['content_id'];
			if(isset($content_id)){				
				$this->db->query("DELETE FROM tblcontent WHERE md5(content_id) = '$content_id'");
				$success = array('status' => "Success", "msg" => "Successfully one record deleted.");
				echo json_encode($success);
				exit();
			}else
				$this->response('',204);	// If no records "No Content" status
		}
		/************** deleteStory End********************/	

		
		

		private function poststory(){
			$tag_id=$_POST['tag_id'];                        //$_GET['tag_id'];
			$user_id=$_POST['user_id'];                            //$_SESSION['user_id'];
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
			
			
			if($_SESSION[image] != 0){
			rename($_SERVER['DOCUMENT_ROOT'] . "/"."images/".$_SESSION[image],$_SERVER['DOCUMENT_ROOT'] . "/"."images/".$content_id.'.jpeg');$_SESSION[image]=0;}
			echo $content_id; 
			//$_SESSION['username']=$username;
			}else{
			echo "<font color=#FF0000>ไม่สามารถบันทึกฐานข้อมูลได้</font>";
			}
		}




}

		

		
	$api = new user_api();
	$api->processApi();
	
	
	
?>