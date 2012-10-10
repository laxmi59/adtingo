<?php
include_once('includes/session.php');  
include('includes/functions.php'); 
//include('includes/dbfiler.php'); 
include('includes/values.php'); 
$object=new main();
$valid_month_status="";
$card_exp_month_error="";
$CampaignID=base64_decode($_REQUEST['cid']);
if($_POST['CC_ExpDate_Year']==date('Y'))
{
if($_POST['CC_ExpDate_Month'] < date('m'))
{
$valid_month_status="invalid";
$card_exp_month_error="Expiry Month should be greater than current month";
}
}
$SqlGetclients_bill_info=sprintf("select * from tbl_billing_details where clientid=%d",$object->stripper($_SESSION['clientid']));
$ResGetclients_bill_info=$object->ExecuteQuery($SqlGetclients_bill_info);
$cols=$object->NumRows($ResGetclients_bill_info);
$RecGetclients_bill_info=$object->FetchArray($ResGetclients_bill_info);


$SqlGetclients_info=sprintf("select * from tbl_clients where clientid=%d",$object->stripper($_SESSION['clientid']));
$ResGetclients_info=$object->ExecuteQuery($SqlGetclients_info);
//$cols=$object->NumRows($ResGetclients_info);
$RecGetclients_info=$object->FetchArray($ResGetclients_info);

 if($_POST['steppaymentsubmit_x_x']!="")
 {
  $CartNumberInfo="";
  if($_POST['CreditCardNumber']!="")
  {
  	if (!(is_numeric($_POST['CreditCardNumber'])))
	{
		$CartNumberInfo="";	
	}
	else
		$CartNumberInfo=$_POST['CreditCardNumber'];
  }
  else if($RecGetclients_bill_info['CCNo']!="")
 	$CartNumberInfo= $RecGetclients_bill_info['CCNo'];

	
 
 
if(isset($_POST['fullname']) && $_POST['fullname']!='' && $_POST['billemail']!='' && $_POST['billcountry_id']!='' && $_POST['CreditCardType']!='' &&  $_POST['CC_ExpDate_Month']!='' && $CartNumberInfo!=""  && $_POST['CC_ExpDate_Year']!=''  && (is_numeric($_POST['card_verification_num'])))
{
	if($cols>0)
	{
	if($_POST["CreditCardNumber"]!="")
	$CardNumber=$_POST["CreditCardNumber"];
	else
	$CardNumber=base64_decode($RecGetclients_bill_info["CCNo"]);
	
	$Insert_Client_bill_Info_qry=sprintf("update tbl_billing_details  set BillFirstname='%s',BillEmail='%s',BillCity='%s',bill_address='%s',BillState='%s',BillZipcode='%s',BillCountry=%d,BillPhone='%s',CCName='%s',CCTypeID='%s',CCNo='%s',CCExpMon='%s',CCExpYear='%s',CCVNo='%s' where clientid=%d",$object->stripper($_POST["fullname"]),$object->stripper($_POST["billemail"]),$object->stripper($_POST["billcity"]),$object->stripper($_POST["billingAddress"]),$object->stripper($_POST["billstatetxt"]),$object->stripper($_POST["BillingPostalCode"]),$object->stripper($_POST["billcountry_id"]),$object->stripper($_POST["BillingPhoneNumber"]),$object->stripper($_POST["cartname"]),$object->stripper($_POST["CreditCardType"]),$object->stripper(base64_encode($CardNumber)),$object->stripper($_POST["CC_ExpDate_Month"]),$object->stripper($_POST["CC_ExpDate_Year"]),$object->stripper(base64_encode($_POST["card_verification_num"])),$object->stripper($_SESSION['clientid']));
	
	}
	else
	{
	 $Insert_Client_bill_Info_qry=sprintf("insert into tbl_billing_details (clientid,  	BillFirstname,BillEmail,BillCity,bill_address,BillState,BillZipcode,BillCountry,BillPhone,CCName,CCTypeID,CCNo,CCExpMon,CCExpYear,CCVNo,date_created) values(%d,'%s','%s','%s','%s','%s','%s',%d,'%s','%s','%s','%s','%s','%s','%s','%s')",$object->stripper($_SESSION['clientid']),$object->stripper($_POST['fullname']),$object->stripper($_POST['billemail']),$object->stripper($_POST['billcity']),$object->stripper($_POST['billingAddress']),$object->stripper($_POST['billstatetxt']),$object->stripper($_POST['BillingPostalCode']),$object->stripper($_POST['billcountry_id']),$object->stripper($_POST['BillingPhoneNumber']),$object->stripper($_POST['cartname']),$object->stripper($_POST['CreditCardType']),$object->stripper(base64_encode($_POST['CreditCardNumber'])),$object->stripper($_POST['CC_ExpDate_Month']),$object->stripper($_POST['CC_ExpDate_Year']),$object->stripper(base64_encode($_POST['card_verification_num'])),date('Y:m:d H:i:s')); 	
	}
		$Insert_Client_bill_Info_Res=$object->ExecuteQuery($Insert_Client_bill_Info_qry);
		if($Insert_Client_bill_Info_Res)
		{
			unset($_SESSION['campaign']);
			header("location:billing-details.php?msg=update");
			exit;
		}
}  
else
{
	$firstname_error='';
	$email_error="";
	$country_error="";
	$cardtype_error="";
	$cardnum_error="";	
	$card_exp_year_error="";
	$cvv_error="";
	if($_POST["fullname"]=="")
	{
	$firstname_error="Full Name Required";
	$_SESSION['campaign']['fullname']="";
	}
	else
	$_SESSION['campaign']['fullname']=$_POST["fullname"];
	if($_POST["billemail"]=="")
	{
	$email_error="Emailaddress Required";
	$_SESSION['campaign']['billemail']="";
	}
	else
	{
	$_SESSION['campaign']['billemail']=$_POST["billemail"];
	
	}
	if($_POST["billingAddress"]=="")
	{
	$BillAdd_err="Street Address Required";
	$_SESSION['campaign']['billingAddress']="";
	}
	else
	$_SESSION['campaign']['billingAddress']=$_POST["billingAddress"];
	   
	if($_POST["billcity"]=="")
	{
	$billcity_err="City Required";
	$_SESSION['campaign']['billcity']="";
	}
	else
	$_SESSION['campaign']['billcity']=$_POST["billcity"];
	if($_POST["billstatetxt"]=="")
	{
	$billstate_err="State/Province Required";
	$_SESSION['campaign']['billstatetxt']="";
	}
	else
	$_SESSION['campaign']['billstatetxt']=$_POST["billstatetxt"];
	if($_POST["BillingPostalCode"]=="")
	{
	$billzipcode_err="Zip/Postal Code Required";
	$_SESSION['campaign']['BillingPostalCode']="";
	}
	else
	$_SESSION['campaign']['BillingPostalCode']=$_POST["BillingPostalCode"];
	
	if($_POST["billcountry_id"]=="")
	{
	$country_error="Coutry Required";
	$_SESSION['campaign']['billcountry_id']="";
	}
	else
	$_SESSION['campaign']['billcountry_id']=$_POST["billcountry_id"];
	if($_POST["CreditCardType"]=="")
	{
	$cardtype_error="Card Type Required";
	$_SESSION['campaign']['CreditCardType']="";
	}
	else
	$_SESSION['campaign']['CreditCardType']=$_POST["CreditCardType"];
	if($RecGetclients_bill_info["CCNo"]=="")
	{
	$cardnum_error="Card Number Required";
	$_SESSION['campaign']['CreditCardNumber']="";
	}
	if($_POST['CreditCardNumber']!="")
	{
		 if (!(is_numeric($_POST['CreditCardNumber'])))
		 { 
		
		 $_SESSION['campaign']['CreditCardNumber']=$_POST["CreditCardNumber"];
			$cardnum_error="Card Number should be numbers only";
		 }
	 }
	else
	$_SESSION['campaign']['CreditCardNumber']=$_POST["CreditCardNumber"];
	if($_POST["CC_ExpDate_Month"]=="")
	{
	$card_exp_month_error="Expiry Month Required";
	$_SESSION['campaign']['CC_ExpDate_Month']="";
	}
	else
	$_SESSION['campaign']['CC_ExpDate_Month']=$_POST["CC_ExpDate_Month"];
	if($_POST["CC_ExpDate_Year"]=="")
	{
	$card_exp_year_error="Expiry Year Required";
	$_SESSION['campaign']['CC_ExpDate_Year']="";
	}
	else
	$_SESSION['campaign']['CC_ExpDate_Year']=$_POST["CC_ExpDate_Year"];
	if($_POST["cartname"]=="")
	{
	$cartname_err="Name on Card Required";
	$_SESSION['campaign']['cartname']="";
	}
	else
	$_SESSION['campaign']['cartname']=$_POST["cartname"];
	
	if($_POST["card_verification_num"]=="")
	{
	$cvv_error="Card Verification Number Required";
	$_SESSION['campaign']['card_verification_num']="";
	}
	else if (!(is_numeric($_POST['card_verification_num'])))
	 { 
	 $_SESSION['campaign']['card_verification_num']=$_POST["card_verification_num"];
	   	$cvv_error="Card Verification Number should be numbers only";
	 }
	else
	$_SESSION['campaign']['card_verification_num']=$_POST["card_verification_num"];
		
}
}
if($RecGetclients_bill_info['CCExpMon']!="")	
$value= $RecGetclients_bill_info['CCExpMon'];
$months_str=$object->select_function($months_arr,$value);
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
				 <form  method="post" name="payment_gateway" id="payment_gateway">
					        <input type="hidden" name="emailerr" />
							<input type="hidden" name="usererr" />
							<input type="hidden" name="chkval" id="chkval" value="1" />
                        
                        <h3 class="grad-box">Billing information</h3>
                         
         				<dl class="form">
                <dt>Full Name</dt>
                <dd><input   name="fullname" id="fullname" tabindex="2"  type="text" 
				value="<?php if($cols>0) { echo stripslashes($RecGetclients_bill_info['BillFirstname']); }
				 else echo $RecGetclients_info['full_name'];?>" />
				<br/>
				<span class="red">
				<?php if($firstname_error!="") echo $firstname_error;?>
				</span>				
				</dd>
                
                 
                <dt>Email Address</dt>
                <dd><input   name="billemail" id="billemail"  tabindex="2" type="text" value="<?php  if($cols>0) { echo stripslashes($RecGetclients_bill_info['BillEmail']); } else echo $RecGetclients_info['email_address'];?>" />
				<br/>
				<span class="red">
				<?php if($email_error!="") echo $email_error;?>
				</span>	
				</dd>
                <dt>Street Address</dt>
                <dd><textarea name="billingAddress" tabindex="2" id="billingAddress"  /><?php if($RecGetclients_bill_info['bill_address']!="") { echo stripslashes($RecGetclients_bill_info['bill_address']);  } else { echo $_SESSION['campaign']['billingAddress']; } ?></textarea>
				<br/>
				<span class="red">
				<?php if($BillAdd_err!="") echo $BillAdd_err;?>
				</span>	
				</dd>
                 <dt>City</dt>
                <dd><input name="billcity" tabindex="2" id="billcity"  size="30" class="" type="text" value="<?php if($RecGetclients_bill_info['BillCity']!="") { echo stripslashes($RecGetclients_bill_info['BillCity']);  } else { echo $_SESSION['campaign']['billcity']; }?>" />
				<br/>
				<span class="red">
				<?php if($billcity_err!="") echo $billcity_err;?>
				</span>
				</dd> 
				 <dt>State/Province</dt>
			  
	               <dd><input name="billstatetxt" tabindex="2" id="billstatetxt"  size="30" class="" type="text" value="<?php if($RecGetclients_bill_info['BillState']!="") { echo stripslashes($RecGetclients_bill_info['BillState']); }else { echo $_SESSION['campaign']['billstatetxt']; } ?>" />
				   <br/>
				<span class="red">
				<?php if($billstate_err!="") echo $billstate_err;?>
				</span>
				   </dd> 
				    <dt>Zip/Postal Code</dt>
                <dd><input name="BillingPostalCode" tabindex="2" id="BillingPostalCode"  size="30" class="" type="text" value="<?php if($RecGetclients_bill_info['BillZipcode']!="") { echo stripslashes($RecGetclients_bill_info['BillZipcode']); }else { echo $_SESSION['campaign']['BillingPostalCode']; } ?>" />
				  <br/>
				<span class="red">
				<?php if($billzipcode_err!="") echo $billzipcode_err;?>
				</span>
				</dd> 
                <dt>Country</dt>
                <dd><select name="billcountry_id" id="billcountry_id" tabindex="2" title="Country" >
			   
			   <?php 
			 if($RecGetclients_bill_info['BillCountry']!="")				  
			  echo $object->getCountriesList($RecGetclients_bill_info['BillCountry']);
			  else
			  echo $object->getCountriesList(223);
			  ?>
               </select>
			   <br/>
			   <span class="red">
				<?php if($country_error!="") echo $country_error;?>
				</span>	
			   </dd>
              
                
               
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
			
			<?php if($RecGetclients_bill_info['CCNo']!="") {	?>
                <dt>Card Number </dt>
                <dd><?php if( $RecGetclients_bill_info['CCNo']!="")	 { echo  $new_card = "XXXX-XXXX-XXXX-" . substr(base64_decode($RecGetclients_bill_info['CCNo']),-4,4);} ?> 
				
				</dd> 
				<dt> </dt>
               
			    <dd><input   name="CreditCardNumber" id="CreditCardNumber"  tabindex="2" type="text" 
				value="<?php echo $_SESSION['campaign']['CreditCardNumber']; ?>" maxlength="16" />
				<br/>
			   <span class="red">
				<?php if($cardnum_error!="") echo $cardnum_error;?>
				</span>	
				</dd>
				<?php } else { ?>
				 <dt>Card Number </dt>
				 <dd><input   name="CreditCardNumber" id="CreditCardNumber"  tabindex="2" type="text" 
				value="<?php echo $_SESSION['campaign']['CreditCardNumber']; ?>" maxlength="16" />
				<br/>
			   <span class="red">
				<?php if($cardnum_error!="") echo $cardnum_error;?>
				</span>	
				</dd>
				 <?php } ?>
			
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
					  <br/>
				<span class="red">
				<?php if($cartname_err!="") echo $cartname_err;?>
				</span>
				</dd> 
                <dt>Card Verification #</dt>
                <dd><input   name="card_verification_num" id="card_verification_num"  tabindex="2" class="w-100"  type="text"  value="<?php echo stripslashes(base64_decode($RecGetclients_bill_info['CCVNo']));  ?>"  /> &nbsp;&nbsp;&nbsp;<span class="f-size11">Most cards:</span> <img src="images/visaVerification.gif" alt="The verification number is located on the signature strip on the back of your card. It is the last three numbers" class="supporting"/>&nbsp;&nbsp;&nbsp;<span class="f-size11">Amex:</span>&nbsp;&nbsp;<img src="images/amexVerification.gif" alt="The American Express verification number is a 4-digit number printed on the front of your card. It appears after and to the right of your card number" 
class="supporting" /> 
<br/>
			   <span class="red">
				<?php if($cvv_error!="") echo $cvv_error;?>
				</span>	</dd> 


 
              </dl>
                        
                         
         				
   <input   src="images/save-changes.jpg"  type="image" name="steppaymentsubmit_x" id="steppaymentsubmit_x" style="float:left;" /> 
                        <span class="formcancel"> &nbsp;&nbsp;or </span><a href="billing-details.php" class="greybutton" onclick="CS.AccountDefault.toggleEdit()" 
> <span>cancel</span></a> 
 

                      </form></div></div>
                   <div class="as-right-col">
                   <div class="bghighlight">You might also want to...</div>
                  	<dl class="changepassword">
                    <dt><a href="change-password.php"><img src="images/change-password.gif" alt="Change your password" title="Change your password" /></a></dt>
                    <dd><a href="change-password.php">Change your  password</a></dd>
                    <dt>&nbsp;</dt>
                    <dd>Modify your account access password</dd>
					<dt><a href="billing-details.php"  ><img src="images/cart.gif" alt="Mange billing details" title="Mange billing details" /></a></dt>
            <dd><a href="billing-details.php" >Mange billing details</a></dd>
            <dd class="last"></dd>
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
