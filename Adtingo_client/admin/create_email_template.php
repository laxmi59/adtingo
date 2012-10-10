<?php 
$nav=9;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('../includes/values.php'); 
include("includes/func.php");

if($_POST['submitproduct']!="")
{
extract($_POST);
 $insertMemInfo=sprintf("insert into tbl_email_template_content(TemplateName,Title ,Description ,paragraph1 ,paragraph2 ,paragraph3 ,paragraph4 ,paragraph5,paragraph6,paragraph7,template_status,template_type) values('%s','%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %d)",$object->stripper(addslashes($_POST['template_name'])),$object->stripper(addslashes($_POST['title'])),$object->stripper(addslashes($_POST['description'])),$object->stripper(addslashes($_POST['paragraph1'])),$object->stripper(addslashes($_POST['paragraph2'])),$object->stripper(addslashes($_POST['paragraph3'])),$object->stripper(addslashes($_POST['paragraph4'])),$object->stripper(addslashes($_POST['paragraph5'])),$object->stripper(addslashes($_POST['paragraph6'])),$object->stripper(addslashes($_POST['paragraph7'])),1,$object->stripper($_POST['template_type']));

$ins1=$object->ExecuteQuery($insertMemInfo);
$iid=mysql_insert_id();
if($_FILES['cre_temp']['name']){
    $img1=$_FILES['cre_temp']['name'];
	$img2=explode(".",$img1);
	$ex=strrchr($img1,".");
	$filename=$img2[0].$iid.$ex;
	move_uploaded_file($_FILES["cre_temp"]["tmp_name"],"../Campaign_templates/Campaign_template1/".$filename);
}
		
	if($_FILES['preview_temp']['name']<>''){
		$image=$_FILES['preview_temp']['name'];
		set_time_limit(0);
		$filename1 = stripslashes($_FILES['preview_temp']['name']);
		$extension = getExtension($filename1);
		$extension = strtolower($extension);
		$iid1=$image."_".$iid.".".$extension;
		$upd1=sprintf("update tbl_email_template_content set preview='%s' where Tid=%d",$object->stripper($iid1),$object->stripper($iid)); 
	$updres1=$object->ExecuteQuery($upd1);
		$image_name=$iid1;
		//the new name will be containing the full path where will be stored (images folder)
		$consname="../Campaign_templates/Campaign_template1/images/".$image_name; //change the image/ section to where you would like the original image to be stored
		$consname2="../Campaign_templates/Campaign_template1/images/thumb_images/".$image_name;
		//change the image/thumb to where you would like to store the new created thumb nail of the image
		$copied = copy($_FILES['preview_temp']['tmp_name'], $consname);
		$copied = copy($_FILES['preview_temp']['tmp_name'], $consname2);
		if (!$copied) {
			echo 'Copy unsuccessfull!';
			$errors=1;
		}else{
			// the new thumbnail image will be placed in images/thumbs/ folder
			$thumb_name=$consname2 ;
			$thumb=make_thumb($consname,$thumb_name,WIDTH,HEIGHT);
			$thumb=make_thumb($consname,$consname,WIDTH2,HEIGHT2);
		}//else
	}	
	$TemplateName="Template ".$iid;
	$upd=sprintf("update tbl_email_template_content set new_temp='%s', TemplateId='%s'  where Tid=%d",$object->stripper($filename),$object->stripper($iid),$object->stripper($iid)); 
	$updres=$object->ExecuteQuery($upd);
	
	 if($updres)
		{
			header("Location:manage_email_templates.php?msg=added");
			exit;
			
		}

 }
  ?>
