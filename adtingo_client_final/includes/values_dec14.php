<?php $Time_zone_info=array('-12.0'=>"(GMT -12:00) Eniwetok, Kwajalein",'-11.0'=>"(GMT -11:00) Midway Island, Samoa",'-10.0'=>"(GMT -10:00) Hawaii",'-9.0'=>"(GMT -9:00) Alaska",'-8.0'=>"(GMT -8:00) Pacific Time (US &amp; Canada)",'-7.0'=>"(GMT -7:00) Mountain Time (US &amp; Canada)",'-6.0'=>"(GMT -6:00) Central Time (US &amp; Canada), Mexico City",'-5.0'=>"(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima",'-4.0'=>"(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",'-3.5'=>"(GMT -3:30) Newfoundland",'-3.0'=>"(GMT -3:00) Brazil, Buenos Aires, Georgetown",'-2.0'=>"(GMT -2:00) Mid-Atlantic",'-1.0'=>"(GMT -1:00 hour) Azores, Cape Verde Islands",'0.0'=>"(GMT) Western Europe Time, London, Lisbon, Casablanca",'1.0'=>"(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris",'2.0'=>"(GMT +2:00) Kaliningrad, South Africa",'3.0'=>"(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",'3.5'=>"(GMT +3:30) Tehran",'4.0'=>"(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",'4.5'=>"(GMT +4:30) Kabul",'5.0'=>"(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",'5.5'=>"(GMT +5:30) Bombay, Calcutta, Madras, New Delhi",'5.75'=>"(GMT +5:45) Kathmandu",'6.0'=>"(GMT +6:00) Almaty, Dhaka, Colombo",'7.0'=>"(GMT +7:00) Bangkok, Hanoi, Jakarta",'8.0'=>"(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",'9.0'=>"(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",'9.5'=>"(GMT +9:30) Adelaide, Darwin",'10.0'=>"(GMT +10:00) Eastern Australia, Guam, Vladivostok",'11.0'=>"(GMT +11:00) Magadan, Solomon Islands, New Caledonia",'12.0'=>"(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka");
  $Intrest_and_activitise=array('1'=>"Food and Dinning",'2'=>"Style",'3'=>"Entertainment",'4'=>"Travel",'5'=>"Nightlife",'6'=>"Home and Garden",'7'=>"Electronics and Gadgets",'8'=>"Dating",'9'=>"Nightlife",'10'=>"Sports and Fitness",'11'=>"Career and Money",'12'=>"Cars",'13'=>"Health and Beauty");
  
  $Intrest_and_activitise_reverse =array("food and dinning" => '1',"style" => '2',"entertainment"=>'3',"travel"=>'4',"nightlife"=>'5',"home and garden"=>'6',"electronics and gadgets"=>'7',"dating"=>'8',"nightlife"=>'9',"sports and fitness"=>'10',"career and money"=>'11',"cars"=>'12',"health and beauty"=>'13');
  
 $Cotact_info=array('1'=>"Daily",'2'=>"Weekly",'3'=>"Bi-Weekly",'4'=>"Monthly",'5'=>"Quarterly");
$education_array=array('1'=>'Highschool','2'=>'Some College','3'=>'In College','4'=>'College Graduate');
$education_array_reverse=array('highschool'=>'1','some college'=>'2','in college'=>'3','college graduate'=>'4');

$Zipcode_Radious=array('1'=>'2','2'=>'5','3'=>'10','4'=>'15','5'=>'20','6'=>'30','7'=>'40','8'=>'50');
$campaign_Time=array('1'=>'1 AM','2'=>'2 AM','3'=>'3 AM','4'=>'4 AM','5'=>'5 AM','6'=>'6 AM','7'=>'7 AM','8'=>'8 AM','9'=>'9 AM','10'=>'10 AM','11'=>'11 AM','12'=>'12 AM','13'=>'1 PM','14'=>'2 PM','15'=>'3 PM','16'=>'4 PM','17'=>'5 PM','18'=>'6 PM','19'=>'7 PM','20'=>'8 PM','21'=>'9 PM','22'=>'10 PM','23'=>'11 PM','24'=>'12 PM');
$income_array=array('1'=>'Below $25,000','2'=>'$25,000 to $50,000','3'=>'$50,000 to $75,000','4'=>'$75,000 to $100,000','5'=>'$100,000 or more');
function getIncome($incomeValue='0')
{
$income_array=array('1'=>'Below $25,000','2'=>'$25,000 to $50,000','3'=>'$50,000 to $75,000','4'=>'$75,000 to $100,000','5'=>'$100,000 or more');

$income_array_reverse=array('below $25,000'=>'1','$25,000 to $50,000'=>'2','$50,000 to $75,000'=>'3','$75,000 to $100,000'=>'4','$100,000 or more'=>'5');

	//global $income_array;
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
function getIncomevalue($incomeValue='0')
{
$income_array=array('1'=>'Below $25,000','2'=>'$25,000 to $50,000','3'=>'$50,000 to $75,000','4'=>'$75,000 to $100,000','5'=>'$100,000 or more');

	//global $income_array;
	foreach($income_array as $k=>$v)
	{
		
		 if($k==$incomeValue)
		{
			//$options.='<option value='".$k."'  selected='selected'>$v</option>';
				$options= $v;
		}
		
	}
	return $options;

}
function Campaing_time($Score='0')
{
	global $campaign_Time;
	foreach($campaign_Time as $k=>$v)
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
function IntrestAndActivities_dropdown($intrest='0')
{
	global $Intrest_and_activitise;
	foreach($Intrest_and_activitise as $k=>$v)
	{
		
		 if($k==$intrest)
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
?>