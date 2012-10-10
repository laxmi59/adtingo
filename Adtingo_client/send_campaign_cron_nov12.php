<?php
include_once('/var/www/client/includes/functions_cron.php'); 
include_once('/var/www/client/includes/values_cron.php'); 
$date=date("Y:m:d");	
$sitepath="/var/www/client";

$GetAllCampaignRecordsQry="select * from tbl_campaigns where schedule_date <='".$date."' and status=2";  
$GetAllCampaignRecordsRes=$object->ExecuteQuery($GetAllCampaignRecordsQry);
 $Num_cols=$object->NumRows($GetAllCampaignRecordsRes); 
echo "\nProgram started at ->".date('m-d-Y H:i:s')."\n";
while($GetAllCampaignRecordsRec=$object->FetchArray($GetAllCampaignRecordsRes)){
$shddate=$GetAllCampaignRecordsRec['schedule_date'];
$shddate1=explode(" ",$shddate);
$shddate2=$shddate1[0];
	$SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$GetAllCampaignRecordsRec['campaign_id']; 
	$ResCampaign_Seg_list_info=$object->ExecuteQuery($SqlCampaign_Seg_list_info);
	$object->NumRows($ResCampaign_Seg_list_info);
	$RecCampaign_Seg_list_info=$object->FetchArray($ResCampaign_Seg_list_info);

	$getLocalDoGoders="select * from `tbl_catart` where cat_id='".$RecCampaign_Seg_list_info['area_list']."' and `primary_cat` ='on'";
	//echo $getLocalDoGoders;
	$ResLocalDoGoders=$object->ExecuteQuery($getLocalDoGoders);
	$RecLocalDoGoders=$object->FetchArray($ResLocalDoGoders);
	
	$cstb = array("title"=>$GetAllCampaignRecordsRec['heading'], "subject"=>$GetAllCampaignRecordsRec['subject_line'], "fromEmail"=>"members@adtingomail.com", "fromName"=>"Adtingo", "toEmail"=>"members@adtingomail.com", "toName"=>"Adtingo", "replyToEmail"=>"reply@adtingomail.com", "replyToName"=>"Adtingo", encoding=>"quoted-printable","Charset"=>"ISO-8859-1", "trackType"=>"ALL", "openTrackType"=>"HTML", "clickStreamType"=>"ALL", "brandID"=>"1","enabled"=>"TRUE" );	
	
	try{	

		$GetTemplateinfoSql="select * from tbl_email_template_content where TId=".$GetAllCampaignRecordsRec['template_selection'].""; 
		$GetTemplateinfoQry=$object->ExecuteQuery($GetTemplateinfoSql);
		$GetTemplateinfoRec=$object->FetchArray($GetTemplateinfoQry);

		$Header_fileName = $sitepath."/Campaign_templates/Campaign_template1/header.html";
		$Content_fileName = $sitepath."/Campaign_templates/Campaign_template1/".$GetTemplateinfoRec[new_temp]."";
		$Footer_fileName = $sitepath."/Campaign_templates/Campaign_template1/footer.html";

		$Total_email_template="";
		if(file_exists($Header_fileName))
		{
			$emailText = file_get_contents($Header_fileName); 
		}
		
		if(file_exists($Content_fileName))
		{
			$emailText .= file_get_contents($Content_fileName); 
		}
		if(file_exists($Footer_fileName))
		{
			$emailText .= file_get_contents($Footer_fileName); 
		}
		
		$desinationurl = nl2br($GetAllCampaignRecordsRec['destination_url']);
		$campaignHeading = stripslashes($GetAllCampaignRecordsRec['heading']);
		$campaignSubheading = stripslashes($GetAllCampaignRecordsRec['sub_heading']);
		$text_content = stripslashes($GetAllCampaignRecordsRec['text_content']);
		
		if($GetAllCampaignRecordsRec['map_address']<>'')$Contact_info1 .=$GetAllCampaignRecordsRec['map_address'].",";
		if($GetAllCampaignRecordsRec['map_apt']<>'')$Contact_info1 .=$GetAllCampaignRecordsRec['map_apt'].",";
		if($GetAllCampaignRecordsRec['map_city']<>'')$Contact_info1 .=$GetAllCampaignRecordsRec['map_city'].",";
		if($GetAllCampaignRecordsRec['map_state']<>'')$Contact_info1 .=$GetAllCampaignRecordsRec['map_state'].",";
		if($GetAllCampaignRecordsRec['map_zipcode']<>'')$Contact_info1 .=$GetAllCampaignRecordsRec['map_zipcode'];
		
		$Contact_info = nl2br($Contact_info1);
		
		$main_image = $GetAllCampaignRecordsRec['main_image'];
		$clickble_image = nl2br($RecLocalDoGoders['img']);
		$twitter_link = nl2br($GetAllCampaignRecordsRec['twitter_link']);
		$facebook_link = nl2br($GetAllCampaignRecordsRec['facebook_link']);
		
		
		 
		$localdeallink = stripslashes($RecLocalDoGoders['url']);
		$localdealtitle = stripslashes($RecLocalDoGoders['title']);
		$localdealdesc = stripslashes(substr($RecLocalDoGoders['desc'],0,100));
		$ldg=$RecLocalDoGoders['art_id'];
		$lotc=$GetTemplateinfoRec['TId'];
		if($GetTemplateinfoRec['paragraph1']!="")
		$listofthinks_to_come1 = "<li style='color:#666666; font-family:Arial,Helvetica,sans-serif; font-size:12px; margin-bottom:10px;'>".stripslashes($GetTemplateinfoRec['paragraph1'])."</li>";
		if($GetTemplateinfoRec['paragraph2']!="")	    
		$listofthinks_to_come2 = "<li style='color:#666666; font-family:Arial,Helvetica,sans-serif; font-size:12px; margin-bottom:10px;'>".stripslashes($GetTemplateinfoRec['paragraph2'])."</li>";	
		if($GetTemplateinfoRec['paragraph3']!="")
		$listofthinks_to_come3 = "<li style='color:#666666; font-family:Arial,Helvetica,sans-serif; font-size:12px; margin-bottom:10px;'>".stripslashes($GetTemplateinfoRec['paragraph3'])."</li>";
		if($GetTemplateinfoRec['paragraph4']!="")	
		$listofthinks_to_come4 = "<li style='color:#666666; font-family:Arial,Helvetica,sans-serif; font-size:12px; margin-bottom:10px;'>".stripslashes($GetTemplateinfoRec['paragraph4'])."</li>";
		if($GetTemplateinfoRec['paragraph5']!="")	
		$listofthinks_to_come5 = "<li style='color:#666666; font-family:Arial,Helvetica,sans-serif; font-size:12px; margin-bottom:10px;'>".stripslashes($GetTemplateinfoRec['paragraph5'])."</li>";
		if($GetTemplateinfoRec['paragraph6']!="")		    
		$listofthinks_to_come6 = "<li style='color:#666666; font-family:Arial,Helvetica,sans-serif; font-size:12px; margin-bottom:10px;'>".stripslashes($GetTemplateinfoRec['paragraph6'])."</li>";
		if($GetTemplateinfoRec['paragraph7']!="")	
		$listofthinks_to_come7 = "<li style='color:#666666; font-family:Arial,Helvetica,sans-serif; font-size:12px; margin-bottom:10px;'>".stripslashes($GetTemplateinfoRec['paragraph7'])."</li>";	
		
		
		if($desinationurl!="")
			$desinationurl1="<a href='".$desinationurl."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template2/images/content-buttoncheckitout.jpg' alt='' border='0' width='201' height='36'></a>";
		else
			$desinationurl1="";
		if($facebook_link!=""){
			$facebook_link1="<a href='".$facebook_link."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-facebookicon.jpg' alt='' width='16' height='24' border='0'></a>";		
		}else
			$facebook_link1="";
		if($twitter_link!=""){
			$twitter_link1="<a href='".$twitter_link."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-twittericon.jpg' alt='' width='16' height='24' border='0'></a>";
		}else
		 	$twitter_link1="";
			
			
		$twitter_share_link='<a href="http://twitter.com/share?url=http://twitter.com/adtingo" target="_blank"><img src="http://clients.adtingo.com/Campaign_templates/Campaign_template2/images/content-buttonretweet.jpg" alt="" border="0" width="95" height="30"></a>';
		$facebook_share_link='<a href="http://www.facebook.com/sharer.php?u=http://www.facebook.com/pages/Adtingo/160563510636133" target="_blank">
<img src="http://clients.adtingo.com/Campaign_templates/Campaign_template2/images/content-buttonfbshare.jpg" alt="" border="0" width="95" height="30"></a>';	
		
		$today = date("F j, Y");
		$object=new main();
		$GetCatName=$object->Getmetropolitianareaname($RecCampaign_Seg_list_info['area_list']);
		$mailMessage = str_replace("#DESTURL#", "$desinationurl1", "$emailText");
		$mailMessage = str_replace("#HEADING#", "$campaignHeading", "$mailMessage");
		$mailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$mailMessage");
		$mailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$mailMessage"); 
		$mailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$mailMessage");
		$mailMessage = str_replace("#MAINIMAGE#", "$main_image", "$mailMessage");
		$mailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$mailMessage");
		$mailMessage = str_replace("#CLICKBLELINK#", "$localdeallink", "$mailMessage");
		$mailMessage = str_replace("#TWITTERLINK#", "$twitter_link1", "$mailMessage");
		$mailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link1", "$mailMessage");
		$mailMessage = str_replace("#DATECREATED#", "$today", "$mailMessage"); 
		$mailMessage = str_replace("#CATEGORYNAME#", "$GetCatName", "$mailMessage");    
		$textContent="";
		
		$mailMessage = str_replace("#TWITTERSHARELINK#", "$twitter_share_link", "$mailMessage");  
		$mailMessage = str_replace("#FACEBOOKSHARELINK#", "$facebook_share_link", "$mailMessage");  
		
		$mailMessage = str_replace("#TITLE#", "$localdealtitle", "$mailMessage");
		$mailMessage = str_replace("#LOCALDESCRIPTION#", "$localdealdesc", "$mailMessage");
		$mailMessage = str_replace("#LDG#", "$ldg", "$mailMessage");
		
		$mailMessage = str_replace("#LOTC#", "$lotc", "$mailMessage"); 
		$mailMessage = str_replace("#PARAGRAPH1#", "$listofthinks_to_come1", "$mailMessage"); 
		$mailMessage = str_replace("#PARAGRAPH2#", "$listofthinks_to_come2", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH3#", "$listofthinks_to_come3", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH4#", "$listofthinks_to_come4", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH5#", "$listofthinks_to_come5", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH6#", "$listofthinks_to_come6", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH7#", "$listofthinks_to_come7", "$mailMessage");

		$pcode=$RecCampaign_Seg_list_info['zipcode'];
		$miles=$RecCampaign_Seg_list_info['zipcode_miles'];	
		$Zipcodechk="";
	  if($pcode!="" && $miles!="")
		{
		$GetLogLattitudedetailsqry="select  distinct  LATITUDE,LONGITUDE from zip_code where ZIP_CODE=".$pcode."";
		$GetLogLattitudedetailsRes=$object->ExecuteQuery($GetLogLattitudedetailsqry);
		$object->NumRows($GetLogLattitudedetailsRes); 
		$tt=$object->FetchArray($GetLogLattitudedetailsRes);

		$sel="select distinct ZIP_CODE ,LATITUDE,LONGITUDE, (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) as distance from zip_code  where (select (1.852 * 60.0 * ((atan((sqrt(1-(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))*(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE))))))))/(select (sin(Radians(LATITUDE)) * sin(Radians($tt[LATITUDE])) + cos(Radians(LATITUDE)) * cos(Radians($tt[LATITUDE])) * cos(abs((Radians($tt[LONGITUDE]))-(Radians(LONGITUDE)))))))/3.14159265358979323846)*180))/1.609344) < $miles order by distance";
		$GetAllZipcodesres=$object->ExecuteQuery($sel);
		$zipcodedb=array();
		$object->NumRows($GetAllZipcodesres); 
		while($GetAllZipcodesrec=$object->FetchArray($GetAllZipcodesres))
		{
			$zipcodedb[]=$GetAllZipcodesrec['ZIP_CODE'];
		}
		if(count($zipcodedb)>0)
		{
		$Dbzipcodes=implode(",",$zipcodedb);
		$Zipcodechk="  and tbl_members.zipcode IN (".$Dbzipcodes.") ";
		}
		else
			$Zipcodechk="  and tbl_members.zipcode IN (0) "; 
	
	}
		$SearchResult=$object->GetAllMemberRedordsinfo($RecCampaign_Seg_list_info['area_list'],$RecCampaign_Seg_list_info['gender'],$RecCampaign_Seg_list_info['education'],$RecCampaign_Seg_list_info['income'],$RecCampaign_Seg_list_info['keywords'],$RecCampaign_Seg_list_info['minimum_age'],$RecCampaign_Seg_list_info['maxmum_age'],$Zipcodechk,$RecCampaign_Seg_list_info['sendall_option'],$RecCampaign_Seg_list_info['random_number'],$shddate2);

		$AllemailIds=array();
		$firstname=array();
		$Lastname=array();
	 	$MemberIds=array();
		while($RecSearch_result=$object->FetchArray($SearchResult))
		{
			$AllemailIds[]=$RecSearch_result['email_address'];
			$firstname[]=$RecSearch_result['full_name'];
			$Lastname[]=$RecSearch_result['last_name'];
			$MemberIds[]=$RecSearch_result['memberid'];
		}
			
		$member_details=array();
		if(count($AllemailIds)>0)
		{
			for($i=0;$i<count($AllemailIds);$i++) {		
  				$member_details[$i] = array("address" => $AllemailIds[$i],"fname"=> $firstname[$i],"lname"=> $Lastname[$i]);
				//$tt[$i] = array("address" => $AllemailIds[$i]);
			}	
		}
		
		$wsdl = 'http://api.stormpost.datranmedia.com/services/SoapRequestProcessor?wsdl';
		$soapClient = new SoapClient($wsdl);

		$login = new SOAPHeader($wsdl, 'username', 'soap@conglomeratenetwork.com');
		$password = new SOAPHeader($wsdl, 'password', 'Password2');
		$headers = array($login, $password);
		$soapClient->__setSOAPHeaders($headers);
		$cst_res = $soapClient->__call("createSendTemplate", array($cstb,$textContent,$mailMessage));
		echo "template id ->".$cst_res."\n"; 
		   
		$smft_res =  $soapClient->__call("sendMessagesFromTemplate", array($cst_res, $member_details));
		echo "mailing id ->".$smft_res."\n";

		$UpdateCampaignIdqry="update tbl_campaigns set template_id =".$cst_res." where campaign_id=".$GetAllCampaignRecordsRec[campaign_id].""; 
		$UpdateCampaignIdRes=$object->ExecuteQuery($UpdateCampaignIdqry);
		$Clients_ID=$GetAllCampaignRecordsRec['clientid'];
		$Cam_ID=$GetAllCampaignRecordsRec['campaign_id'];
		$delivery_date=date('Y-m-d H:i:s',time());
		$UpdateCampaignIdqry="update tbl_campaigns set  mailing_ID =".$smft_res.",status=3,delivery_date='".$delivery_date."' where campaign_id=".$GetAllCampaignRecordsRec[campaign_id].""; 
		$UpdateCampaignIdRes=$object->ExecuteQuery($UpdateCampaignIdqry);
		//echo $UpdateCampaignIdqry;
		//exit;
		
		echo "Compaign created and sent to ".sizeof($AllemailIds)." mails successfully\n";
		
		//$timeStamp = strtotime(date("Y-m-d"));
		for($i=0;$i<count($MemberIds);$i++)
		{
			$timeStamp = strtotime(date("Y-m-d"));
			$GetMemberCampaignReceivedDate="select contact_time  from tbl_members where  memberid=".$MemberIds[$i]."";
			$GetMemberCampaignReceivedDateRes=$object->ExecuteQuery($GetMemberCampaignReceivedDate);
			$GetMemberCampaignReceivedDateRec=$object->FetchArray($GetMemberCampaignReceivedDateRes);
				
			if($GetMemberCampaignReceivedDateRec['contact_time']==1)
			{	
				$timeStamp += 24 * 60 * 60 * 1; 
				 $nextCampaignReceivedDate = date("Y-m-d", $timeStamp);
			}
			else if($GetMemberCampaignReceivedDateRec['contact_time']==2)
			{
				$timeStamp += 24 * 60 * 60 * 7; 
				$nextCampaignReceivedDate = date("Y-m-d", $timeStamp);
			}
			else if($GetMemberCampaignReceivedDateRec['contact_time']==3)
			{
				$timeStamp += 24 * 60 * 60 * 15; 
				$nextCampaignReceivedDate = date("Y-m-d", $timeStamp);
			}
			else if($GetMemberCampaignReceivedDateRec['contact_time']==4)
			{
				$timeStamp += 24 * 60 * 60 * 30; 
				$nextCampaignReceivedDate = date("Y-m-d", $timeStamp);
			}
			else if($GetMemberCampaignReceivedDateRec['contact_time']==5)
			{
				$timeStamp += 24 * 60 * 60 * 90; 
				$nextCampaignReceivedDate = date("Y-m-d", $timeStamp);
			}
			$UpdateCampaignIdqry="update tbl_members set  Next_campaign_received_date ='".$nextCampaignReceivedDate."' where memberid='".$MemberIds[$i]."'"; 
			$UpdateCampaignIdRes=$object->ExecuteQuery($UpdateCampaignIdqry);
			$sentdate=date('Y:m:d H:i:s');
			$Member_ID=$MemberIds[$i];
			$InsertCampaignDetailsQry="INSERT INTO campaign_details(member_id,campaign_id,campaignsentdate) VALUES('$Member_ID','$Cam_ID','$sentdate')"; 
				$InsertCampaignDetailsRes=$object->ExecuteQuery($InsertCampaignDetailsQry);
			
		} 
		$Content_fileName = $sitepath."/Campaign_templates/Campaign_template1/".$GetTemplateinfoRec[new_temp]."";
		if($Content_fileName!="")
		{
			$TemplateName = file_get_contents($Content_fileName); 
			
		}
		$desinationurl = nl2br($GetAllCampaignRecordsRec['destination_url']);
		$campaignHeading = nl2br($GetAllCampaignRecordsRec['heading']); 
		$campaignSubheading = nl2br($GetAllCampaignRecordsRec['sub_heading']);
		$text_content = nl2br($GetAllCampaignRecordsRec['text_content']);
		//$Contact_info = nl2br($GetAllCampaignRecordsRec['contact_info']);
		if($GetAllCampaignRecordsRec['map_address']<>'')$Contact_info12 .=$GetAllCampaignRecordsRec['map_address'].",";
		if($GetAllCampaignRecordsRec['map_apt']<>'')$Contact_info12 .=$GetAllCampaignRecordsRec['map_apt'].",";
		if($GetAllCampaignRecordsRec['map_city']<>'')$Contact_info12 .=$GetAllCampaignRecordsRec['map_city'].",";
		if($GetAllCampaignRecordsRec['map_state']<>'')$Contact_info12 .=$GetAllCampaignRecordsRec['map_state'].",";
		if($GetAllCampaignRecordsRec['map_zipcode']<>'')$Contact_info12 .=$GetAllCampaignRecordsRec['map_zipcode'];
		
		$Contact_info2 = nl2br($Contact_info12);
		$main_image = $GetAllCampaignRecordsRec['main_image'];
		$clickble_image = $GetAllCampaignRecordsRec['clickble_image'];
		$clickble_image = nl2br($RecLocalDoGoders['img']);
		$twitter_link = nl2br($GetAllCampaignRecordsRec['twitter_link']);
		$facebook_link = nl2br($GetAllCampaignRecordsRec['facebook_link']);
			
		if($desinationurl!="")
			$desinationurl1="<a href='".$desinationurl."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-buttoncheckitout.jpg' alt='' border='0' width='201' height='36'></a>";
		else
			$desinationurl1="";
		if($facebook_link!=""){
			$facebook_link1="<a href='".$facebook_link."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-facebookicon.jpg' alt='' width='16' height='24' border='0'></a>";		
		
		}else
			$facebook_link1="";
		if($twitter_link!=""){
			$twitter_link1="<a href='".$twitter_link."' target='_blank'><img src='http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/content-twittericon.jpg' alt='' width='16' height='24' border='0'></a>";
		}else
			$twitter_link1="";
			
		$twitter_share_link='<a href="http://twitter.com/share?url=http://twitter.com/adtingo" target="_blank"><img src="http://clients.adtingo.com/Campaign_templates/Campaign_template2/images/content-buttonretweet.jpg" alt="" border="0" width="95" height="30"></a>';
		$facebook_share_link='<a href="http://www.facebook.com/sharer.php?u=http://www.facebook.com/pages/Adtingo/160563510636133" target="_blank">
<img src="http://clients.adtingo.com/Campaign_templates/Campaign_template2/images/content-buttonfbshare.jpg" alt="" border="0" width="95" height="30"></a>';	
			 
		$wpmailMessage = str_replace("#DESTURL#", "$desinationurl1", "$TemplateName");
		
		$wpmailMessage = str_replace("#HEADING#", "$campaignHeading", "$wpmailMessage");
		$wpmailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$wpmailMessage");
		$wpmailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$wpmailMessage"); 
		$wpmailMessage = str_replace("#CONTACTINFO#", "$Contact_info2", "$wpmailMessage");
		$wpmailMessage = str_replace("#MAINIMAGE#", "$main_image", "$wpmailMessage");
		$wpmailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$wpmailMessage");
		$wpmailMessage = str_replace("#TWITTERLINK#", "$twitter_link1", "$wpmailMessage");
		$wpmailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link1", "$wpmailMessage");
		
		$wpmailMessage = str_replace("#TWITTERSHARELINK#", "$twitter_share_link", "$wpmailMessage");  
		$wpmailMessage = str_replace("#FACEBOOKSHARELINK#", "$facebook_share_link", "$wpmailMessage");  

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
		
				 
/* INSERTING THE CAMPAIGN DETAILS INTO THE WP-POST TABLE IN THE WORDPRESS END HERE*/
	} catch (SoapFault $fault) {
		$error = "cstb_error";
	}
}
echo "\nProgram ended at ->".date('m-d-Y H:i:s');
?>
