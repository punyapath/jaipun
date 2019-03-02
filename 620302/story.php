<?
require('db_config.php');

$storyget=file_get_contents("http://jaipun.com/data/stories/".$_GET[id]);
$story=json_decode($storyget);


$filename = $_SERVER['DOCUMENT_ROOT'] . "/"."profile/".$story->user_id.'.jpeg';
if (file_exists($filename)) {
$profile = $story->user_id.'.jpeg';
} else {
$profile = 'user.jpeg';
}


if (getenv(HTTP_X_FORWARDED_FOR))
$ip=getenv(HTTP_X_FORWARDED_FOR);
else
$ip=getenv(REMOTE_ADDR);

$checklike =  $conn->query("SELECT * FROM `tbllike` WHERE content_id = $_GET[id] and user_ip = '$ip'");
if($checklike->num_rows > 0){
    $classlike = "class='iconliked'";
    $onclicklike = "";
}else{
    $classlike = "class='iconlike'";
    $onclicklike = "onclick='check()'";
}



?>


<html>
    <link rel='shortcut icon' href='/css/3ByI2t.ico' type='image/x-icon'>        
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/feed.css">
    
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head>
<style>

        .content{
            background: #fff;
            float: left;
            max-width: 740px;
            border: 1px solid #e6e6e6;
            padding: 20px;
            padding-right: 100px;
            padding-left: 100px;
        }
        .content-type {
            float: right;
            width: 50%;
            margin-top: -10px;
            margin-bottom: 50px;
            opacity: 0.8;
        }
        .content-type-text {
            float: left;
            padding: 12px 10px;
            font-size: 16px;
            font-weight: 600;
            color: #008a0c;
        }


        .content-tag {
            float: left;
            width: 50%;
        }
        .content-tag-text {
            float: right;
            padding: 10px 10px;
            font-weight: 600;
            font-size: 18px;
        }

        .content-title {
            margin: 60px 0px 0px 0px;
            width: 100%;
            font-size: 28px;
            text-align: center;
            float: left;
            font-weight: 600;
        }
        
        .content-article img{
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            margin-bottom: 20px;
            width: 200px !important;   
        }
        
        
        .content-article * {
            font-family: 'cs_prajad', sans-serif !important;
            word-wrap: break-word;
            margin: 5px;
            color:#000 !important;
            background-color:#fff !important;
            font-size: 20px !important;
            line-height: 45px !important;
            /*min-width: 100%;*/
          }

          .content-article{
            font-family: 'cs_prajad', sans-serif !important;
            word-wrap: break-word;
            margin: 5px;
            color:#000 !important;
            background-color:#fff !important;
            font-size: 20px !important;
            line-height: 45px !important;
            min-width: 620px;
          }
        
        
        

    .content-profile{
    padding: 20px 40px;
    float: left;
    width: 80%;
    }

    .content-profile-into{
    float: left;
    width: 25%;
    }

    .content-profile-img{
    border-radius: 100px;
    height: 80px;
    object-fit: cover;
    width: 80px;
    display: inline-block;
    margin: 0px 0px;
    padding: 0px;
    }

    .content-profile-text{
    float: left;
    width: 55%;
    }

    #name{
        font-weight: 600;
        font-size:24px
    }


    @media screen and (max-width: 520px) {

    .content-into {
    margin: 0px 20px;
    }
    .content-profile-into {
    float: none;
    text-align: center;
    width: 100%;
    }
    .content-profile-text {
        float: none;
        text-align: center;
        width: 100%;
        margin: 15px 0px;
    }

    #detail{
        font-size: 16px;
        font-weight: 400;
    }
    #closecontent{
        top: 0;
        right: 0;
        left: 0;
        
    }


    }


    #closecontent {
        position: fixed;
        top: 50px;
        right: 80px;
        z-index: 1;
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
                font-size: 15px;
                text-align: center;
                padding: 10px;
                max-width: 240px;
                display: none;
                position: absolute;
                bottom: 140%;
                right: 0;
                border: 1px solid #e6e6e6;
                background: #fff;
                margin: 0px 0px;
                display: none;
                box-shadow: 0 1px 2px rgba(0,0,0,.25), 0 0 1px rgba(0,0,0,.35);
            }
            
            #Share:before {
                position: absolute;
                bottom: -12px;
                right: 21px;
                display: inline-block;
                border-right: 12px solid transparent;
                border-top: 12px solid #ccc;
                border-left: 12px solid transparent;
                border-top-color: rgba(0,0,0,0.2);
                content: '';
            }
            #Share:after {
                position: absolute;
                bottom: -10px;
                right: 21px;
                display: inline-block;
                border-right: 12px solid transparent;
                border-top: 12px solid #fff;
                border-left: 12px solid transparent;
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

            @media only screen and (max-width: 900px) {
            .content-article{
                min-width: 0px;
            }

            .content{
                    padding: 20px;
                    padding-right: 50px;
                    padding-left: 50px;
                }


            }
            


            @media only screen and (max-width: 620px) {

                .content{
                    padding: 20px;
                    padding-right: 20px;
                    padding-left: 20px;
                }

                .content-article * {
                    font-size: 18px !important;
                line-height: 40px !important;
            }

            .content-article{
                font-size: 18px !important;
                line-height: 40px !important;
            }
            .content-title {
                font-size: 28px;
                font-weight: 600;
            }


            }



            .iconlike{
                float: left;
                padding: 8px;
                width: 30px;
                border: 1px solid rgba(0,0,0,.15);
                border-radius: 50px;
                opacity: 1;
            }
            .iconlike:hover { 
                border: 2px solid #ff7f7f;
            }

            
            .iconliked{
                float: left;
                padding: 8px;
                width: 30px;
                border: 2px solid #ff7f7f;
                border-radius: 50px;
                opacity: 1;
            }
            
            .iconlike:active { 
                border: 2px solid #ff7f7f;
                box-shadow: 0px 0px 15px 1px rgba(0,0,0,.15)!important;
            }
            
