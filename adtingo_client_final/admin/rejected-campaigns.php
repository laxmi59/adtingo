<?php 
$nav=8;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');


//********** Start Code for displaying CUSTOMERS  *************//

	 $SqlGetCampaigns="select *,date_format(schedule_date,'%d %b,  %Y') as date ,date_format(date_created ,'%W %b %d,  %Y') as createddate  from tbl_campaigns where status='4'";
	
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
		 $SqlGetCampaigns.="  Order By schedule_date DESC";
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

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" colspan="3" class="content-header"><a href="manage_campaign.php">Pending Campaigns</a> <a href="approved-campaigns.php">Approved Campaigns</a><a href="rejected-campaigns.php" class="select">Rejected Campaigns</a></td>
<!--<td align="right"  class="padbot5"><a href="edit-member.php?page=">Add Member </a></td>-->
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
    </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
 
<tr>
    <td height="10"></td>
	
  </tr>
   <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"rejected-campaigns.php?"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value,'rejected-campaigns');">
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
                <td width="17%" align="left" class="headings">Campaign Name <a href="rejected-campaigns.php?page=<?php echo $page;?>&field=campaign_name&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="rejected-campaigns.php?page=<?php echo $page;?>&field=campaign_name&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="15%" align="left" class="headings">Subject <a href="rejected-campaigns.php?page=<?php echo $page;?>&field=subject&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="rejected-campaigns.php?page=<?php echo $page;?>&field=subject&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
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
                
                <td align="left" class="<?php echo $class;?>"><strong>Rejected</strong>
	
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