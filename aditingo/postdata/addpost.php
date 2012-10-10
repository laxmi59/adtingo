<?php 
$link=mysql_connect("localhost","root","") or die("unable to connnect");
mysql_select_db("adtingodb") or die("unable to connect to database");
$campaign_id=47;  
 $SqlGetCampaign="select * from tbl_campaigns  where campaign_id='".$campaign_id."'"; 
$SqlGetCampaignRes=mysql_query($SqlGetCampaign);
 		$SqlGetCampaignRec=mysql_fetch_array($SqlGetCampaignRes);	
	//	$rows=mysql_num_rows($SqlGetCampaignRes);
		if($SqlGetCampaignRec['template_selection']==1)
 	 $fileName ="Post_Template1.htm";	
	 else
	 $fileName ="Post_template2.html";	
		if($fileName!="")
		{
			$emailText = file_get_contents($fileName); 
			
		}
		
		 $desinationurl = nl2br($SqlGetCampaignRec['destination_url']);
		  $campaignHeading = nl2br($SqlGetCampaignRec['heading']); 
		 $campaignSubheading = nl2br($SqlGetCampaignRec['sub_heading']);
		 $text_content = nl2br($SqlGetCampaignRec['text_content']);
		 $Contact_info = nl2br($SqlGetCampaignRec['contact_info']);
		 $main_image = $SqlGetCampaignRec['main_image'];
		 $clickble_image = $SqlGetCampaignRec['clickble_image'];
		 $twitter_link = nl2br($SqlGetCampaignRec['twitter_link']);
		 $facebook_link = nl2br($SqlGetCampaignRec['facebook_link']);
		$mailMessage = str_replace("#DESTURL#", "$desinationurl", "$emailText");
		$mailMessage = str_replace("#HEADING#", "$campaignHeading", "$mailMessage");
		$mailMessage = str_replace("#SUBHEADING#", "$campaignSubheading", "$mailMessage");
		$mailMessage = str_replace("#TEXTCONTENT#", "$text_content", "$mailMessage"); 
		$mailMessage = str_replace("#CONTACTINFO#", "$Contact_info", "$mailMessage");
		$mailMessage = str_replace("#MAINIMAGE#", "$main_image", "$mailMessage");
		$mailMessage = str_replace("#CLICKBLEIMAGE#", "$clickble_image", "$mailMessage");
		$mailMessage = str_replace("#TWITTERLINK#", "$twitter_link", "$mailMessage");
		$mailMessage = str_replace("#FACEBOOKLINK#", "$facebook_link", "$mailMessage");
		
		
$date=date("Y:m:d H:i:s");	
	$post_author="1";
	$post_date=$date;
	$post_date_gmt=$date;
	 $post_content=htmlentities(addslashes($mailMessage)); 
	$post_title=$SqlGetCampaignRec['heading'];
	$post_status="publish";
	$comment_status="open";
	$ping_status="open";
	$post_name=$SqlGetCampaignRec['campaign_name'];
	$post_modified=$date;
	$post_modified_gmt 	=$date;
	$post_parent="0";
	$menu_order="0";
	$post_type="post";
	$comment_count="0";
			
			echo  $insert="INSERT INTO 	wp_posts(post_author,post_date,post_date_gmt,post_content,post_title,post_status 	,comment_status,ping_status,post_name,post_modified,post_modified_gmt,post_parent,menu_order,post_type,comment_count) VALUES ('$post_author','$post_date','$post_date_gmt','$post_content','$post_title','$post_status','$comment_status','$ping_status','$post_name','$post_modified','$post_modified_gmt','$post_parent','$menu_order','$post_type','$comment_count')";  
			 $qry=mysql_query($insert);
			 if($qry)
			 {
			 echo "hii";
			 }
			
			 $get_last_insert_id=mysql_insert_id();	
			 $insert_campaign_post="INSERT INTO 	campaign_posts(post_id,campaign_id) VALUES ('$get_last_insert_id','$campaign_id')"; 
			  $qry=mysql_query($insert_campaign_post);
		
	


?>
