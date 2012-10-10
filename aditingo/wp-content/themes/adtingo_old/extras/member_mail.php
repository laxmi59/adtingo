<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Adtingo Member Confirmation</title>
<style type='text/css'>
table.email {
	background-color:#f3f3f3;
}
table.emailbar {
	background-color:#85beda;
}
table.emailbar td.bardate {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
	padding: 5px;
}
table.emailbar td.barbuttons {
	padding-top: 5px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 0px;
}
table.emailfooter {
	border-top-width: 4px;
	border-top-style: solid;
	border-top-color: #85beda;
	background-color: #F3F3F3;
}
table.emailfooter td.footerlinks {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #D8D8D8;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #999999;
	padding-top: 5px;
	padding-right: 0px;
	padding-bottom: 5px;
	padding-left: 0px;
}
table.emailfooter td.footerlinks a {
	color: #666666;
	text-decoration:none;
}
table.emailfooter td.footermessage {
	font-family: Arial, Verdana, Helvetica, sans-serif;
	font-size: 11px;
	color: #999999;
	padding-top: 5px;
	padding-right: 0px;
	padding-bottom: 5px;
	padding-left: 0px;
}
table.contentarea {
	background-color: #FFFFFF;
}
/*table.contentarea h3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #666666;
	margin-top: 5px;
	margin-bottom: 15px;
}*/
/*table.contentarea p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 1.5em;
	color: #666666;
	margin-top: 5px;
	margin-bottom: 10px;
}*/
/*table.contentarea a {
	color: #006699;
}*/

</style>
</head>

<body>
<table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#f3f3f3'>
  <tr>
    <td>

    <table width='620' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td bgcolor='#f3f3f3'><img src='http://adtingo.com/client/Campaign_templates/Campaign_template1/images/header-logo.jpg' alt='' width='185' height='120' /> <img src='http://adtingo.com/client/Campaign_templates/Campaign_template1/images/header-lifestylela1.jpg' alt='' width='430' height='120' /></td>
      </tr>
    </table>
    <table width='620' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor="#85beda">
        <tr>
          <td width='97%' style='font-family: Arial, Helvetica, sans-serif;	font-size: 14px;font-weight: bold;
	color: #FFFFFF;	padding: 5px;'>". date('F d, Y') ."</td>

          <td width='1%' class='barbuttons'><img src='http://adtingo.com/client/Campaign_templates/Campaign_template1/images/bar-buttonfacebooklikeus.jpg' alt='' width='70' height='20' /></td>
          <td width='1%' class='barbuttons'><img src='http://adtingo.com/client/Campaign_templates/Campaign_template1/images/bar-buttontwitterfollowus.jpg' alt='' width='85' height='20' /></td>
        </tr>
      </table>
      <table width='620' border='0' align='center' cellpadding='20' cellspacing='0' bgcolor='#FFFFFF'>
        <tr>
          <td>
          <p style='font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 1.5em;color: #666666;
	margin-top: 5px;margin-bottom: 10px;'>Hey ".$_POST[email].",</p>

          <h3 style='font-family: Arial, Helvetica, sans-serif;	font-size: 18px;color: #666666;	margin-top: 5px;
	margin-bottom: 15px;'>Congratulations and welcome to the new AdTingo  mailing list!</h3>
          <p style='font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 1.5em;color: #666666;
	margin-top: 5px;margin-bottom: 10px;'>Make sure you add members@adtingomail.com to your safe sender list or address book. If you don't, our content may get sent to your junk folder and you could miss out on everything exciting from us.</p>
          <p style='font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 1.5em;color: #666666;
	margin-top: 5px;margin-bottom: 10px;'>From now on you'll get one daily email for each list that you subscribed to delivered right to your inbox with the latest headlines, awesome editorials and special offers from businesses in your neighborhood.</p>
          <p style='font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 1.5em;color: #666666;
	margin-top: 5px;margin-bottom: 10px;'>Log in to Adtingo.com, enter your email address and password, to change your password, change your settings or add/subtract editions:<br /><br>
            <b>Email: ".$_POST[email]."</b><br />
            <b>Password: ".$string."</b></p>

          <p style='font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 1.5em;color: #666666;
	margin-top: 5px;margin-bottom: 10px;'>Remember, all the information you share with us stays private &mdash; we will never share or sell our email list. For more information on our privacy policy, click here:<br />
            <a href='http://www.adtingo.com/privacy.html' style='color: #006699'>http://www.adtingo.com/privacy.html</a></p>
          <p>&nbsp;</p>
          <p style='font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 1.5em;color: #666666;
	margin-top: 5px;margin-bottom: 10px;'>Thanks and welcome!</p>
          <p style='font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 1.5em;color: #666666;
	margin-top: 5px;margin-bottom: 10px;'>AdTingo Support</p>
          <p style='font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 1.5em;color: #666666;
	margin-top: 5px;margin-bottom: 10px;'>PS&mdash; Sharing is caring, tell all your friends about us.</p></td>

        </tr>
      </table>
      <table width='620' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor="#F3F3F3" class='emailfooter'>
        <tr>
          <td width='470' class='footerlinks'><a href='Link1'>Link1</a> | <a href='Link2'>Link2</a> | <a href='Link3'>Link3</a> | <a href='Link4'>Link4</a> | <a href='Link5'>Link5</a> | <a href='Link6'>Link6</a> | <a href='Link7'>Link7</a> | <a href='Link8'>Link8</a> | <a href='Link9'>Link9</a> | <a href='Link10'>Link10</a></td>

          <td width='150' rowspan='3' valign='top'><img src='http://adtingo.com/client/Campaign_templates/Campaign_template1/images/footer-logo.jpg' alt='' width='150' height='84' /></td>
        </tr>
        <tr>
          <td class='footerlinks'><a href='http://adtingo.com/privacy-policy'>Privacy Policy</a> | <a href='http://adtingo.com/terms-conditions'>Terms &amp; Conditions</a> | <a href='http://adtingo.com/client/'>Advertise</a> | <a href='http://adtingo.com/contact-us'>Contact Us</a> | <a href='http://adtingo.com/unsubscribe'>Unsubscribe</a></td>

        </tr>
        <tr>
          <td class='footermessage'>You have received this email because you have opted to subcribe to our deals. If you wish to have a miserable life and unsubscribe, don't let us stop you. We'll just won't tell you how to unsubscribe.</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
