<?php
include_once('includes/session.php');
include('includes/functions.php');
include('includes/values.php');
$object=new main(); 
$Clientid=$_SESSION['clientid']; 
 $SqlGetclientsinfo=sprintf("select * from tbl_clients where clientid=%d and status='%s'",$object->stripper($_SESSION['clientid']),$object->stripper(1)); 
$QryGetclientsinfo=$object->ExecuteQuery($SqlGetclientsinfo);
 $cols=$object->NumRows($QryGetclientsinfo);
$ResGetclientsinfo=$object->FetchArray($QryGetclientsinfo);
//********** START CODE FOR UPDATING PASSWORD *******//

if(isset($_POST['oldpassword']) && $_POST['oldpassword']!='')
{
	if($_SESSION['clientid'])
	{
	
$getexistingpwdqry=sprintf("select * from tbl_clients where password='%s' and clientid=%d ",$object->stripper($_POST['oldpassword']),$object->stripper($_SESSION['clientid'])); 
		$getexistingpwdres=$object->ExecuteQuery($getexistingpwdqry);
		$records=$object->FetchArray($getexistingpwdres);
		$dbpwd=$records['password'];
	}
	if(strstr($dbpwd,$_POST['oldpassword'])=='')
	{
		header("location:change-password.php?msg=notsame");
		exit;
	}
	else
	{
		if($_SESSION['clientid']!="")
		{
			$updatepwd=sprintf("update tbl_clients set password='%s' where clientid=%d",$object->stripper($_POST['newpwd']),$object->stripper($_SESSION['clientid']));
			$updatepwdresult=$object->ExecuteQuery($updatepwd);
		}
		if($updatepwdresult)
		{
			header("location:change-password.php?msg=updated");
			exit;
		}
	}
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Manage Your Account"?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script language="javascript" src="js/javascript.js"></script>
<?php include "includes/google_analytic.php";?>
</head>
<body>
<!--header start-->
<?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
 				<div class="error-msg"><?php if($_REQUEST['msg']=="updated") { ?>
				Your account details has been updated successfully
				<?php
				}?>
				<?php if($_REQUEST['msg']=="notsame") { ?>
				Old password does not match our records
				<?php
				}?>
				</div>
      <div class="title"><h2>Manage your account</h2> </div> 
 
      <div class="account-settings">
      	 <div class="account-settings-top">
         	<div class="account-settings-bottom">
			
                <div class="as-left-col"><div class="grey-box w-640"><h3 class="grad-box">Account settings</h3><dl class="small-form">
                      <dt>Full Name</dt>
                      <dd><?php echo stripslashes($ResGetclientsinfo['full_name']); ?></dd>
                      
                      <dt>Email Address</dt>
                      <dd><?php echo stripslashes($ResGetclientsinfo['email_address']); ?></dd> 
                      
                      <dt>Username</dt>
                      <dd><?php echo stripslashes($ResGetclientsinfo['username']); ?></dd>  
                      
                      <dt>Company Name</dt>
                      <dd><?php echo stripslashes($ResGetclientsinfo['company_name']); ?></dd>  
                      
                      <dt>Time Zone</dt>
                      <dd><?php
			 echo $Time_zone_info[$ResGetclientsinfo['time_zone']]; ?></dd>    
                      
                      <dt>Metropolitan Area</dt>
                      <dd><?php
			echo $object->Getmetropolitianareaname($ResGetclientsinfo['metropolitian_area']);
		   ?></dd>
                      <dt><a class="greybutton" href="edit-account-setting.php" ><span><img src="images/icon-pen.gif" alt="" />Edit Account Settings</span></a></dt>
                      <dd></dd>
       			   </dl> </div></div>
                   <div class="as-right-col">
                   
                  <form method="post" id="changePasswordForm" name="changePasswordForm" action="" >
                <div class="bghighlight">
                     Change your password <a href="member-profile.php" class="cancle">cancel</a>
                  </div>
                  <p>Enter your new password below. Then confirm it, just to make 
                    sure we got it right.</p>
                     
                    
                    
                    <dl class="form-change-password">
                    	<dt>Old password</dt>
                        <dd><input  name="oldpassword" id="oldpassword"   value=""   type="password" /></dd>
                        
                        <dt>New password</dt>
                        <dd><input   name="newpwd" id="newpwd"   value=""   type="password" /></dd>
                        
                        <dt>Confirm it</dt>
                        <dd><input   name="connewpwd" id="connewpwd"   value=""   type="password" /></dd>
                        
                        
                    </dl>
                    <a class="greybutton" href="#" id="btnSavePasswordChange" onclick="return validatechangepwd();"><span><img src="images/icon-tickcase.gif" alt="" />Update</span></a>
                    
                    </form>
                  
                  </div>
             
           </div>
        </div>        
      </div>  
</div>
<!--body end-->


<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