</style>

<title><? echo $story->contentName ?> | jaipun</title>

</head>

<img src="https://visualpharm.com/assets/311/Easy-595b40b85ba036ed117dc0a2.svg" style='display:none;    position: absolute;  position: fixed;
top: 30%;
left: 40%;width:80px' class='check'>
<body style="background:#fafafa;margin: 0px;">
<header class="header">
<nav>
    <div class="navleft">
    <ul>
        <li>
        <a id="latest" style="">
            <img src="icon/feed.svg"style="width: 20px;padding-top:5px" >    
        </a>   
        </li>
        
        <li >
        <a href="#"></a>   
        </li>
    </ul>
    </div>

    <div class="navcenter">
            <a  href="/">
            <img src="icon/namelogo.svg" style="width: 150px;">
        </a>
    </div>

    <div class="navright">
    <ul>
            <li ></li>
            
            <li>
            <a href="/all.html" style="">
            <!--<a id="btnsearch" href="#" style="">-->
                <img src="icon/tagall.svg" style="width: 20px;padding-top:5px">    
            </a>   
            </li>
        </ul>
    </div>    
</nav>
</header>

    
<div id="closecontent">
    <img src="https://img.icons8.com/cotton/50/000000/circled-chevron-left.png">
</div>
    <div style="max-width: 820px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 65px;">
    <div class="content" style="">
            <div class="content-title"><?php echo $story->contentName ?></div>
            
            
            <div class="content-type" onclick="window.location='/feedtype?t=<?=$story->type?>'">
                    <div class="content-type-text"><?php echo $story->type ?></div>
                    </div>



                    <div style="
    float: left;
    width: 50%;
    margin-top: -10px;
    margin-bottom: 50px;
    opacity: 0.6;
