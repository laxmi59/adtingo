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
$SqlGetclients_info=sprintf("select * from tbl_clients where clientid=%d",$object->stripper($_SESSION['clientid']));
$ResGetclients_info=$object->ExecuteQuery($SqlGetclients_info);
//$cols=$object->NumRows($ResGetclients_info);
$RecGetclients_info=$object->FetchArray($ResGetclients_info);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Billing Details" ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<?php include "includes/google_analytic.php";?>
</head>
<body>
<!--header start-->
  <?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
 <div class="error-msg"><?php if($_REQUEST['msg']=="update") { ?>
				Your billing details has been updated successfully
				<?php
				}?>
				</div> 
      <div class="title"><h2>Manage your account</h2> </div> 
 
      <div class="account-settings">
      	 <div class="account-settings-top">
         	<div class="account-settings-bottom">
			
                <div class="as-left-col"><div class="grey-box w-640">
                <h3 class="grad-box">Billing information</h3>
                
                <dl class="small-form">
                      <dt>Full Name</dt>
                       <dd>
						   <?php
							if($RecGetclients_bill_info['BillFirstname']!="")
								 echo stripslashes($RecGetclients_bill_info['BillFirstname']);
							else
								 echo stripslashes($RecGetclients_info['full_name']);
							 ?>
					   </dd>
                      
                      
                      
                      <dt>Email Address</dt>
                      <dd>
					 		 <?php
								if($RecGetclients_bill_info['BillEmail']!="")
									 echo stripslashes($RecGetclients_bill_info['BillEmail']);
								else
									 echo stripslashes($RecGetclients_info['email_address']);
							 ?>
					  </dd>
                       
                      
                     <dt>Street Address</dt>
                     <dd>
								 <?php
									if($RecGetclients_bill_info['bill_address']!="")
										 echo stripslashes($RecGetclients_bill_info['bill_address']);
									else
										 echo "----";
								 ?>
					 </dd>
                      <dt>City</dt>
                        <dd>
								<?php
									if($RecGetclients_bill_info['BillCity']!="")
										 echo stripslashes($RecGetclients_bill_info['BillCity']);
									else
										 echo "----";
								 ?></dd>
								  <dt>State/Province</dt>
                         <dd>
						 		<?php
									if($RecGetclients_bill_info['BillState']!="")
										 echo stripslashes($RecGetclients_bill_info['BillState']);
									else
										 echo "----";
								 ?>
						 </dd>
                      
                        <dt>Zip/Postal Code</dt>
             <dd>
			 <?php
					if($RecGetclients_bill_info['BillZipcode']!="")
						 echo stripslashes($RecGetclients_bill_info['BillZipcode']);
					else
						 echo "----";
				 ?>
			 </dd>
                     <dt>Country</dt>
                       <dd>
							   <?php
									if($RecGetclients_bill_info['BillCountry']!="")
										 echo stripslashes($object->GetCountryName($RecGetclients_bill_info['BillCountry']));
									else
										 echo "----";
								 ?>
			   </dd>
                      
                    
                     
           
          
             <dt>Telephone</dt>
             <dd>
			  <?php
					if($RecGetclients_bill_info['BillPhone']!="")
						 echo stripslashes($RecGetclients_bill_info['BillPhone']);
					else
						 echo "----";
				 ?>
			</dd>
              
       			   </dl> 
                   
               <h3 class="grad-box">Your payment details (secure)</h3> 
			   <dl class="small-form">
                <dt>Card Type</dt>
                <dd>
				 <?php
					if($RecGetclients_bill_info['CCTypeID']!="")
						echo $object->GetCreditCardType($RecGetclients_bill_info['CCTypeID']);
					else
						 echo "----";
				 ?>
				
			<br/>
			</dd>
                <dt>Card Number </dt>
                <dd>
				 <?php
					if($RecGetclients_bill_info['CCNo']!="")
						echo $new_card = "XXXX-XXXX-XXXX-" . substr(base64_decode($RecGetclients_bill_info['CCNo']),-4,4);
					else
						 echo "----";
				 ?>
				
				<br/>
			   	
				</dd> 
                <dt>Expiry Date </dt>
                <dd>
				<?php
					if($RecGetclients_bill_info['CCExpMon']!="" && $RecGetclients_bill_info['CCExpYear']!="")
						echo $RecGetclients_bill_info['CCExpMon']."/".$RecGetclients_bill_info['CCExpYear'];
					else
						 echo "----";
				 ?>
				
		   <br/>
		   </dd>                 
                <dt>Name on Card </dt>
                <dd>
				<?php
					if($RecGetclients_bill_info['CCName']!="")
						echo $RecGetclients_bill_info['CCName'];
					else
						 echo "----";
				 ?>
				</dd> 
                
                 
              </dl>               
                <dt><a class="greybutton" href="edit-billing-details.php" ><span><img src="images/icon-pen.gif" alt="" />Edit Billing Details</span></a></dt>
                      <dd></dd>           
                    
                   </div></div>
                   <div class="as-right-col">
                   <div class="bghighlight">You might also want to...</div>
                   <dl class="changepassword">
            <dt><a href="change-password.php"><img src="images/change-password.gif" alt="Change your password" title="Change your password"/></a></dt>
            <dd ><a href="change-password.php">Change your  password</a></dd>
            <dd class="last"> Modify your account access password</dd>
            <dt><a href="billing-details.php"  ><img src="images/cart.gif" alt="Manage billing details" title="Manage billing details" /></a></dt>
            <dd><a href="billing-details.php" >Manage billing details</a></dd>
            <dd class="last"></dd>
          </dl> 	 
                  </div>
             <div class="clear"></div>
           </div>
             <div class="clear"></div>
        </div>  
          <div class="clear"></div>      
      </div> 
        <div class="clear"></div> 
</div>
<!--body end-->
<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
