<style>

/***************************FEED START************************************/

.feed{
    word-wrap:break-word;
    float: left;
    margin:10px 0px;
    max-width: 620px;
    width: 100%;
    background: #fff;
    border: 1px solid #e6e6e6;
    box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;

  }



.feed-like{
  word-wrap:break-word;
    float: left;
    margin:10px 0px;
    max-width: 620px;
    width: 100%;
    background: #fff;
    border: 1px solid #e6e6e6;
    box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;

  }

  .feed-title{
    float: left;
    width: 100%;
  }
  
  .feed-into-title{
    display: inline-block;
    margin: 0px 20px 10px 20px;
    font-family: sans-serif;
    font-size: 18px;
    font-weight: 600;
    color: #616161;
  }
  
  .feed-content{
    float: left;
    width: 100%;

  }

  .feed-into-content{
    word-wrap:break-word;
    height: 2em;
    white-space: wrap;	
    text-overflow: '...?';
    -o-text-overflow: '...?';
    -ms-text-overflow: '...';
    overflow: hidden;
    margin: 0 20px;
    min-height: 70px;
    color: #757575;
    font-size: 18px;
    line-height: 32px;
  }
  
  .feed-date{
    float: left;
    margin: 10px 20px 20px;
    font-size: 12px;
  }

  .feed-type{
    float: left;
    width: 30%;
    border-top: 1px solid #e6e6e6;
  }

 .feed-type-into{
    margin-bottom: 15px;
    width: 90%;
    float: left;
    margin-left: 15px;
    margin-top: 15px;
    opacity: 0.8;
 }

 .feed-type-icon{
    float: left;
    width: 20px;
    height: 20px;
    margin-left: 15px;
    margin: 5px 10px 0px 0px;
 }

.feed-type-text{
    float: left;
    margin: 7px 0;
    font-weight: 600;
    font-size: 20px;
}

.feed-tag{
    float: left;
    width: 50%;
    border-top: 1px solid #e6e6e6;
  }



.feed-tag-into{
    opacity: 0.8;
 }

.feed-tag-text{
    float: left;
    margin: 7px 15px;
    font-weight: 600;
    font-size: 20px;
}


.feed-writer{
    float: left;
    width: 50%;
    border-top: 1px solid #e6e6e6;
}

.feed-writer-profile{
    border-radius: 100px;
    float: right;
    height: 35px;
    margin: 5px 20px;
    object-fit: cover;
    width: 35px;
    display: inline-block;
}

.feed-writer-name{
    float: right;
    color: #E53935;
    margin: 10px 0;
    font-size: 18px;
}

.feed-check{
    float: right;
	margin-right: -25px;
	margin-top: -5px;
	color: #167b4d;
	font-weight: bold;
}

.tag{
    width:100%;
}

.tag-text{
    display: block;
    margin: 5px 5px;    
    width: 180px;
    height: 60px;
    position: relative;
    overflow: hidden;
    text-overflow: ellipsis;
    background: #fff;
    box-shadow: 0 1px 3px rgba(32, 33, 36, 0.28);
}

.tag-text div{
    padding: 5px 5px;
    word-wrap:break-word;
}


#left{
  opacity: 0.2;  
  margin-top: 30px;
  float: left;
  text-align: left;
}

#right{
  opacity: 0.2;
  margin-top: 30px;
  float: right;
  text-align: right;
}

@media screen and (max-width: 450px) {
 
        .feed-type{
            width: 30%;
            border-top: 1px solid #e6e6e6;
        }

        .feed-type-into{
            margin-bottom: 0px;
            width: 80%;
            float: left;
            margin-left: 15px;
            margin-top: 15px;
            opacity: 1;
         }
        
         .feed-type-icon{
            float: left;
            width: 20px;
            height: 20px;
            margin-left: 15px;
            margin: 5px 10px 0px 0px;
         }
        .feed-type-text{
            margin: 10px 0;
            font-size: 16px;
        }

        .feed-writer{
            width: 50%;
            border-top: 1px solid #e6e6e6;
        }
          .tag{
          width:350px;
        }
    
}
  
/***************************FEED END************************************/

</style>

<h1>feed Top</h1>
<div>

            <div class="feed-new"></div>
            <h1>LOAD</h1>
            <div class="load-new"></div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
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
            return profile = 'profile/user.jpeg';
        } else {
            return profile = url;
        }
}

