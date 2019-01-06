<? require('db_config.php'); 
if(isset($_GET[tag_id])){
    $sql = "SELECT tagname FROM `tbltag` WHERE tag_id= $_GET[tag_id]"; 
    $result = $conn->query($sql);
    $tbltag = $result->fetch_assoc();
    echo '<title>'.$tbltag[tagname].' | Jaipun</title>';
}else{ echo '<title>Jaipun</title>';}
?>

     <!-- START SEARCH -->
     <div class="seacrh">
        <div style="width: 100%;">
            <div class="write" onclick="window.location.href='index.php?write'">
                <div class="icon-post" ></div>
            </div>
            <div class="search-into">
                    <div class="input-comment-text" id="commentInput" contenteditable="true" placeholder="Say something about this story..."></div>
                <button class="seacrh-button">
                    <div class="icon-search"></div>
                </button>
            </div>
        </div>
    </div>
    <!-- END SEARCH -->
  
  
  
  
<!-- START TAG -->
    <div id="left">
         <div class="icon-left"></div>
    </div>
    <div id="right">
        <div class="icon-right"></div>
    </div>
<div id="tag" style="display: -webkit-box;/* display: flex; */margin: 10px 0px;overflow-x: auto;">
        <?php
            require('db_config.php');
            $sql = "SELECT * FROM `tbltag` ORDER BY tagStories DESC LIMIT 8"; 
            $result = $conn->query($sql);
            include('datatag.php');
        ?>
       
</div>
    

<!-- END TAG -->

<div id="post-data">
    
        <?php
        if(isset($_GET['top'])){
            if(isset($_GET['tag_id'])){
                $feed = "WHERE tag_id =".$_GET['tag_id']." ";
            }else{$feed = " ";}
            require('db_config.php');
            $sql = "SELECT * FROM `tblcontent` $feed ORDER BY contentTop DESC LIMIT 8"; 
            $result = $conn->query($sql);
            include('datatop.php');
        }
        ?>


</div>



 <div class="ajax-load" style="display:block;text-align: center;">
    <p><img src="http://www.fastsailing.it/wp-content/uploads/2017/12/lg.liquid-fill-preloader.gif" style="width:80px"></p>
