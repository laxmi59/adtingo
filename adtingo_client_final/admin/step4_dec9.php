<?php 
$nav=12;
error_reporting(0);
include_once('includes/functions.php'); 
include('includes/header.php'); 
include_once('includes/adminsessions.php');
include_once('includes/values.php'); 
$object=new main();

$Num_cols="0";
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
//$_SESSION['TotalRecords']=$SearchResult;

}
if(isset($_POST['submitproduct'])){
	if($_POST['zipcode']!='' && $_POST['zipcoderadious']!=''){
		if(preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$_POST['zipcode'])){
			if($Num_cols >0){
				$Intrest_activities1=implode(",",$_POST['intrest']);
				$Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set zipcode='%s',zipcode_miles=%d where campaign_id=%d",$object->stripper($_POST["zipcode"]),$object->stripper($_POST["zipcoderadious"]),$object->stripper($CampaignID));  
				$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
				if($Insert_seg__List_Res){
					unset($_SESSION['campaign']);
					header("location:step5.php?cid=".base64_encode($CampaignID)."");
					exit;
				}
			}
		}else{
			$zipcode_area_error="Invalid Zipcode Format";
			$_SESSION['campaign']['zipcode']="";
		}
	}else{
		$zipcode_area_error="";
		$specifyzipcode_area_error="";
		if($_POST["zipcode"]==""){
			$zipcode_area_error="Zipcode Required";
			$_SESSION['campaign']['zipcode']="";
		}else{
			$zipcode_area_error="Invalid Zipcode Format";
			$_SESSION['campaign']['zipcode']="";
		}
		if($_SESSION['campaign']['zipcode']!='')
			$_SESSION['campaign']['zipcode']=$_POST["zipcode"];
		if($_POST["zipcoderadious"]==""){
			$specifyzipcode_area_error="And Zip Codes Within  field Required";
			$_SESSION['campaign']['zipcoderadious']="";
		}else
			$_SESSION['campaign']['zipcoderadious']=$_POST["zipcoderadious"];
	}  
		
}		
?>

<script language="javascript" type="text/javascript">

function gettotalrecords(arealist,minage,maxage,gender,income,zipcode,radious,datesent,random_number)
{
	
	
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
					document.getElementById("Gettotalrecords").innerHTML=res;
					//document.profilrfrm.errormess.value=1;
				}
				else
				{
					
					document.getElementById("Gettotalrecords").innerHTML="0";
					//document.profilrfrm.errormess.value=0;
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
					document.getElementById("Gettotalrecords").innerHTML=res;
					//document.profilrfrm.errormess.value=1;
				}
				else
				{
					
					document.getElementById("Gettotalrecords").innerHTML="0";
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
                    <td height="20" align="left" class="content-header">Step 1.4: List Segmentation</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>   <form  action="" method="post" name="signupForm3" id="signupForm3">    
				
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
                                <td height="30"  align="left" class="table-tab">Zip Codes</td>
								<td height="30"  align="right" class="table-tab"> Total Number Of Records: <strong><span id="Gettotalrecords">
			  </span></strong></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>
Enter Zip Code</strong></td>
                                <td align="left"><input name="zipcode" id="zipcode" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>,<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>,'<?php echo $RecCampaign_Seg_list_info['gender'];?>',<?php echo $RecCampaign_Seg_list_info['income'];?>,document.signupForm3.zipcode.value,document.signupForm3.zipcoderadious.value,'<?php echo $shddate2;?>','');"   type="text" value="<?php if($RecCampaign_Seg_list_info['zipcode']!="")
			  		echo $RecCampaign_Seg_list_info['zipcode'];?>"    />                                </td>
                              </tr>
							<?php   if($zipcode_area_error!="") {?>
							  <tr><td>&nbsp;</td><td ><span class="red-normal">
				  <?php  echo $zipcode_area_error;?>
				</span></td></tr>
					<?php } ?>
                              <tr>
                                <td height="30" align="left"><strong>And Zip Codes Within</strong></td>
                                <td align="left"><select name="zipcoderadious" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> id="zipcoderadious"  onchange="return gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>,<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>,'<?php echo $RecCampaign_Seg_list_info['gender'];?>',<?php echo $RecCampaign_Seg_list_info['income'];?>,document.signupForm3.zipcode.value,document.signupForm3.zipcoderadious.value,'<?php echo $shddate2;?>','');"  >
                <option value="">Select Miles</option>
                 <?php 
				 if($RecCampaign_Seg_list_info['zipcode_miles']!="0")
				   $value=$RecCampaign_Seg_list_info['zipcode_miles']; 
					echo Get_Zipcode_Radious($value);?>
                   
                </select>                                </td>
                              </tr>
							  <?php if($specifyzipcode_area_error!="") {?>
                               <tr><td>&nbsp;</td><td  ><span class="red-normal">
				  <?php  echo $specifyzipcode_area_error;?>
				</span></td></tr><?php } ?>
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><a href="step3.php?cid=<?php echo base64_encode($CampaignID);?>"></a>
									<input type="button" name="button" id="button" value="back" class="button" onclick="javascript:window.location='step3.php?cid=<?php echo base64_encode($CampaignID);?>'" />
									</td>
                                    <td>&nbsp;</td>
                                    <td>
									 <?php if($RecCampaign_info['status']==5)
									{?>
									<input type="button" name="button" id="button" value="Next" class="button" onclick="javascript:window.location='step5.php?cid=<?php echo base64_encode($CampaignID);?>'" />
									
									<?php } else {?>
									<input type="submit" value="Next" id="submitproduct" class="button" name="submitproduct" />
									<?php
									}?>
									</td>
                                    <td>&nbsp;</td>
                                    <td>
									<a href="step5.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>"></a>
									<input type="button" value="Skip the step" id="submitproduct2" class="button" name="submitproduct2" onclick="javascript:window.location='step5.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>'" />
									</td>
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
	  <script language="javascript" type="text/javascript">
	  <?php if($RecCampaign_info['status']!=5)
{?>
	   gettotalrecords(<?php echo $RecCampaign_Seg_list_info['area_list'];?>,<?php echo $RecCampaign_Seg_list_info['minimum_age'];?>,<?php echo $RecCampaign_Seg_list_info['maxmum_age'];?>,'<?php echo $RecCampaign_Seg_list_info['gender'];?>',<?php echo $RecCampaign_Seg_list_info['income'];?>,document.signupForm3.zipcode.value,document.signupForm3.zipcoderadious.value,'<?php echo $shddate2;?>','');
	   <?php } else {?>
GetListedRecords('<?php echo $CampaignID;?>');
<?php } ?>
	  </script>
	 
     <?php include('includes/footer.php'); ?>