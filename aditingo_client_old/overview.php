<?php 
include_once('includes/session.php');
include_once('includes/functions.php');
include_once("includes/pager.php"); 
//include('includes/dbfiler.php'); 
include_once('includes/values.php');

 
$object=new main();
 $Clientid=$_SESSION['clientid']; 
//********* START CODE DELETING CUSTOMER  **********//
if(isset($_REQUEST['delid']) && $_REQUEST['delid']!='')
{
	$cid=$_REQUEST['delid'];
	$GETMessRes="update tbl_campaigns set status=0 where campaign_id=".$cid."";
	//$GETMessResqry=mysql_query($GETMessRes);
	$GETMessResqry=$object->ExecuteQuery($GETMessRes);
	$message="del";
	if($GETMessResqry)
	{
		header("Location:overview.php?msg=".$message."&page=".$_REQUEST['page']."");
		exit;
	}
	
}

 $SqlCampaign_info="select *,date_format(schedule_date,'%d %b,  %Y, %l %p') as date ,date_format(date_created ,'%W %b %d,  %Y') as createddate  from tbl_campaigns where status!=0 and clientid=".$Clientid ; 
$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
$cols=$object->NumRows($ResCampaign_info);

if($cols<=0)
{
header("location:create-campaign.php");
exit;
}
if(!isset($_REQUEST['page']))
		$page=1;	
	else
		$page=$_REQUEST['page'];	
	
	
	if($_REQUEST['limit']!='')
	{
		$limit=$_REQUEST['limit'];
	}	
	else
	{
		$limit=6;		
	}	
	$let_infe=ceil($cols/$limit);
	 $SqlCampaign_info.=" order by campaign_id desc"; 
	  $getPaginationRecords=$object->paginationTop($cols,$limit,$page);
	 $SqlCampaign_info=$SqlCampaign_info." LIMIT $getPaginationRecords,$limit";
	 //echo $SqlCampaign_info;
	  $ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script src="js/javascript.js" type="text/javascript">
</script>
</head>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->
<!--body-->
   <div class="body">
  <div class="title"><h2>Campaigns Summary</h2> <div class="f-right"> <a  href="step1.php" class="greybutton"><span>Create Campaign</span></a> </div>
  <div class="error-msg"><?php if($_REQUEST['msg']=="added"){ echo "Campaign has been created successfully"; } ?>
  <?php if($_REQUEST['msg']=="del"){ echo "Campaign has been deleted successfully"; } ?>
  </div>
  </div>
    <table class="tableHeader"  width="100%" cellpadding="0" cellspacing="0">
      	<tbody>
        <tr>
          <th class="headerLeft" width="207">Campaign Name</th>
          <th width="363"   >Subject</th>
          <th   width="264" >Schedule Date</th>
          <th class="headerRight" width="124" nowrap="nowrap">Options</th>
        </tr>
        <?php while($RecCampaign_info=$object->FetchArray($ResCampaign_info))
		{?>
        <tr>
          <td >
		  <?php if($RecCampaign_info['status']==1 || $RecCampaign_info['status']==5) {?>
		  <a href="edit-campaign.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>" class="left"><?php echo stripslashes($RecCampaign_info['campaign_name']);?></a>
		  <?php } else { ?> <?php echo stripslashes($RecCampaign_info['campaign_name']);?><?php } ?>
            <span>Created <?php echo $RecCampaign_info['createddate'];?></span> </td>
          <td ><?php echo stripslashes($RecCampaign_info['subject_line']);?></td>
          <td  ><?php echo stripslashes($RecCampaign_info['date']);?></td>
          <td >
		  <?php if($RecCampaign_info['status']==1 || $RecCampaign_info['status']==5) {?>
		  <a href="edit-campaign.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"><img src="images/edit.png" alt="Edut"  /></a>
		  <?php } ?>
		   <?php if($RecCampaign_info['status']==3 ){?>
		   <a href="campaign-performance-report.php?rid=<?php echo $RecCampaign_info['campaign_id'];?>"><img src="images/reports.png"  alt="Reports" /></a>
		   <? }?>
		   <a href="javascript:deleteCampaign(<?php echo $RecCampaign_info['campaign_id'];?>,<?php echo $page;?>);" ><img src="images/delete.png" title="Delete" alt="Delete" /></a></td>
        </tr>
		<?php
		 } 
		?>
      </tbody>
    </table>
    <table class="tableFooter" width="100%" cellpadding="0" cellspacing="0">
    
        <tr>
          <td align="left" class="left">page <?php echo $object->userpaginationBottom($cols,$limit,$page,"overview.php?"); ?> of <?php echo $let_infe;?> pages        |   view
	
		  <select name="limit" class="input2" onchange="limtval(this.value,'overview');">
		<?php echo $page_num_str=$object->select_function($page_num_array,$limit);?>
      </select>
per page</td>
          <td class="right" align="right">&nbsp;</td>
        </tr>
       
    </table>
     
 
</div>
<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
