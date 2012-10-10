<?php 
$nav=0;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php'); 



//********* START CODE FOR UPDATING PROFILE **************//
if(isset($_POST['submitproduct']) && $_POST['submitproduct']!='')
{	
$DateOfBirth=$_POST['year'].'-'.$_POST['month'].'-01';
if($_REQUEST['mid']=='')
	{	
		
		 //$insertMemInfo=sprintf("insert into tbl_members(full_name,last_name,email_address,password,home_city,dob,gender,zipcode,education,income,interests_and_activities,date_created,status) values('%s','%s','%s','%s','%s','%s','%s','%s',%d,%d,'%s','%s',%d,%d)",$object->stripper($_POST['full_name']),$object->stripper($_POST['lastname']),$object->stripper($_POST['email']),$object->stripper($_POST['password']),$object->stripper($_POST['city']),$object->stripper($DateOfBirth),$object->stripper($_POST['gender']),$object->stripper($_POST['zipcode']),$object->stripper($_POST['education']),$object->stripper($_POST['income']),$object->stripper($_POST['activities']),date('Y:m:d H:i:s'),'1'); 
		 $insertMemInfo=sprintf("insert into tbl_members(full_name,last_name,email_address,password,dob,gender,zipcode,income,date_created,status) values('%s','%s','%s','%s','%s','%s',%d,'%s',%d,%d)",$object->stripper($_POST['full_name']),$object->stripper($_POST['lastname']),$object->stripper($_POST['email']),$object->stripper($_POST['password']),$object->stripper($DateOfBirth),$object->stripper($_POST['gender']),$object->stripper($_POST['zipcode']),$object->stripper($_POST['income']),date('Y:m:d H:i:s'),'1'); 
		$QryinsertMemInfo=$object->ExecuteQuery($insertMemInfo);
		
			$memberid=mysql_insert_id();
			$metroIds=$object->stripper($_POST['metroIds']);
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
		
		
		$msg="added";
	}
	else
	{
	
		 $updateuserinfo=sprintf("update tbl_members set full_name='%s',last_name='%s', email_address='%s',  password='%s',dob='%s', gender='%s',zipcode='%s', income=%d,contact_time=%d where memberid=%d",$object->stripper($_POST['full_name']),$object->stripper($_POST['lastname']),$object->stripper($_POST['email']),$object->stripper($_POST['password']),$object->stripper($DateOfBirth),$object->stripper($_POST['gender']),$object->stripper($_POST['zipcode']),$object->stripper($_POST['income']),$object->stripper($_POST['contact_info']),$object->stripper($_REQUEST['mid']));
$QryinsertMemInfo=$object->ExecuteQuery($updateuserinfo);

	$memberid=$_REQUEST['mid'];
			$metroIds=$object->stripper($_POST['metroIds']);
			$metroIds=substr($metroIds,0,-1);
			$metroIds_array=explode(":",$metroIds);
	
			
			$Getres=$object->DeleteData(" tbl_member_metropolitian","memberid=".$memberid); 
			for($i=0;$i<count($metroIds_array);$i++)
			{
			//echo "tt";
				 $metroIds_array[$i];
			//	echo "insert into tbl_ client_metropolitian(area_id,clientid) values('%d','%d')",$metroIds_array[$i],$clientid;
				//$insertMetroInfo=sprintf("insert into tbl_ client_metropolitian(area_id,clientid) values(%d,%d)",$metroIds_array[$i],$clientid);
				$getMetroInfo="select * from tbl_member_metropolitian where memberid=$memberid and area_id=$metroIds_array[$i]";
				//echo $getMetroInfo;
				$QryGetMetroInfo=$object->ExecuteQuery($getMetroInfo);
				$rows=$object->NumRows($QryGetMetroInfo);
				if($rows){ continue;}else{
					//echo "tt";
					 $insertMetroInfo=sprintf("insert into tbl_member_metropolitian(area_id,memberid) values(%d,%d)",$metroIds_array[$i],$memberid);
					 $QryinsertMetroInfo=$object->ExecuteQuery($insertMetroInfo);
				}			 
			
				
			}




$msg="update"; 
}
	
	if($QryinsertMemInfo)
	{
		header("Location:members.php?msg=$msg&page=".$_POST['page']);
		exit;
		
	}
		
}
//********* END CODE FOR UPDATING PROFILE **************//
//************** START DISPLAY PROFILE VALUES ************//
$SqlGetUserDetails=sprintf("select * FROM tbl_members  where memberid=%d ",$object->stripper($_REQUEST['mid']));
$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
$QryGetUserDetailsRec=$object->FetchArray($QryGetUserDetails);

