<?php 
include_once('includes/session.php');
include_once('includes/functions.php'); 
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


//$_SESSION['TotalRecords']=$SearchResult;

}
if(isset($_POST['step3submit_x_x']))
{
	if($_POST['zipcode']!='' && $_POST['zipcoderadious']!='')
		{
			if($Num_cols >0)
			{
			  $Intrest_activities1=implode(",",$_POST['intrest']);
			 $Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set zipcode='%s',zipcode_miles=%d where campaign_id=%d",$object->stripper($_POST["zipcode"]),$object->stripper($_POST["zipcoderadious"]),$object->stripper($CampaignID));  
			$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
			if($Insert_seg__List_Res)
			{
				unset($_SESSION['campaign']);
				header("location:step4.php?cid=".base64_encode($CampaignID)."");
				exit;
			}
			}
		}
		else
		{
			$zipcode_area_error="";
			$specifyzipcode_area_error="";
			if($_POST["zipcode"]=="")
				{
				$zipcode_area_error="Zipcode Required";
				$_SESSION['campaign']['zipcode']="";
				}
				else
				$_SESSION['campaign']['zipcode']=$_POST["zipcode"];
				if($_POST["zipcoderadious"]=="")
				{
				$specifyzipcode_area_error="And Zip Codes Within  field Required";
				$_SESSION['campaign']['zipcoderadious']="";
				}
				else
				$_SESSION['campaign']['zipcoderadious']=$_POST["zipcoderadious"];
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
</head>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->

<!--body-->
 <div class="body">
      <div class="title"><h2>Step 1.4: List Segmentation</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="signupForm3" id="signupForm3">                              
            <div class="grey-box">
                <h3 class="grad-box">Zip Codes</h3>
              <div class="tno-rec"> Total Number Of Records: <strong><?php 
			  $val=array();
			  echo $SearchResult=$object->GetCampaignSearchResult($RecCampaign_Seg_list_info['area_list'],$RecCampaign_Seg_list_info['gender'],$RecCampaign_Seg_list_info['education'],$RecCampaign_Seg_list_info['income'],$RecCampaign_Seg_list_info['keywords'],$RecCampaign_Seg_list_info['minimum_age'],$RecCampaign_Seg_list_info['maxmum_age'],$val);?></strong> </div>
              <dl class="form">
                <dt>Enter Zip Code</dt>
                <dd><input name="zipcode" id="zipcode"    type="text" value="<?php if($RecCampaign_Seg_list_info['zipcode']!="")
			  		echo $RecCampaign_Seg_list_info['zipcode'];?>" />
				<br/>
				<span class="red">
				  <?php if($zipcode_area_error!="") echo $zipcode_area_error;?>
				</span>
				</dd>
			
                <dt>And Zip Codes Within </dt>
                <dd><select name="zipcoderadious" id="zipcoderadious"  >
                <option value="">Select Miles</option>
                 <?php 
				 if($RecCampaign_Seg_list_info['zipcode_miles']!="0")
				   $value=$RecCampaign_Seg_list_info['zipcode_miles']; 
					echo Get_Zipcode_Radious($value);?>
                   
                </select>
				<br/>
				<span class="red">
				  <?php if($specifyzipcode_area_error!="") echo $specifyzipcode_area_error;?>
				</span>
				</dd>
              </dl> 
             </div>
          <a href="step2.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input  src="images/next.gif"  type="image" name="step3submit_x" id="step3submit_x" /><a href="step4.php?Val=<?php echo base64_encode("id");?>&cid=<?php echo base64_encode($CampaignID);?>"><img src="images/skip-the-test.gif" alt="Skip" class="m-left5" /><!--<input src="images/skip-the-test.gif" alt="Skip" class="m-left5"  type="image"   />--></a>
    </form>  
</div>
<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
