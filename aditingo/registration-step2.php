<?php 
session_start();
include_once("includes/header.php");
include_once("includes/values.php");
include_once("includes/functions.php");

if($_SESSION['Memberemail']=='' || $_SESSION['metroIds']=='')
header("Location:registration.php");


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
					header("Location:./login.php?msg=reg");
					exit;
			  }

			if($qry)
			{
				header("location:login.php");
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
  
 <form action="" name="regisstration" method="post" onSubmit="return validateregisstrationform();" ><div id="div-Form">
       
	    <div class="form-title">Create  Profile Step2</div><div class="requiredfields"><span class="red">*</span> Required Fields </div>

        <div class="register-form">	<div class="errer-mess2" align="center"><?php echo $error_message;?></div>
      	  <dl class="form1">
          <dt>First Name  <span class="red">*</span></dt>
          <dd><input type="text" name="fname" id="fname"  value="<?php echo $_REQUEST['fname'];?>"/>
          </dd>
          <dt>Last Name  <span class="red">*</span></dt>
          <dd><input type="text" name="lname" id="lname"  value="<?php echo $_REQUEST['lname'];?>" />
          </dd>
          <dt>User Name  <span class="red">*</span></dt><dd><input type="text" name="username" id="username" value="<?php echo $_REQUEST['username'];?>" onchange="usernamechk(this.value,'usererr')"/> <input type="hidden" name="usererr"  id="usererr" value=""/></dd>
          <dt>Password  <span class="red">*</span></dt><dd><input type="password" name="pass"   value="<?php echo $_REQUEST['pass'];?>"/></dd>
          <dt>Home City  <span class="red">*</span></dt><dd><input type="text" name="city" id="city"    value="<?php echo $_REQUEST['city'];?>"/></dd>
           <dt>Date of Birth  <span class="red">*</span></dt><dd><select name="month"  class="w-127" id="month"><option value="">Month</option><?php echo $birthdatemonths;?></select> &nbsp; <select name="year" id="year"  class="w-127"><option value="">Year</option><?php echo $birthdateyears;?></select>
        
         </dd>
          <dt>Gender  <span class="red">*</span></dt><dd class="gender">
          	<input name="gender" type="radio" value="male" /> Male
            <input name="gender" type="radio" value="female" /> Female
          </dd>
          <dt>Zip Code  <span class="red">*</span></dt><dd><input type="text" name="zip"   value="<?php echo $_REQUEST['zip'];?>"/></dd>
          <dt>Education  <span class="red">*</span></dt><dd>
		  <select name="education" id="education"><option value="">Select</option>
		 <?php echo getEducation($_REQUEST['education']);?></select>
		  </dd> 
          <dt>Income  <span class="red">*</span></dt><dd><select name="income" id="income" >
		  <option value="">Select Income</option>
		  <?php echo getIncome($_REQUEST['income']);?>
		  </select></dd>
          <dt>Interests and Activities  <span class="red">*</span></dt><dd>
								<select name="interest" id="interest" >
								<option value="">Select Interest And Activities</option>
                  <?php
							echo IntrestAndActivities($_REQUEST['interest']);
		 		  ?>
                        </select></dd>
           
                
               <dt> </dt><dd>
          <input type="submit" class="greenButton" value="Create" name="but"  />
         
		  </dd>     
       </dl>
        
           
           <div class="signup">
           </div>
            
       </div>
      </div></form>
   <?php include_once("includes/sidebar.php"); ?>
  <?php include_once("includes/footer.php"); ?>