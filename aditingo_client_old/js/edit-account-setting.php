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
if($_POST['chkval']!="")
{		
$updateuserinfo=sprintf("update tbl_clients  set full_name='%s', email_address='%s' ,company_name='%s',time_zone='%s',metropolitian_area='%s' where clientid=%d",$object->stripper($_POST['full_name']),$object->stripper($_POST['email']),$object->stripper($_POST['companyname']),$object->stripper($_POST['timezone']),$object->stripper($_POST['metropolitian_list']),$object->stripper($_SESSION['clientid'])); 
		$QryinsertMemInfo=$object->ExecuteQuery($updateuserinfo);
		if($QryinsertMemInfo)
		{
			header("location:member-profile.php?msg=updated");
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
<?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
      <div class="title"><h2>Manage your account</h2> </div> 
 
      <div class="account-settings">
      	 <div class="account-settings-top">
         	<div class="account-settings-bottom">
			
                <div class="as-left-col"><div class="grey-box w-640">
				 <form action="" method="post" name="updateaccount" id="updateaccount">
					        <input type="hidden" name="emailerr" />
							<input type="hidden" name="usererr" />
							<input type="hidden" name="chkval" id="chkval" value="1" />
                        
                        <h3 class="grad-box">Your details</h3>
                        <p>Your contact details will be used to send 
                          invoices and other correspondence from the Campaign Monitor team.</p> 
         				<dl class="form">
                          <dt>Username</dt>
                          <dd> <?php echo stripslashes($ResGetclientsinfo['username']); ?></dd>  
                          
						  <dt>Full Name</dt>
                          <dd><input   name="full_name" id="full_name" value="<?php echo stripslashes($ResGetclientsinfo['full_name']); ?>" type="text" /></dd>
                          
                          <dt>Email Address</dt>
                          <dd><input name="email" id="email" value="<?php echo stripslashes($ResGetclientsinfo['email_address']); ?>" type="text" onblur="javascript:client_emailcheck();" /></dd> 
                          
                          
                          <!--<dt>Password</dt>-->
                          <!--<dd><input name="username" value="hellorammi"  type="text" /></dd> --> 
                       </dl>
                       
                        <h3 class="grad-box">Your location</h3>
                        <p>Select your company and the default 
                          time-zone you prefer to use.</p> 
         				<dl class="form">
                          <dt>Company Name</dt>
                          <dd><input name="companyname" id="companyname"  value="<?php echo stripslashes($ResGetclientsinfo['company_name']); ?>" type="text" /></dd>
                          
                          <dt>Time Zone</dt>
                          <dd><select name="timezone" id="timezone" >
								<option value="">Select Time zone</option>
                  <?php
							echo Timezone_info_data($ResGetclientsinfo[time_zone]);
		 		  ?></select></dd> 
                          
                          <dt>Metropolitan Area</dt>
                          <dd><select name="metropolitian_list" id="metropolitian_list">
							   <option value="">Select  Metropolitian Area</option>
                  <?php 
							    echo $object->GetAllMetropolitianList($ResGetclientsinfo['metropolitian_area']);
		  			 ?>
					 </select></dd>  
                       </dl>
                        <a class="greybutton" href="#" onclick="return updateaccountdetails();"><span><img src="images/icon-tickcase.gif" alt="" />Save Changes</span></a> 
                        <span class="formcancel">or </span><a href="member-profile.php" class="greybutton" onclick="CS.AccountDefault.toggleEdit()" 
> <span>cancel</span></a> 
 

                      </form></div></div>
                   <div class="as-right-col">
                   <div class="bghighlight">You might also want to...</div>
                  	<dl class="changepassword">
                    <dt><a href="#"><img src="images/change-password.gif" alt="Change your password" /></a></dt>
                    <dd><a href="change-password.php">Change your  password</a></dd>
                    <dt>&nbsp;</dt>
                    <dd>Modify your account access password</dd>
                  </dl>
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
