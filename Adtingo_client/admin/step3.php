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
$shddate=$RecCampaign_info['schedule_date'];
$shddate1=explode(" ",$shddate);
 $shddate2=$shddate1[0];

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
			
$Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set minimum_age=%d,maxmum_age=%d,gender='%s',income=%d where campaign_id=%d",$object->stripper($_POST["minage"]),$object->stripper($_POST["maxage"]),$object->stripper($_POST["gender"]),$object->stripper($_POST["income"]),$object->stripper($CampaignID));  
		//echo $Insert_seg__List_qry;exit;
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
<script language="javascript" type="text/javascript">

function gettotalrecords(arealist,minage,maxage,gender,income,zip,radious,datesent)
{

	for (var i=0; i < document.signupForm2.gender.length; i++)
   {
   		if (document.signupForm2.gender[i].checked)
		  {
		  var rad_val = document.signupForm2.gender[i].value;
		  }
   }
	 var req=createRequest();
	 req.open("GET","GetTotalMemberRecords_admin.php?minage="+minage+"&maxage="+maxage+"&gendersel="+rad_val+"&income="+income+"&area_list="+arealist+"&shddate="+datesent,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
				
			   if((res)!="")
				{
					document.getElementById("totalrecords").innerHTML=res;
					//document.profilrfrm.errormess.value=1;
				}
				else
				{
					
					document.getElementById("totalrecords").innerHTML="0";
					//document.profilrfrm.errormess.value=0;
				}
			
			return false;
		  } 
	 } 
}
function GetListedRecords(cid)
{

 var req=createRequest();
	 req.open("GET","GetListrecords.php?cid="+cid,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
				
			   if((res)!="")
				{
					document.getElementById("totalrecords").innerHTML=res;
					//document.profilrfrm.errormess.value=1;
				}
				else
				{
					
					document.getElementById("totalrecords").innerHTML="0";
					//document.profilrfrm.errormess.value=0;
				}
			
			return false;
		  } 
	 } 
}
function createRequest()
{
	var xmlHttp=null;
	try
	{
	// Firefox, Opera 8.0+, Safari
	xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
	// Internet Explorer
	try
	{
	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e)
	{
	try
	{
	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch (e)
	{
	alert("Please update your browser version, It seems your using older version.");
	return false;
	}
	}
	}

	
	return xmlHttp;
}

</script>
<body onLoad="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');">
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
                                <td height="30"  align="left" class="table-tab">Select Segmented List Below</td>
								<td height="30"  align="right" class="table-tab">Total Number Of Records: <strong><span id="totalrecords">
			  </span></strong></td>
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
				  echo  $_SESSION['campaign']['minage'];?>" onChange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  name="minage" id="minage" class="textfill-small" /></td>
                                    <td width="15">&nbsp;</td>
                                    <td><input type="text" value="<?php if($RecCampaign_Seg_list_info['maxmum_age']!="0")
				  echo stripslashes($RecCampaign_Seg_list_info['maxmum_age']);
				  else
				  echo  $_SESSION['campaign']['maxage'];?>"  name="maxage" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> id="maxage" class="textfill-small" onChange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');" /></td>
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
                                    <td width="15"><input type="radio" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>   name="gender" id="gender" value="male" <?php echo $malechkstatus; ?><?php if($chkstatus!="") echo $chkstatus;?>  onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');" /></td>
                                    <td width="40">Male</td>
                                    <td width="15"><input type="radio" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> name="gender" id="gender" class="m-left5" value="female" <?php echo $femalechkstatus; ?>  onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');" /></td>
                                    <td width="55">Female </td>
                                    <td width="15"><input type="radio" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> class="m-left5"  name="gender" id="gender" value="both" <?php echo $bothchkstatus; ?>  onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');" /></td>
                                    <td width="80">Both</td>
                                  </tr>
                                </table></td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left"><strong>Income</strong></td>
                                <td align="left"><select id="income" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> name="income" class="w-165" onChange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');">
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
                                <td height="10" colspan="2" align="left"></td>
                                </tr>
                              
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><a href="step2.php?cid=<?php echo base64_encode($CampaignID);?>"></a>
									<input type="button" name="button" id="button" value="back" class="button" onClick="javascript:window.location='step2.php?cid=<?php echo base64_encode($CampaignID);?>'" />
									</td>
                                    <td>&nbsp;</td>
                                    <td>
									<?php if($RecCampaign_info['status']==5)
									{?>
									<a href="step4.php?cid='<?php echo base64_encode($CampaignID);?>'"><input type="button" value="Next" id="next" class="button" name="next" /></a>
									<?php } else {?>
									<input type="submit" value="Next" id="submitproduct" class="button" name="submitproduct" />
									<?php } ?>
									</td>
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
	 <script language="javascript" type="text/javascript">
	   <?php if($RecCampaign_info['status']!=5)
{?>
	   gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');
<?php } else {?>
GetListedRecords('<?php echo $CampaignID;?>');
<?php } ?>	   
	  </script>
     <?php include('includes/footer.php'); ?>