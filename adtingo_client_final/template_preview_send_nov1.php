<?php
include_once('includes/session.php'); 
include_once('includes/functions.php'); 
include_once('includes/values.php'); 
$object=new main();
$Num_cols="0";
	//print_r($_POST);
	$getClient="select * from `tbl_billing_details` where clientid='".$_SESSION['clientid']."'";
	
	$ClientExecute=$object->ExecuteQuery($getClient);
	$ClientFetch=$object->FetchArray($ClientExecute);
	if($ClientFetch['CCTypeID']=='' || $ClientFetch['CCNo']=='' || $ClientFetch['CCExpMon']=='' || $ClientFetch['CCExpYear']=='' || 	$ClientFetch['CCName']=='' || $ClientFetch['CCVNo']==''){
		header("location:payment-gateway.php?cid=".base64_encode($_POST['camid']));
		exit;
	}else{
	
		$UpdateCampaignStatus="update tbl_campaigns set  status=5 where campaign_id=".$_POST['camid'].""; 
		//echo $UpdateCampaignStatus;
		$UpdateCampaignStatusRes=$object->ExecuteQuery($UpdateCampaignStatus);
		
		$SqlGetclients_info=sprintf("select * from tbl_clients where clientid=%d",$object->stripper($_SESSION['clientid']));
		//echo $SqlGetclients_info."<br>";
		$ResGetclients_info=$object->ExecuteQuery($SqlGetclients_info);
		$RecGetclients_info=$object->FetchArray($ResGetclients_info);

		$SqlGetCamDetailsQry="select *,date_format(schedule_date,'%d %b,  %Y') as date from tbl_campaigns where status!=0 and campaign_id=".$_POST['camid'] ; 
		//echo $SqlGetCamDetailsQry;
		$SqlGetCamDetailsRes=$object->ExecuteQuery($SqlGetCamDetailsQry);
		$SqlGetCamDetailsRec=$object->FetchArray($SqlGetCamDetailsRes);
		
		if($UpdateCampaignStatusRes)
		{
			$ClientEmail=stripslashes($RecGetclients_info['email_address']);
			$ClientFullname=stripslashes($RecGetclients_info['full_name']);
		    $Campaign_Name_approval=stripslashes($SqlGetCamDetailsRec['campaign_name']);
			$Campaign_sent_Date=stripslashes($SqlGetCamDetailsRec['date']);
			 
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

?>
