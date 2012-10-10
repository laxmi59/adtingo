<?php 
include_once('includes/session.php'); 
include('includes/functions.php'); 
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
	$Zipcodechk="  and tbl_members.zipcode IN (0) "; 
		
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
	 $totalemailsids=$object->GetCampaignSearchResult($RecCampaign_Seg_list_info['area_list'],$RecCampaign_Seg_list_info['gender'],$RecCampaign_Seg_list_info['education'],$RecCampaign_Seg_list_info['income'],$RecCampaign_Seg_list_info['keywords'],$RecCampaign_Seg_list_info['minimum_age'],$RecCampaign_Seg_list_info['maxmum_age'],$Zipcodechk, $shddate2,$Campaign_ID); 		
		$totalemailsidslist=explode("&&&",$totalemailsids);
		$totalemailsidslistarray1=$totalemailsidslist[0];
		$totalemailsidslistarray2=$totalemailsidslist[1];
		$totalemailsidslistarray3=explode(",",$totalemailsidslistarray2);
	}
			if($totalemailsidslistarray1 <= 85000)
			$totalAmountBilled=(50+($totalemailsidslistarray1*0.03));
			else if($totalemailsidslistarray1 > 85000 && $totalemailsidslistarray1 <= 150000)
			$totalAmountBilled=(25+($totalemailsidslistarray1*0.03));
			else if($totalemailsidslistarray1 > 150000)
			$totalAmountBilled=($totalemailsidslistarray1*0.025);
		if($totalemailsidslistarray1>0)
		{
		}
		else
		$totalAmountBilled="0";
		
		 if($_POST['steppaymentsubmit_x']!="")
 		{
		 $UpdateCampaignStatus="update tbl_campaigns set  status=5, created_by=2 where campaign_id=".$Campaign_ID.""; 
		//echo $UpdateCampaignStatus; 
		
		$UpdateCampaignStatusRes=$object->ExecuteQuery($UpdateCampaignStatus);
		for($i=0;$i<count($totalemailsidslistarray3); $i++)
		{
		$Member_ID=$totalemailsidslistarray3[$i];
		 $InsertMemberLisqry=sprintf("insert into tbl_listedmembers(campaign_id,memberid,schedule_date,date_created) values(%d,%d,'%s','%s')",$Campaign_ID,$Member_ID,$shddate2,date('Y:m:d H:i:s')); 
		$InsertMemberListRes=$object->ExecuteQuery($InsertMemberLisqry);
		}
		
			if($UpdateCampaignStatusRes)
			{
				$ClientEmail=stripslashes($RecGetclients_info['email_address']);
				$ClientFullname=stripslashes($RecGetclients_info['full_name']);
				$Campaign_Name_approval=stripslashes($SqlGetCamDetailsRec['campaign_name']);
				$Campaign_sent_Date=stripslashes($SqlGetCamDetailsRec['ssdate']);
				 
				$from="info@adtingo.com";
				$to="manohar015@gmail.com";
				$sub="Adtingo Campaign approval";
				 $fileName = "templates/campaign_approval.html";	
				if(file_exists($fileName))
				{
					$emailText = file_get_contents($fileName); 
					
				}
				
				$htmMsg = nl2br($ClientFullname);
				$mailMessage = str_replace("#CLIENTNAME#", "$htmMsg", "$emailText");
				$mailMessage = str_replace("#CAMPAIGNNAME#", "$Campaign_Name_approval", "$mailMessage");
				$mailMessage = str_replace("#SCHEDULEDATE#", "$Campaign_sent_Date", "$mailMessage");
				$sendmail=$object->sendmail($to,$from,$sub,$mailMessage);
			
				unset($_SESSION['campaign']);
				header("location:overview.php?msg=added");
				exit; 
				}
			}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
</head>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Campaign Payment Confirmation</h2><img src="images/step3.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post">                              
        <div class="grey-box">
           	 <input type="hidden" name="cid" value="<?php echo $_REQUEST['cid'];?>" />
                          
          
           <h3 class="grad-box">Campaign Payment Confirmation </h3> 
          
           <p>Thank you <strong><?php echo stripslashes($ClientFullname);?></strong>. Your campaign <strong><?php echo stripslashes($campaign_name);?></strong> to be  sent to <strong><?php echo $totalemailsidslistarray1;?></strong> recipients on <strong><?php echo $sheduleddate;?></strong>  has been submitted  for approval.  <br /> <br />
             Once your campaign has been approved and deployed you will  be charged $<strong><?php echo $totalAmountBilled;?></strong> on <strong><?php echo $sheduleddate;?></strong>. <br />
             We appreciate your business, if you have any further  questions please emails us at <a href="mailto:Billing@AdTingo.com">Billing@AdTingo.com</a>.</p>
           </div>
 <a href="template-preview.php?cid=<?php echo base64_encode($Campaign_ID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a>
		<?php if($RecCampaign_info['status']==5)
			{?>
			<a href="overview.php?msg=added"><img src="images/next.gif" alt="Next" class="m-left5" /></a>
		 
		  <?php } else { ?> <input type="image"  src="images/approve-bt.gif" alt="Define Delivery"  border="0" name="steppaymentsubmit" />

		<?php } ?>
		 
 

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
