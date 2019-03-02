<link rel="stylesheet" href="css/font.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?
session_start();
echo '<title> write your story | Jaipun</title>';
if($_SESSION["member_id"] == "")
{
  echo"<script>window.location.href='/register.php';</script>";
  //header("location:register.php");
  exit();
}?>

<style>
* {
    word-wrap: break-word !important;
}

h3{
  padding:30px;
}
  html{ height:100%; }
  body{ min-height:100%; padding:0; margin:0; position:relative; }

  .msf_hide{
    display: none;
  }
  .msf_show{
    display: block;
  }


  button{
    background:none;
    border:none;
    font-weight:600;
    padding:5px 10px;
    font-size:16px;
    font-family: 'cs_prajad', sans-serif;
  }

  fieldset{
    min-height: 100%; 
    background: #fff;
    border: none;
    box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
    padding:0px;
  }

  .btn_next{
    color:#ff4545;
  }

  [contentEditable=true]:empty:not(:focus):before{
    content:attr(data-text);
}


#document img{
  
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    margin-bottom: 20px;
    width: 160px !important;   
}


#document * {
    font-family: 'cs_prajad', sans-serif !important;
    word-wrap: break-word !important;
    color:#000 !important;
    background-color:#fff !important;
    font-size: 20px !important;
    line-height: 35px !important;
    /*min-width: 100%;*/
  }

  #document{
    font-family: 'cs_prajad', sans-serif !important;
    word-wrap: break-word !important;
    color:#000 !important;
    background-color:#fff !important;
    font-size: 20px !important;
    line-height: 35px !important;
  }

    
  /************************CSS EMOJI START*******************************/
  
  .toolbar {
    flex: 1 1 70%;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    display: flex;
  }
  
  ::-webkit-scrollbar{ width: 8px}
  ::-webkit-scrollbar-track { background:rgba(255, 255, 255, 0.1); border-radius:0px 2px 2px 0px;}
  ::-webkit-scrollbar-thumb { background:#9e9e9e; }
  
  
  .toolbar .btn,.toolbar .emoji-btn {
    text-align: center;
    border-radius: 2px;
    position:relative;
    cursor:pointer;
  }
  .toolbar .btn:hover{
    background:#333;
    cursor:pointer;
  }
 
  
  .emoji-popup{
    position: fixed;
    top: 20px;
    /* right: 0px; */
    height: 200px;
    width: 100%;
    background: #9e9e9e1c;
    border-radius: 10px;
    text-align: left;
    overflow-y: auto;
    opacity: 0;
    pointer-events: none;
    transition: all 0.25s;
    box-sizing: border-box;
    z-index: 2;
    border-bottom: 1px solid #e2e2e2;
  }
  .emoji-wrapper{
     overflow:hidden;
     padding:10px;
     box-sizing:border-box;
  }
  .emoji-popup .emoji-img{
     margin:auto;
     width:60px;
     height:60px;
     text-align:center;
     border-radius:5px;
    margin:5px;
  }
  
  .emoji-popup button{
      border-style: none;
      background-color: #fff0;
      outline: 0;
  }
  
  .emoji-popup .emoji-img:hover{
     background:rgba(0, 0, 0, 0.1);
  }
  
  
  
  .emoji-btn:after{
     content: '';
     position:absolute;
     border:10px solid transparent;
     border-left:10px solid #ECEFF1;
     top:10px;
     left:-15px;
     transition:all 0.25s;
     opacity:0;
  }
  .emoji-btn.open:after{
     opacity:1;
  }
  .emoji-btn.open .emoji-popup{
     opacity:1;
     pointer-events:initial;
  }


  /* 
  .select-emoji{
    width: 100%;
    background: #fafafa4a;
    border: 1px solid #e9eaea;
  }
  
  .emoji-name{
    display: inline-block;
    padding: 5px 10px;
    border: 1px solid #fafafa; 
  }
  */
  
  /************************CSS EMOJI END*******************************/


  
  /************************TYPE FORM START*******************************/
  
  .typeform-head{
    margin: 20px 0px;
    text-align: center;
    font-size: larger;
    font-weight: 600;
  }
  
  .typeform-select{
    width: 100%;
    float: left;
    text-align: left;
  }
  
  .typeform-select-into{
    display: block;
    float: left; 
    margin:0px; 
    width: 100%;
  }
  
  
  
  
  input[type="radio"]{
    display: none;
  }
  
  input[type="radio"] + label{
    border: 1px solid #fff;
    display: block;
    width: 100%;
    max-width: 100%;
    padding: 5px 40px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    cursor: pointer;
    position: relative;
    opacity: 0.4;
  }
  
  
  input[type="radio"]:checked + label:before{
    display: block;
  }
  
  input[type="radio"] + label h4{
    color: #000;
    margin: 10px 20px;
    display: inline;
  }
  
  input[type="radio"]:checked + label{
    opacity: 1;
    background-color: #ff9191;
    border-radius: 5px;
  }
  
  input[type="radio"]:checked + label h4{
    color: #000;
  }
  
  
  /************************TYPE FORM END*******************************/

  /************************DRAW FORM START*******************************/

.tag div{
  font-size: 20px;
  padding: 10px 20px;
  border-bottom: 1px solid #eee;
  box-shadow: 0 0.5px 4px 0 rgba(0,0,0,.05)!important;
}

.SelectedTag{
  padding: 30px;
  font-size: x-large;
  background: #ff8080;
  color: #fff;
}



#drawForm img{
  width:120px;
  opacity: 0.6;
}
#drawForm img:hover{
  opacity: 1;
}


