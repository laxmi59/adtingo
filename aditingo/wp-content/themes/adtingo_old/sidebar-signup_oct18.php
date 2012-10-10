<?php 
$rec=array();
$object=new main();

if($_POST['but']!='')
{
	//print_r($_POST);
	$error_mess='Please enter';

	unset($_SESSION['metroIds']);
	unset($_SESSION['Memberid']);
	if($_POST['email']=='')
	{
		$error_mess.=' Email';
	
	}
	if($_POST['metroIds']=='')
	{
		$error_mess.=', Metropolitan Area';
	
	}
	if($_POST['email']!='' && $_POST['metroIds']!='')
	{
		$SqlGetUserDetails=sprintf("select * FROM tbl_members  where email_address='%s'",$object->stripper($_POST['email']));
		$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
		$numrows=$object->NumRows($QryGetUserDetails);
		
		
		if($numrows>0)
		{
			$error_mess='Email already exists';
		
		}
		else
		{
			session_start();
			
    		$length = 6;
    		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    		$string = '';    

    		for ($p = 0; $p < $length; $p++) {
				$string .= $characters[mt_rand(0, strlen($characters))];
    		}
			$date=date("Y:m:d H:i:s");	
			$insert=mysql_query("insert into `tbl_members` (`email_address`, `password`, `zipcode`, `date_created`, `status`) values ('".$_POST[email]."', '".$string."', '".$_POST[zipcode]."', '$date','1')");
			if($insert){
				$memberid=mysql_insert_id();
				
			$_SESSION['Memberid']=$memberid;
			$_SESSION['metroIds']=$_POST['metroIds'];
				$metroIds=$_POST['metroIds'];
				$metroIds=substr($metroIds,0,-1);
				$metroIds_array=explode(":",$metroIds);
				for($i=0;$i<count($metroIds_array);$i++){
					 $metroIds_array[$i];
					 $insertMetroInfo=sprintf("insert into tbl_member_metropolitian(area_id,memberid) values (%d,%d)",$metroIds_array[$i],$memberid);
					 $QryinsertMetroInfo=$object->ExecuteQuery($insertMetroInfo);
				}	
				$to=$_POST[email];
				$subject = "Membership Confirmation Mail From Adtingo";
				
				$fileName = "wp-content/themes/adtingo/templates/member_welcome_template.html";		
				if(file_exists($fileName))
				{
					$emailText = file_get_contents($fileName); 
				
				}
				//echo $emailText;
				$htmMsg = nl2br($_POST['email']);
				$htmMsg1 = nl2br($string);
				$htmMsg2 = nl2br(date('F d, Y'));
				$mailMessage = str_replace("#EMAIL#", "$htmMsg", $emailText);
				$mailMessage = str_replace("#PASSWORD#", "$htmMsg1", $mailMessage);
				$mailMessage = str_replace("#DATE#", "$htmMsg2", $mailMessage);
				//echo $mailMessage;		
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:Adtingo.com <info@adtingo.com>" ."\r\n";
				$headers .= 'Reply-To: adtingo <info@adtingo.com>'."\r\n";
				
				if(mail($to,$subject,$mailMessage,$headers)){}
				header("location:".get_page_link(44));
				exit;
			}
		}
	}
}


?>
<div class="content-cont-inner">
<div class="content-left">
    <form onsubmit="return validateformStep1();" method="post" name="registration" action="<?php echo home_url(); ?>/?page_id=19">
      <div id="div-Form">
        <div class="form-title">Create  Profile Step1</div>
        <div class="requiredfields"><span class="red">*</span> Required Fields </div>
        <div class="register-form">
          <div align="center" class="errer-mess2"></div>
          <dl class="form1">
            <dt>Email address <span class="red">*</span></dt>
            <dd>
              <input type="text" onchange="member_emailcheck(this.value,'emailerr');" value="<?=$_POST['email']?>" id="email" class="inputs" name="email">
              <input type="hidden" id="emailerr" name="emailerr">
              <input type="hidden" id="metroIds" name="metroIds">
			  <input type="hidden" name="password" value="<?=mt_rand(10000, 90000)?>" />
            </dd>
			<dt>Zipcode <span class="red">*</span></dt>
            <dd>
              <input type="text" value="<?=$_POST['zipcode']?>" id="zipcode" class="inputs" name="zipcode">
             </dd>
            <dt> Subscriptions List <span class="red">*</span></dt>
            <dd>
              <div class="subscriptions">
                <ul class="subscriptions-fields">
                  <?php
					  $object=new main;
			echo $object->GetmetropolitianareasCheckbox($_REQUEST['mid'],'member');
		   ?>
                </ul>
              </div>
            </dd>
            <dt></dt>
            <dd>
              <input type="submit" value="Next" name="but" class="next-bt">
            </dd>
          </dl>
          <div class="signup"> </div>
        </div>
      </div>
    </form>
  </div>
<?php get_sidebar('adtingo2'); ?>  
</div>