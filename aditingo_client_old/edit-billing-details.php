<?php
include_once('includes/session.php');
include('includes/functions.php');
include('includes/values.php');
$object=new main(); 
$Clientid=$_SESSION['clientid']; 
$SqlGetclients_bill_info=sprintf("select * from tbl_billing_details where clientid=%d",$object->stripper($_SESSION['clientid']));
$ResGetclients_bill_info=$object->ExecuteQuery($SqlGetclients_bill_info);
 $cols=$object->NumRows($ResGetclients_bill_info);
$RecGetclients_bill_info=$object->FetchArray($ResGetclients_bill_info);
$months_str=$object->select_function($months_arr,$RecGetclients_bill_info['CCExpMon']);
if($_POST['billcountry_id'] && $_POST['CreditCardNumber'])
{
if($cols>0)
{
$Insert_Client_bill_Info_qry=sprintf("update tbl_billing_details  set BillFirstname='%s', BillLastname='%s' ,BillEmail='%s',BillCity='%s',bill_address='%s',BillState='%s',BillZipcode='%s',BillCountry='%s',BillPhone='%s',CCName='%s',CCTypeID='%s',CCNo='%s',CCExpMon='%s',CCExpYear='%s',CCVNo='%s' where clientid=%d",$object->stripper($_POST['billfname']),$object->stripper($_POST['billlname']),$object->stripper($_POST['billemail']),$object->stripper($_POST['billcity']),$object->stripper($_POST['billingAddress']),$object->stripper($_POST['billstatetxt']),$object->stripper($_POST['BillingPostalCode']),$object->stripper($_POST['billcountry_id']),$object->stripper($_POST['BillingPhoneNumber']),$object->stripper($_POST['cartname']),$object->stripper($_POST['CreditCardType']),$object->stripper(base64_encode($_POST['CreditCardNumber'])),$object->stripper($_POST['CC_ExpDate_Month']),$object->stripper($_POST['CC_ExpDate_Year']),$object->stripper(base64_encode($_POST['card_verification_num'])),$object->stripper($_SESSION['clientid'])); 

}
else
{
 $Insert_Client_bill_Info_qry=sprintf("insert into tbl_billing_details (clientid,  	BillFirstname,BillLastname,BillEmail,BillCity,bill_address,BillState,BillZipcode,BillCountry,BillPhone,CCName,CCTypeID,CCNo,CCExpMon,CCExpYear,CCVNo,date_created) values(%d,'%s','%s','%s','%s','%s','%s','%s',%d,'%s','%s','%s','%s','%s','%s','%s','%s')",$object->stripper($_SESSION['clientid']),$object->stripper($_POST['billfname']),$object->stripper($_POST['billlname']),$object->stripper($_POST['billemail']),$object->stripper($_POST['billcity']),$object->stripper($_POST['billingAddress']),$object->stripper($_POST['billstatetxt']),$object->stripper($_POST['BillingPostalCode']),$object->stripper($_POST['billcountry_id']),$object->stripper($_POST['BillingPhoneNumber']),$object->stripper($_POST['cartname']),$object->stripper($_POST['CreditCardType']),$object->stripper(base64_encode($_POST['CreditCardNumber'])),$object->stripper($_POST['CC_ExpDate_Month']),$object->stripper($_POST['CC_ExpDate_Year']),$object->stripper(base64_encode($_POST['card_verification_num'])),date('Y:m:d H:i:s')); 
 }
 
$Insert_Client_bill_Info_Res=$object->ExecuteQuery($Insert_Client_bill_Info_qry);
if($Insert_Client_bill_Info_Res)
{
	header("location:billing-details.php?msg=update");
	exit;
}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<script type="text/javascript" src="js/javascript.js"></script>
</head>
<body>
<!--header start-->
<?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
      <div class="title"><h2>Manage your account</h2> </div> 
 
      <div class="account-settings">
      	 <div class="account-settings-top">
         	<div class="account-settings-bottom">
			
                <div class="as-left-col"><div class="grey-box w-640">
				 <form action="" method="post" name="updateaccount" id="updateaccount">
					        <input type="hidden" name="emailerr" />
							<input type="hidden" name="usererr" />
							<input type="hidden" name="chkval" id="chkval" value="1" />
                        
                        <h3 class="grad-box">Billing information</h3>
                         
         				<dl class="form">
                <dt>First Name</dt>
                <dd><input   name="billfname" id="billfname" tabindex="2"  type="text" value="<?php echo $RecGetclients_bill_info['BillFirstname'];?>" />
				<br/>
				<span class="red">
				<?php if($firstname_error!="") echo $firstname_error;?>
				</span>				
				</dd>
                <dt>Last Name </dt>
                <dd><input   name="billlname" id="billlname"  tabindex="2" type="text" value="<?php echo $RecGetclients_bill_info['BillLastname'];?>" /></dd> 
                <dt>Email Address</dt>
                <dd><input   name="billemail" id="billemail"  tabindex="2" type="text" value="<?php echo stripslashes($RecGetclients_bill_info['BillEmail']);  ?>" />
				<br/>
				<span class="red">
				<?php if($email_error!="") echo $email_error;?>
				</span>	
				</dd>
                <dt>First Line of Billing Address</dt>
                <dd><textarea name="billingAddress" tabindex="2" id="billingAddress"  /><?php echo stripslashes($RecGetclients_bill_info['bill_address']);  ?></textarea></dd>
                 
                <dt>Country</dt>
                <dd><select name="billcountry_id" id="billcountry_id" tabindex="2" title="Country" >
			     <option value="">-- Select Country --</option>
			   <?php 
			 if($RecGetclients_bill_info['BillCountry']!="")				  
			  echo $object->getCountriesList($RecGetclients_bill_info['BillCountry']);
			  else
			  echo $object->getCountriesList();
			  ?>
               </select>
			   <br/>
			   <span class="red">
				<?php if($country_error!="") echo $country_error;?>
				</span>	
			   </dd>
               <dt>State/Province</dt>
			   
	               <dd><input name="billstatetxt" tabindex="2" id="billstatetxt"  size="30" class="" type="text" value="<?php echo stripslashes($RecGetclients_bill_info['BillState']);  ?>" /></dd> 
                <dt>City</dt>
                <dd><input name="billcity" tabindex="2" id="billcity"  size="30" class="" type="text" value="<?php echo stripslashes($RecGetclients_bill_info['BillCity']);  ?>" /></dd> 
                <dt>Zip/Postal Code</dt>
                <dd><input name="BillingPostalCode" tabindex="2" id="BillingPostalCode"  size="30" class="" type="text" value="<?php echo stripslashes($RecGetclients_bill_info['BillZipcode']);  ?>" /></dd> 
                <dt>Telephone</dt>
                <dd><input name="BillingPhoneNumber" tabindex="2" id="BillingPhoneNumber"  size="30" class="" type="text" value="<?php echo stripslashes($RecGetclients_bill_info['BillPhone']);  ?>" /></dd> 
              </dl>
			   <h3 class="grad-box">Your payment details (secure)</h3>
                       <dl class="form">
                <dt>Card Type</dt>
                <dd><select id="CreditCardType" name="CreditCardType" tabindex="2">
              <option value="">--Please Select--</option>
            <?php 
			 
			echo $object->getCCList($RecGetclients_bill_info['CCTypeID']);?>
            </select>
			<br/>
			   <span class="red">
				<?php if($cardtype_error!="") echo $cardtype_error;?>
				</span>	
			</dd>
	 <dt>Card Number </dt>
                <dd><?php if( $RecGetclients_bill_info['CCNo']!="")	 { echo  $new_card = "XXXX-XXXX-XXXX-" . substr(base64_decode($RecGetclients_bill_info['CCNo']),-4,4);} ?> 
				
				</dd> 
                <dt> </dt>
                <dd><input   name="CreditCardNumber" id="CreditCardNumber"  tabindex="2" type="text" value="" />
				<br/>
			   <span class="red">
				<?php if($cardnum_error!="") echo $cardnum_error;?>
				</span>	
				</dd> 
                <dt>Expiry Date </dt>
                <dd><select id="CC_ExpDate_Month" tabindex="2" style="width: 120px;" name="CC_ExpDate_Month">
          <option value="" >-- Month --</option>
            <?php echo $months_str;?>
           </select>&nbsp;  <select id="CC_ExpDate_Year" tabindex="2" style="width: 75px;" name="CC_ExpDate_Year">
             <option value="" >-- Year --</option>
           <?php echo $object->getYearList($RecGetclients_bill_info['CCExpYear']);?>
           </select>
		   <br/>
			   <span class="red">
				<?php if($card_exp_month_error!="") echo $card_exp_month_error;?>
				</span>	
				 <span class="red">
				<?php if($card_exp_year_error!="") echo $card_exp_year_error;?>
				</span>	
		   </dd>                 
                <dt>Name on Card </dt>
                <dd><input   name="cartname" id="cartname"   tabindex="2" type="text" value="<?php echo stripslashes($RecGetclients_bill_info['CCName']);  ?>" />
					
				</dd> 
                <dt>Card Verification #</dt>
                <dd><input   name="card_verification_num" id="card_verification_num"  tabindex="2" class="w-100"  type="text"  value="<?php echo stripslashes(base64_decode($RecGetclients_bill_info['CCVNo']));  ?>"  /> &nbsp;&nbsp;&nbsp;<span class="f-size11">Most cards:</span> <img src="images/visaVerification.gif" alt="The verification number is located on the signature strip on the back of your card. It is the last three numbers" class="supporting"/>&nbsp;&nbsp;&nbsp;<span class="f-size11">Amex:</span>&nbsp;&nbsp;<img src="images/amexVerification.gif" alt="The American Express verification number is a 4-digit number printed on the front of your card. It appears after and to the right of your card number" 
class="supporting" /> 
<br/>
			   <span class="red">
				<?php if($cvv_error!="") echo $cvv_error;?>
				</span>	</dd> 


 
              </dl>
                        
                         
         				
                        <a class="greybutton" href="#" onclick="return updatebillingdetails();"><span><img src="images/icon-tickcase.gif" alt="" />Save Changes</span></a> 
                        <span class="formcancel">or </span><a href="billing-details.php" class="greybutton" onclick="CS.AccountDefault.toggleEdit()" 
> <span>cancel</span></a> 
 

                      </form></div></div>
                   <div class="as-right-col">
                   <div class="bghighlight">You might also want to...</div>
                  	<dl class="changepassword">
                    <dt><a href="#"><img src="images/change-password.gif" alt="Change your password" /></a></dt>
                    <dd><a href="change-password.php">Change your  password</a></dd>
                    <dt>&nbsp;</dt>
                    <dd>Modify your account access password</dd>
					<dt><a href="#"  ><img src="images/cart.gif" alt="Link Activity &amp; Overlay" /></a></dt>
            <dd><a href="billing-details.php" >Mange billing details</a></dd>
            <dd class="last">Which links were popular, who clicked.</dd>
                  </dl>
                  </div>
             
           </div>
        </div>        
      </div>  
</div>
<!--body end-->


<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
