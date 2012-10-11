<?php 
$nav=9;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('../includes/values.php'); 
$Tid=$_REQUEST['Tid'];
$SqlGetEmailTemplates="select * from tbl_email_template_content where TId=".$Tid."";
$ResGetEmailTemplates=$object->ExecuteQuery($SqlGetEmailTemplates);
 $RecGetEmailTemplates=$object->FetchArray($ResGetEmailTemplates);
  
if($_POST['submitproduct']!="")
{
 $updateuserinfo=sprintf("update tbl_email_template_content set Title='%s',Description='%s', paragraph1='%s', paragraph2='%s', paragraph3='%s',paragraph4='%s',paragraph5='%s',paragraph6='%s',paragraph7='%s',link_url1='%s',link_url2='%s',link_url3='%s',link_url4='%s',link_url5='%s',link_url6='%s',link_url7='%s',link_url8='%s',link_url9='%s',link_url10='%s',linkname1='%s',linkname2='%s',linkname3='%s',linkname4='%s',linkname5='%s',linkname6='%s',linkname7='%s',linkname8='%s',linkname9='%s',linkname10='%s'  where TId=%d",$object->stripper(addslashes($_POST['title'])),$object->stripper(addslashes($_POST['description'])),$object->stripper(addslashes($_POST['paragraph1'])),$object->stripper(addslashes($_POST['paragraph2'])),$object->stripper(addslashes($_POST['paragraph3'])),$object->stripper(addslashes($_POST['paragraph4'])),$object->stripper(addslashes($_POST['paragraph5'])),$object->stripper(addslashes($_POST['paragraph6'])),$object->stripper(addslashes($_POST['paragraph7'])),$object->stripper($_POST['link_url1']),$object->stripper($_POST['link_url2']),$object->stripper($_POST['link_url3']),$object->stripper($_POST['link_url4']),$object->stripper($_POST['link_url5']),$object->stripper($_POST['link_url6']),$object->stripper($_POST['link_url7']),$object->stripper($_POST['link_url8']),$object->stripper($_POST['link_url9']),$object->stripper($_POST['link_url10']),$object->stripper(addslashes($_POST['linkname1'])),$object->stripper(addslashes($_POST['linkname2'])),$object->stripper(addslashes($_POST['linkname3'])),$object->stripper(addslashes($_POST['linkname4'])),$object->stripper(addslashes($_POST['linkname5'])),$object->stripper(addslashes($_POST['linkname6'])),$object->stripper(addslashes($_POST['linkname7'])),$object->stripper(addslashes($_POST['linkname8'])),$object->stripper(addslashes($_POST['linkname9'])),$object->stripper(addslashes($_POST['linkname10'])),$object->stripper($Tid)); 
$QryinsertMemInfo=$object->ExecuteQuery($updateuserinfo);
 if($QryinsertMemInfo)
	{
		header("Location:manage_email_templates.php?msg=edit");
		exit;
		
	}
 }
  ?>

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
                  <td height="20" align="left" class="content-header">Edit email template</td>
                  <td align="right"  class="padbot5">&nbsp;</td>
                </tr>
                <tr class="grey-bg">
                  <td height="4" colspan="2"></td>
                </tr>
              </table>
              <form action="" method="post" name="profilrfrm" enctype="multipart/form-data" >
               
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="28" align="left" class="form-headings">Your Local Deals</td>
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
                                  <td height="30" align="left"><strong>Tittle</strong></td>
                                  <td align="left"><input  name="title" type="text" id="title" value="<?php if( $RecGetEmailTemplates['Title']!="") echo  stripslashes($RecGetEmailTemplates['Title']);?>" size="33" />
                                  </td>
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
                  </tr>
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
                                  <td height="62" align="left"><strong>Pragraph 1</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph1" id="paragraph1" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph1']!="") echo  stripslashes($RecGetEmailTemplates['paragraph1']);?></textarea>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td height="62" align="left"><strong>Pragraph 2</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph2" id="paragraph2" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph2']!="") echo  stripslashes($RecGetEmailTemplates['paragraph2']);?></textarea>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td height="62" align="left"><strong>Pragraph 3</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph3" id="paragraph3" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph3']!="") echo  stripslashes($RecGetEmailTemplates['paragraph3']);?></textarea>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td height="62" align="left"><strong>Pragraph 4</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph4" id="paragraph4" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph4']!="") echo  stripslashes($RecGetEmailTemplates['paragraph4']);?></textarea>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td height="62" align="left"><strong>Pragraph 5</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph5" id="paragraph5" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph5']!="") echo  stripslashes($RecGetEmailTemplates['paragraph5']);?></textarea>
                                    </label></td>
                                </tr>
								<tr>
                                  <td height="62" align="left"><strong>Pragraph 6</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph6" id="paragraph6" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph6']!="") echo  stripslashes($RecGetEmailTemplates['paragraph6']);?></textarea>
                                    </label></td>
                                </tr>
								<tr>
                                  <td height="62" align="left"><strong>Pragraph 7</strong></td>
                                  <td align="left"><label>
                                    <textarea name="paragraph7" id="paragraph7" cols="25" rows="1"><?php if( $RecGetEmailTemplates['paragraph7']!="") echo  stripslashes($RecGetEmailTemplates['paragraph7']);?></textarea>
                                    </label></td>
                                </tr>
                              </table></td>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="28" align="left" class="form-headings">Links urls</td>
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
                  </tr>
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