//check img ว่ามีภาพอยู่ใน folder หรือไม่
function imgExists(content_id){
        var url = "http://localhost/images/"+content_id+".jpeg";
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

        $.ajax({
                url: "http://localhost/feed/feed_top"
            }).then(function(data) {
            for(var i = 0; i < data.length; i++){
                url = 'http://localhost/profile/'+data[i].content_id +".jpeg";
                profileExists(url);
                imgExists(data[i].content_id);
                if(data[i].contentLike != 0){var Like = data[i].contentLike;}else{var Like = ""}
                $('.feed-new').append( "<div class='feed' id="+ data[i].content_id+">" + image +
                "<div class='feed-title'><div class='feed-type-into'>" +
                "<img class='feed-type-icon' src='type/"+ data[i].type +".png' >" + 
                "<div class='feed-type-text' style='font-size: 12px;'>" + data[i].type + "</div>"+
                "<div class='feed-check'><img src='https://img.icons8.com/doodle/48/000000/checkmark.png' style='width: 30px;'><span style='float: right;font-size: x-large;'>" +
                Like + "</span>" + "</div>" + "</div>" +
                "<div class='feed-into-title' >" + data[i].contentName + "</div></div>" +
                "<div class='feed-content' onclick="+ '"' + "window.location='/story/" + MD5(data[i].content_id) + "'" + '">' + 
                "<div class='feed-into-content' >"+ data[i].content.replace(/&lt;(?:.|\n)*?&gt;/gm, '').replace(/&amp;nbsp;/gi,'').substring(0, 120) +"...</div>" +
                "<div class='feed-date'>" + timeSince(data[i].contentDate) + "</div></div>" + 
                "<div class='feed-tag' style='width: 50%;'><div class='feed-tag-into'>" + 
                "<div class='feed-tag-text' onclick="+ '"' + "window.location='/tag/" + data[i].tag_id + "'" + '">'+  data[i].tagname + "</div>" +
                "</div></div>" + 
                "<div class='feed-writer' style='width: 50%;'>" + 
                "<img src='"+profile+"' class='feed-writer-profile'>" +
                "<div class='feed-writer-name'  onclick="+ '"' + "window.location='/name/" + data[i].name + "'" + '">' + 
                data[i].name + "</div>" +
                "</div></div>"
            );
        }
    });




    $.ajax({
        url: "http://localhost/feed/load_top?contentLike=10"
         }).then(function(data) {
        for(var i = 0; i < data.length; i++){
            url = 'http://localhost/profile/'+data[i].user_id +".jpeg";
            profileExists(url);
            if(data[i].contentLike != 0){var Like = data[i].contentLike;}else{var Like = ""}
            $('.load-new').append(   "<div class='feed' id="+ data[i].content_id+">" +
            "<div class='feed-title'><div class='feed-type-into'>" +
            "<img class='feed-type-icon' src='type/"+ data[i].type +".png' >" + 
            "<div class='feed-type-text' style='font-size: 12px;'>" + data[i].type + "</div>"+
            "<div class='feed-check'><img src='https://img.icons8.com/doodle/48/000000/checkmark.png' style='width: 30px;'><span style='float: right;font-size: x-large;'>" +
             Like + "</span>" + "</div>" + "</div>" +
             "<div class='feed-into-title' >" + data[i].contentName + "</div></div>" +
            "<div class='feed-content' onclick="+ '"' + "window.location='/story/" + MD5(data[i].content_id) + "'" + '">' + 
            "<div class='feed-into-content' >"+ data[i].content.replace(/&lt;(?:.|\n)*?&gt;/gm, '').replace(/&amp;nbsp;/gi,'').substring(0, 120) +"....</div>" +
            "<div class='feed-date'>" + timeSince(data[i].contentDate) + "</div></div>" + 
            "<div class='feed-tag' style='width: 50%;'><div class='feed-tag-into'>" + 
            "<div class='feed-tag-text' onclick="+ '"' + "window.location='/tag/" + data[i].tag_id + "'" + '">'+  data[i].tagname + "</div>" +
             "</div></div>" + 
             "<div class='feed-writer' style='width: 50%;'>" + 
             "<img src='"+ profile +"' class='feed-writer-profile'>" +
             "<div class='feed-writer-name'  onclick="+ '"' + "window.location='/name/" + data[i].name + "'" + '">' + 
             data[i].name + "</div>" +
             "</div></div>"
            );
        }
    });
});
</script>
