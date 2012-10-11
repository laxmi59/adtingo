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

}
if($RecCampaign_info['template_selection']=="0")
{
	header("location:campaign-information.php?cid=".base64_encode($CampaignID)."");
	exit;
}

//$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
if(isset($_POST['submitproduct']))
{

	if($_POST['destinationurl']!='' && $_POST['heading']!='' && $_POST['text_content']!='')
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
				$source=$_FILES['main_image']['tmp_name'];	
				$source_name=$_FILES['main_image']['name'];
				$up_flag='y';
				$main_image_lastname=time()."_".$source_name;
				 $main_image_lastname=clean_url($main_image_lastname);
				$dest=$filedir.$main_image_lastname;
				 $thumbdest="../Campaign_images/main_image/thumb_images/".$main_image_lastname;
				move_uploaded_file($source, $dest);
				$imagepath_temporary = $_FILES['main_image']['tmp_name'];
				list($width,$height,$type) = getimagesize($dest);
				$uploaded_image_size = $_FILES["main_image"]["size"];
				$destpath1 = "../Campaign_images/main_image/".$RecCampaign_info['main_image'];
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
				 unlink($destpath2); 
				  $destpaththumb = "../Campaign_images/clickble_image/thumb_images/".$RecCampaign_info['clickble_image'];
				 unlink($destpaththumb); 
				// $clickble_image_lastname = str_replace(" ", "", $clickble_image_lastname);
				

				   $Insert_Clickble_image_Qry=sprintf("update tbl_campaigns  set clickble_image='%s' where campaign_id=%d",$object->stripper($clickble_image_lastname),$object->stripper($CampaignID));  
				 $Insert_Clickble_image_Res=$object->ExecuteQuery($Insert_Clickble_image_Qry);  
				
		}
		
		
		if($Num_cols >0) 
			{
			   $Insert_campaign_info_qry=sprintf("update tbl_campaigns  set destination_url='%s',  	heading='%s',sub_heading='%s',text_content='%s',contact_info='%s',twitter_link='%s',facebook_link='%s' where campaign_id=%d",$object->stripper($_POST["destinationurl"]),$object->stripper(addslashes($_POST["heading"])),$object->stripper(addslashes($_POST["subheading"])),$object->stripper(addslashes($_POST["text_content"])),$object->stripper($_POST["contact_info"]),$object->stripper($_POST["twitter_link"]),$object->stripper($_POST["facebook_link"]),$object->stripper($CampaignID));  
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
                </table>   <form  action="" method="post" name="submitform5" id="submitform5" enctype="multipart/form-data" >


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
                                    <td align="left">
									<input type="text" name="heading" class="textfill" id="heading" value="<?php if($RecCampaign_info['heading']!="") echo $RecCampaign_info['heading'] ;?>"  onkeypress="return checkvalue();" />
									<br /><div id="headerchars" style="display:none;" class="errer-mess2">You have exceeded more than 30 characters</div> 
									</td>
                                  </tr>
								   <?php if($heading_error!="") {?>
                               <tr><td colspan="2" align="left"><span class="red-normal">
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
                                    <td align="left"><input type="text" name="subheading" class="textfill" id="subheading" value="<?php if($RecCampaign_info['sub_heading']!="") echo $RecCampaign_info['sub_heading'] ;?>" onkeypress="return checksubheadingval();"  /><br /><div id="subhead" style="display:none;" class="errer-mess2">You have exceeded more than 60 characters</div></td>
                                  </tr>
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
                                  <dt><strong>Text content</strong></dt>
                                </dl>                                </td>
                                <td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left"><textarea name="text_content" id="text_content" cols="45" rows="5" class="w-165"><?php if($RecCampaign_info['text_content']!="") echo $RecCampaign_info['text_content'] ;?></textarea></td>
                                  </tr>
                                  <tr>
                                    <td align="left"><span class="small-text">(250 Word Max)</span></td>
                                  </tr>
								    <?php if($content_error!="") {?>
                               <tr><td colspan="2" align="left"><span class="red-normal">
				  <?php  echo $content_error;?>
				</span></td></tr><?php } ?>
                                </table>                                </td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt><strong>Coantact Info</strong></dt>
                                </dl>                                </td>
                                <td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left"><textarea name="contact_info" id="contact_info" cols="45" rows="5" class="w-165"><?php if($RecCampaign_info['contact_info']!="") echo $RecCampaign_info['contact_info'] ;?></textarea></td>
                                  </tr>
                                  <tr>
                                    <td align="left"><span class="small-text">(Physical Address, Webiste URL)</span></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt><strong>Destination URL</strong></dt>
                                </dl>                                </td>
                                <td align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left"><input name="destinationurl" type="text" class="textfill" id="destinationurl" value="<?php if($RecCampaign_info['destination_url']!="") echo $RecCampaign_info['destination_url'] ;?>" /></td>
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
                                    <tr>
                                      <td align="left"><img src="../Campaign_images/main_image/thumb_images/<?php echo $RecCampaign_info['main_image']; ?>" width="100" height="100" /></td>
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
                                    <td align="left"><img src="../Campaign_images/clickble_image/thumb_images/<?php echo $RecCampaign_info['clickble_image']; ?>" width="100" height="100" /></td>
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
                                <td align="left"><input name="twitter_link" type="text" class="textfill" id="twitter_link" value="<?php if($RecCampaign_info['twitter_link']!="") echo $RecCampaign_info['twitter_link'] ;?>" /></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt><strong>Link to Facebook Page</strong></dt>
                                </dl>                                </td>
                                <td align="left"><input name="facebook_link" type="text" class="textfill" id="facebook_link" value="<?php if($RecCampaign_info['facebook_link']!="") echo $RecCampaign_info['facebook_link'] ;?>" /></td>
                              </tr>
                              
                              
                              
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                                </tr>
                              
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><a href="campaign-information.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>">
                                      <input type="button" name="button" id="button" value="back" class="button" />
                                    </a></td>
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