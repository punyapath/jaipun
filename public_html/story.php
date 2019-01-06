<?

include('header.php');
require('db_config.php');




if($_GET[id] > 0){
    
        $content_id=$_GET[id];
        $conn->query("UPDATE tblcontent SET contentTop = contentTop + 1 WHERE content_id = '$content_id'");
        
        if($_SESSION[user_id]!=0){
            date_default_timezone_set("Asia/Bangkok");
            $date= time();

            $checkhistory =  $conn->query("SELECT * FROM `tblhistory` WHERE content_id = '$content_id' and user_id = '$_SESSION[user_id]'");
            if($checkhistory->num_rows > 0){
                $conn->query("DELETE FROM `tblhistory` WHERE content_id = '$content_id' and user_id = '$_SESSION[user_id]'");
                $conn->query( "INSERT INTO `tblhistory` (`history_id`, `user_id`, `content_id`, `historyDate`) VALUES ('0', '$_SESSION[user_id]', '$content_id', '$date')");
            }else{
                $conn->query( "INSERT INTO `tblhistory` (`history_id`, `user_id`, `content_id`, `historyDate`) VALUES ('0', '$_SESSION[user_id]', '$content_id', '$date')");                
            }
        }

        $sql = "SELECT 
        tblcontent.content_id
        , tblcontent.contentName
        , tblcontent.content
        , tblcontent.user_id
        , tblcontent.tag_id    
        , tblcontent.contentLike                   
        , tblcontent.type
        , tbltag.tagname
        , tbluser.name
        , tbluser.detail
        FROM tblcontent,tbluser,tbltag 
        WHERE tblcontent.content_id=$content_id AND tblcontent.user_id=tbluser.user_id
        AND tblcontent.tag_id=tbltag.tag_id"; 
        
        $result = $conn->query($sql);
        $tblcontent = $result->fetch_assoc();
        $conn->query("UPDATE tbltag SET tagTop = tagTop + 1 WHERE tag_id = '$tblcontent[tag_id]'");
        $str=htmlspecialchars_decode($tblcontent['content'], ENT_QUOTES);

        $filename = $_SERVER['DOCUMENT_ROOT'] . "/"."profile/".$tblcontent[user_id].'.jpeg';
        if (file_exists($filename)) {
        $profile = $tblcontent[user_id].'.jpeg';
        } else {
        $profile = 'user.jpeg';
        }


        $fileimage = $_SERVER['DOCUMENT_ROOT'] . "/"."images/".$tblcontent[content_id].'.jpeg';
        if (file_exists($fileimage)) {
        $image = '<img src="/images/'.$tblcontent[content_id].'.jpeg" style="width: 100%;">';
        } else {
        $image = '  ';
        }



        if (getenv(HTTP_X_FORWARDED_FOR))
        $ip=getenv(HTTP_X_FORWARDED_FOR);
        else
        $ip=getenv(REMOTE_ADDR);



        $checklike =  $conn->query("SELECT * FROM `tbllike` WHERE content_id = $_GET[id] and user_ip = '$ip'");
        if($checklike->num_rows > 0){
            $onclicklike = "";
        }else{
            $onclicklike = "onclick='check()'";
        }


        
    ?>
<style>


.content-article img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top:30px;
    margin-bottom:30px;
    width: 120px;  
}


.content-article * {
    font-family: 'cs_prajad', sans-serif !important;
    word-wrap: break-word;
    margin: 5px;
    color:#000 !important;
    background-color:#fff !important;
    font-size: 18px !important;
    line-height: 45px !important;
  }



  .comments{
    width: 100%;
    float: left;
    border-bottom: 1px solid #eee;
    float: left;
    width: 100%;
    padding: 15px 0px;
}
.comments-img{
    float: left;
    height: 40px;
    width: 40px;
    border-radius: 100px;
    object-fit: cover;
    display: inline-block;
    margin: 0px 15px;
    padding: 0px;
}

.comments-name{
    float: left;
    width: 50%;
    font-weight: 600;
    margin-bottom: 5px;
}

#frm-comment{
    float: left;
    width: 100%;
    margin: 30px 10px;
}

#Share {
    display:none;
	position: absolute;
    top: 100%;
    left: 20px;
    width: 100%;
   border: 1px solid #e6e6e6;
  background:#fff;
  width:60px;
  height:35px;
  margin:0px 0px;
  display:none;
  padding:5px;
  box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
}