"><div class="content-tag-text" onclick="window.location='/tag?id=<?=$story->tag_id?>'"><? echo $story->tagname?></div></div>
        


            <article class="content-article" >
                <div>
            <? echo htmlspecialchars_decode($story->content, ENT_QUOTES); ?>
            
            </article>


            <div style="
            float: left;
            width: 100%;
            border-bottom: 1px solid rgba(0,0,0,.05)!important;
            padding-bottom: 25px!important;
            margin-top:60px;
                    ">
                    
                    <div style="
                    float: left;
                "><img  <? echo $classlike." ".$onclicklike ?> src="https://visualpharm.com/assets/311/Easy-595b40b85ba036ed117dc0a2.svg" style=""><span style="
    padding: 15px 5px 15px 15px;
    float: left;
    font-size: 14px;
    /* font-weight: 600; */
    " class="textlike"><? echo $story->contentLike?>  Liked</span></div>


                    <div style='position: relative;float:right'>
                            <div id="Share">
                                    <ul style="
                                    padding: 0px;
                                    margin: 0px;
                                    margin-bottom: 0;
                                    padding: 0;
                                    list-style: none;
                                    list-style-image: none;
                                    font-size: 15px;
                                    text-align: center;
                                    letter-spacing: 0;
                                    
                                    font-style: normal;
                                    text-rendering: optimizeLegibility;
                                    -webkit-font-smoothing: antialiased;
                                    line-height: 1.4;
                                ">
                                                                    <li id="fb-share-button" style="
                                    list-style: none;
                                    display: block;
                                    padding: 5px 0;
                                    border: 0;
                                    text-align: left;
                                    width: 100%;
                                    line-height: 1.4;
                                    white-space: nowrap;
                                    padding: 5px 15px;
                                    -webkit-box-sizing: border-box;
                                    box-sizing: border-box;
                                "><img id="fb-share-button" src="https://img.icons8.com/material/30/000000/facebook.png" style=" margin-bottom: -10px;opacity: 0.6; "> Share on facebook</li>
                                                                    <li id="line-share-button"  style="
                                    list-style: none;
                                    display: block;
                                    padding: 0px 0;
                                    border: 0;
                                    text-align: left;
                                    width: 100%;
                                    line-height: 1.4;
                                    white-space: nowrap;
                                    padding: 5px 15px;
                                    -webkit-box-sizing: border-box;
                                    box-sizing: border-box;
                                "><img id="line-share-button" src="https://img.icons8.com/ios-glyphs/30/000000/line-me.png" style="margin-bottom: -10px;opacity: 0.6; "> Share on line</li>
                                                                
                                                                </ul>
                                
     
                            </div>
                            <div class="toggle" style="margin: 5px 20px;float: right;"><img src="http://pic.90sjimg.com/design/00/23/31/57/58eef971e8910.png" style="width:25px;"></div>
      
                            
                            </div>
                            
                
                </div>

                <div class="content-profile"><div class="content-profile-into"><img src="/profile/<?=$profile?>" class="content-profile-img" >
                </div>
                
                <div class="content-profile-text">
                <div id='name'><? echo $story->name ?></div>
                <div id='detail'><? echo $story->detail ?></div>
                </div>
                
                
                
                
                
                
                
                
                
                
                
                    </div>
    </div>
<!-- เริ่มต้น feed ที่นี่ -->
<div class='feed-data'></div>

    </div>
        



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

var url_string = window.location.href; //window.location.href
var url = new URL(url_string);
var content_id = url.searchParams.get("id");


$('.toggle').click(function() {
    $('#Share').toggle();
});

$('.btnedit').click(function() {
    $('#edit').toggle();
});


var fbButton = document.getElementById('fb-share-button');
var urlshare = window.location.href;

fbButton.addEventListener('click', function() {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + urlshare,
        'facebook-share-dialog',
        'width=800,height=600'
    );
    return false;
});



var lineButton = document.getElementById('line-share-button');
lineButton.addEventListener('click', function() {
    window.open('https://social-plugins.line.me/lineit/share?url=' + urlshare,
        'facebook-share-dialog',
        'width=800,height=600'
    );
    return false;
});
              


