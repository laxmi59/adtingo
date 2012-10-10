<?php 
$nav=8;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');



//******* START CODE FOR UPDATING CUSTOMER STATUS **********//
if($_REQUEST['status']!='')
{

	$cid=$_REQUEST['cid'];
	$SqlGetClientID="select *,date_format(schedule_date,'%d %b,  %Y') as date from tbl_campaigns where campaign_id=".$cid." and  status!=0" ; 
		 
	$QryGetClientID=$object->ExecuteQuery($SqlGetClientID);
	// $Num_cols=$object->NumRows($QryGetClientID);
	$ResGetClientID=$object->FetchArray($QryGetClientID);
	$ClientID=stripslashes($ResGetClientID['clientid']); 
	$campaign_name=stripslashes($ResGetClientID['campaign_name']);
	$sheduleddate= $ResGetClientID['date'];
		
	$SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$_REQUEST['cid']."" ; 
	$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
	$Num_cols=$object->NumRows($ResCampaign_Seg_list_info);
	$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);		
		 
	$SqlGetClientEmail=sprintf("select * FROM tbl_clients where clientid=%d ",$object->stripper($ClientID));
	$ResGetClientEmail=$object->ExecuteQuery($SqlGetClientEmail);
	//$Num_cols=$object->NumRows($ResGetClientEmail);
	$RecGetClientEmail=$object->FetchArray($ResGetClientEmail);
	$ClientEmail=stripslashes($RecGetClientEmail['email_address']);
	$ClientFullname=stripslashes($RecGetClientEmail['full_name']);
	$GetAllListedMembersqry="select * from tbl_listedmembers where campaign_id='".$_REQUEST['cid']."'";
	$GetAllListedMembersRes=$object->ExecuteQuery($GetAllListedMembersqry);
	$TotalRecordsListedTosendEmail=$object->NumRows($GetAllListedMembersRes);
	if($TotalRecordsListedTosendEmail <= 85000)
		$totalAmountBilled=(50+($TotalRecordsListedTosendEmail*0.03));
	else if($TotalRecordsListedTosendEmail > 85000 && $TotalRecordsListedTosendEmail <= 150000)
		$totalAmountBilled=(25+($TotalRecordsListedTosendEmail*0.03));
	else if($TotalRecordsListedTosendEmail > 150000)
		$totalAmountBilled=($TotalRecordsListedTosendEmail*0.025);
