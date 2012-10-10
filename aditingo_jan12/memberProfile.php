<?php 
define('WP_USE_THEMES', false);
require('wp-blog-header.php');

include(get_template_directory()."/includes/functions.php");
include_once(get_template_directory()."/includes/values.php");
session_start();
$object=new main();  
	//print_r($_POST);
	
$memberid=$_SESSION['memberid']; 
if($_POST['submit']!='')
	{

		$DateOfBirth=$_POST['year'].'-'.$_POST['month'].'-01';
		
		 $SqlGetUserDetails=sprintf("select * FROM tbl_members  where memberid!=%d AND (username='%s' OR email_address='%s')",$memberid,$_POST['username'],$_POST['email']); 
		$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
		$QryGetUserResults=$object->FetchArray($QryGetUserDetails);
		$numrows=$object->NumRows($QryGetUserDetails);
	
	
		if($numrows==2)
		{
			$error_message='Username and Email already exists';
		}
		else if($numrows>0)
		{
			
			if($QryGetUserResults['email_address']==$_POST['email'])
			$error_message='Email already exists';
			else if($QryGetUserResults['username']==$_POST['username'])
			echo $error_message='Username already exists';
		}
		else
		{
		
		
		$updateuserinfo=sprintf("update tbl_members set full_name='%s',last_name='%s', email_address='%s', username='%s', password='%s',home_city='%s',dob='%s', gender='%s',zipcode='%s', education='%s',income='%s',interests_and_activities='%s',contact_time=%d   where memberid=%d",$object->stripper($_POST['fullname']),$object->stripper($_POST['lastname']),$object->stripper($_POST['email']),$object->stripper($_POST['username']),$object->stripper($_POST['pass']),$object->stripper($_POST['city']),$object->stripper($DateOfBirth),$object->stripper($_POST['gender']),$object->stripper($_POST['zipcode']),$object->stripper($_POST['education']),$object->stripper($_POST['income']),$object->stripper($_POST['interest']),$object->stripper($_POST['contact_info']),$memberid); 
$QryinsertMemInfo=$object->ExecuteQuery($updateuserinfo);

			
			$metroIds=$object->stripper($_POST['metroIds']);
			$metroIds=substr($metroIds,0,-1);
			$metroIds_array=explode(":",$metroIds);
	
			
		//	$Getres=$object->DeleteData("tbl_member_metropolitian","memberid=".$memberid); 
			$Getres=$object->ExecuteQuery("DELETE  FROM tbl_member_metropolitian WHERE memberid=".$memberid."");
			for($i=0;$i<count($metroIds_array);$i++)
			{
				 $metroIds_array[$i];
				 $insertMetroInfo=sprintf("insert into tbl_member_metropolitian(area_id,memberid) values(%d,%d)",$metroIds_array[$i],$memberid);
					 $QryinsertMetroInfo=$object->ExecuteQuery($insertMetroInfo);
				
			}
			$msg="update"; 
			header("location:".get_page_link(38)."/?msg=2");
			exit;
			}
		
			
			
}