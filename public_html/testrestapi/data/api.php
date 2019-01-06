<?php
    
	/* 
	 * ระบบดู profile
	 * ระบบดู stories
	 * เข้ารหัสด้วย md5	 
 	*/

	 header("Access-Control-Allow-Origin: *");
	 header("Content-Type: application/json; charset=UTF-8");
	
	// Initiiate Library

	class newClass
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
		
	   public function getSite()
	   {
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			 // echo "Mindphp.com";
			if((int)method_exists($this,$func) > 0)
			  $this->$func();
		  	else
			  $this->response('',404);				  
	   }

	   
	   private function stories(){
			//echo $_GET['content_id'];
			$content_id = $_GET['content_id'];
			$sql = $this->db->query("SELECT * FROM tblcontent WHERE md5(content_id) = '$content_id'");
			if($sql->num_rows > 0){
				//echo "OK sql feed_new";
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	 	private function load_new(){
			$sql = $this->db->query("SELECT * FROM tblcontent WHERE content_id < ".$_GET['content_id']." ORDER BY content_id DESC LIMIT 8");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}
		   




		

	}
	//echo "OK";
	$newClassInstance = new newClass();
	//$newClassInstance = new newClass;
	$newClassInstance->getSite();
	
?>