include("includes/storm.php");
	if($_REQUEST['status']==2)
	{
		$msg='Act';
		$statusval="Approved";
		$date=date("Y-m-d");	
		 $QryupdateUserStatus=sprintf("update tbl_campaigns set status=%d, approved_date='%s' where campaign_id=%d",$object->stripper($_REQUEST['status']),$object->stripper($date),$object->stripper($_REQUEST['cid'])); 
	$ResupdateCampaignStatus=$object->ExecuteQuery($QryupdateUserStatus);
	
	
if($ResupdateCampaignStatus)
{	

			$from="info@adtingo.com";
			$to=$ClientEmail;
			$sub="Adtingo Campaign Approval";
			 $fileName = "EmailTemplates/campaign_approval.html";	
			if(file_exists($fileName))
			{
				$emailText = file_get_contents($fileName); 
				
			}
			
			$htmMsg = nl2br($ClientFullname);
			$mailMessage = str_replace("#MESSAGE#", "$htmMsg", "$emailText");
			$mailMessage = str_replace("#CAMPAIGNNAME#", "$campaign_name", "$mailMessage");
			$mailMessage = str_replace("#TOTALRECORDS#", "$TotalRecordsListedTosendEmail", "$mailMessage");
			$mailMessage = str_replace("#SDATE#", "$sheduleddate", "$mailMessage");
			$mailMessage = str_replace("#CCOST#", "$totalAmountBilled", "$mailMessage");
			
			$textContent="";
			// dont change this number..
				$templateId=1471;
			// dont change this number.
			
			$tt[0] = array("address" => $ClientEmail);
			
			$cstb = array("title"=>$sub, "subject"=>$sub, "fromEmail"=>$from, "fromName"=>"Adtingo", "toEmail"=>$from, "toName"=>"Adtingo", "replyToEmail"=>"reply@adtingomail.com", "replyToName"=>"Adtingo", encoding=>"quoted-printable","Charset"=>"ISO-8859-1", "trackType"=>"ALL", "openTrackType"=>"HTML", "clickStreamType"=>"ALL", "brandID"=>"1","enabled"=>"TRUE" );
			try{
				//$cst_res = $soapClient->__call("createSendTemplate", array($cstb,$textContent,$mailMessage));
				$cst_res = $soapClient->__call("updateSendTemplateContents", array($templateId,$textContent,$mailMessage));
				$smft_res =  $soapClient->__call("sendMessagesFromTemplate", array($templateId, $tt));
				
			}catch (SoapFault $fault) {
				$error = "cstb_error";
				echo $fault->faultcode."-".$fault->faultstring;	
			}
			
			//Below $sendmail1 functinality is testing purpose only
			//$mymail="manohar@ritwik.com";
			//$sendmailtest=sendmail($mymail,$from,$sub,$mailMessage);
			//End testing code
			//$sendmail=sendmail($to,$from,$sub,$mailMessage);
			
			header("Location:manage_campaign.php?msg=$msg&page=".$_REQUEST['page']);
			exit;
	
	}
	}
	else
	{
		$msg='Deact'; 
		$statusval="Rejected";
		 $QryupdateUserStatus=sprintf("update tbl_campaigns set status=%d where campaign_id=%d",$object->stripper($_REQUEST['status']),$object->stripper($_REQUEST['cid'])); 
	    $ResupdateCampaignStatus=$object->ExecuteQuery($QryupdateUserStatus);
		$Camid=$_REQUEST['cid'];
		$delMetroIds=$object->DeleteData("tbl_listedmembers","campaign_id=$Camid");
	
	if($ResupdateCampaignStatus)
{			$from="info@adtingo.com";
			$to=$ClientEmail;
			$sub="Your Campaign Rejected by Administrator";
			 $fileName = "EmailTemplates/campaign_reject.html";	
			if(file_exists($fileName))
			{
				$emailText = file_get_contents($fileName); 
				
			}
						
			
			$htmMsg = nl2br($ClientFullname);
			$mailMessage = str_replace("#MESSAGE#", "$htmMsg", "$emailText");
			$mailMessage = str_replace("#CAMPAIGNNAME#", "$campaign_name", "$mailMessage");
			
			$textContent="";
			// dont change this number..
				$templateId=1474;
			// dont change this number.
			
			$tt[0] = array("address" => $ClientEmail);
			
			$cstb = array("title"=>$sub, "subject"=>$sub, "fromEmail"=>$from, "fromName"=>"Adtingo", "toEmail"=>$from, "toName"=>"Adtingo", "replyToEmail"=>"reply@adtingomail.com", "replyToName"=>"Adtingo", encoding=>"quoted-printable","Charset"=>"ISO-8859-1", "trackType"=>"ALL", "openTrackType"=>"HTML", "clickStreamType"=>"ALL", "brandID"=>"1","enabled"=>"TRUE" );
			try{
				//$cst_res = $soapClient->__call("createSendTemplate", array($cstb,$textContent,$mailMessage));
				$cst_res = $soapClient->__call("updateSendTemplateContents", array($templateId,$textContent,$mailMessage));
				$smft_res =  $soapClient->__call("sendMessagesFromTemplate", array($templateId, $tt));
				
			}catch (SoapFault $fault) {
				$error = "cstb_error";
				echo $fault->faultcode."-".$fault->faultstring;	
			}
			
			
			//$sendmail=sendmail($to,$from,$sub,$mailMessage);
			header("Location:manage_campaign.php?msg=$msg&page=".$_REQUEST['page']);
			exit;
	
	}
	}

	
	
}
//******* END CODE FOR UPDATING CUSTOMER STATUS **********//



//********** Start Code for displaying CUSTOMERS  *************//

	 $SqlGetCampaigns="select *,date_format(schedule_date,'%d %b,  %Y') as date ,date_format(date_created ,'%W %b %d,  %Y') as createddate  from tbl_campaigns where status='5'";
	  
	
	if($_REQUEST['field']=='campaign_name')
	{
		$field='campaign_name';
		$order=$_REQUEST['order'];
		$SqlGetCampaigns.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='subject')
	{
		$field='subject_line';
		$order=$_REQUEST['order'];
		$SqlGetCampaigns.= " Order By ".$field." ".$order;
	}
		 	
	else
	{
		 $SqlGetCampaigns.="  Order By schedule_date desc";
	}
	//echo $SqlGetCustomersInfo;
	$SqlGetCampaignsRes=$object->ExecuteQuery($SqlGetCampaigns);
	$cols=$object->NumRows($SqlGetCampaignsRes);
	if(!isset($_REQUEST['page']))
		$page=1;	
	else
		$page=$_REQUEST['page'];	
	
	$let_infe=ceil($cols/$limit);
	if($_REQUEST['limit']!='')
	{
		$limit=$_REQUEST['limit'];
	}	
	else
	{
		$limit=10;		
	}	
	
	 $getPaginationRecords=$object->paginationTop($cols,$limit,$page);
	$SqlGetCampaigns=$SqlGetCampaigns." LIMIT $getPaginationRecords,$limit";
	 $SqlGetCampaignres=$object->ExecuteQuery($SqlGetCampaigns);
	

//********** End Code for displaying Artists  *************//

?>

<script language="javascript" type="text/javascript">
function deleteCampaign(cid,page)
{
	var agree = confirm('Are you sure you want to delete this Campaign?');
	if(agree)
	  window.location.href="manage_campaign.php?delid="+cid+"&page="+page;

	
}
</script>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" colspan="3" class="content-header"><a href="manage_campaign.php" class="select">Pending Campaigns</a> <a href="approved-campaigns.php">Approved Campaigns</a><a href="rejected-campaigns.php">Rejected Campaigns</a></td>
<!--<td align="right"  class="padbot5"><a href="edit-member.php?page=">Add Member </a></td>-->
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
    </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">

