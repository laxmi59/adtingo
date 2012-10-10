<?php
		$to="manohar015@yahoo.co.in";
$subject = 'the subject';
$message = 'hello';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

if(mail($to, $subject, $message, $headers))
{
echo "hiii";
}
?>
