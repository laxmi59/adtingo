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
//print_r($_POST);
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

	if($_POST['minage']!=""){
		if (!(is_numeric($_POST['minage']))){
			$min_age_error="Minimum age should accept numbers only";
		 }else
			$min_age_error="";
	}
	if($_POST['maxage']!=""){
		if (!(is_numeric($_POST['maxage']))){
			$max_age_error="Maximum age should accept numbers only";
		}else if($_POST['minage']>=$_POST['maxage']){
			$max_age_error="Minimum age should be less than maximum age";
		}else
			$max_age_error="";
	}	
	if($Num_cols >0 && $max_age_error=="" && $min_age_error=="" && $specifyzipcode_area_error==""){
		$Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set minimum_age=%d, maxmum_age=%d, gender='%s', income=%d, zipcode='%s', zipcode_miles=%d where campaign_id=%d", $object->stripper($_POST["minage"]), $object->stripper($_POST["maxage"]), $object->stripper($_POST["gender"]), $object->stripper($_POST["income"]),$object->stripper($_POST["zipcode"]),$object->stripper($_POST["zipcoderadious"]), $object->stripper($CampaignID));  
		//echo $Insert_seg__List_qry;exit;
		$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
		if($Insert_seg__List_Res){
			unset($_SESSION['campaign']);
			header("location:step5.php?cid=".base64_encode($CampaignID)."");
			exit;
		}
	}
}		
?>

<script language="javascript" type="text/javascript">

function gettotalrecords(arealist,minage,maxage,gender,income,zip,radious,datesent,random_number)
{
//alert(zip);
//displayStaticMessage("<img src='images/loading.gif' />");
	for (var i=0; i < document.signupForm2.gender.length; i++)
   {
   		if (document.signupForm2.gender[i].checked)
		  {
		  var rad_val = document.signupForm2.gender[i].value;
		  }
   }
   
	 var req=createRequest();
	 req.open("GET","GetTotalMemberRecords_admin.php?minage="+minage+"&maxage="+maxage+"&gendersel="+rad_val+"&income="+income+"&area_list="+arealist+"&shddate="+datesent+"&random_number="+random_number+"&zipcode="+zip+"&radious="+radious,true);
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

<?php /*?><body onLoad="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,1,2,'<?php echo $shddate2;?>','');"><?php */?>
<table width="95%" border="0" cellspacing="0" cellpadding="0"><tr><td height="10"></td></tr></table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
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
		</table>    
		<form  action="" method="post" id="signupForm2" name="signupForm2"> 
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
			<td class="form-bg2">
			<table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
			<thead>
			<tr><td  bgcolor="#FFFFFF" height="9" > </td></tr>
			<tr><td   class="table-tab">Select Segmented List Below</td></tr>
			<tr>
				<td width="12%" align="left" class="tr2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				
  <tr>
    <td width="70%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
				
				
				<tr>
					<td height="10" colspan="2" align="left"></td>
				</tr>
				<tr>
					<td height="30" align="left"><strong>Age</strong></td>
					<td align="left">
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><input type="text" value="<?php if($RecCampaign_Seg_list_info['minimum_age']!="0")
		  echo stripslashes($RecCampaign_Seg_list_info['minimum_age']);
		  else
		  echo  $_SESSION['campaign']['minage'];?>" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  name="minage" id="minage" class="textfill-small" /></td>
						<td width="15">&nbsp;</td>
						<td><input type="text" value="<?php if($RecCampaign_Seg_list_info['maxmum_age']!="0")
		  echo stripslashes($RecCampaign_Seg_list_info['maxmum_age']);
		  else
		  echo  $_SESSION['campaign']['maxage'];?>"  name="maxage" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> id="maxage" class="textfill-small" /></td>
					</tr>
					<tr><td colspan="3"><span class="red">
		  <?php if($min_age_error!="") echo $min_age_error;?>
		   <?php if($max_age_error!="") echo $max_age_error;?>
		   </span></td></tr>
					</table>
					</td>
				</tr>
				<tr>
					<td height="30" align="left"><strong>Gender</strong></td>
					<td align="left">
					<table border="0" cellspacing="0" cellpadding="0">
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
{?>disabled="disabled" <?php } ?>   name="gender" id="gender" value="male" <?php echo $malechkstatus; ?><?php if($chkstatus!="") echo $chkstatus;?>   /></td>
							<td width="40">Male</td>
							<td width="15"><input type="radio" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> name="gender" id="gender" class="m-left5" value="female" <?php echo $femalechkstatus; ?>   /></td>
							<td width="55">Female </td>
							<td width="15"><input type="radio" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> class="m-left5"  name="gender" id="gender" value="both" <?php echo $bothchkstatus; ?>   /></td>
							<td width="80">Both</td>
						  </tr>
						</table></td>
					  </tr>
					  
					  <tr>
						<td height="30" align="left"><strong>Income</strong></td>
						<td align="left"><select id="income" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> name="income" class="w-165" >
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
						<td height="30" align="left"><strong>
Enter Zip Code</strong></td>
						<td align="left"><input name="zipcode" id="zipcode" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  type="text" value="<?php if($RecCampaign_Seg_list_info['zipcode']!="")
			echo $RecCampaign_Seg_list_info['zipcode'];?>" onBlur="hide_radious(this.value)"    />                                </td>
					  </tr>
					<?php   if($zipcode_area_error!="") {?>
					  <tr><td>&nbsp;</td><td ><span class="red-normal">
		  <?php  echo $zipcode_area_error;?>
		</span></td></tr>
			<?php } ?>
					  <tr>
						<td height="30" align="left"><strong>And Zip Codes Within</strong></td>
						<td align="left"><select name="zipcoderadious" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> id="zipcoderadious"  >
		<option value="">Select Miles</option>
		 <?php 
		 if($RecCampaign_Seg_list_info['zipcode_miles']!="0")
		   $value=$RecCampaign_Seg_list_info['zipcode_miles']; 
			echo Get_Zipcode_Radious_Count($value);?>
		   
		</select>                                </td>
					  </tr>
					  <?php if($specifyzipcode_area_error!="") {?>
					   <tr><td>&nbsp;</td><td  ><span class="red-normal">
		  <?php  echo $specifyzipcode_area_error;?>
		</span></td></tr><?php } ?>
					  
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
					</table></td>
    <td width="30%" valign="top" style="padding-top:20px"><table width="90%" border="0" cellspacing="0" cellpadding="0" style="background:#fff; padding:5px 10px 10px 10px; border:solid 1px #ddd">
  <tr>
    <td align="center" style="font-size:13px;">Total Number Of Records: <strong><span id="totalrecords" style="color:blue"></span></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input type="button" onClick="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,document.signupForm2.zipcode.value,document.signupForm2.zipcoderadious.value,'<?php echo $shddate2;?>','');" name="UpdateCount" class="button" value="Update Count"></td>
  </tr>
</table>
</td>
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
{?>   // gettotalrecords(arealist,minage,maxage,gender,income,zip,radious,datesent,random_number)
	   gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,document.signupForm2.minage.value,document.signupForm2.maxage.value,document.signupForm2.gender.value,document.signupForm2.income.value,document.signupForm2.zipcode.value,document.signupForm2.zipcoderadious.value,'<?php echo $shddate2;?>','');
	   hide_radious(document.signupForm2.zipcode.value);
<?php } else {?>
GetListedRecords('<?php echo $CampaignID;?>');
hide_radious(document.signupForm2.zipcode.value);
<?php } ?>	   
	  </script>
     <?php include('includes/footer.php'); ?>