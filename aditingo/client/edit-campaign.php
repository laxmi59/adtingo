<?php 
error_reporting(0);
include('includes/functions.php'); 
include_once('includes/session.php'); 
include('includes/values.php'); 
if($_REQUEST['cid']!="")
{
$Campaign_ID=base64_decode($_REQUEST['cid']);
 $SqlCampaign_info="select *,date_format(schedule_date,'%d %b,  %Y') as date from tbl_campaigns where campaign_id=".$Campaign_ID ; 
$ResCampaign_info=$object->ExecuteQuery($SqlCampaign_info);
$Num_cols=$object->NumRows($ResCampaign_info);
$RecCampaign_info=$object->FetchArray($ResCampaign_info);

$SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$Campaign_ID ; 
$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
$Num_cols=$object->NumRows($ResCampaign_Seg_list_info);
$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);
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
      <div class="title"><h2><?php echo stripslashes($RecCampaign_info['campaign_name']);?></h2></div> 
 
      <form  action="payment-gateway.php" method="post">                              
            <div class="grey-box">
           	<h3 class="grad-box">Step 1.1 List Segmentation <a href="step1.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ><img src="images/edit.gif" alt="Edit this campaign" class="edit-btn" border="0"  /></a></h3> 
			<dl class="small-form">
             <dt>Campaign Name</dt>
             <dd><?php echo stripslashes($RecCampaign_info['campaign_name']);?></dd>
             <dt>Subject Line</dt>
             <dd><?php echo stripslashes($RecCampaign_info['subject_line']);?></dd>
			 <dt>Category</dt>
             <dd><?php echo $Intrest_and_activitise[$RecCampaign_info['category_option']]; ?></dd>               
                <dt>Metropolitan Area</dt>
                <dd>
					<?php 
					if($RecCampaign_Seg_list_info['area_list']!="")
					$area_list=$RecCampaign_Seg_list_info['area_list'];
					$object=new main();
					echo $object->Getmetropolitianareaname($area_list);
					?>
				</dd>               
          </dl>
           <h3 class="grad-box">Step 1.2 Delivery<a href="step5.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ><img src="images/edit.gif" alt="Edit this campaign" class="edit-btn" border="0"  /></a></h3> 
          <dl class="small-form">
             <dt>Send Now</dt>
             <dd><?php if($RecCampaign_info['sending_option']=='1')
			 echo "YES";
			 else if($RecCampaign_info['sending_option']=='21')
			 echo "No";
			 else
			 echo "N/A"; ?>
			 </dd>
             <dt>Schedule Message</dt>
             <dd><?php if($RecCampaign_info['sending_option']=='2')
			 echo $RecCampaign_info['date'];
			 else
			 echo "N/A";
			 ?>
			 </dd>
                            
         </dl>  
          <h3 class="grad-box">Step 1.3 List Segmentation <a href="step2.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ><img src="images/edit.gif" alt="Edit this campaign" class="edit-btn" border="0"  /></a></h3> 
          <dl class="small-form">
             <dt>Minimum Age</dt>
             <dd><?php if($RecCampaign_Seg_list_info['minimum_age']!="0") { echo $RecCampaign_Seg_list_info['minimum_age'];?> years<?php } else echo "N/A";?></dd> 
              <dt>Maximum Age</dt>
             <dd><?php if($RecCampaign_Seg_list_info['maxmum_age']!="0") { echo $RecCampaign_Seg_list_info['maxmum_age'];?> years<?php } else echo "N/A";?></dd> 
              <dt>Gender</dt>
             <dd><?php if($RecCampaign_Seg_list_info['gender']=='male')
			  			echo "Male";
						else if($RecCampaign_Seg_list_info['gender']=='female')
			  			echo "Female";
						else if($RecCampaign_Seg_list_info['gender']=='both')
						echo "Both";
						else 
						echo "N/A";
			  ?></dd> 
             
              <dt>Education</dt>
             <dd><?php 
			 if($RecCampaign_Seg_list_info['education']!="0")
			 echo $education_array[$RecCampaign_Seg_list_info['education']];
			 else 
			 echo "N/A";
			 ?></dd> 
             
             <dt>Keywords/Activities</dt>
             <dd>	 <?php				 	
					 $intrest_value= $RecCampaign_Seg_list_info['keywords'];
					 if($intrest_value!="")
					 {
					 $intrest_value1=explode(",",$intrest_value);
					 echo IntrestAndActivities_Display($intrest_value1);
					 }
					 else 
					 echo "N/A";
					?></dd>               
          </dl>
          
          <h3 class="grad-box">Step 1.4 List Segmentation <a href="step3.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ><img src="images/edit.gif" alt="Edit this campaign" class="edit-btn" border="0"  /></a></h3> 
          <dl class="small-form">
             <dt>Enter Zip Code</dt>
             <dd><?php
			 	if($RecCampaign_Seg_list_info['zipcode']!="")
			  		echo $RecCampaign_Seg_list_info['zipcode'];
			  	else
					echo "N/A";
			  ?></dd>   
              <dt>specified radius </dt>
             <dd><?php if($RecCampaign_Seg_list_info['zipcode_miles']!="0") { echo $Zipcode_Radious[$RecCampaign_Seg_list_info['zipcode_miles']];?> Miles <?php } else echo "N/A"; ?></dd>           
          </dl>
          
          <h3 class="grad-box">Step 1.5 List Segmentation <a href="step4.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ><img src="images/edit.gif" alt="Edit this campaign" class="edit-btn" border="0"  /></a></h3> 
          <dl class="small-form">
             <dt>Send to all</dt>
             <dd><?php
			 		 if($RecCampaign_Seg_list_info['sendall_option']=='1') 
			 			echo "Yes";
					  else if($RecCampaign_Seg_list_info['sendall_option']=='2') 
			 			echo "NO";
					  else
					   echo "N/A"; ?>
				</dd> 
			 <dt>Random Number</dt>
             <dd><?php if($RecCampaign_Seg_list_info['sendall_option']=='2') 
			 echo $RecCampaign_Seg_list_info['random_number'];
			 else
			 echo "N/A";
			 ;?> </dd>          
          </dl>
          
          <!--<h3 class="grad-box">Campaign Information<a href="campaign-information.php"  ><img src="images/edit.gif" alt="Edit this campaign" class="edit-btn" border="0"  /></a></h3>--> 
          
                
          <h3 class="grad-box">Campaign Creation <a href="campaign-information.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ><img src="images/edit.gif" alt="Edit this campaign" class="edit-btn" border="0"  /></a></h3> 
          <dl class="small-form">
             <dt>Selected Template</dt>
			  <dd><?php if($RecCampaign_info['template_selection']=='1') echo "Template 1";
			  			else if($RecCampaign_info['template_selection']=='2') echo "Template 2";
						else if($RecCampaign_info['template_selection']=='3') echo "Template 3";
						else
						echo "N/A"; ?>
			  </dd>
                         </dl>
