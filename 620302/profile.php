<? include('header.php'); ?>



<div id="container">

<? session_start();
require('db_config.php');

  $result = $conn->query("SELECT * FROM tbluser WHERE user_id='$_GET[profile]'");
  $tbluser = $result->fetch_assoc();


$name=$tbluser['name'];
$detail=$tbluser['detail'];
$stories=$tbluser['stories'];

echo '<title>'.$tbluser['name'] .'| Jaipun</title>';

$filename = $_SERVER['DOCUMENT_ROOT'] . "/"."profile/".$_GET[profile].'.jpeg';
if (file_exists($filename)) {
  $profile = $_GET[profile].'.jpeg';
} else {
  $profile = 'user.jpeg';
}

?>


<style>
    .profile_container{
        width: auto;
        margin: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 100px;
    }

    .profile_container img{
    
        border-radius: 100px;
        height: 100px;
        object-fit: cover;
        width: 100px;
        display: inline-block;
        margin: 0px;
        padding: 0px;
    }

    .icon button{
        border: 1px solid #222;
        background: #fafafa;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        position: absolute;
        margin: 2px 10px;
    }

    .new button{
        border: 1px solid #222;
        background: #fafafa;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        position: absolute;
        margin: 2px 10px;
    }


#history{
  margin: 0px;
    background: #fff;
  width:100%;
  height:400px;
  height:160px;
  padding:0px;
  display:none;
  overflow-x:auto;
}

.history{
  text-decoration: none;
    padding: 10px 0px;
    text-align: center;
      background: #f5f5f5;
    color: #000;
    border: 1px solid #e6e6e6;
    width:100%;
}

.Hide
{
  display:none;
}

ul {
  
}

#history li{
  font-size:18px;
background: #fff;
    border: 1px solid #e6e6e6;
    box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
    list-style: none;
    width: 98%;
    margin: 5px 0px;
  padding:5px 0px;
}

#history li span{
  margin:0px 5px;
}


    
</style>

<? if($_SESSION[user_id] == $_GET[profile]){ ?>
<div style='max-width:580px;'>
<div class="history">history</div>

  <ul id="history">
  <?

  $sql = "SELECT tblhistory.history_id, tblhistory.user_id, tblhistory.content_id, tblhistory.historyDate, tblcontent.contentName FROM `tblhistory`,`tblcontent` 
          WHERE tblcontent.content_id=tblhistory.content_id AND tblhistory.user_id=$_SESSION[user_id] ORDER BY history_id DESC limit 8";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
      // output data of each row
        include('datahistory.php');
      }
?>

  </ul>
  
</div>

<? } ?>

<div class="profile">





<? if($_SESSION[user_id] == $_GET[profile]){ ?>
<div class="upload-form" style="margin-top: 100px;text-align: center;">
<div>
    <label>

      <div class="icon">
          <button style=""><img src="https://img.icons8.com/ios/100/000000/compact-camera.png" style="width: 20px;">
        </button>
      </div>

      <span class="new hide"><button style=""><img src="https://img.icons8.com/ios/100/000000/compact-camera.png" style="width: 20px;">
    </button></span>
        <input type="file" class="js-fileinput img-upload" accept="image/jpeg,image/png,image/gif" style="
        opacity: 0;
        position: absolute;
        bottom: auto;
    ">
    </label>
    </div>

</div>

<? } ?>


<div class="profile-photo">
    <img src="/profile/<?=$profile ?>" class="profile-photo-img">
</div>

<div class="profile_container"></div>




<div id="editform">
<div id="profile-name" data-maxlength="20" data-minlength="5"><? echo $name ;?></div>
<div id="profile-detail" data-maxlength="20" data-minlength="5"><? echo $detail ;?> </div>
</div>

<? if($_SESSION[user_id] == $_GET[profile]){ ?>


<div class="profile-button">
    <a href="#" class="profile-button-edit" onclick="button_edit()">Edit Profile</a>
    <a href="/logout.php" class="profile-button-logout"  >log out</a>
</div>


<? } ?>

<div class="profile-follow">

    <div class="profile-followers">
    <span class="profile-follow-int"><? echo $stories; ?></span>
    <span class="profile-follow-text">Stories</span>
</div>
    
    </div>
