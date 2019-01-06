<?
session_start();
echo '<title> write your story | Jaipun</title>';
if($_SESSION["user_id"] == "")
{
  header("location:index.php?register");
  exit();
}
require('db_config.php');


/***************DRAW > JS START****************/
$usedraw = $conn->query("SELECT 
tbldrawname.drawname
,tbldrawuse.drawname_id
 FROM tbldrawuse,tbldrawname WHERE tbldrawuse.drawname_id=tbldrawname.drawname_id AND tbldrawuse.user_id = $_SESSION[user_id]");
if ($usedraw->num_rows > 0){
  $tbldrawuse = $usedraw->fetch_assoc();
  $drawname_id = $tbldrawuse[drawname_id];
  $drawname = $tbldrawuse[drawname];
  
}else{header("location:radiodraw.php");}

if(isset($drawname_id)){
  
  $sql="SELECT CONCAT('draw/', '$drawname_id', '/', draw) AS name,72 AS width,72 AS height FROM tbldraw
  WHERE drawname_id=$drawname_id
  ORDER BY draw_id DESC";
  
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
      $i=1;
      $resultArray = array();
      while($tbldraw = $result->fetch_assoc()) {
          array_push($resultArray,$tbldraw);
      }
      
  } else {
      echo "";
  }
  ?>
  
  <script>
  var emojis = JSON.parse('<?php echo json_encode($resultArray); ?>');
  </script>
  
  <? }

/***************DRAW > JS END****************/
  
  /***************TAG START****************/


  
  ?>
  
  <style>
  body{
    height: 100%;
  }
  #country-list{
  display: -webkit-box;
  /* display: flex; */
  margin: 10px 0px;
  overflow-x: auto;
  }

  #search-box {
    width: 60%;
    background: #f5f5f5;
    padding: 10px 10px;
    border: 1px solid #dbdbdb;
}


#posttag{
  max-width: 765px;
}

