<?php	

		/*
		 * Class สำหรับทำงานติดต่อกับระบบ feed ต่างๆ
		 * feed_new , load_new , เรียงเนื้อหาตาม content_id
		 * feed_top , load_top , เรียงเนื้อหาตาม contentLike
		 * tag_new ,tagload_new  เรียงหัวข้อตาม tag_id
		 * tagid_new ,tagidload_new  เรียงเนื้อหาเจาะจง tag_id		 
		*/	

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	class feed_api
	{

		private $db = NULL;
		public $_content_type = "application/json";

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

//ฟีคเนื้อหาธรรมดาๆที่ เรียงตาม content_id  	   
	   private function feed_new(){
			$sql = $this->db->query("
            SELECT 
            tblcontent.content_id
            , tblcontent.contentName
            , tblcontent.content
            , tblcontent.contentDate
            , tblcontent.type
            , tblcontent.tag_id
            , tblcontent.contentLike
            , tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
            WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id 
            ORDER BY content_id DESC LIMIT 4");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	   //ฟีคเนื้อหาธรรมดาๆที่ เรียงตาม content_id  	   
	   private function feed_new1(){
		$sql = $this->db->query("
		SELECT 
		tblcontent.content_id
		, tblcontent.contentName
		, tblcontent.content
		, tblcontent.contentDate
		, tblcontent.type
		, tblcontent.tag_id
		, tblcontent.contentLike
		, tbltag.tagname
		, tbluser.user_id
		, tbluser.name
		, tbluser.detail
		FROM tblcontent,tbluser,tbltag
		WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tbluser.user_id 
		ORDER BY content_id DESC LIMIT 40");
		if($sql->num_rows > 0){
			$result = array();
			while($rlt = $sql->fetch_assoc()){
				$result[] = $rlt;
			}
			echo json_encode($result);
		}
   }




   
//ฟีคหัวข้อ เรียงตาม content_id ตาม story
private function feed_story(){
	$sql = $this->db->query("
	SELECT 
	tblcontent.content_id
	, tblcontent.contentName
	, tblcontent.content
	, tblcontent.contentDate
	, tblcontent.type
	, tblcontent.tag_id
	, tblcontent.contentLike
	, tbltag.tagname
	, tbluser.user_id
	, tbluser.name
	, tbluser.detail
	FROM tblcontent,tbluser,tbltag
	WHERE content_id <> '".$_GET['content_id']."' and tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tbluser.user_id   AND tblcontent.tag_id = ".$_GET[id]."
	ORDER BY contentLike DESC LIMIT 3
	");
	if($sql->num_rows > 0){
		$result = array();
		while($rlt = $sql->fetch_assoc()){
			$result[] = $rlt;
		}
		echo json_encode($result);
	}
}


	 	private function load_new(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE content_id < '".$_GET['content_id']."' and tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id 
			ORDER BY content_id DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}

//ฟีคเนื้อหาธรรมดาๆที่ เรียงตาม contentLike  
		private function feed_top(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id 
			ORDER BY contentLike DESC LIMIT 4");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	 	private function load_top(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE contentLike < ".$_GET['contentLike']." and tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id 
			ORDER BY contentLike DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}
		   
//ฟีคหัวข้อ เรียงตาม tag_id   
		private function tag_new(){
			$sql = $this->db->query("SELECT * FROM tbltag ORDER BY tag_id DESC LIMIT 8");
			if($sql->num_rows > 0){
				//echo "OK sql feed_new";
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	 	private function tagload_new(){
			$sql = $this->db->query("SELECT * FROM tbltag WHERE tag_id < ".$_GET['tag_id']." ORDER BY tag_id DESC LIMIT 8");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}


		//ฟีคหัวข้อ เรียงตาม tagTop   
		private function tag_top(){
			$sql = $this->db->query("SELECT * FROM tbltag ORDER BY tagTop DESC LIMIT 8");
			if($sql->num_rows > 0){
				//echo "OK sql feed_new";
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	 	private function tagload_top(){
			$sql = $this->db->query("SELECT * FROM tbltag WHERE tagTop < ".$_GET['tagTop']." ORDER BY tag_id DESC LIMIT 8");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}

		//เรียงตามการค้นหา tag
		private function tagsearch_top(){
			$sql = $this->db->query("
			SELECT * FROM tbltag WHERE tagname LIKE '%".$_GET[t]."%'
			ORDER BY tagTop DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}
		   
//ฟีคเฉพาะ tag_id เรียงตาม content_id  
		private function tagid_new(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tblcontent.contentTop			
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id  AND tblcontent.tag_id = ".$_GET[id]."
			ORDER BY content_id DESC LIMIT 4
			");
			if($sql->num_rows > 0){
				//echo "OK sql feed_new";
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	 	private function tagidload_new(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tblcontent.contentTop		
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE content_id < ".$_GET['content_id']." AND tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id  AND tblcontent.tag_id = ".$_GET[id]."
			ORDER BY content_id DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}


				   
//ฟีคเฉพาะ tag_id เรียงตาม contentTop   
private function tagid_top(){
	$sql = $this->db->query("
	SELECT 
	tblcontent.content_id
	, tblcontent.contentName
	, tblcontent.content
	, tblcontent.contentDate
	, tblcontent.type
	, tblcontent.tag_id
	, tblcontent.contentLike
	, tblcontent.contentTop		
	, tbltag.tagname
	, tblcontent.user_id 
	, tblmember.name
	, tblmember.detail
	, tblmember.profile			
	FROM tblcontent,tblmember,tbltag
	WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id AND tblcontent.tag_id = ".$_GET[id]."
	ORDER BY contentTop DESC LIMIT 4
	");
	if($sql->num_rows > 0){
		//echo "OK sql feed_new";
		$result = array();
		while($rlt = $sql->fetch_assoc()){
			$result[] = $rlt;
		}
		echo json_encode($result);
	}
}


 private function tagidload_top(){
	$sql = $this->db->query("
	SELECT 
	tblcontent.content_id
	, tblcontent.contentName
	, tblcontent.content
	, tblcontent.contentDate
	, tblcontent.type
	, tblcontent.tag_id
	, tblcontent.contentLike
	, tblcontent.contentTop	
	, tbltag.tagname
	, tblcontent.user_id 
	, tblmember.name
	, tblmember.detail
	, tblmember.profile			
	FROM tblcontent,tblmember,tbltag
	WHERE contentTop < ".$_GET['contentTop']." AND tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id  AND tblcontent.tag_id = ".$_GET[id]."
	ORDER BY contentTop DESC LIMIT 8
	");
	if($sql->num_rows > 0){
		$result = array();
		while($rlt = $sql->fetch_assoc()){
			$result[] = $rlt;
		}
		echo json_encode($result);
	}
}



//ฟีคชนิด type เรียงตาม content_id  
		private function type_new(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tblcontent.contentTop			
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id  AND tblcontent.type = '".$_GET[t]."'
			ORDER BY content_id DESC LIMIT 4
			");
			if($sql->num_rows > 0){
				//echo "OK sql feed_new";
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	 	private function typeload_new(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tblcontent.contentTop		
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE content_id < ".$_GET['content_id']." AND tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id  AND tblcontent.type = '".$_GET[t]."'
			ORDER BY content_id DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}


				   
//ฟีคชนิด type เรียงตาม contentTop   
private function type_top(){
	$sql = $this->db->query("
	SELECT 
	tblcontent.content_id
	, tblcontent.contentName
	, tblcontent.content
	, tblcontent.contentDate
	, tblcontent.type
	, tblcontent.tag_id
	, tblcontent.contentLike
	, tblcontent.contentTop		
	, tbltag.tagname
	, tblcontent.user_id 
	, tblmember.name
	, tblmember.detail
	, tblmember.profile			
	FROM tblcontent,tblmember,tbltag
	WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id  AND tblcontent.type = '".$_GET[t]."'
	ORDER BY contentTop DESC LIMIT 4
	");
	if($sql->num_rows > 0){
		//echo "OK sql feed_new";
		$result = array();
		while($rlt = $sql->fetch_assoc()){
			$result[] = $rlt;
		}
		echo json_encode($result);
	}
}


 private function typeload_top(){
	$sql = $this->db->query("
	SELECT 
	tblcontent.content_id
	, tblcontent.contentName
	, tblcontent.content
	, tblcontent.contentDate
	, tblcontent.type
	, tblcontent.tag_id
	, tblcontent.contentLike
	, tblcontent.contentTop	
	, tbltag.tagname
	, tblcontent.user_id 
	, tblmember.name
	, tblmember.detail
	, tblmember.profile			
	FROM tblcontent,tblmember,tbltag
	WHERE contentTop < ".$_GET['contentTop']." AND tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id AND tblcontent.type = '".$_GET[t]."'
	ORDER BY contentTop DESC LIMIT 8
	");
	if($sql->num_rows > 0){
		$result = array();
		while($rlt = $sql->fetch_assoc()){
			$result[] = $rlt;
		}
		echo json_encode($result);
	}
}

//ฟีคเฉพาะ user_id เรียงตาม content_id	   
		   private function feed_user(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.user_id	
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tbltag.tagname
			FROM tblcontent,tbltag
			WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = ".$_GET[id]."
			ORDER BY content_id DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
	   }


	 	private function load_user(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.user_id	
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tbltag.tagname
			FROM tblcontent,tbltag
			WHERE content_id < ".$_GET['content_id']." AND tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = ".$_GET[id]."
			ORDER BY content_id DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}
//ฟีคค้นหา เรียงตาม content_id
		private function search_new(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tblcontent.contentTop						
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id 
			AND tblcontent.contentName LIKE '%".$_GET[t]."%'
			ORDER BY content_id DESC LIMIT 4
			");
			if($sql->num_rows > 0){
				//echo "OK sql feed_new";
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}

		   
	private function searchload_new(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.user_id	
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tblcontent.contentTop						
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id 
			AND content_id < ".$_GET['content_id']." 
			AND tblcontent.contentName LIKE '%".$_GET[t]."%'
			ORDER BY content_id DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}


		//ฟีคค้นหา เรียงตาม contentTop
		private function search_top(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tblcontent.contentTop						
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id 
			AND tblcontent.contentName LIKE '%".$_GET[t]."%'
			ORDER BY contentTop DESC LIMIT 4
			");
			if($sql->num_rows > 0){
				//echo "OK sql feed_new";
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}

		   
		private function searchload_top(){
			$sql = $this->db->query("
			SELECT 
			tblcontent.content_id
			, tblcontent.user_id	
			, tblcontent.contentName
			, tblcontent.content
			, tblcontent.contentDate
			, tblcontent.type
			, tblcontent.tag_id
			, tblcontent.contentLike
			, tblcontent.contentTop			
			, tbltag.tagname
            , tblcontent.user_id 
			, tblmember.name
			, tblmember.detail
			, tblmember.profile			
            FROM tblcontent,tblmember,tbltag
			WHERE tblcontent.tag_id=tbltag.tag_id AND tblcontent.user_id = tblmember.member_id 
			AND contentTop < ".$_GET['contentTop']." 
			AND tblcontent.contentName LIKE '%".$_GET[t]."%'
			ORDER BY contentTop DESC LIMIT 8
			");
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					$result[] = $rlt;
				}
				echo json_encode($result);
			}
		}
		

	}
	$api = new feed_api();
	$api->processApi();
?>


