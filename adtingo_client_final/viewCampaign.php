<?php 
include('includes/functions.php'); 
include_once('includes/session.php');
include('includes/values.php'); 
$Num_cols="0";

if($_REQUEST['cid']!="")
{
	$Campaign_ID=base64_decode($_REQUEST['cid']);
	 $SqlCampaign_info="select *,date_format(schedule_date,'%d %b,  %Y') as date from tbl_campaigns where campaign_id=".$Campaign_ID ; 
	$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
	$Num_cols=$object->NumRows($ResCampaign_info);
	$RecCampaign_info=$object->FetchArray($ResCampaign_info);
	
	$SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$Campaign_ID ; 
	$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
	$Num_cols=$object->NumRows($ResCampaign_Seg_list_info);
	$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);
	$object=new main();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."View Campaign Details"?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script type="text/javascript" src="js/javascript.js"></script>
<?php include "includes/google_analytic.php";?>
</head>
<body>
<!--header start-->
<?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
      <div class="title"><h2>View Campaign Details</h2></div> 
 
                                 
            <div class="grey-box">
             
                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10"><img src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="wbg">
        <tr>
          <td align="left" valign="top"><img src="images/box_top_left.gif" width="3" height="3"></td>
          <td align="right" valign="top"><img src="images/box_top_right.gif" width="3" height="3"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td class="wbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/spacer.gif" width="1" height="1"></td>
          <td height="5" valign="top"><img src="images/spacer.gif"></td>
          <td><img src="images/spacer.gif"></td>
        </tr>
        <tr>
          <td width="10">&nbsp;</td>
          <td height="300" valign="top">
            <!-- <form name="loginfrm" method="post" action="<?=$PHP_SELF?>"> -->            <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
              <tr>
                <td>
				
                    <table width="100%"  border="0" cellpadding="1" cellspacing="0" class="border">
                      <tr>
                        <td><table width="100%"  border="0" cellpadding="3" cellspacing="0" class="td">
                            <tr>
                              <td width="100%" colspan="2" align="left" class="h1"></td>
                            </tr>
                          </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="44%" height="10" align="left"></td>
                                <td width="56%" height="10" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left"><strong>Step 1.1 List Segmentation</strong></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Campaign Name </td>
                                <td align="left"><?php echo stripslashes($RecCampaign_info['campaign_name']);?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Subject Line
                                  &nbsp;
                                  &nbsp; </td>
                                <td align="left"><?php echo stripslashes($RecCampaign_info['subject_line']);?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Category
                                  &nbsp;                                  &nbsp;</td>
                                <td align="left"><?php echo $Intrest_and_activitise[$RecCampaign_info['category_option']]; ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Metropolitan Area </td>
                                <td align="left"><?php 
						if($RecCampaign_Seg_list_info['area_list']!="")
						$area_list=$RecCampaign_Seg_list_info['area_list'];
						$object=new main();
						echo $object->Getmetropolitianareaname($area_list);
						?></td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left"><strong>Step 1.2 Delivery</strong></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Campaign Schedule Date</td>
                                <td align="left"><?php if($RecCampaign_info['schedule_date']!="")
				 echo $RecCampaign_info['date'];
				 else
				 echo "N/A";
				 ?>                                </td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left"><strong>Step 1.3 List Segmentation</strong></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Minimum Age </td>
                                <td align="left"><?php if($RecCampaign_Seg_list_info['minimum_age']!="0") { echo $RecCampaign_Seg_list_info['minimum_age'];?>
                                  years
        <?php } else echo "N/A";?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Maximum Age </td>
                                <td align="left"><?php if($RecCampaign_Seg_list_info['maxmum_age']!="0") { echo $RecCampaign_Seg_list_info['maxmum_age'];?>
                                  years
        <?php } else echo "N/A";?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Gender </td>
                                <td align="left"><?php if($RecCampaign_Seg_list_info['gender']=='male')
			  			echo "Male";
						else if($RecCampaign_Seg_list_info['gender']=='female')
			  			echo "Female";
						else if($RecCampaign_Seg_list_info['gender']=='both')
						echo "Both";
						else 
						echo "N/A";
			  ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Income</td>
                                <td align="left"><?php 
			 if($RecCampaign_Seg_list_info['income']!="0")
			 echo $income_array[$RecCampaign_Seg_list_info['income']];
			 else 
			 echo "N/A";
			 ?></td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left" ><strong>Step 1.4 List Segmentation </strong></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Enter Zip Code </td>
                                <td align="left"><?php
			 	if($RecCampaign_Seg_list_info['zipcode']!="")
			  		echo $RecCampaign_Seg_list_info['zipcode'];
			  	else
					echo "N/A";
			  ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> specified radius </td>
                                <td align="left"><?php if($RecCampaign_Seg_list_info['zipcode_miles']!="0") { echo $Zipcode_Radious[$RecCampaign_Seg_list_info['zipcode_miles']];?>
                                  Miles
                                  <?php } else echo "N/A"; ?></td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                              </tr>

                              <tr>
                                <td height="30" colspan="2" align="left"><strong>Step 1.5 List Segmentation </strong></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Send to all </td>
                                <td align="left"><?php
			 		 if($RecCampaign_Seg_list_info['sendall_option']=='1') 
			 			echo "Yes";
					  else if($RecCampaign_Seg_list_info['sendall_option']=='2') 
			 			echo "NO";
					  else
					   echo "N/A"; ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Random Number </td>
                                <td align="left"><?php if($RecCampaign_Seg_list_info['sendall_option']=='2') 
			 echo $RecCampaign_Seg_list_info['random_number'];
			 else
			 echo "N/A";
			 ;?>                                </td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left"><strong>Campaign Creation </strong></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Selected Template </td>
                                <td align="left"><?php 
			  $GetTemplateinfoSql="select * from tbl_email_template_content where TId=".$RecCampaign_info['template_selection'].""; 
			  $GetTemplateinfoQry=$object->ExecuteQuery($GetTemplateinfoSql);
			  $GetTemplateinfoRec=$object->FetchArray($GetTemplateinfoQry);
			if($GetTemplateinfoRec['TemplateName']!="")
			 	echo $GetTemplateinfoRec['TemplateName'];
		    else 	
				echo "N/A"; ?></td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left"><strong>Campaign Information </strong></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Destination URL </td>
                                <td align="left"><?php
					if($RecCampaign_info['destination_url']!="")
					echo $RecCampaign_info['destination_url'];
					else
					echo "N/A";
				 ?>                                </td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Heading </td>
                                <td align="left"><?php
					if($RecCampaign_info['heading']!="")
					echo stripslashes($RecCampaign_info['heading']);
					else
					echo "N/A";
				 ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Sub Heading </td>
                                <td align="left"><?php
					if($RecCampaign_info['sub_heading']!="")
					echo stripslashes($RecCampaign_info['sub_heading']);
					else
					echo "N/A";
				 ?>                                </td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Text content </td>
                                <td align="justify" style="padding-right:5px;"><?php
					if($RecCampaign_info['text_content']!="")
					echo stripslashes($RecCampaign_info['text_content']);
					else
					echo "N/A";
				 ?>                                </td>
                              </tr>
                              <?php /*?><tr>
                                  <td height="30" align="left"> Coantact Info </td>
                                  <td align="left"><?php
					if($RecCampaign_info['contact_info']!="")
					echo $RecCampaign_info['contact_info'];
					else
					echo "N/A";
				 ?> </td>
                                </tr><?php */?>
                              <tr>
                                <td height="30" align="left">Street Address </td>
                                <td align="left"><?php
					if($RecCampaign_info['map_address']!="")
					echo $RecCampaign_info['map_address'];
					else
					echo "N/A";
				 ?>                                </td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> City </td>
                                <td align="left"><?php
					if($RecCampaign_info['map_city']!="")
					echo $RecCampaign_info['map_city'];
					else
					echo "N/A";
				 ?>                                </td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> State </td>
                                <td align="left"><?php
					if($RecCampaign_info['map_state']!="")
					echo $RecCampaign_info['map_state'];
					else
					echo "N/A";
				 ?>                                </td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Zipcode</td>
                                <td align="left"><?php
					if($RecCampaign_info['map_zipcode']!="")
					echo $RecCampaign_info['map_zipcode'];
					else
					echo "N/A";
				 ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Phone Number</td>
                                <td align="left"><?php
					if($RecCampaign_info['phone']!="")
					echo $RecCampaign_info['phone'];
					else
					echo "N/A";
				 ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Website URL</td>
                                <td align="left"><?php
					if($RecCampaign_info['websiteurl']!="")
					echo $RecCampaign_info['websiteurl'];
					else
					echo "N/A";
				 ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Main Clickable Image</td>
                                <td align="left"><?php
					if($RecCampaign_info['main_image']!=""){?>
					<img src="http://clients.adtingo.com/Campaign_images/main_image/thumb_images/<?php echo $RecCampaign_info['main_image']; ?>" width="100" height="100" />
					<?php }else
					echo "N/A";
				 ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left">Inset Clickable Image</td>
                                <td align="left"><?php
					if($RecCampaign_info['clickble_image']!=""){?>
					<img src="http://clients.adtingo.com/Campaign_images/clickble_image/thumb_images/<?php echo $RecCampaign_info['clickble_image']; ?>" width="100" height="100" />
					<?php }else
					echo "N/A";
				 ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Link to Twitter Page </td>
                                <td align="left"><?php
					if($RecCampaign_info['twitter_link']!="")
					echo $RecCampaign_info['twitter_link'];
					else
					echo "N/A";
				 ?>
                                  &nbsp; </td>
                              </tr>
                              <tr>
                                <td height="30" align="left"> Link to Facebook Page </td>
                                <td align="left"><?php
					if($RecCampaign_info['facebook_link']!="")
					echo $RecCampaign_info['facebook_link'];
					else
					echo "N/A";
				 ?>                                </td>
                              </tr>
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left">&nbsp;</td>
                              </tr>
                            </table></td>
                      </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="10">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="wbg">
        <tr>
          <td align="left" valign="bottom"><img src="images/box_bot_left.gif" width="3" height="3"></td>
          <td align="right" valign="bottom"><img src="images/box_bot_right.gif" width="3" height="3"></td>
        </tr>
    </table></td>
  </tr>
</table>
                 
             </div>
            
   
</div>
<!--body end-->
<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
