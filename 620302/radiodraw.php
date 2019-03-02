<? include('header.php'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--  เพิ่มตาราง usedraw เข้ามาใหม่ ใน tbluser  -->
<? require('db_config.php'); ?>



<html><head><style>

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.container img {
  opacity: 0.6;
}


/* On mouse-over, add a grey background color */
.container:hover img {
  opacity: 1;
}


</style></head><body>
<div style="
    margin-top: 70px;
    margin-left: auto;
    margin-right: auto;
    max-width: 720px;
">
    <div style="
    padding: 20px;
    max-width: 720px;
    float: left;
    text-align: center;
    border: 1px solid #e9eaea;
    border-radius: 20px;
    " id='drawcontent'>

<? include('drawform.php'); ?>

</div>
</div>
<script>
document.addEventListener('contextmenu', event => event.preventDefault());
</script>