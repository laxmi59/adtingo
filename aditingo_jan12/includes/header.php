<?php
ob_start();
session_start();
include("functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADTINGO</title>
<link href="css/adtingo-style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ready.js"></script>
<script type="text/javascript" src="js/javascript.js"></script>
</head>
<body>
<div class="container">
  <div class="header-top">
    <div class="header-left"> <a href="index.php"><img src="images/logo.jpg" alt="ADTINGO" width="184" height="54" border="0" /></a> </div>
    <div class="header-right">
      <div class="p-bottom10">
	  <?php if(isset($_SESSION['memberid']) && $_SESSION['memberid']!="")
	  {
	  ?>
	  <a href="viewprofile.php">MY ACCOUNT</a> | <a href="logout.php">LOGOUT</a> <?php } else {?> <a href="registration.php">SIGN UP</a> |<a href="login.php">LOGIN</a><?php } ?></div>
    </div>
    <div class="header-right">
      <div class="editions-main">
        <div class="editions city_edition_selection">Select City/Edition: <span class="f-size12"><strong>ADTINGO NATION</strong></span> <span class="aerrow"><img src="images/editing-aerrow.jpg" /></span> </div>
        <ul style="display: none;" class="dropdown">
                  <li><a href="#">Atlanta</a></li>
                   <li><a href="#">Austin</a></li>
                   <li><a href="#">Boston</a></li>
                   <li><a href="#">Chicago</a></li>
                   <li><a href="#">Dallas </a></li>
                   <li><a href="#">Denver </a></li>
                   <li><a href="#">Hamptons</a></li>
                   <li><a href="#">Las Vegas </a></li>
                   <li><a href="#">London </a></li>
                   <li><a href="#">Los Angeles</a></li>
                   <li><a href="#">Miami </a></li>
                   <li><a href="#">New York </a></li>
                   <li><a href="#">Philadelphia</a></li>
                   <li><a href="#">San Diego</a></li>
                   <li><a href="#">San Francisco</a></li>
                   <li><a href="#">Seattle</a></li>
                   <li><a href="#">Washington DC</a></li>
                   <li><a href="#">Adtingo Nation</a></li>
        </ul>
        <a href="#">View all cities / editions</a> </div>
    </div>
  </div>
  <div class="main-nav">
    <div class="main-nav-right"> <a href="#"><img src="images/zoom.jpg" width="23" height="17" border="0" /></a>
      <input name="textfield" type="text" id="textfield" value="Search" />
      <div class="main-nav-right-bottom"><a href="#"></a></div>
    </div>
    <div class="menu"><a href="#" class="m-left3">FOOD AND DINNING</a> | <a href="#">STYLE</a> | <a href="#">ENTERTAINMENT</a> | <a href="#">TRAVEL</a> | <a href="#">NIGHTLIFE</a> | <a href="#">HOME AND GARDEN</a>
      <div class="submenu f-weightn"><a href="#">SPORTS AND FITNESS</a>|<a href="#">CAREER AND MONEY</a>|<a href="#">CARS</a>|<a href="#">HEALTH AND BEAUTY</a></div>
    </div>
  </div>
  <div class="main-container">
    <div class="content">