<?php


		$Header_fileName = $sitepath."header.html";
		$Content_fileName = $sitepath."content.html";
		$Footer_fileName = $sitepath."footer.html";

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
		
		$to="manohar015@yahoo.co.in";
		$from="info@adtingo.com";
		$sub="Adtingo Test Email ";
		$desinationurl1="www.google.com";
		$campaignHeading="Test ritwik heading";
		$campaignSubheading="Test ritwik subheading";
		$text_content="Test ritwik heading Test ritwik headingTest ritwik headingTest ritwik headingTest ritwik headingTest ritwik headingTest ritwik headingTest ritwik heading";
		$Contact_info="banjara hills";
		$twitter_link1="www.twitter.com";
		$twitter_link1="www.facebook.com";
		$today = date("F j, Y");
		$GetCatName="Loss Angles";
		$main_image="http://ritwik.com/clients/adtingo/test.jpg";
		$clickble_image="http://ritwik.com/clients/adtingo/test.jpg";
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
			
		$mailMessage = str_replace("#PARAGRAPH1#", "$listofthinks_to_come1", "$mailMessage"); 
		$mailMessage = str_replace("#PARAGRAPH2#", "$listofthinks_to_come2", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH3#", "$listofthinks_to_come3", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH4#", "$listofthinks_to_come4", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH5#", "$listofthinks_to_come5", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH6#", "$listofthinks_to_come6", "$mailMessage");
		$mailMessage = str_replace("#PARAGRAPH7#", "$listofthinks_to_come7", "$mailMessage");
		
		 if(sendmail($to,$from,$sub,$mailMessage))
		 {
		 echo "Mail Sent u";
		 }
function sendmail($to,$from,$sub,$msg)
{
	$plainMessage="This is a Plain text..";
	$headers.= "MIME-Version: 1.0\n";
	$headers.= "Content-Type: text/html; charset=ISO-8859-1\n"; 
	$headers .= "From:$from <$from>\n"; 
	
	$mailsent = mail($to,$sub,$msg,$headers);
	return $mailsent;
}
?>