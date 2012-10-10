<?php
ob_start(); 
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
if($RecCampaign_info['template_selection']=="0")
{
	header("location:campaign-information.php?cid=".base64_encode($CampaignID)."");
	exit;
}

$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
if(isset($_POST['step5submit_x_x']))
{
function clean_url($text)
		{
		$text=strtolower($text);
		$code_entities_match = array('—',' ','--','--','&quot;','!','@','#','$','%','^','&','*','(',')','-','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',',' ','/','*','+','~','`','=','‹');
		$code_entities_replace = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
		$text = str_replace($code_entities_match, $code_entities_replace, $text);
		return $text;
		}

	if($_POST['destinationurl']!='' && $_POST['heading']!='' && $_POST['text_content']!='')
		{
		
		if($_FILES['main_image']['name']!='')
		{
		
		
		
				$filedir="Campaign_images/main_image/";
				$source=$_FILES['main_image']['tmp_name'];	
				$source_name=$_FILES['main_image']['name'];
				$up_flag='y';
				$main_image_lastname=time()."_".$source_name;
				 $main_image_lastname=clean_url($main_image_lastname);
				$dest=$filedir.$main_image_lastname;
				$thumbdest="Campaign_images/main_image/thumb_images/".$main_image_lastname;
				move_uploaded_file($source, $dest);
				$imagepath_temporary = $_FILES['main_image']['tmp_name'];
				list($width,$height,$type) = getimagesize($dest);
				$uploaded_image_size = $_FILES["main_image"]["size"];
				$destpath1 = "Campaign_images/main_image/".$RecCampaign_info['main_image'];
				unlink($destpath1); 
				$destpaththumb = "Campaign_images/main_image/thumb_images/".$RecCampaign_info['main_image'];
				unlink($destpaththumb);
				if($RecCampaign_info['template_selection']==1)
				$uploadimage=$object->thumbImage($dest,$thumbdest,"313","406",$uploaded_image_size);
				else
				$uploadimage=$object->thumbImage($dest,$thumbdest,"590","390",$uploaded_image_size);
				
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
				 unlink($destpath2); 
				  $destpaththumb = "Campaign_images/clickble_image/thumb_images/".$RecCampaign_info['clickble_image'];
				 unlink($destpaththumb); 
				// $clickble_image_lastname = str_replace(" ", "", $clickble_image_lastname);
				

				  $Insert_Clickble_image_Qry=sprintf("update tbl_campaigns  set clickble_image='%s' where campaign_id=%d",$object->stripper($clickble_image_lastname),$object->stripper($CampaignID));  
				 $Insert_Clickble_image_Res=$object->ExecuteQuery($Insert_Clickble_image_Qry);  
				
		}
		
		
		if($Num_cols >0) 
			{
			   $Insert_campaign_info_qry=sprintf("update tbl_campaigns  set destination_url='%s',  	heading='%s',sub_heading='%s',text_content='%s',contact_info='%s',twitter_link='%s',facebook_link='%s', lat='%s', lng='%s' where campaign_id=%d",$object->stripper($_POST["destinationurl"]),$object->stripper(addslashes($_POST["heading"])),$object->stripper(addslashes($_POST["subheading"])),$object->stripper(addslashes($_POST["text_content"])),$object->stripper($_POST["contact_info"]),$object->stripper($_POST["twitter_link"]),$object->stripper($_POST["facebook_link"]),$object->stripper($_POST["main1"]),$object->stripper($_POST["main2"]),$object->stripper($CampaignID)); 
			$Insert_campaign_info_Res=$object->ExecuteQuery($Insert_campaign_info_qry);  
			if($Insert_campaign_info_Res)
			{
				unset($_SESSION['campaign']);
				header("location:template-preview.php?cid=".base64_encode($CampaignID)."");
				exit;
			}
			}
		
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
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAba8Tt0uYKnkrkb0C895m_hR-wKhkR8R59YQNO0x7Gm_Fhro2LBRe9W5F95JIvNVJ5JDxEBWLUK16uQ" type="text/javascript"></script>
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
	var ad=document.submitform5.contact_info.value;
	var mytool_array=ad.split(",");
	var addr=mytool_array[0]+","+mytool_array[1]+","+mytool_array[2];
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
 document.submitform5.action="template-preview.php?Val=Val&cid=cid";
 }
 </script>
  <head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Account Settings | Campaign Monitor</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
</head>
<body onLoad="load()" onUnload="GUnload()" >
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Campaign Information</h2><img src="images/step3.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="submitform5" id="submitform5" enctype="multipart/form-data" >                              
            <div class="grey-box">
               <h3 class="grad-box">Campaign Creation </h3> 
              <dl class="form">
                
                <dt>Heading</dt>
                <dd><input type="text" name="heading" id="heading" value="<?php if($RecCampaign_info['heading']!="") echo $RecCampaign_info['heading'] ;?>"  onkeypress="return checkvalue();" /><br /><input type="hidden" name="main1" id="main1">
<input type="hidden" name="main2" id="main2"><div id="map" style="width: 500px; height: 400px; display:none;"></div>
				<div id="headerchars" style="display:none;" class="errer-mess2">You have exceeded more than 30 characters</div> <small>(30 Characters Max)</small>
				<br/>
				<span class="red">
		     <?php if($heading_error!="") echo $heading_error;?>
             </span>
				</dd> 
                <dt>Sub Heading</dt>
                <dd><input type="text" name="subheading" id="subheading" value="<?php if($RecCampaign_info['sub_heading']!="") echo $RecCampaign_info['sub_heading'] ;?>" onkeypress="return checksubheadingval();"  /><br /><div id="subhead" style="display:none;" class="errer-mess2">You have exceeded more than 60 characters</div> <small>(60 Characters Max)</small></dd> 
                <dt>Text content</dt>
                <dd><textarea name="text_content" id="text_content" cols="" rows="5"><?php if($RecCampaign_info['text_content']!="") echo $RecCampaign_info['text_content'] ;?></textarea><br /> <small>(250 word Max)</small>
				<br/>
				<span class="red">
		     <?php if($content_error!="") echo $content_error;?>
             </span>
				</dd> 
                <dt>Coantact Info</dt>
                <dd><textarea name="contact_info" id="contact_info" cols="" rows="5" onblur="lat_lng()"><?php if($RecCampaign_info['contact_info']!="") echo $RecCampaign_info['contact_info'] ;?></textarea><br /> <small>(Physical Address, Webiste URL)</small></dd> 
                <dt>Destination URL</dt>
                <dd><input type="text" name="destinationurl" id="destinationurl" value="<?php if($RecCampaign_info['destination_url']!="") echo $RecCampaign_info['destination_url'] ;?>"  /><br /> <small>example: http://www.yourwebsite.com/</small><br/>
				<span class="red">
		     <?php if($url_error!="") echo $url_error;?>
             </span>
				</dd> 
				<dt>Upload Main Clickable Image</dt>
                <dd><input type="file" name="main_image"  id="main_image" /><br /> <small>(Varies by template choosen, 590X600 or 313X406)</small>
				<br/>
				<img src="Campaign_images/main_image/thumb_images/<?php echo $RecCampaign_info['main_image']; ?>" width="100" height="100" />
				</dd> 
                 <dt>Upload Inset Clickable Image</dt>
                <dd><input type="file" name="clickble_image"  id="clickble_image" /><br /> <small>(130X130)</small>
				<br/>
				<img src="Campaign_images/clickble_image/thumb_images/<?php echo $RecCampaign_info['clickble_image']; ?>" width="100" height="100" />
				</dd>
                <dt>Link to Twitter Page</dt>
                <dd><input type="text" name="twitter_link" id="twitter_link" value="<?php if($RecCampaign_info['twitter_link']!="") echo $RecCampaign_info['twitter_link'] ;?>" /></dd> 
                <dt>Link to Facebook Page</dt>
                <dd><input type="text" name="facebook_link" id="facebook_link"  value="<?php if($RecCampaign_info['facebook_link']!="") echo $RecCampaign_info['facebook_link'] ;?>"  /></dd> 
              </dl>
             </div>

          <a href="campaign-information.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" name="step5submit_x" id="step5submit_x" />&nbsp;&nbsp;<input   src="images/preview-bt.gif"  type="image" name="step5submit_x" id="step5submit_x" /></a>

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
