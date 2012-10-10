<?php
error_reporting(0);
require_once("includes/set_env.php");
include('includes/functions.php');
include('includes/values.php');
$object=new main();
 $Tid=$_REQUEST['Tid']; 
if($Tid=="")
{
header("location:manage_payments.php");
exit;
}
 $GetPaymentDetails="select *,date_format(date_created,'%d %b,  %Y') as date  from tbl_paymentdetails  WHERE  PayID =$Tid"; 

$GetPaymentDetailsRes=$object->ExecuteQuery($GetPaymentDetails);
$cols=$object->NumRows($GetPaymentDetailsRes);
$GetPaymentDetailsRec=$object->FetchArray($GetPaymentDetailsRes);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo SITETITLE."Payment Details"?></title>

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
				<h3>View Payment details</h3>
                    <table width="100%"  border="0" cellpadding="1" cellspacing="0" class="border">
                      <tr>
                        <td><table width="100%"  border="0" cellpadding="3" cellspacing="0" class="td">
                            <tr>
                              <td width="100%" colspan="2" align="left" class="h1"></td>
                            </tr>
                          </table>
                            <table width="100%"  border="0" cellpadding="0" cellspacing="0" height="40px;" >
                           	<tr align="left">
                                <td >Client Name</td>
                                <td ><?php echo stripslashes($GetPaymentDetailsRec['client_name']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Campaign Name</td>
                                <td ><?php echo $object->GetCampaignName($GetPaymentDetailsRec['campaign_id']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Total Members</td>
                                <td ><?php echo stripslashes($GetPaymentDetailsRec['Total_members']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Total Amount </td>
                                <td >$ <?php echo number_format($GetPaymentDetailsRec['TotalAmount'],2); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Transaction Id </td>
                                <td ><?php echo stripslashes($GetPaymentDetailsRec['Transaction_ID']); ?></td>
						   	</tr>
							<tr align="left">
                                <td >Payment Date</td>
                                <td ><?php echo stripslashes($GetPaymentDetailsRec['date']); ?></td>
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
