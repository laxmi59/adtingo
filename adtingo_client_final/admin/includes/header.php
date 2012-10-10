<?php
error_reporting (E_ALL ^ E_NOTICE);
ob_start();
//ini_set("display_errors",1);
include_once("functions.php");
include_once("pager.php");
include_once("globalvalues.php");
$object=new main();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE." Administrator"?></title>

<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/reset.css" media="all" />

<script type="text/javascript" src="js/jquery.js"></script>

<script src="js/p7popmenu.js" type="text/javascript"></SCRIPT>
<style type=text/css media=screen>   
@import url(css/p7pmh0.css); 
</style>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAba8Tt0uYKnkrkb0C895m_hRv9URdpAaw_K8G1Rg0y6NdHfp3pBQiEsEdlk60Zz1MU6HK-Fmz3nY2Xw" type="text/javascript"></script>
 <!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAba8Tt0uYKnkrkb0C895m_hT6hgW3SnPsym-BX2K9uBwQwohXrxSY1owwZMdUjzgh-8_CAf0T0RJ2Mg" type="text/javascript"></script>-->
<script type="text/javascript" src="js/highslide-with-html.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>
<link type="text/css" href="css/highslide.css" rel="stylesheet" />
<link rel="stylesheet" href="../lightbox/css/modal-message.css" type="text/css">
<script type="text/javascript" src="../lightbox/js/ajax.js"></script>
<script type="text/javascript" src="../lightbox/js/modal-message.js"></script>
<script type="text/javascript" src="../lightbox/js/ajax-dynamic-content.js"></script>
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
<script type="text/javascript">
hs.graphicsDir = 'images/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'rounded-white';
hs.fadeInOut = true;
hs.wrapperClassName = 'no-footer'; 

//hs.dimmingOpacity = 0.75;

// Add the controlbar
/*hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		opacity: .75,
		position: 'bottom center',
		hideOnMouseOut: true
	}
});*/
</script>


<script type="text/javascript">
var map = null;
var geocoder = null;
function load() 
{
	//alert('aa');
	if (GBrowserIsCompatible()) {
	map = new GMap2(document.getElementById("map"));
	geocoder = new GClientGeocoder();
	}
}
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//--><script type="text/javascript" src="js/thickbox.js">
</script>

<script type="text/javascript" src="../js/jquery-1.3.1.js"></script>
<script type="text/javascript" src="../js/ui.datepicker.js"></script>
<script type="text/javascript" src="../js/ui.core.js"></script>
<link type="text/css" rel="stylesheet" href="../css/theme/ui.all.css"/>
<script type="text/javascript" src="js/javascript.js"></script>
<script type="text/javascript" src="../js/calendar.js"></script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />

</head>
<body onLoad="load()" onUnload="GUnload()" >

 <?php 
 
 	$members= "";
	$clients  = "";
	$admin  = "";
	$datalist="";
	$catlist="";
	$arealist="";
	$novar = "";
	$managecampaign="";
	$manageemailtemp="";
	$catart="";
	$payments="";
	$CampaignsList="";
	if($nav==0)
	{
		$members = "selected";
	}
	
	
	else if($nav==3)
	{
		$clients  = "selected";
	}
	else if($nav==4)
	{
		$admin  = "selected";
	}
	else if($nav==5)
	{
		$datalist  = "selected";
	}
	else if($nav==6)
	{
		$catlist  = "selected";
	}
	else if($nav==7)
	{
		$arealist  = "selected";
	}
	else if($nav==8)
	{
		$managecampaign = "selected";
	}
	else if($nav==9)
	{
		$manageemailtemp = "selected";
	}
	else if($nav==10)
	{
		$catart  = "selected";
	}
	else if($nav==11)
	{
		$payments  = "selected";
	}
	else if($nav==12)
	{
		$CampaignsList  = "selected";
	}
	else if($nav==13)
	{
		$managereports  = "selected";
	}





  ?>

