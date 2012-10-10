<?php
include(get_template_directory()."/includes/dbfiler.php");
//include('pager.php');
//error_reporting(0);
ob_start();
session_start();
class main extends DBFilter
{
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

//********** START CODE DELETE QUERY  *********//
 function DeleteData($tablename,$condition=1)
{
	$DelQuery = "Delete from ".$tablename."  where  ".$condition;
	$GetDataResult=$this->ExecuteQuery($DelQuery);
	
	return $GetDataResult;
}
//********** END CODE DELETE QUERY  *********//


}

function getMainCategories($cat,$def){
echo $def; 
if($def==''){
	$yourcat=get_category($cat);
	if($yourcat->category_parent<>0){
		$ss2=mysql_fetch_array(mysql_query("SELECT b.parent, a.slug, a.term_id FROM wp_terms a, wp_term_taxonomy b
WHERE a.term_id = $yourcat->category_parent"));
		$qry=$ss2[slug];
	}else{
		$qry=$yourcat->slug;
	}
}else{
	$qry=$def;
}
	//echo $qry;
	$Sel_Sub_Cat=mysql_query("SELECT * FROM wp_term_taxonomy a, wp_terms b, tbl_metropolitian_list c where a.taxonomy = 'category' and a.parent = 0 and a.term_id = b.term_id and b.name=c.area_name order by b.name ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	if($Sel_Sub_Cat_Num){	
		while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){
			if($Sel_Sub_Cat_Fet[term_id]==1) continue;
			if($qry==$Sel_Sub_Cat_Fet['slug']) 
				echo "<option value='$Sel_Sub_Cat_Fet[slug]' selected='selected'>$Sel_Sub_Cat_Fet[name]</option>";
			else
				echo "<option value='$Sel_Sub_Cat_Fet[slug]' $sel>$Sel_Sub_Cat_Fet[name]</option>";
		}
	}
}
function getSubCategories($cat,$def){
if($def==''){
	$yourcat=get_category($cat);
	$termid=$yourcat->term_id;
	$parentid=$yourcat->category_parent;
	$slugs=$yourcat->slug;
}else{
	$yourcat=mysql_fetch_object(mysql_query("SELECT * FROM wp_term_taxonomy a, wp_terms b where a.taxonomy = 'category' and b.slug = $def"));
	$termid=$yourcat->term_id;
	$parentid=$yourcat->parent;
	$slugs=$yourcat->slug;
}
	/*echo "<pre>";
	print_r($yourcat);
	echo "<pre>";*/
	if($parentid==0){
		$Sel_Sub_Cat=mysql_query("SELECT * FROM wp_term_taxonomy a, wp_terms b where a.taxonomy = 'category' and a.parent = '$termid' and a.term_id = b.term_id");
	}else{
		$Sel_Sub_Cat=mysql_query("SELECT * FROM wp_term_taxonomy a, wp_terms b where a.taxonomy = 'category' and a.parent = '$parentid' and a.term_id = b.term_id");
	}
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	if($Sel_Sub_Cat_Num){	
		while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){
			if($sugs==$Sel_Sub_Cat_Fet['slug']) 
				echo "<option value='$Sel_Sub_Cat_Fet[slug]' selected='selected'>$Sel_Sub_Cat_Fet[name]</option>";
			else
				echo "<option value='$Sel_Sub_Cat_Fet[slug]' $sel>$Sel_Sub_Cat_Fet[name]</option>";
		}
	}
}