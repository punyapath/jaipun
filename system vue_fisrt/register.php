<link rel="stylesheet" href="/css/font.css">   
<link rel='shortcut icon' href='/css/3ByI2t.ico' type='image/x-icon'>        
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<html>
<head>
<title> Register & Login | Jaipun</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>


<?
        session_start();
        echo '<title> Register & Login | Jaipun</title>';
        if($_SESSION["member_id"] != "")
        {
          echo"<script>window.location.href='/';</script>";
          //header("location:profile.php?profile=".$_SESSION[user_id]);
          exit();
        }
        require('db_config.php');




    if(isset($_POST[login])){
        $username=$_POST['Email'];
        $password=base64_encode($_POST['password']);
        $sql="SELECT * FROM `tblmember` WHERE email='$username' and password='$password'";
        //$sql="SELECT * FROM 'tbluser' WHERE username='$username' and password='$password'";
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
        
        if($result->num_rows==0){
            echo"<script>alert('!! Login Fail !!');history.back();</script>";
            exit();
        }else{
            $_SESSION['member_id']=$row['member_id'];
            $cookie_name = "member_id";
            $cookie_value = $row['member_id'];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 15), "/"); // 86400 = 1 day
            echo"<script>window.location.href='#/main';</script>";
            header("location:#/main");
            exit();
        }
    }

        if(isset($_POST[regissave])){
              
            $checkemail = $conn->query("SELECT * FROM  `tblmember` WHERE email='$_POST[Email]'");

            if($_POST['Email'] == "" or $_POST['password'] == "" or $_POST['confirmpassword'] == ""){

              echo"<script>alert('!! กรอกข้อมูลไม่ครบ !!');history.back();</script>";
            }else if(!filter_var($_POST[Email], FILTER_VALIDATE_EMAIL)) {
              echo"<script>alert('!! รูปแบบอีเมลไม่ถูกต้อง !!');history.back();</script>";
            }else if($checkemail->num_rows>1){              
              echo"<script>alert('!! ชื่ออีเมลซ้ำ !!');history.back();</script>";
            }else{

              $username=$_POST['Email'];
              $name=$_POST['name'];              
              $password=$_POST['password'];
              $password=base64_encode($password);

              $sql="INSERT INTO `tblmember` (`name`, `email`, `password`) VALUES ( '$name','$username','$password')";
                if($conn->query($sql)===TRUE){
                  $result = $conn->query("SELECT * FROM `tblmember` WHERE email='$username'");
                  $row = $result->fetch_assoc();
                  $_SESSION['member_id']=$row['member_id'];   
                  echo "4";  
                  echo"<script>window.location.href='#/main';</script>";
                  header("location:#/main");
            
          }
        }
      }


?>



<body style="background: #FAFAFA;">

<script>

  var bFbStatus = false;
  var fbID = "";
  var fbName = "";
  var fbEmail = "";

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2155150018131029',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


function statusChangeCallback(response)
{

		if(bFbStatus == false)
		{
			fbID = response.authResponse.userID;

			  if (response.status == 'connected') {
				getCurrentUserInfo(response)
			  } else {
				FB.login(function(response) {
				  if (response.authResponse){
					getCurrentUserInfo(response)
				  } else {
					console.log('Auth cancelled.')
				  }
				}, { scope: 'email' });
			  }
		}


		bFbStatus = true;
}


    function getCurrentUserInfo() {
      FB.api('/me?fields=name,email', function(userInfo) {

		  fbName = userInfo.name;
		  fbEmail = userInfo.email;

			$("#hdnFbID").val(fbID);
			$("#hdnName ").val(fbName);
			$("#hdnEmail").val(fbEmail);
			$("#frmMain").submit();

      });
    }

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}





</script>



<div class="Register" style="
max-width: 480px;
margin-left: auto;
margin-right: auto;
margin-top: 20px;
">

    
    <div style="
          background:#fff;
    padding: 20px 10px;
    text-align: center;
    width: 100%;
    float: left;
    box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
">
    <img src="https://sv1.picz.in.th/images/2019/02/25/TLqJve.png" style="
    width: 45px;
">


            <a style="display: block; "><img src="https://sv1.picz.in.th/images/2019/02/25/TLqMgN.png" style="width: 150px;"></a>
    



<form action="fb_check.php" method="post" name="frmMain" id="frmMain">
	<input type="hidden" id="hdnFbID" name="hdnFbID">
	<input type="hidden" id="hdnName" name="hdnName">
	<input type="hidden" id="hdnEmail" name="hdnEmail"> 
</form>




<form action="" id="RegisterForm" method="post" >
        <input name="regissave" type="hidden">

        <fb:login-button size="large"
                 scope="public_profile,email"
  onlogin="checkLoginState();">
  Login with Facebook
</fb:login-button>

     <div style="
    font-size: 24px;
    padding: 5px 0px;
">

Create new account</div>
<input type="email"  style="
    background: #fafafa;
    border: 1px solid #efefef;
    outline: 0;
    padding: 9px 0 7px 8px;
    width: 240px;
    border-radius: 3px;
    -webkit-box-flex: 1;
    color: #262626;
          margin:5px 0px;
" placeholder="Email" id="Email" name="Email">

