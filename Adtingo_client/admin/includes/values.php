<?php
$Time_zone_info=array('-12.0'=>"(GMT -12:00) Eniwetok, Kwajalein",'-11.0'=>"(GMT -11:00) Midway Island, Samoa",'-10.0'=>"(GMT -10:00) Hawaii",'-9.0'=>"(GMT -9:00) Alaska",'-8.0'=>"(GMT -8:00) Pacific Time (US &amp; Canada)",'-7.0'=>"(GMT -7:00) Mountain Time (US &amp; Canada)",'-6.0'=>"(GMT -6:00) Central Time (US &amp; Canada), Mexico City",'-5.0'=>"(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima",'-4.0'=>"(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",'-3.5'=>"(GMT -3:30) Newfoundland",'-3.0'=>"(GMT -3:00) Brazil, Buenos Aires, Georgetown",'-2.0'=>"(GMT -2:00) Mid-Atlantic",'-1.0'=>"(GMT -1:00 hour) Azores, Cape Verde Islands",'0.0'=>"(GMT) Western Europe Time, London, Lisbon, Casablanca",'1.0'=>"(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris",'2.0'=>"(GMT +2:00) Kaliningrad, South Africa",'3.0'=>"(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",'3.5'=>"(GMT +3:30) Tehran",'4.0'=>"(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",'4.5'=>"(GMT +4:30) Kabul",'5.0'=>"(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",'5.5'=>"(GMT +5:30) Bombay, Calcutta, Madras, New Delhi",'5.75'=>"(GMT +5:45) Kathmandu",'6.0'=>"(GMT +6:00) Almaty, Dhaka, Colombo",'7.0'=>"(GMT +7:00) Bangkok, Hanoi, Jakarta",'8.0'=>"(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",'9.0'=>"(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",'9.5'=>"(GMT +9:30) Adelaide, Darwin",'10.0'=>"(GMT +10:00) Eastern Australia, Guam, Vladivostok",'11.0'=>"(GMT +11:00) Magadan, Solomon Islands, New Caledonia",'12.0'=>"(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka");
$ProductCat=array('1'=>"Clothing",'2'=>"Headwear",'3'=>"Badges/Keyrings/Magnets",'4'=>"Bags",'5'=>"Band/Artist Merchandise",'6'=>"YoYoTrax Merchandise",'7'=>"Memorabilia",'8'=>"Other");
 $Intrest_and_activitise=array('1'=>"Food and Dinning",'2'=>"Style",'3'=>"Entertainment",'4'=>"Travel",'5'=>"Nightlife",'6'=>"Home and Garden",'7'=>"Electronics and Gadgets",'8'=>"Dating",'9'=>"Nightlife",'10'=>"Sports and Fitness",'11'=>"Career and Money",'12'=>"Cars",'13'=>"Health and Beauty");

 $Cotact_info=array('1'=>"Daily",'2'=>"Weekly",'3'=>"Bi-Weekly",'4'=>"Monthly",'5'=>"Quarterly");
 $education_array=array('1'=>'Highschool','2'=>'Some College','3'=>'In College','4'=>'College Graduate');

//$income_array=array('1'=>'>10000 AND <20000','2'=>'>20000 AND <30000','3'=>'>30000 AND <40000','4'=>'>40000 AND <50000');
$income_array=array('1'=>'Below $25,000','2'=>'$25,000 to $50,000','3'=>'$50,000 to $75,000','4'=>'$75,000 to $100,000','5'=>'$100,000 or more');

$Zipcode_Radious=array('1'=>'2','2'=>'5','3'=>'10','4'=>'15','5'=>'20','6'=>'30','7'=>'40','8'=>'50');
function Get_Product_list()
{
	global $ProductCat;
	foreach($ProductCat as $k=>$v)
	{
		if($k==$pro)
		{
			$ProductList.= "<option value='$k' selected='selected'>$v</option>";
		}
		else
		{
			$ProductList.= "<option value='$k'>$v</option>";
		}
	}
	
	return $ProductList;
}
function Get_Zipcode_Radious($Score='0')
{
	global $Zipcode_Radious;
	foreach($Zipcode_Radious as $k=>$v)
	{
		 if($k==$Score)
		{
			$options.= "<option value='$k' selected='selected'>$v</option>";
		}
		else
		{
			$options.= "<option value='$k'>$v</option>";
		}
	}
	return $options;
}


function IntrestAndActivities_checkboxes($Score='0')
{
//print_r($Score); exit;
	global $Intrest_and_activitise;
	foreach($Intrest_and_activitise as $k=>$v)
	{
		
		 if (in_array($k, $Score))
		{
		$options.= "<li><input type='checkbox' name='intrest[]' checked='checked' id='intrest' value='".$k."' />$v</li>";
			
		}
		else
		{
			$options.= "<li><input type='checkbox' name='intrest[]'  id='intrest' value='".$k."' />$v</li>";
		}
	}
	
	return $options;
}
function Contact_info_data($Score='0')
{

	global $Cotact_info;
	foreach($Cotact_info as $k=>$v)
	{
		
		 if($k==$Score)
		{
			$options.= "<option value='$k' selected='selected'>$v</option>";
		}
		else
		{
			$options.= "<option value='$k'>$v</option>";
		}
	}
	
	return $options;
}
function IntrestAndActivities_Display($Score='0')
{
//print_r($Score); exit;
	global $Intrest_and_activitise;
	foreach($Intrest_and_activitise as $k=>$v)
	{
		
		 if (in_array($k, $Score))
		{
		$options.=$v."<br/> ";
			
		}
		
	}
	
	return $options;
}
function Timezone_info_data($Score='test')
{

	global $Time_zone_info;
	foreach($Time_zone_info as $k=>$v)
	{
		
		 if($k==$Score)
		{
			$options.= "<option value='$k' selected='selected'>$v</option>";
		}
		else
		{
			$options.= "<option value='$k'>$v</option>";
		}
	}
	
	return $options;
}
function getEducation($educationValue='0')
{
	global $education_array;
	foreach($education_array as $k=>$v)
	{
		
		 if($k==$educationValue)
		{
			$options.= "<option value='".$k."' selected='selected'>$v</option>";
		}
		else
		{
			$options.= "<option value='".$k."'>$v</option>";
		}
	}
	return $options;

}
function getIncome($incomeValue='test')
{
	global $income_array;
	foreach($income_array as $k=>$v)
	{
		
		 if($k==$incomeValue)
		{
			//$options.='<option value='".$k."'  selected='selected'>$v</option>';
				$options.='<option  selected="selected" value="'.$k.'"  >'.$v.'</option>';
		}
		else
		{
			$options.='<option value="'.$k.'">'.$v.'</option>';
		}
	}
	return $options;

}
function IntrestAndActivities($Score='0')
{

	global $Intrest_and_activitise;
	foreach($Intrest_and_activitise as $k=>$v)
	{
		
		 if($k==$Score)
		{
			$options.= "<option value='$k' selected='selected'>$v</option>";
		}
		else
		{
			$options.= "<option value='$k'>$v</option>";
		}
	}
	
	return $options;
}
function sendmail($to,$from,$sub,$msg)
{
	$plainMessage="This is a Plain text..";
	$headers.= "MIME-Version: 1.0\n";
	$headers.= "Content-Type: text/html; charset=ISO-8859-1\n"; 
	$headers .= "From:$from <$from>\n"; 
	
	$mailsent = mail($to,$sub,$msg,$headers);
	return $mailsent;
}
?>

