<?php 
session_start();
include_once('includes/session.php');
include('includes/functions.php');
include('includes/values.php');
include('includes/graph.php');
$obj= new graphs_types();
$object=new main(); 
$Clientid=$_SESSION['clientid']; 
$SqlGetclientsinfo=sprintf("select * from tbl_clients where clientid=%d and status='%s'",$object->stripper($_SESSION['clientid']),$object->stripper(1));
$QryGetclientsinfo=$object->ExecuteQuery($SqlGetclientsinfo);
$cols=$object->NumRows($QryGetclientsinfo);
$ResGetclientsinfo=$object->FetchArray($QryGetclientsinfo);
//echo print_r($_POST);
//$camp=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_campaigns` WHERE `campaign_id`=$_GET[rid]"));
//$getreport=charts($camp['mailing_ID']);
$dd=$_POST['jumpMenu'];
//print_r($dd);
for($i=0; $i<sizeof($dd);$i++){
	$camp= mysql_fetch_array(mysql_query("select * from `tbl_campaigns` WHERE `campaign_id`=$dd[$i]"));
	$getreport=charts($camp['mailing_ID']);
	if(sizeof($dd)-1==$i){
		$open_array .= $getreport->openRate;
		$click_array .= $getreport->totalClicksPercent;
		$bounce_array .= $getreport->totalBouncePercent;
		$unsub_array .= $getreport->unsubscribeResponsesPercent;
		$compl_array .= $getreport->complaintResponsesPercent;
	}else{
		$open_array .= $getreport->openRate.",";
		$click_array .= $getreport->totalClicksPercent.",";
		$bounce_array .= $getreport->totalBouncePercent.",";
		$unsub_array .= $getreport->unsubscribeResponsesPercent.",";
		$compl_array .= $getreport->complaintResponsesPercent.",";
	}
}
$arry1=array('open','click','bounce','unsubscribe','complaint');
$arry2=array($open_array,$click_array,$bounce_array,$unsub_array,$compl_array);
//print_r($click_array);
$xdd=sizeof($dd)-1;
$xvalues="";
for($xx=0;$xx<sizeof($dd);$xx++){
$camp1= mysql_fetch_array(mysql_query("select * from `tbl_campaigns` WHERE `campaign_id`=$dd[$xx]"));
	if($xdd==$xx){
		$xvalues .="'".$camp1[campaign_name]."'";
		$xcid .=$dd[$xx];
	}else{
		$xvalues .="'".$camp1[campaign_name]."',";
		$xcid .=$dd[$xx].",";
	}
}
//echo $xvalues;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
	<? $res=$obj->line_graph($xvalues,$arry1,$arry2,'line');
		echo $res
	?>
	});
});
</script>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
</head>
<body>
<!--header start-->
<?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
      <div class="title"><h2>Compare Campaign Results</h2>
      <p class="sub-text"> comparing results across 6 different campaigns. <a href="campaign-comparison.php">Select new campaigns</a> to compare</p>
       </div> 
       <div class="graph"><!--<img src="images/graph-big-img.gif" alt="graph" />-->
	   <div id="container" style="width: 900px; height: 400px; margin: 0 auto"></div>
	   </div>
       
        
    <table class="tableHeader"  width="100%" cellpadding="0" cellspacing="0">
      <tbody>
        <tr >
        <th width="26"  class="headerLeft">&nbsp;</th>
          <th class="cellCenter" width="450">&nbsp;</th>
          <th class="cellCenter" width="93" nowrap="nowrap"><img src="images/green-dot.gif" alt="Opens" /> Opens</th>
          <th class="cellCenter" width="84" nowrap="nowrap"><img src="images/blue-dot.gif" alt="Clicks" />  Clicks</th>
          <th class="cellCenter" width="88" nowrap="nowrap"><img src="images/red-dot.gif" alt="Bounces" />  Bounces</th>
           <th class="cellCenter" width="112" nowrap="nowrap"><img src="images/orrange-dot.gif" alt="Unsubscribes" />  Unsubscribes</th>
          <th class="cellCenter headerRight" width="105" nowrap="nowrap"><img src="images/skyblue-dot.gif" alt="Unsubscribes" /> Complaints</th>
          
        </tr>
		<? for($i=0; $i<sizeof($dd);$i++){
		$camp= mysql_fetch_array(mysql_query("select * from `tbl_campaigns` WHERE `campaign_id`=$dd[$i]"));
		$getreport=charts($camp['mailing_ID']);
		$open_total = $open_total + $getreport->openRate;
		$click_total = $click_total + $getreport->totalClicksPercent;
		$bounce_total = $bounce_total + $getreport->totalBouncePercent;
		$unsub_total = $unsub_total + $getreport->unsubscribeResponsesPercent;
		$compl_total = $compl_total + $getreport->complaintResponsesPercent;
		
		$rep=mysql_num_rows(mysql_query("select * from `tbl_reports` WHERE `cid`=$dd[$i]"));
		if($rep=='')
			mysql_query("INSERT INTO `tbl_reports` ( `cid` , `open_percent` , `click_percent` , `bounce_percent` , `unsub_percent` , `compl_percent` , `date` ) VALUES ($dd[$i],'".$getreport->openRate."', '".$getreport->totalClicksPercent."', '".$getreport->totalBouncePercent."', '".$getreport->unsubscribeResponsesPercent."', '".$getreport->complaintResponsesPercent."', now())");
		else
			mysql_query("UPDATE `tbl_reports` SET `open_percent` = '".$getreport->openRate."', `click_percent` = '".$getreport->totalClicksPercent."', `bounce_percent` = '".$getreport->totalBouncePercent."', `unsub_percent` = '".$getreport->unsubscribeResponsesPercent."', `compl_percent` = '".$getreport->complaintResponsesPercent."', date=now() WHERE cid=$dd[$i]");
		?>
        <tr>
        	<td align="center" valign="top" class="b"><?=$i+1?></td>
          <td>
          <div class="b"><?=$camp['campaign_name']?></div> 
<span>Sent to <?=$getreport->scheduledCount?> on <? $dt=$camp['schedule_date']; echo date('D, d M Y \a\t H:i a', strtotime($dt))?>
<br />
<a href="campaign-performance-report.php?rid=<?=$camp['campaign_id']?>">Full Results</a> | <a href="edit-campaign.php?cid=<?=$camp['campaign_id']?>">View Campaign</a></span>
        
              </td>
          <td valign="middle" class="cellCenter" ><strong><?=$getreport->openRate?>%</strong><br />
 <span><?=$getreport->uniqueOpensCount?></span>
 </td>
          <td valign="middle" class="cellCenter"><strong><?=$getreport->totalClicksPercent?>%</strong><br />
 <span><?=$getreport->totalClicksCount?></span>
</td>
          <td valign="middle" class="cellCenter"><strong><?=$getreport->totalBouncePercent?>%</strong><br />
<span><?=$getreport->totalBounceCount?></span>
</td>
           <td valign="middle" class="cellCenter"><strong><?=$getreport->unsubscribeResponsesPercent?>%</strong><br />
<span><?=$getreport->unsubscribeResponsesCount?></span> 
</td>
          <td valign="middle" class="cellCenter"><strong><?=$getreport->complaintResponsesPercent?>%</strong><br />
<span><?=$getreport->complaintResponsesCount?></span></td>
        </tr>
        <? }?>
        
        
        
        
        <tr  class="no-border" >
          <td align="center" valign="top" class="b">&nbsp;</td>
          <td>&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
        </tr>
         
         
         
         
      </tbody>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" class="graph-table-res">
      <tbody>
         
        <tr  >
        <td width="26" align="left" valign="top" >&nbsp;</td>
          <td width="451"  valign="middle">
          
    Averages across all <?=sizeof($dd)?> campaigns
              </td>
          <td width="92" valign="middle" class="cellCenter" ><strong><?=$open_total/sizeof($dd)?>%
          </strong></td>
          <td width="83" valign="middle" class="cellCenter"><strong><?=$click_total/sizeof($dd)?>%
          </strong></td>
          <td width="89" valign="middle" class="cellCenter"><strong><?=$bounce_total/sizeof($dd)?>%
          </strong></td>
           <td width="112" valign="middle" class="cellCenter"><strong><?=$unsub_total/sizeof($dd)?>%
          </strong></td>
          <td width="105" valign="middle" class="cellCenter"><strong><?=$compl_total/sizeof($dd)?>%</strong></td>
        </tr>
        <tr  >
          <td align="left" valign="top" >&nbsp;</td>
          <td  valign="middle">&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
        </tr>
     
      </tbody>
    </table>
    <table class="tableFooter" width="100%" cellpadding="0" 
cellspacing="0">
      <tbody>
        <tr>
          <td class="left" align="right">&nbsp;
         </td>
          <td class="right"> 
		  <form method="post" action="csv.php">
		  <table width="290" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
    <td align="right">
	<input type="hidden" name="cid" value="<?=$xcid?>" />
	<input type="hidden" name="cval" value="<?=$xvalues?>" />
Export this report as a <select >
              
              <option selected="selected"  >Select CSV</option>
          
            </select> </td>
    <td><input type="image" src="images/export.gif" name="export" value=" " /></td>
  </tr>
</table> </form> </td>
        </tr>
      </tbody>
    </table>
 
         
</div>
<!--body end-->


<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
