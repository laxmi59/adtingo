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
	$zipcode_area_error="";
	$specifyzipcode_area_error="";
	if($_POST["zipcode"]==""){
		$zipcode_area_error="Zipcode Required";
		$_SESSION['campaign']['zipcode']="";
	//}elseif(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$_POST['zipcode'])){$zipcode_area_error="Invalid Zipcode Format";$_SESSION['campaign']['zipcode']="";
	}else{
		$_SESSION['campaign']['zipcode']=$_POST["zipcode"];
		$pos1 = strpos(trim($_POST["zipcode"]), ",");
		if($pos1==false){
			if($_POST["zipcoderadious"]==""){
				$specifyzipcode_area_error="And Zip Codes Within  field Required";
				$_SESSION['campaign']['zipcoderadious']="";
			}else{
				$specifyzipcode_area_error =="";
				$_SESSION['campaign']['zipcoderadious']=$_POST["zipcoderadious"];
			}
		}		
	}
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

	if($Num_cols >0 && $max_age_error=="" && $min_age_error=="" && $specifyzipcode_area_error=="")
		{
			
$Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set minimum_age=%d,maxmum_age=%d,gender='%s',income=%d, zipcode='%s', zipcode_miles=%d where campaign_id=%d",$object->stripper($_POST["minage"]),$object->stripper($_POST["maxage"]),$object->stripper($_POST["gender"]),$object->stripper($_POST["income"]),$object->stripper($_POST["zipcode"]),$object->stripper($_POST["zipcoderadious"]),$object->stripper($CampaignID));  
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" type="text/javascript">

function gettotalrecords(arealist,minage,maxage,gender,income,zip,radious,datesent,random_number)
{
//alert(radious);
displayStaticMessage("<img src='images/loading.gif' />");
	for (var i=0; i < document.signupForm2.gender.length; i++)
   	{
   		if (document.signupForm2.gender[i].checked)
		{
		  var rad_val = document.signupForm2.gender[i].value;
		}
   }
	 var req=createRequest();
	 req.open("GET","GetTotalMemberRecords.php?minage="+minage+"&maxage="+maxage+"&gendersel="+rad_val+"&income="+income+"&area_list="+arealist+"&shddate="+datesent+"&random_number="+random_number+"&zipcode="+zip+"&radious="+radious,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
				//alert(res);
			   if((res)!="")
				{
					document.getElementById("totalrecords").innerHTML=res;
					//document.profilrfrm.errormess.value=1;
					closeMessage();
				}
				else
				{
					
					document.getElementById("totalrecords").innerHTML="0";
					//document.profilrfrm.errormess.value=0;
					closeMessage();
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
				alert(res);
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
function hide_radious(id)
{
	str=document.signupForm2.zipcode.value;
	if(str.indexOf(',')!=-1){
		document.signupForm2.zipcoderadious.value='';
		document.signupForm2.zipcoderadious.disabled = true;
	}else{
		document.signupForm2.zipcoderadious.disabled = false;
	}
}

</script>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Step 1.3: List Segmentation"?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<?php include "includes/google_analytic.php";?>
</head>
 <?php if($RecCampaign_info['status']!=5)
{?>
<body onload="gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,document.signupForm2.zipcode.value,document.signupForm2.zipcoderadious.value,'<?php echo $shddate2;?>',''),hide_radious(document.signupForm2.zipcode.value);">
<?php } else { ?>
<body onload=" GetListedRecords('<?php echo $CampaignID;?>'),hide_radious(document.signupForm2.zipcode.value);">
<?php } ?>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Step 1.3: List Segmentation</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form method="post" id="signupForm2" name="signupForm2">                              
            <div class="grey-box">
                <h3 class="grad-box">Select Segmented List Below</h3>
              <div class="tno-rec"><?php /*?>Total Number Of Records: <strong><span id="totalrecords">
			  </span></strong><p>&nbsp;</p>
			  <p><a style="cursor:pointer" onclick="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.getElementById('gender1').value,document.signupForm2.income.value,document.signupForm2.zipcode.value,document.signupForm2.zipcoderadious.value,'<?php echo $shddate2;?>','');"><img src="images/update-count.gif" class="m-right5" alt="Update Count" /></a></p><?php */?>
              <table width="95%" border="0" cellspacing="0" cellpadding="0" style="padding:5px 10px 10px 10px; border:solid 1px #ddd">
                <tr>
                  <td align="center" style="font-size:13px;">Total Number Of Records: <strong><span id="totalrecords" style="color:blue"></span></strong></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><a style="cursor:pointer" onclick="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.getElementById('gender1').value,document.signupForm2.income.value,document.signupForm2.zipcode.value,document.signupForm2.zipcoderadious.value,'<?php echo $shddate2;?>','');"><img src="images/update-count.gif" class="m-right5" alt="Update Count" /></a></td>
                </tr>
              </table>
              <p>&nbsp;</p>
              </div>
              <dl class="form1">
                <dt>Age</dt>
                <dd>
                  <input type="text" value="<?php if($RecCampaign_Seg_list_info['minimum_age']!="")
				  echo stripslashes($RecCampaign_Seg_list_info['minimum_age']);
				  else
				  echo  $_SESSION['campaign']['minage'];?>"  class="w-60" id="minage" name="minage" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  /> <input type="text" class="w-60" id="maxage" name="maxage" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  value="<?php if($RecCampaign_Seg_list_info['maxmum_age']!="0")
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
                  <input type="radio" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>   name="gender"  id="gender1" value="male" <?php echo $malechkstatus; ?><?php if($chkstatus!="") echo $chkstatus;?>  /> Male <input type="radio" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> name="gender" id="gender2" class="m-left5" value="female" <?php echo $femalechkstatus; ?>  /> Female <input type="radio" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> class="m-left5"  name="gender" id="gender3" value="both" <?php echo $bothchkstatus; ?>  /> Both
                </dd>
                
 				<dt>Income</dt>
				<dd><select name="income" id="income" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  >
		  <option value="">Select Income</option>
		  <?php 
				if($RecCampaign_Seg_list_info['income']!="0")
				$value=$RecCampaign_Seg_list_info['income']; 
				 if($_SESSION['campaign']['income']!="")
				$value=$_SESSION['campaign']['income'];
				echo getIncome($value);?>
		
		  </select></dd>
               
            
			   <dt>Enter Zip Code</dt>
                <dd><input name="zipcode" id="zipcode" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>    type="text" onBlur="hide_radious(this.value)"  value="<?php if($RecCampaign_Seg_list_info['zipcode']!="")
			  		echo $RecCampaign_Seg_list_info['zipcode'];?>"  />
				<br/>
				<span class="red">
				  <?php if($zipcode_area_error!="") echo $zipcode_area_error;?>
				</span>
				</dd>
			
                <dt>And Zip Codes Within </dt>
                <dd><select name="zipcoderadious" id="zipcoderadious" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  >
                <option value="">Select Miles</option>
                 <?php 
				 if($RecCampaign_Seg_list_info['zipcode_miles']!="0")
				   $value=$RecCampaign_Seg_list_info['zipcode_miles']; 
					echo Get_Zipcode_Radious_Count($value);?>
                   
                </select>
				<br/>
				<span class="red">
				  <?php if($specifyzipcode_area_error!="") echo $specifyzipcode_area_error;?>
				</span>
				</dd>
			  </dl>	
             </div>
           <div class="button_left">
          <a href="step5.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input src="images/next.gif"  type="image" name="step2submit" id="step2submit" /> <?php /*?><a style="cursor:pointer" onclick="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.getElementById('gender1').value,document.signupForm2.income.value,document.signupForm2.zipcode.value,document.signupForm2.zipcoderadious.value,'<?php echo $shddate2;?>','');"><img src="images/update-count.gif" class="m-right5" alt="Update Count" /></a><?php */?> <?php /*?><input type="button" onclick="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.getElementById('gender1').value,document.signupForm2.income.value,document.signupForm2.zipcode.value,document.signupForm2.zipcoderadious.value,'<?php echo $shddate2;?>','');" name="UpdateCount" class="button" value="Update Count"><?php */?>
        </div>
    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