#drawForm div{
  float: left;
  margin: 10px 20px;
}    
#drawForm span{
  display: block;    
  margin: 10px;
} 
.draw{
  width: 80px;
  margin: 10px 20px;
}

#selectdraw{
  position:fixed!important;
  width: 100%;
  height: 100%;
  z-index: 100;
  background: #75757585;
  display:none;
  top: 0;    
  overflow-y: scroll;
  right: 0;
}
.selectdraw-into{
  margin-top: 70px;
  margin-left: auto;
  margin-right: auto;
  max-width: 720px;
  z-index: 101;
}

.drawtitle{
  padding: 15px;
  background: #fafafa;
  font-size: 20px;
  font-weight: bold;
}

#drawcontent{
  padding: 20px;
  max-width: 720px;
  float: left;
  text-align: center;
  border: 1px solid #e9eaea;
  background: #fff;
}
  
.drawtag div{
    padding: 7px 10px;
    opacity: 0.6;
    /*border-right: 1px solid #eee;*/
    display: inline-flex;
  }

  
  .drawtag div img{
    width: 25px;height:25px
  }


  .drawtag div:active{
    opacity:1;
    background:#eee;
  }

  .drawtag div:hover{
    opacity:1;
    background:#eee;
  }
  #drawcontent img:hover{
    transition: .3s;
    transform: scale(1.5);
  }
  /************************DRAW FORM END*******************************/


  /******************HEADER START*********************/
  header{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    background: #ffffff;
    height: 40px;
    display: block;
    width: 100%;
    border-bottom: 1px solid #f7f7f7;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 99;
    transition: .3s;
  }

  header nav{
    max-width: 700px;
    justify-content: space-between;
    margin: 0 auto;
    padding: 0 10px;
    position: relative;
    display: flex;
  }

  #showdraw{
    padding: 7px 10px;
    opacity: 0.6;
    /* border-right: 1px solid #eee; */
    display: inline-flex;
  }


  /******************HEADER END*********************/
  

</style>
  
<!-- SELECT DRAW START -->
<div id='selectdraw'>
  <div class='selectdraw-into'>
    <div class="drawtitle drawcontent"></div>
    <div id="drawcontent" class='drawcontent'>
      <form id="drawForm"></form>
    </div>
  </div>
</div>

<!-- SELECT DRAW END -->

<body style="margin: 0px;     background: #fafafa;">
<!-- HEADER START -->
<header>
<nav>
    <div class="toolbar">
      <div class="drawtag"></div>
      <div id='showdraw'><img src="https://img.icons8.com/ios/50/000000/plus-math-filled.png" style="
          width: 25px;
          height: 25px;
      ">
      </div>
    </div>



                          <div style='flex: 1 1 30%;    text-align: right;
    padding: 0;
    margin: 0;
    padding-top: 0px;
    box-sizing: border-box;'>

<button data-action="bold" title="Bold" class="post-bold" >B</button>
                        <button class="btn_next"  onclick="msf_btn_next()">Next</button></div>

