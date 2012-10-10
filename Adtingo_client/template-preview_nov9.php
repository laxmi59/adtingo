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
		$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
		 $object->NumRows($ResCampaign_Seg_list_info);
		$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);
		
		$getLocalDoGoders="select * from `tbl_catart` where cat_id='".$RecCampaign_Seg_list_info['area_list']."' and `primary_cat` ='on'";
	//echo $getLocalDoGoders;
	$ResLocalDoGoders=$object->ExecuteQuery($getLocalDoGoders);
	$RecLocalDoGoders=$object->FetchArray($ResLocalDoGoders);
		
	  $GetTemplateinfoSql="select * from tbl_email_template_content where TId=".$RecCampaign_info['template_selection'].""; 
	  //echo $GetTemplateinfoSql;
	$GetTemplateinfoQry=$object->ExecuteQuery($GetTemplateinfoSql);
	$GetTemplateinfoRec=$object->FetchArray($GetTemplateinfoQry);
	
	 $Header_fileName = "Campaign_templates/Campaign_template1/header.html";
	  $Content_fileName = "Campaign_templates/Campaign_template1/".$GetTemplateinfoRec[new_temp]."";
	   $Footer_fileName = "Campaign_templates/Campaign_template1/footer.html";
	
		$Total_email_template="";
			if(file_exists($Header_fileName))
			{
				$Total_email_template = file_get_contents($Header_fileName); 
				
			}
			if(file_exists($Content_fileName))
			{
				$Total_email_template .= file_get_contents($Content_fileName); 
				
			}
			if(file_exists($Footer_fileName))
			{
				$Total_email_template .= file_get_contents($Footer_fileName); 
				
			}
			
			
		 $desinationurl = nl2br($RecCampaign_info['destination_url']);
		 
		 $campaignHeading = stripslashes($RecCampaign_info['heading']);
		 $campaignSubheading = stripslashes($RecCampaign_info['sub_heading']);
		 $text_content = stripslashes($RecCampaign_info['text_content']);
		 if($RecCampaign_info['map_address']<>'')$Contact_info1 .=$RecCampaign_info['map_address'].",";
		//if($RecCampaign_info['map_apt']<>'')$Contact_info1 .=$RecCampaign_info['map_apt'].",";
		if($RecCampaign_info['map_city']<>'')$Contact_info1 .=$RecCampaign_info['map_city'].",";
		if($RecCampaign_info['map_state']<>'')$Contact_info1 .=$RecCampaign_info['map_state'].",";
		if($RecCampaign_info['map_zipcode']<>'')$Contact_info1 .=$RecCampaign_info['map_zipcode'];
		
		$Contact_info = nl2br($Contact_info1);
		 $main_image = nl2br($RecCampaign_info['main_image']);
		 $clickble_image = nl2br($RecLocalDoGoders['img']);
		 $twitter_link = nl2br($RecCampaign_info['twitter_link']);
		 $facebook_link = nl2br($RecCampaign_info['facebook_link']);
		if($desinationurl!="")
		$desinationurl1="<a href='".$desinationurl."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template2/images/content-buttoncheckitout.jpg' alt='' border='0' width='201' height='36'></a>";
		else
		$desinationurl1="";
		 if($facebook_link!="")
		 $facebook_link1="<a href='".$facebook_link."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-facebookicon.jpg' alt='' width='16' height='24' border='0'></a>";		
		 else
		 $facebook_link1="";
		
		 
		 if($twitter_link!="")
		 $twitter_link1="<a href='".$twitter_link."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-twittericon.jpg' alt='' width='16' height='24' border='0'></a>";
		 else
		 $twitter_link1="";
	
		
		$twitter_share_link='<a href="http://twitter.com/share?url=http://twitter.com/adtingo" target="_blank"><img src="http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-buttonretweet.jpg" alt="" border="0" width="95" height="30"></a>';
		 $facebook_share_link='<a href="http://www.facebook.com/sharer.php?u=http://www.facebook.com/pages/Adtingo/160563510636133" target="_blank">
<img src="http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-buttonfbshare.jpg" alt="" border="0" width="95" height="30"></a>';
		
		  $today = date("F j, Y");
		 $object=new main();
		
		$GetCatName=$object->Getmetropolitianareaname($RecCampaign_Seg_list_info['area_list']);
		  
		
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
			
		 
			 $mailMessage = str_replace("#DESTURL#", "$desinationurl1", "$Total_email_template");
			$mailMessage = str_replace("#HEADING#", "$campaignHeading", "$mailMessage");
			$mailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$mailMessage");
			$mailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$mailMessage"); 
			$mailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$mailMessage");
			$mailMessage = str_replace("#MAINIMAGE#", "$main_image", "$mailMessage");
			$mailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$mailMessage");
			$mailMessage = str_replace("#CLICKBLELINK#", "$localdeallink", "$mailMessage");
			$mailMessage = str_replace("#TWITTERLINK#", "$twitter_link1", "$mailMessage");
			$mailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link1", "$mailMessage");
		    $mailMessage = str_replace("#DATECREATED#", "$today", "$mailMessage"); 
			$mailMessage = str_replace("#CATEGORYNAME#", "$GetCatName", "$mailMessage");
			    
			$mailMessage = str_replace("#TWITTERSHARELINK#", "$twitter_share_link", "$mailMessage");  
			$mailMessage = str_replace("#FACEBOOKSHARELINK#", "$facebook_share_link", "$mailMessage");  
			
			
			$mailMessage = str_replace("#TITLE#", "$localdealtitle", "$mailMessage");
			$mailMessage = str_replace("#LOCALDESCRIPTION#", "$localdealdesc", "$mailMessage");
			
			$mailMessage = str_replace("#PARAGRAPH1#", "$listofthinks_to_come1", "$mailMessage"); 
			$mailMessage = str_replace("#PARAGRAPH2#", "$listofthinks_to_come2", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH3#", "$listofthinks_to_come3", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH4#", "$listofthinks_to_come4", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH5#", "$listofthinks_to_come5", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH6#", "$listofthinks_to_come6", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH7#", "$listofthinks_to_come7", "$mailMessage");
			
	
}

if(isset($_POST['steppreview_x_x'])){
	//print_r($_POST);
	$getClient="select * from `tbl_billing_details` where clientid='".$_SESSION['clientid']."'";
	$ClientExecute=$object->ExecuteQuery($getClient);
	$ClientFetch=$object->FetchArray($ClientExecute);
	if($ClientFetch['CCTypeID']=='' || $ClientFetch['CCNo']=='' || $ClientFetch['CCExpMon']=='' || $ClientFetch['CCExpYear']=='' || 	$ClientFetch['CCName']=='' || $ClientFetch['CCVNo']==''){
		header("location:payment-gateway.php");
		exit;
	}else{		
			header("location:campaign_confirmation.php?cid=".base64_encode($CampaignID)."");
			exit;
		
	}
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
 
      <form action="" method="post" >                              
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
          <a href="add-own-template.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" name="steppreview_x" />
		  <input src="images/approve-bt.gif"  type="image" name="steppreview_x" id="steppreview_x" />
		 

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
