<?php 
session_start();
echo $_SESSION['camapaign_id'];
if($_SESSION['memberid']==''){ header('location:/user-login');}
$object=new main(); 		
$memberid=$_SESSION['memberid']; 
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
if($_POST['submit']!='')
	{

		$DateOfBirth=$_POST['yearedit'].'-'.$_POST['monthedit'].'-01';
		
		 $SqlGetUserDetails=sprintf("select * FROM tbl_members  where memberid!=%d AND email_address='%s'",$memberid,$_POST['email']); 
		$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
		$QryGetUserResults=$object->FetchArray($QryGetUserDetails);
		$numrows=$object->NumRows($QryGetUserDetails);
	
		if($numrows==2)
		{
			$error_message='Email already exists';
		}
		else if($numrows>0)
		{
			
			if($QryGetUserResults['email_address']==$_POST['email'])
			$error_message='Email already exists';
			
		}
		else
		{
		
		/*$updateuserinfo=sprintf("update tbl_members set full_name='%s',last_name='%s', email_address='%s',  password='%s',home_city='%s',dob='%s', gender='%s',zipcode='%s', education='%s',income='%s',interests_and_activities='%s',contact_time=%d where memberid=%d",$object->stripper($_POST['fullname']),$object->stripper($_POST['lastname']),$object->stripper($_POST['email']),$object->stripper($_POST['pass']),$object->stripper($_POST['city']),$object->stripper($DateOfBirth),$object->stripper($_POST['gender']),$object->stripper($_POST['zipcode']),$object->stripper($_POST['education']),$object->stripper($_POST['income']),$object->stripper($_POST['interest']),$object->stripper($_POST['contact_info']),$memberid); 
$QryinsertMemInfo=$object->ExecuteQuery($updateuserinfo);*/
		$updateuserinfo=sprintf("update tbl_members set full_name='%s',last_name='%s', email_address='%s',  password='%s',dob='%s', gender='%s',zipcode='%s', income='%s',contact_time=%d where memberid=%d",$object->stripper($_POST['fullname']),$object->stripper($_POST['lastname']),$object->stripper($_POST['email']),$object->stripper($_POST['pass']),$object->stripper($DateOfBirth),$object->stripper($_POST['gender']),$object->stripper($_POST['zipcode']),$object->stripper($_POST['income']),$object->stripper($_POST['contact_info']),$memberid); 
$QryinsertMemInfo=$object->ExecuteQuery($updateuserinfo);

		//echo $_POST['metroIds'];	
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
			
			if($_SESSION['camapaign_id']){
				$selCheck=mysql_num_rows(mysql_query("select * from `tbl_unsubscribe` where memberid=$memberid and campaign_id=$_SESSION[camapaign_id]"));
				if(selCheck==0){
					$getAreaId=mysql_fetch_array(mysql_query("SELECT tab6.area_id FROM campaign_posts AS tab1, wp_posts AS tab2, wp_term_relationships AS tab3, `wp_term_taxonomy` AS tab4, wp_terms AS tab5, `tbl_metropolitian_list` AS tab6 WHERE tab1.campaign_id =$_SESSION[camapaign_id] AND tab1.post_id = tab2.ID AND tab2.ID = tab3.object_id AND tab3.term_taxonomy_id = tab4.term_taxonomy_id AND tab4.parent = tab5.term_id AND tab5.term_id = tab6.cat_id"));
				//echo $getAreaId[area_id];exit;
					$selMemberMetroCheck=mysql_num_rows(mysql_query("select * from tbl_member_metropolitian where area_id=$getAreaId[area_id] and memberid=$memberid"));
					if($selMemberMetroCheck ==0){
					$insUnsubscribe=mysql_query("insert into `tbl_unsubscribe` (`memberid`, `email`, `areas`, `date`, `campaign_id`) values ($memberid, '$_POST[email]', $getAreaId[area_id], now(), $_SESSION[camapaign_id] )");
					}
				}
			}
			$msg="update"; 
			header("location:".get_page_link(38)."/?msg=2");
			exit;
			}
			
			
			
			
}
?>
<div class="content-cont-inner">
  <!--Left content -->
  <div class="content-left">
    <form onsubmit="return editformvalidate();" method="post" name="registration" action="">
      <div id="div-Form">
        <div class="form-title">EDIT  Profile</div>
        <div class="register-form">
          <dl class="form1">
            <div align="center" class="errer-mess2"></div>
            <dt>First Name</dt>
            <dd>
              <input type="text" value="<?php echo isset($_POST['fullname'])?$_POST['fullname']:stripslashes($GetMembersResult['full_name']); ?>" id="fullname" name="fullname">
            </dd>
            <dt>Last Name</dt>
            <dd>
              <input type="text" value="<?php echo isset($_POST['lastname'])?$_POST['lastname']:stripslashes($GetMembersResult['last_name']); ?>" id="lastname" name="lastname">
            </dd>
            <dt>Email address</dt>
            <dd>
              <input type="text" onchange="member_emailcheck(this.value,'emailerr')" value="<?php echo isset($_POST['email'])?$_POST['email']:stripslashes($GetMembersResult['email_address']); ?>" id="email" name="email">
              <input type="hidden" value="" id="emailerr" name="emailerr">
			 
            </dd>
            <?php /*?><dt>User Name</dt>
            <dd>
              <input type="text" onchange="usernamechk(this.value,'usererr')" value="<?php echo isset($_POST['username'])?$_POST['username']:stripslashes($GetMembersResult['username']); ?>" id="username" name="username">
              <input type="hidden" value="" id="usererr" name="usererr">
            </dd><?php */?>
            <dt>Password</dt>
            <dd>
              <input type="password" value="<?php echo isset($_POST['pass'])?$_POST['pass']:stripslashes($GetMembersResult['password']); ?>" id="pass" name="pass"><br />*<span style="font-weight: bold"> Make note that you can change this</span>
              <input type="hidden" id="metroIds" name="metroIds">
            </dd>
            <?php /*?><dt>Home City</dt>
            <dd>
              <input type="text" value="<?php echo isset($_POST['city'])?$_POST['city']:$GetMembersResult['home_city'];?>" id="city" name="city">
            </dd><?php */?>
            <dt>Date of Birth</dt>
            <dd>
               <select name="monthedit" id="monthedit"><option value="">Month</option><?php echo $birthdatemonths;?></select> 
              &nbsp;
              <select name="yearedit" id="yearedit"><option value="">Year</option><?php echo $birthdateyears;?></select>
            </dd>
            <dt>Gender</dt>
            <dd class="gender">
              <input type="radio" value="male" id="gender1" name="gender" <?php echo $male_checked;?>>
              <label>Male</label>
              <input type="radio" value="female" id="gender2" name="gender" <?php echo $female_checked;?>>
              <label>Female</label>
            </dd>
            <dt>Zip Code</dt>
            <dd>
              <input type="text" value="<?php echo isset($_POST['zipcode'])?$_POST['zipcode']:stripslashes($GetMembersResult['zipcode']); ?>" id="zipcode" name="zipcode">
            </dd>
            <?php /*?><dt>Education</dt>
            <dd>
              <select name="education" id="education"><option value="">Select</option>
		 <?php echo getEducation(isset($_POST['education'])?$_POST['education']:$GetMembersResult['education']);?></select>
            </dd><?php */?>
            <dt>Income</dt>
            <dd>
              <select name="income" id="income" >
		  <option value="">Select Income</option>
		  <?php echo getIncome(isset($_POST['income'])?$_POST['income']:$GetMembersResult['income']);?>
		  </select>
            </dd>
            <?php /*?><dt>Interests and Activities</dt>
            <dd>
              <select name="interest" id="interest" >
								<option value="">Select Interest And Activities</option>
                  <?php
							echo IntrestAndActivities(isset($_POST['interest'])?$_POST['interest']:$GetMembersResult['interests_and_activities']);
		 		  ?>
                        </select>
            </dd><?php */?>
            <dt>How often they like to be contacted</dt>
            <dd>
              <select name="contact_info" id="contact_info" >
         <?php echo Contact_info_data(isset($_POST['contact_info'])?$_POST['contact_info']:$GetMembersResult['contact_time']);?> </select>
            </dd>
            <dt> Subscriptions List</dt>
            <dd>
              <div class="subscriptions">
                <ul class="subscriptions-fields">
                     <?php
					  $object=new main;
			echo $object->GetmetropolitianareasCheckbox($memberid,'member');
		   ?>
                </ul>
              </div>
            </dd>
            <dt> </dt>
            <dd>
              <input type="submit" name="submit" id="submit" value="Submit"  class="update-bt"/>
            </dd>
          </dl>
        </div>
      </div>
    </form>
  </div>
  <!--Left content ends-->
  <?php get_sidebar('adtingo2'); ?>
</div>