<script language="javascript" type="text/javascript">
function validatetemplateform()
{
	var sErrStr = ""; 
   	var sFieldName = "";
	//var emailexp=/^[a-zA-Z]{1}[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,3}$/;
	var emailexp=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	var imgexp=/.jpg|\.JPG|\.jpeg|\.gif|\.png$/;//regular expression which accets specified image extensions only
	var urlRegxp = /^(http:\/\/www.|https:\/\/www.|ftp:\/ \/www.|www.){1}([\w]+)(.[\w]+){1,2}$/; //regular expression which accets specified url extensions only
	
	if(trim(document.getElementById('template_name').value)=='')
	{
		sErrStr +=" Template Name\n";
		if(sFieldName == "")
		sFieldName="template_name";
	}
	if(trim(document.getElementById('cre_temp').value)=='')
	{
		sErrStr +=" Upload Template \n";
		if(sFieldName == "")
		sFieldName="cre_temp";
	}
	if(document.getElementById('cre_temp').value!="")
	{
		var img=document.getElementById('cre_temp').value;
		var proimage=img.split('.');
		if(proimage[proimage.length-1]!='html' && proimage[proimage.length-1]!='htm')
		{
			sErrStr +=" Only html format should be accept for Email Template \n";
			if(sFieldName == "")
				sFieldName="cre_temp";
		}
	}
	if(trim(document.getElementById('preview_temp').value)=='')
	{
		sErrStr +=" Upload Template Preview \n";
		if(sFieldName == "")
		sFieldName="preview_temp";
	}
	if(document.getElementById('preview_temp').value!="")
	{
		if(imgexp.test(document.getElementById('preview_temp').value)==0)
		{
			sErrStr +=" Invalid Image format  \n";
			if(sFieldName == "")
			sFieldName="preview_temp";
		}
	}
	if(document.getElementById('template_type_wide').checked == false && document.getElementById('template_type_vertical').checked == false)
	{
		
		sErrStr +=" Template Type \n";
		if(sFieldName == "")
		sFieldName="template_type_vertical";
	}
	
	if (sErrStr != "")
	{
		alert("Please enter the following fields \n\n"+sErrStr);
		document.getElementById(sFieldName).focus();
		return false;
	}
	document.profilrfrm.target="";
	document.profilrfrm.action="";
	document.profilrfrm.submit();
}

