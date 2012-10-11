<?php 
$nav=12;
include("includes/adminsessions.php");
include('includes/header.php'); 
include_once('includes/functions.php'); 
//include('includes/dbfiler.php'); 
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
if(isset($_POST['submitproduct']))
{
	$min_age_error='';
	$max_age_error="";
	$education_age_error="";
	$intrest_age_error="";
if($_POST['minage']!="")
{
 	if (!(is_numeric($_POST['minage'])))
	 {
		   	$min_age_error="Minimum age should accept numbers only";
	 }
	else
	$min_age_error="";
}
if($_POST['maxage']!="")
{
 	if (!(is_numeric($_POST['maxage'])))
	 {
		   	$max_age_error="Maximum age should accept numbers only";
	 }

	else if($_POST['minage']>=$_POST['maxage']) 			
	 {
	 		$max_age_error="Minimum age should be less than maximum age";
	}
	else
	$max_age_error="";
}	

	if($Num_cols >0 && $max_age_error=="" && $min_age_error=="")
		{
			if($_POST['intrest']!="")
			{
		  	$Intrest_activities1=implode(",",$_POST['intrest']);
			}
$Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set minimum_age=%d,maxmum_age=%d,gender='%s',education=%d,income=%d,keywords='%s' where campaign_id=%d",$object->stripper($_POST["minage"]),$object->stripper($_POST["maxage"]),$object->stripper($_POST["gender"]),$object->stripper($_POST["education"]),$object->stripper($_POST["income"]),$object->stripper($Intrest_activities1),$object->stripper($CampaignID));  
		$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
		if($Insert_seg__List_Res)
		{
			unset($_SESSION['campaign']);
			header("location:step4.php?cid=".base64_encode($CampaignID)."");
			exit;
		}
		}
	
}		
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
                    <td height="20" align="left" class="content-header">Step 1.3: List Segmentation</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>    <form  action="" method="post" id="signupForm2" name="signupForm2"> 
				
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
                                <td height="30" colspan="2" align="left" class="table-tab">Select Segmented List Below</td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Age</strong></td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><input type="text" value="<?php if($RecCampaign_Seg_list_info['minimum_age']!="0")
				  echo stripslashes($RecCampaign_Seg_list_info['minimum_age']);
				  else
				  echo  $_SESSION['campaign']['minage'];?>"  name="minage" id="minage" class="textfill-small" /></td>
                                    <td width="15">&nbsp;</td>
                                    <td><input type="text" value="<?php if($RecCampaign_Seg_list_info['maxmum_age']!="0")
				  echo stripslashes($RecCampaign_Seg_list_info['maxmum_age']);
				  else
				  echo  $_SESSION['campaign']['maxage'];?>"  name="maxage" id="maxage" class="textfill-small" /></td>
                                  </tr>
								  <tr><td colspan="3"><span class="red">
				  <?php if($min_age_error!="") echo $min_age_error;?>
				   <?php if($max_age_error!="") echo $max_age_error;?>
				   </span></td></tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Gender</strong></td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
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
				$chkstatus="";
				?>
                                    <td width="15"><input type="radio"   name="gender" id="gender" value="male" <?php echo $malechkstatus; ?><?php if($chkstatus!="") echo $chkstatus;?>  /></td>
                                    <td width="40">Male</td>
                                    <td width="15"><input type="radio" name="gender" id="gender" class="m-left5" value="female" <?php echo $femalechkstatus; ?>  /></td>
                                    <td width="55">Female </td>
                                    <td width="15"><input type="radio" class="m-left5"  name="gender" id="gender" value="both" <?php echo $bothchkstatus; ?>  /></td>
                                    <td width="80">Both</td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Education</strong></td>
                                <td align="left"><select id="education" name="education" class="w-165">
                               <option value="">Select Education</option>
							     <?php 
				if($RecCampaign_Seg_list_info['education']!="0")
				$value=$RecCampaign_Seg_list_info['education']; 
				 if($_SESSION['campaign']['education']!="")
				$value=$_SESSION['campaign']['education'];
				echo getEducation($value);?>
                                </select></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Income</strong></td>
                                <td align="left"><select id="income" name="income" class="w-165">
		  <option value="">Select Income</option>
		 <?php 
				if($RecCampaign_Seg_list_info['income']!="0")
				$value=$RecCampaign_Seg_list_info['income']; 
				 if($_SESSION['campaign']['income']!="")
				$value=$_SESSION['campaign']['income'];
				echo getIncome($value);?>	
		  </select></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" valign="top"><strong>Keywords/Activities</strong></td>
                                <td align="left"><ul class="key-act-list">
				  <?php
				  
				  if($RecCampaign_Seg_list_info['keywords']!="0")
						$value=$RecCampaign_Seg_list_info['keywords']; 
				 if($_SESSION['campaign']['keywords']!="")
						$value=$_SESSION['campaign']['keywords'];			 	
					 	$intrest_value1=explode(",",$value);
	 					echo IntrestAndActivities_checkboxes($intrest_value1);
					?>          	  
               </td>
                              </tr>
                              
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                                </tr>
                              
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><a href="step2.php?cid=<?php echo base64_encode($CampaignID);?>">
                                      <input type="button" name="button" id="button" value="back" class="button" />
                                    </a></td>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" value="Next" id="submitproduct" class="button" name="submitproduct" /></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table>
                            </td>
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