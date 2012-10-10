<?php 
include_once('/var/www/client/includes/functions_cron.php'); 
include_once('/var/www/client/includes/values_cron.php'); 
$mess="";
$current_date=date("Y-m-d H:i:s");
$filename="sample_list.csv";
$destination="/var/www/client/admin/uploads/$filename"; 
$row = 0;
$handle = fopen($destination, "r");
$subject = "Membership Confirmation Mail From Adtingo";
$fileName = "/var/www/wp-content/themes/adtingo/templates/member_welcome_template.html";		
if(file_exists($fileName))
{
	$emailText = file_get_contents($fileName); 
}
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	if ($row > 0) {
       	$name = $data[0];  
		$lastname=$data[1]; 		
		$email = $data[2];
		$cityname=$data[3]; 
		$dob = $data[4];		
		$gender = $data[5];	
		$zipcode = $data[6];
		$education = $data[7];
		$income = $data[8];
		$interest = $data[9];	
		$arealist = $data[10];
	    $current_date=date("Y-m-d H:i:s",time());
		if($email!='')
		{
			//interest and activities
			$interestkey='';
			foreach($Intrest_and_activitise as $key=>$val)
			{
				if(strtolower($val)== strtolower($interest))
				$interestkey=$key;
			}
			$incomekey='';
			foreach($income_array as $key=>$val)
			{
				if($val==$income)
				$incomekey=$key;
			}
			$educationkey='';
			foreach($education_array as $key=>$val)
			{
				if(strtolower($val)==strtolower($education))
				$educationkey=$key;
			}
			//check if email/username already exists
		  	$SqlGetInfo="select * from tbl_members  where email_address='".$email."' ";//exit;
		  	$QryGetInfo=$object->ExecuteQuery($SqlGetInfo);
		   	$numrows=mysql_num_rows($QryGetInfo);
			if($numrows == 0) 
			{	
				//echo $arealist."<br>";
				$rand_numbers=preg_replace('/([ ])/e', 'chr(rand(48,57))', '  ');
				$rand_alpha=preg_replace('/([ ])/e', 'chr(rand(97,122))', '   ');
				$new_rand_pwd=$rand_numbers.$rand_alpha;			 
				$insertMember=sprintf("insert into tbl_members(full_name,last_name,email_address,password,home_city,dob,gender,zipcode,education,income,  	interests_and_activities,date_created,status,contact_time)
			values('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$name,$lastname,$email,$new_rand_pwd,$cityname,$dob,$gender,$zipcode,$educationkey,$incomekey,$interestkey,$current_date,'1','1'); 		
				//echo $insertMember;
				$resinsertmember=$object->ExecuteQuery($insertMember);
				$member_id=mysql_insert_id();
				// mail code	
				$to=$email;
				//echo $emailText;
				$htmMsg = nl2br($email);
				$htmMsg1 = nl2br($new_rand_pwd);
				$htmMsg2 = nl2br(date('F d, Y'));
				$mailMessage = str_replace("#EMAIL#", "$htmMsg", $emailText);
				$mailMessage = str_replace("#PASSWORD#", "$htmMsg1", $mailMessage);
				$mailMessage = str_replace("#DATE#", "$htmMsg2", $mailMessage);
				//echo $mailMessage;		
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:Adtingo.com <info@adtingo.com>" ."\r\n";
				$headers .= 'Reply-To: adtingo <info@adtingo.com>'."\r\n";
				
				if(mail($to,$subject,$mailMessage,$headers)){}	

				$all_areaList=explode(",",$arealist);
				for($s=0;$s<count($all_areaList);$s++){
				$SqlGetListInfo="select * from tbl_metropolitian_list where area_name='$all_areaList[$s]'";  
				$QryGetListInfo=$object->ExecuteQuery($SqlGetListInfo);
				//echo $SqlGetListInfo;
					while($ResGetListInfo=$object->FetchArray($QryGetListInfo))
					{
						$insertarealist=sprintf("insert into tbl_member_metropolitian(area_id,memberid)
							 values(%d,%d)",$ResGetListInfo['area_id'],$member_id);
						$insertUserarealistRes=$object->ExecuteQuery($insertarealist);
					}
				}//for
				$mess="<span class='errer-mess2'>Data has been imported successfully</span>";
				$k=0;
			}	
			$k++;
		}
	}
	$row++;
}
fclose($handle);


?>
