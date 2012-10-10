<?php
include("dbfiler.php");	
//error_reporting(0);
ob_start();
session_start();

$months_arr=array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"Octorber","11"=>"November","12"=>"December");

class main extends DBFilter
{
	//to get the no of days when the video or comment has been added
	function daysago($difference,$timediff=false)
	{
		$timediffarr=explode(":",$timediff);
		//when the no of days is zero
		if($difference<1)
		{
			if($timediffarr[0]==1)
			$ago=$timediffarr[0]." hour ago";
			
			else if(($timediffarr[0]<1)&&($timediffarr[1]!=1))
			{
				$ago=$timediffarr[1]." minutes ago";
				if($timediffarr[1]<=0)
				$ago=$timediffarr[2]." seconds ago";
				
			}
			else if($timediffarr[1]==1)
			$ago=$timediffarr[1]." minute ago";	

			else if($timediffarr[0]>1)
			$ago=$timediffarr[0]." hours ago";
			
		}
		//when the no of days is one
		else if($difference==1)
		$ago=$difference." day ago";
		//when the no of days is greater than one week
		else if($difference<7)
		$ago=$difference." days ago";		
		else if($difference>=7)
		{
			$weeks=$difference/7;
			if($weeks==1)
			$ago=$weeks." week ago";
			else if(ceil($weeks)>=5)
			{	
				$months=ceil($weeks)/5;
				if(ceil($months)==1)
				$ago="1 month ago";
				else if((ceil($months)>1)&&(ceil($months)<12))
				$ago=ceil($months)." months ago";
				else if(ceil($months)==12)
				$ago="1 year ago";
				else if(ceil($months)>12)
				$ago=ceil(ceil($months)/12)." years ago";
			}
			else if(ceil($weeks)<5)
			$ago=ceil($weeks)." weeks ago";
		}
		return $ago;
	}
	
	//function to include top navigation in admin side
	function modifier_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
	{
		if ($length == 0)
			return '';
	
		if (strlen($string) > $length) {
			$length -= strlen($etc);
			if (!$break_words && !$middle) {
				$string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
			}
			if(!$middle) {
				return substr($string, 0, $length).$etc;
			} else {
				return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
			}
		} else {
			return $string;
		}
	}
	
	function paginationTop($cols=0,$Limit=10,$page="")
	{
		//global $pager;
		if($page=="")
			$page=1;	
		else
			$page=$page;
		$limit=$Limit;//no.of records perpage
		$total =$cols;
		$pager  = Pager::getPagerData($total, $limit, $page);	
		if($total==0 )
			$offset =0;
		else
			$offset = $pager->offset; 
		
		$limit  = $pager->limit;
		$page   = $pager->page;
		
		$limit2=array($offset => $limit);
		if($page==1)
		{
			$pg=0;
		}
		else
		{
			$pg=($page-1)*$limit;
		}
		return $pg;
	}
	
	
function GetCampaignSearchResult($arealist="",$gender="",$education="",$incomeval="",$keywordsarry="",$minage="",$maxage="",$zipcodedb="",$shddate="",$Campaign_ID="",$random_number)
{
	$where=1;
	//echo $gender;
	if($arealist!="")
		$where.=" and tbl_member_metropolitian.area_id=".$arealist."";
	
	if($gender!="" && $gender!="both")
		$where.=" and tbl_members.gender='".$gender."'";
	
	if($incomeval!="" && $incomeval!="0")
	{
		$where.=" and tbl_members.income =".$incomeval."";
	}
	if($minage!=""  && $maxage!="" && $maxage!="0")
	{
		$where.="  and YEAR(CURRENT_DATE)-YEAR(dob)>=".$minage." and YEAR(CURRENT_DATE)-YEAR(dob)<=".$maxage."";
	}
	
	if($zipcodedb!="")
		$where.= $zipcodedb;
	
	
	$SqlSearch_result="select * from tbl_members,tbl_member_metropolitian  where $where and tbl_members.memberid = tbl_member_metropolitian.memberid ";    
	$ResSearch_result=$this->ExecuteQuery($SqlSearch_result);
	//$TotalSearchRecords=$this->NumRows($ResSearch_result);
	//echo $TotalSearchRecords;
	$TotalSearchRecordslist="0";
	$GetTotalSearchListRecords=array();
	while($ResSearch_resultRec=$this->FetchArray($ResSearch_result))
	{
		$GetAllRecordsQry="select * from tbl_listedmembers where memberid=".$ResSearch_resultRec['memberid']."";
		$GetAllRecordsRes=$this->ExecuteQuery($GetAllRecordsQry);
		$GetTotalRec =$this->NumRows($GetAllRecordsRes);
		if($GetTotalRec >0)
		{
			$where=1;
			$scheduleDate1=explode("-",$shddate);
			if($ResSearch_resultRec['contact_time']==1)
				$where.="  and schedule_date='".$shddate."'";
			else if($ResSearch_resultRec['contact_time']==2)
			{
				$Contact_date1=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]-7, $scheduleDate1[0]));
				$Contact_date2=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]+7, $scheduleDate1[0]));
				$where.=" and (schedule_date >='".$Contact_date1."' AND schedule_date <='".$Contact_date2."')";
			}
			else if($ResSearch_resultRec['contact_time']==3)
			{
				$Contact_date1=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]-14, $scheduleDate1[0]));
				$Contact_date2=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]+14, $scheduleDate1[0]));
				$where.=" and (schedule_date >='".$Contact_date1."' AND schedule_date <='".$Contact_date2."')";
			}
			else if($ResSearch_resultRec['contact_time']==4)
			{
				$Contact_date1=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]-30, $scheduleDate1[0]));
				$Contact_date2=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]+30, $scheduleDate1[0]));
				$where.=" and (schedule_date >='".$Contact_date1."' AND schedule_date <='".$Contact_date2."')";
			}
			else if($ResSearch_resultRec['contact_time']==5)
			{
				$Contact_date1=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]-90, $scheduleDate1[0]));
				$Contact_date2=date("Y-m-d", mktime(0, 0, 0, $scheduleDate1[1], $scheduleDate1[2]+90, $scheduleDate1[0]));
				$where.=" and (schedule_date >='".$Contact_date1."' AND schedule_date <='".$Contact_date2."')";
			}
			$GetTotalRecordsToSent="select * from tbl_listedmembers where $where and memberid=".$ResSearch_resultRec['memberid']."";    
			$GetTotalRecordsToSentRes=$this->ExecuteQuery($GetTotalRecordsToSent);
			$TotalSearchRecords =$this->NumRows($GetTotalRecordsToSentRes);
			if($TotalSearchRecords <=0)
			{
				$GetTotalSearchListRecords[]=$ResSearch_resultRec['memberid'];
				$TotalSearchRecordslist = $TotalSearchRecordslist+1;
		
			}
		}
		else
		{
			$TotalSearchRecordslist=$TotalSearchRecordslist+1;
			$GetTotalSearchListRecords[]=$ResSearch_resultRec['memberid'];
		}  
	}
	
	//  count(($GetTotalSearchListRecords));
	//print_r($GetTotalSearchListRecords);
	$GetTotalSearchListRecords1=implode(",",$GetTotalSearchListRecords);
	$TotalSearchRecordslist."&&&".$GetTotalSearchListRecords1;
	if($random_number!="" && $GetTotalSearchListRecords1!="")
	{
		$randcon.=" ORDER BY RAND() LIMIT ".$random_number.";";
		$getFinalList="select * from tbl_members where memberid in($GetTotalSearchListRecords1) $randcon";
		$resFinalList=$this->ExecuteQuery($getFinalList);
		while($recFinalList=$this->FetchArray($resFinalList)){
			$FinalList[]=$recFinalList['memberid'];
		}
		$GetFinalSearchListRecords1=implode(",",$FinalList);
		return $random_number."&&&".$GetFinalSearchListRecords1;
	}else{
		return $TotalSearchRecordslist."&&&".$GetTotalSearchListRecords1;
	}
}
	
	
	
	
	function GetAllTheCamRecords($cid)
	{
		//$Camid=$_GET['cid'];
 		$GetAllRecordsqry="select * from tbl_listedmembers where campaign_id='".$cid."'";
		$GetAllRecordsRes=$this->ExecuteQuery($GetAllRecordsqry);
 		$totalRecords=$this->NumRows($GetAllRecordsRes); 
		return $totalRecords;		
	}
	
	
	
	
	
	
	
	
	
	function userpaginationBottom($cols=0,$Limit=10,$page="",$pagename)
	{
		$pagecontent="";
		if($cols>$Limit)
		{
			$let=ceil($cols/$Limit);
			$addpages=4;
			if($page<=$addpages)
			$pgMinLimit=1;
			else
			$pgMinLimit=$page-$addpages;
			if($page<$let-$addpages)
			$pgMaxLimit=$page+$addpages;
			else
			$pgMaxLimit=$let;
	

			if($page>1) 
			{
				$pagecontent.='<a href="'.$pagename.'&page='.($page-1).'&limit='.$_REQUEST['limit'].'"><img src="images/pre.gif" alt="Go to Previous page" align="absmiddle" /></a>&nbsp;<input name="page" type="text" class="input2" value="'.$page.'" size="2" onchange=pagelist(this.value,"'.$pagename.'","'.$_REQUEST['limit'].'")>';
			}
			else
			{
				$pagecontent.='<span class="fontlightgray"><img src="images/pre-off.gif" alt="Go to Previous page" align="absmiddle" /></span>&nbsp;<input name="page" type="text" class="input2" value="'.$page.'" size="2" onchange=pagelist(this.value,"'.$pagename.'","'.$_REQUEST['limit'].'")>';
			}
			
			if($page<$let) 
			{
				$pagecontent.='&nbsp;<a href="'.$pagename.'&page='.($page+1).'&limit='.$_REQUEST['limit'].'"><img src="images/next.gif" alt="Go to Previous page" align="absmiddle" /></a>';
			}
			else
			{
				$pagecontent.='&nbsp;<span class="fontlightgray"><img src="images/next-off.gif" alt="Go to Previous page" align="absmiddle" /></span>';
			}
		}

		return $pagecontent;
	}

	function userpaginationBottom_cust($cols=0,$Limit=10,$page="",$pagename)
	{
		$pagecontent="";
		if($cols>$Limit)
		{
			$let=ceil($cols/$Limit);
			$addpages=4;
			if($page<=$addpages)
			$pgMinLimit=1;
			else
			$pgMinLimit=$page-$addpages;
			if($page<$let-$addpages)
			$pgMaxLimit=$page+$addpages;
			else
			$pgMaxLimit=$let;
	

			if($page>1) 
			{
				$pagecontent.='<a href="'.$pagename.'&page_cust='.($page-1).'&limit_cust='.$_REQUEST['limit_cust'].'"><img src="images/pre.gif" alt="Go to Previous page" align="absmiddle" /></a>&nbsp;<input name="page" type="text" class="input2" value="'.$page.'" size="2" onchange=pagelist(this.value,"'.$pagename.'","'.$_REQUEST['limit_cust'].'")>';
			}
			else
			{
				$pagecontent.='<span class="fontlightgray"><img src="images/pre-off.gif" alt="Go to Previous page" align="absmiddle" /></span>&nbsp;<input name="page" type="text" class="input2" value="'.$page.'" size="2" onchange=pagelist(this.value,"'.$pagename.'","'.$_REQUEST['limit_cust'].'")>';
			}
			
			if($page<$let) 
			{
				$pagecontent.='&nbsp;<a href="'.$pagename.'&page_cust='.($page+1).'&limit_cust='.$_REQUEST['limit_cust'].'"><img src="images/next.gif" alt="Go to Previous page" align="absmiddle" /></a>';
			}
			else
			{
				$pagecontent.='&nbsp;<span class="fontlightgray"><img src="images/next-off.gif" alt="Go to Previous page" align="absmiddle" /></span>';
			}
		}

		return $pagecontent;
	}


