<?php
include_once('includes/session.php');
include_once('includes/functions.php');
include_once("includes/pager.php"); 
//include('includes/dbfiler.php'); 
include_once('includes/values.php');

 
$object=new main();
 $Clientid=$_SESSION['clientid']; 
 $SqlGetCampaignsInfo ="SELECT * FROM `tbl_campaigns` WHERE `clientid` = ".$Clientid." AND `status` = 3 AND `template_id` != 0 AND `mailing_ID` != 0";
 //echo $SqlGetCampaignsInfo;
 $ResGetCampaignsInfo=$object->ExecuteQuery($SqlGetCampaignsInfo);
$cols=$object->NumRows($ResGetCampaignsInfo);
//echo $cols;
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
<!--header start-->
  <?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
<div class="body">
  <div class="title">
  	<h2>Campaigns Summary</h2> 
	<div class="f-right"><a onclick="CS.Step4_1.step4_1TestEmail(); return false;" href="campaign-comparison.php" class="greybutton"><span> Campaign Comparison</span></a> 
	</div>
  </div> 
	<table class="tableHeader"  width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<th class="headerLeft" width="207">Campaign Name</th>
		<th width="363" >Subject</th>
		<th   width="264" >Schedule Date</th>
		<th class="headerRight" width="124" nowrap="nowrap">Options</th>
	</tr>
	<?php if($cols){
	 while($RecGetCampaignsInfo=$object->FetchArray($ResGetCampaignsInfo))
		{?>
    <tr>
    	<td><?php echo $RecGetCampaignsInfo['campaign_name']?><span><?php $dt=$RecGetCampaignsInfo['schedule_date']; echo date('l, j F  Y', strtotime($dt))?></span> </td>
        <td><?php echo $RecGetCampaignsInfo['subject_line']?></td>
        <td><?php $dt=$RecGetCampaignsInfo['schedule_date']; echo date('j F Y, h:i A', strtotime($dt))?></td>
        <td><a href="campaign-performance-report.php?rid=<?php echo $RecGetCampaignsInfo['campaign_id']?>"><img src="images/reports.png" alt="Reports"  /></a></td>
    </tr>
	<?php }
	}else{?>
	<tr>
		<td>no rows found</td>
	</tr>
	<?php }?>
	</table>

</div>
<!--body end-->
<!--footer start-->
<?php include('includes/footer.php'); ?>
<!--footer end-->
</body>
</html>
