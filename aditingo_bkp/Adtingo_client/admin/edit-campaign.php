<?php 
	error_reporting(0);
	$nav=12;
	include('includes/functions.php'); 
	include_once('includes/adminsessions.php'); 
	include('includes/values.php'); 
	include('includes/header.php'); 
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
            <td width="83%" height="100" align="left" class="tr5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="20" align="left" class="content-header"><?php echo stripslashes($RecCampaign_info['campaign_name']);?></td>
                  <td align="right"  class="padbot5">&nbsp;</td>
                </tr>
                <tr class="grey-bg">
                  <td height="4" colspan="2"></td>
                </tr>
              </table>
              <form action="campaign-information.php" method="post" name="profilrfrm" enctype="multipart/form-data" onsubmit="return validatemember();">
                <input type="hidden" name="userid" id="userid" value="<?php echo $_REQUEST['mid']; ?>" />
                <input type="hidden" name="page" id="page" value="<?php echo $_REQUEST['page']; ?>" />
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
                            <td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="23%" height="10" align="left"></td>
                                  <td width="76%" height="10" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="2" align="left" class="table-tab"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle" class="p-t3">Step 1.1 List Segmentation</td>
                                        <td align="right"><a href="step1.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ></a>
                                        <input type="button" name="button7" id="button7" value="Edit" class="button" onclick="javascript:window.location='step1.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>'" />
                                        </td>
                                      </tr>
                                    </table></td>
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
                                  <td height="30" colspan="2" align="left" class="table-tab"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle" class="p-t3">Step 1.2 Delivery</td>
                                        <td align="right"><a href="step2.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ></a>
                                          <input type="button" name="button7" id="button7" value="Edit" class="button" onclick="javascript:window.location='step2.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>'" />
                                          </td>
                                      </tr>
                                    </table></td>
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
				 ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td height="8" colspan="2" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="2" align="left" class="table-tab"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle" class="p-t3">Step 1.3 List Segmentation </td>
                                        <td align="right"><a href="step3.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ></a>
                                          <input type="button" name="button7" id="button7" value="Edit" class="button" onclick="javascript:window.location='step3.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>'" />
                                          </td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="10" colspan="2" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"> Minimum Age </td>
                                  <td align="left"><?php if($RecCampaign_Seg_list_info['minimum_age']!="0") { echo $RecCampaign_Seg_list_info['minimum_age'];?> years<?php } else echo "N/A";?></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left">Maximum Age </td>
                                  <td align="left"><?php if($RecCampaign_Seg_list_info['maxmum_age']!="0") { echo $RecCampaign_Seg_list_info['maxmum_age'];?> years<?php } else echo "N/A";?></td>
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
                                  <td height="30" colspan="2" align="left" class="table-tab"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle" class="p-t3">Step 1.4 List Segmentation </td>
                                        <td align="right">
										<a href="step3.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ></a><input type="button" name="button4" id="button4" value="Edit" class="button" onclick="javascript:window.location='step4.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>'" />
										</td>
                                      </tr>
                                    </table></td>
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
                                  <td align="left"><?php if($RecCampaign_Seg_list_info['zipcode_miles']!="0") { echo $Zipcode_Radious[$RecCampaign_Seg_list_info['zipcode_miles']];?> Miles <?php } else echo "N/A"; ?></td>
                                </tr>
                                <tr>
                                  <td height="8" colspan="2" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="2" align="left" class="table-tab"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle" class="p-t3">Step 1.5 List Segmentation </td>
                                        <td align="right">
										<a href="step4.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ></a><input type="button" name="button3" id="button3" value="Edit" class="button" onclick="javascript:window.location='step5.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>'" />
										</td>
                                      </tr>
                                    </table></td>
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
			 ;?> </td>
                                </tr>
                                <tr>
                                  <td height="8" colspan="2" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="2" align="left" class="table-tab"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle" class="p-t3">Campaign Creation </td>
                                        <td align="right">
										<a href="campaign-information.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ></a><input type="button" name="button2" id="button2" value="Edit" class="button" onclick="javascript:window.location='campaign-information.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>'" />
										</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="10" colspan="2" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"> Selected Template </td>
                                  <td align="left"><?php if($RecCampaign_info['template_selection']=='1') echo "Template 1";
			  			else if($RecCampaign_info['template_selection']=='2') echo "Template 2";
						else if($RecCampaign_info['template_selection']=='3') echo "Template 3";
						else
						echo "N/A"; ?></td>
                                </tr>
                                <tr>
                                  <td height="8" colspan="2" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="2" align="left" class="table-tab"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="left" valign="middle" class="p-t3">Campaign Information </td>
                                        <td align="right">
										<a href="add-own-template.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ></a><input type="button" name="button" id="button" value="Edit" class="button" onclick="javascript:window.location='add-own-template.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>'" />
										</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="10" colspan="2" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"> Destination URL </td>
                                  <td align="left"> <?php
					if($RecCampaign_info['destination_url']!="")
					echo $RecCampaign_info['destination_url'];
					else
					echo "N/A";
				 ?> </td>
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
                                  <td align="left"> <?php
					if($RecCampaign_info['sub_heading']!="")
					echo stripslashes($RecCampaign_info['sub_heading']);
					else
					echo "N/A";
				 ?> </td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"> Text content </td>
                                  <td align="left"><?php
					if($RecCampaign_info['text_content']!="")
					echo stripslashes($RecCampaign_info['text_content']);
					else
					echo "N/A";
				 ?> </td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"> Coantact Info </td>
                                  <td align="left"><?php
					if($RecCampaign_info['contact_info']!="")
					echo $RecCampaign_info['contact_info'];
					else
					echo "N/A";
				 ?> </td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"> Link to Twitter Page </td>
                                  <td align="left"> <?php
					if($RecCampaign_info['twitter_link']!="")
					echo $RecCampaign_info['twitter_link'];
					else
					echo "N/A";
				 ?>
                                    &nbsp; </td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"> Link to Facebook Page </td>
                                  <td align="left"> <?php
					if($RecCampaign_info['facebook_link']!="")
					echo $RecCampaign_info['facebook_link'];
					else
					echo "N/A";
				 ?> </td>
                                </tr>
                                <tr>
                                  <td height="30" align="left">&nbsp;</td>
                                  <td align="left">&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
              </form></td>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table></td>
  </tr>
</table>
<?php include('includes/footer.php'); ?>
