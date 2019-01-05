
<style>
.tag-card{
    display: block;
    margin: 5px 5px;
    width: 120px;
    height: 50px;
    position: relative;
    overflow: hidden;
    text-overflow: ellipsis;
    background: #ff5f5f;
    border-radius:5px;
    box-shadow: 0 1px 3px rgba(32, 33, 36, 0.28);
 
}

.tag-card-text{  
    color:#fff;font-weight:600;
    padding: 5px 5px;
    word-wrap:break-word;
}

</style>
<h1>TAG</h1>
<div style="
    margin-left: auto;
    margin-right: auto;
    padding-top: 50px;
    max-width: 620px;

">
<div class="tag" style="
display: -webkit-box;
/* display: flex; */
margin: 10px 0px;
overflow-x: auto;
">


</div>

</div>
<h1>LOAD TAG</h1>

<?
/**************tagload new Start****************/

$url = "http://localhost/feed/tagload_new?tag_id=16";
$data = file_get_contents($url);

$k=json_decode($data,true);

for ($i = 0; $i < 8; $i++ ) {
    echo $k[$i][tag_id], "tagname : ";
    echo $k[$i][tagname], "  tagStories : ";
    echo $k[$i][tagStories], "<br>";
}
/**************tagload new End****************/
?>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    $.ajax({
             url: "http://jaipun.com/feed/tag_new",
            }).then(function(data) {
            for(var i = 0; i < data.length; i++){
                $('.tag').append(   
                    "<div class='tag-card'><div  class='tag-card-text'>"+ data[i].tagname+"</div></div>"
                );
        }
    });
});
</script>