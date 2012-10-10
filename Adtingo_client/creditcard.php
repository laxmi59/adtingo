<?php
function validateCC($cc_num, $type) {

	if($type == "AmEx") {
	$denum = "American Express";
	} elseif($type == "Discover") {
	$denum = "Discover";
	} elseif($type == "MasterCard") {
	$denum = "MasterCard";
	} elseif($type == "Visa") {
	$denum = "Visa";
	} elseif($type == "Maestro") {
	$denum = "Maestro";
	}elseif($type == "Solo") {
	$denum = "Solo";
	}

	if($type == "AmEx") {
	$pattern = "/^([34]{2})([0-9]{15})$/";//American Express
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	
	} elseif($type == "Discover") {
	$pattern = "/^([6011]{4})([0-9]{12})$/";//Discover Card
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	
	} elseif($type == "MasterCard") {
	//$res= $cc_num;
	$pattern = "/^([55]{2})([0-9]{16})$/";//Mastercard
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	
	} elseif($type == "Visa") {
	$pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	}elseif($type == "Solo"){
	$pattern = "/^([6334|6767]{4})([0-9]{16,18,19})$/";//Solo
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
    }elseif($type == "Maestro"){
	$pattern = "/^([5018|5020|5038|6304|6759|6761]{4})([0-9]{12,13,14,15,16,18,19})$/";//Maestro
	
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
    }
		
	if($verified == false) {
	//Do something here in case the validation fails
	$res= "Invalid Card Number. Please make sure that you entered a valid <em>" . $denum . "</em> credit card ";
	
	} 
return $res;
}
//echo validateCC("38520000023237", "Dinners");
function is_valid_credit_card($s) {
    $s = strrev(preg_replace('/[^\d]/','',$s));
    $sum = 0;
    for ($i = 0, $j = strlen($s); $i < $j; $i++) {
        if (($i % 2) == 0) {
            $val = $s[$i];
        } else {
            $val = $s[$i] * 2;
            if ($val > 9) { $val -= 9; }
        }
        $sum += $val;
    }
    return (($sum % 10) == 0);
}if (! is_valid_credit_card('676700000000000000')) {
    //print 'Sorry, that card number is invalid.';
}else{
	//print 'success';
}
?>