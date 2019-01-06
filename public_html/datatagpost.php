<?php
    while($tbltag = $result->fetch_assoc()){
?>
    <div class="tag-text" id="<?php echo $tbltag['tag_id']; ?>" onclick="selectTag('<?php echo $tbltag[tag_id]; ?>','<?php echo $tbltag[tagname]; ?>');">
    <span style="
    position: absolute;
    bottom: 0;
    right: 0;
    font-size: 20px;
    padding: 2px;
    opacity: 0.4;
"><?php echo $tbltag['tagStories']; ?></span>
    
    
    <div><?php echo $tbltag['tagname']; ?></div></div>     

<?
    }
?>