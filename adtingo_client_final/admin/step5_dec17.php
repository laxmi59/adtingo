<?php
error_reporting(0); 
$nav=12;
include('includes/functions.php'); 
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php'); 
$object=new main();
$Num_cols="0";
$count=0;
if($_REQUEST['Val']!="")
{
$CampaignID=base64_decode($_REQUEST['cid']);
	 $UpdateCampaignzipcodeqry="update tbl_campaign_list_segmentation set zipcode ='',zipcode_miles='' where campaign_id=".$CampaignID.""; 
		$UpdateCampaignzipcodeRes=$object->ExecuteQuery($UpdateCampaignzipcodeqry);
}
if($_REQUEST['cid']!="")
{
	$CampaignID=base64_decode($_REQUEST['cid']);
  	 $SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$CampaignID ; 
	$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
	$Num_cols=$object->NumRows($ResCampaign_Seg_list_info);
	$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);
		
	 $SqlCampaign_info="select * from tbl_campaigns where campaign_id=".$CampaignID ; 
	$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
	  $Num_cols=$object->NumRows($ResCampaign_info); 
	$RecCampaign_info=$object->FetchArray($ResCampaign_info);
	
	$shddate=$RecCampaign_info['schedule_date'];
$shddate1=explode(" ",$shddate);
  $shddate2=$shddate1[0];
}

	
	

//$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
if(isset($_POST['submitproduct']))
{
	$Random_num_error="";
	if($_POST['sendall']=='1' || $_POST['sendall']=='2')
	{
		$_SESSION['campaign']['random_number']=$_POST['random_number'];
		$_SESSION['campaign']['sendall']=$_POST['sendall'];
		if($_POST['sendall']=='1')
		{
			if($Num_cols >0)
			{
					$count=$count+1;
			}
		}else{
		if($_POST['random_number']!='')
		{
			$_SESSION['campaign']['random_number']=$_POST['random_number'];
			if (is_numeric($_POST['random_number']))
			{
				if($_POST['random_number']<=$_POST['totrec'] && $_POST['random_number']>=1) 
				{
					$count=$count+1;
				}
				else
					$Random_num_error="Specify Number should be less than Total number of records";
			}
			else {
				$Random_num_error="Specify Number should accept numbers only";
			}
		}else{
			if($_POST["random_number"]=="")
			{
				$_SESSION['campaign']['sendall']=$_POST['sendall'];
				$Random_num_error="Specify Number Field Required";
				$_SESSION['campaign']['random_number']="";
			}
			else
				$_SESSION['campaign']['random_number']=$_POST["random_number"];
		}
	}
}
else
{
	$Random_num_error="Select The Option To Send Campaign";
}
if($count>0)
		{
				$Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set 	sendall_option=%d,random_number=%d where campaign_id=%d",$object->stripper($_POST["sendall"]),$object->stripper($_POST["random_number"]),$object->stripper($CampaignID));
				$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
				unset($_SESSION['campaign']);
				header("location:campaign-information.php?cid=".base64_encode($CampaignID)."");
				exit;
			}
	}		
?>

<script language="javascript" type="text/javascript">

