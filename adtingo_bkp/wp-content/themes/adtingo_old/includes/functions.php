<?php
include(get_template_directory()."/includes/dbfiler.php");
//include('pager.php');
//error_reporting(0);
ob_start();
session_start();
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
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
?>