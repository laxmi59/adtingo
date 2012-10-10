<?php 
$nav=12;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');
$ClientID=$_REQUEST['clientselect'];
if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{
	$cid=$_REQUEST['delid'];
	//$GETMessRes=$object->DeleteData("tbl_campaigns","campaign_id=$mid");
	$GETMessRes="update tbl_campaigns set status=0 where campaign_id=".$cid."";
	//$GETMessResqry=mysql_query($GETMessRes);
	$GETMessResqry=$object->ExecuteQuery($GETMessRes);
	if($GETMessResqry)
	{
		header("Location:manage_Campaigns_list2.php?msg=deleted&page=".$_REQUEST['page']."&clientselect=".$_REQUEST['clientid']."");
		exit;
	}
	
}
	$SqlGetClients="select * from tbl_clients where status=1";
	$ResGetClients=$object->ExecuteQuery($SqlGetClients);

//********** Start Code for displaying CUSTOMERS  *************//

	 $SqlCampaign_info="select *,date_format(schedule_date,'%d %b,  %Y') as date ,date_format(date_created ,'%W %b %d,  %Y') as createddate  from tbl_campaigns where clientid=".$_GET['uid']." and  status!=0" ; 
	if($_REQUEST['field']=='cname')
	{
		$field='campaign_name';
		$order=$_REQUEST['order'];
		$SqlCampaign_info.= " Order By ".$field." ".$order;
	}
	else if($_REQUEST['field']=='client')
	{
		$field='client_name';
		$order=$_REQUEST['order'];
		$SqlCampaign_info.= " Order By ".$field." ".$order;
	}
	
	 	
	else
	{
		 $SqlCampaign_info.="  Order By campaign_id DESC";
	}
	//echo $SqlGetCustomersInfo;
	$SqlGetCampaignsRes=$object->ExecuteQuery($SqlCampaign_info);
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
	$SqlCampaign_info=$SqlCampaign_info." LIMIT $getPaginationRecords,$limit";
	 $SqlGetCampaignres=$object->ExecuteQuery($SqlCampaign_info);
	

//********** End Code for displaying Artists  *************//

?>

<script language="javascript" type="text/javascript">
  function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript">
function getClient(nid){
window.location='manage_Campaigns_list2.php?uid='+nid;
}
</script>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Campaigns  </td>
<td align="right"  class="padbot5"><a href="step1.php?ClientID=<?php echo $ClientID;?>">Add Campaign </a></td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
  </tr>
</table>
<table width="95%" cellpadding="0" cellspacing="1" id="customerGrid_table">
    <tr>
        <td height="30" align="left" class="tr1"><b>Select Client</b></td>
		<td align="left" class="tr1">
		
		<select name="client" onchange="getClient(this.value);">
			<option value="">&nbsp;Select Client&nbsp;&nbsp;</option>
		<?php	while($RecGetClients=$object->FetchArray($ResGetClients)){?>
         	<option value="<?php echo $RecGetClients['clientid']?>" <?php if($_GET[uid]==$RecGetClients['clientid']) echo "selected='selected'"?>><?php echo $RecGetClients['full_name']?></option>
		<?php }?>
          </select>
		</td>
	</tr>
    </table>
<?php if($_GET[uid]){?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">

<?php
if($_REQUEST['msg']=="update")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Member Information has been updated successfully</td></tr>
<?php
}
if($_REQUEST['mes']=="added")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Campaign has been added successfully</td></tr>
<?php
}
if($_REQUEST['msg']=="deleted")
{
?>
<tr><td colspan="3" align="center" class="errer-mess2"> Campaign has been deleted successfully</td></tr>
<?php
}

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
     <td align="left"></td>
   </tr>
   
   <tr>
     <td align="left">&nbsp;</td>
   </tr>
   <tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"manage_Campaigns_list2.php?uid=$_GET[uid]"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtvaltracks(this.value,'manage_Campaigns_list2',<?php echo $_GET[uid]?>);">
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
          <td class="form-bg2">
		 
		  <table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
            <thead>
			
              <tr>
              <!--<td width="6%" class="headings" align="left"><strong>ID</strong></td>-->
                <td width="17%" align="left" class="headings">Campaign Name <a href="manage_payments.php?page=<?php echo $page;?>&field=cname&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manage_payments.php?page=<?php echo $page;?>&field=cname&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="15%" align="left" class="headings"> Subject </td>
                <td width="21%" align="left" class="headings">Schedule Date  </td>
                  
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
             <!--  <td class="<?php echo $class;?>" align="left"> </td>-->
                <td align="left" class="<?php echo $class;?>"><?php echo stripslashes($SqlGetCampaignrec['campaign_name']); ?></td>
                <td align="left" class="<?php echo $class;?>">
					<?php echo stripslashes($SqlGetCampaignrec['subject_line']); ?></td>
                
                
                <td align="left" class="<?php echo $class;?>" ><?php echo $SqlGetCampaignrec['date'];?></td>
				 <td align="left" class="<?php echo $class;?>">
	<?php if($SqlGetCampaignrec['status']=='1' || $SqlGetCampaignrec['status']=='5') {?>
	 <a href="edit-campaign.php?cid=<?php echo base64_encode($SqlGetCampaignrec['campaign_id']);?>" class="left"><img src="images/edit.gif" alt="Edit"  border="0" title="Edit" /></a>
	 <?php }?>
	<a href="javascript:deleteCampaign_list(<?php echo $SqlGetCampaignrec['campaign_id'];?>,<?php echo $page;?>,<?php echo $ClientID;?> );" ><img src="images/delete.gif" title="Delete" alt="Delete" /></a>
		
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
      <?php }?>
	  
      
   

 <?php include('includes/footer.php'); ?>