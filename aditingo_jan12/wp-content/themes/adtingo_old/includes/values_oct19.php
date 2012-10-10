<?php
$Time_zone_info=array('-12.0'=>"(GMT -12:00) Eniwetok, Kwajalein",'-11.0'=>"(GMT -11:00) Midway Island, Samoa",'-10.0'=>"(GMT -10:00) Hawaii",'-9.0'=>"(GMT -9:00) Alaska",'-8.0'=>"(GMT -8:00) Pacific Time (US &amp; Canada)",'-7.0'=>"(GMT -7:00) Mountain Time (US &amp; Canada)",'-6.0'=>"(GMT -6:00) Central Time (US &amp; Canada), Mexico City",'-5.0'=>"(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima",'-4.0'=>"(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",'-3.5'=>"(GMT -3:30) Newfoundland",'-3.0'=>"(GMT -3:00) Brazil, Buenos Aires, Georgetown",'-2.0'=>"(GMT -2:00) Mid-Atlantic",'-1.0'=>"(GMT -1:00 hour) Azores, Cape Verde Islands",'0.0'=>"(GMT) Western Europe Time, London, Lisbon, Casablanca",'1.0'=>"(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris",'2.0'=>"(GMT +2:00) Kaliningrad, South Africa",'3.0'=>"(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",'3.5'=>"(GMT +3:30) Tehran",'4.0'=>"(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",'4.5'=>"(GMT +4:30) Kabul",'5.0'=>"(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",'5.5'=>"(GMT +5:30) Bombay, Calcutta, Madras, New Delhi",'5.75'=>"(GMT +5:45) Kathmandu",'6.0'=>"(GMT +6:00) Almaty, Dhaka, Colombo",'7.0'=>"(GMT +7:00) Bangkok, Hanoi, Jakarta",'8.0'=>"(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",'9.0'=>"(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",'9.5'=>"(GMT +9:30) Adelaide, Darwin",'10.0'=>"(GMT +10:00) Eastern Australia, Guam, Vladivostok",'11.0'=>"(GMT +11:00) Magadan, Solomon Islands, New Caledonia",'12.0'=>"(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka");
$education_array=array('1'=>'Highschool','2'=>'Some College','3'=>'In College','4'=>'College Graduate');

 $Cotact_info=array('1'=>"Daily",'2'=>"Weekly",'3'=>"Bi-Weekly",'4'=>"Monthly",'5'=>"Quarterly");
  $Intrest_and_activitise=array('1'=>"Food and Dinning",'2'=>"Style",'3'=>"Entertainment",'4'=>"Travel",'5'=>"Nightlife",'6'=>"Home and Garden",'7'=>"Electronics and Gadgets",'8'=>"Dating",'9'=>"Nightlife",'10'=>"Sports and Fitness",'11'=>"Career and Money",'12'=>"Cars",'13'=>"Health and Beauty");
//$education_array=array('1'=>'Highschool','2'=>'Some College','3'=>'In College','4'=>'College Graduate');

$income_array=array('1'=>'&gt;10000 AND &lt;20000','2'=>'&gt;20000 AND &lt;30000','3'=>'&gt;30000 AND &lt;40000','4'=>'&gt;40000 AND &lt;50000');
function Contact_info_data($Score='0')
{ $Cotact_info=array('1'=>"Daily",'2'=>"Weekly",'3'=>"Bi-Weekly",'4'=>"Monthly",'5'=>"Quarterly");
	//echo $Cotact_info;
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

function Timezone_info_data($Score='0')
{

	//global $Time_zone_info;
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
function IntrestAndActivities($Score='0')
{
  $Intrest_and_activitise=array('1'=>"Food and Dinning",'2'=>"Style",'3'=>"Entertainment",'4'=>"Travel",'5'=>"Nightlife",'6'=>"Home and Garden",'7'=>"Electronics and Gadgets",'8'=>"Dating",'9'=>"Nightlife",'10'=>"Sports and Fitness",'11'=>"Career and Money",'12'=>"Cars",'13'=>"Health and Beauty");
	//global $Intrest_and_activitise;
	foreach($Intrest_and_activitise as $k=>$v)
	{
		
		 if($k==$Score)
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
/**** START CODE FOR  displaying month, day and year values in drop down  *****/
function dateArray($month_value="",$day_value="",$year_value="",$yearFrom,$yearTo)
{
	//before last year to curent year
	
		//$year5=date("Y"); 
		//$yearFrom=date("Y")-50;
		//$yearTo=date("Y")-18;
	/* FOr displaying months, days and years  */
	
	$days31=array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
	$days30=array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30");
	$days29=array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29");
	$yearArray=array($y4,$y3,$y1,$y2);
	//$monthArray=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$monthArray=array("1"=>"Jan","2"=>"Feb","3"=>"Mar","4"=>"Apr","5"=>"May","6"=>"Jun","7"=>"Jul","8"=>"Aug","9"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");
	$months='';
	foreach($monthArray as $key => $value)
	{	
		if($key==$month_value)
		$months.='<option value="'.$key.'" selected="selected">'.$value.'</option>';
		else		
		$months.='<option value="'.$key.'">'.$value.'</option>';
	}
	
	$days='';
	foreach($days31 as $value)
	{
		if($value==$day_value)
		$days.='<option value="'.$value.'" selected="selected">'.$value.'</option>';
		else		
		$days.='<option value="'.$value.'">'.$value.'</option>';
	}
	
	$years='';
	for($value=$yearFrom; $value<=$yearTo;$value++)
	{
		if($value==$year_value)
		$years.='<option value="'.$value.'" selected="selected">'.$value.'</option>';
		else		
		$years.='<option value="'.$value.'">'.$value.'</option>';
	}
	// End for displaying part of days months and years
	
	$complete_date_array=array($months,$days,$years);
	
	return $complete_date_array;
}
function getEducation($educationValue='0')
{
$education_array=array('1'=>'Highschool','2'=>'Some College','3'=>'In College','4'=>'College Graduate');
	
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
	return  $options;

}
function getIncome($incomeValue='0')
{
$income_array=array('1'=>'&gt;10000 AND &lt;20000','2'=>'&gt;20000 AND &lt;30000','3'=>'&gt;30000 AND &lt;40000','4'=>'&gt;40000 AND &lt;50000');
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
?>
