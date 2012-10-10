<?php
session_start();
include("../set_env.php");
include("../includes/functions.php");

$memberid=$_SESSION['memberid'];
$t="";
$object=new main();
if($_GET['member_reg_email']!='')
{	
	if($memberid!='')
	$SqlGetUserDetails=sprintf("select * FROM tbl_members  where email_address='%s' AND memberid!=%d ",$object->stripper($_GET['member_reg_email']),$memberid);
	else
	$SqlGetUserDetails=sprintf("select * FROM tbl_members  where email_address='%s'",$object->stripper($_GET['member_reg_email']));
	$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
	$numrows=$object->NumRows($QryGetUserDetails);
	if($numrows>0)
	echo "1";
}
if($_GET['reg_username']!='')
{
	if($memberid!='')
	$SqlGetUserDetails=sprintf("select * FROM tbl_members  where username='%s'  AND memberid!=%d ",$object->stripper($_GET['reg_username']),$memberid);
	else
	$SqlGetUserDetails=sprintf("select * FROM tbl_members  where username='%s'",$object->stripper($_GET['reg_username']));
	$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
	$numrows=$object->NumRows($QryGetUserDetails);
	if($numrows>0)
	echo "1";
}


?>