</nav>
</header>

<div class="emoji-btn">
                          <div class="emoji-popup">
                            <div class="emoji-wrapper">

                              </div>
                            </div>

 </div>

<!-- HEADER END -->

<!-- POST FORM START -->
 <div style="
      max-width: 600px;
      height: 500px;
      position: relative;
      margin-top: 35px;
      margin-left: auto;
      margin-right: auto;
  ">
    <!-- WRITE START -->
    <fieldset class="msf_show"  style="max-width: 600px;">

      <input name="title" type="text" id="txtUsername" placeholder="ชื่อเรื่อง" style="
      border: none;
      outline: none;
      padding: 15px 20px;
      font-size: 22px;
      font-weight: 600;
      width: 100%;
      border-bottom: 1px solid #eee;
      font-family: 'cs_prajad', sans-serif;
      ">


      <div class="errorpost" style='color:red;'></div>
      <input type="hidden" name="document" id="inputC">

      <div style="
          width: 99%;
          position: absolute;
      ">
      <div id="document" contenteditable="true" data-text="เล่าเรื่องของคุณที่นี่" class="post-card-contentform" style="
          min-height: 100%;
          border: none;
          outline: none;
          padding: 20px 20px;
      "></div>
      </div>

    </fieldset>
    <!-- WRITE END -->

    <!-- TYPE SELECT START -->
    <fieldset class="msf_hide">
    <div class="typeform-head">Select type of your content</div>
            <div class="typeform-select">
                    <div class="typeform-select-into">
                      <input type="radio" name="r1" id="r1" value="knowledge" checked>
                      <label for="r1">
                        <img src="https://img.icons8.com/ios/100/000000/light.png" style="width: 20px;">
                        <h4 >Knowledge</h4>
                      </label>
                    </div>
                    <div  class="typeform-select-into">
                      <input type="radio" name="r1" id="r2" value="dhamma"><label for="r2">
                        <img src="https://img.icons8.com/ios/100/000000/sphere.png" style=" width: 20px;">
                        <h4 >dhamma</h4>
                      </label>
                    </div>
                    <div class="typeform-select-into">
                      <input type="radio" name="r1" id="r3" value="experience"><label for="r3">
                        <img src="https://img.icons8.com/wired/100/000000/briefcase.png" style="width: 20px;">
                        <h4 >experience</h4>
                      </label>
                    </div>
                    <div class="typeform-select-into">
                      <input type="radio" name="r1" id="r4" value="emotion">
                      <label for="r4">
                        <img src="https://img.icons8.com/wired/100/000000/heart-health.png" style="width: 20px;">
                        <h4 >emotion</h4>
                      </label>
                    </div>
                    <div  class="typeform-select-into">
                      <input type="radio" name="r1" id="r5" value="tipitaka"><label for="r5">
                        <img src="https://img.icons8.com/wired/100/000000/book.png" style=" width: 20px;">
                        <h4 >tipitaka</h4>
                      </label>
                    </div>
                    <div class="typeform-select-into">
                      <input type="radio" name="r1" id="r6" value="story"><label for="r6">
                        <img src="https://img.icons8.com/ios/100/000000/leaf.png" style="width: 20px;">
                        <h4 >story</h4>
                      </label>
            
            </div>
    </fieldset>
    <!-- TYPE SELECT END -->
    

    <!-- TAG SELECT START -->

    <fieldset class="msf_hide">
      <div class='SelectedTag'>กรุณาเลือกหัวข้อเรื่องของคุณ</div>
      <input type="text" id="search-box" placeholder="ค้นหาหัวข้อของคุณ" style="
          width: 100%;
          background: #f5f5f5;
          padding: 10px 10px;
          border: 1px solid #dbdbdb;
          font-family: 'cs_prajad', sans-serif;
          outline: 0;
          font-size: 20px;
      ">
      <input type="hidden" name="tag_id" id="inputA">

      <div class='tag'></div>
    </fieldset>
    <!-- TAG SELECT END -->


</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