//********** Start COde for deleting Folder Function *************//
	function delete_directory($dir)
	{
		if ($handle = opendir($dir))
		{
			$array = array();	
			while (false !== ($file = readdir($handle))) 
			{
				if ($file != "." && $file != "..") 
				{
	
					if(is_dir($dir.$file))
					{
						if(!@rmdir($dir.$file)) // Empty directory? Remove it
						{
							delete_directory($dir.$file.'/'); // Not empty? Delete the files inside it
						}
					}
					else
					{
						@unlink($dir.$file);
					}
				}
			}
			closedir($handle);
			@rmdir($dir);
		}
	}

//********** End COde for deleting Folder Function *************//

//********** Start COde file uploading Function *************//


function upload($filedir,$source,$source_name,$up_flag,$lastname)
	{
		if (!file_exists($filedir))
		{
			mkdir($filedir,0777);
		}
		@chmod($filedir,0777);
		if (!$lastname)
		{
			$lastname=$source_name;
		}
		//if (file_exists($filedir.$lastname))
//		{
			if ($up_flag=="y")
			{
			$dest=$filedir.$lastname;
			@unlink("$filedir/$lastname");
			return(move_uploaded_file($dest,$source));
			return true;
			}
			else
			 false;
	//	}
//		else
//		{
//			$dest= $filedir;
//			return move_uploaded_file($dest,$source.$lastname);
//		}
	}
//********** End COde file uploading Function *************//







//******* START CODE FOR SELECTING ARRAY VALUES ************//

function select_function($disparray,$passed_value="")
{
	$select_str="";
	foreach($disparray as $key=>$value)
	{	
		if($passed_value==$key)
			$select_str.="<option value=".$key." selected='selected' >".$value."</option>";
		else
			$select_str.="<option value=".$key." >".$value."</option>";
	}
	return $select_str;
}


//******* END CODE FOR SELECTING ARRAY VALUES ************//


//******** START CODE FOR DISPLAYING BANNER SIZE ********//
function getbannertypename($type)
{
	if($type==0)
		$name='Leaderboard (728 x 90 pixel)';
	else
		$name='Skyscraper (120 x 600 pixel)';
		
		return $name;
}
//******** END CODE FOR DISPLAYING BANNER SIZE ********//

//******** START CODE FOR DISPLAYING BANNER SIZE ********//
function getbannerimgpath($type)
{
	if($type==0)
		$path=ADV_BAN_LB;		
	else 
		$path=ADV_BAN_SKY;
		
		return $path;
}
//******** END CODE FOR DISPLAYING BANNER SIZE ********//

//****** START CODE FOR EXPLODE DB DATE AND DISPLAY *********//
function getdbdateexp($date)
{
	$date_valid=explode("-",$date); 
	$date=$date_valid[1]."/".$date_valid[2]."/".$date_valid[0]; 
	
	return $date;
}

//****** END CODE FOR EXPLODE DB DATE AND DISPLAY *********//


