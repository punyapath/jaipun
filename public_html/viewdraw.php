
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--  เพิ่มตาราง usedraw เข้ามาใหม่ ใน tbluser  -->
<? require('db_config.php'); ?>



<html><head><style>

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.container img {
  opacity: 0.6;
}


/* On mouse-over, add a grey background color */
.container:hover img {
  opacity: 1;
}


</style></head><body>

    <div style="
    padding: 20px;
    max-width: 720px;
    float: left;
    text-align: center;
    border: 1px solid #e9eaea;
    border-radius: 20px;
    " id='drawcontent'>





<?
require('db_config.php');


   

   

   
if (!function_exists('generate_date_today')) {
	
	
	
	/* =Time&Date Config
	-------------------------------------------------------------- */
	$SuffixTime = array(
		"th"=>array(
			"time"=>array(
				"Seconds"			=>		" วินาทีที่แล้ว",
				"Minutes"				=>		" นาทีที่แล้ว",
				"Hours"					=>		" ชั่วโมงที่แล้ว"
			),
			"day"=>array(
				"Yesterday"		=>		"เมื่อวาน เวลา ",
				"Monday"				=>		"วันจันทร์ เวลา ",
				"Tuesday"			=>		"วันอังคาร เวลา ",
				"Wednesday"	=>		"วันพุธ เวลา ",
				"Thursday"			=>		"วันพฤหัสบดี เวลา ",
				"Friday"				=>		"วันศุกร์ เวลา ",
				"Saturday"			=>		" วันวันเสาร์ เวลา ",
				"Sunday"				=>		"วันอาทิตย์ เวลา ",
			)
		),
		"en"=>array(
			"time"=>array(
				"Seconds"				=>		" seconds ago",
				"Minutes"				=>		" minutes ago",
				"Hours"					=>		" hours ago"
			),
			"day"=>array(
				"Yesterday"		=>		"Yesterday at ",
				"Monday"				=>		"Monday at ",
				"Tuesday"			=>		"Tuesday at ",
				"Wednesday"	=>		"Wednesday at ",
				"Thursday"			=>		"Thursday at ",
				"Friday"				=>		"Friday at ",
				"Saturday"			=>		"Saturday at ",
				"Sunday"				=>		"Sunday at ",
			)
		)
	);
	
	$DateThai = array(
		// Day
		"l" => array(	// Full day
			"Monday"				=>		"วันจันทร์",
			"Tuesday"			=>		"วันอังคาร",
			"Wednesday"	=>		"วันพุธ",
			"Thursday"			=>		"วันพฤหัสบดี",
			"Friday"				=>		"วันศุกร์",
			"Saturday"			=>		"วันวันเสาร์",
			"Sunday"				=>		"วันอาทิตย์",
		),
		"D" => array(	// Abbreviated day
			"Monday"				=>		"จันทร์",
			"Tuesday"			=>		"อังคาร",
			"Wednesday"	=>		"พุธ",
			"Thursday"			=>		"พฤหัส",
			"Friday"				=>		"ศุกร์",
			"Saturday"			=>		"วันเสาร์",
			"Sunday"				=>		"อาทิตย์",
		),
		
		// Month
		"F" => array(	// Full month
			"January"				=>		"มกราคม",
			"February"			=>		"กุมภาพันธ์",
			"March"					=>		"มีนาคม",
			"April"					=>		"เมษายน",
			"May"					=>		"พฤษภาคม",
			"June"					=>		"มิถุนายน",
			"July"						=>		"กรกฎาคม",
			"August"				=>		"สิงหาคม",
			"September"		=>		"กันยายน",
			"October"				=>		"ตุลาคม",
			"November"		=>		"พฤศจิกายน",
			"December"		=>		"ธันวาคม"
		),
		"M" => array(	// Abbreviated month
			"January"				=>		"ม.ค.",
			"February"			=>		"ก.พ.",
			"March"					=>		"มี.ค.",
			"April"					=>		"เม.ย.",
			"May"					=>		"พ.ค.",
			"June"					=>		"มิ.ย.",
			"July"						=>		"ก.ค.",
			"August"				=>		"ส.ค.",
			"September"		=>		"ก.ย.",
			"October"				=>		"ต.ค.",
			"November"		=>		"พ.ย.",
			"December"		=>		"ธ.ค."
		)
	);
	/* =Time&Date Config
	-------------------------------------------------------------- */
	
	
	/* =Function
	-------------------------------------------------------------- */
	function generate_date_today($Format, $Timestamp, $Language = "en", $TimeText = true )
	{
		date_default_timezone_set("Asia/Bangkok");
		global $SuffixTime, $DateThai;
		//return date("i:H d-m-Y", $Timestamp) ." | ". date("i:H d-m-Y", time());
		if( date("Ymd", $Timestamp) >= date("Ymd", (time()-345600)) && $TimeText)				// Less than 3 days.
		{
			$TimeStampAgo = (time()-$Timestamp);
			
			if(($TimeStampAgo < 86400))			// Less than 1 day.
			{
				
				$TimeDay = "time";				// Use array time
				
				if($TimeStampAgo < 60)				// Less than 1 minute.
				{
					$Return = (time() - $Timestamp);
					$Values = "Seconds";
				}
				else if($TimeStampAgo < 3600)			// Less than 1 hour.
				{
					$Return = floor( (time() - $Timestamp)/60 );
					$Values = "Minutes";
				}
				else			// Less than 1 day.
				{
					$Return = floor( (time() - $Timestamp)/3600 );
					$Values = "Hours";
				}
				
			}
			else if($TimeStampAgo < 172800)			// Less than 2 day.
			{
				$Return = date("H:i", $Timestamp);
				$TimeDay = "day";
				$Values = "Yesterday";
			}
			else		// More than 2 hours..
			{
				$Return = date("H:i", $Timestamp);
				$TimeDay = "day";
				$Values = date("l", $Timestamp);
			}
			
			if($TimeDay == "time")
				$Return .= $SuffixTime[$Language][$TimeDay][$Values];
			else if($TimeDay == "day")
				$Return = $SuffixTime[$Language][$TimeDay][$Values] . $Return;
			
			return $Return;
		}
		else
		{
			if($Language == "en")
			{
				return date($Format, $Timestamp);
			}
			else if($Language == "th")
			{
				$Format = str_replace("l", "|1|", $Format);
				$Format = str_replace("D", "|2|", $Format);
				$Format = str_replace("F", "|3|", $Format);
				$Format = str_replace("M", "|4|", $Format);
				$Format = str_replace("y", "|x|", $Format);
				$Format = str_replace("Y", "|X|", $Format);
	
				$DateCache = date($Format, $Timestamp);
				
				$AR1 = array ("", "l", "D", "F", "M");
				$AR2 = array ("", "l", "l", "F", "F");
				
				for($i=1; $i<=4; $i++)
				{
					if(strstr($DateCache, "|". $i ."|"))
					{
						//$Return .= $i;
						
						$split = explode("|". $i ."|", $DateCache); 
						for($j=0; $j<count($split)-1; $j++)
						{
							$StrCache .= $split[$j];
							$StrCache .= $DateThai[$AR1[$i]][date($AR2[$i], $Timestamp)];
						}
						$StrCache .= $split[count($split)-1];
						$DateCache = $StrCache;
						$StrCache = "";
						empty($split);
					}
				}
				
				if(strstr($DateCache, "|x|"))
					{
						
						$split = explode("|x|", $DateCache); 
						
						for($i=0; $i<count($split)-1; $i++)
						{
							$StrCache .= $split[$i];
							$StrCache .= substr((date("Y", $Timestamp)+543), -2);
						}
						$StrCache .= $split[count($split)-1];
						$DateCache = $StrCache;
						$StrCache = "";
						empty($split);
					}
	
				if(strstr($DateCache, "|X|"))
					{
						
						$split = explode("|X|", $DateCache); 
						
						for($i=0; $i<count($split)-1; $i++)
						{
							$StrCache .= $split[$i];
							$StrCache .= (date("Y", $Timestamp)+543);
						}
						$StrCache .= $split[count($split)-1];
						$DateCache = $StrCache;
						$StrCache = "";
						empty($split);
					}
	
					$Return = $DateCache;
					
				return $Return;
			}
		}
	}
	

	
	}










