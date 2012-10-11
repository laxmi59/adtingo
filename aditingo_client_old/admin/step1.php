<?php 
$nav=12;
error_reporting(0);
include('includes/functions.php'); 
include_once('includes/adminsessions.php');
include('includes/header.php'); 
include('includes/values.php'); 
$Num_cols="0";

$ClientID=$_REQUEST['ClientID'];
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
	if(isset($_POST['step1submit']))
	{
		if($_POST['compaignname']!="" && $_POST['intrestAndactivities']!='' && $_POST['metropolitian_list']!='')
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
			header("location:step2.php?cid=".base64_encode($CampaignID)."");
			exit;
		}
		}
		else
		{	
			  $insertCampaignInfoQry=sprintf("insert into tbl_campaigns(clientid,campaign_name,subject_line,category_option,status,date_created)
	 values(%d,'%s','%s','%s',%d,'%s')",$object->stripper($_POST['Client_ID']),$object->stripper($_POST['compaignname']),$object->stripper($_POST['subjectline']),$object->stripper($_POST['intrestAndactivities']),'1', date('Y:m:d H:i:s'));
				$insertCampaignInfoRes=$object->ExecuteQuery($insertCampaignInfoQry); 
				$_SESSION['Last_inserted_campaign_id']=mysql_insert_id();	
				if($insertCampaignInfoRes)
				  $Insert_Seg_listqry=sprintf("insert into tbl_campaign_list_segmentation(campaign_id,clientid,area_list,date_created)
 values(%d,%d,%d,'%s')",$object->stripper($_SESSION['Last_inserted_campaign_id']),$object->stripper($_POST['Client_ID']),$object->stripper($_POST['metropolitian_list']),date('Y:m:d H:i:s'));  
				$Insert_Seg_listRes=$object->ExecuteQuery($Insert_Seg_listqry);
		if($insertCampaignInfoRes && $Insert_Seg_listRes)
		{
			unset($_SESSION['campaign']);
			header("location:step2.php?cid=".base64_encode($_SESSION['Last_inserted_campaign_id'])."");
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
                    <td height="20" align="left" class="content-header">Step 1.1: List Segmentation</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>  <form  action="" id="signupForm1" name="signupForm1" method="post" >   
				<input type="hidden" name="Client_ID" id="Client_ID" value="<?php echo $ClientID;?>" />
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
                                <td height="30" colspan="2" align="left" class="table-tab">Campaign Information</td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                                </tr>
                              <tr>
                                <td height="30" align="left"><strong>Campaign Name</strong></td>
                                <td align="left"> 
                                 <input type="text" value="<?php if($RecCampaign_info['campaign_name']!="")
				  echo stripslashes($RecCampaign_info['campaign_name']);
				  else
				  echo  $_SESSION['campaign']['compaignname'];?>"  name="compaignname" id="compaignname" class="textfill" />                  <br/>
                                 <span class="red-normal">
                                 <?php if($compaignname_error!="") echo $compaignname_error;?>
                                 </span></td>
                              </tr>
							  <tr>
                                <td height="30" align="left"><strong>Subject Line </strong></td>
                                <td align="left"> 
                                 <input type="text" value="<?php if($RecCampaign_info['subject_line']!="")
				  echo stripslashes($RecCampaign_info['subject_line']);
				  else
				   echo $_SESSION['campaign']['subjectline'] ;?>"  name="subjectline" id="subjectline" class="textfill"  />
				   <br/>
				 <span class="red-normal">
				 <?php if($subjectline_error!="") echo $subjectline_error;?>
				 </span>				                            </td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Select Category</strong></td>
                                <td align="left"> 
								<select name="intrestAndactivities" id="intrestAndactivities" >
								<option value="">Select Category</option>
                <?php
				if($RecCampaign_info['category_option']!="0")
				$value=$RecCampaign_info['category_option']; 
				 if($_SESSION['campaign']['intrestAndactivities']!="")
				  $value=$_SESSION['campaign']['intrestAndactivities']; 
					echo IntrestAndActivities($value);
		 		  ?>
                        </select>
						
						<br/>
				<span class="red-normal">
				 <?php if($intrestAndactivities_error!="") echo $intrestAndactivities_error;?>
				 </span>						</td>
                              </tr>
                               <tr>
                                <td height="30" colspan="2" align="left" class="table-tab">Select Metropolitan Area<br/>
                                    <!--<span id="errmail" class="errer-mess2"></span>-->                                </td></tr>
							   <tr>
                                 <td height="10" colspan="2" align="left"></td>
						        </tr>
							   <tr>
                                <td height="30" align="left"><strong>Metropolitan Area</strong></td>
                                <td align="left"> 
								<select name="metropolitian_list" id="metropolitian_list">
							   <option value="">Select  Metropolitian Area</option>
         			 <?php 
		  					$mainobj=new main;
							
							  echo $mainobj->GetAllMetropolitianList($RecCampaign_Seg_list_info['area_list']);
		  			 ?>	 </select><br/>
			<span class="red-normal">
		     <?php if($metro_area_error!="") echo $metro_area_error;?>
             </span>								</td>
                              </tr>
							   <tr>
							     <td height="30" align="left">&nbsp;</td>
							     <td align="left"><input type="submit" value="Next" class="button" id="step1submit" name="step1submit"></td>
						        </tr>
							  

			   

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
<?php include('includes/footer.php'); ?>