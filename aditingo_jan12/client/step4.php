<?php 
error_reporting(0);
include_once('includes/functions.php'); 
//include('includes/dbfiler.php'); 
include_once('includes/values.php'); 
$object=new main();
$Num_cols="0";
$count=0;
if($_REQUEST['cid']!="")
{
	$CampaignID=base64_decode($_REQUEST['cid']);
  	$SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$CampaignID ; 
	$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
	$Num_cols=$object->NumRows($ResCampaign_Seg_list_info);
	$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);

}
//$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
	if(isset($_POST['step4submit_x_x']))
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
		}
		else
		{
			if($_POST['random_number']!='')
			{
				$_SESSION['campaign']['random_number']=$_POST['random_number'];
				if (is_numeric($_POST['random_number']))
				 {
					  if($_POST['random_number']<=35) 
					  	{
						$count=$count+1;
						}
						else
						$Random_num_error="Specify Number should be less than Total number of records";
				
				}
				 else {
					$Random_num_error="Specify Number should accept numbers only";
				}
			
			}
			else
			{
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script src="js/javascript.js" type="text/javascript"></script>
 </head>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Step 1.5: List Segmentation</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="signupForm4" id="signupForm4">                              
            <div class="grey-box">
                <h3 class="grad-box">Select The Option To Send Campaign</h3>
              <div class="tno-rec">  Total Number Of Records: <strong>35</strong> </div>
              <div class="small-form">
                <input name="sendall" id="sendall" type="radio" value="1" onclick="return sendallcheck();" <?php if($RecCampaign_Seg_list_info['sendall_option']=='1') { ?> checked="checked" <?php } ?> /> Send to All  <br />
 				<input name="sendall" id="send_random" type="radio" value="2" onclick="return sendallcheck();" <?php if($RecCampaign_Seg_list_info['sendall_option']=='2' || $_SESSION['campaign']['sendall']=='2') { ?> checked="checked" <?php } ?> /> Specify Number <input name="random_number" id="random_number" type="text" class="w-60"  value="<?php if($RecCampaign_Seg_list_info['random_number']!="0") echo $RecCampaign_Seg_list_info['random_number'];?>" 
	<?php if($RecCampaign_Seg_list_info['sendall_option']=='1')	 {?> disabled="disabled" <?php }?>		
				/> 
              </div> 
			  <span class="red">
		     <?php if($Random_num_error!="") echo $Random_num_error;?>
             </span>
             </div>

          <a href="step3.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" name="step4submit_x" id="step4submit_x" /> 

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
