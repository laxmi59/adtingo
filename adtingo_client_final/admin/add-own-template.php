<?php
$nav=12;
include('includes/header.php'); 
include_once('includes/values.php'); 
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
	$main1=$RecCampaign_info['lat'];
	$main2=$RecCampaign_info['lng'];
	$main_img=$RecCampaign_info['main_image'];
}
if($RecCampaign_info['template_selection']=="0" || $RecCampaign_info['template_selection']=="")
{
	header("location:campaign-information.php?cid=".base64_encode($CampaignID)."");
	exit;
}

//$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
//print_r($_POST);
if($_POST['submitproduct'] || $_POST['submitproduct1'])
{
	extract($_POST);
	//print_r($_POST);
	$headering_error_val="";
	$subcontent_error_val="";
	$content_error_val="";
	if(strlen($_POST['heading'])>30)
		$headering_error_val="invalid";
	else
		$headering_error_val="";
	
	
	
	if($_FILES['main_image']['name']=="" && $main_img == ""){
		$image_error_val="Upload Main Image";
	}
	else
		$image_error_val="";
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
		
	if($_POST['destinationurl']!='' && $_POST['heading']!='' && $headering_error_val=="" &&$subcontent_error_val=="" && $_POST['text_content']!='' && $image_error_val=='' && $Heading_Error=='' )
	{
		
		function clean_url($text)
		{
			$text=strtolower($text);
			$code_entities_match = array('—',' ','--','--','&quot;','!','@','#','$','%','^','&','*','(',')','-','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',',' ','/','*','+','~','`','=','‹');
			$code_entities_replace = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
			$text = str_replace($code_entities_match, $code_entities_replace, $text);
			return $text;
		}
		
		if($_FILES['main_image']['name']!='')
		{
			$filedir="../Campaign_images/main_image/";
			$filedir1="Campaign_images/main_image/thumb_280x140/";
			$filedir2="Campaign_images/main_image/thumb_60x60/";
			$filedir3="Campaign_images/main_image/thumb_130x130/";
			$source=$_FILES['main_image']['tmp_name'];	
			$source_name=$_FILES['main_image']['name'];
			$up_flag='y';
			$main_image_lastname=time()."_".$source_name;
			$main_image_lastname=clean_url($main_image_lastname);
			$dest=$filedir.$main_image_lastname;
		  	$thumbdest="../Campaign_images/main_image/thumb_images/".$main_image_lastname; 
			$thumbdest1="../Campaign_images/main_image/thumb_280x140/".$main_image_lastname;
			$thumbdest2="../Campaign_images/main_image/thumb_60x60/".$main_image_lastname;
			$thumbdest3="../Campaign_images/main_image/thumb_130x130/".$main_image_lastname;
			move_uploaded_file($source, $dest);
			$imagepath_temporary = $_FILES['main_image']['tmp_name'];
			
			$uploaded_image_size = $_FILES["main_image"]["size"];
			$destpath1 = "../Campaign_images/main_image/".$RecCampaign_info['main_image'];
			if($RecCampaign_info['main_image']!="")
			unlink($destpath1); 
			$destpaththumb = "../Campaign_images/main_image/thumb_images/".$RecCampaign_info['main_image'];
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
				$uploadimage=$object->thumbImage($dest,$thumbdest,$imgwidth1,$imgheight1,$uploaded_image_size);
				$uploadimage1=$object->thumbImage($dest,$thumbdest1,"280","140",$uploaded_image_size);
				$uploadimage2=$object->thumbImage($dest,$thumbdest2,"60","60",$uploaded_image_size);
				$uploadimage3=$object->thumbImage($dest,$thumbdest3,"130","130",$uploaded_image_size);
			
			}
			elseif($recTemplateSelection['template_type']==2)
			{
			list($mainimgwidth,$mainimgheight) = getimagesize($dest);
				if($mainimgwidth>590 && $mainimgheight>390)
				{
				$imgwidth=590;
				$imgheightval=590/$mainimgwidth;
				$imgheight=$mainimgheight*$imgheightval;
				}
				else
				{
				$imgwidth=$mainimgwidth;
				$imgheight=$mainimgheight;
				}
			
				$uploadimage=$object->thumbImage($dest,$thumbdest,$imgwidth,$imgheight,$uploaded_image_size);
				$uploadimage1=$object->thumbImage($dest,$thumbdest1,"280","140",$uploaded_image_size);
				$uploadimage2=$object->thumbImage($dest,$thumbdest2,"60","60",$uploaded_image_size);
				$uploadimage3=$object->thumbImage($dest,$thumbdest3,"130","130",$uploaded_image_size);
			
			}
			//echo $uploadimage;exit;
			$_SESSION['campaign']['main_image']=$_FILES['main_image']['name']; 
			//$main_image_lastname = str_replace(" ", "", $main_image_lastname);
			
			$Insert_main_image_Qry=sprintf("update tbl_campaigns  set main_image='%s' where campaign_id=%d",$object->stripper(addslashes($main_image_lastname)),$object->stripper($CampaignID));  
			$Insert_main_image_Res=$object->ExecuteQuery($Insert_main_image_Qry); 
		}
	
		if($_FILES['clickble_image']['name']!='')
		{
			$filedir="../Campaign_images/clickble_image/";
			$source=$_FILES['clickble_image']['tmp_name'];	
			$source_name=$_FILES['clickble_image']['name'];
			$up_flag='y';
			$clickble_image_lastname=time()."_".$source_name;
			$clickble_image_lastname=clean_url($clickble_image_lastname);
			$dest=$filedir.$clickble_image_lastname;
			$thumbdest="../Campaign_images/clickble_image/thumb_images/".$clickble_image_lastname;
			move_uploaded_file($source, $dest);
			$imagepath_temporary = $_FILES['clickble_image']['tmp_name'];
			list($width,$height,$type) = getimagesize($dest);
			$uploaded_image_size = $_FILES["clickble_image"]["size"];
			$uploadimage=$object->thumbImage($dest,$thumbdest,"130","130",$uploaded_image_size);
			$_SESSION['campaign']['clickble_image']=$_FILES['clickble_image']['name']; 
			$destpath2 = "../Campaign_images/clickble_image/".$RecCampaign_info['clickble_image'];
			if($RecCampaign_info['clickble_image']!="")
			unlink($destpath2); 
			$destpaththumb = "../Campaign_images/clickble_image/thumb_images/".$RecCampaign_info['clickble_image'];
			if($RecCampaign_info['clickble_image']!="")
			unlink($destpaththumb); 
			// $clickble_image_lastname = str_replace(" ", "", $clickble_image_lastname);
				
			$Insert_Clickble_image_Qry=sprintf("update tbl_campaigns  set clickble_image='%s' where campaign_id=%d",$object->stripper($clickble_image_lastname),$object->stripper($CampaignID));  
			$Insert_Clickble_image_Res=$object->ExecuteQuery($Insert_Clickble_image_Qry);  
			
		}
		if($Num_cols >0) 
		{
		    foreach ($sq_html_ent_table as $key => $value) {
	        	$text_content=str_replace($key,$value,$text_content);
			}

			//$text_content=str_replace("â€™","'",$_POST["text_content"]);
			
		   $Insert_campaign_info_qry=sprintf("update tbl_campaigns  set destination_url='%s', heading='%s', sub_heading='%s', text_content='%s',contact_info='%s',twitter_link='%s',facebook_link='%s', lat='%s', lng='%s', map_address='%s', map_city='%s', map_state='%s', map_zipcode='%s', phone='%s', websiteurl='%s' where campaign_id=%d",$object->stripper($_POST["destinationurl"]),$object->stripper($_POST["heading"]),$object->stripper($_POST["subheading"]),$object->stripper($text_content),$object->stripper($_POST["contact_info"]),$object->stripper($_POST["twitter_link"]),$object->stripper($_POST["facebook_link"]),$object->stripper($_POST["main1"]),$object->stripper($_POST["main2"]),$object->stripper($_POST["map_address"]),$object->stripper($_POST["map_city"]),$object->stripper($_POST["map_state"]),$object->stripper($_POST["map_zipcode"]),$object->stripper($_POST["phone"]),$object->stripper($_POST["websiteurl"]),$object->stripper($CampaignID));  
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
		$address_error="";
		$city_error="";
		$state_error="";
		$zipcode_error="";
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
				$heading_error="Heading should be below 30 chars";
			}
		
		else if($_POST["heading"]!="")
			{		
			$heading_error=$Heading_Error;
			}
		else
			$_SESSION['campaign']['heading']=$_POST["heading"];
		if($_POST["subheading"]!="")
		{
			/*if(strlen($_POST["subheading"])>60)
			{
				$subheading_error="Sub heading should be below 60 chars";
			}*/
		}
		else
			$_SESSION['campaign']['subheading']=$_POST["subheading"];
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
<script type="text/javascript">
    var _csv = {};
    _csv['action_target'] = 'listing_profile';
    _csv['listing_id'] = '10100230';
    _csv['publisher'] = '0905768917';
    _csv['reference_id'] = '1';
    _csv['placement'] = 'home';
   
</script>
<script type="text/javascript" src="http://images.citysearch.net/assets/pfp/scripts/tracker.js"></script><noscript>
    <img src='http://api.citysearch.com/tracker/imp?action_target=listing_profile&listing_id=10100230&publisher=0905768917&reference_id=10100230&
    placement=posting' width='1' height='1' alt='' />
</noscript>
<script language="javascript" type="text/javascript">

function checkvalue()
		  {
		 
		  	var st=document.getElementById("heading").value;
			var text=st.length;
			
			if(text>30)
			{
				document.getElementById("headerchars").style.display='block';
				//alert("Your have exceddmoremare than 140 characters");
				document.getElementById("headerror").style.display='none';
				
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
  function validatetestcontent()
  {
	var st=document.getElementById("text_content").value;
	var text=st.length;
	
	if(text>250)
	{
		document.getElementById("test_content").style.display='block';
		//alert("Your have exceddmoremare than 140 characters");
		document.getElementById("contenterror").style.display='none';
	}
	else if(text<=250)
	{
		document.getElementById("test_content").style.display='none';
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
	//alert(document.submitform5.map_state.value);
	//var ad=document.submitform5.contact_info.value;
	var d1=document.submitform5.map_address.value;
	var d2=document.submitform5.map_city.value;
	var d3=document.submitform5.map_state.value;
	//var mytool_array=ad.split(",");
	//var addr=mytool_array[0]+","+mytool_array[1]+","+mytool_array[2];
	var addr=d1+','+d2+','+d3;
	//alert(addr);
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
			document.submitform5.submitproduct1.value="submit";
			document.submitform5.submit();
		}
		);
	}
}
</script>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
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
		<form  method="post" name="submitform5" id="submitform5" enctype="multipart/form-data"  >
		<input type="hidden" name="main1" id="main1" value="<?php echo $main1 ;?>">
<input type="hidden" name="main2" id="main2" value="<?php echo $main2 ;?>"><div id="map" style="width: 500px; height: 400px; display:none;"></div>


		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td align="right">&nbsp;</td>
			</tr>
			<tr>
			  <td height="28" align="left" class="form-headings"><?php echo $title;?> </td>
			</tr>
			
			<tr>
			  <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
				<thead>
				  <tr>
					<td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
						<td height="30" align="left"><strong>Heading</strong></td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="text" name="heading" class="textfill2" id="heading" value="<?php if($heading<>'Array') echo stripslashes($heading) ; else echo '';?>" onkeypress="return checkvalue();" />
							  <br />
							  <div id="headerchars" style="display:none;" class="red-normal" align="left">You have exceeded more than 30 characters</div>							</td>
						  </tr>
						   <?php if($heading_error!="") {?>
					   <tr><td  align="left"><span class="red-normal" id="headerror">
		  <?php  echo $heading_error;?>
		</span></td></tr><?php } ?>
						  <tr>
							<td align="left"><span class="small-text">(30 Characters Max)</span></td>
						  </tr>
						</table></td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
						</tr>
					  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Sub Heading</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="text" name="subheading" class="textfill2" id="subheading" value="<?php if($subheading <>'Array') echo stripslashes($subheading) ;else echo '';?>" onkeypress="return checksubheadingval();"  />
							<br /><div id="subhead" style="display:none;" class="red-normal">You have exceeded more than 60 characters</div></td>
						  </tr>
						  <?php if($subheading_error!="") {?>
					   <tr><td  align="left"><span class="red-normal" id="subheaderror">
		  <?php  echo $subheading_error;?>
		</span></td></tr><?php } ?>
						  <tr>
							<td align="left"><span class="small-text">(60 Characters Max)</span></td>
						  </tr>
						</table></td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
					  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Text Content</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left">
							<textarea name="text_content" id="text_content" cols="45" rows="5" class="w-238" onkeydown="countEm(250,'text_content','myTracker');" onkeyup="maybeReset(250,'text_content');"><?php if($text_content<>'Array') echo stripslashes($text_content); else echo '';?></textarea><input type='hidden' name='myTracker' id="myTracker" /><br /><div id="test_content" style="display:none;" class="red-normal">You have exceeded more than 250 characters</div></td>
						  </tr>
						  <tr>
							<td align="left"><span class="small-text">(250 Word Max)</span></td>
						  </tr>
							<?php if($content_error!="") {?>
					   <tr><td colspan="2" align="left"><span class="red-normal" id="contenterror">
		  <?php  echo $content_error;?>
		</span></td></tr><?php } ?>
						</table>                                </td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
					  
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
					  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Street Address</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="text" class="textfill2" name="map_address" id="map_address" value="<?php if($map_address<>'Array') echo stripslashes($map_address); else echo '';?>"/></td>
						  </tr>
						  
						</table></td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
										  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>City</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="text" class="textfill2" name="map_city" id="map_city" value="<?php if($map_city<>'Array') echo stripslashes($map_city) ; echo '';?>"/></td>
						  </tr>
						  
						</table></td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
					   <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>State</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="text" class="textfill2" name="map_state" id="map_state" value="<?php if($map_state<>'Array') echo stripslashes($map_state) ; else '';?>" /></td>
						  </tr>
						  
						</table></td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
					  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Zipcode</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="text" class="textfill2" name="map_zipcode" id="map_zipcode" value="<?php if($map_zipcode<>'Array') echo $map_zipcode ;else echo '';?>"/></td>
						  </tr>
						  
						</table></td>
					  </tr>
					   <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Phone Number</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="text" class="textfill2" name="phone" id="phone" value="<?php if($phone<>'Array') echo $phone; else echo '';?>"/></td>
						  </tr>
						  <?php if($phone_error!="") {?>
					   <tr><td colspan="2" align="left" ><span class="red-normal">
		  <?php  echo $phone_error;?>
		</span></td></tr><?php } ?>
						</table></td>
					  </tr>
					   <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Website URL</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="text" class="textfill2" name="websiteurl" id="websiteurl" value="<?php if($websiteurl<>'Array') echo $websiteurl ;else echo '';?>"/></td>
						  </tr>
						  
						</table></td>
					  </tr>
					  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Destination URL</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input name="destinationurl" type="text" class="textfill2" id="destinationurl" value="<?php if($sestinationurl<>'Array') echo $destinationurl ;else echo '';?>" /></td>
						  </tr>
						  <tr>
							<td align="left"><span class="small-text">example: http://www.yourwebsite.com/</span></td>
						  </tr>
						   <?php if($url_error!="") {?>
					   <tr><td colspan="2" align="left" ><span class="red-normal">
		  <?php  echo $url_error;?>
		</span></td></tr><?php } ?>
						</table></td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
					  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Upload Main Clickable Image</strong></dt>
						</dl>                                </td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							  <td align="left"><input type="file" id="main_image" name="main_image" /></td>
							</tr>
							<tr>
							  <td align="left"><span class="small-text">(Varies by template choosen, 590X600 or 313X406)  </span></td>
							</tr>
							<?php if($image_error_val!="") {?>
					   <tr><td colspan="2" align="left" ><span class="red-normal">
		  <?php  echo $image_error_val;?>
		</span></td></tr><?php } ?>
							
							<tr>
							  <td align="left">
							  <?php if($RecCampaign_info['main_image']<>''){ ?>
							  <img src="http://clients.adtingo.com/Campaign_images/main_image/thumb_images/<?php echo $RecCampaign_info['main_image']; ?>" width="100" height="100" /><?php }?></td>
							</tr>
						  </table></td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
					  <tr>
						<td height="30" align="left"><strong>Upload Inset Clickable Image</strong></td>
						<td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"><input type="file" id="clickble_image" name="clickble_image" /></td>
						  </tr>
						  <tr>
							<td align="left"><span class="small-text">(130X130) </span></td>
						  </tr>
						  <tr>
							<td align="left">
							<?php if($RecCampaign_info['clickble_image']<>''){ ?>
							<img src="http://clients.adtingo.com/Campaign_images/clickble_image/thumb_images/<?php echo $RecCampaign_info['clickble_image']; ?>" width="100" height="100" />
							<?php }?>
							</td>
						  </tr>
						</table></td>
					  </tr>
					  <tr>
						<td height="8" colspan="2" align="left"></td>
					  </tr>
					  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Link to Twitter Page</strong></dt>
						</dl>                                </td>
						<td align="left"><input name="twitter_link" type="text" class="textfill2" id="twitter_link" value="<?php echo $twitter_link;?>" /></td>
					  </tr>
					  <tr>
						<td height="30" align="left"><dl>
						  <dt><strong>Link to Facebook Page</strong></dt>
						</dl>                                </td>
						<td align="left"><input name="facebook_link" type="text" class="textfill2" id="facebook_link" value="<?php echo $facebook_link ;?>" /></td>
					  </tr>
					  
					  
					  
					  <tr>
						<td height="10" colspan="2" align="left"></td>
						</tr>
					  
					  <tr>
						<td height="30" align="left">&nbsp;</td>
						<td align="left"><table border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td><a href="campaign-information.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>"></a>
							  <input type="button" name="button" id="button" value="back" class="button" onclick="javascript:window.location='campaign-information.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>'" />
							</td>
							<td>&nbsp;</td>
							<td><input type="hidden" name="submitproduct1" id="submitproduct1" /><input type="button" value="Next" id="submitproduct" class="button" name="submitproduct" onclick="lat_lng();" /></td>
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