//***** START CODE FOR DELETING SELECTED BANNER *******//
function deletebanner($bid)
{
	$SqlDeleteBanner=sprintf("DELETE FROM tbl_advbanners where BannerID=%d ",$this->stripper($bid));
	$QryDeleteBanner=$this->ExecuteQuery($SqlDeleteBanner);

	return $QryDeleteBanner;

}
//***** END CODE FOR DELETING SELECTED BANNER *******//
//***** START CODE FOR DELETING SELECTED PRODUCT *******//
function deleteProduct($pid)
{
	$SqlDeleteProduct=sprintf("DELETE FROM tbl_merchandise where MerchandiseID=%d ",$this->stripper($pid));
	$QryDeleteProduct=$this->ExecuteQuery($SqlDeleteProduct);

	return $QryDeleteProduct;

}
//***** END CODE FOR DELETING SELECTED PRODUCT *******//
//***** START CODE FOR RETRIVING STATE LIST *******//
function getStatesList($stateid)
{
	$displayStateDropdown="";
	$getStates=sprintf("select * from tbl_states WHERE CountryID=1");
	$getStatesresult=$this->ExecuteQuery($getStates);
	while($getStatesrecords=$this->FetchArray($getStatesresult))
	{
		if($getStatesrecords['StateID']=="$stateid")
		$displayStateDropdown.='<option value="'.$getStatesrecords['StateID'].'" selected="seleted">'.ucfirst(strtolower($getStatesrecords['StateName'])).'</option>';
		else
		$displayStateDropdown.='<option value="'.$getStatesrecords['StateID'].'">'.ucfirst(strtolower($getStatesrecords['StateName'])).'</option>';
	}
	return $displayStateDropdown;
}
//***** END CODE FOR RETRIVING STATE LIST *******//

//***** START CODE FOR RETRIVING COUNTRY LIST *******//
function getCountriesList($countryid='')
{
	$displayCountryDropdown="";
	$getCountries=sprintf("select * from tbl_countries");
	$getCountriesresult=$this->ExecuteQuery($getCountries);
	while($getCountriesrecords=$this->FetchArray($getCountriesresult))
	{
		if($getCountriesrecords['CountryID']==$countryid)
		$displayCountryDropdown.='<option value="'.$getCountriesrecords['CountryID'].'" selected="seleted">'.$getCountriesrecords['CountryName'].'</option>';
		else
		$displayCountryDropdown.='<option value="'.$getCountriesrecords['CountryID'].'">'.$getCountriesrecords['CountryName'].'</option>';
	}
	return $displayCountryDropdown;
}
//***** END CODE FOR RETRIVING COUNTRY LIST *******//

//***** START CODE FOR RETRIVING CREDIT CARD LIST *******//
function getCCList($CCID)
{
	$displayCCDropdown="";
	$getcctype=sprintf("select * from tbl_creditcard");
	$Qrygetcctype=$this->ExecuteQuery($getcctype);
	while($Resgetcctype=$this->FetchArray($Qrygetcctype))
	{
		if($Resgetcctype['CreditCardAbbv']==$CCID)
		$displayCCDropdown.='<option value="'.$Resgetcctype['CreditCardAbbv'].'" selected="seleted">'.$Resgetcctype['CreditCard'].'</option>';
		else
		$displayCCDropdown.='<option value="'.$Resgetcctype['CreditCardAbbv'].'">'.$Resgetcctype['CreditCard'].'</option>';
	}
	return $displayCCDropdown;
}
//***** END CODE FOR RETRRIVING CREDIT CARD LIST *******//

//***** START CODE FOR DISPLAYING YEAR LIST *******//

function getYearList($year)
{
	$displayYearDropdown="";
	$current_year=date("Y");
	$year_plus=date("Y")+20;
							
	for($i=$current_year;$i<$year_plus;$i++)
	{
		if($year==$i)
			$displayYearDropdown.="<option value=".$i." selected='selected'> ".$i." </option>";
		else
			$displayYearDropdown.="<option value=".$i."> ".$i." </option>";
	}
	return $displayYearDropdown;
}
//***** END CODE FOR DISPLAYING YEAR LIST *******//
//******* START CODE FOR RETRVING SELECTED Subscritpion **********// 
//function 
//******* END CODE FOR RETRVING SELECTED Subscritpion **********// 

//***** START CODE FOR DISPLAYING Subscritpion LIST *******//

function getSubscritpionList($subid)
{
	
	$displaySubscradio="";
	$getsubtype=sprintf("select * from tbl_subscriptions where Status='1'");
	$Qrysubtype=$this->ExecuteQuery($getsubtype);	
	$i=1;
	while($Ressubtype=$this->FetchArray($Qrysubtype))
	{
	
		if($subid==$Ressubtype['SubscriptionID'])
			$displaySubscradio.='<li><input type="radio" checked="checked" name="Subscriptions" id="SubscriptionID'.$i.'" value="'.$Ressubtype['SubscriptionID'].'" />&nbsp;'.$Ressubtype['PackageName'].'=&nbsp;<span>&pound;'.$Ressubtype['Price'].'</span></li>';
		else
			$displaySubscradio.='<li><input type="radio" name="Subscriptions" id="SubscriptionID'.$i.'" value="'.$Ressubtype['SubscriptionID'].'" />&nbsp;'.$Ressubtype['PackageName'].'=&nbsp;<span>&pound;'.$Ressubtype['Price'].'</span></li>';
			$i++;
	}
	return $displaySubscradio;
}
//***** END CODE FOR DISPLAYING Subscritpion LIST *******//


//***** START CODE FOR DISPLAYING Subscritpion LIST *******//

function getAllValidSubscritpionList($price)
{
	
	$displaySubscradio="";
	$getsubtype=sprintf("select * from tbl_subscriptions where Status='1'");
	$Qrysubtype=$this->ExecuteQuery($getsubtype);	
	$i=1;
	while($Ressubtype=$this->FetchArray($Qrysubtype))
	{
	
		if($price<$Ressubtype['Price'])
			$displaySubscradio.='<li><input type="radio"  name="Subscriptions" id="SubscriptionID'.$i.'" value="'.$Ressubtype['SubscriptionID'].'" onclick="javascript:calculatePrice('.$Ressubtype['SubscriptionID'].','.$Ressubtype['Price'].','.$Ressubtype['TracksNum'].');" />&nbsp;'.$Ressubtype['PackageName'].'=&nbsp;<span>&pound;'.$Ressubtype['Price'].'</span></li>';
		else
			$displaySubscradio.='<li><input type="radio" disabled="disabled" name="Subscriptions" id="SubscriptionID'.$i.'" value="'.$Ressubtype['SubscriptionID'].'"  />&nbsp;'.$Ressubtype['PackageName'].'=&nbsp;<span>&pound;'.$Ressubtype['Price'].'</span></li>';
			$i++;
	}
	return $displaySubscradio;
}
//***** END CODE FOR DISPLAYING Subscritpion LIST *******//


//***** START CODE FOR RETRVING SELECTED Primary Genere NAME *******//
function GetCampaignName($cid)
{
	$SqlgetCamName=sprintf("select campaign_name FROM tbl_campaigns where campaign_id=%d ",$this->stripper($cid));
	$ResgetCamName=$this->ExecuteQuery($SqlgetCamName);
	$RecgetCamName=$this->FetchArray($ResgetCamName);
	$campaign_name=$RecgetCamName['campaign_name'];
	
	return $campaign_name;

}

