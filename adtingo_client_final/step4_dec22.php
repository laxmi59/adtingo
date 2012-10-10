<?php
include_once('includes/session.php'); 
include_once('includes/functions.php'); 
include_once('includes/values.php'); 
$object=new main();
$Num_cols="0";
$count=0;
if($_REQUEST['Val']!="")
{
$CampaignID=base64_decode($_REQUEST['cid']);
	 $UpdateCampaignzipcodeqry="update tbl_campaign_list_segmentation set zipcode ='',zipcode_miles='' where campaign_id=".$CampaignID.""; 
		$UpdateCampaignzipcodeRes=$object->ExecuteQuery($UpdateCampaignzipcodeqry);
}
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

	$pcode=$RecCampaign_Seg_list_info['zipcode'];
	$miles=$RecCampaign_Seg_list_info['zipcode_miles'];	
	$Zipcodechk="";
	  if($pcode!="" && $miles!="")
	{
	  $GetLogLattitudedetailsqry="select  distinct  LATITUDE,LONGITUDE from zip_code where ZIP_CODE=".$pcode."";
	$GetLogLattitudedetailsRes=$object->ExecuteQuery($GetLogLattitudedetailsqry);
	   $object->NumRows($GetLogLattitudedetailsRes); 
	$tt=$object->FetchArray($GetLogLattitudedetailsRes);

  $sel="select distinct ZIP_CODE ,LATITUDE,LONGITUDE, (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) as distance from zip_code  where (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) 
< $miles order by distance";
	$GetAllZipcodesres=$object->ExecuteQuery($sel);
	$zipcodedb=array();
	  $object->NumRows($GetAllZipcodesres); 
	while($GetAllZipcodesrec=$object->FetchArray($GetAllZipcodesres))
	{
			$zipcodedb[]=$GetAllZipcodesrec['ZIP_CODE'];
	}
	if(count($zipcodedb)>0)
{
$Dbzipcodes=implode(",",$zipcodedb);
$Zipcodechk="  and tbl_members.zipcode IN (".$Dbzipcodes.") ";
}
else
	$Zipcodechk="  and tbl_members.zipcode IN (0) "; 


}
//$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
	if(isset($_POST['step4submit_x_x']))
	{
	$Random_num_error="";
	if($_POST['sendall']=='1' || $_POST['sendall']=='2')
	{
	$_SESSION['campaign']['random_number']=$_POST['random_number'];
	$_SESSION['campaign']['sendall']=$_POST['sendall'];
		if($_POST['sendall']=='1')
		{
			if($Num_cols >0)
			{
					$count=$count+1;
			}
		}
		else
		{
			if($_POST['random_number']!='')
			{
				$_SESSION['campaign']['random_number']=$_POST['random_number'];
				if (is_numeric($_POST['random_number']))
				 {
					  if($_POST['random_number']<=$_POST['totrec'] && $_POST['random_number']>=1) 
					  	{
						$count=$count+1;
						}
						else
						$Random_num_error="Specify Number should be less than Total number of records";
				
				}
				 else {
					$Random_num_error="Specify Number should accept numbers only";
				}
			
			}
			else
			{
				if($_POST["random_number"]=="")
				{
				$_SESSION['campaign']['sendall']=$_POST['sendall'];
				$Random_num_error="Specify Number Field Required";
				$_SESSION['campaign']['random_number']="";
				}
				else
				$_SESSION['campaign']['random_number']=$_POST["random_number"];
			}
		}
		}
		else
		{
		$Random_num_error="Select The Option To Send Campaign";
		}
		
			
			if($count>0)
			{
				$Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set 	sendall_option=%d,random_number=%d where campaign_id=%d",$object->stripper($_POST["sendall"]),$object->stripper($_POST["random_number"]),$object->stripper($CampaignID));
				$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
				unset($_SESSION['campaign']);
				header("location:campaign-information.php?cid=".base64_encode($CampaignID)."");
				exit;
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
<script src="js/javascript.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">

function gettotalrecords(arealist,minage,maxage,gender,income,zipcode,radious,datesent,random_number)
{
	
	 var req=createRequest();
	 req.open("GET","GetTotalMemberRecords.php?minage="+minage+"&maxage="+maxage+"&gendersel="+gender+"&income="+income+"&area_list="+arealist+"&zipcode="+zipcode+"&radious="+radious+"&shddate="+datesent+"&random_number="+random_number,true);
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
					document.getElementById("totrec").value=res;
					//alert(res);
				}
				else
				{
					
					document.getElementById("totalrecords").innerHTML="0";
					//document.profilrfrm.errormess.value=0;
					document.getElementById("totrec").value="0";
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
					//document.profilrfrm.errormess.value=1;"totrec
					
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
 </head>
 <?php if($RecCampaign_info['status']!=5)
{?>
<body onload="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>,<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>,'<?php echo $RecCampaign_Seg_list_info['gender'];?>','<?php echo $RecCampaign_Seg_list_info['income'];?>','<?php echo $RecCampaign_Seg_list_info['zipcode'];?>','<?php echo $RecCampaign_Seg_list_info['zipcode_miles'];?>','<?php echo $shddate2;?>','')">
<?php } else { ?>
<body onload="return GetListedRecords('<?php echo $CampaignID;?>');">
<?php } ?>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Step 1.5: List Segmentation</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="signupForm4" id="signupForm4">                              
            <div class="grey-box">
                <h3 class="grad-box">Select The Option To Send Campaign</h3>
              <div class="tno-rec">  Total Number Of Records: <strong><span id="totalrecords">
			  </span></strong>
			  <input type="hidden" name="totrec" id="totrec"  /> </div>
              <div class="small-form">
                <input name="sendall" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> id="sendall" type="radio" value="1" onclick="return sendallcheck();" <?php if($RecCampaign_Seg_list_info['sendall_option']=='1') { ?> checked="checked" <?php } ?> /> Send to All  <br />
 				<input name="sendall" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> id="send_random" type="radio" value="2" onclick="return sendallcheck();" <?php if($RecCampaign_Seg_list_info['sendall_option']=='2' || $_SESSION['campaign']['sendall']=='2') { ?> checked="checked" <?php } ?> /> Specify Number <input name="random_number" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> id="random_number" type="text" class="w-60"  value="<?php if($RecCampaign_Seg_list_info['random_number']!="0") echo $RecCampaign_Seg_list_info['random_number'];?>" 
	<?php if($RecCampaign_Seg_list_info['sendall_option']=='1')	 {?> disabled="disabled" <?php }?>		
				/> 
              </div> 
			  <span class="red">
		     <?php if($Random_num_error!="") echo $Random_num_error;?>
             </span>
             </div>
<?php if($RecCampaign_info['status']==5)
					{?>
					<input type="hidden" name="sendall" id="sendall" value="" />
					 <input type="hidden" name="random_number" id="random_number" value="" />
                  <?php }?>
          <a href="step3.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a>
		  <?php if($RecCampaign_info['status']==5)
			{?>
			<a href="campaign-information.php?cid=<?php echo base64_encode($CampaignID);?>"><img src="images/next.gif" alt="Next" class="m-left5" /></a>
		 
		  <?php } else { ?> <input   src="images/next.gif"  type="image" name="step4submit_x" id="step4submit_x" /> 

		<?php } ?>
    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
