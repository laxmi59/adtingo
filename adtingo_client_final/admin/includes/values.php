<?php
$Time_zone_info=array('-12.0'=>"(GMT -12:00) Eniwetok, Kwajalein",'-11.0'=>"(GMT -11:00) Midway Island, Samoa",'-10.0'=>"(GMT -10:00) Hawaii",'-9.0'=>"(GMT -9:00) Alaska",'-8.0'=>"(GMT -8:00) Pacific Time (US &amp; Canada)",'-7.0'=>"(GMT -7:00) Mountain Time (US &amp; Canada)",'-6.0'=>"(GMT -6:00) Central Time (US &amp; Canada), Mexico City",'-5.0'=>"(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima",'-4.0'=>"(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",'-3.5'=>"(GMT -3:30) Newfoundland",'-3.0'=>"(GMT -3:00) Brazil, Buenos Aires, Georgetown",'-2.0'=>"(GMT -2:00) Mid-Atlantic",'-1.0'=>"(GMT -1:00 hour) Azores, Cape Verde Islands",'0.0'=>"(GMT) Western Europe Time, London, Lisbon, Casablanca",'1.0'=>"(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris",'2.0'=>"(GMT +2:00) Kaliningrad, South Africa",'3.0'=>"(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",'3.5'=>"(GMT +3:30) Tehran",'4.0'=>"(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",'4.5'=>"(GMT +4:30) Kabul",'5.0'=>"(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",'5.5'=>"(GMT +5:30) Bombay, Calcutta, Madras, New Delhi",'5.75'=>"(GMT +5:45) Kathmandu",'6.0'=>"(GMT +6:00) Almaty, Dhaka, Colombo",'7.0'=>"(GMT +7:00) Bangkok, Hanoi, Jakarta",'8.0'=>"(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",'9.0'=>"(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",'9.5'=>"(GMT +9:30) Adelaide, Darwin",'10.0'=>"(GMT +10:00) Eastern Australia, Guam, Vladivostok",'11.0'=>"(GMT +11:00) Magadan, Solomon Islands, New Caledonia",'12.0'=>"(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka");
$ProductCat=array('1'=>"Clothing",'2'=>"Headwear",'3'=>"Badges/Keyrings/Magnets",'4'=>"Bags",'5'=>"Band/Artist Merchandise",'6'=>"YoYoTrax Merchandise",'7'=>"Memorabilia",'8'=>"Other");
 $Intrest_and_activitise=array('1'=>"Food and Dinning",'2'=>"Style",'3'=>"Entertainment",'4'=>"Travel",'5'=>"Nightlife",'6'=>"Home and Garden",'7'=>"Electronics and Gadgets",'8'=>"Dating",'9'=>"Nightlife",'10'=>"Sports and Fitness",'11'=>"Career and Money",'12'=>"Cars",'13'=>"Health and Beauty");
 
 $Intrest_and_activitise_reverse =array("food and dinning" => '1',"style" => '2',"entertainment"=>'3',"travel"=>'4',"nightlife"=>'5',"home and garden"=>'6',"electronics and gadgets"=>'7',"dating"=>'8',"nightlife"=>'9',"sports and fitness"=>'10',"career and money"=>'11',"cars"=>'12',"health and beauty"=>'13');

 $Cotact_info=array('1'=>"Daily",'2'=>"Weekly",'3'=>"Bi-Weekly",'4'=>"Monthly",'5'=>"Quarterly");
 $education_array=array('1'=>'Highschool','2'=>'Some College','3'=>'In College','4'=>'College Graduate');
  $education_array_reverse=array('highschool'=>'1','some college'=>'2','in college'=>'3','college graduate'=>'4');


