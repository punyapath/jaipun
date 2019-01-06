
<style>
#country-list::-webkit-scrollbar{display:none;}

</style>
<?php
class DBController {
	private $host = "localhost";
	private $user = "jaipunco";
	private $password = "P10oct2540M##";
	private $database = "jaipunco_db";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM tbltag WHERE tagname like '" . $_POST["keyword"] . "%' ORDER BY tagname LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $tbltag) {
?>
<div class="tag-text" id="<?php echo $tbltag['tag_id']; ?>" onclick="selectTag('<?php echo $tbltag[tag_id]; ?>','<?php echo $tbltag[tagname]; ?>');"><div><?php echo $tbltag['tagname']; ?></div></div>     
<?php } ?>
</ul>
<?php } } ?>