<?php 
if(!$_POST['jumpMenu']) header('location:campaign-comparison.php');
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
if(sizeof($dd)==1){
	header('location:campaign-comparison.php?msg=1');
}
for($i=0; $i<sizeof($dd);$i++){
	$camp= mysql_fetch_array(mysql_query("select * from `tbl_campaigns` WHERE `campaign_id`=$dd[$i]"));
  	$SelectUnsubMembers=mysql_num_rows(mysql_query("select * from `tbl_unsubscribe` where campaign_id=$dd[$i]"));
	$SelectFarwardMembers=mysql_num_rows(mysql_query("select * from `tbl_emailtofrd` where campaign_id=$dd[$i]"));
	
	$getreport=charts($camp['mailing_ID']);
	if($getreport->uniqueOpensCount !=0){
	$opn1=$getreport->uniqueOpensCount*100/$getreport->deliveredCount;
	}else{
	$opn1=$getreport->uniqueOpensCount;
	}
	if(sizeof($dd)-1==$i){
		$open_array .=  round($opn1,2);
		$click_array .= round($getreport->totalClicksPercent,2);
		$totOpen .=$getreport->uniqueOpensCount;
		$totClick .=$getreport->uniqueClicksCount;
		$bounce_array .= $getreport->totalBouncePercent;
		if($SelectUnsubMembers !=0){
			$unsub_array .= ($SelectUnsubMembers*100)/$getreport->deliveredCount;
		}else{
			$unsub_array .= $SelectUnsubMembers;
		}
		$compl_array .= $getreport->complaintResponsesPercent;
	}else{
		$open_array .= round($opn1,2).",";
		$click_array .= round($getreport->totalClicksPercent,2).",";
		$totOpen .=$getreport->uniqueOpensCount.",";
		$totClick .=$getreport->uniqueClicksCount.",";
		$bounce_array .= $getreport->totalBouncePercent.",";
		if($SelectUnsubMembers !=0){
			$unsub_array .= ($SelectUnsubMembers*100)/$getreport->deliveredCount.",";
		}else{
			$unsub_array .= $SelectUnsubMembers.",";
		}
		$compl_array .= $getreport->complaintResponsesPercent.",";
	}
}
//$arry1=array('open','click','bounce','unsubscribe','complaint');
//$arry2=array($open_array,$click_array,$bounce_array,$unsub_array,$compl_array);
//print_r($click_array);
$arry1=array('open','click');
$arry2=array($open_array,$click_array);
$arry3=array($totOpen,$totClick);
$xdd=sizeof($dd)-1;
$xvalues="";
for($xx=0;$xx<sizeof($dd);$xx++){
$camp1= mysql_fetch_array(mysql_query("select * from `tbl_campaigns` WHERE `campaign_id`=$dd[$xx]"));
	$xval=str_replace("'","",$camp1[campaign_name]);
	if($xdd==$xx){
		
		$xvalues .="'".$xval."'";
		$xcid .=$dd[$xx];
		$xvalnum=$xx+1;
	}else{
		$xvalues .="'".$xval."',";
		$xcid .=$dd[$xx].",";
		$xvalnum=$xx+1;
	}
}
//echo $xvalues;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Compare Campaign Result"?></title>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
	<?php  $res=$obj->line_graph($xvalues,$arry1,$arry2,'line',$arry3);
		echo $res
	?>
	});
});
</script>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<?php include "includes/google_analytic.php";?>
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
          <th class="cellCenter" width="93" nowrap="nowrap">Total Mailed</th>
         
          <th class="cellCenter" width="93" nowrap="nowrap"><img src="images/green-dot.gif" alt="Opens" /> Opens</th>
          <th class="cellCenter" width="84" nowrap="nowrap"><img src="images/blue-dot.gif" alt="Clicks" />  Clicks</th>
          <th class="cellCenter" width="88" nowrap="nowrap"><img src="images/red-dot.gif" alt="Bounces" />  Bounces</th>
	      <th class="cellCenter" width="93" nowrap="nowrap">Cost</th>
         
        </tr>
		<?php  for($i=0; $i<sizeof($dd);$i++){
		$camp= mysql_fetch_array(mysql_query("select * from `tbl_campaigns` WHERE `campaign_id`=$dd[$i]"));
		
		$SelectUnsubMembers=mysql_num_rows(mysql_query("select * from `tbl_unsubscribe` where campaign_id=$dd[$i]"));
		$SelectFarwardMembers=mysql_num_rows(mysql_query("select * from `tbl_emailtofrd` where campaign_id=$dd[$i]"));
		$getreport=charts($camp['mailing_ID']);
		if($getreport->deliveredCount <= 85000)
			$totalAmountBilled=(50+($getreport->deliveredCount*0.03));
		else if($getreport->deliveredCount > 85000 && $getreport->deliveredCount <= 150000)
			$totalAmountBilled=(25+($getreport->deliveredCount*0.03));
		else if($getreport->deliveredCount > 150000)
			$totalAmountBilled=($getreport->deliveredCount*0.025);
			
		//$opn2=$getreport->deliveredCount*$getreport->uniqueOpensCount/100;
		if($getreport->uniqueOpensCount !=0){
			$opn2=round(($getreport->uniqueOpensCount*100)/$getreport->deliveredCount,2);
		}else{
			$opn2=$getreport->uniqueOpensCount;
		}
		
		$open_total = $open_total + $opn2;
		//$click_total = $click_total + $getreport->totalClicksPercent;
		if($getreport->totalClicksCount !=0){
			$click_total = $click_total + ($getreport->totalClicksCount*100)/$getreport->uniqueOpensCount;
		}else{
			$click_total = $click_total + $getreport->totalClicksCount;
		}
		$bounce_total = $bounce_total + $getreport->totalBouncePercent;
		if($SelectUnsubMembers !=0){
			$unsub_total = $unsub_total + ($SelectUnsubMembers*100)/$getreport->deliveredCount;
		}else{
			$unsub_total = $unsub_total + $SelectUnsubMembers;
		}
		$compl_total = $compl_total + $getreport->complaintResponsesPercent;
		
		$send_total=$send_total+$getreport->scheduledCount;
		$amt_total=$amt_total+$totalAmountBilled;
		
		$rep=mysql_num_rows(mysql_query("select * from `tbl_reports` WHERE `cid`=$dd[$i]"));
		if($getreport->totalClicksCount !=0){
			$click_percent =round($getreport->totalClicksCount*100/$getreport->uniqueOpensCount,2);
		}else{
			$click_percent =$getreport->totalClicksCount;
		}
		if($SelectUnsubMembers !=0){
			$unsub_percent=round(($SelectUnsubMembers*100)/$getreport->deliveredCount,2);
		}else{
			$unsub_percent=$SelectUnsubMembers;
		}
		if($rep=='')
			mysql_query("INSERT INTO `tbl_reports` ( `cid` , `open_percent` , `click_percent` , `bounce_percent` , `unsub_percent` , `compl_percent` , `date` ) VALUES ($dd[$i],'".round($opn2,2)."', '".$click_percent."', '".round($getreport->totalBouncePercent,2)."', '".$unsub_percent."', '".round($getreport->complaintResponsesPercent,2)."', now())");
		else
			mysql_query("UPDATE `tbl_reports` SET `open_percent` = '".round($opn2,2)."', `click_percent` = '".click_percent."', `bounce_percent` = '".round($getreport->totalBouncePercent,2)."', `unsub_percent` = '".$unsub_percent."', `compl_percent` = '".round($getreport->complaintResponsesPercent,2)."', date=now() WHERE cid=$dd[$i]");
		?>
        <tr>
        	<td align="center" valign="top" class="b"><?php echo $i+1?></td>
          <td>
          <div class="b"><?php echo $camp['campaign_name']?></div> 
<span>Sent to <?php echo $getreport->scheduledCount?> on <?php $dt=$camp['schedule_date']; echo date('D, d M Y \a\t H:i a', strtotime($dt))?>
<?php
			
?>
<br />
<a href="campaign-performance-report.php?rid=<?php echo $camp['campaign_id']?>">Full Results</a> | <?php /*?><a href="edit-campaign.php?cid=<?php echo $camp['campaign_id']?>">View Campaign</a><?php */?>
<a href="viewCampaign.php?cid=<?php echo base64_encode($camp['campaign_id']);?>">View Campaign</a></span>              </td>
          <td valign="middle" class="cellCenter" ><strong><?php echo $getreport->scheduledCount?></td>
        
          <td valign="middle" class="cellCenter" ><strong><?php echo $opn2?>%</strong><br />
 <span><?php echo $getreport->uniqueOpensCount?></span> </td>
          <td valign="middle" class="cellCenter"><strong><strong>
		  <?php 
		  if($getreport->totalClicksCount !=0){
		  	echo round($getreport->totalClicksCount*100/$getreport->uniqueOpensCount,2);
		  }else{
		  	echo $getreport->totalClicksCount;
		  }
		  //round($getreport->totalClicksPercent, 2)?></strong>%</strong><br />
 <span><?php echo $getreport->totalClicksCount?></span></td>
          <td valign="middle" class="cellCenter"><strong><?php echo round($getreport->totalBouncePercent,2)?>%</strong><br />
<span><?php echo $getreport->totalBounceCount?></span></td>
  <td valign="middle" class="cellCenter" ><strong>$<?php echo $totalAmountBilled?></td>
        
        </tr>
        <?php }?>
        <tr  class="no-border" >
          <td align="center" valign="top" class="b">&nbsp;</td>
          <td>&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
         <!-- <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>-->
        </tr>
      </tbody>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" class="graph-table-res">
      <tbody>
         
        <tr  >
        <td width="27" align="left" valign="top" >&nbsp;</td>
          <td width="466"  valign="middle">
          
    Averages across all <?php echo sizeof($dd)?> campaigns          </td>
          <td width="97" valign="middle" class="cellCenter" ><strong><?php //echo $send_total?></strong></td>
         
          <td width="97" valign="middle" class="cellCenter" ><strong><?php echo round($open_total/sizeof($dd),2)?>%
          </strong></td>
          <td width="87" valign="middle" class="cellCenter"><strong><?php echo round($click_total/sizeof($dd),2)?>%
          </strong></td>
          <td width="96" valign="middle" class="cellCenter"><strong><?php echo round($bounce_total/sizeof($dd),2)?>%
          </strong></td>
		   <td width="106" valign="middle" class="cellCenter" ><strong><?php //echo $amt_total?></strong></td>
        <!--   <td width="112" valign="middle" class="cellCenter"><strong><?php echo round($unsub_total/sizeof($dd),2)?>%
          </strong></td>
          <td width="105" valign="middle" class="cellCenter"><strong><?php echo round($compl_total/sizeof($dd),2)?>%</strong></td>-->
        </tr>
        <tr  >
          <td align="left" valign="top" >&nbsp;</td>
          <td  valign="middle">&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
        <!--  <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>-->
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
	<input type="hidden" name="cid" value="<?php echo $xcid?>" />
	<input type="hidden" name="cval" value="<?php echo $xvalues?>" />
Export this report as a <select >
              
              <option selected="selected"  >Select CSV</option>
          
            </select> </td>
    <td><input type="image" src="images/export.gif" name="export" id="export" value="Submit" class="export" /></td>
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
