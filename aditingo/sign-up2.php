<?php 
define('WP_USE_THEMES', false);
require('wp-blog-header.php');

include(get_template_directory()."/includes/functions.php");
include_once(get_template_directory()."/includes/values.php");
session_start();
$object=new main();  
if($_SESSION['Memberemail']=='' || $_SESSION['metroIds']=='')
{		
		header("location:".get_page_link(5)."");
			exit;
}


if(isset($_POST['but']) && $_POST['but']!='' )
{
	$firstname=$_POST["fname"];
	$lastname=$_POST["lname"];
	$email=$_POST["email"];
	$username=$_POST["username"];
	$password=$_POST["pass"];
	$homecity=$_POST["city"];
	$month=$_POST["month"];
	$year=$_POST["year"];
	$dob=$year."-".$month;
	$gender=$_POST["gender"];
	$zipcode=$_POST["zip"];
	$education=$_POST["education"];
	$income=$_POST["income"];
	$interest=$_POST["interest"];
	$status="1";
	
	$date=date("Y:m:d H:i:s");	
	
	$error_message='';
		if(trim($_POST['username'])!='' && trim($_POST['pass'])!='')
		{
				$SqlGetUserDetails=sprintf("select * FROM tbl_members  where username='%s'",$_POST['username']);
				$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
				$numrows=$object->NumRows($QryGetUserDetails);
			
				if($numrows>0)
				{
					$error_message='Username already exists';
				
				}
				else
				{
			 $insert="INSERT INTO 	tbl_members(full_name,last_name,email_address,username,password,home_city,dob,gender,zipcode,education,income,interests_and_activities,date_created,contact_time,status) VALUES ('$firstname','$lastname','".$_SESSION['Memberemail']."','$username','$password','$homecity','$dob','$gender','$zipcode','$education','$income','$interest','$date','1','$status')"; 
			 $qry=$object->ExecuteQuery($insert);
			 if($qry)
			 {
			 
					$memberid=mysql_insert_id();
					$metroIds=$_SESSION['metroIds'];
					$metroIds=substr($metroIds,0,-1);
					$metroIds_array=explode(":",$metroIds);
					
					for($i=0;$i<count($metroIds_array);$i++)
					{
						 $metroIds_array[$i];
					//	echo "insert into tbl_ client_metropolitian(area_id,clientid) values('%d','%d')",$metroIds_array[$i],$clientid;
						//$insertMetroInfo=sprintf("insert into tbl_ client_metropolitian(area_id,clientid) values(%d,%d)",$metroIds_array[$i],$clientid);
						 $insertMetroInfo=sprintf("insert into tbl_member_metropolitian(area_id,memberid) values(%d,%d)",$metroIds_array[$i],$memberid);
						 $QryinsertMetroInfo=$object->ExecuteQuery($insertMetroInfo);
					}	
			 
			 
			 		unset($_SESSION['Memberemail']);
					unset($_SESSION['metroIds']);
					header("location:".get_page_link(58)."/?msg=reg");
					exit;
					
			  }

			
			}
		}
		else if(trim($_POST['username'])=='')
		{
				$error_message='Please enter Username';
		}
		else if(trim($_POST['pass'])=='')
		{
				$error_message='Please enter Password';
		}
}
list($birthdatemonths,$birthdatedays,$birthdateyears)=dateArray($_POST['month'],'',$_POST['year'],date("Y")-70,date("Y")-10);
?>
