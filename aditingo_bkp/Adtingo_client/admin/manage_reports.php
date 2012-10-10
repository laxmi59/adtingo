<?php 
$nav=13;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');
include('includes/graph.php');
$obj= new graphs_types();
$object=new main(); 

$SqlGetClients="select * from tbl_clients where status=1";
$ResGetClients=$object->ExecuteQuery($SqlGetClients);
?>
<script type="text/javascript">
function getClient(nid){
window.location='manage_reports.php?uid='+nid;
}
</script>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td width="45%" height="30">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" align="left" class="content-header">Manage Reports </td>
<td align="right"  class="padbot5">&nbsp;</td>
  </tr>
  <tr class="grey-bg">
    <td height="4" colspan="2"></td>
  </tr>
</table>
<br />
  <table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="form-bg2">
	<table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
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
    </table></td>
  </tr>
</table> 
<br />
<?php if($_GET[uid]){?>
<?php $SqlGetCampaigns="SELECT * FROM `tbl_campaigns` WHERE `clientid` =$_GET[uid] AND `template_id` <>0 AND `mailing_ID` <>0 AND `status` =3";
	
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
		 $SqlGetCampaigns.="  Order By campaign_id DESC";
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
	 $SqlGetCampaignres=$object->ExecuteQuery($SqlGetCampaigns);?>
	 
<table width="95%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"manage_reports.php?uid=$_GET[uid]"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtvaltracks(this.value,'manage_reports',<?php echo $_GET[uid]?>);">
		<?php echo $page_num_str=$object->select_function($page_num_array,$limit,$_GET[uid]);?>
      </select>
per page</td>
  </tr>
	<tr><td>&nbsp;</td></tr>
  <tr>
  
    <td class="form-bg2">   
<table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table">
            <thead>
			
              <tr>
              <!--<td width="6%" class="headings" align="left"><strong>ID</strong></td>-->
                <td width="17%" align="left" class="headings">Campaign Name <a href="manage_reports.php?uid=<?php echo $_GET[uid]?>&page=<?php echo $page;?>&field=campaign_name&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manage_reports.php?uid=<?php echo $_GET[uid]?>&page=<?php echo $page;?>&field=campaign_name&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
                <td width="15%" align="left" class="headings">Subject <a href="manage_reports.php?uid=<?php echo $_GET[uid]?>&page=<?php echo $page;?>&field=subject&order=ASC&limit=<?php echo $limit;?>"><img src="images/up.gif"  /></a><a href="manage_reports.php?uid=<?php echo $_GET[uid]?>&page=<?php echo $page;?>&field=subject&order=DESC&limit=<?php echo $limit;?>"><img src="images/down.gif"  /></a></td>
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
                <td align="left" class="<?php echo $class;?>"><?php echo stripslashes($SqlGetCampaignrec['campaign_name']);?></td>
                <td align="left" class="<?php echo $class;?>">
					<?php echo stripslashes($SqlGetCampaignrec['subject_line']);?></td>
                <td align="left" class="<?php echo $class;?>"> <?php echo date("d M, Y",strtotime($SqlGetCampaignrec['schedule_date']));?></td>
                
                <td align="left" class="<?php echo $class;?>">
				<?php 
				$getreport=charts($SqlGetCampaignrec['mailing_ID']);
				$deliveredCount=$getreport->deliveredCount;
				//echo $deliveredCount;
				?>
				
				<?php if($deliveredCount<>0){?>
				<a href="campaign-performance-report.php?uid=<?php echo $_GET['uid']?>&rid=<?php echo stripslashes($SqlGetCampaignrec['campaign_id']);?>">
				<img src="images/reports.png" alt="Reports" title="Reports" />
				</a>
				<?php }else{ ?>
				 <img src="images/rep_not_avail.jpg" width="24" height="24" alt="Report Not Available" title="Report Not Available"/>
				<?php }?>
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
      </table>
    </td></tr></table>
<?php }?>
      
   

 <?php include('includes/footer.php'); ?>