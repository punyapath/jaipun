 <style>
     .feed-into-content{
 word-wrap:break-word;
                    height: 2em;
                    white-space: wrap;	
                    text-overflow: '...?';
                    -o-text-overflow: '...?';
                    -ms-text-overflow: '...';
                    overflow: hidden;
                }
 </style>
 
 
 <?


   

   

   
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

	function cutStr($str, $maxChars='', $holder=''){
		
			if (strlen($str) > $maxChars ){
					$str = iconv_substr($str, 0, $maxChars,"UTF-8") . $holder;
			} 
			return $str;
		} 


                while($tblcontent = $result->fetch_assoc()){


                $content1=htmlspecialchars_decode($tblcontent[content], ENT_NOQUOTES);
                $content=strip_tags($content1);
                                    
                $filename = $_SERVER['DOCUMENT_ROOT'] . "/"."profile/".$tblcontent[user_id].'.jpeg';
                if (file_exists($filename)) {
                $profile = $tblcontent[user_id].'.jpeg';
                } else {
                $profile = 'user.jpeg';
                }
            ?>


            

            <div class="feed" id="<?php echo $tblcontent['content_id']; ?>" >
                <div class="feed-title"><div class="feed-type-into">
				<img class="feed-type-icon" src="type/<?=$tblcontent['type']?>.png" >
					<div class="feed-type-text" style="font-size: 12px;"><?php echo $tblcontent['type']; ?></div>
					

					<div style="
					float: right;
					margin-right: -25px;
					margin-top: -5px;
					color: #ff5f5f;
					font-weight: bold;
					position: relative;
					width:40px
					"><img src="https://sv1.picz.in.th/images/2019/01/04/9lqDJk.png" style=" width: 100%;height: auto;">
					<span style="
					float: right;font-size:14px;
					  position: absolute;
					  top: 55%;
					  left: 40%;
					  transform: translate(-50%, -50%);
					  font-size: 16px;
					  ">
					  <?php if($tblcontent['contentLike']!= 0){echo $tblcontent['contentLike'];} ?></span>
					</div>


                </div>
					<div class="feed-into-title" ><?php echo $tblcontent['contentName']; ?></div>
                </div>

                <div class="feed-content" onclick="window.location='story.php?id=<?=$tblcontent['content_id']?>'">
                    <div class="feed-into-content" ><? echo cutStr($content,'150','...'); ?></div>
                    <div class="feed-date"><?php echo generate_date_today("d M Y H:i", $tblcontent['contentDate'], "en", true) ; ?></div>
                </div>

                <div class="feed-tag" style="width: 50%;">
                    <div class="feed-tag-into">
                        <div class="feed-tag-text" onclick="feed_new_tag(<?php echo $tblcontent['tag_id']; ?>)"><?php echo $tblcontent['tagname']; ?></div>
                    </div>
                </div>

                <div class="feed-writer" style="width: 50%;">
                    <img src="profile/<?=$profile?>" class="feed-writer-profile">
                    <div class="feed-writer-name"  onclick="window.location='index.php?profile=<?=$tblcontent['user_id']?>'" ><?php echo $tblcontent['name']; ?></div>
                </div>

            </div>
                    
            <?php
                }



                
            ?>
