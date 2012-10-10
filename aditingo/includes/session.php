<?php
session_start();

if($_SESSION['memberid']=="")
{
	header("location:login.php?msg=exp");
	exit;
}

?>