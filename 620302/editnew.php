
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/icon.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

   <!---//////////////////////CROP FORM___START///////////////////////////-->
   <div class="crop-form hide">
                <div class="crop-form-card">
                
                <canvas class="js-editorcanvas" width="800" height="533"></canvas>

                
                <div class="crop-form-button">
                    
                

            <button class="js-export img-export crop-form-export">
            <div class="icon-crop"></div>
            </button>
              <button class="reset crop-form-reset" >
              <div class="icon-exit"></div>
            </button>
                    

                </div>
                    
                    <canvas class="js-previewcanvas hide"></canvas>
                
                </div>
                </div>




          <!---//////////////////////CROP FORM___END///////////////////////////-->


<div id="container">

<? session_start();
require('db_config.php');
if($_SESSION[member_id] != 0){
$member_id = $_SESSION[member_id];

}else if($_COOKIE[member_id] != 0){
  $member_id = $_COOKIE[member_id];
}

  $result = $conn->query("SELECT * FROM tblmember WHERE member_id='$member_id '");
  $tbluser = $result->fetch_assoc();

  $email=$tbluser['email'];
$name=$tbluser['name'];
$detail=$tbluser['detail'];
$stories=$tbluser['stories'];
$profile=$tbluser['profile'];
echo '<title>'.$tbluser['name'] .' | Jaipun</title>';



if(isset($_POST[editsave])){

  echo"<script>alert('".$_POST[detail]."');</script>";
  $checkname = $conn->query("SELECT * FROM  `tblmember` WHERE name='$_POST[name]' and member_id!='$member_id '");
  
  if($_POST['name'] == ""){
    alert("name ว่าง");
  }else if($checkname->num_rows>1){              
    echo"<script>alert('!! ชื่อซ้ำ !!');</script>";
  }else{
      $sql="UPDATE `tblmember` SET `name`='$_POST[name]',`detail`='$_POST[detail]' WHERE member_id='$member_id '";
      $result = $conn->query($sql);
      header("location:page1.php");      
      exit();
  }
}


?>


<style>
    .profile_container{
        width: auto;
        margin: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
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

.Hide
{
  display:none;
}

ul {
  
}
#container {
    margin-left: auto;
    margin-right: auto;
    padding-top: 20px;
    max-width: 620px;
}

#closecontent {
    position: fixed;
    top: 50px;
    right: 80px;
    z-index: 4;
}
    
</style>


<div class="profile">

<div id="closecontent" onclick="window.history.back()"><img src="https://img.icons8.com/cotton/50/000000/circled-chevron-left.png"></div>



<? if($_SESSION[member_id]){ ?>
<div class="upload-form" style="margin-top: 20px;text-align: center;">
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


<div class="profile-photo" style="margin-top: 20px;">
    <img src="<?=$profile ?>" class="profile-photo-img">
</div>

<div class="profile_container"></div>

<form action="" method="post">
  <input type="email"  style="
      background: #e6e6e6;
      border: 1px solid #efefef;
      outline: 0;
      padding: 9px 0 7px 8px;
      width: 240px;
      border-radius: 3px;
      -webkit-box-flex: 1;
      color: #969696;
      display: block;
      margin: 5px auto;
      margin-top: 40px;
  " placeholder="Email" id="Email" name="Email"  value="<? echo $email ;?>" disabled >


  <input type="text"  style="
      background: #fafafa;
      border: 1px solid #efefef;
      outline: 0;
      padding: 9px 0 7px 8px;
      width: 240px;
      border-radius: 3px;
      -webkit-box-flex: 1;
      color: #262626;
      display: block;
      margin: 5px auto;
  " placeholder="Email" name="name" value="<? echo $name ;?>">


  <input type="text"  style="
      background: #fafafa;
      border: 1px solid #efefef;
      outline: 0;
      padding: 9px 0 7px 8px;
      width: 240px;
      border-radius: 3px;
      -webkit-box-flex: 1;
      color: #262626;
      display: block;
      margin: 5px auto;
  " placeholder="detail" name="detail" value="<? echo $detail ;?>">

  <input type="hidden"  name="editsave">



  <div class="profile-button">
      <a href="#" class="profile-button-edit" onclick="document.forms[0].submit()">Edit Profile</a>
  </div>
</form>


    
    </div>
</div>









        <!-- dribbble -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>




$(document).ready(function() {
  $('.like').on('click',function(){window.location.href="index.php";});
         $('.profile_container').hide();
         $('#errorname').hide();
         $('#errordetail').hide();

    });


        

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
                url: 'photo_upload.php?profile',
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
    
        
    
    
    </div>
    </body>
    </html>