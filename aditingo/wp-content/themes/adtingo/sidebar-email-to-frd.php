<?php
get_header(); 
if($_REQUEST['cid']!="")
{
	$CampaignID=base64_decode($_REQUEST['cid']);
	$GetDataFromId=mysql_query("select * from `campaign_posts` tab1, `wp_posts` tab2 where tab1.campaign_id='$CampaignID' and tab1.post_id=tab2.ID");
	$cols=mysql_num_rows($GetDataFromId);
	if($cols){
		$ResDataFromId=mysql_fetch_array($GetDataFromId);
		$url="http://adtingo.com/".$ResDataFromId['post_name'];
	}else{
		$err_msg="Invalid Link";
	}
	//echo $url;

}
if($_POST['submit_email_frd']){
	extract($_POST);
	$to=$frd_email_id;
	$subject = "Email From Adtingo";
	
	$fileName="";
	$fileName = home_url()."/wp-content/themes/adtingo/templates/emailtofrd.html";	
	if($fileName!=""){
		$emailText = file_get_contents($fileName); 
	}
	//echo $emailText;
	$mailIdSize=explode(",",$frd_email_id);
	//echo $mailIdSize;
	if(sizeof($mailIdSize)>0){
		for($i=0;$i<sizeof($mailIdSize);$i++){
			$htmMsg = nl2br($frd_message);
			$htmMsg1 = nl2br($mailIdSize[$i]);
			$htmMsg2 = nl2br(date('F d, Y'));
			$htmMsg3 =nl2br($url);
			$mailMessage = str_replace("#MESSAGE#", "$htmMsg", "$emailText");
			$mailMessage = str_replace("#FRDEMAIL#", "$htmMsg1", "$mailMessage");
			$mailMessage = str_replace("#DATE#", "$htmMsg2", "$mailMessage");
			$mailMessage = str_replace("#CAMPAIGNLINK#", "$htmMsg3", "$mailMessage");
			
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From:Adtingo.com <info@adtingo.com>" ."\r\n";
			$headers .= 'Reply-To: adtingo <info@adtingo.com>'."\r\n";
			
			if(mail($htmMsg1,$subject,$mailMessage,$headers)){ }
		}
	}else{
		$htmMsg = nl2br($frd_message);
		$htmMsg1 = nl2br($mailIdSize[$i]);
		$htmMsg2 = nl2br(date('F d, Y'));
		$htmMsg3 =nl2br($url);
		$mailMessage = str_replace("#MESSAGE#", "$htmMsg", "$emailText");
		$mailMessage = str_replace("#FRDEMAIL#", "$htmMsg1", "$mailMessage");
		$mailMessage = str_replace("#DATE#", "$htmMsg2", "$mailMessage");
		$mailMessage = str_replace("#CAMPAIGNLINK#", "$htmMsg3", "$mailMessage");
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From:Adtingo.com <info@adtingo.com>" ."\r\n";
		$headers .= 'Reply-To: adtingo <info@adtingo.com>'."\r\n";
		
		if(mail($to,$subject,$mailMessage,$headers)){ }
	}
	
	header("location:".get_page_link(383)."?msg=1");
	exit;
}
?>
<!-- #content -->
<div  class="content-cont-inner">
<!--Left content -->
<div class="content-left">
 <div class="form-title">Email to Friend</div>
<h4 class="skyblue-tit"><strong style="text-transform:uppercase">
<!--ELECTRONICS &amp; GADGETS </strong>\ Article Entry Breadcrumb-->
</strong>
</h4>
<!--<div class="inner-con-left">-->
<div class="clear"></div><br />
<div class="register-form">	
<?php if($err_msg=='') {?>
<form method="post" onsubmit="return email_frd_valid()">
<div align="center" class="errer-mess"><?php if($_GET[msg]=='1') echo "Mail Sent Successfully";?></div><br />
	<dl class="emailtofrd">
    	<dt>Your Friends Email Address </dt>
        <dd><input type="text" id="frd_email_id" name="frd_email_id"><br /><small>(To send to more than one person, separate email addresses with a comma.)</small></dd>
        <dt>Message</dt>
        <dd>
          <textarea name="frd_message" id="frd_message" rows="10" cols="39"></textarea>
        </dd>
		<dt>&nbsp;</dt>
        <dd>&nbsp;</dd>
		<dt>&nbsp;</dt>
        <dd>
          <input type="submit" name="submit_email_frd" class="send-bt" value="Submit" />
        </dd>
	</dl>
</form>
<?php }else{?>
<div align="center" class="errer-mess"><?php echo $err_msg;?></div><br />
<?php }?>
</div>
<!--</div>-->
<div class="clear"></div>
  </div><!--Left content ends-->
<!--right content -->
<?php get_sidebar('adtingo2'); ?>  
<!--right content ends-->
</div>
<?php get_footer(); ?>