$(document).ready(function () {
       //Show Jaipun Store for selecting draw tag
        selectdraw();
        $("#showdraw").on("click",function(){
          $("#selectdraw").show();
        });

        //ถ้าคลิกที่อื่น จะปิดตัว Jaipun Store ทั้งที
        $("#selectdraw").mouseup(function(e) 
        {
            var container = $(".drawcontent");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
              $("#selectdraw").hide();
            }
        });

    drawtag();
    $('button').on('click', function(e) {
        var $this = $(this),
        action = $this.data("action");
        
        var aShowDefaultUI = false, aValueArgument = null;
        if($this.data('show-default-ui'))
            aShowDefaultUI = $this.data('show-default-ui');
           document.execCommand(action, aShowDefaultUI, aValueArgument);
    });

    $('[contenteditable]').on('paste',function(e) {
        
        e.preventDefault();
        
        var text = (e.originalEvent || e).clipboardData.getData('text/html') || prompt('Paste something..');
        var $result = $('<div></div>').append($(text));
        
        $(this).append($result.html());
        
        // replace all styles except bold and italic
        $.each($(this).find("*"), function(idx, val) {
            var $item = $(val);
            if ($item.length > 0){
               var saveStyle = {
                    'font-weight': $item.css('font-weight'),
                    'font-style': $item.css('font-style')
                };
                $item.removeAttr('style').removeClass()
                   .css(saveStyle); 
            }
        });
        
        // remove unnecesary tags (if paste from word)
        $(this).children('style').remove();
        $(this).children('meta').remove()
        $(this).children('link').remove();
        
    });



    $("#search-box").keyup(function(e){
      $.ajax({
      url: "http://jaipun.com/feed/tagsearch_top?t="+$(this).val(),
      beforeSend: function(){
        $("#search-box").css("background","#f5f5f5 url(LoaderIcon.gif) no-repeat 350px");
      },
      success: function(data){
        $('.tag').html(""); 
        for(var i = 0; i < data.length; i++){
          $('.tag').append(   
              "<div onclick="+ '"' + "selectTag(" + data[i].tag_id + ",'"+ data[i].tagname +"')" + '">'+ data[i].tagname +"</div>"
          );
        }
        
      }
      });
      /*if(e.keyCode == 13){sendtag();}*/
    });
    
});

 console.log("Reloaded");

// dom variables
var msf_getFsTag = document.getElementsByTagName("fieldset");
// declaring the active fieldset & the total fieldset count
var msf_form_nr = 0;
var fieldset = msf_getFsTag[msf_form_nr];
fieldset.className = "msf_show";

/*** OPEN DRAW START ***/
        var btn = document.querySelector('.btn')
        var input = document.querySelector('.toolbar')
        var emojiholder = document.querySelector('.emoji-holder')
        var emojiwrapper = document.querySelector('.emoji-wrapper')
        var emojibtn = document.querySelector('.emoji-btn')

        // Button/Enter Key

        input.addEventListener('keyup', function(evt){ if(evt.keyCode == 13) sendMessage() })
        emojibtn.addEventListener('click', function(e){
        e.stopPropagation()
        this.classList.toggle('open')
        })
        // Load the Emojies
        for(var i = 0; i < emojis.length; i++){
        if(emojis[i].name == null) continue
        emojiwrapper.innerHTML += `
            <button  data-action="insertImage" data-img="${emojis[i].name}" ><img    class="emoji-img" src="${emojis[i].name}"/></button>
        `
        }


