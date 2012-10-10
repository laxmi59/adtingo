<?php
session_start();
if($_SESSION['clientid']=="")
{
	header("location:login.php?msg=exp");
	exit;
}

?>