<?php
session_start();
if($_SESSION['memberid']==''){ header('location:/user-login');}
//echo $_SESSION['camapaign_id'];
$object=new main(); 
if($_REQUEST['cid']){
	$CampaignID=base64_decode($_REQUEST['cid']);
	if($CampaignID)
	{
		$_SESSION['camapaign_id']=$CampaignID;
		
	}
}
//echo $_SESSION['camapaign_id'];
$education_array=array('1'=>'Highschool','2'=>'Some College','3'=>'In College','4'=>'College Graduate');
$Cotact_info=array('1'=>"Daily",'2'=>"Weekly",'3'=>"Bi-Weekly",'4'=>"Monthly",'5'=>"Quarterly");
$Intrest_and_activitise=array('1'=>"Food and Dinning",'2'=>"Style",'3'=>"Entertainment",'4'=>"Travel",'5'=>"Nightlife",'6'=>"Home and Garden",'7'=>"Electronics and Gadgets",'8'=>"Dating",'9'=>"Nightlife",'10'=>"Sports and Fitness",'11'=>"Career and Money",'12'=>"Cars",'13'=>"Health and Beauty");

$income_array=array('1'=>'Below $25,000','2'=>'$25,000 to $50,000','3'=>'$50,000 to $75,000','4'=>'$75,000 to $100,000','5'=>'$100,000 or more');
$memberid=$_SESSION['memberid']; 
$SqlGetMembers=sprintf("select * from tbl_members  where memberid=$memberid");
$QryGetMembers=$object->ExecuteQuery($SqlGetMembers);
$cols=$object->NumRows($QryGetMembers);
$GetMembersResult=$object->FetchArray($QryGetMembers);

//print_r($education_array);
if($_GET['msg']==2)
$message='Profile has been updated succesfully.';
?>
<div class="content-cont-inner">
  <!--Left content -->
  <div class="content-left">
    <form action="<?php echo get_page_link(61);?>" method="post" name="viewprofile" >
      <div id="div-Form">
        <div class="form-title"> MY Account</div>
        <div class="register-form">
		<div align="center" class="errer-mess"><?php echo $message;?></div>
        <?php if($message!="")
		{?>
		 <div align="center" class="errer-mess">&nbsp;</div>
		 <?php
		 }?>
          <dl class="form1">
            <dt>First Name</dt>
            <dd><?php echo stripslashes($GetMembersResult['full_name']); ?></dd>
            <dt>Email address</dt>
            <dd><?php echo stripslashes($GetMembersResult['email_address']); ?></dd>
            <?php /*?><dt>User Name</dt>
            <dd><?php echo stripslashes($GetMembersResult['username']); ?></dd><?php */?>
            <dt>Password</dt>
            <dd><?php /*?><?php echo stripslashes($GetMembersResult['password']); ?><?php */?> ****** </dd>
            <dt>Date of Birth</dt>
            <dd> <?php if($GetMembersResult['dob']<>"" && $GetMembersResult['dob']<>"--01") echo date('M Y',strtotime($GetMembersResult['dob']));?></dd>
            <dt>Gender</dt>
            <dd class="gender"><?php echo stripslashes($GetMembersResult['gender']); ?> </dd>
            <dt>Zip Code</dt>
            <dd><?php echo stripslashes($GetMembersResult['zipcode']); ?> </dd>
           <?php /*?> <dt>Education</dt>
            <dd><?php echo $education_array[$GetMembersResult['education']]; ?> </dd><?php */?>
            <dt>Income ($)</dt>
            <dd><?php echo $income_array[$GetMembersResult['income']]; ?> </dd>
            <?php /*?><dt>Interests and Activities</dt>
            <dd><?php echo  $Intrest_and_activitise[$GetMembersResult['interests_and_activities']]; ?> </dd><?php */?>
            <dt>How often they like to be contacted</dt>
            <dd> <?php if($Cotact_info[$GetMembersResult['contact_time']]!='')echo $Cotact_info[$GetMembersResult['contact_time']]; else echo '--';?> </dd>
            <dt>Subscriptions List</dt>
             <dd>
		   <?php
        	$SqlGetClientMetropolitianAreas=sprintf("select * FROM tbl_member_metropolitian a, tbl_metropolitian_list b  WHERE memberid=%d AND a.area_id=b.area_id",$memberid);
			$QryGetClientMetropolitianAreas=$object->ExecuteQuery($SqlGetClientMetropolitianAreas);
		//	$QryGetClientMetropolitianAreasRec=$this->FetchArray($QryGetClientMetropolitianAreas);
			while($QryGetclientmetropolitianareasRec=$object->FetchArray($QryGetClientMetropolitianAreas))
			{
				echo $QryGetclientmetropolitianareasRec['area_name'].'<br>';
			}
			?>
              </dd>
            <dt>&nbsp; </dt>
            <dd> </dd>
            <dt>&nbsp; </dt>
            <dd>
              <input type="submit" name="button" id="button" value="Submit" class="edit-profile-bt" />
            </dd>
          </dl>
        </div>
      </div>
    </form>
  </div>
  <!--Left content ends-->
  <?php get_sidebar('adtingo2'); ?>
</div>
