<?php 
$nav=12;
include('includes/header.php'); 
//include_once('includes/functions.php'); 
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
	$GetTemplateinfoQry=$object->ExecuteQuery($GetTemplateinfoSql);
	$GetTemplateinfoRec=$object->FetchArray($GetTemplateinfoQry);
	
	 	$Header_fileName = "http://clients.adtingo.com/Campaign_templates/Campaign_template1/header.html";
	    $Content_fileName = "http://clients.adtingo.com/Campaign_templates/Campaign_template1/".$GetTemplateinfoRec[new_temp]."";
	    $Footer_fileName = "http://clients.adtingo.com/Campaign_templates/Campaign_template1/footer.html";
	
		$Total_email_template="";
			if($Header_fileName!="")
			{
			
				 $Total_email_template = file_get_contents($Header_fileName); 
				
			}
			if($Content_fileName!="")
			{
				$Total_email_template .= file_get_contents($Content_fileName); 
				
			}
			if($Footer_fileName!="")
			{
				$Total_email_template .= file_get_contents($Footer_fileName); 
				
			}
	
			
		/* if($RecCampaign_info['template_selection']==3 ||$RecCampaign_info['template_selection']==4){
			 $logolink="logoclient-citygridmedia.jpg";

		 }elseif($RecCampaign_info['template_selection']==5 || $RecCampaign_info['template_selection']==6){
			$logolink="logoclient-tablethotels.jpg";
		 }else{
			$logolink='';
		 }*/
		 $desinationurl = nl2br($RecCampaign_info['destination_url']);
		 $desinationdisp = $RecCampaign_info['websiteurl'];
		 $campaignHeading = stripslashes($RecCampaign_info['heading']);
		 $campaignSubheading = stripslashes($RecCampaign_info['sub_heading']);
		 $text_content = stripslashes($RecCampaign_info['text_content']);
		 //$Contact_info = nl2br($RecCampaign_info['contact_info']);
		 //$Contact_info = nl2br($RecCampaign_info['map_address'].", ".$RecCampaign_info['map_city'].", ".$RecCampaign_info['map_state']);
		if($RecCampaign_info['map_address']<>'')$Contact_info1 .=$RecCampaign_info['map_address'].",";
		if($RecCampaign_info['map_apt']<>'')$Contact_info1 .=$RecCampaign_info['map_apt'].",";
		if($RecCampaign_info['map_city']<>'')$Contact_info1 .=$RecCampaign_info['map_city'].",";
		if($RecCampaign_info['map_state']<>'')$Contact_info1 .=$RecCampaign_info['map_state'].",";
		if($RecCampaign_info['map_zipcode']<>'')$Contact_info1 .=$RecCampaign_info['map_zipcode'];
		
		$Contact_info = nl2br($Contact_info1);
		 $main_image = nl2br($RecCampaign_info['main_image']);
		 //$clickble_image = nl2br($RecCampaign_info['clickble_image']);
		 $clickble_image = nl2br($RecLocalDoGoders['img']);
		 $twitter_link = nl2br($RecCampaign_info['twitter_link']);
		 $facebook_link = nl2br($RecCampaign_info['facebook_link']);
		 
		  $today = date("F j, Y");
		 $object=new main();
		
		$GetCatName=$object->Getmetropolitianareaname($RecCampaign_Seg_list_info['area_list']);
		  
		  //$localdealtitle = stripslashes($GetTemplateinfoRec['Title']);
		  //$localdealdesc = stripslashes($GetTemplateinfoRec['Description']);
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
		
		  		 
			$mailMessage = str_replace("#DESTURL#", "$desinationurl1", "$Total_email_template");
			//$mailMessage = str_replace("#DESTDISP#", "$desinationdisp", "$mailMessage");
			$mailMessage = str_replace("#HEADING#", "$campaignHeading", "$mailMessage");
			$mailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$mailMessage");
			$mailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$mailMessage"); 
			$mailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$mailMessage");
			$mailMessage = str_replace("#MAINIMAGE#", "$main_image", "$mailMessage");
			$mailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$mailMessage");
			$mailMessage = str_replace("#CLICKBLELINK#", "$localdeallink", "$mailMessage");
			$mailMessage = str_replace("#TWITTERLINK#", "$twitter_link1", "$mailMessage");
			$mailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link1", "$mailMessage");
			//$mailMessage = str_replace("#LOGOLINK#", "$logolink", "$mailMessage");
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
			
		
			
if($_POST['submitproduct']!="")
{
	 $GETMessRes="update tbl_campaigns set status=5, created_by=1 where campaign_id=".$CampaignID."";
	//$GETMessResqry=mysql_query($GETMessRes);
	$GETMessResqry=$object->ExecuteQuery($GETMessRes);
	$message="del";
	if($GETMessResqry)
	{
	
		header("Location:manage_Campaigns_list2.php?mes=added&uid=".$RecCampaign_info['clientid']."");
		exit;
	}
}			
			
}

?>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
            <thead>
              
              <tr>
                <td width="83%" height="100" align="left" class="tr5">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">                  
                  <tr>
                    <td height="20" align="left" class="content-header">Campaign Information</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>  <form  action="" method="post">  
				<input type="hidden" name="cid" value="<?php echo $_REQUEST['cid'];?>" />

                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="right">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" align="left" class="form-headings"><?php echo $title;?> </td>
                    </tr>
                    
                    <tr>
                      <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                        <thead>
                          
                          
                          <tr>
                            <td width="12%" align="center" class="tr2"><table width="620" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="23%" height="10" align="left"></td>
                                <td width="76%" height="10" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left" class="table-tab">Campaign Preview</td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"><?php 
echo $mailMessage;
?></td>
                              </tr>
                              
                              
                              <tr>
                                <td height="6" colspan="2" align="left"></td>
                                </tr>
                              <tr>
                                <td height="30" colspan="2" align="center"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><a href="add-own-template.php?Val=<?php echo base64_encode("id");?>&amp;cid=<?php echo base64_encode($CampaignID);?>"></a>
									<input type="button" name="button" id="button" value="back" class="button" onclick="javascript:window.location='add-own-template.php?Val=<?php echo base64_encode("id");?>&amp;cid=<?php echo base64_encode($CampaignID);?>'" />
									</td>
                                    <td>&nbsp;</td>
                                    <td>
                                      <input type="submit" value="Next" id="submit" class="button" name="submitproduct" />
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>                           <input type="submit" name="submitproduct" id="submit" value="approve" class="button" />
                                    </td>
                                  </tr>
                                </table></td>
                                </tr>
                            </table>
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></form></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
	 
     <?php include('includes/footer.php'); ?>