<?php 
$nav=12;
include("includes/adminsessions.php"); 
include('includes/header.php');
include('includes/values.php'); 
$object=new main();
if($_REQUEST['cid']!="")
{
	$Campaign_ID=base64_decode($_REQUEST['cid']);
	$SqlGetclients_info=sprintf("select * from tbl_clients where clientid=%d",$object->stripper($_SESSION['clientid']));
	$ResGetclients_info=$object->ExecuteQuery($SqlGetclients_info);
	$RecGetclients_info=$object->FetchArray($ResGetclients_info);
	
	$SqlGetCamDetailsQry="select *,date_format(schedule_date,'%d %b,  %Y') as ssdate from tbl_campaigns where status!=0 and campaign_id=".$Campaign_ID ; 
	$SqlGetCamDetailsRes=$object->ExecuteQuery($SqlGetCamDetailsQry);
	$SqlGetCamDetailsRec=$object->FetchArray($SqlGetCamDetailsRes);
	$ClientID=stripslashes($SqlGetCamDetailsRec['clientid']); 
	$campaign_name=stripslashes($SqlGetCamDetailsRec['campaign_name']);
	$sheduleddate= $SqlGetCamDetailsRec['ssdate'];
	$Campaignsentdate= $SqlGetCamDetailsRec['schedule_date'];
	$shddate1=explode(" ",$Campaignsentdate);
	$shddate2=$shddate1[0];
	
	$SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$Campaign_ID."" ; 
	$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
	$Num_cols=$object->NumRows($ResCampaign_Seg_list_info);
	$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);		
	$pcode=$RecCampaign_Seg_list_info['zipcode'];
	$miles=$RecCampaign_Seg_list_info['zipcode_miles'];	
	$Zipcodechk="";
	if($pcode!="" && $miles!="")
	{
		$GetLogLattitudedetailsqry="select  distinct  LATITUDE,LONGITUDE from zip_code where ZIP_CODE=".$pcode."";
		$GetLogLattitudedetailsRes=$object->ExecuteQuery($GetLogLattitudedetailsqry);
		$object->NumRows($GetLogLattitudedetailsRes); 
		$tt=$object->FetchArray($GetLogLattitudedetailsRes);
		
		$sel="select distinct ZIP_CODE ,LATITUDE,LONGITUDE, (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) as distance from zip_code  where (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) 
		< $miles order by distance";
		$GetAllZipcodesres=$object->ExecuteQuery($sel);
		$zipcodedb=array();
		$object->NumRows($GetAllZipcodesres); 
		while($GetAllZipcodesrec=$object->FetchArray($GetAllZipcodesres))
		{
			$zipcodedb[]=$GetAllZipcodesrec['ZIP_CODE'];
		}
		if(count($zipcodedb)>0)
		{
			$Dbzipcodes=implode(",",$zipcodedb);
			$Zipcodechk="  and tbl_members.zipcode IN (".$Dbzipcodes.") ";
		}
		else
			$Zipcodechk="  and tbl_members.zipcode IN ($pcode) "; 
	}
	if($pcode!="" && $miles ==0)
	{
		if(count($pcode)>0 && $miles!='undefined')
		{
			//$Dbzipcodes=implode(",",$zipcodes);
			$where.="  and tbl_members.zipcode IN (".$pcode.")";
		}
		else
			$where.="  and tbl_members.zipcode IN (0)";
	}
	$SqlGetClientEmail=sprintf("select * FROM tbl_clients where clientid=%d ",$object->stripper($ClientID));
	$ResGetClientEmail=$object->ExecuteQuery($SqlGetClientEmail);
	//$Num_cols=$object->NumRows($ResGetClientEmail);
	$RecGetClientEmail=$object->FetchArray($ResGetClientEmail);
	$ClientEmail=stripslashes($RecGetClientEmail['email_address']);
	$ClientFullname=stripslashes($RecGetClientEmail['full_name']);
	if($SqlGetCamDetailsRec['status']==5)
	{
		$totalemailsidslistarray1=$object->GetAllTheCamRecords($Campaign_ID);
	}
	else
	{
		$totalemailsids=$object->GetCampaignSearchResult($RecCampaign_Seg_list_info['area_list'],$RecCampaign_Seg_list_info['gender'],$RecCampaign_Seg_list_info['education'],$RecCampaign_Seg_list_info['income'],$RecCampaign_Seg_list_info['keywords'],$RecCampaign_Seg_list_info['minimum_age'],$RecCampaign_Seg_list_info['maxmum_age'],$Zipcodechk, $shddate2,$Campaign_ID,$RecCampaign_Seg_list_info['random_number']); 		
		$totalemailsidslist=explode("&&&",$totalemailsids);
		$totalemailsidslistarray1=$totalemailsidslist[0];
		$totalemailsidslistarray2=$totalemailsidslist[1];
		$totalemailsidslistarray3=explode(",",$totalemailsidslistarray2);
	}
	//print_r($totalemailsidslistarray3);
	if($totalemailsidslistarray1>0){}
	else
		$totalAmountBilled="0";
	if($_POST['submitproduct']!=""){
		//echo count($totalemailsidslistarray3);
		for($i=0;$i<count($totalemailsidslistarray3); $i++){
			$Member_ID=$totalemailsidslistarray3[$i];
			$InsertMemberLisqry=sprintf("insert into tbl_listedmembers(campaign_id,memberid,schedule_date,date_created) values(%d,%d,'%s','%s')",$Campaign_ID,$Member_ID,$shddate2,date('Y:m:d H:i:s')); 
			$InsertMemberListRes=$object->ExecuteQuery($InsertMemberLisqry);
		}
		$UpdateCampaignStatus="update tbl_campaigns set  status=5, created_by=1 where campaign_id=".$Campaign_ID."";  
		//echo $UpdateCampaignStatus; 
		
		$UpdateCampaignStatusRes=$object->ExecuteQuery($UpdateCampaignStatus);
		if($UpdateCampaignStatusRes){			
			unset($_SESSION['campaign']);
			header("Location:manage_Campaigns_list2.php?mes=added&uid=".$ClientID."");
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
                    <td height="20" align="left" class="content-header">Campaign Confirmation</td>
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
                      <td height="28" align="left" class="form-headings">Campaign Confirmation </td>
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
                                <td height="10" colspan="2" align="left"><?php 
echo $mailMessage;
?></td>
                              </tr>
                              
                              
                              <tr>
                                <td height="6" colspan="2" align="left"></td>
                                </tr>
                              <tr>
                                <td height="30" colspan="2" align="center">Thank you <strong><?php echo stripslashes($ClientFullname);?></strong>. Your campaign <strong><?php echo stripslashes($campaign_name);?></strong> to be  sent to <strong><?php echo $totalemailsidslistarray1;?></strong> recipients on <strong><?php echo $sheduleddate;?></strong>  has been submitted  for approval.  <br /> <br />
       </td>
                                </tr>
								<tr><td><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><a href="template-preview.php?Val=<?php echo base64_encode("id");?>&amp;cid=<?php echo $_REQUEST['cid'];?>">
									<input type="button" name="button" id="button" value="back" class="button" /></a>
									</td>
                                    <td>&nbsp;</td>
                                    <td>
									<?php if($RecCampaign_info['status']==5)
									{?>
                                    <a href="manage_Campaigns_list2.php?mes=added&uid='<?php echo $ClientID;?>'">
									 <?php } else { ?>
									 <input type="submit" name="submitproduct" id="submit" value="approve" class="button" />
									 <?php }?>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>                           
                                    </td>
                                  </tr>
								  <tr><td>&nbsp;</td></tr>
                                </table></td></tr>
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

<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->

