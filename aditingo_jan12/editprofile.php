<?php 
session_start();
include_once('includes/session.php');
include_once("includes/header.php");
include_once("includes/functions.php");
include('includes/values.php');

$object=new main(); 
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
			header("Location:viewprofile.php?msg=2");
			exit;
			}
			
			
			
			
}
	$SqlGetMembers=sprintf("select * from tbl_members  where memberid=$memberid");
$QryGetMembers=$object->ExecuteQuery($SqlGetMembers);
$cols=$object->NumRows($QryGetMembers);
$GetMembersResult=$object->FetchArray($QryGetMembers);

$date=explode("-",$GetMembersResult['dob']);
list($birthdatemonths,$birthdatedays,$birthdateyears)=dateArray($date[1],'',$date[0],date("Y")-70,date("Y")-10);


if($GetMembersResult['gender']=='female')
$female_checked="checked='checked'";
if($GetMembersResult['gender']=='male')
$male_checked="checked='checked'";
?>

      <form action="editprofile.php"   name="regisstration" method="post" onsubmit="return editformvalidate()"><div id="div-Form">
        <div class="form-title">EDIT  Profile</div>

        <div class="register-form">
      	  <dl class="form1"><div class="errer-mess2" align="center"><?php echo $error_message;?></div>
          <dt>Full Name</dt><dd><input type="text" name="fullname"  id="fullname"  value="<?php echo isset($_POST['fullname'])?$_POST['fullname']:stripslashes($GetMembersResult['full_name']); ?>">
          </dd>  <dt>Full Name</dt><dd><input type="text" name="lastname"   id="lastname"  value="<?php echo isset($_POST['lastname'])?$_POST['lastname']:stripslashes($GetMembersResult['last_name']); ?>">
          </dd>
          
          
          <dt>Email address</dt><dd><input name="email"  id="email" type="text" value="<?php echo isset($_POST['email'])?$_POST['email']:stripslashes($GetMembersResult['email_address']); ?>" onchange="member_emailcheck(this.value,'emailerr')">
		  <input type="hidden" name="emailerr" id="emailerr" value=""/>
          </dd>
          <dt>User Name</dt><dd><input name="username"  id="username" type="text" value="<?php echo isset($_POST['username'])?$_POST['username']:stripslashes($GetMembersResult['username']); ?>" onchange="usernamechk(this.value,'usererr')">
		    <input type="hidden" name="usererr" id="usererr" value=""/>
          </dd>
          <dt>Password</dt><dd><input name="pass"  id="pass" type="text" value="<?php echo isset($_POST['pass'])?$_POST['pass']:stripslashes($GetMembersResult['password']); ?>">
         <input type="hidden" name="metroIds" id="metroIds"/> </dd>
		           <dt>Home City</dt><dd><input type="text" name="city" id="city"    value="<?php echo isset($_POST['city'])?$_POST['city']:$GetMembersResult['home_city'];?>"/></dd>

          <dt>Date of Birth</dt><dd>
		  <select name="month" id="month"><option value="">Month</option><?php echo $birthdatemonths;?></select> 
          
         &nbsp; <select name="year" id="year"><option value="">Year</option><?php echo $birthdateyears;?></select></dd>
          <dt>Gender</dt><dd class="gender">
          	<input name="gender"  id="gender1" type="radio" value="male" <?php echo $male_checked;?>/> Male&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="gender" id="gender2"  type="radio" value="female" <?php echo $female_checked;?>/> Female
          </dd>
          <dt>Zip Code</dt><dd><input name="zipcode"  id="zipcode" type="text" value="<?php echo isset($_POST['zipcode'])?$_POST['zipcode']:stripslashes($GetMembersResult['zipcode']); ?>">
          </dd>
          <dt>Education</dt><dd><select name="education" id="education"><option value="">Select</option>
		 <?php echo getEducation(isset($_POST['education'])?$_POST['education']:$GetMembersResult['education']);?></select>
          </dd>
          <dt>Income</dt><dd>
		 
		  <select name="income" id="income" >
		  <option value="">Select Income</option>
		  <?php echo getIncome(isset($_POST['income'])?$_POST['income']:$GetMembersResult['income']);?>
		  </select>
          </dd>
          <dt>Interests and Activities</dt><dd><select name="interest" id="interest" >
								<option value="">Select Interest And Activities</option>
                  <?php
							echo IntrestAndActivities(isset($_POST['interest'])?$_POST['interest']:$GetMembersResult['interests_and_activities']);
		 		  ?>
                        </select>
          </dd>
          <dt>How often they like to be contacted</dt><dd>
		  <select name="contact_info" id="contact_info" >
         <?php echo Contact_info_data(isset($_POST['contact_info'])?$_POST['contact_info']:$GetMembersResult['contact_time']);?> </select>
          </dd>   
          <dt> Subscriptions List</dt><dd>  
           <div class="subscriptions">
                <ul class="subscriptions-fields">
                     <?php
					  $object=new main;
			echo $object->GetmetropolitianareasCheckbox($memberid,'member');
		   ?>
                </ul>
          </div>
          </dd>   
          <dt> </dt><dd> <input type="submit" class="greenButton"   name="submit" value="Update" />
          </dd>   
       </dl>
        
            
       </div>
      </div></form>
 <?php include_once("includes/sidebar.php"); ?>
 <?php include_once("includes/footer.php"); ?>
