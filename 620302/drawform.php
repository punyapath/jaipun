<? require('db_config.php'); ?>


<div>ภาพประกอบโดด ๆ สำหรับเนื้อหาของคุณ</div>

<form id="drawForm">
        <?php 
        $result = $conn->query("SELECT * FROM tbldrawname ORDER BY drawname_id LIMIT 0,8");
        while($tbldrawname = $result->fetch_assoc()){
        ?>

        <div style="float: left;PADDING: 15px;">
            </label>
            <label class="container" style="">
            <img src="drawtag/<?=$tbldrawname[drawTag]?>" style="width:150px;">
            <div style="margin: 10px 0px;"><? echo $tbldrawname[drawname] ?></div>
            <input type="radio" name="draw" value="<? echo $tbldrawname[drawname_id] ?>">
          </label>
        </div>

        <?php } ?>


</form>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

$(document).ready(function () {
 $("#drawForm input[type=radio]").on("change",function(){
   
   if(this.checked) {
    var link = "detaildraw.php?drawname_id="+this.value;

    $.get(link, function(res){          
          $('#drawcontent').html(res);
    });
   }
  });
});

</script>