</div>

<div id="post-user" style="max-width: 580px;">

<a href="#" class="profile-story" style="width: 100%;">New</a>

    <?php

            require('db_config.php');   
            $sql = "SELECT * FROM `tblcontent`,`tbltag` WHERE tblcontent.tag_id=tbltag.tag_id and user_id ='$_GET[profile]'  ORDER BY content_id DESC LIMIT 8"; 
            $result = $conn->query($sql);
            include('datauser.php');
    ?>


</div>


        <!-- dribbble -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>




$('.history').click(function() {
    $('#history').toggle('600');
});



    
$(window).scroll(function() {

            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                  var last_id = $(".feed:last").attr("id");
                  loadMoreUser(last_id);   
            }
        });
        
        
            function loadMoreUser(last_id){
                <? if(isset($_GET['profile'])){ ?>
                    var profile= <?echo $_GET['profile'];?>;
                    var link = "&profile=" + profile;
                    <? }else{ ?>
                    var link = " ";
                <? } ?>
              $.ajax(
                    {
                        url: 'loadMoreUser.php?last_id=' + last_id + link,
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
                        $("#post-user").append(data);}
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError)
                    {
                          //alert('server not responding...');
                    });
            }



$(document).ready(function() {
  $('.like').on('click',function(){window.location.href="index.php";});
         $('.profile_container').hide();
         $('#errorname').hide();
         $('#errordetail').hide();
        $('#profile-name').keyup(function(){
            var limit = parseInt($(this).attr('data-maxlength'));
            var minlimit = parseInt($(this).attr('data-minlength'));
            var text = $(this).html();
            var chars = text.length;
            if(chars >= limit){
                var new_text = text.substr(0,limit);
                $(this).html(new_text);
            }
        });

        $('#profile-detail').keyup(function(){
            var limit = parseInt($(this).attr('data-maxlength'));
            var minlimit = parseInt($(this).attr('data-minlength'));
            var text = $(this).html();
            var chars = text.length;
            if(chars >= limit){
                var new_text = text.substr(0,limit);
                $(this).html(new_text);
            }
        });
    });



    $('#profile-name').keydown(function(e) {
      // trap the return key being pressed
      if (e.keyCode === 13) {
        // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
        $(this).next().focus();
        // prevent the default behaviour of return key pressed
        return false;
      }
    });

    $('#profile-detail').keydown(function(e) {
      // trap the return key being pressed
      if (e.keyCode === 13) {
        // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
        button_edit();
        // prevent the default behaviour of return key pressed
        return false;
      }
    });



    function button_edit(){
            var buttonedit = $('.profile-button-edit');
            if(buttonedit.attr('data-click-state') == 1) {

              if($("#profile-name").text().length > 1 || $("#profile-detail").text().length > 1){
                buttonedit.attr('data-click-state', 0);
                buttonedit.css('background', '#fff');
                buttonedit.html("Edit Profile")          
                $("#editform *").attr("contentEditable", false);
                $("#editform *").css('background', '#fff'); 
                $("#editform *").css('border', '0px solid');                 
                var name = $("#profile-name").html();
                var detail = $("#profile-detail").html();

                
                  $.ajax({
                    type : 'POST',
                    url : '/editsave.php',
                    data : { name : name, detail : detail },
                    beforeSend: function() {
                      $('.profile-button-edit').html(' sending ...');
                    },
                    success : function(response) {
                      $('.profile-button-edit').html("Edit Profile")  
                    }
                  });
                }else{
                  buttonedit.html('edit again');
                  buttonedit.css('background', '#f84242')
                }
                
            } else {
                buttonedit.attr('data-click-state', 1)
                buttonedit.css('background', '#81C784')
                buttonedit.html("save")                                            
                $("#editform *").attr("contentEditable", true);
                $("#editform *").css('background', '#fafafa'); 
                $("#editform *").css('border', '1px solid #e6e6e6'); 
                

            }       
        }






        

