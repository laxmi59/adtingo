<?php
include('includes/functions.php');
$email=$_GET['client_reg_email'];
$Username=$_GET['client_user_chk'];
$clientID=$_SESSION['clientid'];
$t="";
if($email!="")
{

 	$user_email_check_qry=sprintf("select * from tbl_clients where email_address='%s' and clientid!=%d",$object->stripper($email),$object->stripper($clientID));
	$chkresult=$object->ExecuteQuery($user_email_check_qry);
	//$ResInfo=$object->FetchArray($chkresult);
	$rows=$object->NumRows($chkresult);
	if($rows>0)
	{
		echo "1";
	}
}
if($Username!="")
{

 	$user_name_check_qry=sprintf("select * from tbl_clients where 	username='%s' and clientid!=%d ",$object->stripper($Username),$object->stripper($clientID));
	$UserNamechkresult=$object->ExecuteQuery($user_name_check_qry);
	//$ResInfo=$object->FetchArray($chkresult);
	$User_rows=$object->NumRows($UserNamechkresult);
	if($User_rows>0)
	{
		echo "2";
	}
}

?>
