<?php
session_start();
if($_SESSION['AdminID']=="" && (!isset($_SESSION['AdminID'])))
{
	header("location:index.php?msg=expired");
	exit;
}

?>