<?php
session_start();
 include('includes/functions.php'); 

$object=new main();               
if(isset($_POST['member_username']) && $_POST['member_username']!="")
{
  $checkusername=sprintf("select * from tbl_clients where password='%s' and username='%s' and status='%s'",$object->stripper($_POST['member_pwd']),$object->stripper($_POST['member_username']),$object->stripper(1));
	$chkresult=$object->ExecuteQuery($checkusername);
	//$ResInfo=$object->FetchArray($chkresult);
	$rows=$object->NumRows($chkresult);
	if($rows >0)
	{
		$chkrows=$object->FetchArray($chkresult);
			$_SESSION['clientid']=$chkrows['clientid'];
			$totalrows=$object->getloginrecords($chkrows['clientid']);
			if($totalrows >0)
			{
			header("location:overview.php");
			exit;
			}
			else
			{
			header("location:create-campaign.php");
			exit;
			}
	}
	else
	{
			header("location:login.php?msg=invalid");
			exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script type="text/javascript" src="js/javascript.js"></script>
</head>
<body>
<!--header start-->
  <?php include('includes/header-registration.php'); ?> 
<!-- header end-->

<!--banner start-->
<div class="banner">
  <div class="containt">
    <h1>Client Login</h1>
     
  </div>
</div>
<!-- banner end-->

<!--body start-->
  
 <div class="resigtration-body"><form method="post" action="" id="login" name="login" onSubmit="return validateloginform();"> 
<?php if($_REQUEST['msg']=="added")
	{?>
    <div class="error-msg">Your registration has been completed successfully. Please check your email to confirm the account</div>
	<?php
	}
	if($_REQUEST['msg']=="confirmed")
	{?>
    <div class="error-msg">Your registration has been confirmed. Please login</div>
	<?php
	}
	if($_REQUEST['msg']=="logout")
	{?>
	<div class="error-msg">You have been logged out successfully</div>
	<?php
	}
	if($_REQUEST['msg']=="exp")
	{?>
	<div class="error-msg">Your session has been expired. Please login again</div>
	<?php
	}
	if($_REQUEST['msg']=="invalid")
	{?>
	<div class="error-msg">Invalid  username and password</div>
	<?php
	}
	if($_REQUEST['msg']=="1")
	{?>
	<div class="error-msg">Login details have been sent to your email address</div>
	<?php
	}
	if($_REQUEST['msg']=="2")
	{?>
	<div class="error-msg">Your email address does not match our records</div>
	<?php
	}
	?>
        <div class="login">   
            <div class="login-top-ronund"></div>
            <div class="copy"> 
                    <h4>Login</h4>
                    <dl class="form-lfa">
                        <dt> Username </dt>
                        <dd><input  name="member_username" id="member_username" type="text"/></dd>
                        <dt>  Password    </dt>
                        <dd><input  name="member_pwd" id="member_pwd" value="" type="password"/></dd>
                        <dt></dt>
                        <dd><a href="forget-password.php"> Forgot password ?</a></dd>
                        <dt></dt>
                        <dd><input src="images/btn_login.png" name="Member_submit" id="Member_submit"   value="submit" type="image"/></dd>
                    </dl> 
                </div>
            <div class="sub-copy">                 
                  <h4>Create a New Account </h4>
                  <p>To create a Aditingo account click on 'Signup' below</p>
                  <a href="resigtration.php"><img alt="Signup" src="images/signup.png" /></a>
                </div>
            <div class="login-bottom-ronund"></div>       
        </div> </form>
</div>

<!--body end-->


<!--footer start-->
 <?php include('includes/footer-new.php'); ?> 
<!--footer end-->