#Share:before {
    position: absolute;
    top: -7px;
    right: 9px;
    display: inline-block;
    border-right: 7px solid transparent;
    border-bottom: 7px solid #ccc;
    border-left: 7px solid transparent;
    border-bottom-color: rgba(0,0,0,0.2);
    content: '';
}
#Share:after {
    position: absolute;
    top: -6px;
    right: 10px;
    display: inline-block;
    border-right: 6px solid transparent;
    border-bottom: 6px solid #fff;
    border-left: 6px solid transparent;
    content: '';
}


.Hide
{
  display:none;
}


.toggle{
  margin-top:0px;
}


#edit {
    display:none;
	position: absolute;
    top: 80%;
    right: 0px;
    width: 100%;
   border: 1px solid #e6e6e6;
   font-size:14px;
  background:#fff;
  width:60px;
  height:40px;
  display:none;
  padding:5px;
  box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
}

#edit:before {
    position: absolute;
    top: -7px;
    right: 9px;
    display: inline-block;
    border-right: 7px solid transparent;
    border-bottom: 7px solid #ccc;
    border-left: 7px solid transparent;
    border-bottom-color: rgba(0,0,0,0.2);
    content: '';
}
#edit:after {
    position: absolute;
    top: -6px;
    right: 10px;
    display: inline-block;
    border-right: 6px solid transparent;
    border-bottom: 6px solid #fff;
    border-left: 6px solid transparent;
    content: '';
}


.Hide
{
  display:none;
}


.btnedit{
  margin:10px;
}
  
  
</style>


<title><? echo $tblcontent['contentName'] ?> | Jaipun</title>

<div id="closecontent">
      <img src="https://img.icons8.com/cotton/50/000000/circled-chevron-left.png">
</div>
<img src="https://www.img.in.th/images/9b69a09f95242df5f49f21bfa0348f3b.png" style='display:none;    position: absolute;  position: fixed;
  top: 50%;
  left: 50%;' class='check'>
<div id="opencontent">
  <div class="content" style="background: #fff;">


<?

$checkbuttonedit =  $conn->query("SELECT * FROM `tblcontent` WHERE content_id = '$content_id' and user_id = '$_SESSION[user_id]'");
if($checkbuttonedit->num_rows > 0){
?>
  <!--- BUTTON EDIT START -->
  <? ?>
<div style='position: relative;float:right'>
  <div id="edit">
  <div style="text-align: center;">
<div style="border-bottom: 1px solid #eee;" onclick="window.location.href='/delete.php?content_id=<?=$_GET[id]?>'">delete</div>

<div onclick="window.location.href='/editform.php?content_id=<?=$_GET[id]?>'">edit</div>
  
</div>
  </div>
<div class="btnedit"><img src="https://img.icons8.com/ios-glyphs/50/000000/chevron-down.png" style='width:20px'></div>
</div>
<? ?>
<!--- BUTTON EDIT END -->

<? } ?>


<!--- IMAGE AND TAG TYPE START -->
  <? echo $image ?>
    <div class="content-into">
    <div class="content-header"><div class="content-type">
    <img src="/type/<?=$tblcontent['type']?>.png" class="content-type-icon"><div class="content-type-text"><?echo $tblcontent['type'];?></div>
    </div><div class="content-tag">
    <div class="content-tag-text" onclick="window.location='/tag?id=<?=$tblcontent['tag_id']?>'"><?echo $tblcontent['tagname'];?></div>
    
    </div>
    </div>
<!--- IMAGE AND TAG TYPE END -->



<div class="content-title"><?echo $tblcontent['contentName'];?></div>
    <article class="content-article" <? echo $onclicklike ?> style="word-wrap:break-word;"><?echo $str;?></article>



<!-- check START-->
<div style="position: relative;float:left;margin: 2px;"><img src="https://sv1.picz.in.th/images/2019/01/04/9lqDJk.png" style="
    float: left;width:20px"><div style="float: left;margin: 0px 10px;font-weight: 600;color:#ff5f5f" class='textlike'><?echo $tblcontent['contentLike'];?></div></div>
<!-- check END-->



<!-- BUTTON SHARE START-->
<div style='position: relative;float:right'>
<div id="Share">
 <div style="float: right;display: -webkit-box;">
