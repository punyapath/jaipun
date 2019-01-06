<? include('header.php'); ?>



<div id="container">
    <? if(isset($_GET['write'])){
        include('write.php');
    }else if(isset($_GET['story'])){
        include('story.php');        
    }else if(isset($_GET['profile'])){
        include('profile.php');        
    }else if(isset($_GET['register'])){
        include('register.php');        
    }else{
        include('home.php');
    }
    ?>


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