<input type="name"  style="
    background: #fafafa;
    border: 1px solid #efefef;
    outline: 0;
    padding: 9px 0 7px 8px;
    width: 240px;
    border-radius: 3px;
    -webkit-box-flex: 1;
    color: #262626;
          margin:5px 0px;
" placeholder="name" id="name" name="name">

      <div class="error">error</div>
      
      <input type="password" style="
    background: #fafafa;
    border: 1px solid #efefef;
    outline: 0;
    padding: 9px 0 7px 8px;
    width: 240px;
    border-radius: 3px;
    -webkit-box-flex: 1;
    color: #262626;
          margin:5px 0px;
" placeholder="Password" id="password" name="password">
<div class="error">Enter a password longer than 8 characters</div>

            
      <input type="password" style="
    background: #fafafa;
    border: 1px solid #efefef;
    outline: 0;
    padding: 9px 0 7px 8px;
    width: 240px;
    border-radius: 3px;
    -webkit-box-flex: 1;
    color: #262626;
          margin:5px 0px;
" placeholder="Confrim Password" id="confirm_password" name="confirmpassword">
<div class="error">Your passwords do not match</div>

      <div id="btnRegister" style="
    display: block;
    margin: 10px auto;
    width: 240px;
    color: #fff;
    border: 1px solid #54ada1;
    background: #54ada1;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    padding: 5px;
                   " onClick="document.forms[1].submit()">Register</div>
      
      
      <div> Have your account? <a id="UrlLogin" style="
    font-weight: 600;
    color: #54ada1;
">login</a></div>
      </form>



      
      
      <form id="LoginForm" style="display:none;" action="" method="post">
  <input name="login" type="hidden">
    
<input type="text" style="
    background: #fafafa;
    border: 1px solid #efefef;
    outline: 0;
    padding: 9px 0 7px 8px;
    width: 240px;
    border-radius: 3px;
    -webkit-box-flex: 1;
    color: #262626;
          margin:5px 0px;
" placeholder="Email" name="Email">
      
      
      <input type="password" style="
    background: #fafafa;
    border: 1px solid #efefef;
    outline: 0;
    padding: 9px 0 7px 8px;
    width: 240px;
    border-radius: 3px;
    -webkit-box-flex: 1;
    color: #262626;
          margin:5px 0px;
" placeholder="Password" name="password">
     
   
      <div id="btnLogin" style="
    display: block;
    margin: 10px auto;
    width: 240px;
    color: #fff;
    border: 1px solid #54ada1;
    background: #54ada1;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    padding: 5px;
                  " onclick="document.forms[2].submit()">Login</div>
        
        
      <div> Don't you have account? <a id="UrlRegister" style="
      font-weight: 600;
      display: block;
      color: #54ada1;
      border: 1px solid;
      width: 100px;
      border-radius: 3px;
      margin: 10px auto;
  ">register</a>
  
  </div>
      
      </form>
      
      




      </div>

</body>
</html>




<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}

window.onload = function () {
    var userName = '<%= Session["member_id"] %>'; 
    var member_id =getCookie('member_id');
    if(member_id != null){
      window.location.href="/main";
    }
    
    document.getElementById("lbUserName").innerHTML = userName;
    
};


//$("#RegisterForm").hide();
$("#UrlLogin").click(function () {
    $("#LoginForm").show();
    $("#RegisterForm").hide();
});

$("#UrlRegister").click(function () {
    $("#RegisterForm").show();
    $("#LoginForm").hide();
});


var $Email = $("#Email");
var $password = $("#password");
var $confirmPassword = $("#confirm_password");

//Hide hints
$(".error").hide();

function isPasswordValid() {
  return $password.val().length >= 8;
}

function isEmailValid() {
  return $Email.val().length > 0;
}

function arePasswordsMatching() {
  return $password.val() === $confirmPassword.val();
}

function canSubmit() {
  return isPasswordValid() && arePasswordsMatching() && isEmailValid();
}

function passwordEvent(){
    //Find out if password is valid  
    if(isPasswordValid()) {
      //Hide hint if valid
      $password.next().hide();
    } else {
      //else show hint
      $password.next().show();
    }
}

function confirmPasswordEvent() {
  //Find out if password and confirmation match
  if(arePasswordsMatching()) {
    //Hide hint if match
    $confirmPassword.next().hide();
  } else {
    //else show hint 
    $confirmPassword.next().show();
  }
}

function enableSubmitEvent() {
  $("#btnRegister").prop("disabled", !canSubmit());
}



//When event happens on password input
$password.focus(passwordEvent).keyup(passwordEvent).keyup(confirmPasswordEvent).keyup(enableSubmitEvent);

//When event happens on confirmation input
$confirmPassword.focus(confirmPasswordEvent).keyup(confirmPasswordEvent).keyup(enableSubmitEvent);

enableSubmitEvent();

$('#LoginForm *').keydown(function(e) {
      // trap the return key being pressed
      if (e.keyCode === 13) {
        // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
        document.forms[2].submit()
        // prevent the default behaviour of return key pressed
        return false;
      }
});


$('#confirm_password').keydown(function(e) {
      // trap the return key being pressed
      if (e.keyCode === 13) {
        // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
        document.forms[1].submit()
        // prevent the default behaviour of return key pressed
        return false;
      }
});





</script>


