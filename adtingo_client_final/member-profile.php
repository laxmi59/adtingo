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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Manage Your Account"?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
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
                   <div class="bghighlight">You might also want to...</div>
                   <dl class="changepassword">
            <dt><a href="change-password.php"><img src="images/change-password.gif" alt="Change your password" title="Change your password" /></a></dt>
            <dd ><a href="change-password.php">Change your  password</a></dd>
            <dd class="last"> Modify your account access password</dd>
            <dt><a href="billing-details.php"  ><img src="images/cart.gif" alt="Manage billing details" title="Manage billing details" /></a></dt>
            <dd><a href="billing-details.php" >Manage billing details</a></dd>
            <dd class="last"></dd>
          </dl>
                   
                  	 
                  </div>
             <div class="clear"></div>
           </div>
             <div class="clear"></div>
        </div>  
          <div class="clear"></div>      
      </div> 
        <div class="clear"></div> 
</div>
<!--body end-->


<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
