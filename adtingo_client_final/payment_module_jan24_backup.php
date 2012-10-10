<?php
include_once('/var/www/client/includes/functions_cron.php'); 
include_once('/var/www/client/includes/values_cron.php'); 
include('/var/www/client/includes/graph.php');
$date=date("Y:m:d");	
$object=new main();

$getCampainPayment="select * from tbl_campaigns where status=3 and mailing_ID !=0 and ( datediff( now( ) , delivery_date ) >=1) and  payment_status='' and created_by=2";
//echo $getCampainPayment;
$resCamapainPayment=$object->ExecuteQuery($getCampainPayment);
$numCamapainPayment=$object->NumRows($resCamapainPayment); 
if($numCamapainPayment){
	while($recCamapainPayment=$object->FetchArray($resCamapainPayment)){
		$getreport=charts($recCamapainPayment['mailing_ID']);
		$totalemailsids=$getreport->deliveredCount;
		
		if($totalemailsids <= 85000)
			$totalAmountBilled=50+($totalemailsids*0.03);
		else if($totalemailsids > 85000 && $totalemailsids <= 150000)
			$totalAmountBilled=25+($totalemailsids*0.03);
		else if($totalemailsids > 150000)
			$totalAmountBilled=($totalemailsids*0.025);
			
		echo $totalemailsids."----".$totalAmountBilled;
		
		$getpaymentcarddeatails=$object->getpaymentdetails($recCamapainPayment['clientid']);
		$paymentdetailsarray=explode("@@@",$getpaymentcarddeatails);
		$Paymentststus=$object->Makepayment($totalAmountBilled,$paymentdetailsarray[0],$paymentdetailsarray[1]);  
		$PaymentststusResult=explode("@@@@",$Paymentststus);
		echo "campaign id ->".$recCamapainPayment['campaign_id']."\n";
		echo "payment status ->".$PaymentststusResult[0]."\n";
		
		if($PaymentststusResult[0]=='success'){
			$Client_ID=$recCamapainPayment['clientid'];
			$Tran_ID=$PaymentststusResult[1];
			$datecreated=date("Y:m:d");
			echo $datecreated1=date("Y:m:d h:i:s");
			$ClientNameDetails=$object->GetClientName($Client_ID);
			$campaignID=$recCamapainPayment['campaign_id'];

			$paymentQry="INSERT INTO tbl_paymentdetails(clientid,client_name,campaign_id,Total_members,TotalAmount,Transaction_ID,date_created) VALUES('$Client_ID','$ClientNameDetails','$campaignID','$totalemailsids','$totalAmountBilled','$Tran_ID','$datecreated')";
			$InsertPaymentDetailsRes=$object->ExecuteQuery($paymentQry); 
			
			$updatePaymentQuery="update tbl_campaigns set payment_status='paid' where campaign_id = $recCamapainPayment[campaign_id]";
			$resPaymentQuery=$object->ExecuteQuery($updatePaymentQuery);
		}else{
			echo "payment status ->".$PaymentststusResult[0]."\n";
			
		}
	}
}

?>