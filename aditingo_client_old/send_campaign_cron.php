<?php
include_once('/var/www/client/includes/functions_cron.php'); 
include_once('/var/www/client/includes/values_cron.php'); 
$date=date("Y:m:d H:i:s");	
$sitepath="/var/www/client";
 $GetAllCampaignRecordsQry="select * from tbl_campaigns where schedule_date <='".$date."' and status=2"; 
$GetAllCampaignRecordsRes=$object->ExecuteQuery($GetAllCampaignRecordsQry);
$Num_cols=$object->NumRows($GetAllCampaignRecordsRes);

while($GetAllCampaignRecordsRec=$object->FetchArray($GetAllCampaignRecordsRes))
{
 $SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation
		where campaign_id=".$GetAllCampaignRecordsRec['campaign_id']; 
		$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
		 $object->NumRows($ResCampaign_Seg_list_info);
		$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);

	
$cstb = array("title"=>$GetAllCampaignRecordsRec['heading'], "subject"=>$GetAllCampaignRecordsRec['subject_line'], "fromEmail"=>"members@adtingomail.com", "fromName"=>"Adtingo", "toEmail"=>"members@adtingomail.com", "toName"=>"Adtingo", "replyToEmail"=>"reply@adtingomail.com", "replyToName"=>"Adtingo", encoding=>"quoted-printable","Charset"=>"ISO-8859-1", "trackType"=>"ALL", "openTrackType"=>"HTML", "clickStreamType"=>"ALL", "brandID"=>"1","enabled"=>"TRUE" );	
	try{	
		if($GetAllCampaignRecordsRec['template_selection']=='1')
		{
		$fileName = $sitepath."/Campaign_templates/Campaign_template1/template1.html";
		$TempID =1;
		}
		else if($GetAllCampaignRecordsRec['template_selection']=='2')
		{
		  $fileName = $sitepath."/Campaign_templates/Campaign_template2/template2.html";
		$TempID =2;
		}
			if(file_exists($fileName))
		{
			$emailText = file_get_contents($fileName); 
		}
		
		 $GetTemplateinfoSql="select * from tbl_email_template_content where TemplateId=".$TempID ; 
		$GetTemplateinfoQry=$object->ExecuteQuery($GetTemplateinfoSql);
		$GetTemplateinfoRec=$object->FetchArray($GetTemplateinfoQry);
		
		 $desinationurl = nl2br($GetAllCampaignRecordsRec['destination_url']);
		 $campaignHeading = stripslashes($GetAllCampaignRecordsRec['heading']);
		 $campaignSubheading = stripslashes($GetAllCampaignRecordsRec['sub_heading']);
		 $text_content = stripslashes($GetAllCampaignRecordsRec['text_content']);
		 $Contact_info = nl2br($GetAllCampaignRecordsRec['contact_info']);
		 $main_image = $GetAllCampaignRecordsRec['main_image'];
		 $clickble_image = $GetAllCampaignRecordsRec['clickble_image'];
		 $twitter_link = nl2br($GetAllCampaignRecordsRec['twitter_link']);
		 $facebook_link = nl2br($GetAllCampaignRecordsRec['facebook_link']);
		 
		  $localdealtitle = stripslashes($GetTemplateinfoRec['Title']);
		  $localdealdesc = stripslashes($GetTemplateinfoRec['Description']);
		  if($GetTemplateinfoRec['paragraph1']!="")
		  $listofthinks_to_come1 = "<li>".stripslashes($GetTemplateinfoRec['paragraph1'])."</li>";
		  if($GetTemplateinfoRec['paragraph2']!="")	    
		  $listofthinks_to_come2 = "<li>".stripslashes($GetTemplateinfoRec['paragraph2'])."</li>";	
		  if($GetTemplateinfoRec['paragraph3']!="")
		  $listofthinks_to_come3 = "<li>".stripslashes($GetTemplateinfoRec['paragraph3'])."</li>";
		  if($GetTemplateinfoRec['paragraph4']!="")	
		  $listofthinks_to_come4 = "<li>".stripslashes($GetTemplateinfoRec['paragraph4'])."</li>";
		  if($GetTemplateinfoRec['paragraph5']!="")	
		  $listofthinks_to_come5 = "<li>".stripslashes($GetTemplateinfoRec['paragraph5'])."</li>";
		  if($GetTemplateinfoRec['paragraph6']!="")		    
		  $listofthinks_to_come6 = "<li>".stripslashes($GetTemplateinfoRec['paragraph6'])."</li>";
		  if($GetTemplateinfoRec['paragraph7']!="")	
		  $listofthinks_to_come7 = "<li>".stripslashes($GetTemplateinfoRec['paragraph7'])."</li>";	
			
		  $Linkname1 = stripslashes($GetTemplateinfoRec['linkname1']);
		  $Linkname2 = stripslashes($GetTemplateinfoRec['linkname2']);
		  $Linkname3 = stripslashes($GetTemplateinfoRec['linkname3']);
		  $Linkname4 = stripslashes($GetTemplateinfoRec['linkname4']);
		  $Linkname5 = stripslashes($GetTemplateinfoRec['linkname5']);
		  $Linkname6 = stripslashes($GetTemplateinfoRec['linkname6']);
		  $Linkname7 = stripslashes($GetTemplateinfoRec['linkname7']);
		  $Linkname8 = stripslashes($GetTemplateinfoRec['linkname8']);
		  $Linkname9 = stripslashes($GetTemplateinfoRec['linkname9']);
		  $Linkname10 = stripslashes($GetTemplateinfoRec['linkname10']);
		  
		  $linkUrl1 = stripslashes($GetTemplateinfoRec['link_url1']);
		  $linkUrl2 = stripslashes($GetTemplateinfoRec['link_url2']);
		  $linkUrl3 = stripslashes($GetTemplateinfoRec['link_url3']);
		  $linkUrl4 = stripslashes($GetTemplateinfoRec['link_url4']);
		  $linkUrl5 = stripslashes($GetTemplateinfoRec['link_url5']);
		  $linkUrl6 = stripslashes($GetTemplateinfoRec['link_url6']);
		  $linkUrl7 = stripslashes($GetTemplateinfoRec['link_url7']);
		  $linkUrl8 = stripslashes($GetTemplateinfoRec['link_url8']);
		  $linkUrl9 = stripslashes($GetTemplateinfoRec['link_url9']);
		  $linkUrl10 = stripslashes($GetTemplateinfoRec['link_url10']);
		 
		 $today = date("F j, Y");
		 $object=new main();
		$GetCatName=$object->Getmetropolitianareaname($RecCampaign_Seg_list_info['area_list']);
		$mailMessage = str_replace("#DESTURL#", "$desinationurl", "$emailText");
		$mailMessage = str_replace("#HEADING#", "$campaignHeading", "$mailMessage");
		$mailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$mailMessage");
		$mailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$mailMessage"); 
		$mailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$mailMessage");
		$mailMessage = str_replace("#MAINIMAGE#", "$main_image", "$mailMessage");
		$mailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$mailMessage");
		$mailMessage = str_replace("#TWITTERLINK#", "$twitter_link", "$mailMessage");
		$mailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link", "$mailMessage");
		$mailMessage = str_replace("#DATECREATED#", "$today", "$mailMessage"); 
		$mailMessage = str_replace("#CATEGORYNAME#", "$GetCatName", "$mailMessage");    
		$textContent="";
		
		$mailMessage = str_replace("#TITLE#", "$localdealtitle", "$mailMessage");
			$mailMessage = str_replace("#LOCALDESCRIPTION#", "$localdealdesc", "$mailMessage");
			
			$mailMessage = str_replace("#PARAGRAPH1#", "$listofthinks_to_come1", "$mailMessage"); 
			$mailMessage = str_replace("#PARAGRAPH2#", "$listofthinks_to_come2", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH3#", "$listofthinks_to_come3", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH4#", "$listofthinks_to_come4", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH5#", "$listofthinks_to_come5", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH6#", "$listofthinks_to_come6", "$mailMessage");
			$mailMessage = str_replace("#PARAGRAPH7#", "$listofthinks_to_come7", "$mailMessage");
			
			$mailMessage = str_replace("#LINKNAME1#", "$Linkname1", "$mailMessage"); 
			$mailMessage = str_replace("#LINKNAME2#", "$Linkname2", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME3#", "$Linkname3", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME4#", "$Linkname4", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME5#", "$Linkname5", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME6#", "$Linkname6", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME7#", "$Linkname7", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME8#", "$Linkname8", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME9#", "$Linkname9", "$mailMessage");
			$mailMessage = str_replace("#LINKNAME10#", "$Linkname10", "$mailMessage");
			
			$mailMessage = str_replace("#LINKURL1#", "$linkUrl1", "$mailMessage"); 
			$mailMessage = str_replace("#LINKURL2#", "$linkUrl2", "$mailMessage");
			$mailMessage = str_replace("#LINKURL3#", "$linkUrl3", "$mailMessage");
			$mailMessage = str_replace("#LINKURL4#", "$linkUrl4", "$mailMessage");
			$mailMessage = str_replace("#LINKURL5#", "$linkUrl5", "$mailMessage");
			$mailMessage = str_replace("#LINKURL6#", "$linkUrl6", "$mailMessage");
			$mailMessage = str_replace("#LINKURL7#", "$linkUrl7", "$mailMessage");
			$mailMessage = str_replace("#LINKURL8#", "$linkUrl8", "$mailMessage");
			$mailMessage = str_replace("#LINKURL9#", "$linkUrl9", "$mailMessage");
			$mailMessage = str_replace("#LINKURL10#", "$linkUrl10", "$mailMessage");
			
		
 	$pcode=$RecCampaign_Seg_list_info['zipcode'];
	$miles=$RecCampaign_Seg_list_info['zipcode_miles'];	
	  $GetLogLattitudedetailsqry="select  distinct  LATITUDE,LONGITUDE from zip_code where ZIP_CODE=".$pcode."";
	$GetLogLattitudedetailsRes=$object->ExecuteQuery($GetLogLattitudedetailsqry);
	   $object->NumRows($GetLogLattitudedetailsRes); 
	$tt=$object->FetchArray($GetLogLattitudedetailsRes);

  $sel="select distinct ZIP_CODE ,LATITUDE,LONGITUDE, (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) as distance from zip_code  where (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) 
< $miles order by distance";
	$GetAllZipcodesres=$object->ExecuteQuery($sel);
	$zipcodedb=array();
	  $object->NumRows($GetAllZipcodesres); 
	while($GetAllZipcodesrec=$object->FetchArray($GetAllZipcodesres))
	{
			$zipcodedb[]=$GetAllZipcodesrec['ZIP_CODE'];
	}
	
$SearchResult=$object->GetAllMemberRedordsinfo($RecCampaign_Seg_list_info['area_list'],$RecCampaign_Seg_list_info['gender'],$RecCampaign_Seg_list_info['education'],$RecCampaign_Seg_list_info['income'],$RecCampaign_Seg_list_info['keywords'],$RecCampaign_Seg_list_info['minimum_age'],$RecCampaign_Seg_list_info['maxmum_age'],$zipcodedb,$RecCampaign_Seg_list_info['sendall_option'],$RecCampaign_Seg_list_info['random_number']);
	
	$AllemailIds=array();
	$firstname=array();
	$Lastname=array();
	 
	while($RecSearch_result=$object->FetchArray($SearchResult))
	{
		$AllemailIds[]=$RecSearch_result['email_address'];
		$firstname[]=$RecSearch_result['full_name'];
		$Lastname[]=$RecSearch_result['last_name'];
	}
	
		$tt=array();
		if(count($AllemailIds)>0)
		{
		for($i=0;$i<count($AllemailIds);$i++) {		
  		$tt[$i] = array("address" => $AllemailIds[$i],"fname"=> $firstname[$i],"lname"=> $Lastname[$i]);
		//$tt[$i] = array("address" => $AllemailIds[$i]);
		}	
		}

		$getpaymentcarddeatails=$object->getpaymentdetails($GetAllCampaignRecordsRec['clientid']);
		$paymentdetailsarray=explode("@@@",$getpaymentcarddeatails);
		
		$totalemailsids=count($AllemailIds);
		$totalAmountBilled=($totalemailsids*1);
		  $Paymentststus=$object->Makepayment($totalAmountBilled,$paymentdetailsarray[0],$paymentdetailsarray[1]);  
		  $PaymentststusResult=explode("@@@@",$Paymentststus);
if($PaymentststusResult[0]=="success")
{	
	$wsdl = 'http://api.stormpost.datranmedia.com/services/SoapRequestProcessor?wsdl';
		
		$soapClient = new SoapClient($wsdl);
		$login = new SOAPHeader($wsdl, 'username', 'soap@conglomeratenetwork.com');
		$password = new SOAPHeader($wsdl, 'password', 'Password2');
		$headers = array($login, $password);
		$soapClient->__setSOAPHeaders($headers);
		 $cst_res = $soapClient->__call("createSendTemplate", array($cstb,$textContent,$mailMessage));
		$smft_res =  $soapClient->__call("sendMessagesFromTemplate", array($cst_res, $tt));
		$UpdateCampaignIdqry="update tbl_campaigns set template_id =".$cst_res." where campaign_id=".$GetAllCampaignRecordsRec[campaign_id]."";
		$UpdateCampaignIdRes=$object->ExecuteQuery($UpdateCampaignIdqry);
		$UpdateCampaignIdqry="update tbl_campaigns set  mailing_ID =".$smft_res.",status=3 where campaign_id=".$GetAllCampaignRecordsRec[campaign_id].""; 
		$UpdateCampaignIdRes=$object->ExecuteQuery($UpdateCampaignIdqry);
		
		
		echo "<br>Compaign created and sent to ".sizeof($AllemailIds)." mails successfully";
		//$ins_campaigns=mysql_query("insert into `campaign` (`cid`, `members`, `mid`, `date`)values('".$cst_res."', '".sizeof($arr)."', '".$smft_res."', now())");
		//$ins_report=mysql_query("insert into `reports` (`cid`, `mid`)values('".$cst_res."', '".$smft_res."')");
	
	/* INSERTING THE CAMPAIGN DETAILS INTO THE WP-POST TABLE IN THE WORDPRESS START HERE*/
	
	if($GetAllCampaignRecordsRec['template_selection']==1)
 	 $TemplateName =$sitepath."/Campaign_templates/Post_Template1.htm";	
	 else if($GetAllCampaignRecordsRec['template_selection']==2)
		{
		  $TemplateName = $sitepath."/Campaign_templates/Post_template2.html";
		}
	 
	
		if($TemplateName!="")
		{
			$wpemailText = file_get_contents($TemplateName); 
			
		}		
		 $desinationurl = nl2br($GetAllCampaignRecordsRec['destination_url']);
		  $campaignHeading = nl2br($GetAllCampaignRecordsRec['heading']); 
		 $campaignSubheading = nl2br($GetAllCampaignRecordsRec['sub_heading']);
		 $text_content = nl2br($GetAllCampaignRecordsRec['text_content']);
		 $Contact_info = nl2br($GetAllCampaignRecordsRec['contact_info']);
		 $main_image = $GetAllCampaignRecordsRec['main_image'];
		 $clickble_image = $GetAllCampaignRecordsRec['clickble_image'];
		 $twitter_link = nl2br($GetAllCampaignRecordsRec['twitter_link']);
		 $facebook_link = nl2br($GetAllCampaignRecordsRec['facebook_link']);
		 
		$wpmailMessage = str_replace("#DESTURL#", "$desinationurl", "$wpemailText");
		$wpmailMessage = str_replace("#HEADING#", "$campaignHeading", "$wpmailMessage");
		$wpmailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$wpmailMessage");
		$wpmailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$wpmailMessage"); 
		$wpmailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$wpmailMessage");
		$wpmailMessage = str_replace("#MAINIMAGE#", "$main_image", "$wpmailMessage");
		$wpmailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$wpmailMessage");
		$wpmailMessage = str_replace("#TWITTERLINK#", "$twitter_link", "$wpmailMessage");
		$wpmailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link", "$wpmailMessage");
		
		$date=date("Y:m:d H:i:s");	
		$post_author="1";
		$post_date=$date;
		$post_date_gmt=$date;
		$post_content=htmlentities(addslashes($wpmailMessage));  
		$post_title=$GetAllCampaignRecordsRec['heading'];
		$post_status="publish";
		$comment_status="open";
		$ping_status="open";	
		$post_name=$GetAllCampaignRecordsRec['heading'];
		$post_name = str_replace(" ", "-", $post_name);
		$post_modified=$date;
		$post_modified_gmt =$date;
		$post_parent="0";
		$menu_order="0";
		$post_type="post";
		$comment_count="0";
			
$InsertCampaignQry="INSERT INTO wp_posts(post_author,post_date,post_date_gmt,post_content,post_title,post_status,comment_status,ping_status,post_name,post_modified,post_modified_gmt,post_parent,menu_order,post_type,comment_count) VALUES('$post_author','$post_date','$post_date_gmt','$post_content','$post_title','$post_status','$comment_status','$ping_status','$post_name','$post_modified','$post_modified_gmt','$post_parent','$menu_order','$post_type','$comment_count')";  
$InsertCampaignRes=$object->ExecuteQuery($InsertCampaignQry);
$get_last_insert_id=mysql_insert_id();	
$catid=$RecCampaign_Seg_list_info['area_list'];
 $GetCatname=$object->Getmetropolitianareaname($catid); 
 $GetCatId=$object->GetmetropolitianareaID($GetCatname); 
 $subcatname=$Intrest_and_activitise[$GetAllCampaignRecordsRec['category_option']];	
$GetSubcatid=$object->GetmetropolitiSubCatId($subcatname,$GetCatId);
$InsertCampaignrelationQry="INSERT INTO wp_term_relationships(object_id,term_taxonomy_id) VALUES('$get_last_insert_id','$GetSubcatid')";  
$InsertCampaignrelationRes=$object->ExecuteQuery($InsertCampaignrelationQry);
$campaignID=$GetAllCampaignRecordsRec['campaign_id'];
$InsertCampaignPostnQry="INSERT INTO campaign_posts(post_id,campaign_id) VALUES('$get_last_insert_id','$campaignID')";  
$InsertCampaignPostnRes=$object->ExecuteQuery($InsertCampaignPostnQry);
//Update the member received date
$Client_ID=$GetAllCampaignRecordsRec['clientid'];
$Tran_ID=$PaymentststusResult[1];
$datecreated=date("Y:m:d");
$ClientNameDetails=$object->GetClientName($Client_ID);
 $paymentQry="INSERT INTO tbl_paymentdetails(clientid,client_name,campaign_id,Total_members,TotalAmount,Transaction_ID,date_created) VALUES('$Client_ID','$ClientNameDetails','$campaignID','$totalemailsids','$totalAmountBilled','$Tran_ID','$datecreated')";   
$InsertPaymentDetailsRes=$object->ExecuteQuery($paymentQry); 

for($i=0;$i<count($AllemailIds);$i++)
{
 $UpdateCampaignIdqry="update tbl_members set  Campaign_received_date ='".$date."' where email_address='".$AllemailIds[$i]."'";  
$UpdateCampaignIdRes=$object->ExecuteQuery($UpdateCampaignIdqry);
}
}
else
{
echo $Paymentststus;
}			 
/* INSERTING THE CAMPAIGN DETAILS INTO THE WP-POST TABLE IN THE WORDPRESS END HERE*/
	
	} catch (SoapFault $fault) {
	  $error = "cstb_error";
	}
}
?>