//funtion สำหรับดูรายละเอียดของ draw นั้น
function viewdraw(drawname_id) {
  $('#drawcontent').html("");
  $('#drawcontent').append("<div id='drawer'></div>"); 
       /*** ดึงข้อมูลของผู้ทำ draw ***/
        $.ajax({
          url:"http://jaipun.com/data/drawer/"+ drawname_id,
            }).then(function(data) {
              $('.drawtitle').html("<img src='https://img.icons8.com/ios/50/000000/undo-filled.png' id='backdrawname' style='width: 20px;'>");
                $('#drawer').append(   
                    "<div style='max-width: 400px;margin-left: auto;margin-right: auto;'>"+'<img src="drawtag/'+ data.drawTag +'" style="width: 140px;float: left;">'+
                    "<h1 style='margin: 0px;'>" +  data.drawname + "</h1>" +
                    "<div onclick="+ '"' + "window.location='/name/" + data.user_id + "'" + '">' +  data.name + "</div>" +
                    "<div> จำนวนการใช้ต่อเนื้อหา  :   " +data.drawuseCount + "</div>" +
                    "<div>" +data.drawnameDate + "</div>" +
                    "<button id='usedraw' data-drawname-id='"+ data.drawname_id +"' style='background: #00b84f;border: none;color: #fff;padding: 10px 50px;margin: 10px;'>USE</button></div>" +
                    "</div>"
                );

                  //ปุ่มกดใช้ draw
                $("#usedraw").on("click",function(){
                  var drawname_id = $("#usedraw").attr('data-drawname-id');
                  $.ajax({
                      type: "GET",
                      url: "drawinsert.php",
                      data:{drawname_id:drawname_id},
                      success: function(data){
                        $("#selectdraw").hide();
                        //href='index.php?write'
                        drawtag();
                      }
                    });
                });
                //ปุ่มกดกลับไปหน้าแรกที่แสดง drawTag
                $("#backdrawname").on("click",function(){
                  $('#drawcontent').html("<form id='drawForm'></form>");
                  selectdraw();
                });
         });
      /*** ดึงภาพทั้งหมดตาม drawname_id ***/
      $.ajax({
          url:"http://jaipun.com/data/usedraw/"+ drawname_id,
          beforeSend: function()
              {
                  $('.ajax-load').show();
              }
      }).then(function(emojis) {

          for(var i = 0; i < emojis.length; i++){
                    $('#drawcontent').append(   
                          '<img class="draw" src="/'+ emojis[i].name+'">'
                    );
              }
      });

  

}

//funtion สำหรับเลือก draw ที่จะใช้แสดง drawTag
function selectdraw(){
    $.ajax({
      //url: "http://jaipun.com/data/drawname",
      url: "http://jaipun.com/data/drawname",
      }).then(function(data) {
        $('.drawtitle').html("Jaipun Store");
      for(var i = 0; i < data.length; i++){
          $('#drawForm').append(   
              "<div onclick="+ '"' + "viewdraw(" + data[i].drawname_id + ")" + '">'+'<img src="drawtag/'+ data[i].drawTag +'">'+
              "<span>"+data[i].drawname+"</span>"+"</div>"
          );
        }
    });
}


//funtion ใช้เรียก drawTag ที่จะใช้ในการเรียก draw ต่อไป
function drawtag(){
  $('.drawtag').html("");
  $.ajax({
            //url: "http://jaipun.com/data/drawname",
            url: "http://jaipun.com/data/drawuse/" + <? echo $_SESSION[member_id]?>,
            }).then(function(data) {
            for(var i = 0; i < data.length; i++){
                $('.drawtag').append(   
                    "<div onclick="+ '"' + "usedraw(" + data[i].drawname_id + ")" + '">'+'<img src="drawtag/'+ data[i].drawTag +'">'+"</div>"
                );
              }
         });
}

//function ใช้งานเมื่อกดที่ภาพ ใช้สำหรับกดเลือกภาพลงในเนื้อหา
function usedraw(drawname_id) {
  emojiwrapper.innerHTML="";
  $.ajax({
      url:"http://jaipun.com/data/usedraw/"+ drawname_id,
      beforeSend: function()
          {
              $('.ajax-load').show();
          }
  }).then(function(emojis) {
      emojibtn.classList.toggle('open');
      for(var i = 0; i < emojis.length; i++){
          if(emojis[i].name == null) continue
          emojiwrapper.innerHTML += `
              <button  data-action="insertImage" data-img="${emojis[i].name}" ><img    class="emoji-img" src="${emojis[i].name}"/></button>
          `
          }

          $('button').on('click', function(e) {
              var $this = $(this),
                      action = $this.data("action");
              
              var aShowDefaultUI = false, aValueArgument = null;
              if($this.data('show-default-ui'))
                  aShowDefaultUI = $this.data('show-default-ui');
              

              if($this.data('action') == 'insertImage')
                  aValueArgument = $this.data("img");	
              //emojibtn.classList.remove('open');
              
              document.execCommand(action, aShowDefaultUI, aValueArgument);
          });
          


  });
}


/*** OPEN DRAW END ***/

