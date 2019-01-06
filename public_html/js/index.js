console.log("Reloaded");

// dom variables
var msf_getFsTag = document.getElementsByTagName("fieldset");


// declaring the active fieldset & the total fieldset count
var msf_form_nr = 0;
var fieldset = msf_getFsTag[msf_form_nr];
fieldset.className = "msf_show";



// creates and stores a number of bullets
var msf_bullet_nr = "<div class='msf_bullet'></div>";
var msf_length = msf_getFsTag.length;
for (var i = 1; i < msf_length; ++i) {
    msf_bullet_nr += "<div class='msf_bullet'></div>";
};
// injects bullets
var msf_bullet_o = document.getElementsByClassName("msf_bullet_o");
for (var i = 0; i < msf_bullet_o.length; ++i) {
    var msf_b_item = msf_bullet_o[i];
    msf_b_item.innerHTML = msf_bullet_nr;
};

// removes the first back button & the last next button
document.getElementsByName("back")[0].className = "msf_hide";
document.getElementsByName("next")[msf_bullet_o.length - 1].className = "msf_hide";

// Makes the first dot active
var msf_bullets = document.getElementsByClassName("msf_bullet");
msf_bullets[msf_form_nr].className += " msf_bullet_active";






// Validation loop & goes to the next step
function msf_btn_next() {
    var msf_val = true;

    var msf_fs = document.querySelectorAll("fieldset")[msf_form_nr];
    var msf_fs_i_count = msf_fs.querySelectorAll("input").length;
    var title = $('input[type=text][name=title]').val();
    var tag_id = $('input[type=hidden][name=tag_id]').val();
    var doc = document.getElementById("document").innerHTML;
    for (i = 0; i < msf_fs_i_count; ++i) {
        var msf_input_s = msf_fs.querySelectorAll("input")[i];

        if (msf_input_s.getAttribute("type") === "button") {
            // nothing happens
        } else {
            if (title.length === 0 || doc.length < 300 || tag_id === 0) {
              if(title.length === 0 ){
                document.getElementById("title").style.backgroundColor = "#eee";
              }
              if(doc.length < 300 ){
                document.getElementById("document").style.backgroundColor = "#eee";
                $('.errorpost').html("กรุณากรอกเนื้อให้ครบ 300 ตัวอักษรด้วยครับ");
              }
              if(tag_id.length === 0 ){
                $('.SelectedTag').css("color", "red");
                $('.SelectedTag').html("กรุณาใส่หัวข้อเกี่ยวกับเรื่องของคุณ เพื่อง่ายต่อการเข้าถึง");
              }
                msf_val = false;
            } else {
                if (msf_val === false) {} else {
                    msf_val = true;
                    msf_input_s.style.backgroundColor = "#eee";
                }
            }
        };
    };
    if (msf_val === true) {
         $('.phone').addClass('opacityphone');
        //Save to input

        var inputC = $('#inputC'); //document
        inputC.val(doc);
        // goes to the next step
        var selection = msf_getFsTag[msf_form_nr];
        selection.className = "msf_hide";
        msf_form_nr = msf_form_nr + 1;
        var selection = msf_getFsTag[msf_form_nr];
        selection.className = "msf_show";
        // refreshes the bullet
        var msf_bullets_a = msf_form_nr * msf_length + msf_form_nr;
        msf_bullets[msf_bullets_a].className += " msf_bullet_active";

    }
};



    $(document).ready(function() {

      
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
             loadMoreTagPOST(last_tag);
             
        }
    


      
      if(window.location.href.indexOf("write") > -1) {
        $('#container').css('max-width', '740px');
      }
          
    });




    $(document).ready(function(){
      $("#search-box").keyup(function(e){
        $.ajax({
        type: "POST",
        url: "readCountry.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
          $("#search-box").css("background","#f5f5f5 url(LoaderIcon.gif) no-repeat 350px");
        },
        success: function(data){
          $("#top-tag").hide();
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#search-box").css("background","#f5f5f5");
          
        }
        });
        if(e.keyCode == 13)
        {
          sendtag();
        }
      });
    });



    function sendtag(){
      //var msf_val = true;
      //var msf_fs = document.querySelectorAll("fieldset")[msf_form_nr];
      if ($("#search-box").val()!=null) {
       /* // goes to the next step
       // var selection = msf_getFsTag[msf_form_nr];
        selection.className = "msf_hide";
        msf_form_nr = msf_form_nr + 1;
        var selection = msf_getFsTag[msf_form_nr];
        selection.className = "msf_show";
        // refreshes the bullet
        var msf_bullets_a = msf_form_nr * msf_length + msf_form_nr;
        msf_bullets[msf_bullets_a].className += " msf_bullet_active";*/
        var tagname = $("#search-box").val(); //tag_id
        var inputA = $('#inputA'); //tag_id  
        $('.SelectedTag').html(tagname);
        $("#search-box").val("");
        $.ajax({
          type: "POST",
          url: "savetag.php",
          data:{tagname:tagname},
          success: function(data){
            inputA.val(data);
          }
          });

        $('.phone').removeClass('opacityphone');
      }
    }
    //window.location.href = "index.html?tag_id=" + tag_id;



    function selectTag(tag_id,tagname) {
      var inputA = $('#inputA'); //tag_id
      inputA.val(tag_id);
    // var msf_val = true;
    // var msf_fs = document.querySelectorAll("fieldset")[msf_form_nr];
      inputA.val(tag_id);
      $('.SelectedTag').html(tagname);
    // if (msf_val === true) {
        // goes to the next step
        //var selection = msf_getFsTag[msf_form_nr];
      // selection.className = "msf_hide";
      // msf_form_nr = msf_form_nr + 1;
      // var selection = msf_getFsTag[msf_form_nr];
        //selection.className = "msf_show";
        // refreshes the bullet
      // var msf_bullets_a = msf_form_nr * msf_length + msf_form_nr;
      // msf_bullets[msf_bullets_a].className += " msf_bullet_active";
        $('.phone').removeClass('opacityphone');
    // }

    }






            
