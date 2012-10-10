<?php 
ob_start();
session_start();
$setpath="http://ec2-75-101-211-185.compute-1.amazonaws.com/client";
 include('includes/dbfiler.php'); 
//include('pager.php');
$months_arr=array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"Octorber","11"=>"November","12"=>"December");
	$page_num_array=array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10", "20"=>"20","30"=>"30","40"=>"40","50"=>"50","60"=>"60","70"=>"70","80"=>"80","90"=>"90","100"=>"100");
class main extends DBFilter
{
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

//******** START CODE FOR MAILING ****************//
function sendmail($to,$from,$sub,$msg)
{
	$plainMessage="This is a Plain text..";
	$headers.= "MIME-Version: 1.0\n";
	$headers.= "Content-Type: text/html; charset=ISO-8859-1\n"; 
	$headers .= "From:$from <$from>\n"; 
	
	$mailsent = mail($to,$sub,$msg,$headers);
	return $mailsent;
}
//******** END CODE FOR MAILING ****************//
function Getmetropolitianareaname($val)
{
	$SqlGetAreaName=sprintf("select area_name FROM tbl_metropolitian_list where area_id=%d ",$this->stripper($val));
	$QryGetAreaName=$this->ExecuteQuery($SqlGetAreaName);
	$ResGetAreaName=$this->FetchArray($QryGetAreaName);
	$area_name=stripslashes($ResGetAreaName['area_name']);
	
	return $area_name;

}
function GetClientUsername($cid)
{
	$SqlGetClientUserName=sprintf("select username FROM tbl_clients where clientid=%d ",$this->stripper($cid));
	$QryGetClientUserName=$this->ExecuteQuery($SqlGetClientUserName);
	$ResGetClientUserName=$this->FetchArray($QryGetClientUserName);
	$Client_User_name=stripslashes($ResGetClientUserName['username']);
	
	return $Client_User_name;

}
function getloginrecords($cid)
{
	$SqlGetClientUserName=sprintf("select * FROM tbl_campaigns where clientid=%d ",$this->stripper($cid));
	$QryGetClientUserName=$this->ExecuteQuery($SqlGetClientUserName);
	$Totalrows=$this->NumRows($QryGetClientUserName);
	return $Totalrows;

}
function GetCampaignSearchResult($arealist="",$gender="",$education="",$keywords="")
{
$where=1;

if($arealist!="")
$where.=" and tbl_member_metropolitian.area_id=".$arealist."";
if($gender!="")
$where.=" and tbl_members.gender='".$gender."'";
if($education!="")
$where.=" and tbl_members.education=".$education."";
if($keywords!="")
{
$where.=" and concat(',',interests_and_activities,',')  like '%,".$keywords.",%'";
}
  $SqlSearch_result="select * from tbl_members,tbl_member_metropolitian  where $where and tbl_members.memberid=tbl_member_metropolitian.memberid"; 
$ResSearch_result=$this->ExecuteQuery($SqlSearch_result);
$TotalSearchRecords=$this->NumRows($ResSearch_result);
return $TotalSearchRecords;

}
function GetCampaignInfo($CampaignID) 
{

 $SqlCampaign_Seg_list_info="select * from tbl_campaign_list_segmentation where campaign_id=".$CampaignID ; 
$ResCampaign_Seg_list_info=$this->ExecuteQuery($SqlCampaign_Seg_list_info);
return $ResCampaign_Seg_list_info;
}


function GetCreditCardType($val)
{

	 $SqlGetCreditCardType=sprintf("select CreditCard FROM tbl_creditcard  where CreditCardAbbv='%s' ",$this->stripper($val));
	$QryGetCreditCardType=$this->ExecuteQuery($SqlGetCreditCardType);
	$RecGetCreditCardType=$this->FetchArray($QryGetCreditCardType);
	$CardType_name=stripslashes($RecGetCreditCardType['CreditCard']);
	
	return $CardType_name;

}

function GetCountryName($val)
{
	$SqlGetCountryName=sprintf("select CountryName FROM  tbl_countries  where CountryID =%d ",$this->stripper($val));
	$QryGetCountryName=$this->ExecuteQuery($SqlGetCountryName);
	$RecGetCountryName=$this->FetchArray($QryGetCountryName);
	$Get_Country_name=stripslashes($RecGetCountryName['CountryName']);
	
	return $Get_Country_name;

}
function GetTotalNumRecords($val)
{
	 $SqlGetTotalNumRecords=sprintf("select DISTINCT (memberid) FROM  tbl_member_metropolitian where area_id=%d ",$this->stripper($val)); 
	$QryGetTotalNumRecords=$this->ExecuteQuery($SqlGetTotalNumRecords);
	//$ResGetTotalNumRecords=$this->FetchArray($QryGetTotalNumRecords);
	$TotalRecords=$this->NumRows($QryGetTotalNumRecords);
	return $TotalRecords;
}
function GetmetropolitianareasCheckbox($clientid,$type)
	{
		$SqlGetmetropolitianareas=sprintf("select * FROM tbl_metropolitian_list ORDER BY area_name ASC");
		$QryGetmetropolitianareas=$this->ExecuteQuery($SqlGetmetropolitianareas);
		//$QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas);
		$i=1;
		$metroAreas=array();
		
		if($clientid!="" && $type=='member')
		{
			$SqlGetClientMetropolitianAreas=sprintf("select * FROM tbl_member_metropolitian  WHERE memberid=%d",$clientid);
			$QryGetClientMetropolitianAreas=$this->ExecuteQuery($SqlGetClientMetropolitianAreas);
		//	$QryGetClientMetropolitianAreasRec=$this->FetchArray($QryGetClientMetropolitianAreas);
			while($QryGetclientmetropolitianareasRec=$this->FetchArray($QryGetClientMetropolitianAreas))
			{
				$metroAreas[]=$QryGetclientmetropolitianareasRec['area_id'];
			}
		
		}
		$metroIds_array=array();
		if($_REQUEST['metroIds']!='')
		{
			$metroIds=$_REQUEST['metroIds'];
			$metroIds=substr($metroIds,0,-1);
			$metroIds_array=explode(":",$metroIds);
					
		}
		 while($QryGetmetropolitianareasRec=$this->FetchArray($QryGetmetropolitianareas))
		 {
		 if(in_array($QryGetmetropolitianareasRec['area_id'],$metroAreas))
			{
			//	$options.= "<option value=".$QryGetmetropolitianareasRec[area_id]." selected='selected'>".$QryGetmetropolitianareasRec['area_name']."</option>";
						$options.='<li><input type="checkbox" name="metropolitian_area" id="metropolitian_area'.$i.'" value="'.$QryGetmetropolitianareasRec[area_id].'" checked="checked">&nbsp;'.$QryGetmetropolitianareasRec['area_name'].'&nbsp;&nbsp;</li>';
			}
			else if(in_array($QryGetmetropolitianareasRec['area_id'],$metroIds_array))
			{
			//	$options.= "<option value=".$QryGetmetropolitianareasRec[area_id]." selected='selected'>".$QryGetmetropolitianareasRec['area_name']."</option>";
						$options.='<li><input type="checkbox" name="metropolitian_area" id="metropolitian_area'.$i.'" value="'.$QryGetmetropolitianareasRec[area_id].'" checked="checked">&nbsp;'.$QryGetmetropolitianareasRec['area_name'].'&nbsp;&nbsp;</li>';
			}
			else
			{
					$options.='<li><input type="checkbox" name="metropolitian_area"  id="metropolitian_area'.$i.'"  value="'.$QryGetmetropolitianareasRec[area_id].'">&nbsp;'.$QryGetmetropolitianareasRec['area_name'].'&nbsp;&nbsp;</li>';
				
			}$i++;
		}	
		return $options;
	
	}
	
	function GetKeywordsAndActivities($keywords)
	{		
		
	}
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
//********** START CODE DELETE QUERY  *********//
 function DeleteData($tablename,$condition=1)
{
	$DelQuery = "Delete from ".$tablename."  where  ".$condition;
	$GetDataResult=$this->ExecuteQuery($DelQuery);
	
	return $GetDataResult;
}
//********** END CODE DELETE QUERY  *********//



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
				$pagecontent.='&nbsp;<a href="'.$pagename.'&page='.($page+1).'&limit='.$_REQUEST['limit'].'"><img src="images/next.jpg" alt="Go to Previous page" align="absmiddle" /></a>';
			}
			else
			{
				$pagecontent.='&nbsp;<span class="fontlightgray"><img src="images/next-off.gif" alt="Go to Previous page" align="absmiddle" /></span>';
			}
		}

		return $pagecontent;
	}
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
?>