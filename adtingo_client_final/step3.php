<?php 
include_once('includes/session.php');
include_once('includes/functions.php'); 
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
//$_SESSION['TotalRecords']=$SearchResult;

}
if(isset($_POST['step3submit_x_x']))
{
	if($_POST['zipcode']!='' && $_POST['zipcoderadious']!='')
	{
		if(preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$_POST['zipcode']))
		{
			if($Num_cols >0)
			{
			 // $Intrest_activities1=implode(",",$_POST['intrest']);
			 $Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set zipcode='%s',zipcode_miles=%d where campaign_id=%d",$object->stripper($_POST["zipcode"]),$object->stripper($_POST["zipcoderadious"]),$object->stripper($CampaignID));  
			$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
				if($Insert_seg__List_Res)
				{
					unset($_SESSION['campaign']);
					header("location:step4.php?cid=".base64_encode($CampaignID)."");
					exit;
				}
			}
		}else{
			$zipcode_area_error="Invalid Zipcode Format";
			$_SESSION['campaign']['zipcode']="";
		}
	}
	else
	{
		$zipcode_area_error="";
		$specifyzipcode_area_error="";
		if($_POST["zipcode"]=="")
		{
			$zipcode_area_error="Zipcode Required";
			$_SESSION['campaign']['zipcode']="";
		}else{
			$zipcode_area_error="Invalid Zipcode Format";
			$_SESSION['campaign']['zipcode']="";
		}
		if($_SESSION['campaign']['zipcode']!='')
			$_SESSION['campaign']['zipcode']=$_POST["zipcode"];
		if($_POST["zipcoderadious"]=="")
		{
			$specifyzipcode_area_error="And Zip Codes Within  field Required";
			$_SESSION['campaign']['zipcoderadious']="";
		}
		else
			$_SESSION['campaign']['zipcoderadious']=$_POST["zipcoderadious"];
	}  
		
}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" type="text/javascript">

function gettotalrecords(arealist,minage,maxage,gender,income,zipcode,radious,datesent,random_number)
{
	displayStaticMessage("<img src='images/loading.gif' />");
	 var req=createRequest();
	 //document.getElementById('totalrecords').innerHTML = "Checking...";
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

</script>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<?php include "includes/google_analytic.php";?>
</head>
 <?php if($RecCampaign_info['status']!=5)
{?>
<body onload="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>,<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>,'<?php echo $RecCampaign_Seg_list_info['gender'];?>',<?php echo $RecCampaign_Seg_list_info['income'];?>,document.signupForm3.zipcode.value,document.signupForm3.zipcoderadious.value,'<?php echo $shddate2;?>','')">
<?php } else { ?>
<body onload="return GetListedRecords('<?php echo $CampaignID;?>');">
<?php } ?>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Step 1.4: List Segmentation</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="signupForm3" id="signupForm3">                              
            <div class="grey-box">
                <h3 class="grad-box">Zip Codes</h3>
              <div class="tno-rec"> Total Number Of Records: <strong><span id="totalrecords">
			  </span></strong> </div>
              <dl class="form">
                <dt>Enter Zip Code</dt>
                <dd><input name="zipcode" id="zipcode" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>    type="text"   value="<?php if($RecCampaign_Seg_list_info['zipcode']!="")
			  		echo $RecCampaign_Seg_list_info['zipcode'];?>" onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>,<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>,'<?php echo $RecCampaign_Seg_list_info['gender'];?>',<?php echo $RecCampaign_Seg_list_info['income'];?>,document.signupForm3.zipcode.value,document.signupForm3.zipcoderadious.value,'<?php echo $shddate2;?>','');"  />
				<br/>
				<span class="red">
				  <?php if($zipcode_area_error!="") echo $zipcode_area_error;?>
				</span>
				</dd>
			
                <dt>And Zip Codes Within </dt>
                <dd><select name="zipcoderadious" id="zipcoderadious" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>,<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>,'<?php echo $RecCampaign_Seg_list_info['gender'];?>',<?php echo $RecCampaign_Seg_list_info['income'];?>,document.signupForm3.zipcode.value,document.signupForm3.zipcoderadious.value,'<?php echo $shddate2;?>','');"  >
                <option value="">Select Miles</option>
                 <?php 
				 if($RecCampaign_Seg_list_info['zipcode_miles']!="0")
				   $value=$RecCampaign_Seg_list_info['zipcode_miles']; 
					echo Get_Zipcode_Radious($value);?>
                   
                </select>
				<br/>
				<span class="red">
				  <?php if($specifyzipcode_area_error!="") echo $specifyzipcode_area_error;?>
				</span>
				</dd>
				<?php if($RecCampaign_info['status']==5)
					{?>
					<input type="hidden" name="zipcode" id="zipcode" value="" />
					 <input type="hidden" name="schedule_date" id="zipcoderadious" value="" />
                  <?php }?>
				 
                 
				  
              </dl> 
             </div>
          <a href="step2.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><?php if($RecCampaign_info['status']==5)
					{?> <a href="step4.php?cid=<?php echo base64_encode($CampaignID);?>"><img src="images/next.gif" alt="Next" class="m-left5" /></a> <?php } else {?><input  src="images/next.gif"  type="image" name="step3submit_x" id="step3submit_x" /><?php }?><a href="step4.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>"><img src="images/skip-the-test.gif" alt="Skip" class="m-left5" /></a>
    </form>  
</div>
<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>