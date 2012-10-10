<?php
include("includes/set_env.php");
include("includes/functions.php");
$email=$_GET['reg_email'];
$clientid=$_GET['cid'];
$cityname=$_GET['cityname'];
$object=new main();
if($email!="")
{
$t="Email Aadress is already exists.  Please enter another email";
 $SqlGetUserFlag=sprintf("select * from tbl_clients WHERE clientid !=$clientid and email_address='".$email."'"); 
$QryGetUserFlag=$object->ExecuteQuery($SqlGetUserFlag);
$email_count_rows=$object->NumRows($QryGetUserFlag);
if($email_count_rows>0)
	{
		echo $t;
	}
	
	
}

if($cityname!="")
{
$user_name_check_qry=sprintf("select * from `tbl_metropolitian_list` where 	area_name='%s'",$object->stripper($cityname));
	$UserNamechkresult=$object->ExecuteQuery($user_name_check_qry);
	//$ResInfo=$object->FetchArray($chkresult);
	$User_rows=$object->NumRows($UserNamechkresult);
	if($User_rows>0)
	{
		echo "2";
	}
	
}

