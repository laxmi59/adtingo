<?php
include('includes/functions.php');
$Camid=$_GET['cid'];
$object=new main();
 $GetAllRecordsqry="select * from tbl_listedmembers where campaign_id='".$Camid."'";
$GetAllRecordsRes=$object->ExecuteQuery($GetAllRecordsqry);
 $totalRecords=$object->NumRows($GetAllRecordsRes); 
echo $totalRecords;
?>