</script>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
        <thead>
          <tr>
            <td width="83%" height="100" align="left" class="tr5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="20" align="left" class="content-header">Add email template</td>
                  <td align="right"  class="padbot5">&nbsp;</td>
                </tr>
                <tr class="grey-bg">
                  <td height="4" colspan="2"></td>
                </tr>
              </table>
              <form action="" method="post" name="profilrfrm" enctype="multipart/form-data" onsubmit="return validatetemplateform();" >
               
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="28" align="left" class="form-headings">Temaplate details</td>
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
                                  <td height="30" align="left"><strong>Template Name </strong></td>
                                  <td align="left"><input type="text" name="template_name" id="template_name" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Upload Template </strong></td>
                                  <td align="left"><input type="file" name="cre_temp" id="cre_temp" /></td>
                                </tr>
								<tr>
                                  <td height="30" align="left"><strong>Preview Image </strong></td>
                                  <td align="left"><input type="file" name="preview_temp" id="preview_temp" /></td>
                                </tr>
								<tr>
                                  <td height="30" align="left"><strong>Template Type </strong></td>
                                  <td align="left">
								  	<input type="radio" name="template_type" id="template_type_vertical" value="1" /> 
								  	Vertical
									<input type="radio" name="template_type" id="template_type_wide" value="2" /> 
									Wide
								  </td>
                                </tr>
                               
                              </table></td>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                  </tr>
                  
                  
                  <!--<tr>
                    <td height="28" align="left" class="form-headings">Your Local Deals</td>
                  </tr>-->
                  <?php /*?><tr>
                    <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                        <thead>
                          <tr>
                            <td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="23%" height="10" align="left"></td>
                                  <td width="76%" height="10" align="left"></td>
                                </tr>
							
                                <tr>
                                  <td height="30" align="left"><strong>Title</strong></td>
                                  <td align="left"><input  name="title" type="text" id="title" value="<?php if( $RecGetEmailTemplates['Title']!="") echo  stripslashes($RecGetEmailTemplates['Title']);?>" size="33" />                                  </td>
                                </tr>
                                <tr>
                                  <td height="94" align="left"><strong>Description</strong></td>
                                  <td align="left"><textarea name="description" id="description" cols="25" rows="4"><?php if( $RecGetEmailTemplates['Description']!="") echo  stripslashes($RecGetEmailTemplates['Description']);?></textarea>
                                    <br/>
                                    <span id="errmail" class="errer-mess2"></span> </td>
                                </tr>
                              </table></td>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                  </tr><?php */?>
                  <tr>
                    <td height="28" align="left" class="form-headings">List of Things to Come</td>
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
                                  <td height="62" align="left"><strong>Paragraph 1</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph1" id="paragraph1" cols="25" rows="3"><?php if( $RecGetEmailTemplates['paragraph1']!="") echo  stripslashes($RecGetEmailTemplates['paragraph1']);?></textarea>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td height="62" align="left"><strong>Paragraph 2</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph2" id="paragraph2" cols="25" rows="3"><?php if( $RecGetEmailTemplates['paragraph2']!="") echo  stripslashes($RecGetEmailTemplates['paragraph2']);?></textarea>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td height="62" align="left"><strong>Paragraph 3</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph3" id="paragraph3" cols="25" rows="3"><?php if( $RecGetEmailTemplates['paragraph3']!="") echo  stripslashes($RecGetEmailTemplates['paragraph3']);?></textarea>
                                    </label></td>
                                </tr>
                                <!--<tr>
                                  <td height="62" align="left"><strong>Paragraph 4</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph4" id="paragraph4" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph4']!="") echo  stripslashes($RecGetEmailTemplates['paragraph4']);?></textarea>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td height="62" align="left"><strong>Paragraph 5</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph5" id="paragraph5" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph5']!="") echo  stripslashes($RecGetEmailTemplates['paragraph5']);?></textarea>
                                    </label></td>
                                </tr>
								<tr>
                                  <td height="62" align="left"><strong>Paragraph 6</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph6" id="paragraph6" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph6']!="") echo  stripslashes($RecGetEmailTemplates['paragraph6']);?></textarea>
                                    </label></td>
                                </tr>
								<tr>
                                  <td height="62" align="left"><strong>Paragraph 7</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph7" id="paragraph7" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph7']!="") echo  stripslashes($RecGetEmailTemplates['paragraph7']);?></textarea>
                                    </label></td>
                                </tr>-->
								<tr>
                                  <td height="30" align="left">&nbsp;</td>
                                  <td align="left" ><input name="submitproduct" type="submit" class="button" id="submitproduct" value="Submit" />
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                  </tr>
                  <!--<tr>
                    <td height="28" align="left" class="form-headings">Links urls</td>
                  </tr>-->
                  <?php /*?><tr>
                    <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                        <thead>
                          <tr>
                            <td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="23%" height="10" align="left"></td>
                                  <td width="76%" height="10" align="left"></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 1</strong></td>
                                  <td align="left"><input type="text" name="linkname1" value="<?php if( $RecGetEmailTemplates['linkname1']!="") echo  stripslashes($RecGetEmailTemplates['linkname1']);?>"  />&nbsp;&nbsp;<input  name="link_url1" type="text" id="link_url1" value="<?php if( $RecGetEmailTemplates['link_url1']!="") echo  stripslashes($RecGetEmailTemplates['link_url1']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 2</strong></td>
                                  <td align="left"><input type="text" name="linkname2" value="<?php if( $RecGetEmailTemplates['linkname2']!="") echo  stripslashes($RecGetEmailTemplates['linkname2']);?>"  />&nbsp;&nbsp;<input  name="link_url2" type="text" id="link_url2" value="<?php if( $RecGetEmailTemplates['link_url2']!="") echo  stripslashes($RecGetEmailTemplates['link_url2']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 3</strong></td>
                                  <td align="left"><input type="text" name="linkname3" value="<?php if( $RecGetEmailTemplates['linkname3']!="") echo  stripslashes($RecGetEmailTemplates['linkname3']);?>"  />&nbsp;&nbsp;<input  name="link_url3" type="text" id="link_url3" value="<?php if( $RecGetEmailTemplates['link_url3']!="") echo  stripslashes($RecGetEmailTemplates['link_url3']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 4</strong></td>
                                  <td align="left"><input type="text" name="linkname4" value="<?php if( $RecGetEmailTemplates['linkname4']!="") echo  stripslashes($RecGetEmailTemplates['linkname4']);?>"  />&nbsp;&nbsp;<input  name="link_url4" type="text" id="link_url4" value="<?php if( $RecGetEmailTemplates['link_url4']!="") echo  stripslashes($RecGetEmailTemplates['link_url4']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 5</strong></td>
                                  <td align="left"><input type="text" name="linkname5" value="<?php if( $RecGetEmailTemplates['linkname5']!="") echo  stripslashes($RecGetEmailTemplates['linkname5']);?>"  />&nbsp;&nbsp;<input  name="link_url5" type="text" id="link_url5" value="<?php if( $RecGetEmailTemplates['link_url5']!="") echo  stripslashes($RecGetEmailTemplates['link_url5']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 6</strong></td>
                                  <td align="left"><input type="text" name="linkname6" value="<?php if( $RecGetEmailTemplates['linkname6']!="") echo  stripslashes($RecGetEmailTemplates['linkname6']);?>"  />&nbsp;&nbsp;<input  name="link_url6" type="text" id="link_url6" value="<?php if( $RecGetEmailTemplates['link_url6']!="") echo  stripslashes($RecGetEmailTemplates['link_url6']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 7</strong></td>
                                  <td align="left"><input type="text" name="linkname7" value="<?php if( $RecGetEmailTemplates['linkname7']!="") echo  stripslashes($RecGetEmailTemplates['linkname7']);?>"  />&nbsp;&nbsp;<input  name="link_url7" type="text" id="link_url7" value="<?php if( $RecGetEmailTemplates['link_url7']!="") echo  stripslashes($RecGetEmailTemplates['link_url7']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 8</strong></td>
                                  <td align="left"><input type="text" name="linkname8" value="<?php if( $RecGetEmailTemplates['linkname8']!="") echo  stripslashes($RecGetEmailTemplates['linkname8']);?>"  />&nbsp;&nbsp;<input  name="link_url8" type="text" id="link_url8" value="<?php if( $RecGetEmailTemplates['link_url8']!="") echo  stripslashes($RecGetEmailTemplates['link_url8']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 9</strong></td>
                                  <td align="left"><input type="text" name="linkname9" value="<?php if( $RecGetEmailTemplates['linkname9']!="") echo  stripslashes($RecGetEmailTemplates['linkname9']);?>"  />&nbsp;&nbsp;<input  name="link_url9" type="text" id="link_url9" value="<?php if( $RecGetEmailTemplates['link_url9']!="") echo  stripslashes($RecGetEmailTemplates['link_url9']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left"><strong>Link 10</strong></td>
                                  <td align="left"><input type="text" name="linkname10" value="<?php if( $RecGetEmailTemplates['linkname10']!="") echo  stripslashes($RecGetEmailTemplates['linkname10']);?>"  />&nbsp;&nbsp;<input  name="link_url10" type="text" id="link_url10" value="<?php if( $RecGetEmailTemplates['link_url10']!="") echo  stripslashes($RecGetEmailTemplates['link_url10']);?>" size="33" /></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left">&nbsp;</td>
                                  <td align="left" ><input name="submitproduct" type="submit" class="button" id="submitproduct" value="Submit" />
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                  </tr><?php */?>
				  
                </table>
              </form></td>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table></td>
  </tr>
</table>
<?php include('includes/footer.php'); ?>
