<?
        session_start();
        echo '<title> Register & Login | Jaipun</title>';
        if($_SESSION["user_id"] != "")
        {
        header("location:index.php?profile=".$_SESSION[user_id]);
        exit();
        }
        require('db_config.php');




    if(isset($_POST[login])){
        $username=$_POST['Email'];
        $password=base64_encode($_POST['password']);
        $sql="SELECT * FROM `tbluser` WHERE email='$username' and password='$password'";
        //$sql="SELECT * FROM 'tbluser' WHERE username='$username' and password='$password'";
        $result = $conn->query($sql);
        
        $row=$result->fetch_assoc();
        
        if($result->num_rows==0){
            echo"<script>alert('!! Login Fail !!');history.back();</script>";
            exit();
        }else{
            $_SESSION['user_id']=$row['user_id'];
            header("location:index.php");
            exit();
        }
    }

        if(isset($_POST[regissave])){
              
            $checkemail = $conn->query("SELECT * FROM tbluser WHERE email='$_POST[Email]'");

            if($_POST['Email'] == "" or $_POST['password'] == "" or $_POST['confirmpassword'] == ""){

              echo"<script>alert('!! กรอกข้อมูลไม่ครบ !!');history.back();</script>";
            }else if(!filter_var($_POST[Email], FILTER_VALIDATE_EMAIL)) {
              echo"<script>alert('!! รูปแบบอีเมลไม่ถูกต้อง !!');history.back();</script>";
            }else if($checkemail->num_rows>1){              
              echo"<script>alert('!! ชื่ออีเมลซ้ำ !!');history.back();</script>";
            }else{

              $username=$_POST['Email'];
              $password=$_POST['password'];
              $password=base64_encode($password);
              $name=substr($username, 0 ,strpos($username, "@"));


              if (getenv(HTTP_X_FORWARDED_FOR))
              $ip=getenv(HTTP_X_FORWARDED_FOR);
              else
              $ip=getenv(REMOTE_ADDR);
                
              $sql="INSERT INTO `tbluser` (`user_id`, `email`, `password`, `name`,`detail` ,`user_ip`, `stories`) VALUES (0,'$username','$password','$name','....','$ip','')";
                if($conn->query($sql)===TRUE){
                  $result = $conn->query("SELECT * FROM tbluser WHERE email='$username'");
                  $row = $result->fetch_assoc();
                  $_SESSION['user_id']=$row['user_id'];   
                  echo "4";  
                  header("location:index.php");
            
          }
        }
      }


?>



<style>.error{color:red;font-size: 14px;}</style>
    
    <div class="Register" style="
    max-width: 480px;
    margin-left: auto;
    margin-right: auto;
">
    
    <div style="
          background:#fff;
    padding: 20px 10px;
    text-align: center;
    width: 100%;
    float: left;
    box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
">
    <img src="https://www.picz.in.th/images/2018/11/01/3ByI2t.png" style="
    width: 45px;
">

            <a style="display: block; "><img src="https://sv1.picz.in.th/images/2018/11/29/3HKSqV.png" style="width: 150px;"></a>
    
    <form action="" id="RegisterForm" method="post" >
        <input name="regissave" type="hidden">
     <div style="
    font-size: 24px;
    padding: 5px 0px;
">Create new account</div>
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
    border: 1px solid #fb6166;
    background: #fb6166;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    padding: 5px;
                   " onClick="document.forms[0].submit()">Register</div>
      
      
      <div> Have your account? <a id="UrlLogin" style="
    font-weight: 600;
    color: #fb6166;
">login</a></div>
      
      </form>
      
      
      
      
      
  <form id="LoginForm" style="display:block;" action="" method="post">
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
    border: 1px solid #fb6166;
    background: #fb6166;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    padding: 5px;
                  " onclick="document.forms[1].submit()">Login</div>
        
        
      <div> Don't you have account? <a id="UrlRegister" style="
    font-weight: 600;
    color: #fb6166;
">register</a></div>
      
      </form>
      
      
      
            

      

      
      </div>
    <div>
    
    </div>
      
      
      
</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

$('.like').on('click',function(){window.location.href="index.php";});

$("#RegisterForm").hide();
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
        document.forms[1].submit()
        // prevent the default behaviour of return key pressed
        return false;
      }
});


$('#confirm_password').keydown(function(e) {
      // trap the return key being pressed
      if (e.keyCode === 13) {
        // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
        document.forms[0].submit()
        // prevent the default behaviour of return key pressed
        return false;
      }
});


</script>