<div id="fb-share-button">
<img src="https://img.icons8.com/color/48/000000/facebook.png" style="width: 30px;">
</div>



<div id="line-share-button">
<img src="https://img.icons8.com/color/48/000000/line-me.png" style="width: 30px;">
</div>
</div>
</div>
<div class="toggle" style="float: right;"><img src="https://img.icons8.com/ios/50/000000/right2.png" style='width:20px'></div>
<div style="float: right;margin: 0px 10px;font-weight: 600;">Share</div>
</div>


<!-- BUTTON SHARE END-->


<div class="content-like">
<div class="content-date"><?echo $tblcontent['contentDate'];?></div></div>




<div class="content-profile"><div class="content-profile-into"><img src="/profile/<?=$profile?>" class="content-profile-img">
</div>

<div class="content-profile-text">
<div><?echo $tblcontent['name'];?></div>
<div><?echo $tblcontent['detail'];?></div>
</div>











    </div>
</div>

<!--- COMMENT FORM START -->
<? if($_SESSION[user_id]!=0){?>

<div style='max-width: 620px;
    margin-left: auto;
    margin-right: auto;'> 
    <form id="frm-comment">
    <div style=" width: 100%;">
    <div style="
        float: left;
        margin: 2px;
    "></div><div style="
        position: relative;
        display: inline-block;
        width: 90%;
        border: 1px solid #e8e8e8;
        border-radius: 50px;
        background: #fafafa;
    ">
        <input type="hidden" name="id" id="id" value="<? echo $_GET[id] ?>"> 
        <input type="text" name="comment" contenteditable="true" placeholder="Write a comment..." style="
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 10px;
        text-align: left;
        height: 30px;
        width: 90%;
        font-size: 18px;
        background:none;
        border:none;
        outline:0;
    ">
        
        <button id="submitButton" style="border: none;background: rgba(255, 255, 255, 0.0);border-radius: 50%;width: 40px;height: 40px;position: absolute;"><img src="https://img.icons8.com/ios/50/000000/checked.png" style="
        width: 30px;
    ">
    </button>
    
    </div></div>
    </form>
</div>
<? } ?>
<!--- COMMENT FORM END -->



<div id="output"></div>
    
</div>
</div>

<?

 }
?>
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>


function check(){
 if($('article').attr('id') === undefined ){
    $(".check").fadeIn(600);
    $(".check").fadeOut(3000,"swing");
    $.ajax({
				url: 'like.php',
				type: 'post',
				data: {
					'liked': 1,
					'content_id': <? echo $_GET[id];?>
				},
				success: function(response){
					$('.textlike').text(response);
				}
            });
  $('article').attr('id','checked');
 }
}


$('.toggle').click(function() {
    $('#Share').toggle();
});

$('.btnedit').click(function() {
    $('#edit').toggle();
});
            $('.like').on('click',function(){window.location.href="index.php";});
            $("#submitButton").click(function () {
            	   $("#comment-message").css('display', 'none');
                var str = $("#frm-comment").serialize();

                $.ajax({
                    url: "comment-add.php",
                    data: str,
                    type: 'post',
                    success: function (response)
                    {
                        var result = eval('(' + response + ')');
                        if (response)
                        {
                            $("#comment").val("");
                            load_comment()
                        } else
                        {
                            alert("Failed to add comments !");
                            return false;
                        }
                    }
                });
            });
            
            $(document).ready(function () {
                load_comment()
            });

            function load_comment()
            {
             $.ajax({
              url:"comment-list.php?content_id=" + <? echo $content_id; ?>,
              method:"POST",
              success:function(data)
              {
               $('#output').html(data);
              }
             })
            }

var fbButton = document.getElementById('fb-share-button');
var url = window.location.href;

fbButton.addEventListener('click', function() {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + url,
        'facebook-share-dialog',
        'width=800,height=600'
    );
    return false;
});



var lineButton = document.getElementById('line-share-button');
lineButton.addEventListener('click', function() {
    window.open('https://social-plugins.line.me/lineit/share?url=' + url,
        'facebook-share-dialog',
        'width=800,height=600'
    );
    return false;
});
              
if(window.location.href.indexOf("story") > -1) {
            $('#container').css('padding-top', '0px'); 
            $('#opencontent').css('margin-top', '60px');      
}

                

$('#closecontent').click(function () {
        window.history.back();
 });



</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130480379-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-130480379-1');
</script>
