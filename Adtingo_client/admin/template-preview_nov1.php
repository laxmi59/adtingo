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
	
			
		 $desinationurl = nl2br($RecCampaign_info['destination_url']);
		 $campaignHeading = stripslashes($RecCampaign_info['heading']);
		 $campaignSubheading = stripslashes($RecCampaign_info['sub_heading']);
		 $text_content = stripslashes($RecCampaign_info['text_content']);
		 //$Contact_info = nl2br($RecCampaign_info['contact_info']);
		 $Contact_info = nl2br($RecCampaign_info['map_address'].", ".$RecCampaign_info['map_city'].", ".$RecCampaign_info['map_state']);
		 $main_image = nl2br($RecCampaign_info['main_image']);
		 $clickble_image = nl2br($RecCampaign_info['clickble_image']);
		 $twitter_link = nl2br($RecCampaign_info['twitter_link']);
		 $facebook_link = nl2br($RecCampaign_info['facebook_link']);
		 
		  $today = date("F j, Y");
		 $object=new main();
		
		$GetCatName=$object->Getmetropolitianareaname($RecCampaign_Seg_list_info['area_list']);
		  
		  $localdealtitle = stripslashes($GetTemplateinfoRec['Title']);
		  $localdealdesc = stripslashes($GetTemplateinfoRec['Description']);
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
			
		  $Linkname1 = stripslashes($GetTemplateinfoRec['linkname1']);
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
		  $linkUrl10 = stripslashes($GetTemplateinfoRec['link_url10']);
		 
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
			$mailMessage = str_replace("#HEADING#", "$campaignHeading", "$mailMessage");
			$mailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$mailMessage");
			$mailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$mailMessage"); 
			$mailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$mailMessage");
			$mailMessage = str_replace("#MAINIMAGE#", "$main_image", "$mailMessage");
			$mailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$mailMessage");
			$mailMessage = str_replace("#TWITTERLINK#", "$twitter_link1", "$mailMessage");
			$mailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link1", "$mailMessage");
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
			
		if($Linkname1<>''){ 
			$mailMessage = str_replace("#LINKNAME1#", "$Linkname1", "$mailMessage"); 
			$mailMessage = str_replace("#LINKSAPARATION1#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME1#", "", "$mailMessage"); 
			$mailMessage = str_replace("#LINKSAPARATION1#", "", "$mailMessage");
		}
		if($Linkname2<>''){
			$mailMessage = str_replace("#LINKNAME2#", "$Linkname2", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION2#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME2#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION2#", "", "$mailMessage");
		}
		if($Linkname3<>''){
			$mailMessage = str_replace("#LINKNAME3#", "$Linkname3", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION3#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME3#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION3#", "", "$mailMessage");
		}
		if($Linkname4<>''){
			$mailMessage = str_replace("#LINKNAME4#", "$Linkname4", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION4#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME4#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION4#", "", "$mailMessage");
		}
		if($Linkname5<>''){
			$mailMessage = str_replace("#LINKNAME5#", "$Linkname5", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION5#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME5#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION5#", "", "$mailMessage");
		}
		if($Linkname6<>''){
			$mailMessage = str_replace("#LINKNAME6#", "$Linkname6", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION6#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME6#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION6#", "", "$mailMessage");
		}if($Linkname7<>''){
			$mailMessage = str_replace("#LINKNAME7#", "$Linkname7", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION7#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME7#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION7#", "", "$mailMessage");
		}
		if($Linkname8<>''){
			$mailMessage = str_replace("#LINKNAME8#", "$Linkname8", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION8#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME8#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION8#", "", "$mailMessage");
		}
		if($Linkname9<>''){
			$mailMessage = str_replace("#LINKNAME9#", "$Linkname9", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION9#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME9#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION9#", "", "$mailMessage");
		}
		if($Linkname10<>''){
			$mailMessage = str_replace("#LINKNAME10#", "$Linkname10", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION10#", "|", "$mailMessage");
		}else{
			$mailMessage = str_replace("#LINKNAME10#", "", "$mailMessage");
			$mailMessage = str_replace("#LINKSAPARATION10#", "", "$mailMessage");
		}
			
			$mailMessage = str_replace("#LINKURL1#", "$linkUrl1", "$mailMessage"); 
			$mailMessage = str_replace("#LINKURL2#", "$linkUrl2", "$mailMessage");
			$mailMessage = str_replace("#LINKURL3#", "$linkUrl3", "$mailMessage");
			$mailMessage = str_replace("#LINKURL4#", "$linkUrl4", "$mailMessage");
			$mailMessage = str_replace("#LINKURL5#", "$linkUrl5", "$mailMessage");
			$mailMessage = str_replace("#LINKURL6#", "$linkUrl6", "$mailMessage");
			$mailMessage = str_replace("#LINKURL7#", "$linkUrl7", "$mailMessage");
			$mailMessage = str_replace("#LINKURL8#", "$linkUrl8", "$mailMessage");
			$mailMessage = str_replace("#LINKURL9#", "$linkUrl9", "$mailMessage");
			$mailMessage = str_replace("#LINKURL10#", "$linkUrl10", "$mailMessage");
			
if($_POST['submitproduct']!="")
{
	 $GETMessRes="update tbl_campaigns set status=5 where campaign_id=".$CampaignID."";
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