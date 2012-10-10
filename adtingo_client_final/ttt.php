<?
//echo $_SERVER['HTTP_HOST'];
$to="laxmi.kotni@gmail.com";
$subject = "Membership Confirmation Mail From Adtingo";

$fileName = "http://adtingo.com/wp-content/themes/adtingo/templates/member_welcome_template.html";		
if(file_exists($fileName))
{
	$emailText = file_get_contents($fileName); 

}
 //$emailText="testing";

//echo $mailMessage;		
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From:Adtingo.com <info@adtingo.com>" ."\r\n";
$headers .= 'Reply-To: adtingo <info@adtingo.com>'."\r\n";

if(mail($to,$subject,$emailText,$headers)){echo $emailText;}
				
?>