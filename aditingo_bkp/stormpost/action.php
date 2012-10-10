<style type="text/css">
<!--
.style1 {font-size: 18px}
a{color:#0099FF; text-decoration:none;}
a:hover{color:#0066FF;}

-->
</style>
<?php
include "dbcon.php";
extract($_POST);
/*laxmi.kotni@gmail.com,rama.ritwik@yopmail.com,rama@ritwik.com*/
$wsdl = 'http://api.stormpost.datranmedia.com/services/SoapRequestProcessor?wsdl';
$soapClient = new SoapClient($wsdl);
$login = new SOAPHeader($wsdl, 'username', 'soap@conglomeratenetwork.com');
$password = new SOAPHeader($wsdl, 'password', 'Password2');
$headers = array($login, $password);
$soapClient->__setSOAPHeaders($headers);
echo "<a href='index.php' class='style1'>Home</a><br>";
// Create and send msg ///////////////////////////////////////////////////////////////////////////////////
if($_GET['act']=='create_send'){
$html_content = stripslashes($htmlContent);
	$cstb = array("title"=>$title, "subject"=>$subject, "fromEmail"=>"rama@ritwik.com", "fromName"=>"rama", "toEmail"=>"rama.ritwik@yopmail.com", "toName"=>"laxmi", "replyToEmail"=>"rama@ritwik.com", "replyToName"=>"rama", encoding=>"quoted-printable", "Charset"=>"ISO-8859-1", "trackType"=>"ALL", "openTrackType"=>"HTML", "clickStreamType"=>"ALL", "brandID"=>"1","enabled"=>"TRUE" );
	$arr=explode(",",$mails);
	$i=0;$tt=array();
	foreach ($arr as $value) {
		if($i==sizeof($arr)-1)$tt[$i] = array("address" => $value);	
		else{
  			$tt[$i] = array("address" => $value);$i++;
		}
	}
	try{
		$cst_res = $soapClient->__call("createSendTemplate", array($cstb,$textContent,$html_content));
		$smft_res =  $soapClient->__call("sendMessagesFromTemplate", array($cst_res, $tt));
		echo "<br>Compaign created and sent to ".sizeof($arr)." mails successfully";
		$ins_campaigns=mysql_query("insert into `campaign` (`cid`, `members`, `mid`, `date`)values('".$cst_res."', '".sizeof($arr)."', '".$smft_res."', now())");
		$ins_report=mysql_query("insert into `reports` (`cid`, `mid`)values('".$cst_res."', '".$smft_res."')");
	} catch (SoapFault $fault) {
		$error = "cstb_error";
	}
}
// Create msg ///////////////////////////////////////////////////////////////////////////////////
if($_GET['act']=='create'){
//print_r($_POST);
$html_content = stripslashes($htmlContent);
	$cstb = array("title"=>$title, "subject"=>$subject, "fromEmail"=>"rama@ritwik.com", "fromName"=>"rama", "toEmail"=>"rama.ritwik@yopmail.com", "toName"=>"laxmi", "replyToEmail"=>"rama@ritwik.com", "replyToName"=>"rama", encoding=>"quoted-printable", "Charset"=>"ISO-8859-1", "trackType"=>"ALL", "openTrackType"=>"HTML", "clickStreamType"=>"ALL", "brandID"=>"1","enabled"=>"TRUE" );
	try{
		$cst_res = $soapClient->__call("createSendTemplate", array($cstb,$textContent,$html_content));
		echo "<br> Compaign created";
	} catch (SoapFault $fault) {
		$error = "cstb_error";
	}
}
// Sending mails ///////////////////////////////////////////////////////////////////////////////////

if($_GET['act']=='sending'){
	$arr=explode(",",$mails);
	$i=0;$tt=array();
	foreach ($arr as $value) {
		if($i==sizeof($arr)-1)	$tt[$i] = array("address" => $value);
		else{
  			$tt[$i] = array("address" => $value);$i++;
		}
	}
	try{
		$smft_res =  $soapClient->__call("sendMessagesFromTemplate", array($cid, $tt));
		echo "<br>Compaign sent to ".sizeof($arr)." mails successfully";
		$sel=mysql_fetch_array(mysql_query("select * from `campaign` where cid=$cid"));
		$mem=$sel['cid']+sizeof($arr);
		$upd=mysql_query("update `campaign` set `members`='".$mem."'");
	} catch (SoapFault $fault) {
		$error = "smft_error";
	}
}
// Genarating Reports ///////////////////////////////////////////////////////////////////////////////////

if($_GET['act']=='report'){
	$gdmr=array("mailingId"=>$rid);
	try{
		$gdmr_res =  $soapClient->__call("getDetailedMailingReport", $gdmr);
		echo "<pre>";print_r ($gdmr_res);echo "</pre>";
		//echo $gdmr_res->mailingID;
	} catch (SoapFault $fault) {
		$error = "gdmr_error";
	}
}
switch($error){
	case "cstb_error": echo $fault->faultcode."-".$fault->faultstring;	break;
	case "smft_error": echo $fault->faultcode."-".$fault->faultstring;	break;
	case "gdmr_error": echo $fault->faultcode."-".$fault->faultstring;	break;
} 
if($_GET['act']=='preport'){
	//$gdmr=array("mailingId"=>$rid);
	try{
		//$gdmr_res =  $soapClient->__call("getDetailedMailingReport", $gdmr);
		//echo "<pre>";print_r ($gdmr_res);echo "</pre>";
		//echo $gdmr_res->mailingID;
		//$upd=mysql_query("update `reports` set `open`='".$gdmr_res->openLinkCount."', `unique`='".$gdmr_res->uniqueOpensCount."', `unsub`='".$gdmr_res->unsubscribeResponsesCount."', `complaint`='".$gdmr_res->complaintResponsesCount."', `reply`='".$gdmr_res->replyResponsesCount."'");
		include "try2.php";
	} catch (SoapFault $fault) {
		$error = "gdmr_error";
	}
}
if($_GET['act']=='greport'){
	// Report
	try{
		//$gdmr_res =  $soapClient->__call("getDetailedMailingReport", $gdmr);
		//echo "<pre>";print_r ($gdmr_res);echo "</pre>";
		//echo $gdmr_res->mailingID;
		//$upd=mysql_query("update `reports` set `open`='".$gdmr_res->openLinkCount."', `unique`='".$gdmr_res->uniqueOpensCount."', `unsub`='".$gdmr_res->unsubscribeResponsesCount."', `complaint`='".$gdmr_res->complaintResponsesCount."', `reply`='".$gdmr_res->replyResponsesCount."'");
		include "try2.php";
	} catch (SoapFault $fault) {
		$error = "gdmr_error";
	}
}
switch($error){
	case "cstb_error": echo $fault->faultcode."-".$fault->faultstring;	break;
	case "smft_error": echo $fault->faultcode."-".$fault->faultstring;	break;
	case "gdmr_error": echo $fault->faultcode."-".$fault->faultstring;	break;
} 
?>