function GetClientName($cid)
{
	$SqlgetClientName=sprintf("select full_name FROM tbl_clients where clientid=%d ",$this->stripper($cid));
	$ResgetClientName=$this->ExecuteQuery($SqlgetClientName);
	$RecgetClientName=$this->FetchArray($ResgetClientName);
	$full_name=$RecgetClientName['full_name'];
	
	return $full_name;

}
function GetClientCompanyName($cid)
{
	$SqlgetClientName=sprintf("select company_name FROM tbl_clients where clientid=%d ",$this->stripper($cid));
	$ResgetClientName=$this->ExecuteQuery($SqlgetClientName);
	$RecgetClientName=$this->FetchArray($ResgetClientName);
	$CompanyName=$RecgetClientName['company_name'];
	
	return $CompanyName;

}


function Getmetropolitianareas($Score)
{
	 $SqlGetmetropolitianareas=sprintf("select * FROM tbl_metropolitian_list  ORDER BY area_name ASC");
	$QryGetmetropolitianareas=$this->ExecuteQuery($SqlGetmetropolitianareas);
	$QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas);
	 while($QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas))
	 {
	
	 if($QryGetmetropolitianareasRec['area_id']==$Score)
		{
			$options.= "<option value=".$QryGetmetropolitianareasRec[area_id]." selected='selected'>".$QryGetmetropolitianareasRec['area_name']."</option>";
		}
		else
		{
			$options.= "<option value=".$QryGetmetropolitianareasRec[area_id]." >".$QryGetmetropolitianareasRec['area_name']."</option>";
			
		}
	}	
	return $options;

}
function GetAllClientsinfo()
{
	 $SqlGetAllClientList=sprintf("select clientid,username FROM tbl_clients where status=1");
	$SqlGetAllClientListInfo=$this->ExecuteQuery($SqlGetAllClientList);
	while($SqlGetAllClientListRes=$this->FetchArray($SqlGetAllClientListInfo))
	{
	
	$options.= "<option value=".$SqlGetAllClientListRes[clientid].">".$SqlGetAllClientListRes['username']."</option>";
	
	}
	return $options;
}
function GetAllMetropolitianList($id)
{
	 $SqlGetAllMetropolitianList=sprintf("select * FROM tbl_metropolitian_list");
	$QryGetAllMetropolitianList=$this->ExecuteQuery($SqlGetAllMetropolitianList);
	while($QryGetAllMetropolitianListRec=$this->FetchArray($QryGetAllMetropolitianList))
	{
	if($QryGetAllMetropolitianListRec[area_id]==$id)
	{
	$options.= "<option value=".$QryGetAllMetropolitianListRec[area_id]." selected='selected'>".$QryGetAllMetropolitianListRec['area_name']."</option>";
	}
	else
	{
	$options.= "<option value=".$QryGetAllMetropolitianListRec[area_id]." >".$QryGetAllMetropolitianListRec['area_name']."</option>";
	}
	}
	return $options;
}
function GetmetropolitianareasCheckbox($clientid,$type)
{
	 $SqlGetmetropolitianareas=sprintf("select * FROM tbl_metropolitian_list order by area_name asc");
	$QryGetmetropolitianareas=$this->ExecuteQuery($SqlGetmetropolitianareas);
	//$numrows=mysql_num_rows($QryGetmetropolitianareas);
	//$QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas);
	$i=1;
	$metroAreas=array();
	
	if($clientid!="" && $type=='member')
	{
		$SqlGetClientMetropolitianAreas=sprintf("select * FROM tbl_member_metropolitian  WHERE memberid=%d",$clientid);
		$QryGetClientMetropolitianAreas=$this->ExecuteQuery($SqlGetClientMetropolitianAreas);
		while($QryGetclientmetropolitianareasRec=$this->FetchArray($QryGetClientMetropolitianAreas))
	 	{
			$metroAreas[]=$QryGetclientmetropolitianareasRec['area_id'];
		}
	
	}
	
	 while($QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas))
	 {
	 if(in_array($QryGetmetropolitianareasRec['area_id'],$metroAreas))
		{
		
				$options.='<li><input type="checkbox" name="metropolitian_area" id="metropolitian_area'.$i.'" value="'.$QryGetmetropolitianareasRec[area_id].'" checked="checked">&nbsp;'.$QryGetmetropolitianareasRec['area_name'].'&nbsp;&nbsp;</li>';
		}
		else
		{
				$options.='<li><input type="checkbox" name="metropolitian_area"  id="metropolitian_area'.$i.'"  value="'.$QryGetmetropolitianareasRec[area_id].'">&nbsp;'.$QryGetmetropolitianareasRec['area_name'].'&nbsp;&nbsp;</li>';
			
		}
		
		$i++;
	}	
	return $options;

}

function Getmetropolitianareaname($val)
{
	$SqlGetAreaName=sprintf("select area_name FROM tbl_metropolitian_list where area_id=%d ",$this->stripper($val));
	$QryGetAreaName=$this->ExecuteQuery($SqlGetAreaName);
	$ResGetAreaName=$this->FetchArray($QryGetAreaName);
	$area_name=stripslashes($ResGetAreaName['area_name']);
	
	return $area_name;

}

function GetmetropolitianAreasLists($clientid)
{
	/* $SqlGetmetropolitianareas=sprintf("select * FROM tbl_metropolitian_list");
	$QryGetmetropolitianareas=$this->ExecuteQuery($SqlGetmetropolitianareas);
	$QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas);
	$metroAreas=array();
		$SqlGetClientMetropolitianAreas=sprintf("select * FROM tbl_member_metropolitian  WHERE memberid=%d",$clientid);
		$QryGetClientMetropolitianAreas=$this->ExecuteQuery($SqlGetClientMetropolitianAreas);
	//	$QryGetClientMetropolitianAreasRec=$this->FetchArray($QryGetClientMetropolitianAreas);
		while($QryGetclientmetropolitianareasRec=$this->FetchArray($QryGetClientMetropolitianAreas))
	 	{
			$metroAreas[]=$QryGetclientmetropolitianareasRec['area_id'];
		}
	 while($QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas))
	 	{
		 if(in_array($QryGetmetropolitianareasRec['area_id'],$metroAreas))
			{
						$options.=$QryGetmetropolitianareasRec['area_name'];
						$options.=",";
			}
		
		}	
	return $options;*/
	$SqlGetClientMetropolitianAreas=sprintf("select * FROM tbl_member_metropolitian  WHERE memberid=%d",$clientid);
	$QryGetClientMetropolitianAreas=$this->ExecuteQuery($SqlGetClientMetropolitianAreas);
	//	$QryGetClientMetropolitianAreasRec=$this->FetchArray($QryGetClientMetropolitianAreas);
	while($QryGetclientmetropolitianareasRec=$this->FetchArray($QryGetClientMetropolitianAreas))
	{
		$SqlGetmetropolitianareas=sprintf("select * FROM tbl_metropolitian_list where area_id='$QryGetclientmetropolitianareasRec[area_id]'");
		$QryGetmetropolitianareas=$this->ExecuteQuery($SqlGetmetropolitianareas);
		$QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas);
		//$metroAreas=array();
		//$metroAreas[]=$QryGetclientmetropolitianareasRec['area_id'];
		$options.=$QryGetmetropolitianareasRec['area_name'];
		$options.=",";
	}
	/* while($QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas))
	 	{
		 if(in_array($QryGetmetropolitianareasRec['area_id'],$metroAreas))
			{
						$options.=$QryGetmetropolitianareasRec['area_name'];
						$options.=",";
			}
		
		}	*/
	$options_val=substr($options,0,strlen($options)-1);
	return $options_val;

}





