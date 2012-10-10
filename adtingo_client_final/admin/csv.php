<?php 
include "includes/dbclass.php";
$con=new DBConnect();
$con->OpenConnection();
function expt($aaa){
	$f = fopen ('unsubscribe_users.csv','w');
	fputs($f, $aaa);
	fclose($f);
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename="unsubscribe_users.csv"');
	readfile('unsubscribe_users.csv');
}
$income_array=array('1'=>"Below $25000",'2'=>"$25000 to $50000",'3'=>"$50000 to $75000",'4'=>"$75000 to $100000",'5'=>"$100000 or more");

$out = "full_name, last_name, email_address, dob, gender, zipcode, income \n";
$members=mysql_query("select * from `tbl_members`");
while($members_fet=mysql_fetch_array($members)){
	$metro=mysql_num_rows(mysql_query("select * from `tbl_member_metropolitian` where memberid=$members_fet[memberid]"));
	if(!$metro){
		$out .= $members_fet['full_name'].",";
		$out .= $members_fet['last_name'].",";
		$out .= $members_fet['email_address'].",";
		$out .= $members_fet['dob'].",";
		$out .= $members_fet['gender'].",";
		$out .= $members_fet['zipcode'].",";
		$out .= $income_array[$members_fet['income']]."\n";
	}
}

$tt=expt($out);

?>	

