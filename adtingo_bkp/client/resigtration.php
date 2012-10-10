<?php ob_start();
include_once('includes/functions.php'); 
//include('includes/dbfiler.php'); 
include_once('includes/values.php'); 
$object=new main();
//********* START CODE FOR UPDATING PROFILE **************//
if(isset($_POST['AddClient']) && $_POST['AddClient']!='')
{			
$insertMemInfo=sprintf("insert into tbl_clients(full_name,email_address,username,password,company_name,time_zone,metropolitian_area,date_created,status) values('%s','%s','%s','%s','%s','%s',%d,'%s',%d)",$object->stripper($_POST['full_name']),$object->stripper($_POST['email']),$object->stripper($_POST['username']),$object->stripper($_POST['password']),$object->stripper($_POST['companyname']),$object->stripper($_POST['timezone']),$object->stripper($_POST['metropolitian_list']),date('Y:m:d H:i:s'),'0');
			$QryinsertMemInfo=$object->ExecuteQuery($insertMemInfo);
			$msg="added";
		
}	if($QryinsertMemInfo)
	{
			$from="info@adtingo.com";
			$to=$_POST['email'];
			$link=$setpath."/activate.php?clientID=".base64_encode($QryinsertMemInfo);
			$sub="Adtingo Email Confirmation";
			$fileName = "templates/account_new_confirmation.html";	
			if(file_exists($fileName))
			{
				$emailText = file_get_contents($fileName); 
				
			}
			$htmMsg = nl2br($_POST['full_name']);
			$htmMsg1 = nl2br($_POST['email']);
			$htmMsg2 = nl2br($link);
			$htmMsg3 = nl2br($_POST['username']);
			$htmMsg4 = nl2br($_POST['password']);
			$mailMessage = str_replace("#MESSAGE#", "$htmMsg", "$emailText");
			$mailMessage = str_replace("#EMAIL#", "$htmMsg1", "$mailMessage");
			$mailMessage = str_replace("#CONFIRMLINK#", "$htmMsg2", "$mailMessage");
			$mailMessage = str_replace("#USERNAME#", "$htmMsg3", "$mailMessage");
			$mailMessage = str_replace("#PASSWORD#", "$htmMsg4", "$mailMessage");
			 $sendmail=$object->sendmail($to,$from,$sub,$mailMessage);
			if($sendmail)
			{					
				header("Location:login.php?msg=$msg");
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
    <h1>Registration</h1>
     
  </div>
</div>
<!-- banner end-->

<!--body start-->
 <div class="resigtration-body">
 
        <div class="forget-account">   
            <div class="forget-account-top"></div>
             <div class="forget-account-content"> 
             <form action="" method="post" id="form-sign-up" name="signupform" onsubmit="return validateprofilefrm_admin();">
          <input type="hidden" name="emailerr" />
<input type="hidden" name="usererr" />
              <h4>Setup your account</h4>
               <div class="required"><div class="red">*</div>required</div>
              <p class="p-left60">Please use a valid email address, you’ll need to verify it 
                before you can send any campaigns.</p>
              <dl class="form-lfa">
              
               <dt>Full Name<div class="red">*</div></dt>
                <dd><input   name="full_name" id="full_name"  type="text"/></dd>
                
                <dt>Email Address<div class="red">*</div></dt>
                <dd><input   name="email" id="email"  type="text" onblur="javascript:emailcheck();"/></dd>
                
                <dt>Username<div class="red">*</div></dt>
                <dd><input   name="username" id="username"  type="text" onblur="javascript:usernamechk();"/></dd>
                
                <dt>Password<div class="red">*</div></dt>
                <dd><input   name="password" id="password"  type="password"/></dd>
                
                <dt>Company Name<div class="red">*</div></dt>
                <dd><input   name="companyname" id="companyname"  type="text"/></dd>
                
                <dt> Timezone <div class="red">*</div>  </dt>
                <dd><select name="timezone" id="timezone"  >
               <option value="" >Select Time Zone </option>
			  <?php
							echo Timezone_info_data();
		 		  ?>
            </select></dd>
                
                <dt>Metropolitan Area<div class="red">*</div></dt>
                <dd><select name="metropolitian_list" id="metropolitian_list">
							   <option value="">Select  Metropolitian Area</option>
         			 <?php 
		  					$mainobj=new main;
							
							  echo $mainobj->GetAllMetropolitianList('');
		  			 ?>	 </select></dd>
                <dt> </dt>
                <dd><input src="images/btn_create-my-account.png" name="submit" id="submit" value="submit"  type="image"/></dd>
            </dl>
          <input name="refererURL" value="" type="hidden"/>  <input name="AddClient" value="AddClient" type="hidden"/>
          <input name="dateOfFirstVisit" value="" type="hidden"/>
          <input name="landingPage" value="" type="hidden"/>
          <input name="signupVar" value="" type="hidden"/>
		</form>
             
              </div>        
         <div class="forget-account-bottom"></div>      
        </div> 
        
</div>
<!--body end-->


<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>