<?php

if($_REQUEST['msg']=="Deact")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Campaign  has been Rejected successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="Act")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Campaign has been Approved successfully</td></tr>
<?php
}

?>  
<tr>
    <td height="10"></td>
	
  </tr>
   <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"manage_campaign.php?"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value,'manage_campaign');">
		<?php echo $page_num_str=$object->select_function($page_num_array,$limit);?>
      </select>
per page</td>
    </tr>
  <tr>
    <td height="10"></td>
  </tr>
</table>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
            <thead>
			
              <tr>
              <td width="16%" class="headings" align="left"><strong>Client Name</strong></td>
			  <td width="15%" class="headings" align="left"><strong>Company Name</strong></td>
                <td width="17%" align="left" class="headings">Campaign Name <a href="manage_campaign.php?page=<?php echo $page;?>&field=campaign_name&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manage_campaign.php?page=<?php echo $page;?>&field=campaign_name&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="15%" align="left" class="headings">Subject <a href="manage_campaign.php?page=<?php echo $page;?>&field=subject&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manage_campaign.php?page=<?php echo $page;?>&field=subject&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="11%" align="left" class="headings">Schedule Date  </td>
                  <td width="19%" align="left" class="headings">Options</td>
              </tr>
			  <?php
			  if($cols>0)
			  {
			  $i=1;
			  while($SqlGetCampaignrec=$object->FetchArray($SqlGetCampaignres))
			{ 
				if($i%2==0)
				$class="tr2";
				else
				$class="tr1";
				?>
		<tr>
             <td class="<?php echo $class;?>" align="left"><?php echo $object->GetClientName($SqlGetCampaignrec['clientid']); ?> </td>
			  <td class="<?php echo $class;?>" align="left"><?php echo $object->GetClientCompanyName($SqlGetCampaignrec['clientid']); ?> </td>
                <td align="left" class="<?php echo $class;?>"><?php echo stripslashes($SqlGetCampaignrec['campaign_name']);?></td>
                <td align="left" class="<?php echo $class;?>">
					<?php echo stripslashes($SqlGetCampaignrec['subject_line']);?></td>
                <td align="left" class="<?php echo $class;?>"> <?php echo stripslashes($SqlGetCampaignrec['date']);?></td>
                
                <td align="left" class="<?php echo $class;?>">
	
			<a href="javascript:MM_openBrWindow('viewCampaign.php?cid=<?php echo base64_encode($SqlGetCampaignrec['campaign_id']);?>','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=500,height=600')">
	<img src='images/view2.gif' alt='View'  border='0' align="absmiddle"  title='View'></a>	
				 
	<?php if($SqlGetCampaignrec['status']=='5')
	  {
	  ?>	
		<a  href="manage_campaign.php?cid=<?php echo $SqlGetCampaignrec['campaign_id'];?>&status=2&page=<?php echo $page ;?>" onclick="javascript:return confirm('Are you sure you want to Approve this campaign');" >
		<strong>Approve</strong></a>&nbsp;&nbsp; | &nbsp;&nbsp;
		
		<a  href="manage_campaign.php?cid=<?php echo $SqlGetCampaignrec['campaign_id'];?>&status=4&page=<?php echo $page ;?>" onclick="javascript:return confirm('Are you sure you want to Reject this campaign');" >
		<strong>Reject</strong></a>	  
	 <?php 
	 } 
	 
	 ?>
	 <?php if($SqlGetCampaignrec['status']=='2')
	  {
	  ?>	
		<strong>Approved</strong>&nbsp;&nbsp; | &nbsp;&nbsp;
		<a  href="manage_campaign.php?cid=<?php echo $SqlGetCampaignrec['campaign_id'];?>&status=4&page=<?php echo $page ;?>" onclick="javascript:return confirm('Are you sure you want to Reject this campaign');" >
		<strong>Reject</strong></a>	  
	 <?php 
	 } 
	 if($SqlGetCampaignrec['status']=='4')
	  {
	  ?>	
		<a  href="manage_campaign.php?cid=<?php echo $SqlGetCampaignrec['campaign_id'];?>&status=2&page=<?php echo $page ;?>" onclick="javascript:return confirm('Are you sure you want to Approve this campaign');" >
		<strong>Approve</strong></a>&nbsp;&nbsp; | &nbsp;&nbsp;	<strong>Rejected</strong>
			  
	 <?php 
	 } 
	 ?>
	 			 
	<?php if($SqlGetCampaignrec['status']=='3')
	  {
	  ?>	&nbsp;&nbsp;<strong>Sent</strong>
			  
	 <?php 
	 } 
	  ?>
	   </td>
              </tr>			  
			  <?php
			  $i++;
			  }
			  }
			  else
			  {
			  ?>
			  <tr>
               <td class="errer-mess2" align="left" colspan="6">No Records Found </td>
			  <?php
			  }
			  ?>
			  
			  
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
      
	  
      
   

 <?php include('includes/footer.php'); ?>