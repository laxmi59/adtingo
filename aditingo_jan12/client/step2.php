<?php 
include_once('includes/functions.php'); 
include_once('includes/session.php');
include_once('includes/values.php'); 
$object=new main();
$Num_cols="0";
if($_REQUEST['cid']!="")
{
	$CampaignID=base64_decode($_REQUEST['cid']);
  	$SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$CampaignID ; 
	$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
	$Num_cols=$object->NumRows($ResCampaign_Seg_list_info);
	$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);
	
	 $SqlCampaign_info="select * from tbl_campaigns where campaign_id=".$CampaignID ; 
$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
$Num_cols=$object->NumRows($ResCampaign_info);
$RecCampaign_info=$object->FetchArray($ResCampaign_info);

}
$SearchResult=$object->GetCampaignSearchResult($RecCampaign_Seg_list_info['area_list']);
$_SESSION['TotalRecords']=$SearchResult;
if(isset($_POST['step2submit_x']))
{
if(isset($_POST['gender']) && $_POST['gender']!='' && (is_numeric($_POST['minage']))  && (is_numeric($_POST['maxage'])) && $_POST['education']!='' && $_POST['intrest']!='')
{
	if($Num_cols >0)
		{
		  $Intrest_activities1=implode(",",$_POST['intrest']);
		 $Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set minimum_age=%d,maxmum_age=%d,gender='%s',  	education=%d,keywords='%s' where campaign_id=%d",$object->stripper($_POST["minage"]),$object->stripper($_POST["maxage"]),$object->stripper($_POST["gender"]),$object->stripper($_POST["education"]),$object->stripper($Intrest_activities1),$object->stripper($CampaignID));  
		$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
		if($Insert_seg__List_Res)
		{
			unset($_SESSION['campaign']);
			header("location:step3.php?cid=".base64_encode($CampaignID)."");
			exit;
		}
		}
		
}
else
{
	$min_age_error='';
	$max_age_error="";
	$education_age_error="";
	$intrest_age_error="";
	
	if($_POST["minage"]=="")
	{
	$min_age_error="Minimum Age Required";
	$_SESSION['campaign']['minage']="";
	}
	else if (!(is_numeric($_POST['minage'])))
	 {
	 $_SESSION['campaign']['minage']=$_POST["minage"];
	   	$min_age_error="Minimum age should accept numbers only";
	 }
	 else if($_POST['minage']>=$_POST['maxage']) 			
	 {
	 $_SESSION['campaign']['minage']=$_POST["minage"];
		$min_age_error="Minimum age should be less than maximum age";
	}
	else
	$_SESSION['campaign']['minage']=$_POST["minage"];
	if($_POST["maxage"]=="")
	{
	$max_age_error="Maximum Age Required";
	$_SESSION['campaign']['maxage']="";
	}
	else if (!(is_numeric($_POST['maxage'])))
	 {
	 $_SESSION['campaign']['maxage']=$_POST["maxage"];
	   	$max_age_error="Maximum age should accept numbers only";
	 }
	else
	{
	$_SESSION['campaign']['maxage']=$_POST["maxage"];
	
	}
	if($_POST["gender"]=="")
	{
	$education_age_error="Gender Required";
	$_SESSION['campaign']['gender']="";
	}
	else
	$_SESSION['campaign']['gender']=$_POST["gender"];
	if($_POST["education"]=="")
	{
	$education_age_error="Education Required";
	$_SESSION['campaign']['education']="";
	}
	else
	$_SESSION['campaign']['education']=$_POST["education"];
	if($_POST["intrest"]=="")
	{
	$intrest_age_error="Keywords/Activities Required";
	$_SESSION['campaign']['intrest']="";
	}
	else
	$_SESSION['campaign']['intrest']=$_POST["intrest"];
}
}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />

</head>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Step 1.3: List Segmentation</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" id="signupForm2" name="signupForm2">                              
            <div class="grey-box">
                <h3 class="grad-box">Select Segmented List Below</h3>
              <div class="tno-rec">Total Number Of Records: <strong><?php echo $_SESSION['TotalRecords'];?></strong></div>
              <dl class="form">
                <dt>Age</dt>
                <dd>
                  <input type="text" value="<?php if($RecCampaign_Seg_list_info['minimum_age']!="0")
				  echo stripslashes($RecCampaign_Seg_list_info['minimum_age']);
				  else
				  echo  $_SESSION['campaign']['minage'];?>"  class="w-60" id="minage" name="minage"  /> <input type="text" class="w-60" id="maxage" name="maxage"   value="<?php if($RecCampaign_Seg_list_info['maxmum_age']!="0")
				  echo stripslashes($RecCampaign_Seg_list_info['maxmum_age']);
				  else
				  echo  $_SESSION['campaign']['maxage'];?>"  /><br/>
				  <span class="red">
				  <?php if($min_age_error!="") echo $min_age_error;?>
				   <?php if($max_age_error!="") echo $max_age_error;?>
				   </span>
                </dd>
                <dt>Gender</dt>
                <dd>
				<?php 
				$chkstatus="";
				$malechkstatus="";
				$femalechkstatus="";
				$bothchkstatus="";
				if($RecCampaign_Seg_list_info['gender']=="male") 
				$malechkstatus="checked='checked'";
				else if($_SESSION['campaign']['gender']=='male')
				$malechkstatus="checked='checked'";
				if($RecCampaign_Seg_list_info['gender']=="female")
				$femalechkstatus="checked='checked'";
				else if($_SESSION['campaign']['gender']=='female')
				$femalechkstatus="checked='checked'";
				if($RecCampaign_Seg_list_info['gender']=="both") 
				$bothchkstatus="checked='checked'";
				else if($_SESSION['campaign']['gender']=='both')
				$bothchkstatus="checked='checked'";
				else
				$chkstatus="checked='checked'";
				?>
                  <input type="radio"   name="gender" id="gender" value="male" <?php echo $malechkstatus; ?><?php if($chkstatus!="") echo $chkstatus;?>  /> Male <input type="radio" name="gender" id="gender" class="m-left5" value="female" <?php echo $femalechkstatus; ?>  /> Female <input type="radio" class="m-left5"  name="gender" id="gender" value="both" <?php echo $bothchkstatus; ?>  /> Both
                </dd>
                <dt>Education</dt>
                <dd><select name="education" id="education">
				<option value="">Select Education</option>
				<?php 
				if($RecCampaign_Seg_list_info['education']!="0")
				$value=$RecCampaign_Seg_list_info['education']; 
				 if($_SESSION['campaign']['education']!="")
				$value=$_SESSION['campaign']['education'];
				echo getEducation($value);?>
	 
</select>
<br/>
<span class="red">
 <?php if($education_age_error!="") echo $education_age_error;?>
</span>
</dd>
                <dt>Keywords/Activities</dt>
                <dd>
                  <ul class="key-act-list">
				  <?php
				  
				  if($RecCampaign_Seg_list_info['keywords']!="0")
						$value=$RecCampaign_Seg_list_info['keywords']; 
				 if($_SESSION['campaign']['keywords']!="")
						$value=$_SESSION['campaign']['keywords'];			 	
					 	$intrest_value1=explode(",",$value);
	 					echo IntrestAndActivities_checkboxes($intrest_value1);
					?>
             	  
                </ul>
				<span class="red">
				<?php if($intrest_age_error!="") echo $intrest_age_error;?>
				</span>
                </dd>
              </dl>
             </div>
           <div class="button_left">
          <a href="step5.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" name="step2submit" id="step2submit" />
        </div>
    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