<?php 

 if($_SERVER['REQUEST_URI']==DOC_ROOT ."/admin/index.php" || $_SERVER['REQUEST_URI']==DOC_ROOT ."/admin/"  || $_SESSION['AdminID']=='')
 {?><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" height="53" class="header"><span class="logo"><img src="images/logo.png"   /> </span></td>
    <td width="50%" align="right" class="header padtop10 p-right30">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="nav-bar"><div class="nav-bar">
    

    

</div></td>
  </tr>
</table>
 <?php } else { 
 ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" height="53" class="header"><span class="logo"><img src="images/logo.png" /></span></td>
    <td width="50%" align="right" class="header padtop10 p-right30">   
	<?php
	$sel1=$object->ExecuteQuery("select * from wp_users where ID =1");
	$sel=$object->FetchArray($sel1);
	?>
	<form name="loginform" id="loginform" target="_blank" action="http://adtingo.com/wp-login.php" method="post">
		<input type="hidden" name="user_log"  id="user_log" class="input" value="<?php echo $sel[user_login]?>" size="20" tabindex="10" />
		
	</p>

		<input type="submit" style="background:none; border:1px solid #0C3064; color:#9FD7FF; cursor:pointer; text-decoration:underline; font-family:Arial,Helvetica,sans-serif" name="wp-submit" id="wp-submit" value="WordPress Admin" tabindex="100" />
</form>   
<span><!--<a href="http://adtingo.com/wp-admin/" class="link-logout">WordPress Admin Login</a>--></span><span class="separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
        logged in as <?php echo $_SESSION['Username'];?><span class="separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span><script language="JavaScript">
<!--
						var today = new Date()
						var myMonth=today.getMonth()
						if (myMonth==0) {
						var Month = "january" }
						if (myMonth==1) {
						var Month = "february" }
						if (myMonth==2) {
						var Month = "march" }
						if (myMonth==3) {
						var Month = "april" }
						if (myMonth==4) {

						var Month = "may" }

						if (myMonth==5) {

						var Month = "june" }

						if (myMonth==6) {

						var Month = "july" }

						if (myMonth==7) {

						var Month = "august" }

						if (myMonth==8) {

						var Month = "september" }

						if (myMonth==9) {

						var Month = "october" }

						if (myMonth==10) {

						var Month = "november" }

						if (myMonth==11) {

						var Month = "december" }

						if (today.getDay()==0) {

						var weekDay = "sunday" }

						if (today.getDay()==1) {

						var weekDay = "monday" }

						if (today.getDay()==2) {

						var weekDay = "tuesday" }

						if (today.getDay()==3) {

						var weekDay = "wednesday" }

						if (today.getDay()==4) {

						var weekDay = "thursday" }

						if (today.getDay()==5) {

						var weekDay = "friday" }

						if (today.getDay()==6) {

						var weekDay = "saturday" }

						var weekDate = today.getDate()
						var year = today.getFullYear()

						document.write("" + weekDay + ", " + Month + " " + weekDate + ", "+ year +"")

						// -->

									</script><span class="separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span><a href="logout.php" class="link-logout">log out</a>        </td>
  </tr>
  <tr>
    <td colspan="2" class="nav-bar"><div class="nav-bar">
            <ul id="p7PMnav">
			 <li><a href="manageadmin.php" class="<?php echo $admin;?>">Administrators </a></li>
       
        <li><a href="clientsdetails.php" class="<?php echo $clients;?>">Clients </a></li>
        <li><a href="members.php" class="<?php echo $members;?>">Members</a></li>
        <li><a href="importData.php" class="<?php echo $datalist;?>">Datalists</a></li>
		<li><a href="managearealist.php" class="<?php echo $arealist;?>">Area List</a></li>
		<!--<li><a href="managecat.php" class="<?php echo $catlist;?>">Manage Categories</a></li>-->
       <!--<li><a href="#">Email Templates</a></li>-->
      <li><a href="manage_email_templates.php" class="<?php echo $manageemailtemp;?>">Email Templates</a></li>
      <!-- <li><a   href="manage_Campaigns_list.php" class="<?php echo $CampaignsList;?>">Campaigns</a></li>-->
	    <li><a   href="manage_Campaigns_list2.php" class="<?php echo $CampaignsList;?>">Campaigns</a></li>
	    <li><a  href="manage_campaign.php" class="<?php echo $managecampaign;?>">Approve / Reject Campaigns </a></li><br />
       <!-- <li><a   href="manage_payments.php" class="<?php echo $payments;?>">Payment&nbsp;Details</a></li>-->
		<li><a   href="manage_payments.php" class="<?php echo $payments;?>">Payment&nbsp;Details</a></li>
		<li><a   href="manage_reports.php" class="<?php echo $managereports;?>">Campaign&nbsp;Performance&nbsp;Report</a></li>
		<li><a   href="category_article.php"class="<?php echo $catart;?>">Local Do-Gooders</a></li>
		
  <!--       <li><a href="changepassword.php" class="<?php //echo $changepassword;?>" >Change Password</a></li>-->
      </ul>
    </div></td>
  </tr>
</table><?php }?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="400" align="center" valign="top" class="body-bg padbot15">