function gettotalrecords(arealist,minage,maxage,gender,income,zipcode,radious,datesent,random_number)
{
displayStaticMessage("<img src='images/loading.gif' />");
	 var req=createRequest();
	 req.open("GET","GetTotalMemberRecords_admin.php?minage="+minage+"&maxage="+maxage+"&gendersel="+gender+"&income="+income+"&area_list="+arealist+"&zipcode="+zipcode+"&radious="+radious+"&shddate="+datesent+"&random_number="+random_number,true,'');
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
				
			   if((res)!="")
				{
					document.getElementById("totalrecords").innerHTML=res;
					//document.profilrfrm.errormess.value=1;totrec
					document.getElementById("totrec").value=res;
					closeMessage();
				}
				else
				{
					
					document.getElementById("totalrecords").innerHTML="0";
					//document.profilrfrm.errormess.value=0;
					document.getElementById("totrec").value="0";
					closeMessage();
				}
			
			return false;
		  } 
	 } 
}
function GetListedRecords(cid)
{

 var req=createRequest();
	 req.open("GET","GetListrecords.php?cid="+cid,true);
	 req.send(null);
	 req.onreadystatechange=function()
	 {
		 //alert("hi");
		 	
    if(req.readyState==4  && req.status==200)
		  {
			   var res=req.responseText;
				
			   if((res)!="")
				{
					document.getElementById("totalrecords").innerHTML=res;
					//document.profilrfrm.errormess.value=1;
				}
				else
				{
					
					document.getElementById("totalrecords").innerHTML="0";
					//document.profilrfrm.errormess.value=0;
				}
			
			return false;
		  } 
	 } 
}
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
                    <td height="20" align="left" class="content-header">Step 1.5: List Segmentation</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>  <form  action="" method="post" name="signupForm4" id="signupForm4">          
				
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
                                <td width="9%" height="10" align="left"></td>
                                <td width="53%" height="10" align="left"></td>
                              </tr>
                              <tr>
                                <td colspan="2" height="30"  align="left" class="table-tab" >Select The Option To Send Campaign</td>
                              <td width="38%" height="30"  align="right" class="table-tab">Total Number Of Records:<strong><span id="totalrecords">
			  </span></strong>
			   <input type="hidden" name="totrec" id="totrec"  /></td>
							  </tr>
                              <tr>
                                <td height="10" colspan="3" align="left"></td>
                                </tr>
                              <tr>
                                <td height="30" align="center" valign="middle"><input name="sendall" id="sendall" <?php if($RecCampaign_info['status']==5){?>disabled="disabled" <?php } ?> type="radio" value="1" onclick="return sendallcheck();" <?php if($RecCampaign_Seg_list_info['sendall_option']=='1') { ?> checked="checked" <?php } ?> /></td>
                                <td align="left" colspan="2"><strong>Send to All </strong> </td>
                              </tr>
							  <tr>
                                <td height="30" align="center" valign="middle"><input name="sendall" <?php if($RecCampaign_info['status']==5){?>disabled="disabled" <?php } ?> id="send_random" type="radio" value="2" onclick="return sendallcheck();" <?php if($RecCampaign_Seg_list_info['sendall_option']=='2' || $_SESSION['campaign']['sendall']=='2') { ?> checked="checked" <?php } ?> /> </td>
                                <td  colspan="2" align="left"><table width="274" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="109"><strong>Specify Number</strong></td>
                                    <td width="165"><input name="random_number" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> id="random_number" type="text" class="w-60"  value="<?php if($RecCampaign_Seg_list_info['random_number']!="0") echo $RecCampaign_Seg_list_info['random_number'];?>" 
	<?php if($RecCampaign_Seg_list_info['sendall_option']=='1')	 {?> disabled="disabled" <?php }?>		
				/>
					
					</td>
                                    </tr>
									<?php   if($Random_num_error!="") {?>
							  <tr><td>&nbsp;</td><td  colspan="2" ><span class="red-normal">
				  <?php  echo $Random_num_error;?>
				</span></td></tr>
					<?php } ?>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="3" align="center" valign="middle"></td>
                                </tr>
                               
							   <tr>
							     <td height="30" align="left">&nbsp;</td>
							     <td align="left" colspan="2"><table border="0" cellspacing="0" cellpadding="0">
                                   <tr>
                                     <td><a href="step4.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"></a>
									 <input type="button" name="button" id="button" value="back" class="button" onclick="javascript:window.location='step4.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>'" />
									 </td>
                                     <td>&nbsp;</td>
                                     <td>
									  <?php if($RecCampaign_info['status']==5)
									{?>
									<input type="button" name="button" id="button" value="Next" class="button" onclick="javascript:window.location='campaign-information.php?cid=<?php echo base64_encode($CampaignID);?>'" />
									
									<?php } else {?>
									<input type="submit" value="Next" id="submitproduct" class="button" name="submitproduct" />
									<?php
									}?>
									</td>
                                   </tr>
                                 </table></td>
						        </tr>
							  

						<?php
						$gendertype="";
						$gendertype1="";
						
						 if($QryGetUserDetailsRec['gender']=='male')
						{
						
							$gendertype="checked=checked";
							}
							else
							{
							$gendertype1="checked=checked";
							}
							  ?>
							   

                            </table></td>
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
	  <script language="javascript" type="text/javascript">
<?php if($RecCampaign_info['status']!=5)
{?>   
gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,'<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>','<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>','<?php echo $RecCampaign_Seg_list_info['gender'];?>',<?php echo $RecCampaign_Seg_list_info['income'];?>,'<?php echo $RecCampaign_Seg_list_info['zipcode'];?>','<?php echo $RecCampaign_Seg_list_info['zipcode_miles'];?>','<?php echo $shddate2;?>','<?php echo $RecCampaign_Seg_list_info['random_number'];?>');
<?php } else {?>
GetListedRecords('<?php echo $CampaignID;?>');
<?php
}?>
	  </script>
     <?php include('includes/footer.php'); ?>