//********** START CODE DELETE QUERY  *********//
 function DeleteData($tablename,$condition=1)
{
	$DelQuery = "Delete from ".$tablename."  where  ".$condition;
	$GetDataResult=$this->ExecuteQuery($DelQuery);
	
	return $GetDataResult;
}
//********** END CODE DELETE QUERY  *********//

//********** START CODE FOR FRONT END PAGINATION ************//
function userpaginationBottom_front($cols=0,$Limit=10,$page="",$pagename)
{
		global $siteurl;
		$pagecontent="";
		if($cols>$Limit)
		{
			$let=ceil($cols/$Limit);
			$addpages=1;
			if($page<=$addpages)
			$pgMinLimit=1;
			else
			$pgMinLimit=$page-$addpages;
			if($page<$let-$addpages)
			$pgMaxLimit=$page+$addpages;
			else
			$pgMaxLimit=$let;
			if($page>1) 
				$pagecontent.='<a href='.$pagename.'&page='.($page-1).'>< Previous</a> ';
			else
				$pagecontent.='<strong>< Previous</strong>&nbsp; ';
				
			for($k=$pgMinLimit;$k<=$pgMaxLimit;$k++) 
			{
				if($page==$k) 
					$pagecontent.="<strong>$k</strong>&nbsp;"; 
				else 
				{
					$pagecontent.=' <a href='.$pagename.'&page='.$k.'>';
					$pagecontent.= $k;
					$pagecontent.='</a>  ';
				}
				
			}
			if($page<$let) 
				$pagecontent.='<a href='.$pagename.'&page='.($page+1).'>Next ></a>';
			else
				$pagecontent.='&nbsp;<strong>Next ></strong>';
		}

		return $pagecontent;
	
	}
	
function userpaginationBottom_payment($cols=0,$Limit=10,$page="",$pagename)
{
		global $siteurl;
		$pagecontent="";
		if($cols>$Limit)
		{
			$let=ceil($cols/$Limit);
			$addpages=1;
			if($page<=$addpages)
			$pgMinLimit=1;
			else
			$pgMinLimit=$page-$addpages;
			if($page<$let-$addpages)
			$pgMaxLimit=$page+$addpages;
			else
			$pgMaxLimit=$let;
			if($page>1) 
				$pagecontent.='<a href='.$pagename.'&page_payment='.($page-1).'>< Previous</a> ';
			else
				$pagecontent.='<strong>< Previous</strong>&nbsp; ';
				
			for($k=$pgMinLimit;$k<=$pgMaxLimit;$k++) 
			{
				if($page==$k) 
					$pagecontent.="<strong>$k</strong>&nbsp;"; 
				else 
				{
					$pagecontent.=' <a href='.$pagename.'&page_payment='.$k.'>';
					$pagecontent.= $k;
					$pagecontent.='</a>  ';
				}
				
			}
			if($page<$let) 
				$pagecontent.='<a href='.$pagename.'&page_payment='.($page+1).'>Next ></a>';
			else
				$pagecontent.='&nbsp;<strong>Next ></strong>';
		}

		return $pagecontent;
	
	}

	

//********** END CODE FOR FRONT END PAGINATION ************//



