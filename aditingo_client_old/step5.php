<?php
include_once('includes/session.php');  
include_once('includes/functions.php'); 
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
	if(isset($_POST['step5submit_x_x']))
	{
	
	$sending_options_error="";
			if($_POST['schedule_date']!='')
			{
			$currdate=date('m/d/Y');
			
				if ($currdate > $_POST['schedule_date'])
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
				header("location:step2.php?cid=".base64_encode($CampaignID)."");
				exit;
			}
	}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script language='javascript' src='js/calendar.js'></script>
<script language='javascript' src='js/javascript.js'></script>
</head>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Step 1.2: Delivery</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="signupForm5" id="signupForm5">                              
            <div class="grey-box">
            <h3 class="grad-box">Schedule Message</h3>            
                <div class="small-form"> 
               	  Please choose the day you would like your campaign to send.  
                  <input type="text" name="schedule_date" id="schedule_date"
				   value="<?php if($RecCampaign_info['schedule_date']!="")
				   {
				   $dateformat=explode(" ",$RecCampaign_info['schedule_date']);
				   $dateformat1=explode("-",$dateformat[0]);
				     $dateformat2=$dateformat1['1']."/".$dateformat1['2']."/".$dateformat1['0'];
				    echo $dateformat2; } ?>" 	  class="w-80"  /><a href="javascript:show_calendar('signupForm5.schedule_date');" onmouseover="window.status='Date Picker';return true;" onmouseout="window.status='';return true;"><img src="images/calendar.gif"  title='Calender' width="17" height="19" border="0"></a>
                  
                   
                  
               </div> 
			    <span class="red">
		     <?php if($sending_options_error!="") echo $sending_options_error;?>
			 <?php if($Schedule_Message_error!="") echo $Schedule_Message_error;?>
             </span>
             </div>

          <a href="step1.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" name="step5submit_x" id="step5submit_x" /> 

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
