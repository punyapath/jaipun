<?php
    
	/* 
	 * ระบบดู profile
	 * ระบบดู stories
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

			$this->db->query("UPDATE tblcontent SET contentTop = contentTop + 1 WHERE content_id = '$content_id'");
			$sql = $this->db->query(
				"SELECT 
				tblcontent.content_id
				, tblcontent.contentName
				, tblcontent.content
				, tblcontent.user_id
				, tblcontent.tag_id    
				, tblcontent.contentLike                   
				, tblcontent.type
				, tblcontent.contentTop			
				, tbltag.tagname
				, tblmember.name
				, tblmember.detail
				, tblmember.profile				
				FROM tblcontent,tblmember,tbltag 
				WHERE tblcontent.content_id=$content_id AND tblcontent.user_id=tblmember.member_id
				AND tblcontent.tag_id=tbltag.tag_id");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$this->db->query("UPDATE tbltag SET tagTop = tagTop + 1 WHERE tag_id = '$rlt[tag_id]'");
					echo json_encode($rlt);
				}
				//echo json_encode($result);
			}
	   }


	   private function users(){
			$name = $_GET['name'];
			$sql = $this->db->query("SELECT * FROM tblmember WHERE name = '$name'");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					echo json_encode($rlt);
				}
				//echo json_encode($result);
			}
		}


		private function tag(){
			$tag_id = $_GET['tag_id'];
			$sql = $this->db->query("SELECT * FROM tbltag WHERE tag_id = '$tag_id'");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					echo json_encode($rlt);
				}
				//echo json_encode($result);
			}
		}


		private function usedraw(){
			$drawname_id = $_GET['drawname_id'];
			$sql=$this->db->query("SELECT CONCAT('draw/', '$drawname_id', '/', draw) AS name,72 AS width,72 AS height FROM tbldraw
			WHERE drawname_id=$drawname_id
			ORDER BY draw_id DESC");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}


		private function drawname(){
			$sql = $this->db->query("SELECT * FROM tbldrawname limit 12");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}


		private function drawuse(){
			$user_id = $_GET[user_id];
			$sql = $this->db->query("SELECT 
			tbldrawname.drawname_id,tbldrawname.drawTag 
			FROM `tbldrawuse`,tbldrawname WHERE tbldrawuse.user_id=$user_id 
			and tbldrawname.drawname_id =tbldrawuse.drawname_id");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}

		private function drawer(){
			$drawname_id = $_GET['drawname_id'];
			$sql = $this->db->query("SELECT 
			tbldrawname.drawname_id
			,tbldrawname.drawname
			,tbldrawname.drawTag
			,tbldrawname.drawuseCount
			,tbldrawname.drawnameDate
			,tblmember.name
			,tblmember.member_id			
			FROM tbldrawname,tblmember WHERE tbldrawname.drawname_id=$drawname_id and 
			tbldrawname.user_id=tblmember.member_id");
			if($sql->num_rows > 0){
				$rlt = $sql->fetch_assoc();
				echo json_encode($rlt);
			}
		}

	}
	
	$api = new data_api();
	$api->processApi();
	
?>

