<?php
ob_start(); 
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
	$heading=$RecCampaign_info['heading'];
	$subheading=$RecCampaign_info['sub_heading'];
	$text_content=$RecCampaign_info['text_content'];
	$map_address=$RecCampaign_info['map_address'];
	$map_city=$RecCampaign_info['map_city'];
	$map_state=$RecCampaign_info['map_state'];
	$map_zipcode=$RecCampaign_info['map_zipcode'];
	$phone=$RecCampaign_info['phone'];
	$websiteurl=$RecCampaign_info['websiteurl'];
	$destinationurl=$RecCampaign_info['destination_url'];
	$twitter_link=$RecCampaign_info['twitter_link'];
	$facebook_link=$RecCampaign_info['facebook_link'];
	$main_img=$RecCampaign_info['main_image'];
}
if($RecCampaign_info['template_selection']=="0")
{
	header("location:campaign-information.php?cid=".base64_encode($CampaignID)."");
	exit;
}
$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
if(isset($_POST['step5submit_x_x']))
{
	extract($_POST);
	function clean_url($text)
	{
		$text=strtolower($text);
		$code_entities_match = array('—',' ','--','--','&quot;','!','@','#','$','%','^','&','*','(',')','-','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',',' ','/','*','+','~','`','=','‹');
		$code_entities_replace = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
		$text = str_replace($code_entities_match, $code_entities_replace, $text);
		return $text;
	}
	if($_FILES['main_image']['name']=='' && $main_img=='')
	{
		$image_error="Upload Manin Image";
	}
	else
		$image_error="";
		$post_name1 = str_replace(" ", "-", $_POST["heading"]);
		$post_name2 = str_replace("&", "and", $post_name1);
		$post_name5 = str_replace("'", "", $post_name2);
	  $user_email_check_qry=sprintf("select 1 from wp_posts where post_name='%s'",$object->stripper($post_name5));  
	 $chkresult=$object->ExecuteQuery($user_email_check_qry);
	//$ResInfo=$object->FetchArray($chkresult);
	$rows=$object->NumRows($chkresult);
	$Heading_Error="";
	if($rows>0)
	{
	$Heading_Error="Campaign heading is allready exist. Please enter another heading";
	}
	if($_POST['destinationurl']!='' && $_POST['heading']!='' && $_POST['text_content']!='' && $image_error=='' && $Heading_Error=="")
	{
		/*if($_POST["phone"]!="")
		{
			if(ereg('^[2-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}$', $_POST["phone"]))
				$_SESSION['campaign']['phone']=$_POST["phone"];
			else{
				$phone_error="Inavalid Phone Number ";
				$_SESSION['campaign']['phone']="";
			}
		}*/
		//if(!$phone_error){
		if($_FILES['main_image']['name']!='')
		{
			$filedir="Campaign_images/main_image/";
			$filedir1="Campaign_images/main_image/thumb_280x140/";
			$filedir2="Campaign_images/main_image/thumb_60x60/";
			$filedir3="Campaign_images/main_image/thumb_130x130/";
			$source=$_FILES['main_image']['tmp_name'];	
			$source_name=$_FILES['main_image']['name'];
			$up_flag='y';
			$main_image_lastname=time()."_".$source_name;
			$main_image_lastname=clean_url($main_image_lastname);
			$dest=$filedir.$main_image_lastname;
			$thumbdest="Campaign_images/main_image/thumb_images/".$main_image_lastname;
			$thumbdest1="Campaign_images/main_image/thumb_280x140/".$main_image_lastname;
			$thumbdest2="Campaign_images/main_image/thumb_60x60/".$main_image_lastname;
			$thumbdest3="Campaign_images/main_image/thumb_130x130/".$main_image_lastname;
			move_uploaded_file($source, $dest);
			$imagepath_temporary = $_FILES['main_image']['tmp_name'];
					
			$uploaded_image_size = $_FILES["main_image"]["size"];
			$destpath1 = "Campaign_images/main_image/".$RecCampaign_info['main_image'];
			if($RecCampaign_info['main_image']!="")
			unlink($destpath1); 
			$destpaththumb = "Campaign_images/main_image/thumb_images/".$RecCampaign_info['main_image'];
			if($RecCampaign_info['main_image']!="")
			unlink($destpaththumb);
			$getTemplateSelection=$object->ExecuteQuery("SELECT * FROM `tbl_email_template_content` where Tid=$RecCampaign_info[template_selection]");
			$recTemplateSelection=$object->FetchArray($getTemplateSelection);
			if($recTemplateSelection['template_type']==1)
			{
			list($mainimgwidth1,$mainimgheight1) = getimagesize($dest);
				if($mainimgwidth1>313 && $mainimgheight1>406)
				{
				$imgheight1=406;
				$imgwidth1val=406/$mainimgheight1;
				$imgwidth1=$mainimgwidth1*$imgwidth1val;
				}
				else
				{
				$imgwidth1=$mainimgwidth1;
				$imgheight1=$mainimgheight1;
				}
			/*echo $imgwidth;
			echo $imgheight; exit;*/
				$uploadimage=$object->thumbImage($dest,$thumbdest,$imgwidth1,$imgheight1,$uploaded_image_size);
				$uploadimage2=$object->thumbImage($dest,$thumbdest1,"280","140",$uploaded_image_size);
				$uploadimage3=$object->thumbImage($dest,$thumbdest2,"60","60",$uploaded_image_size);
				$uploadimage3=$object->thumbImage($dest,$thumbdest3,"130","130",$uploaded_image_size);
			}
			elseif($recTemplateSelection['template_type']==2)
			{
			list($mainimgwidth,$mainimgheight) = getimagesize($dest);
				if($mainimgwidth>590 && $mainimgheight>390)
				{
				$imgwidth=590;
				//$imgheight=390;
				$imgheightval=590/$mainimgwidth;
				$imgheight=$mainimgheight*$imgheightval;
				}
				else
				{
				$imgwidth=$mainimgwidth;
				$imgheight=$mainimgheight;
				}
				$uploadimage=$object->thumbImage($dest,$thumbdest,$imgwidth,$imgheight,$uploaded_image_size);
				$uploadimage2=$object->thumbImage($dest,$thumbdest1,"280","140",$uploaded_image_size);
				$uploadimage3=$object->thumbImage($dest,$thumbdest2,"60","60",$uploaded_image_size);
				$uploadimage3=$object->thumbImage($dest,$thumbdest3,"130","130",$uploaded_image_size);
			}
			$_SESSION['campaign']['main_image']=$_FILES['main_image']['name']; 
				 //$main_image_lastname = str_replace(" ", "", $main_image_lastname);
				
			$Insert_main_image_Qry=sprintf("update tbl_campaigns  set main_image='%s' where campaign_id=%d",$object->stripper(addslashes($main_image_lastname)),$object->stripper($CampaignID));  
			$Insert_main_image_Res=$object->ExecuteQuery($Insert_main_image_Qry); 
		}
		if($_FILES['clickble_image']['name']!='')
		{
			$filedir="Campaign_images/clickble_image/";
			$source=$_FILES['clickble_image']['tmp_name'];	
			$source_name=$_FILES['clickble_image']['name'];
			$up_flag='y';
			$clickble_image_lastname=time()."_".$source_name;
			$clickble_image_lastname=clean_url($clickble_image_lastname);
			$dest=$filedir.$clickble_image_lastname;
			$thumbdest="Campaign_images/clickble_image/thumb_images/".$clickble_image_lastname;
			move_uploaded_file($source, $dest);
			$imagepath_temporary = $_FILES['clickble_image']['tmp_name'];
			list($width,$height,$type) = getimagesize($dest);
			$uploaded_image_size = $_FILES["clickble_image"]["size"];
			$uploadimage=$object->thumbImage($dest,$thumbdest,"130","130",$uploaded_image_size);
			$_SESSION['campaign']['clickble_image']=$_FILES['clickble_image']['name']; 
			$destpath2 = "Campaign_images/clickble_image/".$RecCampaign_info['clickble_image'];
			if($RecCampaign_info['clickble_image']!="")
			unlink($destpath2); 
			$destpaththumb = "Campaign_images/clickble_image/thumb_images/".$RecCampaign_info['clickble_image'];
			if($RecCampaign_info['clickble_image']!="")
			unlink($destpaththumb); 
			// $clickble_image_lastname = str_replace(" ", "", $clickble_image_lastname);
			$Insert_Clickble_image_Qry=sprintf("update tbl_campaigns  set clickble_image='%s' where campaign_id=%d",$object->stripper($clickble_image_lastname),$object->stripper($CampaignID));  
			$Insert_Clickble_image_Res=$object->ExecuteQuery($Insert_Clickble_image_Qry);  
		}
		if($Num_cols >0) 
		{
			$text_content=$_POST["text_content"];
					//echo $text_content;
			foreach ($sq_html_ent_table as $key => $value) {
	        	$text_content=str_replace($key,$value,$text_content);
			}
			$Insert_campaign_info_qry=sprintf("update tbl_campaigns  set destination_url='%s',  	heading='%s',sub_heading='%s',text_content='%s',contact_info='%s',twitter_link='%s',facebook_link='%s', lat='%s', lng='%s', map_address='%s', map_city='%s', map_state='%s', map_zipcode='%s', phone='%s', websiteurl='%s' where campaign_id=%d",$object->stripper($_POST["destinationurl"]),$object->stripper($_POST["heading"]),$object->stripper($_POST["subheading"]),$object->stripper(addslashes($text_content)),$object->stripper($_POST["contact_info"]),$object->stripper($_POST["twitter_link"]),$object->stripper($_POST["facebook_link"]),$object->stripper($_POST["main1"]),$object->stripper($_POST["main2"]),$object->stripper($_POST["map_address"]),$object->stripper($_POST["map_city"]),$object->stripper($_POST["map_state"]),$object->stripper($_POST["map_zipcode"]),$object->stripper($_POST["phone"]),$object->stripper($_POST["websiteurl"]),$object->stripper($CampaignID)); 
			
			//echo $Insert_campaign_info_qry;
			$Insert_campaign_info_Res=$object->ExecuteQuery($Insert_campaign_info_qry);  
			if($Insert_campaign_info_Res)
			{
				unset($_SESSION['campaign']);
				header("location:template-preview.php?cid=".base64_encode($CampaignID)."");
				exit;
			}
			}
		//}
		}
		else
		{
			$url_error="";
			$heading_error="";
			$content_error="";
			
			if($_POST["destinationurl"]=="")
			{
				$url_error="Destination URL Required";
				$_SESSION['campaign']['destinationurl']="";
			}
			else
				$_SESSION['campaign']['destinationurl']=$_POST["destinationurl"];
			if($_POST["heading"]=="")
			{
				$heading_error="Heading Required";
				$_SESSION['campaign']['heading']="";
			}
			else if(strlen($_POST["heading"])>30)
			{
				$heading_error="Heading should not be more than 30 chars";
				$_SESSION['campaign']['heading']="";
			}
			else if($_POST["heading"]!="")
			{		
			$heading_error=$Heading_Error;
			}
			else
				$_SESSION['campaign']['heading']=$_POST["heading"];
			if($_POST["text_content"]=="")
			{
				$content_error="Text content Required";
				$_SESSION['campaign']['text_content']="";
			}
			else
				$_SESSION['campaign']['text_content']=$_POST["text_content"];
			
		}  
		
}	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAba8Tt0uYKnkrkb0C895m_hR-wKhkR8R59YQNO0x7Gm_Fhro2LBRe9W5F95JIvNVJ5JDxEBWLUK16uQ" type="text/javascript"></script>-->
 <script 	33.7602 	-118.115src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAba8Tt0uYKnkrkb0C895m_hT6hgW3SnPsym-BX2K9uBwQwohXrxSY1owwZMdUjzgh-8_CAf0T0RJ2Mg" type="text/javascript"></script>

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
function lat_lng()
{
	//alert("Aa");
	//var ad=document.submitform5.contact_info.value;
	var d1=document.submitform5.map_address.value;
	var d2=document.submitform5.map_city.value;
	var d3=document.submitform5.map_state.value;
	//var mytool_array=ad.split(",");
	//var addr=mytool_array[0]+","+mytool_array[1]+","+mytool_array[2];
	var addr=d1+','+d2+','+d3;
	showAddress(addr);
}
function showAddress(address) 
{
	//alert(address);
	if (geocoder) {
	//alert(address);
		geocoder.getLatLng(address,
		function(point) {
			var msg = "Latitude: "+point.lat()+"<br>"+"Longitude: "+point.lng();
			//alert(msg);
			document.submitform5.main1.value=point.lat();
			document.submitform5.main2.value=point.lng();
			//document.submitform5.submit();
		}
		);
	}
}
</script>
<script language="javascript" type="text/javascript">
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
function checkvalue()
		  {
		  	var st=document.getElementById("heading").value;
			var text=st.length;
			
			if(text>30)
			{
				document.getElementById("headerchars").style.display='block';
				//alert("Your have exceddmoremare than 140 characters");
			}
			else if(text<30)
			{
				document.getElementById("headerchars").style.display='none';
			}
		
           }
  function checksubheadingval()
  {
	var st=document.getElementById("subheading").value;
	var text=st.length;
	
	if(text>60)
	{
		document.getElementById("subhead").style.display='block';
		//alert("Your have exceddmoremare than 140 characters");
	}
	else if(text<60)
	{
		document.getElementById("subhead").style.display='none';
	}
	
  }
  
</script>
 <script language="javascript" type="text/javascript">
 function chkpagesubmit(Val,cid)
 {
 //document.submitform5.action = "view_price.php";
 lat_lng()
 document.submitform5.action="template-preview.php?Val=Val&cid=cid";
 }
 </script>
 <script>
//var wordLimit = 10;
var holdText;
var disabledBox = false;

function countEm(wordLimit,txt,track){
	var text1 = document.getElementById(txt).value;
	var numberOfWords = doCount(text1);
 	if(numberOfWords == wordLimit) {
  		holdText = text1;
 	}//end if
	document.getElementById(track).value = wordLimit - numberOfWords;
	if(numberOfWords >= wordLimit)
		disabledBox = true;
	else
		disabledBox = false;
}//end function

function doCount(textParam){
	//replace all instances of one-or-more spaces with a single space
	var text2 = textParam.replace(/\s+/g, ' ');
	//trim leading and tailing spaces
	while(text2.substring(0, 1) == ' ')
		text2 = text2.substring(1);
	while(text2.substring(text2.length-2, text2.length-1) == ' ')
		text2 = text2.substring(0,text2.length-1);
	var text3 = text2.split(' ');
	return text3.length;
}//end function

function maybeReset(wordLimit,txt){
	if(disabledBox){
		var currText = document.getElementById(txt).value;
		var newLength = doCount(currText);
		//prevent user from adding words, but not taking them away
		if(newLength > wordLimit) {
			document.getElementById(txt).value = holdText;
			alert("Word limit exceded");
		}//end if
	}//end if
}//end function
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20346514-1']);
  _gaq.push(['_setDomainName', '.adtingo.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  <head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE ?>Campaign Information</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<?php include "includes/google_analytic.php";?>
</head>
<body onLoad="load()" onUnload="GUnload()" >
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Campaign Information</h2><img src="images/step3.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="submitform5" id="submitform5" enctype="multipart/form-data"  >                              
            <div class="grey-box">
               <h3 class="grad-box">Campaign Creation </h3> 
              <dl class="form">
                
                <dt>Heading</dt>
                <dd><input type="text" name="heading" id="heading" value="<?php echo $heading ;?>"  onchange="return checkvalue(document.submitform5.heading.value);" /><br /><input type="hidden" name="main1" id="main1" value="<?php echo $main1 ;?>">
<input type="hidden" name="main2" id="main2" value="<?php echo $main2 ;?>"><div id="map" style="width: 500px; height: 400px; display:none;"></div>
				<div id="headerchars" style="display:none;" class="errer-mess2">You have exceeded more than 30 characters</div> <small>(30 Characters Max)</small>
				<br/>
				<span class="red">
		     <?php if($heading_error!="") echo $heading_error;?>
             </span>
				</dd> <input type="hidden" name="errormess" id="errormess" value="" />
                <dt>Sub Heading</dt>
                <dd><input type="text" name="subheading" id="subheading" value="<?php echo $subheading ;?>" onkeypress="return checksubheadingval();"  /><br /><div id="subhead" style="display:none;" class="errer-mess2">You have exceeded more than 60 characters</div> <small>(60 Characters Max)</small></dd> 
                <dt>Text Content</dt>
                <dd><textarea name="text_content" id="text_content" cols="" rows="5" onkeydown="countEm(250,'text_content','myTracker');" onkeyup="maybeReset(250,'text_content');"><?php echo $text_content ;?></textarea><input type='hidden' name='myTracker' id="myTracker" />
				<br /> <small>(250 word Max)</small>
				<br/>
				<span class="red">
		     <?php if($content_error!="") echo $content_error;?>
             </span>
				</dd> 
               	 <dt>Street Address</dt>
                <dd><input type="text" name="map_address" id="map_address" value="<?php echo $map_address;?>" /></dd> 
				<dt>City</dt>
                <dd><input type="text" name="map_city" id="map_city" value="<?php echo $map_city ;?>" /><br /></dd> 
				 <dt>State</dt>
                <dd><input type="text" name="map_state" id="map_state" onblur="lat_lng()" value="<?php echo $map_state ;?>" /></dd> 
				<dt>Zipcode</dt>
                <dd><input type="text" name="map_zipcode" id="map_zipcode" value="<?php echo $map_zipcode;?>" /></dd> 
			 <dt>Phone Number</dt>
                <dd><input type="text" name="phone" id="phone" value="<?php echo $phone;?>" /><br /><span class="red">
		     <?php if($phone_error!="") echo $phone_error;?>
             </span></dd>
			<dt>Website URL</dt>
                <dd><input type="text" name="websiteurl" id="websiteurl" value="<?php echo $websiteurl;?>" /><br /><small>example: your website name</small></dd> 
                <dt>Destination URL</dt>
                <dd><input type="text" name="destinationurl" id="destinationurl" value="<?php echo $destinationurl ;?>"  /><br /> <small>example: http://www.yourwebsite.com/</small><br/>
				<span class="red">
		     <?php if($url_error!="") echo $url_error;?>
             </span>
				</dd> 
				<dt>Upload Main Clickable Image</dt>
                <dd><input type="file" name="main_image"  id="main_image" /><br /> <small>(Varies by template choosen, 590X600 or 313X406)</small><br />
				<span class="red">
		     <?php if($image_error!="") echo $image_error;?>
             </span>
				<br/>
				<?php if($RecCampaign_info['main_image']<>''){ ?>
				<img src="Campaign_images/main_image/thumb_images/<?php echo $RecCampaign_info['main_image']; ?>" width="100" height="100" />
				<?php }?>
				</dd> 
                 <dt>Upload Inset Clickable Image</dt>
                <dd><input type="file" name="clickble_image"  id="clickble_image" /><br /> <small>(130X130)</small>
				<br/>
				<?php if($RecCampaign_info['clickble_image']<>''){ ?>
				<img src="Campaign_images/clickble_image/thumb_images/<?php echo $RecCampaign_info['clickble_image']; ?>" width="100" height="100" />
				<?php }?>
				</dd>
                <dt>Link to Twitter Page</dt>
                <dd><input type="text" name="twitter_link" id="twitter_link" value="<?php echo $twitter_link ;?>" /></dd> 
                <dt>Link to Facebook Page</dt>
                <dd><input type="text" name="facebook_link" id="facebook_link"  value="<?php echo $facebook_link ;?>"  /></dd> 
              </dl>
             </div>

          <a href="campaign-information.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" name="step5submit_x" id="step5submit_x" />&nbsp;&nbsp;<input  src="images/preview-bt.gif"  type="image" name="step5submit_x" id="step5submit_x" /></a>

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
