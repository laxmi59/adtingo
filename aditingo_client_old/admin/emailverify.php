<?php
include("includes/set_env.php");
include("includes/functions.php");
$email=$_GET['reg_email'];
$clientid=$_GET['cid'];
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

?>
