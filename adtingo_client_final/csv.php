<?php 
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


extract($_POST);

$dd=explode(",",$cid);
$dval1=stripslashes($cval);
$dval2=str_replace("'","",$dval1);
$dval=explode(",",$dval2);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function expt($aaa){
	$f = fopen ('campaigns.csv','w');
	fputs($f, $aaa);
	fclose($f);
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename="campaigns.csv"');
	readfile('campaigns.csv');
}
//$out .= "Campaign_name,Opens,Clicks,Bounces,Unsubscribs,Complaints \n";
$out .= "Campaign Name,Total Mailed,Opens,Clicks,Bounces,Cost \n";
for($i=0;$i<sizeof($dd);$i++){
	$book=mysql_fetch_array(mysql_query("select * from `tbl_reports` where cid='$dd[$i]'"));
	$camp= mysql_fetch_array(mysql_query("select * from `tbl_campaigns` WHERE `campaign_id`=$dd[$i]"));
	$SelectUnsubMembers=mysql_num_rows(mysql_query("select * from `tbl_unsubscribe` where campaign_id=$dd[$i]"));
	$SelectFarwardMembers=mysql_num_rows(mysql_query("select * from `tbl_emailtofrd` where campaign_id=$dd[$i]"));
	$getreport=charts($camp['mailing_ID']);
	$opn2=$getreport->deliveredCount*$getreport->uniqueOpensCount/100;
	
	if($getreport->deliveredCount <= 85000)
		$totalAmountBilled=(50+($getreport->deliveredCount*0.03));
	else if($getreport->deliveredCount > 85000 && $getreport->deliveredCount <= 150000)
		$totalAmountBilled=(25+($getreport->deliveredCount*0.03));
	else if($getreport->deliveredCount > 150000)
		$totalAmountBilled=($getreport->deliveredCount*0.025);
			
	$send_total=$send_total+$getreport->scheduledCount;
		$amt_total=$amt_total+$totalAmountBilled;
		
		
		$open_total = $open_total + $opn2;
		$click_total = $click_total + ($getreport->totalClicksCount*100)/$getreport->uniqueOpensCount;
		$bounce_total = $bounce_total + $getreport->totalBouncePercent;
		//$unsub_total = $unsub_total + ($SelectUnsubMembers*100)/$getreport->deliveredCount;
		//$compl_total = $compl_total + $getreport->complaintResponsesPercent;
	$out .=$dval[$i].",";
	$out .=$getreport->scheduledCount.",";
	$out .=$book['open_percent']."% ,";
	$out .=$book['click_percent']."% ,";
	$out .=$book['bounce_percent']."% ,";
	$out .=$totalAmountBilled."\n";
	//$out .=$book['unsub_percent']."% ,";
	//$out .=$book['compl_percent']."% \n";
}
$out .="\n\nTotal".",";
$out .=",";
$out .=round($open_total/sizeof($dd),2)."% ,";
$out .=round($click_total/sizeof($dd),2)."% ,";
$out .=round($bounce_total/sizeof($dd),2)."% ,";
$out .="\n";
//$out .=round($unsub_total/sizeof($dd),2)."% ,";
//$out .=round($compl_total/sizeof($dd),2)."% \n";
//echo $out;
$tt=expt($out);
?>