function loadMoreTagPOST(last_id){
  $.ajax(
          {
              url: 'loadMoreTagPOST.php?last_id=' + last_id,
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


  
// goes one step back
function msf_btn_back() {
  $('.phone').removeClass('opacityphone');
  msf_getFsTag[msf_form_nr].className = "msf_hide";
  msf_form_nr = msf_form_nr - 1;
  msf_getFsTag[msf_form_nr].className = "msf_showhide";
};


function submit_test(){
      var tag_id = $('input[type=hidden][name=tag_id]').val();
      var title = $('input[type=text][name=title]').val();
      var content = $('input[type=hidden][name=document]').val();
      var type = $('input[type=radio][name=r1]:checked').val();
      
        $.ajax({
        type : 'POST',
        url : 'postsave.php?tag_id=' + tag_id ,
        data : {tag_id:tag_id,title:title,content:content,type:type},
        beforeSend: function() {
          $('.msf_show').html("Sending........");
        },
        success : function(response) {
            window.location.href="story.php?id="+ response;
        }

      });
      return false;
}


console.log("loaded");





/****************************************************************************/
/**************** photo_upload.php *********
<?php

    $data = $_POST['photo'];
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
//echo $_SERVER['DOCUMENT_ROOT'] ;
    //mkdir($_SERVER['DOCUMENT_ROOT'] . "/post/images");

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/post/images/".time().'.jpeg', $data);
    die;
    echo "<br>OK";
?>


***************************************/


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
                url: 'photo_upload.php',
                data: {
                    photo: photo
                }});
                $('.crop-form').addClass('hide');
                $('.icon').addClass('hide');
                $('.upload-form').removeClass('hide');
                $('.upload').removeClass('do');
                $('.upload').removeClass('animateEnd');
                $('.upload').removeClass('upload');     
                $('.new').removeClass('hide');
                
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
    var dimensions = { width: 720, height: 300 };
    
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
      document.querySelector('.photo_container').appendChild(img);
      document.querySelector('.js-export').onclick = function (e) {return editor.export(img);};
    } catch (error) {
      exceptionHandler(error.message);
    }


/**********************************************************************************************/
// Font Style

//var emojis = JSON.parse('[{"name":null,"width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/smirking-face_1f60f.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/persevering-face_1f623.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/disappointed-but-relieved-face_1f625.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/face-with-open-mouth_1f62e.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/hushed-face_1f62f.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/sleepy-face_1f62a.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/tired-face_1f62b.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/sleeping-face_1f634.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/relieved-face_1f60c.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/face-with-stuck-out-tongue_1f61b.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/face-with-stuck-out-tongue-and-winking-eye_1f61c.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/face-with-stuck-out-tongue-and-tightly-closed-eyes_1f61d.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/unamused-face_1f612.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/face-with-cold-sweat_1f613.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/pensive-face_1f614.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/confused-face_1f615.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/astonished-face_1f632.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/slightly-frowning-face_1f641.png","width":"72","height":"72"},{"name":"https://emojipedia-us.s3.amazonaws.com/thumbs/72/mozilla/36/dog-face_1f436.png","width":"72","height":"72"}]');
// Not Made to be production level I made this quickly for testing a websocket server and added the emojies for fun!
// Selectors
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
document.body.addEventListener('click', function(){
   emojibtn.classList.remove('open')
})




// Load the Emojies
for(var i = 0; i < emojis.length; i++){
   if(emojis[i].name == null) continue
   emojiwrapper.innerHTML += `
      <button  data-action="insertImage" data-img="${emojis[i].name}" ><img    class="emoji-img" src="${emojis[i].name}"/></button>
   `
}


/**********************************************************************************************/

var pbtn = document.querySelector('.pbtn')
var pinput = document.querySelector('.ptoolbar')
var pemojiholder = document.querySelector('.pemoji-holder')
var pemojiwrapper = document.querySelector('.pemoji-wrapper')
var pemojibtn = document.querySelector('.pemoji-btn')

// Button/Enter Key

pinput.addEventListener('keyup', function(evt){ if(evt.keyCode == 13) sendMessage() })
pemojibtn.addEventListener('click', function(e){
   e.stopPropagation()
   this.classList.toggle('open')
})
document.body.addEventListener('click', function(){
   pemojibtn.classList.remove('open')
})




// Load the Emojies
for(var i = 0; i < emojis.length; i++){
   if(emojis[i].name == null) continue
   pemojiwrapper.innerHTML += `
      <button  data-action="insertImage" data-img="${emojis[i].name}" ><img    class="emoji-img" src="${emojis[i].name}"/></button>
   `
}



/**********************************************************************************************/


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