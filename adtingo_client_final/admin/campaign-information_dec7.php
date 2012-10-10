<?php 
error_reporting(0); 
$nav=12;
include('includes/functions.php'); 
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');
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
if($_REQUEST['errmsg']==1) $listing_id_error1="Enter Listing Id";
if(isset($_POST['submitproduct']))
{
	if($_POST['templatename']!='')
	{
		if($_POST["templatename"]==3 || $_POST["templatename"]==4)
		{
			if($_POST['listing_id']==0){
				$listing_id_error="Enter Listing Id";
				$_SESSION['campaign']['listing_id']="";
			}else
			$_SESSION['campaign']['listing_id']=$_POST["listing_id"];
		}
				
		if(!$listing_id_error){
			if($Num_cols >0)
			{
				//echo $_POST['listing_id'];exit;
				if($_POST["templatename"]==3 || $_POST["templatename"]==4){
					$url="http://api2.citysearch.com/profile/?listing_id=".$_POST['listing_id']."&client_ip=184.73.167.196&reference_id=1&publisher=0905768917&placement=home&api_key=gkpyqcng3yj9w4zn9ns2rcr3&format=xml";
					//echo $url;exit;
					$xmlStr = file_get_contents($url);
					$xmlObj = simplexml_load_string($xmlStr);
					$arrXml = objectsIntoArray($xmlObj);
					//echo $arrXml['location']['contact_info']['display_phone'];	exit;
					//echo $arrXml['location']['reference_id']."<br>";		
					$content=str_replace("’","'",$arrXml['location']['customer_content']['customer_message']);
					$content1=str_replace("‘","'",$content);
					$content2=str_replace("“",'"',$content1);
					$content3=str_replace("”",'"',$content2);
							
					$Insert_campaign_info_qry=sprintf("update tbl_campaigns  set template_selection=%d, heading='%s', sub_heading='%s', text_content='%s', map_address='%s', map_city='%s', map_state ='%s', phone ='%s', websiteurl ='%s', map_zipcode ='%s', destination_url ='%s', listing_id=%d, ref_id=%d where campaign_id=%d",$object->stripper($_POST["templatename"]), $object->stripper(addslashes($arrXml['location']['name'])), $object->stripper(addslashes($arrXml['location']['teaser'])), $object->stripper(addslashes($content3)),$object->stripper(addslashes($arrXml['location']['address']['street'])), $object->stripper(addslashes($arrXml['location']['address']['city'])), $object->stripper(addslashes($arrXml['location']['address']['state'])), $object->stripper($arrXml['location']['contact_info']['display_phone']), $object->stripper(addslashes($arrXml['location']['contact_info']['display_url'])), $object->stripper($arrXml['location']['address']['postal_code']), $object->stripper(addslashes($arrXml['location']['urls']['profile_url'])),$object->stripper($_POST['listing_id']),$object->stripper($arrXml['location']['reference_id']), $object->stripper($CampaignID));
					//echo $Insert_campaign_info_qry;exit;
				}else{
			   		//$Insert_campaign_info_qry=sprintf("update tbl_campaigns  set template_selection=%d, heading='%s', sub_heading='%s', text_content='%s', map_address='%s', map_city='%s', map_state ='%s', phone =%d, websiteurl ='%s', map_zipcode ='%s', destination_url ='%s', listing_id=%d where campaign_id=%d",$object->stripper($_POST["templatename"]), $object->stripper(''), $object->stripper(''), $object->stripper(''), $object->stripper(''), $object->stripper(''), $object->stripper(''), $object->stripper(''), $object->stripper(''), $object->stripper(''), $object->stripper(''),$object->stripper(''), $object->stripper($CampaignID));
					$Insert_campaign_info_qry=sprintf("update tbl_campaigns set template_selection=%d,listing_id=%d where campaign_id=%d",$object->stripper($_POST["templatename"]),$object->stripper($_POST["listing_id"]), $object->stripper($CampaignID));
				}
				$Insert_campaign_info_Res=$object->ExecuteQuery($Insert_campaign_info_qry);  
				
			if($Insert_campaign_info_Res)
			{
				unset($_SESSION['campaign']);
				header("location:add-own-template.php?cid=".base64_encode($CampaignID)."");
				exit;
			}
			}
		}else{
			$Insert_campaign_info_qry=sprintf("update tbl_campaigns set template_selection=%d where campaign_id=%d",$object->stripper($_POST["templatename"]), $object->stripper($CampaignID));
			$Insert_campaign_info_Res=$object->ExecuteQuery($Insert_campaign_info_qry);  
			if($Insert_campaign_info_Res)
			{
				unset($_SESSION['campaign']);
				header("location:campaign-information.php?cid=".base64_encode($CampaignID)."&errmsg=1");
				//exit;
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

<script language="javascript" type="text/javascript">
function showpriviewtemplate1(val,num)
{
	//alert(val);
	var vl=3;
	if(val==3 || val==4){
		//alert(val);
		document.getElementById('listing_id_show').style.display="block";
		
	}else{
		document.getElementById('listing_id_show').style.display="none";
		document.getElementById('listerr').style.display="none";
	}
	for(i=1;i<num;i++){
		if(i==val)
			document.getElementById('checked'+i).style.display="block";
		else
			document.getElementById('checked'+i).style.display="none";
	}
	
}
function showpriviewtemplate(val)
{
	document.getElementById('templatedisplay'+val).style.display="block";

}
function MM_openBrWindow(theURL,winName,features) { //v2.0
	window.open(theURL,winName,features);
}

</script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
var xmlHttp
function GetSiteFromState(str1){ 
str=document.getElementById(str1).value;
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null) {
		alert ("Browser does not support HTTP Request")
 		return
 	}
	document.getElementById('checked').innerHTML = "Checking...";
	var field="template_check";
	var url="ajax_template.php"
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
<script type="text/javascript">
    var _csv = {};
    _csv['action_target'] = 'listing_profile';
    _csv['listing_id'] = '10100230';
    _csv['publisher'] = '0905768917';
    _csv['reference_id'] = '10100230';
    _csv['placement'] = 'posting';
   
</script>
<script type="text/javascript" src="http://images.citysearch.net/assets/pfp/scripts/tracker.js"></script><noscript>
    <img src='http://api.citysearch.com/tracker/imp?action_target=listing_profile&listing_id=10100230&publisher=0905768917&reference_id=10100230&
    placement=posting' width='1' height='1' alt='' />
</noscript>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
	<thead>
	<tr>
		<td width="83%" height="100" align="left" class="tr5">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">                  
		<tr>
			<td height="20" align="left" class="content-header">Campaign Information</td>
			<td align="right"  class="padbot5">&nbsp;</td>
		</tr>
		<tr class="grey-bg">
			<td height="4" colspan="2"></td>
		</tr>
		</table>   
		<form  action="" method="post" name="signupForm5" id="signupForm5">      
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
			<tr>
				<td width="12%" align="left" class="tr2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">			  
				<tr>
					<td width="23%" height="10" align="left"></td>
					<td width="76%" height="10" align="left"></td>
				</tr>
				<tr>
					<td height="30" colspan="2" align="left" class="table-tab">Campaign Creation</td>
				</tr>
				<tr>
					<td height="10" colspan="2" align="left"></td>
				</tr>
				<tr>
					<td height="30" align="left"><strong>Select template</strong></td>
					<td align="left">
					<table border="0" cellspacing="5" cellpadding="0">
					<tr>
					<?php
					$k=4;
					 $GetCampaignListqry="select * from tbl_email_template_content where template_status=1";
					 $GetCampaignListRes=$object->ExecuteQuery($GetCampaignListqry);
					 for($i=1;$GetCampaignListRec=$object->FetchArray($GetCampaignListRes);$i++){	
					 if($i==$k){$k=$k+4; echo "</tr><tr>";}						   
					 ?>
					 	<td><input type="radio" name="templatename" id="templatename<?php echo $i;?>" value="<?php echo $GetCampaignListRec['TId'];?>"  <?php if($RecCampaign_info['template_selection']==$GetCampaignListRec['TId']) { ?> checked="checked" <?php } ?> onclick="showpriviewtemplate1(this.value,<?php echo sizeof($GetCampaignListRec)?>), show(this.value)"  />
						<?php echo stripslashes($GetCampaignListRec['TemplateName']);?> 
						<div  id="checked<?php echo $i?>" style=" height:100px; width:100px; display:<?php if($RecCampaign_info['template_selection']==$GetCampaignListRec['TId']){ echo 'block';}else{echo 'none';}?>;" >
		
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
						</table></td>
					  </tr>
					  <tr>
					  <td colspan="2">
					  <?php
						if($RecCampaign_info['template_selection']==3 || $RecCampaign_info['template_selection']==4 || $listing_id_error!=""){ $dt=1; }?>
						<div id="listing_id_show" style="display:<?php if($dt==1){?> block <?php }else{?>none <?php }?> ">
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">			  
				<tr>
					<td width="23%" height="10" align="left"></td>
					<td width="76%" height="10" align="left"></td>
				</tr>
					  <td>Listing ID</td>
						<td>
						<input type="text" name="listing_id" value="<?php if($RecCampaign_info['listing_id']==0) echo ''; else echo $RecCampaign_info['listing_id'];?>" />
						
						</td>
						</tr></table></div></td></tr>
					  <?php   if($listing_id_error!="" || $listing_id_error1!=='') {?>
					  <tr><td colspan="5" ><span class="red" id="listerr">
		  <?php  echo $listing_id_error; echo $listing_id_error1;?>
		</span></td></tr>
			<?php } ?>
					  <tr>
						<td height="10" colspan="2" align="left"></td>
						</tr>
					  
					  <tr>
						<td height="30" align="left">&nbsp;</td>
						<td align="left"><table border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td><a href="step5.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>"></a>
							<input type="button" name="button" id="button" value="back" class="button" onclick="javascript:window.location='step5.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>'" />
							</td>
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