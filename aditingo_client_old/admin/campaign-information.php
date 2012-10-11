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

if(isset($_POST['submitproduct']))
{
	if($_POST['templatename']!='')
		{
		if($Num_cols >0)
			{
			   $Insert_campaign_info_qry=sprintf("update tbl_campaigns  set template_selection=%d where campaign_id=%d",$object->stripper($_POST["templatename"]),$object->stripper($CampaignID));
			$Insert_campaign_info_Res=$object->ExecuteQuery($Insert_campaign_info_qry);  
			if($Insert_campaign_info_Res)
			{
				unset($_SESSION['campaign']);
				header("location:add-own-template.php?cid=".base64_encode($CampaignID)."");
				exit;
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
function showpriviewtemplate(val)
{
if(val==1)
{
document.getElementById("template1").style.display="block";
document.getElementById("template2").style.display="none";
}
if(val==2)
{
document.getElementById("template2").style.display="block";
document.getElementById("template1").style.display="none";
}
}

  function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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
                </table>   <form  action="" method="post" name="signupForm5" id="signupForm5">      
				
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
                                <td height="30" align="left"><strong>
Select template</strong></td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="15"><input type="radio" name="templatename" id="templatename1" value="1"  <?php if($RecCampaign_info['template_selection']=='1') { ?> checked="checked" <?php } ?> onclick="return showpriviewtemplate(1);" /> </td>
                                    <td width="80">Template 1</td>
                                    <td width="15"> <input type="radio" class="m-left5" name="templatename" id="templatename2" value="2" <?php if($RecCampaign_info['template_selection']=='2') { ?> checked="checked" <?php } ?> onclick="return showpriviewtemplate(2);"/> </td>
                                    <td width="100">Template 2</td>
                                  </tr>
								  <tr><td colspan="4"><div id="template1" style="display:none;" ><a href="javascript:MM_openBrWindow('viewtemplatepreview.php?image=image-examplelargevertical.jpg','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=480,height=600')">
	<img src="images/image-examplelargevertical.jpg" width="100" height="100" /></a></div>
	<div id="template2" style="display:none;" ><a href="javascript:MM_openBrWindow('viewtemplatepreview.php?image=image-examplelargewide.jpg','Win','toolbar=n,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=480,height=600')">
	<img src="images/image-examplelargewide.jpg" width="100" height="100" /></a></div></td></tr>
								  <?php   if($templatename_error!="") {?>
							  <tr><td colspan="5" ><span class="red">
				  <?php  echo $templatename_error;?>
				</span></td></tr>
					<?php } ?>
                                </table></td>
                              </tr>
                              
                              
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                                </tr>
                              
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><a href="step5.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>">
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