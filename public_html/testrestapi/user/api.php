<?php

	require_once("Rest.inc.php");
		/*
		 * Class สำหรับทำงานกับผู้ใช้
		 * ระบบ login , register , editprofile
		 * ระบบจัดการเนื้อหา editstory , deletestory
		*/	
	
	class API extends REST {
	
		public $data = "";
		
		const DB_SERVER = "localhost";
		const DB_USER = "jaipunco";
		const DB_PASSWORD = "P10oct2540M##";
		const DB = "jaipunco_db";
		
		private $db = NULL;
	
		public function __construct(){
			parent::__construct();				// Init parent contructor
			$this->dbConnect();					// Initiate Database connection
		}
		
		/*
		 *  Database connection 
		*/
		private function dbConnect(){
			$this->db = mysql_connect(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD);
			if($this->db)
				mysql_select_db(self::DB,$this->db);
		}

		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404);				// If the method not exist with in this class, response would be "Page not found".
		}
		
		/* 
		 *	Simple login API
		 *  Login must be POST method
		 *  email : <USER EMAIL>
		 *  pwd : <USER PASSWORD>
		 */
		
		private function login(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			
			$email = $this->_request['email'];		
			$password = $this->_request['password'];
			$password = base64_encode($password);

			if(!empty($email) and !empty($password)){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$sql = mysql_query("SELECT * FROM tbluser WHERE email = '$email' AND password = '".$password."' LIMIT 1", $this->db);
					if(mysql_num_rows($sql) > 0){
						$result = mysql_fetch_array($sql,MYSQL_ASSOC);
						
						// If success everythig is good send header as "OK" and user details
						$this->response($this->json($result), 200);
					}
					$this->response('', 204);	// If no records "No Content" status
				}
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		private function register(){	
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$email= $this->_request['email'];
			$password= $this->_request['password'];
			$password=base64_encode($password);
			$name=substr($username, 0 ,strpos($username, "@"));
			
			if (getenv(HTTP_X_FORWARDED_FOR))
			$ip=getenv(HTTP_X_FORWARDED_FOR);
			else
			$ip=getenv(REMOTE_ADDR);

			if(!empty($email) and !empty($password)){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$sql = "INSERT INTO `tbluser` (`user_id`, `email`, `password`, `name`,`detail` ,`user_ip`, `stories`) VALUES (0,'$email','$password','$name','....','$ip','')";
					if(mysql_query($sql,$this->db)){
						$sql = mysql_query("SELECT * FROM tbluser WHERE email='$email'",$this->db);
						$result = mysql_fetch_array($sql,MYSQL_ASSOC);
						session_start();
						$_SESSION['user_id']=$result['user_id']; 
						// If success everythig is good send header as "OK" and user details
						$this->response($this->json($result), 200);
					}
					$this->response('', 204);	// If no records "No Content" status
				}
			}
		}
		
		private function editprofile(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$user_id = $this->_request['user_id'];					
			$name = $this->_request['name'];		
			$detail = $this->_request['detail'];
			$name=htmlspecialchars($name,ENT_QUOTES);
			$detail=htmlspecialchars($detail,ENT_QUOTES);
			
			// Input validations
			if(!empty($name) and !empty($detail)){
					$sql="UPDATE `tbluser` SET  `name` = '$name', `detail` = '$detail' WHERE `tbluser`.`user_id` = $user_id";
					if(mysql_query($sql,$this->db)){
						$sql = mysql_query("SELECT * FROM tbluser WHERE user_id='$user_id'",$this->db);
						$result = mysql_fetch_array($sql,MYSQL_ASSOC);
						
						// If success everythig is good send header as "OK" and user details
						$this->response($this->json($result), 200);
					}
					$this->response('', 204);	// If no records "No Content" status
			}

		}



		private function editstory(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$content_id = $this->_request['content_id'];					
			$content = $this->_request['content'];		
			
			// Input validations
			if(!empty($content_id) and !empty($content)){
					$sql="UPDATE `tblcontent` SET  `content` = '$content' WHERE `tblcontent`.`content_id` = $content_id";
					if(mysql_query($sql,$this->db)){
						$sql = mysql_query("SELECT * FROM tblcontent WHERE content_id='$content_id'",$this->db);
						$result = mysql_fetch_array($sql,MYSQL_ASSOC);
						
						// If success everythig is good send header as "OK" and user details
						$this->response($this->json($result), 200);
					}
					$this->response('', 204);	// If no records "No Content" status
			}

		}



		private function deletestory(){
				// Cross validation if the request method is DELETE else it will return "Not Acceptable" status
				if($this->get_request_method() != "GET"){
					$this->response('',406);
				}
				$content_id = $this->_request['content_id'];
				if($content_id > 0){				
					mysql_query("DELETE FROM tblcontent WHERE md5(content_id) = $content_id");
					$success = array('status' => "Success", "msg" => "Successfully one record deleted.");
					$this->response($this->json($success),200);
				}else
					$this->response('',204);	// If no records "No Content" status
		}



		
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
	}
	
	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>