/******************************************************************************************/
/******************************************************************************************/
/******************************CROP_PROFILE__START*****************************************/
/******************************************************************************************/
/******************************************************************************************/


    
    $('.upload').click(function (e) {
         var self = $(this);
        if (self.hasClass('do')) {
            self.removeClass('do animateEnd');
        } else {
            self.addClass('do');
            setTimeout(function () {
                self.addClass('animateEnd');
            }, 4000);
        }
                
    });


    $('.reset').click(function (e) {
 
                $('.crop-form').addClass('hide');
                $('.upload-form').removeClass('hide');
    });


    var _createClass = function () {function defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}return function (Constructor, protoProps, staticProps) {if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;};}();function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}} /**
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             * @file Allows uploading, cropping (with automatic resizing) and exporting
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             * of images.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             * @author Billy Brown
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             * @license MIT
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             * @version 2.1.0
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             */

    /** Class used for uploading images. */var
    Uploader = function () {
      /**
                             * <p>Creates an Uploader instance with parameters passed as an object.</p>
                             * <p>Available parameters are:</p>
                             * <ul>
                             *  <li>exceptions {function}: the exceptions handler to use, function that takes a string.</li>
                             *  <li>input {HTMLElement} (required): the file input element. Instantiation fails if not provided.</li>
                             *  <li>types {array}: the file types accepted by the uploader.</li>
                             * </ul>
                             *
                             * @example
                             * var uploader = new Uploader({
                             *  input: document.querySelector('.js-fileinput'),
                             *  types: [ 'gif', 'jpg', 'jpeg', 'png' ]
                             * });
                             * *
                             * @param {object} options the parameters to be passed for instantiation
                             */
      function Uploader(options) {_classCallCheck(this, Uploader);
        if (!options.input) {
          throw '[Uploader] Missing input file element.';
        }
        this.fileInput = options.input;
        this.types = options.types || ['gif', 'jpg', 'jpeg', 'png'];
      }
    
      /**
         * Listen for an image file to be uploaded, then validate it and resolve with the image data.
         */_createClass(Uploader, [{ key: 'listen', value: function listen(
        resolve, reject) {var _this = this;
          this.fileInput.onchange = function (e) {
            // Do not submit the form
            e.preventDefault();
    
            // Make sure one file was selected
            if (!_this.fileInput.files || _this.fileInput.files.length !== 1) {
              reject('[Uploader:listen] Select only one file.');
            }
    
            var file = _this.fileInput.files[0];
            var reader = new FileReader();
            // Make sure the file is of the correct type
            if (!_this.validFileType(file.type)) {
              reject('[Uploader:listen] Invalid file type: ' + file.type);
            } else {
              // Read the image as base64 data
              reader.readAsDataURL(file);
              // When loaded, return the file data
              reader.onload = function (e) {return resolve(e.target.result);};
            }
            $('.upload-form').addClass('hide');
            $('.crop-form').removeClass('hide');
          };
        }
    
        /** @private */ }, { key: 'validFileType', value: function validFileType(
        filename) {
          // Get the second part of the MIME type
          var extension = filename.split('/').pop().toLowerCase();
          // See if it is in the array of allowed types
          return this.types.includes(extension);
        } }]);return Uploader;}();
    
    
    function squareContains(square, coordinate) {
      return coordinate.x >= square.pos.x &&
      coordinate.x <= square.pos.x + square.size.x &&
      coordinate.y >= square.pos.y &&
      coordinate.y <= square.pos.y + square.size.y;
    }
    
    /** Class for cropping an image. */var
    Cropper = function () {
      /**
                            * <p>Creates a Cropper instance with parameters passed as an object.</p>
                            * <p>Available parameters are:</p>
                            * <ul>
                            *  <li>size {object} (required): the dimensions of the cropped, resized image. Must have 'width' and 'height' fields. </li>
                            *  <li>limit {integer}: the longest side that the cropping area will be limited to, resizing any larger images.</li>
                            *  <li>canvas {HTMLElement} (required): the cropping canvas element. Instantiation fails if not provided.</li>
                            *  <li>preview {HTMLElement} (required): the preview canvas element. Instantiation fails if not provided.</li>
                            * </ul>
                            *
                            * @example
                            * var editor = new Cropper({
                            *  size: { width: 128, height: 128 },
                            *  limit: 600,
                            *  canvas: document.querySelector('.js-editorcanvas'),
                            *  preview: document.querySelector('.js-previewcanvas')
                            * });
                            *
                            * @param {object} options the parameters to be passed for instantiation
                            */
      function Cropper(options) {_classCallCheck(this, Cropper);
        // Check the inputs
        if (!options.size) {throw 'Size field in options is required';}
        if (!options.canvas) {throw 'Could not find image canvas element.';}
        if (!options.preview) {throw 'Could not find preview canvas element.';}
    
        // Hold on to the values
        this.imageCanvas = options.canvas;
        this.previewCanvas = options.preview;
        this.c = this.imageCanvas.getContext("2d");
    
        // Images larger than options.limit are resized
        this.limit = options.limit || 800; // default to 600px
        // Create the cropping square with the handle's size
        this.crop = {
          size: { x: options.size.width, y: options.size.height },
          pos: { x: 0, y: 0 },
          handleSize: 10 };
    
    
        // Set the preview canvas size
        this.previewCanvas.width = options.size.width;
        this.previewCanvas.height = options.size.height;
    
 /*************************************************************/
    /************************START EDIT**********************/
    /*************************************************************/


        //ระบบสัมผัส เพิ่มขึ้นเอง START
        // Bind the methods, ready to be added and removed as events
        this.boundDrag = this.drag.bind(this);
        this.boundClickStop = this.clickStop.bind(this);
        this.boundtouchStop = this.touchStop.bind(this);
        this.boundTouchtest = this.touchtest.bind(this);

      }

      /**
         * Set the source image data for the cropper.
         *
         * @param {String} source the source of the image to crop.
         */_createClass(Cropper, [{ key: 'setImageSource', value: function setImageSource(
        source) {var _this2 = this;
          this.image = new Image();
          this.image.src = source;
          this.image.onload = function (e) {
            // Perform an initial render
            _this2.render();
         /**********START*************/
        // Listen for events on the canvas when the image is ready
        _this2.imageCanvas.onmousedown = _this2.clickStart.bind(_this2);
        _this2.imageCanvas.addEventListener("touchstart", _this2.touchStart.bind(_this2), false);
        /************END*************/
          };
        }



    
        /**
           * Export the result to a given image tag.
           *
           * @param {HTMLElement} img the image tag to export the result to.
           */ }, { key: 'export', value: function _export(
        img) {
          img.setAttribute('src', this.previewCanvas.toDataURL());
          var photo = this.previewCanvas.toDataURL('image/jpeg');                
                $.ajax({
                method: 'POST',
                url: '/photo_upload.php?profile',
                data: {
                    photo: photo
                },success:function(data){
                    // display the croped photo
                    $('.profile_container').show();
                    $('.profile-photo').hide();
                    $('#profile_container').html(data);
                }});
                $('.crop-form').addClass('hide');
                $('.icon').addClass('hide');
                $('.upload-form').removeClass('hide');
                $('.upload').removeClass('do');
                $('.upload').removeClass('animateEnd');
                $('.upload').removeClass('upload');
                
                $('.new').removeClass('hide');
                
                
                
                //$('.js-editorcanvas').addClass('hide');
            /* $.ajax({
                url: 'crop_photo.php',
                type: 'POST',
                data: {photo_url:this.previewCanvas.toDataURL()},
                success:function(data){
                    // display the croped photo
                    $('#photo_container').html(data);
                }});*/
        }
    
        /** @private */ }, { key: 'render', value: function render()
        {
          this.c.clearRect(0, 0, this.imageCanvas.width, this.imageCanvas.height);
          this.displayImage();
          this.preview();
          this.drawCropWindow();
        }
    
     /** @private */ }, { key: 'clickStart', value: function clickStart(
      e) {
        // Get the click position and hold onto it for the expected mousemove
  
        var position = { x: e.offsetX, y: e.offsetY };
        this.lastEvent = {
          position: position,
          resizing: this.isResizing(position),
          moving: this.isMoving(position) };
  
  
        // Listen for mouse movement and mouse release      
        this.imageCanvas.addEventListener('mousemove', this.boundDrag);
        this.imageCanvas.addEventListener('mouseup', this.boundClickStop);
      }
  
  
  
      /** @private */ }, { key: 'clickStop', value: function clickStop(
      e) {
        // Stop listening for mouse movement and mouse release
        this.imageCanvas.removeEventListener("mousemove", this.boundDrag);
        this.imageCanvas.removeEventListener("mouseup", this.boundClickStop);
      }
  
  
      /*************************TOUCH START**********************************/
  
      /** @private */ }, { key: 'touchStart', value: function touchStart(
      e) {
        // Get the click position and hold onto it for the expected mousemove
        var position = {
          x: e.changedTouches[0].pageX - e.target.getBoundingClientRect().left,
          y: e.changedTouches[0].pageY - e.target.getBoundingClientRect().top };
  
        this.lastEvent = {
          position: position,
          resizing: this.isResizing(position),
          moving: this.isMoving(position) };
  
  
        //ระบบสัมผัส เพิ่มขึ้นเอง START
        this.imageCanvas.addEventListener("touchmove", this.boundTouchtest);
        this.imageCanvas.addEventListener('touchend', this.boundtouchStop);
  
      }
  
  
  
  
      /** @private */ }, { key: 'touchStop', value: function touchStop(
      e) {
        // Stop listening for mouse movement and mouse release
        this.imageCanvas.removeEventListener("touchmove", this.boundTouchtest);
        this.imageCanvas.removeEventListener("touchend", this.boundtouchStop);
      }
  
  
      /*************************TOUCH END**********************************/
  
  
  
      /** @private */ }, { key: 'isResizing', value: function isResizing(
      coord) {
        var size = this.crop.handleSize;
        var handle = {
          pos: {
            x: this.crop.pos.x + this.crop.size.x - size / 2,
            y: this.crop.pos.y + this.crop.size.y - size / 2 },
  
          size: { x: size, y: size } };
  
        return squareContains(handle, coord);
      }
  
      /** @private */ }, { key: 'isMoving', value: function isMoving(
      coord) {
        return squareContains(this.crop, coord);
      }
  
  
      //ระบบสัมผัส เพิ่มขึ้นเอง START
    }, { key: 'touchtest', value: function touchtest(e) {
        var position = {
          x: e.changedTouches[0].pageX - e.target.getBoundingClientRect().left,
          y: e.changedTouches[0].pageY - e.target.getBoundingClientRect().top };
  
  
        var dx = position.x - this.lastEvent.position.x;
        var dy = position.y - this.lastEvent.position.y;
        // Determine whether we are resizing, moving, or nothing
        if (this.lastEvent.resizing) {
          this.resize(dx, dy);
        } else if (this.lastEvent.moving) {
          this.move(dx, dy);
        }
        this.lastEvent.position = position;
        this.render();
      }
  
      //ระบบสัมผัส เพิ่มขึ้นเอง END
  
      /*************************************************************/
      /************************END EDIT**********************/
      /*************************************************************/
  
  
        /** @private */ }, { key: 'drag', value: function drag(
        e) {
          var position = {
            x: e.offsetX,
            y: e.offsetY };
    
          // Calculate the distance that the mouse has travelled
          var dx = position.x - this.lastEvent.position.x;
          var dy = position.y - this.lastEvent.position.y;
          // Determine whether we are resizing, moving, or nothing
          if (this.lastEvent.resizing) {
            this.resize(dx, dy);
          } else if (this.lastEvent.moving) {
            this.move(dx, dy);
          }
          // Update the last position
          this.lastEvent.position = position;
          this.render();
        }
    
        /** @private */ }, { key: 'resize', value: function resize(
        dx, dy) {
          var handle = {
            x: this.crop.pos.x + this.crop.size.x,
            y: this.crop.pos.y + this.crop.size.y };
    
          // Maintain the aspect ratio
          var amount = Math.abs(dx) > Math.abs(dy) ? dx : dy;
          // Make sure that the handle remains within image bounds
          if (this.inBounds(handle.x + amount, handle.y + amount)) {
            this.crop.size.x += amount;
            this.crop.size.y += amount;
          }
        }
    
        /** @private */ }, { key: 'move', value: function move(
        dx, dy) {
          // Get the opposing coordinates
          var tl = {
            x: this.crop.pos.x,
            y: this.crop.pos.y };
    
          var br = {
            x: this.crop.pos.x + this.crop.size.x,
            y: this.crop.pos.y + this.crop.size.y };
    
          // Make sure they are in bounds
          if (this.inBounds(tl.x + dx, tl.y + dy) &&
          this.inBounds(br.x + dx, tl.y + dy) &&
          this.inBounds(br.x + dx, br.y + dy) &&
          this.inBounds(tl.x + dx, br.y + dy)) {
            this.crop.pos.x += dx;
            this.crop.pos.y += dy;
          }
        }
    
        /** @private */ }, { key: 'displayImage', value: function displayImage()
        {
          // Resize the original to the maximum allowed size
          var ratio = this.limit / Math.max(this.image.width, this.image.height);
          this.image.width *= ratio;
          this.image.height *= ratio;
          // Fit the image to the canvas
          this.imageCanvas.width = this.image.width;
          this.imageCanvas.height = this.image.height;
          this.c.drawImage(this.image, 0, 0, this.image.width, this.image.height);
        }
    
        /** @private */ }, { key: 'drawCropWindow', value: function drawCropWindow()
        {
          var pos = this.crop.pos;
          var size = this.crop.size;
          var radius = this.crop.handleSize / 2;
          this.c.strokeStyle = 'blue';
          this.c.fillStyle = 'blue';
          // Draw the crop window outline
          this.c.strokeRect(pos.x, pos.y, size.x, size.y);
          // Draw the draggable handle
          var path = new Path2D();
          path.arc(pos.x + size.x, pos.y + size.y, radius, 0, Math.PI * 2, true);
          this.c.fill(path);
        }
    
        /** @private */ }, { key: 'preview', value: function preview()
        {
          var pos = this.crop.pos;
          var size = this.crop.size;
          // Fetch the image data from the canvas
          var imageData = this.c.getImageData(pos.x, pos.y, size.x, size.y);
          if (!imageData) {
            return false;
          }
          // Prepare and clear the preview canvas
          var ctx = this.previewCanvas.getContext('2d');
          ctx.clearRect(0, 0, this.previewCanvas.width, this.previewCanvas.height);
          // Draw the image to the preview canvas, resizing it to fit
          ctx.drawImage(this.imageCanvas,
          // Top left corner coordinates of image
          pos.x, pos.y,
          // Width and height of image
          size.x, size.y,
          // Top left corner coordinates of result in canvas
          0, 0,
          // Width and height of result in canvas
          this.previewCanvas.width, this.previewCanvas.height);
        }
    
        /** @private */ }, { key: 'inBounds', value: function inBounds(
        x, y) {
          return squareContains({
            pos: { x: 0, y: 0 },
            size: {
              x: this.imageCanvas.width,
              y: this.imageCanvas.height } },
    
          { x: x, y: y });
        } }]);return Cropper;}();
    
    
    function exceptionHandler(message) {
      console.log(message);
    }
    
    // Auto-resize the cropped image
    var dimensions = { width: 400, height: 400 };
    
    try {
      var uploader = new Uploader({
        input: document.querySelector('.js-fileinput'),
        types: ['gif', 'jpg', 'jpeg', 'png'] });
    
    
      var editor = new Cropper({
        size: dimensions,
        canvas: document.querySelector('.js-editorcanvas'),
        preview: document.querySelector('.js-previewcanvas') });
    
    
      // Make sure both were initialised correctly
      if (uploader && editor) {
        // Start the uploader, which will launch the editor
        uploader.listen(editor.setImageSource.bind(editor), function (error) {throw error;});
      }
      // Allow the result to be exported as an actual image
      var img = document.createElement('img');
      //img.addClass('img');
      document.querySelector('.profile_container').appendChild(img);
      document.querySelector('.js-export').onclick = function (e) {return editor.export(img);};
    } catch (error) {
      exceptionHandler(error.message);
    }



    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130480379-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-130480379-1');

    </script>
    

    
    </div>
    
      <!-- END CONTAINER  -->
    
    <script type="text/javascript">
    
    
    
        $(document).scroll(function() {
        navbarScroll();
        });
    
        function navbarScroll() {
        var y = window.scrollY;
            if (y > 10) {
                $('.header').addClass('small');
            } else if (y < 10) {
                $('.header').removeClass('small');
            }
        }   
    
        
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130480379-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-130480379-1');
    </script>
    
    
    </div>
    </body>
    </html>