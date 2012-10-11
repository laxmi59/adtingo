<?php 
include_once('includes/functions.php'); 
//include('includes/dbfiler.php'); 
include_once('includes/values.php'); 
$object=new main();
$Num_cols="0";
if($_REQUEST['cid']!="")
{
	$CampaignID=base64_decode($_REQUEST['cid']);
  	 $SqlCampaign_info="select * from tbl_campaigns where campaign_id=".$CampaignID ; 
	$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
	 $Num_cols=$object->NumRows($ResCampaign_info);
	$RecCampaign_info=$object->FetchArray($ResCampaign_info);

}
$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
if(isset($_POST['step4submit_x_x']))
{
	if($_POST['templatename']!='')
		{
		if($Num_cols >0)
			{
			   $Insert_campaign_info_qry=sprintf("update tbl_campaigns  set template_selection=%d where campaign_id=%d",$object->stripper($_POST["templatename"]),$object->stripper($CampaignID));
			$Insert_campaign_info_Res=$object->ExecuteQuery($Insert_campaign_info_qry);  
			if($Insert_campaign_info_Res)
			{
				unset($_SESSION['campaign']);
				header("location:add-own-template.php?cid=".base64_encode($CampaignID)."");
				exit;
			}
			}
		
		}
		else
		{
			$templatename_error="";
			
				if($_POST["templatename"]=="")
				{
				$templatename_error="Select template Required";
				$_SESSION['campaign']['templatename']="";
				}
				else
				$_SESSION['campaign']['templatename']=$_POST["templatename"];
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
<script language="javascript" type="text/javascript">
function showpriviewtemplate(val)
{
if(val==1)
{
document.getElementById("template1").style.display="block";
document.getElementById("template2").style.display="none";
}
if(val==2)
{
document.getElementById("template2").style.display="block";
document.getElementById("template1").style.display="none";
}
}

  function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>
<body onload="return showpriviewtemplate(<?php echo $RecCampaign_info['template_selection'];?>);">
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Campaign Information</h2><img src="images/step2.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="signupForm5" id="signupForm5">                              
            <div class="grey-box">
                            
              <h3 class="grad-box">Campaign Creation</h3> 
              <dl class="form">
                <dt>Select template</dt>
                <dd> <input type="radio" name="templatename" id="templatename1" value="1"  <?php if($RecCampaign_info['template_selection']=='1') { ?> checked="checked" <?php } ?> onclick="return showpriviewtemplate(1);" /> 
                  Template 1 
                  <input type="radio" class="m-left5" name="templatename" id="templatename2" value="2" <?php if($RecCampaign_info['template_selection']=='2') { ?> checked="checked" <?php } ?> onclick="return showpriviewtemplate(2);"/> 
                  Template 2 
                  
				  <br/>
				  <span class="red">
				 <?php if($templatename_error!="") echo $templatename_error;?>
				 </span>
				  </dd> 
				   <dt></dt>
                <dd><div id="template1" style="display:none;" ><a href="javascript:MM_openBrWindow('viewtemplatepreview.php?image=image-examplelargevertical.jpg','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=480,height=600')">
	<img src="images/image-examplelargevertical.jpg" width="100" height="100" /></a></div>
	<div id="template2" style="display:none;" ><a href="javascript:MM_openBrWindow('viewtemplatepreview.php?image=image-examplelargewide.jpg','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=480,height=600')">
	<img src="images/image-examplelargewide.jpg" width="100" height="100" /></a></div>
				  </dd> 
              </dl> 
             </div>

          <a href="step4.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" name="step4submit_x" id="step4submit_x" /> 

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
