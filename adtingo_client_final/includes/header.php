<div class="header">
  <div class="nav">
    <div class="logo"><a href="index.php" title="Campaign Monitor - Home">&nbsp;</a></div>
    <div class="links">
      <ul>
        <li><a href="overview.php">Manage Campaigns</a></li>
        <li><a href="member-profile.php">Account Settings</a></li>
        <li><span style="color:#7bdef3"><?php
		$object=new main();
		echo $client_Name=$object->GetClientUsername($_SESSION['clientid']);
		 ?></span></li>
        <li><a href="logout.php"><span>Logout</span></a></li>
      </ul>
    </div>
  </div>
</div>
<!--end header-->
<!--banner-->
<div class="banner">
  <div class="containt">
  <?php
  $a=pathinfo($_SERVER['SCRIPT_NAME']);
   if(($a[basename]=='member-profile.php')  || ($a[basename]=='edit-account-setting.php') || ($a[basename]=='change-password.php') || ($a[basename]=='billing-details.php') || ($a[basename]=='edit-billing-details.php'))
   
{  ?>
 <h1>Account Settings</h1>
 <?php
 } 	
	  if(($a[basename]=='overview.php') || ($a[basename]=='lnk-activity-overlay.php') || ($a[basename]=='reports.php') || ($a[basename]=='campaign-performance-report.php') || ($a[basename]=='step1.php') || ($a[basename]=='step2.php') || ($a[basename]=='step3.php') || ($a[basename]=='step4.php') || ($a[basename]=='step5.php')|| ($a[basename]=='campaign-show-results.php') || ($a[basename]=='edit-campaign.php') || ($a[basename]=='payment-gateway.php') || ($a[basename]=='template-preview.php') || ($a[basename]=='campaign-comparison.php') || ($a[basename]=='campaign-information.php') || ($a[basename]=='add-own-template.php') || ($a[basename]=='campaign_confirmation.php') || ($a[basename]=='create-campaign.php') || ($a[basename]=='viewCampaign.php'))
		{ 
		$overview_class="";
		$campaign_class=="";
		$report_class="";
		if($a[basename]=='overview.php')
		$overview_class="active";
		
		else if(($a[basename]=='lnk-activity-overlay.php') || ($a[basename]=='reports.php') || ($a[basename]=='campaign-performance-report.php')  ||  ($a[basename]=='campaign-show-results.php')  ||  ($a[basename]=='campaign-comparison.php'))
		 $report_class="active"; 
		
		else if(($a[basename]=='step1.php') || ($a[basename]=='step2.php') || ($a[basename]=='step3.php') || ($a[basename]=='step4.php') || ($a[basename]=='step5.php') || ($a[basename]=='edit-campaign.php') || ($a[basename]=='payment-gateway.php') || ($a[basename]=='template-preview.php') || ($a[basename]=='campaign-information.php') || ($a[basename]=='add-own-template.php'))
		$campaign_class="active";
		
		?>
<h1>Manage Campaigns</h1>
    <div class="nav">
      <ul>
        <li class="<?php echo $overview_class;?>"><a href="overview.php" ><span>Overview</span></a></li>
        <li class="<?php echo $campaign_class;?>"><a href="step1.php" ><span>Create Campaign</span></a></li>
        <li  class="<?php echo $report_class; ?>" ><a href="reports.php" ><span>Reports</span></a></li>
      </ul>
    </div>
  
<?php } ?>
</div>
</div>
<link rel="stylesheet" href="../admin/lightbox/css/modal-message.css" type="text/css">
<script type="text/javascript" src="../admin/lightbox/js/ajax.js"></script>
<script type="text/javascript" src="../admin/lightbox/js/modal-message.js"></script>
<script type="text/javascript" src="../admin/lightbox/js/ajax-dynamic-content.js"></script>
<script type="text/javascript">
messageObj = new DHTML_modalMessage();	// We only create one object of this class
messageObj.setShadowOffset(5);	// Large shadow


function displayMessage(url)
{
	
	messageObj.setSource(url);
	messageObj.setCssClassMessageBox(false);
	messageObj.setSize(400,200);
	messageObj.setShadowDivVisible(true);	// Enable shadow for these boxes
	messageObj.display();
}

function displayStaticMessage(messageContent,cssClass)
{
	messageObj.setHtmlContent(messageContent);
	messageObj.setSize(300,150);
	messageObj.setCssClassMessageBox(cssClass);
	messageObj.setSource(false);	// no html source since we want to use a static message here.
	messageObj.setShadowDivVisible(false);	// Disable shadow for these boxes	
	messageObj.display();
	
	
}

function closeMessage()
{
	messageObj.close();	
}


</script>