//$income_array=array('1'=>'>10000 AND <20000','2'=>'>20000 AND <30000','3'=>'>30000 AND <40000','4'=>'>40000 AND <50000');
$income_array=array('1'=>'Below $25,000','2'=>'$25,000 to $50,000','3'=>'$50,000 to $75,000','4'=>'$75,000 to $100,000','5'=>'$100,000 or more');
$income_array_reverse=array('below $25,000'=>'1','$25,000 to $50,000'=>'2','$50,000 to $75,000'=>'3','$75,000 to $100,000'=>'4','$100,000 or more'=>'5');
$Zipcode_Radious=array('1'=>'2','2'=>'5','3'=>'10','4'=>'15','5'=>'20','6'=>'30','7'=>'40','8'=>'50');
$Zipcode_Radious_count=array('2'=>'2','5'=>'5','10'=>'10','15'=>'15','20'=>'20','30'=>'30','40'=>'40','50'=>'50');
$sq_html_ent_table = array(

        "\xC2\xA0" => '&nbsp;',
        "\xC2\xA1" => '&iexcl;',
        "\xC2\xA2" => '&cent;',
        "\xC2\xA3" => '&pound;',
        "\xC2\xA4" => '&curren;',
        "\xC2\xA5" => '&yen;',
        "\xC2\xA6" => '&brvbar;',
        "\xC2\xA7" => '&sect;',
        "\xC2\xA8" => '&uml;',
        "\xC2\xA9" => '&copy;',
        "\xC2\xAA" => '&ordf;',
        "\xC2\xAB" => '&laquo;',
        "\xC2\xAC" => '&not;',
        "\xC2\xAD" => '&shy;',
        "\xC2\xAE" => '&reg;',
        "\xC2\xAF" => '&macr;',
        "\xC2\xB0" => '&deg;',
        "\xC2\xB1" => '&plusmn;',
        "\xC2\xB2" => '&sup2;',
        "\xC2\xB3" => '&sup3;',
        "\xC2\xB4" => '&acute;',
        "\xC2\xB5" => '&micro;',
        "\xC2\xB6" => '&para;',
        "\xC2\xB7" => '&middot;',
        "\xC2\xB8" => '&cedil;',
        "\xC2\xB9" => '&sup1;',
        "\xC2\xBA" => '&ordm;',
        "\xC2\xBB" => '&raquo;',
        "\xC2\xBC" => '&frac14;',
        "\xC2\xBD" => '&frac12;',
        "\xC2\xBE" => '&frac34;',
        "\xC2\xBF" => '&iquest;',
        "\xC3\x80" => '&Agrave;',
        "\xC3\x81" => '&Aacute;',
        "\xC3\x82" => '&Acirc;',
        "\xC3\x83" => '&Atilde;',
        "\xC3\x84" => '&Auml;',
        "\xC3\x85" => '&Aring;',
        "\xC3\x86" => '&AElig;',
        "\xC3\x87" => '&Ccedil;',
        "\xC3\x88" => '&Egrave;',
        "\xC3\x89" => '&Eacute;',
        "\xC3\x8A" => '&Ecirc;',
        "\xC3\x8B" => '&Euml;',
        "\xC3\x8C" => '&Igrave;',
        "\xC3\x8D" => '&Iacute;',
        "\xC3\x8E" => '&Icirc;',
        "\xC3\x8F" => '&Iuml;',
        "\xC3\x90" => '&ETH;',
        "\xC3\x91" => '&Ntilde;',
        "\xC3\x92" => '&Ograve;',
        "\xC3\x93" => '&Oacute;',
        "\xC3\x94" => '&Ocirc;',
        "\xC3\x95" => '&Otilde;',
        "\xC3\x96" => '&Ouml;',
        "\xC3\x97" => '&times;',
        "\xC3\x98" => '&Oslash;',
        "\xC3\x99" => '&Ugrave;',
        "\xC3\x9A" => '&Uacute;',
        "\xC3\x9B" => '&Ucirc;',
        "\xC3\x9C" => '&Uuml;',
        "\xC3\x9D" => '&Yacute;',
        "\xC3\x9E" => '&THORN;',
        "\xC3\x9F" => '&szlig;',
        "\xC3\xA0" => '&agrave;',
        "\xC3\xA1" => '&aacute;',
        "\xC3\xA2" => '&acirc;',
        "\xC3\xA3" => '&atilde;',
        "\xC3\xA4" => '&auml;',
        "\xC3\xA5" => '&aring;',
        "\xC3\xA6" => '&aelig;',
        "\xC3\xA7" => '&ccedil;',
        "\xC3\xA8" => '&egrave;',
        "\xC3\xA9" => '&eacute;',
        "\xC3\xAA" => '&ecirc;',
        "\xC3\xAB" => '&euml;',
        "\xC3\xAC" => '&igrave;',
        "\xC3\xAD" => '&iacute;',
        "\xC3\xAE" => '&icirc;',
        "\xC3\xAF" => '&iuml;',
        "\xC3\xB0" => '&eth;',
        "\xC3\xB1" => '&ntilde;',
        "\xC3\xB2" => '&ograve;',
        "\xC3\xB3" => '&oacute;',
        "\xC3\xB4" => '&ocirc;',
        "\xC3\xB5" => '&otilde;',
        "\xC3\xB6" => '&ouml;',
        "\xC3\xB7" => '&divide;',
        "\xC3\xB8" => '&oslash;',
        "\xC3\xB9" => '&ugrave;',
        "\xC3\xBA" => '&uacute;',

        "\xC3\xBB" => '&ucirc;',

        "\xC3\xBC" => '&uuml;',

        "\xC3\xBD" => '&yacute;',

        "\xC3\xBE" => '&thorn;',

        "\xC3\xBF" => '&yuml;',

        "\xC5\x92" => '&OElig;',

        "\xC5\x93" => '&oelig;',

        "\xC5\xA0" => '&Scaron;',

        "\xC5\xA1" => '&scaron;',

        "\xC5\xB8" => '&Yuml;',

        "\xCB\x86" => '&circ;',

        "\xCB\x9C" => '&tilde;',

        "\xE2\x80\x82" => '&ensp;',

        "\xE2\x80\x83" => '&emsp;',

        "\xE2\x80\x89" => '&thinsp;',

        "\xE2\x80\x8C" => '&zwnj;',

        "\xE2\x80\x8D" => '&zwj;',

        "\xE2\x80\x8E" => '&lrm;',

        "\xE2\x80\x8F" => '&rlm;',

        "\xE2\x80\x93" => '&ndash;',

        "\xE2\x80\x94" => '&mdash;',

        "\xE2\x80\x98" => '&lsquo;',

        "\xE2\x80\x99" => '&rsquo;',

        "\xE2\x80\x9A" => '&sbquo;',

        "\xE2\x80\x9C" => '&ldquo;',

        "\xE2\x80\x9D" => '&rdquo;',

        "\xE2\x80\x9E" => '&bdquo;',

        "\xE2\x80\xA0" => '&dagger;',

        "\xE2\x80\xA1" => '&Dagger;',

        "\xE2\x80\xB0" => '&permil;',

        "\xE2\x80\xB9" => '&lsaquo;',

        "\xE2\x80\xBA" => '&rsaquo;',

        "\xE2\x82\xAC" => '&euro;',

        "\xC6\x92" => '&fnof;',

        "\xCE\x91" => '&Alpha;',

        "\xCE\x92" => '&Beta;',

        "\xCE\x93" => '&Gamma;',

        "\xCE\x94" => '&Delta;',

        "\xCE\x95" => '&Epsilon;',

        "\xCE\x96" => '&Zeta;',

        "\xCE\x97" => '&Eta;',

        "\xCE\x98" => '&Theta;',

        "\xCE\x99" => '&Iota;',

        "\xCE\x9A" => '&Kappa;',

        "\xCE\x9B" => '&Lambda;',

        "\xCE\x9C" => '&Mu;',

        "\xCE\x9D" => '&Nu;',

        "\xCE\x9E" => '&Xi;',

        "\xCE\x9F" => '&Omicron;',

        "\xCE\xA0" => '&Pi;',

        "\xCE\xA1" => '&Rho;',

        "\xCE\xA3" => '&Sigma;',

        "\xCE\xA4" => '&Tau;',

        "\xCE\xA5" => '&Upsilon;',

        "\xCE\xA6" => '&Phi;',

        "\xCE\xA7" => '&Chi;',

        "\xCE\xA8" => '&Psi;',

        "\xCE\xA9" => '&Omega;',

        "\xCE\xB1" => '&alpha;',

        "\xCE\xB2" => '&beta;',

        "\xCE\xB3" => '&gamma;',

        "\xCE\xB4" => '&delta;',

        "\xCE\xB5" => '&epsilon;',

        "\xCE\xB6" => '&zeta;',

        "\xCE\xB7" => '&eta;',

        "\xCE\xB8" => '&theta;',

        "\xCE\xB9" => '&iota;',

        "\xCE\xBA" => '&kappa;',

        "\xCE\xBB" => '&lambda;',

        "\xCE\xBC" => '&mu;',

        "\xCE\xBD" => '&nu;',

        "\xCE\xBE" => '&xi;',

        "\xCE\xBF" => '&omicron;',

        "\xCF\x80" => '&pi;',

        "\xCF\x81" => '&rho;',

        "\xCF\x82" => '&sigmaf;',

        "\xCF\x83" => '&sigma;',

        "\xCF\x84" => '&tau;',

        "\xCF\x85" => '&upsilon;',

        "\xCF\x86" => '&phi;',

        "\xCF\x87" => '&chi;',

        "\xCF\x88" => '&psi;',

        "\xCF\x89" => '&omega;',

        "\xCF\x91" => '&thetasym;',

        "\xCF\x92" => '&upsih;',

        "\xCF\x96" => '&piv;',

        "\xE2\x80\xA2" => '&bull;',

        "\xE2\x80\xA6" => '&hellip;',

        "\xE2\x80\xB2" => '&prime;',

        "\xE2\x80\xB3" => '&Prime;',

        "\xE2\x80\xBE" => '&oline;',

        "\xE2\x81\x84" => '&frasl;',

        "\xE2\x84\x98" => '&weierp;',

        "\xE2\x84\x91" => '&image;',

        "\xE2\x84\x9C" => '&real;',

        "\xE2\x84\xA2" => '&trade;',

        "\xE2\x84\xB5" => '&alefsym;',

        "\xE2\x86\x90" => '&larr;',

        "\xE2\x86\x91" => '&uarr;',

        "\xE2\x86\x92" => '&rarr;',

        "\xE2\x86\x93" => '&darr;',

        "\xE2\x86\x94" => '&harr;',

        "\xE2\x86\xB5" => '&crarr;',

        "\xE2\x87\x90" => '&lArr;',

        "\xE2\x87\x91" => '&uArr;',

        "\xE2\x87\x92" => '&rArr;',

        "\xE2\x87\x93" => '&dArr;',

        "\xE2\x87\x94" => '&hArr;',

        "\xE2\x88\x80" => '&forall;',

        "\xE2\x88\x82" => '&part;',

        "\xE2\x88\x83" => '&exist;',

        "\xE2\x88\x85" => '&empty;',

        "\xE2\x88\x87" => '&nabla;',

        "\xE2\x88\x88" => '&isin;',

        "\xE2\x88\x89" => '&notin;',

        "\xE2\x88\x8B" => '&ni;',

        "\xE2\x88\x8F" => '&prod;',

        "\xE2\x88\x91" => '&sum;',

        "\xE2\x88\x92" => '&minus;',

        "\xE2\x88\x97" => '&lowast;',

        "\xE2\x88\x9A" => '&radic;',

        "\xE2\x88\x9D" => '&prop;',

        "\xE2\x88\x9E" => '&infin;',

        "\xE2\x88\xA0" => '&ang;',

        "\xE2\x88\xA7" => '&and;',

        "\xE2\x88\xA8" => '&or;',

        "\xE2\x88\xA9" => '&cap;',

        "\xE2\x88\xAA" => '&cup;',

        "\xE2\x88\xAB" => '&int;',

        "\xE2\x88\xB4" => '&there4;',

        "\xE2\x88\xBC" => '&sim;',

        "\xE2\x89\x85" => '&cong;',

        "\xE2\x89\x88" => '&asymp;',

        "\xE2\x89\xA0" => '&ne;',

        "\xE2\x89\xA1" => '&equiv;',

        "\xE2\x89\xA4" => '&le;',

        "\xE2\x89\xA5" => '&ge;',

        "\xE2\x8A\x82" => '&sub;',

        "\xE2\x8A\x83" => '&sup;',

        "\xE2\x8A\x84" => '&nsub;',

        "\xE2\x8A\x86" => '&sube;',

        "\xE2\x8A\x87" => '&supe;',

        "\xE2\x8A\x95" => '&oplus;',

        "\xE2\x8A\x97" => '&otimes;',

        "\xE2\x8A\xA5" => '&perp;',

        "\xE2\x8B\x85" => '&sdot;',

        "\xE2\x8C\x88" => '&lceil;',

        "\xE2\x8C\x89" => '&rceil;',

        "\xE2\x8C\x8A" => '&lfloor;',

        "\xE2\x8C\x8B" => '&rfloor;',

        "\xE2\x8C\xA9" => '&lang;',

        "\xE2\x8C\xAA" => '&rang;',

        "\xE2\x97\x8A" => '&loz;',

        "\xE2\x99\xA0" => '&spades;',

        "\xE2\x99\xA3" => '&clubs;',

        "\xE2\x99\xA5" => '&hearts;',

        "\xE2\x99\xA6" => '&diams;'

    );

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
function Get_Zipcode_Radious_Count($Score='0')
{
	global $Zipcode_Radious_count;
	foreach($Zipcode_Radious_count as $k=>$v)
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

