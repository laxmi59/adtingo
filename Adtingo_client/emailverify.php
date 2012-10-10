<?php
include('includes/functions.php');
$email=$_GET['reg_email'];
$Username=$_GET['reg_username'];

$t="";
if($email!="")
{

 	$user_email_check_qry=sprintf("select * from tbl_clients where email_address='%s'",$object->stripper($email));
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

 	$user_name_check_qry=sprintf("select * from tbl_clients where 	username='%s'",$object->stripper($Username));
	$UserNamechkresult=$object->ExecuteQuery($user_name_check_qry);
	//$ResInfo=$object->FetchArray($chkresult);
	$User_rows=$object->NumRows($UserNamechkresult);
	if($User_rows>0)
	{
		echo "2";
	}
}

?>
