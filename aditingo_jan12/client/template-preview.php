<?php 
error_reporting(0);
include_once('includes/functions.php'); 
//include('includes/dbfiler.php'); 
include_once('includes/values.php'); 
$object=new main();
$Num_cols="0";
if($_REQUEST['cid']!="")
{
	$CampaignID=base64_decode($_REQUEST['cid']);
  	 $SqlCampaign_info="select * from tbl_campaigns where campaign_id=".$CampaignID ; 
	$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
	 $Num_cols=$object->NumRows($ResCampaign_info);
	$RecCampaign_info=$object->FetchArray($ResCampaign_info);
		if($RecCampaign_info['template_selection']=='1')
		$fileName = "Campaign_templates/Campaign_template1/template1.html";
		else if($RecCampaign_info['template_selection']=='2')
		  $fileName = "Campaign_templates/Campaign_template2/template2.html";

			if(file_exists($fileName))
		{
			$emailText = file_get_contents($fileName); 
			
		}
		 $desinationurl = nl2br($RecCampaign_info['destination_url']);
		 $campaignHeading = nl2br($RecCampaign_info['heading']);
		 $campaignSubheading = nl2br($RecCampaign_info['sub_heading']);
		 $text_content = nl2br($RecCampaign_info['text_content']);
		 $Contact_info = nl2br($RecCampaign_info['contact_info']);
		 $main_image = nl2br($RecCampaign_info['main_image']);
		 $clickble_image = nl2br($RecCampaign_info['clickble_image']);
		 $twitter_link = nl2br($RecCampaign_info['twitter_link']);
		 $facebook_link = nl2br($RecCampaign_info['facebook_link']);
		 
			 $mailMessage = str_replace("#DESTURL#", "$desinationurl", "$emailText");
			$mailMessage = str_replace("#HEADING#", "$campaignHeading", "$mailMessage");
			$mailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$mailMessage");
			$mailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$mailMessage"); 
			$mailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$mailMessage");
			$mailMessage = str_replace("#MAINIMAGE#", "$main_image", "$mailMessage");
			$mailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$mailMessage");
			$mailMessage = str_replace("#TWITTERLINK#", "$twitter_link", "$mailMessage");
			$mailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link", "$mailMessage");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Account Settings | Campaign Monitor</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
</head>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Campaign Information</h2><img src="images/step3.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="payment-gateway.php" method="post">                              
            <div class="grey-box">
            <h3 class="grad-box">Campaign Preview</h3>
            	<div class="my-template">
				
<?php 
echo $mailMessage;
?>
             
             
    		</div>
             </div>

          <a href="add-own-template.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" /><a href="payment-gateway.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>"><img class="m-left5" src="images/approve-bt.gif" alt="Approve"/></a>

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
