<?php
include_once('includes/session.php');  
include('includes/functions.php');
 
 if($_SESSION['campaign']['sendimmediately']=='1')
 $schedule_date=date('Y:m:d H:i:s');
else
{
$date_format1=explode("/",$_SESSION['campaign']['schedule_date']);
$date_format2=$date_format1['2']."-".$date_format1['0']."-".$date_format1['1'];
 $schedule_date=$date_format2." ".$_SESSION['campaign']['schedule_time'].":00:00"; 
} 

 
 $insertCampaignInfoQry=sprintf("insert into tbl_campaigns(clientid,campaign_name,subject_line,category_option,template_selection,destination_url,  	heading,sub_heading,text_content,contact_info,main_image,clickble_image,twitter_link,facebook_link,sending_option,  	schedule_date,status,date_created) values(%d,'%s','%s',%d,%d,'%s','%s','%s','%s','%s','%s','%s','%s','%s',%d,'%s',%d,'%s')",$object->stripper($_SESSION['clientid']),$object->stripper($_SESSION['campaign']['compaignname']),$object->stripper($_SESSION['campaign']['subjectline']),$object->stripper($_SESSION['campaign']['intrestAndactivities']),$object->stripper($_SESSION['campaign']['templatename']),$object->stripper($_SESSION['campaign']['destinationurl']),$object->stripper($_SESSION['campaign']['heading']),$object->stripper($_SESSION['campaign']['subheading']),$object->stripper($_SESSION['campaign']['text_content']),$object->stripper($_SESSION['campaign']['contact_info']),$object->stripper($_SESSION['campaign']['main_image']),$object->stripper($_SESSION['campaign']['clickble_image']),$object->stripper($_SESSION['campaign']['twitter_link']),$object->stripper($_SESSION['campaign']['facebook_link']),$object->stripper($_SESSION['campaign']['sendimmediately']),$object->stripper($schedule_date),$object->stripper(1),date('Y:m:d H:i:s'));  
	$insertCampaignInfoRes=$object->ExecuteQuery($insertCampaignInfoQry);
	$Last_inserted_campaign_id=mysql_insert_id();	
if($insertCampaignInfoRes)
{
  $Insert_Seg_listqry=sprintf("insert into tbl_campaign_list_segmentation(campaign_id,  	clientid,area_list,minimum_age,maxmum_age,gender,education,keywords,zipcode,zipcode_miles,sendall_option,random_number,date_created) values(%d,%d,%d,%d,%d,'%s',%d,'%s','%s',%d,%d,'%s','%s')",$object->stripper($Last_inserted_campaign_id),$object->stripper($_SESSION['clientid']),$object->stripper($_SESSION['campaign']['arealist']),$object->stripper($_SESSION['campaign']['minage']),$object->stripper($_SESSION['campaign']['maxage']),$object->stripper($_SESSION['campaign']['gender']),$object->stripper($_SESSION['campaign']['education']),$object->stripper($Intrest_activities1),$object->stripper($_SESSION['campaign']['zipcode']),$object->stripper($_SESSION['campaign']['zipcoderadious']),$object->stripper($_SESSION['campaign']['sendall']),$object->stripper($_SESSION['campaign']['random_number']),date('Y:m:d H:i:s'));  
$Insert_Seg_listRes=$object->ExecuteQuery($Insert_Seg_listqry);
}
if($Insert_Seg_listRes)
{
if(isset($_SESSION['campaign']['CreditCardNumber']) && isset($_SESSION['campaign']['billcountry_id']))
{
 $Insert_Client_bill_Info_qry=sprintf("insert into tbl_billing_details (clientid,  	BillFirstname,BillLastname,BillEmail,BillCity,bill_address,BillState,BillZipcode,BillCountry,BillPhone,CCName,CCTypeID,CCNo,CCExpMon,CCExpYear,CCVNo,date_created) values(%d,'%s','%s','%s','%s','%s','%s','%s',%d,'%s','%s','%s','%s','%s','%s','%s','%s')",$object->stripper($_SESSION['clientid']),$object->stripper($_SESSION['campaign']['billfname']),$object->stripper($_SESSION['campaign']['billlname']),$object->stripper($_SESSION['campaign']['billemail']),$object->stripper($_SESSION['campaign']['billcity']),$object->stripper($_SESSION['campaign']['billingAddress']),$object->stripper($_SESSION['campaign']['billstatetxt']),$object->stripper($_SESSION['campaign']['BillingPostalCode']),$object->stripper($_SESSION['campaign']['billcountry_id']),$object->stripper($_SESSION['campaign']['BillingPhoneNumber']),$object->stripper($_SESSION['campaign']['cartname']),$object->stripper($_SESSION['campaign']['CreditCardType']),$object->stripper($_SESSION['campaign']['CreditCardNumber']),$object->stripper($_SESSION['campaign']['CC_ExpDate_Month']),$object->stripper($_SESSION['campaign']['CC_ExpDate_Year']),$object->stripper($_SESSION['campaign']['card_verification_num']),date('Y:m:d H:i:s')); 
$Insert_Client_bill_Info_Res=$object->ExecuteQuery($Insert_Client_bill_Info_qry);
if($Insert_Client_bill_Info_Res)
{
	unset($_SESSION['campaign']);
	header("location:overview.php?msg=added");
	exit;
}
}
else
{
	unset($_SESSION['campaign']);
	header("location:overview.php?msg=added");
	exit;
}
}

?>