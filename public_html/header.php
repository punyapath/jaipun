<!DOCTYPE html>
<link rel='shortcut icon' href='css/3ByI2t.ico' type='image/x-icon'>
<? session_start(); 


   
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


?>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
     
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/icon.css">
      



</head>
<body style="background: #FAFAFA; -webkit-overflow-scrolling: touch;">

        <!---//////////////////////CROP FORM___START///////////////////////////-->
        <div class="crop-form hide">
                <div class="crop-form-card">
                
                <canvas class="js-editorcanvas" width="800" height="533"></canvas>

                
                <div class="crop-form-button">
                    
                

            <button class="js-export img-export crop-form-export">
            <div class="icon-crop"></div>
            </button>
              <button class="reset crop-form-reset" >
              <div class="icon-exit"></div>
            </button>
                    

                </div>
                    
                    <canvas class="js-previewcanvas hide"></canvas>
                
                </div>
                </div>




          <!---//////////////////////CROP FORM___END///////////////////////////-->



          <div id="area" class="hide"></div>



<div style="display: block;margin: 8px;">


<header class="header">
    <nav>
        <div class="navleft">
            <ul>
                <li class="like">
                     <div class="icon-good"></div>
                </li>
                
                <li></li>
            </ul>
        </div>
    <div class="navcenter">
        <a href="index.php"><img src="https://sv1.picz.in.th/images/2018/11/29/3HKSqV.png" style="width: 150px; "></a>
    </div>


    <div class="navright">
       <ul><li></li>
        <li >
            <? if($_SESSION[user_id] == ""){ ?>
          <a href="index.php?register">
            <div class="icon-user"></div>
          </a>   
          <? }else{ ?>
          <a href="index.php?profile=<?=$_SESSION[user_id]?>">
          <div class="icon-user" style="opacity: 1;"></div>
          </a>         
            <? } ?>
        </li>
      </ul>
    </div>
    </nav>
</header>



<script type="text/javascript">



    $(document).scroll(function() {
    navbarScroll();

    });

    function navbarScroll() {
    var y = window.scrollY;
        if (y > 10) {
            if(window.location.href.indexOf("story") > -1){$('.header').hide(); 
            }else{$('.header').addClass('small');}
        } else if (y < 10) {
            if(window.location.href.indexOf("story") > -1){$('.header').show(); 
            }else{$('.header').removeClass('small');}
            
        }
    }   


</script>
    
<!-- START CONTAINER  -->