$date=explode("-",$QryGetUserDetailsRec['dob']);
list($birthdatemonths,$birthdatedays,$birthdateyears)=dateArray($date[1],$date[2],$date[0],date("Y")-70,date("Y")-10);

//************** END DISPLAY PROFILE VALUES ************//
if($_REQUEST['mid']=='')
	$title='Add';
else
	$title='Edit';
?>



<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
            <thead>
              
              <tr>
                <td width="83%" height="100" align="left" class="tr5">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">                  
                  <tr>
                    <td height="20" align="left" class="content-header">Member information </td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>  <form action="" method="post" name="profilrfrm" enctype="multipart/form-data" onsubmit="return validatemember();">
				
<input type="hidden" name="userid" id="userid" value="<?php echo $_REQUEST['mid']; ?>" />
<input type="hidden" name="page" id="page" value="<?php echo $_REQUEST['page']; ?>" />

                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="right">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" align="left" class="form-headings"><?php echo $title;?> </td>
                    </tr>
                    
                    <tr>
                      <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                        <thead>
                          
                          
                          <tr>
                            <td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="23%" height="10" align="left"></td>
                                <td width="76%" height="10" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>First Name</strong></td>
                                <td align="left"> 
                                 <input type="text" value="<?php if($QryGetUserDetailsRec['full_name']!='') echo stripslashes($QryGetUserDetailsRec['full_name']);?>"  name="full_name" id="full_name" />                         </td>
                              </tr>
							  <tr>
                                <td height="30" align="left"><strong>Last Name</strong></td>
                                <td align="left"> 
                                 <input type="text" value="<?php if($QryGetUserDetailsRec['last_name']!='') echo stripslashes($QryGetUserDetailsRec['last_name']);?>"  name="lastname" id="lastname" />                         </td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Email Address</strong></td>
                                <td align="left"> 
								<input type="text" value="<?php if($QryGetUserDetailsRec['email_address']!='') echo stripslashes($QryGetUserDetailsRec['email_address']);?>"  name="email" id="email" onchange="member_emailcheck(this.value,'emailerr')">
		  <input type="hidden" name="emailerr" id="emailerr" value=""/></td>
                              </tr>
                              <?php /*?> <tr>
                                <td height="30" align="left"><strong>Username</strong></td>
                                <td align="left"> 
								<input type="text" value="<?php if($QryGetUserDetailsRec['username']!='') echo stripslashes($QryGetUserDetailsRec['username']);?>" name="username" id="username"   onchange="usernamechk(this.value,'usererr')">
		    <input type="hidden" name="usererr" id="usererr" value=""/><br/>
								<!--<span id="errmail" class="errer-mess2"></span>-->
								</td>
                              </tr><?php */?>
							  <tr>
                                <td height="30" align="left"><strong>Password</strong></td>
                                <td align="left"> 
								<input type="password" value="<?php if($QryGetUserDetailsRec['password']!='') echo stripslashes($QryGetUserDetailsRec['password']);?>" name="password" id="password"  /><br/>
								
								</td>
                              </tr>
							  <?php /*?><tr>
                                <td height="30" align="left"><strong>Home City</strong></td>
                                <td align="left"> 
								<input type="text" value="<?php if($QryGetUserDetailsRec['home_city']!='') echo stripslashes($QryGetUserDetailsRec['home_city']);?>" name="city" id="city"  /><br/>
								
								</td>
                              </tr><?php */?>
							   <tr>
                                <td height="30" align="left"><strong>Date of Birth</strong></td>
                                <td align="left"><select name="month" id="month"><option value="">Month</option><?php echo $birthdatemonths;?></select> &nbsp; <select name="year" id="year"><option value="">Year</option><?php echo $birthdateyears;?></select></td>
                              </tr>
                              
						<?php
						$gendertype="";
						$gendertype1="";
						
						 if($QryGetUserDetailsRec['gender']=='male')
						{
						
							$gendertype="checked=checked";
							}
							else
							{
							$gendertype1="checked=checked";
							}
							  ?>
							   <tr>
                                <td height="30" align="left" valign="top"><strong>Gender</strong></td>
                                <td  align="left"> <input type="hidden" name="metroIds" id="metroIds"/><input type="radio" id="gender" name="gender" value="male" <?php if($QryGetUserDetailsRec['gender']!='') echo $gendertype;?> /> Male <input type="radio" name="gender" id="gender" value="female" <?php if($QryGetUserDetailsRec['gender']!='') echo $gendertype1;?> /> Female</td>
                              </tr>
						
							 <tr>
                                <td height="30" align="left" valign="top"><strong>Zip Code</strong></td>
                                <td  align="left"><input type="text" name="zipcode" id="zipcode" size="20" value="<?php if($QryGetUserDetailsRec['zipcode']!='') echo stripslashes($QryGetUserDetailsRec['zipcode']);?>"  /></td>
                              </tr>
							  
                              <?php /*?><tr>
                                <td height="30" align="left" valign="top"><strong>Education</strong></td>
                                <td  align="left">
								<select name="education" id="education"><option value="">Select</option>
		 <?php echo getEducation($QryGetUserDetailsRec['education']);?></select>
								</td>
                              </tr>
                               <?php */?>
                           
                               <tr>
                                <td height="30" align="left"><strong>Income</strong></td>
                                <td align="left">
								<select name="income" id="income" >
		  <option value="">Select Income</option>
		  <?php echo getIncome($QryGetUserDetailsRec['income']);?>
		  </select>
								 </td>
                              </tr>
                                <?php /*?><tr>
                                <td height="30" align="left"><strong>Interest And Activities</strong></td>
                                <td align="left" height="30">
								
								<select name="activities" id="activities" >
								<option value="">Select Intrest And Activities</option>
                  <?php
							echo IntrestAndActivities($QryGetUserDetailsRec['interests_and_activities']);
		 		  ?>
                        </select>
								</td>  </tr><?php */?>  
                             <tr>
                                <td height="30" align="left"><strong>How often they like to be contacted</strong></td>
                                <td align="left" height="30">
								
								<select name="contact_info" id="contact_info" >
								
                  <?php
					echo Contact_info_data(isset($_POST['contact_info'])?$_POST['contact_info']:$QryGetUserDetailsRec['contact_time']);?>
							//echo IntrestAndActivities($QryGetUserDetailsRec['interests_and_activities']);
		 		  ?>
                        </select>
								</td>  </tr> 
                            
                              <?php /*?> <tr>
                              <td  align="left" height="30"  valign="top"><strong>How often they like to be contacted</strong></td>
							   <td align="left"><select name="contact_info" >
                  <?php
			echo Contact_info_data($QryGetUserDetailsRec[contact_time]);
		   ?>
                        </select> </td>
							   </tr><?php */?>
							   <tr>
                              <td  align="left" height="30"  valign="top"><strong>Metropolitian Area</strong></td>
							   <td align="left">
							  <ul class="testtt">
							   <!--<select name="metropolitin_area" id="metropolitin_area" >
							   <option value="" >Select Area </option>-->
                  <?php
			echo $object->GetmetropolitianareasCheckbox($_REQUEST['mid'],'member');
		   ?>
                      <!--  </select>--></ul> </td>
							   </tr>
                                <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left" >
                                  <input name="submitproduct" type="submit" class="button" id="submitproduct" value="Submit" />                                                            </td>
                              </tr>
                              
                            </table></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></form></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
	 
     <?php include('includes/footer.php'); ?>