<?
function getValue($ex1){
	//$ex1=$_SERVER['REQUEST_URI'];
	
	
	
	$file = basename(rtrim($ex1, '/'));
	/*echo $file;
	if($file=="Food%20&%20Dinning"){
		$file="food-and-dinning-".$filett;
	elseif($file=="Style"){
		$file="style-".$filett;
	}elseif($file=="Entertainment"){
		$file="entertainment-".$filett;
	}elseif($file=="Travel"){
		$file="travel-".$filett;
	}elseif($file=="Nightlife"){
		$file="nightlife-".$filett;
	}elseif($file=="Home%20&%20Garden"){
		$file="home-and-garden-".$filett;
	}elseif($file=="Electronics%20&%20Gadgets"){
		$file="electronics-and-gadgets-".$filett;
	}elseif($file=="Dating"){
		$file="dating-".$filett;
	}elseif($file=="Sports%20&%20Fitness"){
		$file="sports-and-fitness-".$filett;
	}elseif($file=="Career%20&%20Money"){
		$file="career-and-money-".$filett;
	}elseif($file=="Cars"){
		$file="cars-".$filett;
	}elseif($file=="Health%20&%20Beauty"){
		$file="health-and-money-".$filett;
	}*/
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2,`tbl_metropolitian_list` as tab3 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and slug='$file' and tab2.name=tab3.area_name order by tab2.name ");
	
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	if($Sel_Sub_Cat_Num==''){
		$tes =str_replace($file,"",$ex1);
		$filett = basename(rtrim($tes, '/'));
		$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 ,`tbl_metropolitian_list` as tab3 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and slug='$filett' and tab2.name=tab3.area_name order by tab2.name ");
		$num=mysql_num_rows($Sel_Sub_Cat);
		if($num<>''){
			$retunarr="test";
		}
	}
	if($retunarr){
		$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2,`tbl_metropolitian_list` as tab3 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and tab2.name=tab3.area_name order by tab2.name ");
		
		$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
		if($file=="category")$catid=DEFAULT_CITY; else $catid=$file;
	
		$sel=mysql_fetch_array(mysql_query("select * from `wp_terms` where slug='$catid'"));
		$Row=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_id=$sel[term_id]"));
		if($Row['parent']<>0){
			$Sel_parent=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$Row[parent]"));
			$catid=$Sel_parent['slug'];
		}
	}else{
		//echo "tttt";
		$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2, `tbl_metropolitian_list` as tab3 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and tab2.name=tab3.area_name order by tab2.name ");
		
		//echo "SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2, `tbl_metropolitian_list` as tab3 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and tab2.name=tab3.area_name order by tab2.name ";
		
		$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
		$tt=mysql_num_rows(mysql_query("SELECT * FROM `wp_terms` where slug='$file' "));
		if($tt<>''){
			$catid=$file;
		}else{
			$catid=DEFAULT_CITY;
		}
	}
	//echo $Sel_Sub_Cat;
	$arr=array($Sel_Sub_Cat,$catid);
return $arr;

}//function
?>
<?
function Footer_Page_Names()
{
	$i=0;
	$page=mysql_query("select * from `wp_posts` where `post_type`='page' and `post_status`='publish'");
	$pageNum=mysql_num_rows($page);
	while($page_Fet=mysql_fetch_array($page)){
		if($i==$pageNum-1){
			echo "<a href='".home_url( '/' ).$page_Fet['post_name']."'>$page_Fet[post_title]</a> ";
		}else{
			echo "<a href='".home_url( '/' ).$page_Fet['post_name']."'>$page_Fet[post_title]</a> | ";$i++;
		}
	}
}
?>
