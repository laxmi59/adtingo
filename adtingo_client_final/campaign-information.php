<?php 
include_once('includes/session.php');
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
<title><?php echo SITETITLE."Campaign Information"?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script language="javascript" type="text/javascript">
function showpriviewtemplate1(val,num)
{
	//alert(val);
	for(i=1;i<num;i++){
		if(i==val)
			document.getElementById('checked'+i).style.display="block";
		else
			document.getElementById('checked'+i).style.display="none";
	}
}
function showpriviewtemplate(val,count)
{
document.getElementById('templatedisplay'+val).style.display="block";

}

  function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript">
var xmlHttp
function GetSiteFromState(str1){ 
str=document.getElementById(str1).value;
//alert(str);
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null) {
		alert ("Browser does not support HTTP Request")
 		return
 	}
	document.getElementById('checked').innerHTML = "Checking...";
	var field="template_check";
	var url="http://clients.adtingo.com/ajax_template.php"
	url=url+"?q="+str
	url=url+"&act="+field
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=stateChanged 
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}
function stateChanged() { 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") { 
		if(	document.getElementById("checked1").style.display == 'block')
		{
			document.getElementById("checked1").style.display = 'none';
			//alert(document.getElementById("checked1").style.display);
		}
 		document.getElementById("checked").innerHTML=xmlHttp.responseText; 
	} 
}
//main code starts//
function GetXmlHttpObject(){
	var xmlHttp=null;
	try {
		// Firefox, Opera 8.0+, Safari
 		xmlHttp=new XMLHttpRequest();
 	}catch (e) {
 		//Internet Explorer
 		try{
  			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  		} catch (e)  {
  			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
 	}
	return xmlHttp;
}
</script>
<?php include "includes/google_analytic.php";?>
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
                      <style type="text/css">
					  	.temp { margin:0 20px 20px 0; float:left;}
						.temp img { margin:5px 0 0 0;}
					  </style>      
              <h3 class="grad-box">Campaign Creation</h3> 
              <dl class="form">
                <dt>Select template</dt>
				<dd>
				<table border="0" cellspacing="5" cellpadding="0">
					<tr>
					<?php
					$k=4;
					 $GetCampaignListqry="select * from tbl_email_template_content where template_status=1 and client_view_status='on'";
					 $GetCampaignListRes=$object->ExecuteQuery($GetCampaignListqry);
					 for($i=1;$GetCampaignListRec=$object->FetchArray($GetCampaignListRes);$i++){	
					 if($i==$k){$k=$k+4; echo "</tr><tr>";}						   
					 ?>
					 	<td valign="top"><input type="radio" name="templatename" id="templatename<?php echo $i;?>" value="<?php echo $GetCampaignListRec['TId'];?>"  <?php if($RecCampaign_info['template_selection']==$GetCampaignListRec['TId']) { ?> checked="checked" <?php } ?> onclick="showpriviewtemplate1(this.value,<?php echo sizeof($GetCampaignListRec)?>)"  />
						<?php echo stripslashes($GetCampaignListRec['TemplateName']);?> 
						<div id="checked<?php echo $i?>"  style=" height:100px; width:100px; display:<?php if($RecCampaign_info['template_selection']==$GetCampaignListRec['TId']){ echo 'block';}else{echo 'none';}?>;" >
		
		<a href="javascript:MM_openBrWindow('viewtemplatepreview.php?image=<?php echo $GetCampaignListRec['preview'];?>','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=480,height=600')"><img src="http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/thumb_images/<?php echo $GetCampaignListRec['preview'];?>" border="0" /></a>
		
		</div> 
		
		<div id="checked" style=" padding:5px;" >&nbsp;	</div> 
		</td>
		 <?php
		 //$i++;
		 } 
		 ?></tr>
						  <?php   if($templatename_error!="") {?>
					  <tr><td colspan="5" ><span class="red">
		  <?php  echo $templatename_error;?>
		</span></td></tr>
			<?php } ?>
						</table>
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
