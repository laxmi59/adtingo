<?php
ob_start();
session_start();
include('includes/functions.php');
$object=new main();
if(isset($_REQUEST['clientID']) && $_REQUEST['clientID']!='')
{
		$ClientId=base64_decode($_REQUEST['clientID']);
		$postdate=date("Y-m-d H:i:s");
		$updatuserstatus=sprintf("Update tbl_clients set status='%s' where clientid=%d",$object->stripper(1),$object->stripper($ClientId));
		
		$resupdatuserstatus=$object->ExecuteQuery($updatuserstatus);
	$checkusername=sprintf("select * from tbl_clients where clientid=%d and status=%d",$object->stripper($ClientId),$object->stripper(1));
	$chkresult=$object->ExecuteQuery($checkusername);
	$object->NumRows($chkresult);
	if($object->NumRows($chkresult)>0)
	{
		$chkrows=$object->FetchArray($chkresult);
		//$_SESSION['clientid']=$chkrows['clientid'];
		header("Location:login.php?msg=confirmed");
		exit;
	}
}
?>