var timer;
$(document).scroll(function() {
navbarScroll();
/*ระบบจำกัดครั้งการส่งเวลาเลื่อนลง ใช้ time ในการรีเลย์ ไม่ให้ส่งซ้ำมากเกินไป*/
if(timer) {
    window.clearTimeout(timer);
}
timer = window.setTimeout(function() {
    if($(window).height() - $(window).scrollTop() <= 850) {
        if(window.location.href.indexOf("new") > -1) {
            var last_new = $(".feed:last").attr("id");
            var url = "http://jaipun.com/feed/load_new?content_id="+last_new;
        load_new(url);
        }else{
            var last_id = $(".feed:last").attr("id");
            var url = "http://jaipun.com/feed/load_top?contentLike="+last_id;
            //loadMoreData(last_id);
            load_top(url);
        }  
    }
console.log( "Firing!" );
}, 100);
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


/*ฟังก์ชั่นในการนับวันถอยหลัง*/
function timeSince(timeStamp) {
timeStamp = new Date(timeStamp * 1000);
var now = new Date(),
secondsPast = (now.getTime() - timeStamp.getTime() ) / 1000;
if(secondsPast < 60){
    return parseInt(secondsPast) + ' seconds ago';
}
if(secondsPast < 3600){
    return parseInt(secondsPast/60) + ' minutes ago';
}
if(secondsPast <= 86400){
    return parseInt(secondsPast/3600) + ' hours ago';
}
if(secondsPast <= 259200){
    hour = timeStamp.getHours();
    minute = timeStamp.getMinutes();
    return parseInt(secondsPast/86400) + ' day ago at  ' + hour +":"+ minute;
}

if(secondsPast > 259200){
    day = timeStamp.getDate();
    month = timeStamp.toDateString().match(/ [a-zA-Z]*/)[0].replace(" ","");
    year = timeStamp.getFullYear() == now.getFullYear() ? "" :  " "+timeStamp.getFullYear();
    hour = timeStamp.getHours();
    minute = timeStamp.getMinutes();
    return day + " " + month + year + " " + hour +":"+ minute;
}
}

var MD5 = function(d){result = M(V(Y(X(d),8*d.length)));return result.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}

//check profile ว่ามีภาพอยู่ใน folder หรือไม่
function profileExists(url){
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    if (http.status == "404") {
        return profile = '/profile/user.jpeg';
    } else {
        return profile = url;
    }
}

//check img ว่ามีภาพอยู่ใน folder หรือไม่
function imgExists(content_id){
    var url = "/images/"+content_id+".jpeg";
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    if (http.status == "404") {
        return image = '';
    } else {
        return image = '<img src="images/'+ content_id +'.jpeg" style="width: 100%;">';
    }
} 

$(document).ready(function() {
    var touchtime = 0;
    $("article").on("click", function() {
        if (touchtime == 0) {
            // set first click
            touchtime = new Date().getTime();
        } else {
            // compare first click to this click and see if they occurred within double click threshold
            if (((new Date().getTime()) - touchtime) < 800) {
                // double click occurred
                check();
                touchtime = 0;
            } else {
                // not a double click so set as a new first click
                touchtime = new Date().getTime();
            }
        }
    });

    $("#btnsearch").click(function(){
        $("#frmsearch").toggle();
        $("input").focus();
    });

    $('article img').click(function () {
                var id =  $(this).attr('src').match(/\d+/)[0];
                window.location.href='viewdraw.php?drawname_id='+id;
                
            });          
var tag_id = <? echo $story->tag_id ?>;
var content_id = <? echo $story->content_id ?>;


            url="http://jaipun.com/feed/feed_story?id="+tag_id+"&content_id="+content_id;
            feed_top(url);


    
});


function check(){
 if($('.iconlike').attr('id') === undefined ){
    $(".check").fadeIn(600);
    $(".check").fadeOut(3000,"swing");
    $('.iconlike').attr('id','checked');
    $.ajax({
				url: 'like.php',
				type: 'post',
				data: {
					'liked': 1,
					'content_id': content_id
				},
				success: function(response){
					$('.textlike').text(response+" Liked");
				}
            });
  
 }
}



/****************************************************************/

function feed_top(url){
    $.ajax({
        url: url,
        beforeSend: function()
            {
                $('.ajax-load').show();
            }
    }).then(function(data) {
        $('.ajax-load').hide();
    for(var i = 0; i < data.length; i++){
        var n = data[i].content.search("&lt;img");
        var e = data[i].content.search("png&quot;&gt;"); var en = e + 13;
        var all = data[i].content.slice(n, en);
        var draw = all.replace("&lt;","<").replace(/&quot;/gm,"'").replace('&gt;','>');
        url = '/profile/'+data[i].user_id +".jpeg";
        profileExists(url);
        //imgExists(data[i].content_id);
        if(data[i].contentLike != 0){var Like = data[i].contentLike+" liked";}else{var Like = ""}
        $('.feed-data').append(   "<div class='feed' id="+ data[i].contentLike+">" + 
            "<div class='feed-title'><div class='feed-title-text'>" + data[i].contentName + "</div>" +
            "<div class='feed-title-under'>" + 
            "<div class='feed-tag' onclick="+ '"' + "window.location='/tag?id=" + data[i].tag_id + "'" + '">'+  data[i].tagname + "</div>" +
            "<div class='feed-type' onclick="+ '"' + "window.location='/feedtype?t=" + data[i].type + "'" + '">' + data[i].type + "</div>" +  "</div>" +
            "<div class='feed-content' onclick="+ '"' + "window.location='/story.php?id=" + data[i].content_id + "'" + '">' + 
             draw + "<div class='feed-content-into' >"+ data[i].content.replace(/&lt;(?:.|\n)*?&gt;/gm, '').replace(/&amp;nbsp;/gi,' ').substring(0, 120) +"...</div>" +
            "<div class='feed-date'>" + timeSince(data[i].contentDate) + "<span class='feed-like'>" + 
             Like + "</span></div></div>" +  "<div class='feed-writer'>" + "<img src='"+profile+"' class='feed-writer-profile'>" +
            "<div class='feed-writer-name'  onclick="+ '"' + "window.location='/name/" + data[i].user_id + "'" + '">' + 
            data[i].name + "<span class='feed-writer-detail'>" + data[i].detail + "</span></div>" +"</div>"
        );
    }
});
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


    </body>
    </html>
