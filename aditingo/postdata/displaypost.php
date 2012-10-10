<?php 
$link=mysql_connect("localhost","root","") or die("unable to connnect");
mysql_select_db("adtingodb") or die("unable to connect to database");
$campaign_id=36;  
$SqlGetCampaign="select * from wp_posts  where ID='67'"; 
$SqlGetCampaignRes=mysql_query($SqlGetCampaign);
$SqlGetCampaignRec=mysql_fetch_array($SqlGetCampaignRes);	
echo  html_entity_decode($SqlGetCampaignRec['post_content']); 	 

?>
