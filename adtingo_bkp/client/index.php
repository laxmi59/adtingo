<?php
session_start();
include_once('includes/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<link href="css/style.css" rel="stylesheet" />
</head>
<body>
<!--Header-->
 
<div class="header">
  <div class="nav">
    <div class="logo"><a href="index.php" title="Campaign Monitor - Home">&nbsp;</a></div>
    <div class="links">
      <ul>
        <li><a href="#">Pricing</a></li>
        <li><a href="#">Support</a></li>
        <?php if($_SESSION['clientid']!="") {?>
		<li><a href="member-profile.php">Account Settings </a></li>
         <li><a href="member-profile.php"><?php
		$object=new main();
		echo $client_Name=$object->GetClientUsername($_SESSION['clientid']);
		 ?></a></li>
		<li><a href="logout.php">Logout</a></li>
		<?php } else { ?>
		<li><a href="resigtration.php">Signup</a></li>
        <li><a href="login.php">Login</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</div>
<!--Banner-->
 
<div class="banner">
  <h1><img  src="images/feature_screenshot_01.jpg"  alt="Campaign Monitor Screenshot" id="feature_screenshot" /></h1>
</div>
<!--End header-->

 <!--body-->
 
<div class="body">
  <div class="left-col">
    <ul >
      <li><a href="#"><img src="images/create-send.png"  alt="Create &amp; Send Beautiful Emails" /></a> <a href="#" style="display:inline">Design great looking emails</a> using your own tools, or create templates and let your clients log in and build their own.</li>
      <li><a href="#"><img src="images/powerful.png"  alt="Manage Lists &amp; Subscribers" /></a> <a href="#" style="display:inline;">Actionable reports that go beyond opens and clicks.</a> Track your email related conversions and sales.</li>
    </ul>
  </div>
  <div class="right-col">
    <div class="email"> FROM THE BLOG
      <div class="email-spacer"></div>
      <strong class="email" ><a href="#" >Email Standoff: Bands and Musicians</a></strong>
      <p> Three emails to promote a similar product or service. Which one will 
        make the cut? </p>
      To kick off our first 'Email...
      <div class="comments"> <a href="#">0 Comments</a> |  Posted July 6th </div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<!--end body-->
 <!--footer-->
 
<div class="footer">
<!--footer top-->
 
  <div class="ftop">
    <div class="left-col">
      <ul>
        <li><a href="#"><img src="images/icon-home-twitter.png" alt="" /></a> <span><a href="#">Follow us</a> on Twitter</span></li>
        <li><a href="#"><img src="images/icon-home-facebook.png" alt="" /></a> <span><a href="#">Become a fan</a> on Facebook</span></li>
      </ul>
    </div>
    <div class="right-col">
      <ul>
        <li> <a href="#">Privacy Policy</a></li>
        <li><img src="images/dotted.jpg" alt="" /></li>
        <li><a href="#">Terms of Use</a></li>
        <li><img src="images/dotted.jpg" alt="" /> </li>
        <li> <a href="#">Contact</a></li>
        <li><img src="images/dotted.jpg" alt=""/></li>
        <li><a href="#">About</a></li>
      </ul>
    </div>
  </div>
  <!--end footer top-->
 
  <div class="right-col">
    <ul>
      <li> &copy; 2009 adtingo. All rights reserved.</li>
    </ul>
  </div>
</div>
<!--end footer-->
 
</body>
</html>
