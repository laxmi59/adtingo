<?php
$object=new main(); 
if(isset($_POST['ForGotPwd']) && $_POST['ForGotPwd']!=""){
	$email_address=$_POST['emailaddress'];  
	$SqlGetMembers="select * from tbl_members  where email_address='".$email_address."'"; 
	$QryGetMembers=$object->ExecuteQuery($SqlGetMembers);
	$cols=$object->NumRows($QryGetMembers);
	if($cols>0){
		include(get_template_directory()."/includes/storm.php");
		$GetMembersResult=$object->FetchArray($QryGetMembers);		
		$userid=$GetMembersResult['memberid'];
		$emailaddress=$GetMembersResult['email_address'];
		$to=$emailaddress;
		$subject="Regarding your adtingo Password details";
		$fileName="";
		$fileName = home_url()."/wp-content/themes/adtingo/templates/forgotpassword.html";	
		if($fileName!="")
		{
			$emailText = file_get_contents($fileName); 
		}
		//echo $emailText;
		$htmMsg = nl2br($GetMembersResult['email_address']);
		$htmMsg1 = nl2br($GetMembersResult['email_address']);
		$htmMsg2 = nl2br($GetMembersResult['password']);
		$htmMsg3 = nl2br(date('F d, Y'));
		$mailMessage = str_replace("#MESSAGE#", "$htmMsg", "$emailText");
		$mailMessage = str_replace("#USERNAME#", "$htmMsg1", "$mailMessage");
		$mailMessage = str_replace("#PASSWORD#", "$htmMsg2", "$mailMessage"); 
		$mailMessage = str_replace("#DATE#", "$htmMsg3", "$mailMessage");
		$textContent="";
		// dont change this number..
			$templateId=1467;
		// dont change this number.
		$tt[0] = array("address" => $emailaddress);
			
		$cstb = array("title"=>$subject, "subject"=>$subject, "fromEmail"=>"members@adtingomail.com", "fromName"=>"Adtingo", "toEmail"=>"members@adtingomail.com", "toName"=>"Adtingo", "replyToEmail"=>"reply@adtingomail.com", "replyToName"=>"Adtingo", encoding=>"quoted-printable","Charset"=>"ISO-8859-1", "trackType"=>"ALL", "openTrackType"=>"HTML", "clickStreamType"=>"ALL", "brandID"=>"1","enabled"=>"TRUE" );
		try{
			$cst_res = $soapClient->__call("updateSendTemplateContents", array($templateId,$textContent,$mailMessage));
			$smft_res =  $soapClient->__call("sendMessagesFromTemplate", array($templateId, $tt));
		}catch (SoapFault $fault) {
			$error = "cstb_error";
			echo $fault->faultcode."-".$fault->faultstring;	
		}
		//$subject="Regarding your SoftwareMob Password details";
		/*$from .= "From:adtingo<info@adtingo.com>\n";
		$from .= "Reply-To: adtingo <info@adtingo.com>\n";
		$from  .= "MIME-Version: 1.0\n";
		$from .= "Content-type: text/html; charset=iso-8859-1\n";
		if($mail=mail($to,$sub,$mailMessage,$from))
		{*/
		header("location:".get_page_link(58)."/?msg=1");
		exit;
		
		//}
	}else {
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