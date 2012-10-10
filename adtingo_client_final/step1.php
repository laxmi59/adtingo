<?php 
include_once('includes/session.php');
include('includes/functions.php'); 
include('includes/values.php'); 
$Num_cols="0";
if($_REQUEST['Val']=="")
$_SESSION['Last_inserted_campaign_id']="";
if($_REQUEST['cid']!="" || $_SESSION['Last_inserted_campaign_id']!="")
{
if($_REQUEST['cid']!="")
$CampaignID=base64_decode($_REQUEST['cid']);
else
$CampaignID=$_SESSION['Last_inserted_campaign_id'];

 $SqlCampaign_info="select * from tbl_campaigns where campaign_id=".$CampaignID ; 
$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
$Num_cols=$object->NumRows($ResCampaign_info);
$RecCampaign_info=$object->FetchArray($ResCampaign_info);
 $SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$CampaignID ; 
$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
$Num_cols=$object->NumRows($ResCampaign_Seg_list_info);
$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);
$object=new main();

}
	if(isset($_POST['step1submit_x']))
	{
		if($_POST['compaignname']!="" && $_POST['subjectline']!='' && $_POST['intrestAndactivities']!='' && $_POST['metropolitian_list']!='')
		{
		if($Num_cols >0)
		{
		$Insert_Campaign__info_qry=sprintf("update tbl_campaigns  set campaign_name='%s', subject_line='%s' ,category_option=%d where campaign_id =%d",$object->stripper($_POST['compaignname']),$object->stripper($_POST['subjectline']),$object->stripper($_POST['intrestAndactivities']),$object->stripper($CampaignID)); 
		$Insert_Campaign__info_Res=$object->ExecuteQuery($Insert_Campaign__info_qry);
		$Insert_seg__List_qry=sprintf("update tbl_campaign_list_segmentation  set area_list=%d where campaign_id=%d",$object->stripper($_POST['metropolitian_list']),$object->stripper($CampaignID)); 
		$Insert_seg__List_Res=$object->ExecuteQuery($Insert_seg__List_qry);  
		if($Insert_Campaign__info_Res && $Insert_seg__List_Res)
		{
			unset($_SESSION['campaign']);
			header("location:step5.php?cid=".base64_encode($CampaignID)."");
			exit;
		}
		}
		else
		{	
			  $insertCampaignInfoQry=sprintf("insert into tbl_campaigns(clientid,campaign_name,subject_line,category_option,status,date_created)
	 values(%d,'%s','%s','%s',%d,'%s')",$object->stripper($_SESSION['clientid']),$object->stripper($_POST['compaignname']),$object->stripper($_POST['subjectline']),$object->stripper($_POST['intrestAndactivities']),'1', date('Y:m:d H:i:s'));
				$insertCampaignInfoRes=$object->ExecuteQuery($insertCampaignInfoQry); 
				$_SESSION['Last_inserted_campaign_id']=mysql_insert_id();	
				if($insertCampaignInfoRes)
				  $Insert_Seg_listqry=sprintf("insert into tbl_campaign_list_segmentation(campaign_id,clientid,area_list,date_created)
 values(%d,%d,%d,'%s')",$object->stripper($_SESSION['Last_inserted_campaign_id']),$object->stripper($_SESSION['clientid']),$object->stripper($_POST['metropolitian_list']),date('Y:m:d H:i:s'));  
				$Insert_Seg_listRes=$object->ExecuteQuery($Insert_Seg_listqry);
		if($insertCampaignInfoRes && $Insert_Seg_listRes)
		{
			unset($_SESSION['campaign']);
			header("location:step5.php?cid=".base64_encode($_SESSION['Last_inserted_campaign_id'])."");
			exit;
		}
		
		}
		}
		
		else
		{
			$metro_area_error="";
			$compaignname_error="";
			$subjectline_error="";
			$intrestAndactivities_error="";
			if($_POST["compaignname"]=="")
			{
			$compaignname_error="Campaign Name Required";
			$_SESSION['campaign']['compaignname']="";
			}
			else
			$_SESSION['campaign']['compaignname']=$_POST["compaignname"];
			if($_POST["subjectline"]=="")
			{
			$subjectline_error="Subject Line Required";
			$_SESSION['campaign']['subjectline']="";
			}
			else
			$_SESSION['campaign']['subjectline']=$_POST["subjectline"];
			if($_POST["intrestAndactivities"]!="")
			{
			$_SESSION['campaign']['intrestAndactivities']=$_POST["intrestAndactivities"];
			}
			if($_POST["intrestAndactivities"]=="")
			{
			$intrestAndactivities_error="Category Required";
			$_SESSION['campaign']['intrestAndactivities']="";
			}
			else
			$_SESSION['campaign']['intrestAndactivities']=$_POST["intrestAndactivities"];
			
			if($_POST["metropolitian_list"]=="")
			{
			$metro_area_error="Metropolitan Area Required";
			$_SESSION['campaign']['arealist']="";
			}
			else
			$_SESSION['campaign']['arealist']=$_POST["metropolitian_list"];
		} 
		//print_r($_SESSION); 
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Step 1.1: List Segmentation"?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script type="text/javascript" src="js/javascript.js"></script>
<?php include "includes/google_analytic.php";?>
</head>
<body>
<!--header start-->
<?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
      <div class="title"><h2>Step 1.1: List Segmentation</h2><img src="images/step1.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" id="signupForm1" name="signupForm1" method="post" >                              
            <div class="grey-box">
              <h3 class="grad-box">Campaign Information</h3> 
              <dl class="form">
                <dt>Campaign Name</dt>
                <dd><input   name="compaignname" id="compaignname" tabindex="2"  type="text"
				 value="<?php if($RecCampaign_info['campaign_name']!="")
				  echo stripslashes($RecCampaign_info['campaign_name']);
				  else
				  echo  $_SESSION['campaign']['compaignname'];?>"  />
				<br/>
				 <span class="red">
		     <?php if($compaignname_error!="") echo $compaignname_error;?>
             </span>
				</dd>
                <dt>Subject Line </dt>
                <dd><input   name="subjectline" id="subjectline"  tabindex="2" type="text" 
				value="<?php if($RecCampaign_info['subject_line']!="")
				  echo stripslashes($RecCampaign_info['subject_line']);
				  else
				   echo $_SESSION['campaign']['subjectline'] ;?>" />
				<br/>
				 <span class="red">
				 <?php if($subjectline_error!="") echo $subjectline_error;?>
				 </span>
				</dd>
                <dt>Select Category</dt>
                <dd><select name="intrestAndactivities" id="intrestAndactivities"  tabindex="2"> 
				<option value="">Select Category</option>
                <?php
				if($RecCampaign_info['category_option']!="0")
				$value=$RecCampaign_info['category_option']; 
				 if($_SESSION['campaign']['intrestAndactivities']!="")
				  $value=$_SESSION['campaign']['intrestAndactivities']; 
					echo IntrestAndActivities_dropdown($value);
		 		  ?>
				</select>
				<br/>
				<span class="red">
				 <?php if($intrestAndactivities_error!="") echo $intrestAndactivities_error;?>
				 </span>
				</dd>  
              </dl> 
                <h3 class="grad-box">Select Metropolitan Area</h3>
                <dl class="form">
                    <dt>Metropolitan Area</dt>
                    <dd>
                     <select name="metropolitian_list" id="metropolitian_list" tabindex="2" <?php if($RecCampaign_info['status']==5)
{?>disabled="disabled" <?php } ?> >
					<option value="">Select Metropolitan Area </option>
					<?php 
							if($RecCampaign_Seg_list_info['area_list']!="0")
							$value=$RecCampaign_Seg_list_info['area_list']; 
							 if($_SESSION['campaign']['arealist']!="")
							$value=$_SESSION['campaign']['arealist'];
		  					$mainobj=new main;							
							echo $mainobj->GetAllMetropolitianList($value);
		  			 ?>	
            </select><br/>
			<?php if($RecCampaign_info['status']==5)
{?>
			<input type="hidden" name="metropolitian_list" id="metropolitian_list" value="<?php echo $RecCampaign_Seg_list_info['area_list'];?>" />
			<?php }?>
			<span class="red">
		     <?php if($metro_area_error!="") echo $metro_area_error;?>
             </span>
		</dd>    
             </dl>
             </div>
           <div class="button_left">
          <input   src="images/next.gif"  type="image" name="step1submit" id="step1submit" />
        </div>
    </form>  
</div>
<!--body end-->
<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