@media screen and (max-width: 450px) {#posttag{max-width: 360px;}}
  </style>

<link rel="stylesheet" href="css/icon.css">

<div class="form_wrapper" >


 <!---//////////////////////TAG FORM___START///////////////////////////-->


  
  
 <!---//////////////////////CONTENT FORM___START///////////////////////////-->

<fieldset class="msf_hide">


<!-- START TAG -->
<div id='posttag' style="">
  <input type="text" id="search-box" placeholder="เพิ่มและค้นหาหัวข้อของคุณ" />
    <div onclick="window.location.href='radiodraw.php'" style="width: 40%;
    display: inline;
    padding: 5px;
    color: #81C784;"><? echo $drawname  ?></div>

    <div id="suggesstion-box"></div>

    <div style="width:100%;">


 

    <div  id="top-tag">

    
    <div id="left">
         <div class="icon-left"></div>
    </div>
    <div id="right">
        <div class="icon-right"></div>
    </div>

<div id="tag" style="display: -webkit-box;/* display: flex; */margin: 10px 0px;overflow-x: auto;">
<input type="hidden" name="tag_id" id="inputA">
        <?php
            require('db_config.php');
            $sql = "SELECT * FROM `tbltag` ORDER BY tagStories DESC LIMIT 8"; 
            $result = $conn->query($sql);
            include('datatagpost.php');
        ?>
       
</div>


</div>
    

<!-- END TAG -->




  <!---SHOW PHOTO -->
    <div class="photo_container"></div>
      <div  class="post-card-padding">
        <div>
<div class="SelectedTag"></div>
          <div style="max-width: 665px;">
            <div class="post-card-title">

          <!---SYSTEM UPLOAD PHOTO___START-->

            <div class="upload-form" style="float:right;">
            <div>
                <label>
                  <div class="icon">
                      <button class="post-card-camera"><div class="icon-camera"></div>
                    </button>
                  </div>

                  <span class="new hide"><button class="post-card-camera">
                  <div class="icon-camera"></div>
                  </button></span>
                  <input type="file" class="js-fileinput img-upload" accept="image/jpeg,image/png,image/gif">
            </label>
          </div>
          </div>

          
        <!---SYSTEM UPLOAD PHOTO___END-->

<!--//////////////////////////////////////////////////////////////////// -->
<input type="text" name="title" id="title" class="post-card-titleform data" placeholder="Say something about this story...">

  </div></div></div>
<div class="errorpost" style='color:red;'></div>


  
  
  <!---  SYSTEM WRITE CONTENT___START  -->
<input type="hidden" name="document" id="inputC">
    <div><div style="max-width: 665px;"><div class="post-card-content data">
     <div  id="document"  contenteditable="true" placeholder="Say something about this story..." class="post-card-contentform"></div>
       
            <!---  BUTTON ALL___START  -->
                <div class="post-card-button">
                    <div class="toolbar">
                       <div class="emoji-btn open">
                          <div class="emoji-popup">
                            <div class="emoji-wrapper">

                              </div>
                            </div>

                        <button class="post-card-button-into">
                            <div class="icon-draw"></div>        
                            </div>
                          </div>
                        </button>
                        <button data-action="bold" title="Bold" class="post-card-button-into" style="margin: 15px 2px;display: block;"><div class="icon-bold"></div></button>
                        <button data-action="italic" title="Italic" class="post-card-button-into" style="margin: 2px;display: block;"><div class="icon-italics"></div></button>
                        <button class="post-card-button-ok"><div class="icon-check" onclick="msf_btn_next()"></div></button>
                      </div>
                    </div>
                  </div>
                </div>
              <!---  BUTTON ALL___END  -->
  
  
  <input type="hidden" name="back" value="Back"  onclick="msf_btn_back()">
	<input type="hidden" name="next" value="Next"  onclick="msf_btn_next()">
  <div class="msf_bullet_o"></div>
  <div class="msf_line"></div>
    
  </div>
</fieldset>

<!---//////////////////////CONTENT FORM___END///////////////////////////-->




<!---//////////////////////TYPE FORM___START///////////////////////////-->


<fieldset class="msf_hide" style=" max-width: 420px;padding: 50px;">
    <div class="typeform-head">Select type of your content</div>
    <div class="typeform-select">
            <div class="typeform-select-into">
              <input type="radio" name="r1" id="r1" value="knowledge" checked>
              <label for="r1">
                <img src="https://img.icons8.com/ios/100/000000/light.png" style="width: 50px;">
                <h4 >Knowledge</h4>
              </label>
            </div>
            <div  class="typeform-select-into">
              <input type="radio" name="r1" id="r2" value="dhamma"><label for="r2">
                <img src="https://img.icons8.com/ios/100/000000/sphere.png" style=" width: 50px;">
                <h4 >dhamma</h4>
              </label>
            </div>
            <div class="typeform-select-into">
              <input type="radio" name="r1" id="r3" value="experience"><label for="r3">
                <img src="https://img.icons8.com/wired/100/000000/briefcase.png" style="width: 50px;">
                <h4 >experience</h4>
              </label>
            </div>
            <div class="typeform-select-into">
              <input type="radio" name="r1" id="r4" value="emotion">
              <label for="r4">
                <img src="https://img.icons8.com/wired/100/000000/heart-health.png" style="width: 50px;">
                <h4 >emotion</h4>
              </label>
            </div>
            <div  class="typeform-select-into">
              <input type="radio" name="r1" id="r5" value="tipitaka"><label for="r5">
                <img src="https://img.icons8.com/wired/100/000000/book.png" style=" width: 50px;">
                <h4 >tipitaka</h4>
              </label>
            </div>
            <div class="typeform-select-into">
              <input type="radio" name="r1" id="r6" value="story"><label for="r6">
                <img src="https://img.icons8.com/ios/100/000000/leaf.png" style="width: 50px;">
                <h4 >story</h4>
              </label>
    
    </div>
  
  <input type="button" name="back" value="Back"  onclick="msf_btn_back()">
  <input type="button" name="next" value="Next"  onclick="msf_btn_next()">
	<input type="submit" name="submit" value="Submit Now!" onclick="submit_test()">
  <div class="msf_bullet_o"></div>
  <div class="msf_line"></div>
</fieldset>
</div>






<!-- ///////////////////////////////// START EDIT ///////////////////////// --> 

<div class="phone" style="
position: relative;
">   

<div class="post-card-pbutton" style="
position: relative;    min-height:100%;
margin-bottom: -40px;
padding-bottom: 40px;

">
<!-- /////////////////////////////////  END  EDIT///////////////////////// --> 
  <div class="ptoolbar">
      <div class="pemoji-btn open">

  

<button class="post-card-pcafe"><div class="icon-draw"></div>
</button>
    
               <div class="pemoji-popup"><div class="pemoji-wrapper">
                 
                 </div></div>
</div></div>

    <button data-action="bold" title="Bold"  class="post-card-pbold"><div class="icon-bold"></div>
</button><button  data-action="italic" title="Italic"  class="post-card-pitalic" >
<div class="icon-italics"></div>
</button><button class="post-card-pok" onclick="msf_btn_next()" ><div class="icon-check"></div>
</button></div>

</div>




  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>

  

    <script  src="js/index.js"></script>
    <script>$('.like').on('click',function(){window.location.href="index.php";});</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130480379-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-130480379-1');
</script>
