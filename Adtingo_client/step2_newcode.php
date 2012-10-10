<?php
ob_start(); 
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
$shddate=$RecCampaign_info['schedule_date'];
$shddate1=explode(" ",$shddate);
 $shddate2=$shddate1[0];
}
if(isset($_POST['step2submit_x']))
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

	
	else
	$max_age_error="";
}	

	if($Num_cols >0 && $max_age_error=="" && $min_age_error=="")
		{
			
 $Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set minimum_age=%d,maxmum_age=%d,gender='%s',income=%d where campaign_id=%d",$object->stripper($_POST["minage"]),$object->stripper($_POST["maxage"]),$object->stripper($_POST["gender"]),$object->stripper($_POST["income"]),$object->stripper($CampaignID));  
		$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
		if($Insert_seg__List_Res)
		{
			unset($_SESSION['campaign']);
			header("location:step3.php?cid=".base64_encode($CampaignID)."");
			exit;
		}
		}
	
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	 req.open("GET","GetTotalMemberRecords.php?minage="+minage+"&maxage="+maxage+"&gendersel="+rad_val+"&income="+income+"&area_list="+arealist+"&shddate="+datesent,true);
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
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />

</head>
 <?php if($RecCampaign_info['status']!=5)
{?>
<body onload="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');">
<?php } else { ?>
<body onload="return GetListedRecords('<?php echo $CampaignID;?>');">
<?php } ?>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Step 1.3: List Segmentation</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" id="signupForm2" name="signupForm2">                              
            <div class="grey-box">
                <h3 class="grad-box">Select Segmented List Below</h3>
              <div class="tno-rec">Total Number Of Records: <strong><span id="totalrecords">
			  </span></strong></div>
               <?php if($RecCampaign_info['status']!=5)
					{?>
			  <dl class="form">
                <dt>Age</dt>
                <dd>
                  <input type="text" value="<?php if($RecCampaign_Seg_list_info['minimum_age']!="")
				  echo stripslashes($RecCampaign_Seg_list_info['minimum_age']);
				  else
				  echo  $_SESSION['campaign']['minage'];?>"  class="w-60" id="minage" name="minage" onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');"   /> <input type="text" class="w-60" id="maxage" name="maxage" onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');"    value="<?php if($RecCampaign_Seg_list_info['maxmum_age']!="0")
				  echo stripslashes($RecCampaign_Seg_list_info['maxmum_age']);
	  else
	  echo  $_SESSION['campaign']['maxage'];?>" /><br/>
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
				$chkstatus="";
				?>
                  <input type="radio"   name="gender" onclick="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.getElementById('gender1').value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');" id="gender1" value="male" <?php echo $malechkstatus; ?><?php if($chkstatus!="") echo $chkstatus;?>  /> Male <input type="radio" name="gender" id="gender2" class="m-left5" value="female" <?php echo $femalechkstatus; ?> onclick="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.getElementById('gender2').value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');"  /> Female <input type="radio" class="m-left5"  name="gender" id="gender3" value="both" <?php echo $bothchkstatus; ?>  onclick="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.getElementById('gender3').value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');" /> Both
                </dd>
                
 				<dt>Income</dt>
				<dd><select name="income" id="income" onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>');"  >
		  <option value="">Select Income</option>
		  <?php 
				if($RecCampaign_Seg_list_info['income']!="0")
				$value=$RecCampaign_Seg_list_info['income']; 
				 if($_SESSION['campaign']['income']!="")
				$value=$_SESSION['campaign']['income'];
				echo getIncome($value);?>
		
		  </select></dd>
               
              </dl>
			  <?php } else { ?>
			  <dl class="form">
                <dt>Age</dt>
                <dd>
				<?php if($RecCampaign_Seg_list_info['minimum_age']!="0" && $RecCampaign_Seg_list_info['maxmum_age']!=0)
					 {
						echo "<strong>".$RecCampaign_Seg_list_info['minimum_age']."</strong> Minimum Age  ";
						echo "<strong>".$RecCampaign_Seg_list_info['maxmum_age']."</strong> Maxmum Age";
					  }
					  else
					  echo "N/A";
				  ?>
				  <input type="hidden" name="minage" id="minage" value="<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>" />
				  <input type="hidden" name="maxage" id="maxage" value="<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>" />
                </dd>
                <dt>Gender</dt>
                <dd>
				<?php if($RecCampaign_Seg_list_info['gender']!="")
						 echo $RecCampaign_Seg_list_info['gender']; 
						else
							echo "N/A";
					?>
				<input type="hidden" name="gender" id="gender" value="<?php echo $RecCampaign_Seg_list_info['gender'];?>" />
                </dd>
                
 				<dt>Income</dt>
				<dd>
				<?php
				if($RecCampaign_Seg_list_info['income']!="0")
				{
				$value=$RecCampaign_Seg_list_info['income']; 
				echo getIncomevalue($value);
				}
				else 
				echo "N/A";
				?>
				<input type="hidden" name="income" id="income" value="<?php echo $RecCampaign_Seg_list_info['income'];?>" />
				</dd>
               
              </dl>
			  <?php } ?>
			  
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
