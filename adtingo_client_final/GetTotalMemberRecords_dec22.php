<?php
include('includes/functions.php');
$minage=$_GET['minage'];
$maxage=$_GET['maxage'];
$gender=$_GET['gendersel']; 
$incomeval=$_GET['income'];
$arealist=$_GET['area_list'];
$zipcodes=$_GET['zipcode'];
$zipcodedist=$_GET['radious'];
$scheduleDate=$_GET['shddate'];
$random_number=$_GET['random_number'];
$where=1;
//echo $gender;
if($arealist!="")
	$where.=" and tbl_member_metropolitian.area_id=".$arealist."";

if($gender!="" && $gender!="both" && $gender!="undefined")
	$where.=" and tbl_members.gender='".$gender."'";

if($incomeval!="" && $incomeval!="0" && $incomeval!="undefined")
{
	$where.=" and tbl_members.income =".$incomeval."";
}
if($zipcodes!="" &&  $zipcodedist=="")
	$where.=" and tbl_members.zipcode='".$zipcodes."'";
if($minage!=""  && $maxage!="" && $maxage!="0")
{
	#$where.="  and YEAR(CURRENT_DATE)-YEAR(dob)>=".$minage." and YEAR(CURRENT_DATE)-YEAR(dob)<=".$maxage."";
	$minYear=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"),date("Y")-$minage));
	$maxYear=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"),date("Y")-$maxage));
	$where.="  and dob BETWEEN ".$maxYear." and ".$minYear." ";
}

if($zipcodes!="" && $zipcodedist!="")
{
	$pcode=$zipcodes;
	$miles=$zipcodedist;
	$GetLogLattitudedetailsqry="select  distinct  LATITUDE,LONGITUDE from zip_code where ZIP_CODE=".$pcode."";
	$GetLogLattitudedetailsRes=$object->ExecuteQuery($GetLogLattitudedetailsqry);
	$object->NumRows($GetLogLattitudedetailsRes); 
	$tt=$object->FetchArray($GetLogLattitudedetailsRes);
	
	$sel="select distinct ZIP_CODE ,LATITUDE,LONGITUDE, (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) as distance from zip_code  where (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) 
	< $miles order by distance";
	$GetAllZipcodesres=$object->ExecuteQuery($sel);
	$zipcodedb=array();
	$object->NumRows($GetAllZipcodesres); 
	while($GetAllZipcodesrec=$object->FetchArray($GetAllZipcodesres))
	{
		$zipcodedb[]=$GetAllZipcodesrec['ZIP_CODE'];
	}
	
	if(count($zipcodedb)>0 && $zipcodedb!='undefined')
	{
		$Dbzipcodes=implode(",",$zipcodedb);
		$where.="  and tbl_members.zipcode IN (".$Dbzipcodes.")";
	}
	else
		$where.="  and tbl_members.zipcode IN (0)";
}
/*if($random_number!="")
{
	$randcon.=" ORDER BY RAND() LIMIT ".$random_number.";";
}*/

$where_1 = $where;
  $SqlSearch_result="select distinct tbl_members.memberid,contact_time from tbl_members,tbl_member_metropolitian,tbl_listedmembers  where $where and tbl_members.memberid = tbl_member_metropolitian.memberid and tbl_members.memberid=tbl_listedmembers.memberid and tbl_member_metropolitian.memberid=tbl_listedmembers.memberid";    
$ResSearch_result=$object->ExecuteQuery($SqlSearch_result);
// $TotalSearchRecords=$object->NumRows($ResSearch_result);
$TotalSearchRecordslist="0";
$scheduleDate1=explode("-",$scheduleDate);
while($ResSearch_resultRec=$object->FetchArray($ResSearch_result))
{
	/*
	$GetAllRecordsQry="select 1 from tbl_listedmembers where memberid=".$ResSearch_resultRec['memberid']."";
	
	$GetAllRecordsRes=$object->ExecuteQuery($GetAllRecordsQry);
	$GetTotalRec =$object->NumRows($GetAllRecordsRes);
	if($GetTotalRec >0)
	{ 
	*/

		$where=1;

		switch ($ResSearch_resultRec['contact_time']) {
		case 1:
			$where.="  and schedule_date='".$scheduleDate."'";
			break;
		case 2:
			$Contact_date1=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]-7, $scheduleDate1[0]));
			$Contact_date2=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]+7, $scheduleDate1[0]));

			$where.=" and (schedule_date >='".$Contact_date1."' AND schedule_date <='".$Contact_date2."')";
			break;
		case 3:
			$Contact_date1=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]-14, $scheduleDate1[0]));
			$Contact_date2=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]+14, $scheduleDate1[0]));
			$where.=" and (schedule_date >='".$Contact_date1."' AND schedule_date <='".$Contact_date2."')";
			break;
		case 4:
			$Contact_date1=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]-30, $scheduleDate1[0]));
			$Contact_date2=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]+30, $scheduleDate1[0]));
			$where.=" and (schedule_date >='".$Contact_date1."' AND schedule_date <='".$Contact_date2."')";
			break;
		case 5:
			$Contact_date1=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]-90, $scheduleDate1[0]));
			$Contact_date2=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]+90, $scheduleDate1[0]));
			$where.=" and (schedule_date >='".$Contact_date1."' AND schedule_date <='".$Contact_date2."')";
			break;
		}
	
		
		$GetTotalRecordsToSent="select 1 from tbl_listedmembers where $where and memberid=".$ResSearch_resultRec['memberid']."";    
		//echo $GetTotalRecordsToSent;
		$GetTotalRecordsToSentRes=$object->ExecuteQuery($GetTotalRecordsToSent);
		$TotalSearchRecords =$object->NumRows($GetTotalRecordsToSentRes);
		
		if($TotalSearchRecords == 0)
		{
			$TotalSearchRecordslist = $TotalSearchRecordslist+1;
			$GetTotalSearchListRecords[]=$ResSearch_resultRec['memberid'];
		}
	#}
	
	
}

  $SqlSearch_result="select  tbl_members.memberid,contact_time from tbl_members left join tbl_listedmembers on  tbl_members.memberid=tbl_listedmembers.memberid  ,tbl_member_metropolitian  where $where_1 and tbl_members.memberid = tbl_member_metropolitian.memberid and tbl_listedmembers.memberid is NULL";    
$ResSearch_result=$object->ExecuteQuery($SqlSearch_result);
// $TotalSearchRecords=$object->NumRows($ResSearch_result);
$scheduleDate1=explode("-",$scheduleDate);
while($ResSearch_resultRec=$object->FetchArray($ResSearch_result))
{
	
	$TotalSearchRecordslist=$TotalSearchRecordslist+1;
	$GetTotalSearchListRecords[]=$ResSearch_resultRec['memberid'];
}

//$GetTotalSearchListRecords1=implode(",",$GetTotalSearchListRecords);
echo $TotalSearchRecordslist;
//echo $TotalSearchRecordslist;
?>
