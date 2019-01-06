<html>

<head>

<style>
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
    margin: 10px;
}

</style>
<? $content_id = 1 ?>
<body>





<html><head><link rel="shortcut icon" href="css/3ByI2t.ico" type="image/x-icon">


<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
     
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/icon.css">
      

    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

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
              <button class="reset crop-form-reset">
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
        <li>
                      <a href="index.php?register">
            <div class="icon-user"></div>
          </a>   
                  </li>
      </ul>
    </div>
    </nav>
</header>
    
<!-- START CONTAINER  -->



<div id="container" style="padding-top: 0px;">
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
    margin: 10px;
}
  
</style>


<title> | Jaipun</title>


    <div id="closecontent" style="display: none;">
      <img src="https://img.icons8.com/cotton/50/000000/circled-chevron-left.png">
    </div>
<div id="opencontent" style="margin-top: 20px;">
  <div class="content" style="background: #fff;">
        <div class="content-into">
    <div class="content-header"><div class="content-type">
<img src="type/.png" class="content-type-icon"><div class="content-type-text"></div>
</div><div class="content-tag">

    
    <div class="content-tag-text"></div>
<a href="#"></a>
   
</div>
</div>



<div class="content-title"></div>
<article class="content-article" style="word-wrap:break-word;"></article>

<div class="content-like">





<div class="content-date"></div></div>




<div class="content-profile"><div class="content-profile-into"><img src="profile/user.jpeg" class="content-profile-img">
</div>

<div class="content-profile-text">
<div></div>
<div></div>
</div>



<div style="
float: right;
display: -webkit-box;
">
<div style="
font-weight: 600;
margin: 5px;
">Share</div>
<div id="fb-share-button">
<img src="https://img.icons8.com/color/48/000000/facebook.png" style="width: 30px;">
</div>



<div id="line-share-button">
<img src="https://img.icons8.com/color/48/000000/line-me.png" style="width: 30px;">
</div>
</div>


</div>
</div>

    









<div style="
    margin-left: auto;
    margin-right: auto;
    max-width: 420px;
">
  
<form id="frm-comment" >
<div style=" width: 100%;">
<div style="
    float: left;
    margin: 2px;
"><img src="https://img.icons8.com/ios/50/000000/user-male-circle.png" style="
    width: 25px;
    "></div><div style="
    position: relative;
    display: inline-block;
    width: 90%;
    border: 1px solid #e9eaea;
    border-radius: 50px;
    background-color: #f5f5f5;
">
    <input type="hidden" name="content_id" id="content_id" value='<?=$content_id?>' /> 
    <input type="text" name="comment" contenteditable="true" placeholder="Comment this story..." style="
    padding-top: 5px;
    padding-bottom: 5px;
    padding-left: 10px;
    text-align: left;
    width: 90%;
    background:none;
    border:none;
    outline:0;
">
    
    <button id="submitButton" style="border: none;background: rgba(255, 255, 255, 0.0);border-radius: 50%;width: 30px;height: 30px;position: absolute;right: 0;bottom: 0;"><img src="https://img.icons8.com/ios/50/000000/checked.png" style="
    width: 15px;
">
</button>

</div></div>
</form>


<div id="output"></div>

</div>
   


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>

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


        </script>
</body>

</html>