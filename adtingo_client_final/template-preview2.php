<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Account Settings | Campaign Monitor</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<?php include "includes/google_analytic.php";?>
</head>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Campaign Information</h2><img src="images/step3.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="step5.php" method="post">                              
            <div class="grey-box">
            <h3 class="grad-box">Campaign Preview</h3>
            	<div class="my-template">
               http://www.yourwebsite.com/mytemplate/<br />    
   			 <div class="pre-temp">
            <div class="t-tit">My Template Title</div>
            <div class="t-img"><img src="images/sample-img.jpg" alt="sample image" /></div>
            <div class="t-cont">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </div>
    
    
    </div>
    		</div>
             </div>

          <a href="campaign-information.php" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" /><a href="step5.php"><img class="m-left5" src="images/approve-bt.gif" alt="Approve"/></a>

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