//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING VIDEO FRONT END *******//
function UpdateDisplayOrderVideo($id,$orderid,$tablename,$condition=1,$mode)
{
	//Chainging the first order
	if($mode=='down')	
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,VideoID from tbl_videos where UserID=".$_SESSION['UserID']." and DisplayOrder>".$orderid." ORDER BY DisplayOrder ASC LIMIT 1");
	else
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,VideoID from tbl_videos where UserID=".$_SESSION['UserID']." and DisplayOrder<".$orderid." ORDER BY DisplayOrder ASC LIMIT 1");
	$QryDisplayOrderID=$this->ExecuteQuery($GetDisplayOrderID);
	$ResDisplayOrderID=$this->FetchArray($QryDisplayOrderID);
	$OrderIDGet=$ResDisplayOrderID['DisplayOrder'];
	$VideoIDGet=$ResDisplayOrderID['VideoID'];

	
	$UpdateDisplayOrdeAl1 = "update ".$tablename." set DisplayOrder=$orderid where UserID=".$_SESSION['UserID']." and VideoID=".$VideoIDGet;
	$ResUpdateDisplayOrdeAl1=$this->ExecuteQuery($UpdateDisplayOrdeAl1);
	
	$UpdateDisplayOrdeAl = "update ".$tablename." set DisplayOrder=$OrderIDGet where UserID=".$_SESSION['UserID']." and ".$condition;
	$ResUpdateDisplayOrdeAl=$this->ExecuteQuery($UpdateDisplayOrdeAl);
	
	return $ResUpdateDisplayOrdeAl;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING VIDEO FRONT END *******//

//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING EVENTS FRONT END *******//
function UpdateDisplayOrder($id,$orderid,$tablename,$condition=1,$mode)
{
	//Chainging the first order
	if($mode=='down')	
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,EventID from tbl_events where UserID=".$_SESSION['UserID']." and DisplayOrder>".$orderid." ORDER BY DisplayOrder ASC LIMIT 1");
	else
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,EventID from tbl_events where UserID=".$_SESSION['UserID']." and DisplayOrder<".$orderid." ORDER BY DisplayOrder ASC LIMIT 1");
	$QryDisplayOrderID=$this->ExecuteQuery($GetDisplayOrderID);
	$ResDisplayOrderID=$this->FetchArray($QryDisplayOrderID);
	$OrderIDGet=$ResDisplayOrderID['DisplayOrder'];
	$EventIDGet=$ResDisplayOrderID['EventID'];

	
	$UpdateDisplayOrdeAl1 = "update ".$tablename." set DisplayOrder=$orderid where UserID=".$_SESSION['UserID']." and EventID=".$EventIDGet;
	$ResUpdateDisplayOrdeAl1=$this->ExecuteQuery($UpdateDisplayOrdeAl1);
	
	$UpdateDisplayOrdeAl = "update ".$tablename." set DisplayOrder=$OrderIDGet where UserID=".$_SESSION['UserID']." and ".$condition;
	$ResUpdateDisplayOrdeAl=$this->ExecuteQuery($UpdateDisplayOrdeAl);
	
	return $ResUpdateDisplayOrdeAl;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING EVENTS FRONT END *******//

//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING BILL BOARDS FRONT END *******//
function UpdateDisplayOrdertrack($id,$orderid,$tablename,$condition=1,$mode)
{
	//Chainging the first order
	if($mode=='down')	
		$GetDisplayOrderID=sprintf("SELECT Display_Order,TrackID from tbl_tracks where UserID=".$_SESSION['UserID']." and Display_Order>".$orderid." ORDER BY Display_Order ASC LIMIT 1");
	else
		$GetDisplayOrderID=sprintf("SELECT Display_Order,TrackID from tbl_tracks where UserID=".$_SESSION['UserID']." and Display_Order<".$orderid." ORDER BY Display_Order ASC LIMIT 1");
		
	$QryDisplayOrderID=$this->ExecuteQuery($GetDisplayOrderID);
	$ResDisplayOrderID=$this->FetchArray($QryDisplayOrderID);
	$OrderIDGet=$ResDisplayOrderID['Display_Order'];
	$EventIDGet=$ResDisplayOrderID['TrackID'];

	
	$UpdateDisplayOrdeAl1 = "update ".$tablename." set Display_Order=$orderid where UserID=".$_SESSION['UserID']." and BillboardID=".$EventIDGet;
	$ResUpdateDisplayOrdeAl1=$this->ExecuteQuery($UpdateDisplayOrdeAl1);
	
	$UpdateDisplayOrdeAl = "update ".$tablename." set Display_Order=$OrderIDGet where UserID=".$_SESSION['UserID']." and ".$condition;
	$ResUpdateDisplayOrdeAl=$this->ExecuteQuery($UpdateDisplayOrdeAl);
	
	return $ResUpdateDisplayOrdeAl;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING BILL BOARDS FRONT END *******//
//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING BILL BOARDS FRONT END *******//
function UpdateDisplayOrderBill($id,$orderid,$tablename,$condition=1,$mode)
{
	//Chainging the first order
	if($mode=='down')	
		$GetDisplayOrderID=sprintf("SELECT Display_Order,BillboardID from tbl_billboards where UserID=".$_SESSION['UserID']." and Display_Order>".$orderid." ORDER BY Display_Order ASC LIMIT 1");
	else
		$GetDisplayOrderID=sprintf("SELECT Display_Order,BillboardID from tbl_billboards where UserID=".$_SESSION['UserID']." and Display_Order<".$orderid." ORDER BY Display_Order ASC LIMIT 1");
		
	$QryDisplayOrderID=$this->ExecuteQuery($GetDisplayOrderID);
	$ResDisplayOrderID=$this->FetchArray($QryDisplayOrderID);
	$OrderIDGet=$ResDisplayOrderID['Display_Order'];
	$EventIDGet=$ResDisplayOrderID['BillboardID'];

	
	$UpdateDisplayOrdeAl1 = "update ".$tablename." set Display_Order=$orderid where UserID=".$_SESSION['UserID']." and BillboardID=".$EventIDGet;
	$ResUpdateDisplayOrdeAl1=$this->ExecuteQuery($UpdateDisplayOrdeAl1);
	
	$UpdateDisplayOrdeAl = "update ".$tablename." set Display_Order=$OrderIDGet where UserID=".$_SESSION['UserID']." and ".$condition;
	$ResUpdateDisplayOrdeAl=$this->ExecuteQuery($UpdateDisplayOrdeAl);
	
	return $ResUpdateDisplayOrdeAl;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING BILL BOARDS FRONT END *******//

//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING FANS FRONT END *******//
function UpdateDisplayOrderFan($id,$orderid,$tablename,$condition=1,$mode)
{
	//Chainging the first order
	if($mode=='down')	
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,FanID from tbl_fans where ArtistUserID=".$_SESSION['UserID']." and DisplayOrder>".$orderid." ORDER BY DisplayOrder ASC LIMIT 1");
	else
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,FanID from tbl_fans where ArtistUserID=".$_SESSION['UserID']." and DisplayOrder<".$orderid." ORDER BY DisplayOrder ASC LIMIT 1");
		
	$QryDisplayOrderID=$this->ExecuteQuery($GetDisplayOrderID);
	$ResDisplayOrderID=$this->FetchArray($QryDisplayOrderID);
	$OrderIDGet=$ResDisplayOrderID['DisplayOrder'];
	$EventIDGet=$ResDisplayOrderID['FanID'];

	
	$UpdateDisplayOrdeAl1 = "update ".$tablename." set DisplayOrder=$orderid where ArtistUserID=".$_SESSION['UserID']." and FanID=".$EventIDGet;
	$ResUpdateDisplayOrdeAl1=$this->ExecuteQuery($UpdateDisplayOrdeAl1);
	
	$UpdateDisplayOrdeAl = "update ".$tablename." set DisplayOrder=$OrderIDGet where ArtistUserID=".$_SESSION['UserID']." and ".$condition;
	$ResUpdateDisplayOrdeAl=$this->ExecuteQuery($UpdateDisplayOrdeAl);
	
	return $ResUpdateDisplayOrdeAl;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING FANS FRONT END *******//

//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING Friends *******//
function UpdateDisplayOrderFriend($id,$orderid,$tablename,$condition=1,$mode)
{
	//Chainging the first order
	if($mode=='down')	
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,FriendID from tbl_friends where UserID=".$_SESSION['UserID']." and DisplayOrder>".$orderid." ORDER BY FriendID ASC LIMIT 1");
	else
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,FriendID from tbl_friends where UserID=".$_SESSION['UserID']." and DisplayOrder<".$orderid." ORDER BY FriendID ASC LIMIT 1");
		
	$QryDisplayOrderID=$this->ExecuteQuery($GetDisplayOrderID);
	$ResDisplayOrderID=$this->FetchArray($QryDisplayOrderID);
	$OrderIDGet=$ResDisplayOrderID['DisplayOrder'];
	$EventIDGet=$ResDisplayOrderID['FriendID'];

	
	$UpdateDisplayOrdeAl1 = "update ".$tablename." set DisplayOrder=$orderid where UserID=".$_SESSION['UserID']." and FriendID=".$EventIDGet;
	$ResUpdateDisplayOrdeAl1=$this->ExecuteQuery($UpdateDisplayOrdeAl1);
	
	$UpdateDisplayOrdeAl = "update ".$tablename." set DisplayOrder=$OrderIDGet where UserID=".$_SESSION['UserID']." and ".$condition;
	$ResUpdateDisplayOrdeAl=$this->ExecuteQuery($UpdateDisplayOrdeAl);
	
	return $ResUpdateDisplayOrdeAl;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING BILL BOARDS FRONT END *******//

//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING EVENTS FRONT END *******//
function UpdateDisplayOrderBlog($id,$orderid,$tablename,$condition=1,$mode)
{
	//Chainging the first order
	if($mode=='down')	
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,BlogID from tbl_blog where UserID=".$_SESSION['UserID']." and DisplayOrder>".$orderid." ORDER BY DisplayOrder ASC LIMIT 1");
	else
		$GetDisplayOrderID=sprintf("SELECT DisplayOrder,BlogID from tbl_blog where UserID=".$_SESSION['UserID']." and DisplayOrder<".$orderid." ORDER BY DisplayOrder ASC LIMIT 1");
		
	$QryDisplayOrderID=$this->ExecuteQuery($GetDisplayOrderID);
	
	$ResDisplayOrderID=$this->FetchArray($QryDisplayOrderID);
	$OrderIDGet=$ResDisplayOrderID['DisplayOrder'];
	$EventIDGet=$ResDisplayOrderID['BlogID'];

	
	$UpdateDisplayOrdeAl1 = "update ".$tablename." set DisplayOrder=$orderid where UserID=".$_SESSION['UserID']." and BlogID=".$EventIDGet;
	$ResUpdateDisplayOrdeAl1=$this->ExecuteQuery($UpdateDisplayOrdeAl1);
	
	$UpdateDisplayOrdeAl = "update ".$tablename." set DisplayOrder=$OrderIDGet where UserID=".$_SESSION['UserID']." and ".$condition;
	$ResUpdateDisplayOrdeAl=$this->ExecuteQuery($UpdateDisplayOrdeAl);
	
	return $ResUpdateDisplayOrdeAl;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING EVENTS FRONT END *******//

//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING EVENTS FRONT END *******//
function getblogmaxordeid()
{
	$SqlMaxBlogOrdID=sprintf("SELECT max(DisplayOrder) from tbl_blog WHERE UserID=".$_SESSION['UserID']);
	$QryMaxBlogOrdID=$this->ExecuteQuery($SqlMaxBlogOrdID);
	$ResMaxBlogOrdID=$this->FetchArray($QryMaxBlogOrdID);
	$BlogOrdIDMax=$ResMaxBlogOrdID['max(DisplayOrder)']+1;

	return $BlogOrdIDMax;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING EVENTS FRONT END *******//
//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING PHOTOS FRONT END *******//
function getphotomaxordeid()
{
	$SqlMaxPhotoOrdID=sprintf("SELECT max(Display_Order) from tbl_photos WHERE UserID=".$_SESSION['UserID']);
	$QryMaxPhotoOrdID=$this->ExecuteQuery($SqlMaxPhotoOrdID);
	$ResMaxPhotoOrdID=$this->FetchArray($QryMaxPhotoOrdID);
	$PhotoOrdIDMax=$ResMaxPhotoOrdID['max(Display_Order)']+1;

	return $PhotoOrdIDMax;

}
//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING PHOTOS FRONT END *******//
////***** START CODE FOR DISPLAYING HEADER ADD IMAGE *******//
//function getheaderimg($type)
//{
//	$SqlheaderImg=sprintf("SELECT BannerURL, from tbl_advbanners WHERE BannerSize=".$type);
//	$QryheaderImg=$this->ExecuteQuery($SqlheaderImg);
//	$ResheaderImg=$this->FetchArray($QryheaderImg);
//	$PhotoOrdIDMax=$QryheaderImg['max(Display_Order)']+1;
//
//	return $PhotoOrdIDMax;
//
//}
////***** END CODE FOR DISPLAYING HEADER ADD IMAGE *******//

//***** START CODE FOR RETRVING MAX ORDER ID FOR MANAGING PHOTOS FRONT END *******//

//***** END CODE FOR RETRVING MAX ORDER ID FOR MANAGING PHOTOS FRONT END *******//
//***** START CODE FOR RETRIVING PRODUCT DETAILS *******//
function getProductDetails($proid)
{	
	$SqlGetProdutsQty=sprintf("select * from tbl_merchandise where MerchandiseID=$proid");
	$QryGetProdutsQty=$this->ExecuteQuery($SqlGetProdutsQty);
	$ResGetProdutsQty=$this->FetchArray($QryGetProdutsQty);
	return $ResGetProdutsQty;
}
//***** END CODE FOR RETRIVING PRODUCT DETAILS *******//

//***** START CODE FOR RETRIVING ARTIST TARCKID *******//
function getArtistTrackID($uerid,$limit_1,$getpagerec)
{	

	if($getpagerec=='-1')
		$getpagerec=0;
	$SqlArtistTrackID_1=sprintf("select * from tbl_orderproducts a,tbl_tracks b where b.UserID=$uerid and a.TrackID=b.TrackID");
	$QryArtistTrackID_1=$this->ExecuteQuery($SqlArtistTrackID_1);
	$cols_ArtistTrackID_1=$this->NumRows($QryArtistTrackID_1);
	
	while($ResArtistTrackID_1=$this->FetchArray($QryArtistTrackID_1))
		{
			$ArtistTrackID_11.=$ResArtistTrackID_1['TrackID'].",";
		}

	if($getpagerec=='-1')
		$getpagerec=0;	

	
		$SqlGetUserTracksSold_1=sprintf("select * from tbl_orderproducts where TrackID IN($ArtistTrackID_11) ORDER BY ORDERID DESC");
		$QryGetUserTracksSold_1=$this->ExecuteQuery($SqlGetUserTracksSold_1);
		$cols_UserTracksSold_1=$this->NumRows($QryGetUserTracksSold_1);

		$SqlGetUserTracksSold=sprintf("select * from tbl_orderproducts a,tbl_tracks b where b.UserID=$uerid and a.TrackID=b.TrackID ORDER BY ORDERID DESC  LIMIT $getpagerec,$limit_1");
		$QryGetUserTracksSold=$this->ExecuteQuery($SqlGetUserTracksSold);
		$cols_UserTracksSold=$this->NumRows($QryGetUserTracksSold);
		if($cols_UserTracksSold>0)
		{
			while($ResGetUserTracksSold=$this->FetchArray($QryGetUserTracksSold))
			{
				$UserTracksSold.=$ResGetUserTracksSold['OrderID'].",";
				$UserTracksSoldAmt.=$ResGetUserTracksSold['SubTotal'].",";
			}
			$UserTracksSold_1=substr($UserTracksSold,0,-1);
			$UserTracksSoldAmt_1=substr($UserTracksSoldAmt,0,-1);
		}
	
	else
		$ArtistTrackID.=0;


	return $UserTracksSold_1."@".$UserTracksSoldAmt_1."@".$cols_ArtistTrackID_1;
}
//***** END CODE FOR RETRIVING ARTIST TARCKID *******//
//**** START CODE FOR RETRVING BILL NAME AND SHIP NAME ********//
function getOrderStatus($orderid)
{
	$SqlGetOrderStatus=sprintf("select Status from tbl_orders where OrderID=$orderid");
	$QryGetOrderStatus=$this->ExecuteQuery($SqlGetOrderStatus);
	$ResGetOrderStatus=$this->FetchArray($QryGetOrderStatus);
	$Order_Status=$ResGetOrderStatus['Status'];
	return $Order_Status;
}
//**** END CODE FOR RETRVING BILL NAME AND SHIP NAME ********// 

//**** START CODE FOR RETRVING BILL NAME AND SHIP NAME ********//
function getOneChartName($chartid)
{
	$SqlGetCharts="select * from tbl_charts WHERE ChartID=".$chartid." AND StartDate <= now() AND EndDate  > now()";
	$QryGetCharts=$this->ExecuteQuery($SqlGetCharts);
	$ResGetCharts=$this->FetchArray($QryGetCharts);
	return $ResGetCharts;
}
//**** END CODE FOR RETRVING BILL NAME AND SHIP NAME ********// 

//**** START CODE FOR RETRVING Chart Names ********//
function getChartName($chartid='')
{
	$SqlGetCharts="select ChartID,Name from tbl_charts WHERE Status='1' AND StartDate <= now() AND EndDate  > now() Order By ChartID DESC";
	$QryGetCharts=$this->ExecuteQuery($SqlGetCharts);
	$cols=$this->NumRows($QryGetCharts);  
         
	if($cols>0)
	{	
		$displayChartName='<ul class="side-menu">';
		while($ResGetCharts=$this->FetchArray($QryGetCharts))
		{
			if($chartid==$ResGetCharts['ChartID'])				
				$displayChartName.="<li class='active'><a href='charts.php?chartid=".$ResGetCharts['ChartID']."'>".$ResGetCharts['Name']."</a></li>";
			else
				$displayChartName.="<li><a href='charts.php?chartid=".$ResGetCharts['ChartID']."'>".$ResGetCharts['Name']."</a></li>";
				
		}
			$displayChartName.="</ul>";
	}
	else
	{
		$displayChartName.="<div align='center'>No Charts</div>";
	}
	return $displayChartName;
	
	
}
//**** START CODE FOR RETRVING Chart Names ********//

//**** START CODE FOR RETRVING BILL NAME AND SHIP NAME ********//
function getBillShipName($orderid,$type)
{
	$SqlGetOrderName=sprintf("select * from tbl_orderaddress where AddressType='".$type."' and OrderID=$orderid");
	$QryGetOrderName=$this->ExecuteQuery($SqlGetOrderName);
	$ResGetOrderName=$this->FetchArray($QryGetOrderName);
	$Name_Order=ucfirst($ResGetOrderName['OrderFirstname'])." ".ucfirst($ResGetOrderName['OrderLastname']);
	return $Name_Order;
}
//**** END CODE FOR RETRVING BILL NAME AND SHIP NAME ********// 

function thumbImage($source,$dest,$new_width,$new_height,$uploaded_file_size=0)	
	{
		$set_memory_size = "";
		//echo $uploaded_file_size;exit;

		//increase memory allocation if the image size is geater than 2.7MB size
		//if($uploaded_file_size > 2774457 )
			$set_memory_size= "128M";

		//allocate only if needed
		if($set_memory_size!="")
		{
			ini_set("memory_limit",$set_memory_size);
		}
		// The file
		 $filename = $source; 
		//$new_width=100;
		//$new_height=100;
		// Get new dimensions
		list($width, $height) = getimagesize($filename);
		// Resample
		$image_p = imagecreatetruecolor($new_width, $new_height) ;
		 $imginfo = getimagesize($filename);
		// handle image according to type
		switch ($imginfo[2])
		{
		case 1: // gif
		// Content type
				//header('Content-type: image/gif');
			$image = imagecreatefromgif($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagegif($image_p,$dest, 100);
			break;
		
		
		case 2: // jpeg
			// Content type
				//header('Content-type: image/jpeg');
			 $image = imagecreatefromjpeg($filename); 
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			//imagejpeg($image_p, $thumbDes, 100);
				imagejpeg($image_p,$dest, 100);
				
			
			break;
		
		case 3: // png
				// Content type
				//header('Content-type: image/png');
			$image = imagecreatefrompng($filename);
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			//imagepng($image_p, $thumbDes, 100);
				imagepng($image_p,$dest);
				break;
		default:
			break;
		}
	}
}
	if($_REQUEST['limit']!='')
	{
		$limit=$_REQUEST['limit'];
	}	
	else
	{
		$limit=10;		
	}	
	
	if($_REQUEST['limit_fea']!='')
	{
		$limit_fea=$_REQUEST['limit_fea'];
	}	
	else
	{
		$limit_fea=10;
	}
		
	if($_REQUEST['limit_cust']!='')
	{
		$limit_cust=$_REQUEST['limit_cust'];
	}	
	else
	{
		$limit_cust=10;
		
	}
	
		if($_REQUEST['limit_payment']!='')
	{
		$limit_payment=$_REQUEST['limit_payment'];
	}	
	else
	{
		$limit_payment=10;
		
	}



function InsertRecord($in_table,$in_fields,$in_values)
{
	$query = "insert into $in_table (";	
	// get all the fields ready
	for($i=0;$i<count($in_fields);$i++)
	{                        
		$query .= $in_fields[$i].",";
	}		
	// trim the last comma
	$query = substr($query,0,strlen($query)-1);
	$query .= ") VALUES (";		
	// now we have insert into table(field1,field2...,fieldn) VALUES (
	// get all the values ready
	for($i=0;$i<count($in_fields);$i++)
	{                        
		$query .= "'".$in_values[$i]."',";
	}	
	// trim the last comma
	$query = substr($query,0,strlen($query)-1);
	$query .= ")";				
	echo $query;
	exit;
	mysql_query($query) or die(mysql_error());
	return(mysql_insert_id());			
}

	
function resize_img ($input_file_name, $imagetype,$foldername,$width,$height,$resize_by,$thumb)
	{
		$input_file_path=$foldername;
		// resizes image using the GD library
		global $config;
		$quality=100;
		
		// Specify your file details
		$current_file = $input_file_path . $input_file_name;
		$max_width = $width;
		$max_height = $height;
		$resize_by = $resize_by;
	
		// Get the current info on the file
		$imagedata = getimagesize($current_file);
		$imagewidth = $imagedata[0];
		$imageheight = $imagedata[1];
		$imagetype = $imagedata[2];
	
		if ($resize_by == 'width') {
			$shrinkage = $imagewidth / $max_width;
			$new_img_width = $max_width;
			$new_img_height = round($imageheight / $shrinkage);
		} 
		elseif ($resize_by == 'height') 
		{
			$shrinkage = $imageheight / $max_height;
			$new_img_height = $max_height;
			$new_img_width = round($imagewidth / $shrinkage);
		} 
		elseif ($resize_by == 'both') 
		{
			$new_img_width = $max_width;
			$new_img_height = $max_height;
		} 
		elseif ($resize_by == 'bestfit') 
		{
			$shrinkage_width = $imagewidth / $max_width;
			$shrinkage_height = $imageheight / $max_height;
			$shrinkage = max($shrinkage_width, $shrinkage_height);
			$new_img_height = round($imageheight / $shrinkage);
			$new_img_width = round($imagewidth / $shrinkage);
		}
		// type definitions
		// 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP
		// 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order)
		// 9 = JPC, 10 = JP2, 11 = JPX
		$img_name = $input_file_name; //by default
		// the GD library, which this uses, can only resize GIF, JPG and PNG
		if ($imagetype == 1) {
			// it's a GIF
			// see if GIF support is enabled
			if (imagetypes() &IMG_GIF) {
				$src_img = imagecreatefromgif($current_file);
				$dst_img = imageCreate($new_img_width, $new_img_height);
				// copy the original image info into the new image with new dimensions
				ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $new_img_width, $new_img_height, $imagewidth, $imageheight);
				$thumb_name = "$thumb" . "$input_file_name";
				$img_name = "$thumb" ."$input_file_name";
				imagegif($dst_img, "$input_file_path/$img_name");
				imagedestroy($src_img);
				imagedestroy($dst_img);
			} //end if GIF support is enabled
		} // end if $imagetype == 1
		elseif ($imagetype == 2) {
			// it's a JPG
		
			$src_img = imagecreatefromjpeg($current_file);
			$dst_img = imageCreateTrueColor($new_img_width, $new_img_height);
			
			// copy the original image info into the new image with new dimensions
			// checking to see which function is available
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $new_img_width, $new_img_height, $imagewidth, $imageheight);
			
			$img_name = "$thumb" ."$input_file_name";
			imagejpeg($dst_img, "$input_file_path/$img_name", $quality);
			imagedestroy($src_img);
			imagedestroy($dst_img);
		} // end if $imagetype == 2
		elseif ($imagetype == 3) {
			// it's a PNG
			$src_img = imagecreatefrompng($current_file);
			$dst_img = imagecreate($new_img_width, $new_img_height);
			imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $new_img_width, $new_img_height, $imagewidth, $imageheight);
			$img_name = "$thumb" ."$input_file_name";
			imagepng($dst_img, "$input_file_path/$img_name");
			imagedestroy($src_img);
			imagedestroy($dst_img);
		} // end if $imagetype == 3
	return "$thumb" .$img_name;
	} // end function resize_img_gd	

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
//convert xml response into array
function objectsIntoArray($arrObjData, $arrSkipIndices = array())
{
    $arrData = array();
    // if input is object, convert into array
    if (is_object($arrObjData)) {
        $arrObjData = get_object_vars($arrObjData);
    }
    if (is_array($arrObjData)) {
        foreach ($arrObjData as $index => $value) {
            if (is_object($value) || is_array($value)) {
                $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
            }
            if (in_array($index, $arrSkipIndices)) {
                continue;
            }
            $arrData[$index] = $value;
        }
    }
    return $arrData;
}
?>