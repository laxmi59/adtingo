<?php
error_reporting(0);
require_once("includes/set_env.php");
include('includes/functions.php');
include('includes/values.php');
$object=new main();

$client_id=$_REQUEST['cid'];
if($client_id=="")
{
header("location:clientsdetails.php");
exit;
}
$SqlGetUserFlag=sprintf("select * from tbl_clients  WHERE clientid =$client_id"); 
$QryGetUserFlag=$object->ExecuteQuery($SqlGetUserFlag);
$cols=$object->NumRows($QryGetUserFlag);
$ResGetUserFlag=$object->FetchArray($QryGetUserFlag);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Adtingo</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="images/css.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/reset.css" media="all" />

</head>

 <body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10"><img src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="wbg">
        <tr>
          <td align="left" valign="top"><img src="images/box_top_left.gif" width="3" height="3"></td>
          <td align="right" valign="top"><img src="images/box_top_right.gif" width="3" height="3"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td class="wbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/spacer.gif" width="1" height="1"></td>
          <td height="5" valign="top"><img src="images/spacer.gif"></td>
          <td><img src="images/spacer.gif"></td>
        </tr>
        <tr>
          <td width="10">&nbsp;</td>
          <td height="300" valign="top">
            <!-- <form name="loginfrm" method="post" action="<?=$PHP_SELF?>"> -->            <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1">
              <tr>
                <td>
				<h3>View Client details</h3>
                    <table width="100%"  border="0" cellpadding="1" cellspacing="0" class="border">
                      <tr>
                        <td><table width="100%"  border="0" cellpadding="3" cellspacing="0" class="td">
                            <tr>
                              <td width="100%" colspan="2" align="left" class="h1"></td>
                            </tr>
                          </table>
                            <table width="100%"  border="0" cellpadding="0" cellspacing="0" height="40px;" >
                           	<tr align="left">
                                <td >Full Name</td>
                                <td ><?php echo stripslashes($ResGetUserFlag['full_name']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Email Address</td>
                                <td ><?php echo stripslashes($ResGetUserFlag['email_address']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Username</td>
                                <td ><?php echo stripslashes($ResGetUserFlag['username']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Password</td>
                                <td ><?php echo stripslashes($ResGetUserFlag['password']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Company Name</td>
                                <td ><?php echo stripslashes($ResGetUserFlag['company_name']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Time Zone</td>
                                <td >
								<?php
			 echo $Time_zone_info[$ResGetUserFlag['time_zone']]; ?>
		   
								</td>
						   	</tr>
							<tr align="left">
                                <td >Metropolitian Area</td>
                                <td >
								<?php
			echo $object->Getmetropolitianareaname($ResGetUserFlag['metropolitian_area']);
		   ?>
								</td>
						   	</tr>
							
					        		
					
                                 <!-- only SiteUsers are having Password -->
							 

                             
                            </table></td>
                      </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="10">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="22" align="center" class="wbg"><a href="javascript:window.close();">Close Window</a> </td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="wbg">
        <tr>
          <td align="left" valign="bottom"><img src="images/box_bot_left.gif" width="3" height="3"></td>
          <td align="right" valign="bottom"><img src="images/box_bot_right.gif" width="3" height="3"></td>
        </tr>
    </table></td>
  </tr>
</table>
 
    

</body>
</html>
