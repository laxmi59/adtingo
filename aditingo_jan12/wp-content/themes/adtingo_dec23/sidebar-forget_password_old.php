<?php
$object=new main(); 
if(isset($_POST['ForGotPwd']) && $_POST['ForGotPwd']!="")
{
$email_address=$_POST['emailaddress'];  
 $SqlGetMembers="select * from tbl_members  where email_address='".$email_address."'"; 
$QryGetMembers=$object->ExecuteQuery($SqlGetMembers);
 $cols=$object->NumRows($QryGetMembers);
if($cols>0)
	{
		$GetMembersResult=$object->FetchArray($QryGetMembers);		
		 $userid=$GetMembersResult['memberid'];
		 $emailaddress=$GetMembersResult['email_address'];
		$to=$emailaddress;
		$sub="Regarding your adtingo Password details";
		$fileName="";
		 $fileName = home_url()."/templates/forgotpassword.html";	
		if($fileName!="")
		{
			$emailText = file_get_contents($fileName); 
			
		}
		  $htmMsg = nl2br($GetMembersResult['full_name']);
		 $htmMsg1 = nl2br($GetMembersResult['email_address']);
		 $htmMsg2 = nl2br($GetMembersResult['password']);
		 $mailMessage = str_replace("#MESSAGE#", "$htmMsg", "$emailText");
		$mailMessage = str_replace("#USERNAME#", "$htmMsg1", "$mailMessage");
		 $mailMessage = str_replace("#PASSWORD#", "$htmMsg2", "$mailMessage"); 
		//$subject="Regarding your SoftwareMob Password details";
		$from .= "From:adtingo<info@adtingo.com>\n";
		$from .= "Reply-To: adtingo <info@adtingo.com>\n";
		$from  .= "MIME-Version: 1.0\n";
		$from .= "Content-type: text/html; charset=iso-8859-1\n";
		if($mail=mail($to,$sub,$mailMessage,$from))
		{
		header("location:".get_page_link(58)."/?msg=1");
		exit;
		
		}
	}
	else
	 {
		 header("location:".get_page_link(58)."/?msg=2");
		exit;	
			
	 }
	}
?>

<div class="content-cont-inner">
  <div class="content-left">
    <form name="forgotpwd" id="forgotpwd" action="" method="post" onsubmit="return validatepwd();">
      <div id="div-Form">
        <div class="form-title">Forgot Password</div>
        <div class="login">
          <div class="p-bottom20">To obtain a new password, please enter your e-mail address and a link will be emailed to you.</div>
          <dl class="form1">
            <dt>E-mail address</dt>
            <dd>
              <input type="text" name="emailaddress" id="emailaddress" value="">
            </dd>
            <dt>&nbsp;</dt>
            <dd>
              <input type="submit" name="ForGotPwd" class="send-bt" value="Send" />
            </dd>
          </dl>
        </div>
      </div>
    </form>
  </div>
<?php get_sidebar('adtingo2'); ?>  
</div>