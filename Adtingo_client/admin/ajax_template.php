<?php
error_reporting(0); 
$nav=12;
include('includes/functions.php'); 
include("includes/adminsessions.php");
//include('includes/header.php'); 
include('includes/values.php');
$object=new main();
if($_GET['act']=='template_check'){
	$id=$_GET['q'];
	$GetCampaignListqry1="select * from tbl_email_template_content where TId=$id";
	$GetCampaignListRes1=$object->ExecuteQuery($GetCampaignListqry1);
	$GetCampaignListRec1=$object->FetchArray($GetCampaignListRes1);
	?><a href="javascript:MM_openBrWindow('viewtemplatepreview.php?image=<?php echo $GetCampaignListRec1['preview'];?>','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=480,height=600')"><img src="http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/thumb_images/<?php echo $GetCampaignListRec1['preview'];?>" border="0" />
	
<?php
}
?>
