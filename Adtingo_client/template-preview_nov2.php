<?php
include_once('includes/session.php'); 
include_once('includes/functions.php'); 
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
	
	
		$SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation
		where campaign_id=".$CampaignID; 
		//echo $SqlCampaign_Seg_list_info;
		$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
		 $object->NumRows($ResCampaign_Seg_list_info);
		$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);
		
	$getLocalDoGoders="select * from `tbl_catart` where cat_id='".$RecCampaign_Seg_list_info['area_list']."' and `primary_cat` ='on'";
	//echo $getLocalDoGoders;
	$ResLocalDoGoders=$object->ExecuteQuery($getLocalDoGoders);
	$RecLocalDoGoders=$object->FetchArray($ResLocalDoGoders);
	
	if($RecCampaign_info['template_selection']=='1')
		{
		$fileName = "Campaign_templates/Campaign_template1/template1.html";
		$TempID =1;
		}
		else if($RecCampaign_info['template_selection']=='2')
		{
			$TempID =2;
		  $fileName = "Campaign_templates/Campaign_template2/template2.html";
		}
		
	  $GetTemplateinfoSql="select * from tbl_email_template_content where TemplateId=".$TempID ; 
	$GetTemplateinfoQry=$object->ExecuteQuery($GetTemplateinfoSql);
	$GetTemplateinfoRec=$object->FetchArray($GetTemplateinfoQry);
	
	
	
		
			if(file_exists($fileName))
			{
				$emailText = file_get_contents($fileName); 
				
			}
		 $desinationurl = nl2br($RecCampaign_info['destination_url']);
		 $desinationdisp = $RecCampaign_info['websiteurl'];
		 //echo $desinationdisp;
		 $campaignHeading = stripslashes($RecCampaign_info['heading']);
		 $campaignSubheading = stripslashes($RecCampaign_info['sub_heading']);
		 $text_content = stripslashes($RecCampaign_info['text_content']);
		// $Contact_info = nl2br($RecCampaign_info['contact_info']);
		if($RecCampaign_info['map_address']<>'')$Contact_info1 .=$RecCampaign_info['map_address'].",";
		elseif($RecCampaign_info['map_apt']<>'')$Contact_info1 .=$RecCampaign_info['map_apt'].",";
		elseif($RecCampaign_info['map_city']<>'')$Contact_info1 .=$RecCampaign_info['map_city'].",";
		elseif($RecCampaign_info['map_state']<>'')$Contact_info1 .=$RecCampaign_info['map_state'].",";
		elseif($RecCampaign_info['map_zipcode']<>'')$Contact_info1 .=$RecCampaign_info['map_zipcode'];
		
		$Contact_info = nl2br($Contact_info1);
		 $main_image = nl2br($RecCampaign_info['main_image']);
		// $clickble_image = nl2br($RecCampaign_info['clickble_image']);
		$clickble_image = nl2br($RecLocalDoGoders['img']);
		 $twitter_link = nl2br($RecCampaign_info['twitter_link']);
		 $facebook_link = nl2br($RecCampaign_info['facebook_link']);
		 
		  $today = date("F j, Y");
		 $object=new main();
		
		$GetCatName=$object->Getmetropolitianareaname($RecCampaign_Seg_list_info['area_list']);
		  
		 // $localdealtitle = stripslashes($GetTemplateinfoRec['Title']);
		 // $localdealdesc = stripslashes($GetTemplateinfoRec['Description']);
		 $localdeallink = stripslashes($RecLocalDoGoders['url']);
		  $localdealtitle = stripslashes($RecLocalDoGoders['title']);
		  $localdealdesc = stripslashes(substr($RecLocalDoGoders['desc'],0,100));
		  if($GetTemplateinfoRec['paragraph1']!="")
		  $listofthinks_to_come1 = "<li>".stripslashes($GetTemplateinfoRec['paragraph1'])."</li>";
		  if($GetTemplateinfoRec['paragraph2']!="")	    
		  $listofthinks_to_come2 = "<li>".stripslashes($GetTemplateinfoRec['paragraph2'])."</li>";	
		  if($GetTemplateinfoRec['paragraph3']!="")
		  $listofthinks_to_come3 = "<li>".stripslashes($GetTemplateinfoRec['paragraph3'])."</li>";
		  if($GetTemplateinfoRec['paragraph4']!="")	
		  $listofthinks_to_come4 = "<li>".stripslashes($GetTemplateinfoRec['paragraph4'])."</li>";
		  if($GetTemplateinfoRec['paragraph5']!="")	
		  $listofthinks_to_come5 = "<li>".stripslashes($GetTemplateinfoRec['paragraph5'])."</li>";
		  if($GetTemplateinfoRec['paragraph6']!="")		    
		  $listofthinks_to_come6 = "<li>".stripslashes($GetTemplateinfoRec['paragraph6'])."</li>";
		  if($GetTemplateinfoRec['paragraph7']!="")	
		  $listofthinks_to_come7 = "<li>".stripslashes($GetTemplateinfoRec['paragraph7'])."</li>";	
			
		  /*$Linkname1 = stripslashes($GetTemplateinfoRec['linkname1']);
		  $Linkname2 = stripslashes($GetTemplateinfoRec['linkname2']);
		  $Linkname3 = stripslashes($GetTemplateinfoRec['linkname3']);
		  $Linkname4 = stripslashes($GetTemplateinfoRec['linkname4']);
		  $Linkname5 = stripslashes($GetTemplateinfoRec['linkname5']);
		  $Linkname6 = stripslashes($GetTemplateinfoRec['linkname6']);
		  $Linkname7 = stripslashes($GetTemplateinfoRec['linkname7']);
		  $Linkname8 = stripslashes($GetTemplateinfoRec['linkname8']);
		  $Linkname9 = stripslashes($GetTemplateinfoRec['linkname9']);
		  $Linkname10 = stripslashes($GetTemplateinfoRec['linkname10']);
		  
		  $linkUrl1 = stripslashes($GetTemplateinfoRec['link_url1']);
		  $linkUrl2 = stripslashes($GetTemplateinfoRec['link_url2']);
		  $linkUrl3 = stripslashes($GetTemplateinfoRec['link_url3']);
		  $linkUrl4 = stripslashes($GetTemplateinfoRec['link_url4']);
		  $linkUrl5 = stripslashes($GetTemplateinfoRec['link_url5']);
		  $linkUrl6 = stripslashes($GetTemplateinfoRec['link_url6']);
		  $linkUrl7 = stripslashes($GetTemplateinfoRec['link_url7']);
		  $linkUrl8 = stripslashes($GetTemplateinfoRec['link_url8']);
		  $linkUrl9 = stripslashes($GetTemplateinfoRec['link_url9']);
		  $linkUrl10 = stripslashes($GetTemplateinfoRec['link_url10']);*/
		 
		  	$mailMessage = str_replace("#DESTDISP#", "$desinationdisp", "$emailText");
			$mailMessage = str_replace("#DESTURL#", "$desinationurl", "$mailMessage");
			$mailMessage = str_replace("#HEADING#", "$campaignHeading", "$mailMessage");
			$mailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$mailMessage");
			$mailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$mailMessage"); 
			$mailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$mailMessage");
			$mailMessage = str_replace("#MAINIMAGE#", "$main_image", "$mailMessage");
			$mailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$mailMessage");
			$mailMessage = str_replace("#CLICKBLELINK#", "$localdeallink", "$mailMessage");
			$mailMessage = str_replace("#TWITTERLINK#", "$twitter_link", "$mailMessage");
			$mailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link", "$mailMessage");
			$mailMessage = str_replace("#DATECREATED#", "$today", "$mailMessage"); 
		    $mailMessage = str_replace("#CATEGORYNAME#", "$GetCatName", "$mailMessage");    
			
			
			$mailMessage = str_replace("#TITLE#", "$localdealtitle", "$mailMessage");
			$mailMessage = str_replace("#LOCALDESCRIPTION#", "$localdealdesc", "$mailMessage");
			
			$mailMessage = str_replace("#PARAGRAPH1#", "$listofthinks_to_come1", "$mailMessage"); 
			$mailMessage = str_replace("#PARAGRAPH2#", "$listofthinks_to_come2", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH3#", "$listofthinks_to_come3", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH4#", "$listofthinks_to_come4", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH5#", "$listofthinks_to_come5", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH6#", "$listofthinks_to_come6", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH7#", "$listofthinks_to_come7", "$mailMessage");
			
			/*$mailMessage = str_replace("#LINKNAME1#", "$Linkname1", "$mailMessage"); 
			$mailMessage = str_replace("#LINKNAME2#", "$Linkname2", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME3#", "$Linkname3", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME4#", "$Linkname4", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME5#", "$Linkname5", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME6#", "$Linkname6", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME7#", "$Linkname7", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME8#", "$Linkname8", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME9#", "$Linkname9", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME10#", "$Linkname10", "$mailMessage");
			
			$mailMessage = str_replace("#LINKURL1#", "$linkUrl1", "$mailMessage"); 
			$mailMessage = str_replace("#LINKURL2#", "$linkUrl2", "$mailMessage");
			$mailMessage = str_replace("#LINKURL3#", "$linkUrl3", "$mailMessage");
			$mailMessage = str_replace("#LINKURL4#", "$linkUrl4", "$mailMessage");
			$mailMessage = str_replace("#LINKURL5#", "$linkUrl5", "$mailMessage");
			$mailMessage = str_replace("#LINKURL6#", "$linkUrl6", "$mailMessage");
			$mailMessage = str_replace("#LINKURL7#", "$linkUrl7", "$mailMessage");
			$mailMessage = str_replace("#LINKURL8#", "$linkUrl8", "$mailMessage");
			$mailMessage = str_replace("#LINKURL9#", "$linkUrl9", "$mailMessage");
			$mailMessage = str_replace("#LINKURL10#", "$linkUrl10", "$mailMessage");*/
			
			
			
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
 
      <form  action="template_preview_send.php" method="post">                              
            <div class="grey-box">
            <h3 class="grad-box">Campaign Preview</h3>
            	<div class="my-template">
				
<?php 
echo $mailMessage;
?>
             <input type="hidden" name="campid" value="<?php $mailMessage;?>" />
			 <input type="hidden" name="camid" value="<?php echo $CampaignID;?>" />
             
    		</div>
             </div>

         <!-- <a href="add-own-template.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" /><a href="payment-gateway.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>"><img class="m-left5" src="images/approve-bt.gif" alt="Approve"/></a>-->
		 <a href="add-own-template.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" /><!--<a href="payment-gateway.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>"><img class="m-left5" src="images/approve-bt.gif" alt="Approve"/></a>-->
		  <input src="images/approve-bt.gif"  type="image" name="steppreview_x" id="steppreview_x" />

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
