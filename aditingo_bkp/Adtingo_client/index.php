<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE);
include_once('includes/functions.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<link href="css/style2.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="navbar-box">
<div class="navbar-menu"><a href="about.php">About</a> | <a href="http://adtingo.com">Blog</a> | <a href="contact.php">Contact Us</a> | <?php  if($_SESSION['clientid']=="")
{?>
 <a href="login.php">Member Login</a>
 <?php }else {
 ?>
 <a href="overview.php">Manage Campaigns</a>
  | <span><?php
		$object=new main();
		echo $client_Name=$object->GetClientUsername($_SESSION['clientid']);
		 ?></span>
 | <a href="logout.php">Logout</a>
 <?php } ?></div>
</div>
<div class="home-box" ><div class="home-banner"><a href="index.php" class="logo"></a><a href="tour.php" class="tour"></a><a href="examples.php" class="examples"></a><a href="pricing.php" class="pricing"></a><a href="resigtration.php" class="singup"></a><a href="resigtration.php" class="freejoin"></a></div></div>
<div id="content-container">
<div class="message-boxsettwo">
<div class="message-settwo">
<div class="group270three">
<div class="group270two">
<div class="entry270left">
<img src="images/home-boxleft.jpg" alt="" width="270" height="200" />
<h2>Target</h2>
<p>Tell us who you want to reach. Get as detailed as you want, down to the Zip Code they live in.</p>
</div>
<div class="entry270right">
<img src="images/home-boxmiddle.jpg" alt="" width="270" height="200" />
<h2>Build</h2>
<p>If you can write two paragraphs about your company and upload an image, we can create your campaign.</p>
</div>
</div>
<div class="entry270right">
<img src="images/home-boxright.jpg" alt="" width="270" height="200" />
<h2>Deploy</h2>
<p>We take care of the hard stuff like delivery and reporting, you just sit back and watch the clicks and customers pile up.</p>
</div>
</div>
<div class="clear-both"></div>
</div>
</div>
</div>
 <div class="footerbar-box">
<div class="footerbar-menu"><ul class="bottomlinks"><li>
  <div class="bottom-icons"><a href="http://www.facebook.com/pages/Adtingo/160563510636133" target="_blank"><img src="images/f.jpg" /></a> <a href="http://www.facebook.com/pages/Adtingo/160563510636133" target="_blank">Find us</a> on Facebook<a href="http://twitter.com/adtingo" target="_blank"><img src="images/t.jpg"  border="0"/></a> <a href="http://twitter.com/adtingo" target="_blank">Follow us</a> on Twitter</div><div class="leftlinks"><a href="about.php">ABOUT</a> | <a href="contact.php">CONTACT</a> | <a href="terms-of-use.php">TERMS OF USE</a> | <a href="privacy-policy.php">PRIVACY POLICY</a></div></li><li class="p-t10">&copy; 2009 AdTingo. All Rights Reserved.</li>
</ul></div>
</div>
</body>
</html>