/*** SYSTEM PAGE FORM START ***/
//function Go to page select type
function msf_btn_next(){
    var msf_val = true;
    var title = $('input[type=text][name=title]').val();
    var doc = document.getElementById("document").innerHTML;

    if (title.length === 0 || doc.length < 300) {
        if(title.length === 0 ){
          //document.getElementById("title").style.backgroundColor = "#eee";
          var errortitle = "*กรุณาใส่ชื่อเรื่อง";
        }else{ var errortitle =  ""}
        if(doc.length < 300 ){
          //document.getElementById("document").style.backgroundColor = "#eee";
          var errordoc = "**กรอกเนื้อให้ครบ 300 ตัวอักษรด้วยครับ";
        }else{ var errordoc =  ""}
        $('.errorpost').html(errortitle + errordoc);
        msf_val = false;
    } 
    
    
    if (msf_val === true) {
      var inputC = $('#inputC'); //document
      inputC.val(doc);
      var selection = msf_getFsTag[msf_form_nr];
      selection.className = "msf_hide";
      msf_form_nr = msf_form_nr + 1;
      var selection = msf_getFsTag[msf_form_nr];
      selection.className = "msf_show";
      $('.btn_next').attr("onclick",'msf_btn_next_tag()');
      $('.toolbar').html("<button onclick='msf_btn_back_post()'>Back</button>");
      $('.post-bold').hide();
      document.querySelector('.emoji-btn').classList.remove('open');
    }

}


//function Go to page select tag
function msf_btn_next_tag(){ 
  tag();
  var type =$('input[type=radio][name=r1]:checked').val();
  var selection = msf_getFsTag[msf_form_nr];
  selection.className = "msf_hide";
  msf_form_nr = msf_form_nr + 1;
  var selection = msf_getFsTag[msf_form_nr];
  selection.className = "msf_show";
  $('.btn_next').attr("onclick",'submit()');
  $('.toolbar').html("<button onclick='msf_btn_back_tag()'>Back</button>");
  $('.btn_next').html('Post');
}

//function Back to page POST FORM
function msf_btn_back_post() {
  msf_getFsTag[msf_form_nr].className = "msf_hide";
  msf_form_nr = msf_form_nr - 1;
  msf_getFsTag[msf_form_nr].className = "msf_showhide";
  $('.toolbar').html("<div class='drawtag'></div>");
  $('.btn_next').attr("onclick",'msf_btn_next()');  
  $('.post-bold').show();
  drawtag();
};

//function Back to page select type
function msf_btn_back_tag() {
  msf_getFsTag[msf_form_nr].className = "msf_hide";
  msf_form_nr = msf_form_nr - 1;
  msf_getFsTag[msf_form_nr].className = "msf_showhide";
  $('.toolbar').html("<button onclick='msf_btn_back_post()'>Back</button>");
  $('.btn_next').attr("onclick",'msf_btn_next_tag()');  
  $('.btn_next').html('Next');
  $('.tag').html(""); 
};

//function select Tag in tag form
function selectTag(tag_id,tagname) {
      var inputA = $('#inputA'); //tag_id
      inputA.val(tag_id);
      inputA.val(tag_id);
      $('.SelectedTag').html(tagname);
}

//function Send data to datadase
function submit(){
  var tag_id = $('input[type=hidden][name=tag_id]').val();
  var title = $('input[type=text][name=title]').val();
  var content = $('input[type=hidden][name=document]').val();
  var type = $('input[type=radio][name=r1]:checked').val();

  if(tag_id != 0){
      $.ajax({
        type : 'POST',
        url : 'user/poststory',
        data : {tag_id:tag_id,title:title,content:content,type:type},
        beforeSend: function() {
          $('.msf_show').html("<h3>Sending........</h3>");
        },
        success : function(response) {
            window.location.href="story.php?id="+ response;
        }
      });
      return false;
    }else{alert('กรุณาเลือกหัวข้อ เพื่อง่ายต่อการเข้าถึงเนื้อหาของคุณ')}
}

//function ดึงข้อมูลรายละเอียดของ tag ทั้งหมด
function tag(){
  $.ajax({
            url: "http://jaipun.com/feed/tag_top",
            //url: "http://jaipun.com/data/drawuse/" + <?// echo $_SESSION[user_id]?>,
            }).then(function(data) {
            for(var i = 0; i < data.length; i++){
                $('.tag').append(   
                    "<div onclick="+ '"' + "selectTag(" + data[i].tag_id + ",'"+ data[i].tagname +"')" + '">'+ data[i].tagname +"</div>"
                );
              }
         });
}

               
</script>