</div>




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">


    $(document).ready(function(){
        if(window.location.href.indexOf("top") < 0) {
            <? if(isset($_GET['tag_id'])){ ?>
            var tag_id = <?echo $_GET['tag_id'];?>;
            var link = "feed-new.php?tag_id=" + tag_id;
            <? }else{ ?>
            var link = "feed-new.php";
            <? } ?>
            $.get(link, function(res){
                $('#post-data').html(res);
                window.history.replaceState(null, null, "");
            });
        }


        if(window.location.href.indexOf("top") > -1) {
            <? if(isset($_GET['tag_id'])){ ?>
            var tag_id = <?echo $_GET['tag_id'];?>;
            var link = "feed-top.php?tag_id=" + tag_id;
            $.get(link, function(res){
                $('#post-data').html(res);
                window.history.replaceState(null, null, "index.php?top&tag_id=" + tag_id);
            });
            <? }else{ ?>
            var link = "feed-top.php";
            $.get(link, function(res){
                $('#post-data').html(res);
                window.history.replaceState(null, null, "");
            });
            <? } ?>

        }

                      
        if(window.location.href.indexOf("register") > -1) {
            $('#container').css('max-width', '480px');   
        }
        
        
        $('.like').on('click',function(){
        
                    if($(this).attr('data-click-state') == 1) {
                        $(this).attr('data-click-state', 0)
                        $(this).css('opacity', '0.4')
        
                        if(window.location.href.indexOf("write") > -1 || window.location.href.indexOf("story") > -1 || window.location.href.indexOf("profile") > -1 || window.location.href.indexOf("register") > -1) {                   
                        
                            window.location.href="index.php";
                        }else{
                            var link = "feed-new.php";
                            $.get(link, function(res){          
                                $('#post-data').html(res);
                                window.history.replaceState(null, null, "index.php");
                            });
                        }
        
                    } else {
                        $(this).attr('data-click-state', 1)
                        $(this).css('opacity', '1')

                        if(window.location.href.indexOf("write") > -1 || window.location.href.indexOf("story") > -1 || window.location.href.indexOf("profile") > -1 || window.location.href.indexOf("register") > -1) {                   
                            window.location.href="index.php?top";
                        }else{
                            var link = "feed-top.php";
                                $.get(link, function(res){
                                $(".feed").hide();
                                $(".feed-like").show();  
                                $('#post-data').html(res);
                                window.history.replaceState(null, null, "index.php?top");
                            });
                        }
                        document.body.scrollTop = 0; // For Safari
                        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                
                    }


        });



        $('#left').click(function () {
            $(this).css('opacity', '0.6');
            $('#right').css('opacity', '0.2');                                                            
            var leftPos = $('#tag').scrollLeft();
            console.log(leftPos);
            $("#tag").animate({
                scrollLeft: leftPos - 500
            }, 800);
        });

        $('#right').click(function () {
            $(this).css('opacity', '0.6');  
            $('#left').css('opacity', '0.2');                                                            
            var leftPos = $('#tag').scrollLeft();
            console.log(leftPos);
            $("#tag").animate({
                    scrollLeft: leftPos + 500
                }, 800);
            });
            if($('#tag').scrollLeft() + $(window).width() >= $('#tag').width()){
                 var last_tag = $(".tag-text:last").attr("id");  
                 loadMoreTag(last_tag);
                 
            }
        });

    
        $(window).scroll(function() {

            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                if(window.location.href.indexOf("top") > -1) {
                        var last_top = $(".feed-like:last").attr("id");
                        loadMoreDataTop(last_top);
                 }else{
                        var last_id = $(".feed:last").attr("id");
                        loadMoreData(last_id);
                 }     
            }
        });
        
        
            function loadMoreDataTop(last_top){
                <? if(isset($_GET['tag_id'])){ ?>
                    var tag_id = <?echo $_GET['tag_id'];?>;
                    var link = "&tag_id=" + tag_id;
                    <? }else{ ?>
                    var link = " ";
                <? } ?>
              $.ajax(
                    {
                        url: 'loadMoreData.php?last_top=' + last_top + link,
                        type: "get",
                        beforeSend: function()
                        {
                            $('.ajax-load').show();
                        }
                    })
                    .done(function(data)
                    {
                        $('.ajax-load').hide();
                        if(data != 1){
                        $("#post-data").append(data);}
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError)
                    {
                          //alert('server not responding...');
                    });
            }


            function loadMoreData(last_id){
                <? if(isset($_GET['tag_id'])){ ?>
                    var tag_id = <?echo $_GET['tag_id'];?>;
                    var link = "&tag_id=" + tag_id;
                    <? }else{ ?>
                    var link = " ";
                <? } ?>
            $.ajax(
                    {
                        url: 'loadMoreData.php?last_id=' + last_id + link,
                        type: "get",
                        beforeSend: function()
                        {
                            $('.ajax-load').show();
                        }
                    })
                    .done(function(data)
                    {
                        $('.ajax-load').hide();
                        if(data != 1){
                        $("#post-data").append(data);}
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError)
                    {
                        alert('server not responding...');
                    });
            }


            
            function loadMoreTag(last_id){
            $.ajax(
                    {
                        url: 'loadMoreTag.php?last_id=' + last_id,
                        type: "get",
                        beforeSend: function()
                        {
                            $('.ajax-load').show();
                        }
                    })
                    .done(function(data)
                    {
                        $('.ajax-load').hide();
                        if(data != 1){
                        $("#tag").append(data);}
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError)
                    {
                        alert('server not responding...');
                    });
            }

            /*
            function openstory(id){
                var link = "story.php?id=" + id;
                var url = "index.php?story=" + id;
                
                $.get(link, function(res){
                $('#area').removeClass('hide');
                $('#area').html(res);
                window.history.replaceState(null, null, url);
            });
            }*/


            function feed_new_tag(tag_id){
                var link = "feed-new.php?tag_id=" + tag_id;
                $.get(link, function(res){
                    $('#post-data').html(res);
                    window.history.replaceState(null, null, "index.php?tag_id=" + tag_id);
                    window.location.reload();                    
                });
            }

            function feed_top_tag(tag_id){
                var link = "feed-top.php?tag_id=" + tag_id;
                $.get(link, function(res){
                    $('#post-data').html(res);
                    window.history.replaceState(null, null, "index.php?top&tag_id=" + tag_id);
                    window.location.reload();
                });

            }

            
    
</script>
