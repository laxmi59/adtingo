<?
function getValue($ex1){
	//$ex1=$_SERVER['REQUEST_URI'];
	$file = basename(rtrim($ex1, '/'));
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and slug='$file' order by tab2.name ");
	
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	if($Sel_Sub_Cat_Num==''){
		$tes =str_replace($file,"",$ex1);
		$filett = basename(rtrim($tes, '/'));
		$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and slug='$filett' order by tab2.name ");
		$num=mysql_num_rows($Sel_Sub_Cat);
		if($num<>''){
			$retunarr="test";
		}
	}
	if($retunarr){
		$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id order by tab2.name ");
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
		$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id order by tab2.name ");
		$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
		$tt=mysql_num_rows(mysql_query("SELECT * FROM `wp_terms` where slug='$file' "));
		if($tt<>''){
			$catid=$file;
		}else{
			$catid=DEFAULT_CITY;
		}
	}
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
