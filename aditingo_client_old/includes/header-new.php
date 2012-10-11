<?php
error_reporting (E_ALL ^ E_NOTICE);
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
  <div class="navbar-menu"><a href="#">About</a> | <a href="#">Blog</a> | <a href="#">Contact Us</a> | <a href="login.php">Member Login</a></div>
</div>
<?php $a=pathinfo($_SERVER['SCRIPT_NAME']);
if($a[basename]=='examples.php')
$TitleName="Examples";
if($a[basename]=='pricing.php')
$TitleName="Pricing"; 
if($a[basename]=='overview-new.php')
$TitleName="Overview"; 
if($a[basename]=='compaign.php')
$TitleName="Campaign";
if($a[basename]=='recipients.php')
$TitleName="Recipients";
if($a[basename]=='reports-new.php')
$TitleName="Reports";
 ?>
<div class="welcome-box" style="position:relative;"><a href="index.php" class="logo"></a><a href="tour.php" class="tour"></a><a href="examples.php" class="examples"></a><a href="pricing.php" class="pricing"></a><a href="resigtration.php" class="singup"></a><div style="font-size:47px; color:#fff; position:absolute; left:35px; bottom:13px; width:550px; height:50px; text-align:left; font-weight:bold;"><?php echo $TitleName;?></div></div>