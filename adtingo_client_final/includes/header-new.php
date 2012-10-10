<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE);
include_once('includes/functions.php');

 $a=pathinfo($_SERVER['SCRIPT_NAME']);
if($a[basename]=='examples.php')
$TitleName="Examples";
if($a[basename]=='pricing.php')
$TitleName="Pricing"; 
if($a[basename]=='tour.php')
$TitleName="Overview"; 
if($a[basename]=='compaign.php')
$TitleName="Campaign";
if($a[basename]=='recipients.php')
$TitleName="Recipients";
if($a[basename]=='reports-new.php')
$TitleName="Reports";
if($a[basename]=='about.php')
$TitleName="About";
if($a[basename]=='contact.php')
$TitleName="Contact";
if($a[basename]=='terms-of-use.php')
$TitleName="Terms of Use";
if($a[basename]=='privacy-policy.php')
$TitleName="Privacy Policy";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE.$TitleName ?></title>
<link href="css/style2.css" rel="stylesheet" type="text/css" />
<?php include "includes/google_analytic.php";?>
</head>

<body>
<div class="navbar-box">
  <div class="navbar-menu"><a href="about.php">About</a> | <a href="http://adtingo.com">Blog</a> | <a href="contact.php">Contact Us</a> |<?php  if($_SESSION['clientid']=="")
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
 <?php } ?>
 </div>
</div>

 <?php if($_SESSION['clientid']){ $reg="member-profile.php";}else{ $reg="resigtration.php";}?>
<div class="welcome-box" ><div class="inner-banner"><a href="index.php" class="logo"></a><a href="tour.php" class="tour"></a><a href="examples.php" class="examples"></a><a href="pricing.php" class="pricing"></a><a href="<?php echo $reg;?>" class="singup"></a><div class="title"><?php echo $TitleName;?></div></div></div>

