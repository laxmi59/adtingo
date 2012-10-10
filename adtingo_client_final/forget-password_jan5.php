<?php 
session_start();
if($_SESSION['clientid']<>""){header('location:/overview.php');}
 include('includes/functions.php'); 
 /*if($_SESSION['clientid']!="")
{
header("location:member-profile.php");
exit;
}*/
$object=new main(); 
if(isset($_POST['ForGotPwd']) && $_POST['ForGotPwd']!="")
{
$email_address=$_POST['emailaddress'];
 $SqlGetclientemail=sprintf("select * from tbl_clients where email_address='%s' and status=%d",$object->stripper($_POST['emailaddress']),'1'); 
$QryGetclientemail=$object->ExecuteQuery($SqlGetclientemail);
 $cols=$object->NumRows($QryGetclientemail);
 if($cols>0)
	{
		$GetMembersResult=$object->FetchArray($QryGetclientemail);		
		 $userid=$GetMembersResult['memberid'];
		 $emailaddress=$GetMembersResult['email_address'];
		$to=$emailaddress;
		$sub="Regarding your adtingo Password details";
		$fileName = "templates/forgotpassword_new.html";	
		if(file_exists($fileName))
		{
			$emailText = file_get_contents($fileName); 
			
		}
		 $htmMsg = nl2br($GetMembersResult['full_name']);
		 $htmMsg1 = nl2br($GetMembersResult['username']);
		 $htmMsg2 = nl2br($GetMembersResult['password']);
		$mailMessage = str_replace("#IMAGEPATH#", "$htmMsg", "$emailText");
		$mailMessage = str_replace("#MESSAGE#", "$htmMsg", "$emailText");
		$mailMessage = str_replace("#USERNAME#", "$htmMsg1", "$mailMessage");
		 $mailMessage = str_replace("#PASSWORD#", "$htmMsg2", "$mailMessage"); 
		//$subject="Regarding your SoftwareMob Password details";
		$from .= "From:adtingo<info@adtingo.com>\n";
		$from .= "Reply-To: adtingo <info@adtingo.com>\n";
		$from  .= "MIME-Version: 1.0\n";
		$from .= "Content-type: text/html; charset=iso-8859-1\n";
		$mailMessage="this is test mail from manohar";
		if($mail=mail($to,$sub,$mailMessage,$from))
		{
		header("location:login.php?msg=1");
		exit;
		}
	}
	else
	 {
			header("location:login.php?msg=2");
			exit;
			
	 }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Forget Password"?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script type="text/javascript" src="js/javascript.js"></script>
<?php include "includes/google_analytic.php";?>
</head>
<body>
<!--header start-->
    <?php include('includes/header-registration.php'); ?> 
<!-- header end-->

<!--banner start-->
<div class="banner">
  <div class="containt">
    <h1>Forget Password</h1>
     
  </div>
</div>
<!-- banner end-->

<!--body start-->
<form action="" method="post" id="form-sign-up" name="forgotpwd"  onsubmit="return validatepwd();">
 <div class="resigtration-body">
 
        <div class="forget-account">   
            <div class="forget-account-top"></div>
             <div class="forget-account-content"> <h4>Forget Password</h4>
              <p class="p-left60">Please enter the email address associated with your account. An email with a link to reset your password will be sent to this address</p> 
              <dl class="form-lfa">
                <dt>Email Address</dt>
                <dd><input   name="emailaddress"  id="emailaddress" type="text"/></dd>
                <dt>&nbsp; </dt>
                <dd><input src="images/submit.png" name="ForGotPwd" id="ForGotPwd"  value="submit" type="image"/></dd>
              </dl>  </div>        
         <div class="forget-account-bottom"></div>      
        </div> 
        
</div>
  
        </form>
<!--body end-->


<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
