<?php
    
	/* 
	 * ระบบดู profile
	 * ระบบดู stories
	 * เข้ารหัสด้วย md5	 
 	*/

	 header("Access-Control-Allow-Origin: *");
	 header("Content-Type: application/json; charset=UTF-8");
	
	// Initiiate Library

	class data_api
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

	   
	   private function stories(){
			$content_id = $_GET['content_id'];
			$sql = $this->db->query("SELECT * FROM tblcontent WHERE md5(content_id) = '$content_id'");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	   private function users(){
			$name = $_GET['name'];
			$sql = $this->db->query("SELECT * FROM tbluser WHERE name = '$name'");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}

	}
	$api = new data_api();
	$api->processApi();
	
?>