$result = $conn->query("SELECT 
tbldrawname.drawname_id
,tbldrawname.drawname
,tbldrawname.drawTag
,tbldrawname.drawuseCount
,tbldrawname.drawnameDate
,tbluser.name
 FROM tbldrawname,tbluser WHERE drawname_id=$_GET[drawname_id]");
$tbldrawname = $result->fetch_assoc();


?>




<div style="
    float: left;
">
    <div style="
    float: left;
    width: 100%;
">


<!--  DRAMNAME DETAIL START -->
        <div style="
        float: left;
        width: 100%;
">
        <img src="drawtag/<?=$tbldrawname[drawTag]?>" style="width: 250px;">
        </div>
    
    
    <div style="
    margin: 10px 0px;
    float: left;
    width:100%;
    "><div  style="
    font-size: xx-large;
"><? echo $tbldrawname[drawname] ;?></div><div><? echo $tbldrawname[name] ;?></div><div>จำนวนการใช้ต่อเนื้อหา :<? echo $tbldrawname[drawuseCount] ;?></div><div>วันที่สร้าง : <? echo generate_date_today("d M Y H:i", $tbldrawname['drawnameDate'], "en", true) ; ?></div>
<button id="usedraw" data-drawname-id='<? echo $tbldrawname[drawname_id] ;?>' style="background: #00b84f;border: none;color: #fff;padding: 10px 50px;margin: 10px;">USE</button></div>
    </div>


<!--  DRAMNAME DETAIL END -->


<!--  DRAM DETAIL START -->
<div style="float: left;width:100%;">



<?php

$path="draw/".$_GET[drawname_id]."/";  


$sql = "SELECT draw FROM tbldraw
WHERE drawname_id=$_GET[drawname_id]
ORDER BY draw_id DESC"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row

  while($tbldraw = $result->fetch_assoc()) {

         echo "<img src='$path".$tbldraw[draw]."'style='float: left;width: 100px;margin: 20px;'/>"; 
  }
 
} else {
  echo "0 results";
}
$conn->close();


?>

<!--  DRAM DETAIL END -->

</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

$(document).ready(function () {
    
  $("#usedraw").on("click",function(){
    var drawname_id = $("#usedraw").attr('data-drawname-id');
    $.ajax({
        type: "GET",
        url: "drawinsert.php",
        data:{drawname_id:drawname_id},
        success: function(data){
          //href='index.php?write'
           window.location.href='write.php';
        }
      });
  });


});


   


</script>


</div>