<h3 class="grad-box">Campaign Information <a href="add-own-template.php?cid=<?php echo base64_encode($RecCampaign_info['campaign_id']);?>"  ><img src="images/edit.gif" alt="Edit this campaign" class="edit-btn" border="0"  /></a></h3> 
          <dl class="small-form">
             <dt>Destination URL</dt>
			  <dd>
				<?php
					if($RecCampaign_info['destination_url']!="")
					echo $RecCampaign_info['destination_url'];
					else
					echo "N/A";
				 ?>
			  </dd>
			  <dt>Heading</dt>
			  <dd>
				<?php
					if($RecCampaign_info['destination_url']!="")
					echo $RecCampaign_info['destination_url'];
					else
					echo "N/A";
				 ?>
			  </dd>
			  <dt>Sub Heading</dt>
			  <dd>
				<?php
					if($RecCampaign_info['destination_url']!="")
					echo $RecCampaign_info['destination_url'];
					else
					echo "N/A";
				 ?>
			  </dd>
			  <dt>Text content</dt>
			  <dd>
				<?php
					if($RecCampaign_info['text_content']!="")
					echo $RecCampaign_info['text_content'];
					else
					echo "N/A";
				 ?>
			  </dd>
			  <dt>Coantact Info</dt>
			  <dd>
				<?php
					if($RecCampaign_info['contact_info']!="")
					echo $RecCampaign_info['contact_info'];
					else
					echo "N/A";
				 ?>
			  </dd>
			  <dt>Link to Twitter Page</dt>
			  <dd>
				<?php
					if($RecCampaign_info['twitter_link']!="")
					echo $RecCampaign_info['twitter_link'];
					else
					echo "N/A";
				 ?>
			  </dd>
			  <dt>Link to Facebook Page</dt>
			  <dd>
				<?php
					if($RecCampaign_info['facebook_link']!="")
					echo $RecCampaign_info['facebook_link'];
					else
					echo "N/A";
				 ?>
			  </dd>
             </dl>       
      
          
                     
         
         
             </div>
          <!--<a href="step4.php"><img  src="images/test-define-delivery.gif" alt="Define Delivery"  border="0" /></a>-->
 

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
