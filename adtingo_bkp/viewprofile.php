<?php
include_once("includes/header.php");
include_once('includes/session.php');
include('includes/values.php');
$object=new main(); 
$memberid=$_SESSION['memberid']; 
$SqlGetMembers=sprintf("select * from tbl_members  where memberid=$memberid");
$QryGetMembers=$object->ExecuteQuery($SqlGetMembers);
$cols=$object->NumRows($QryGetMembers);
$GetMembersResult=$object->FetchArray($QryGetMembers);


if($_GET['msg']==2)
$message='Profile has been updated succesfully.';
?>
      <form action="editprofile.php"  >
        <div id="div-Form">

        <div class="form-title"> MY Account</div>

        <div class="register-form">		<div align="center" class="errer-mess"><?php echo $message;?></div>
      	  <dl class="form1">
          <dt>Full Name</dt><dd><?php echo stripslashes($GetMembersResult['full_name']); ?></dd>
          
          <dt>Email address</dt><dd><?php echo stripslashes($GetMembersResult['email_address']); ?></dd>
          <dt>User Name</dt><dd><?php echo stripslashes($GetMembersResult['username']); ?></dd>
          <dt>Password</dt><dd><?php echo stripslashes($GetMembersResult['password']); ?> 
          </dd>
          <dt>Date of Birth</dt><dd>
         <?php echo date('M Y',strtotime($GetMembersResult['dob']));?></dd>
          <dt>Gender</dt><dd class="gender"><?php echo stripslashes($GetMembersResult['gender']); ?>
          </dd>
          <dt>Zip Code</dt><dd><?php echo stripslashes($GetMembersResult['zipcode']); ?>
          </dd>
          <dt>Education</dt><dd><?php echo $education_array[$GetMembersResult['education']]; ?>
          </dd>
          <dt>Income ($)</dt><dd> <?php echo $income_array[$GetMembersResult['income']]; ?>
          </dd>
          <dt>Interests and Activities</dt><dd><?php echo  $Intrest_and_activitise[$GetMembersResult['interests_and_activities']]; ?>
          </dd>
          <dt>How often they like to be contacted</dt><dd>
          <?php if($Cotact_info[$GetMembersResult['contact_time']]!='')echo $Cotact_info[$GetMembersResult['contact_time']]; else echo '--';?>
          </dd>  
           <dt>Subscriptions List</dt><dd>
		   <?php
        	$SqlGetClientMetropolitianAreas=sprintf("select * FROM tbl_member_metropolitian a, tbl_metropolitian_list b  WHERE memberid=%d AND a.area_id=b.area_id",$memberid);
			$QryGetClientMetropolitianAreas=$object->ExecuteQuery($SqlGetClientMetropolitianAreas);
		//	$QryGetClientMetropolitianAreasRec=$this->FetchArray($QryGetClientMetropolitianAreas);
			while($QryGetclientmetropolitianareasRec=$object->FetchArray($QryGetClientMetropolitianAreas))
			{
				echo $QryGetclientmetropolitianareasRec['area_name'].'<br>';
			}
			?>
          </dd>   <dt>&nbsp; </dt><dd>
         
          </dd>     
           <dt>&nbsp; </dt><dd>
         <input type="submit" class="greenButton" onclick="window.location.href='';" value="Edit Profile" />
          </dd>           
       </dl>
           
            
       </div>
      </div></form>
 <?php include_once("includes/sidebar.php"); ?>
  <?php include_once("includes/footer.php"); ?>
