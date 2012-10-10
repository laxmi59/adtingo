<?php 
$nav=12;
include("includes/adminsessions.php");
include('includes/header.php'); 
include_once('includes/functions.php'); 
//include('includes/dbfiler.php'); 
include_once('includes/values.php'); 
$object=new main();
$Num_cols="0";
$count==0;
if($_REQUEST['cid']!="")
{
	$CampaignID=base64_decode($_REQUEST['cid']);
  	 $SqlCampaign_info="select * from tbl_campaigns where campaign_id=".$CampaignID ; 
	$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
	 $Num_cols=$object->NumRows($ResCampaign_info);
	$RecCampaign_info=$object->FetchArray($ResCampaign_info);

}
 
 
//$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
	if(isset($_POST['submitproduct']))
	{
	
	$sending_options_error="";
			if($_POST['schedule_date']!='')
			{
			$currdate=date('m/d/Y');
			
				if (strtotime($currdate) > strtotime($_POST['schedule_date']))
				 {
					  $sending_options_error="Date should be greater than current date";
				
				}
				
				  else {
							
							$count=$count+1;
							
						}
			
			}
			else
			{
				if($_POST["schedule_date"]=="")
				{
				$_POST["schedule_date"]="";
				$sending_options_error="Schedule Message Date Field Required";
				}
								
			}
		
		
		
		
		if($count>0)
			{
				if($_POST['schedule_date']!="")
				{
				$date_format1=explode("/",$_POST['schedule_date']);
				$date_format2=$date_format1['2']."-".$date_format1['0']."-".$date_format1['1'];
				 $schedule_date=$date_format2; 
				} 
			 	$Insert_seg__List_qry=sprintf("update tbl_campaigns  set schedule_date ='%s' where campaign_id=%d",$object->stripper($schedule_date),$object->stripper($CampaignID)); 
				$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
				header("location:step3.php?cid=".base64_encode($CampaignID)."");
				exit;
			}
	}		
?>
 <script language='javascript' src='js/calendar.js'></script>

  <form  action="" method="post" name="signupForm5" id="signupForm5">   

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
                    <td height="20" align="left" class="content-header">Step 1.2: Delivery</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>  
				
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
                                <td width="3%" height="10" align="left"></td>
                                <td width="97%" height="10" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left" class="table-tab">Schedule Message</td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                                </tr>
                              
							  <tr>
                                <td height="30" align="center" valign="middle"> </td>
                                <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="40%"><strong>Please choose the day you would like your campaign to send.   </strong></td>
                                    <td width=""> <input type="text" name="schedule_date" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?>  id="schedule_date"
				   value="<?php if($RecCampaign_info['schedule_date']!="0000-00-00 00:00:00")
				   {
				   $dateformat=explode(" ",$RecCampaign_info['schedule_date']);
				   $dateformat1=explode("-",$dateformat[0]);
				     $dateformat2=$dateformat1['1']."/".$dateformat1['2']."/".$dateformat1['0'];
				    echo $dateformat2; } else echo $_POST['schedule_date']; ?>" 	  class="w-80"  />&nbsp;
					<?php if($RecCampaign_info['status']==5)
{?> 
					<a href="#"><img src="images/calendar.gif"  title='Calender' width="17" height="19" border="0"></a>
					<?php } else {?>
					 <a href="javascript:show_calendar('signupForm5.schedule_date');" onmouseover="window.status='Date Picker';return true;" onmouseout="window.status='';return true;"><img src="images/calendar.gif"  title='Calender' width="17" height="19" border="0"></a>
					 <?php
					 }?>
					</td>
                                   
                                  </tr>
								  <tr><td colspan="3"><span class="red-normal">
		     <?php if($sending_options_error!="") echo $sending_options_error;?>
			 <?php if($Schedule_Message_error!="") echo $Schedule_Message_error;?>
             </span></td></tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="center" valign="middle"></td>
                                </tr>
                               
							   <tr>
							     <td height="30" align="left">&nbsp;</td>
							     <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                   <tr>
                                     <td><?php /*?><a href="step1.php?cid=<?php echo base64_encode($CampaignID);?>"><?php */?><?php /*?></a><?php */?><input type="button" name="button" id="button" value="back" class="button" onclick="javascript:window.location='step1.php?cid=<?php echo base64_encode($CampaignID);?>'" /></td>
                                     <td>&nbsp;</td>
                                     <td>
									 <?php if($RecCampaign_info['status']==5)
									{?> 
									<a href="step3.php?cid='<?php echo base64_encode($CampaignID);?>'"> <input type="button" value="Next" id="next" class="button" name="next" /></a>
									 <?php } else {?>
									  <input type="submit" value="Next" id="submitproduct" class="button" name="submitproduct" />
									<?php }?>
									 </td>									
                                   </tr>
                                 </table></td>
						        </tr>
							  
                            </table></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
	 </form>
     <?php include('includes/footer.php'); ?>