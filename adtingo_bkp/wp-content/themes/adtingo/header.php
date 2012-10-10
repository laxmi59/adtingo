<?php
session_start();
ob_start();

include(get_template_directory()."/includes/functions.php");
include_once(get_template_directory()."/includes/values.php");
include(get_template_directory()."/includes/func.php");
define ("DEFAULT_CITY","los-angeles");
define ("DEFAULT_CITY1","los angeles");
if(is_category()){	$Cat_All=get_query_var('cat');}else{$def=DEFAULT_CITY;}
$cooktime=20;
if($_POST['top_srch_button']){
	extract($_POST);
	$cat=DEFAULT_CITY;
	//setcookie("keysearch", $srchkey, time()+5);
	//$loc= home_url( '/' ).$cat."?id=".$srchkey;
	setcookie("keysearch", $srchkey, time()+5);
	$loc= home_url( '/' ).$cat;
	//echo $loc;
	header('Location: '.$loc);
}
if(is_category()){
	$CatgoryForAll=get_query_var('cat');
	$YourCatForAll=get_category($CatgoryForAll);
	if($yourcat->category_parent<>0){
		$ss2=mysql_fetch_array(mysql_query("SELECT b.parent, a.slug, a.term_id FROM wp_terms a, wp_term_taxonomy b
WHERE a.term_id = $yourcat->category_parent"));
		$SubCat=$ss2[slug];
	}else{
		$Cat=$yourcat->slug;
	}
}
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	echo "Adtingo "; 
	wp_title( '|', true, 'left' );

/*
	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
*/
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/stylesheet.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAba8Tt0uYKnkrkb0C895m_hSGyD6hr9wiI_WG79mA1tOFyNqoWRRNWt9yPzMh7Xmvuk1Q_jtVKJe-Ug" type="text/javascript"></script>
<script language="javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/javascript.js"> </script>
</head>
<script type="text/javascript">
function test(nid){
	window.location="<?php bloginfo('url'); ?>/category/"+nid
}
</script>
<body <?php body_class(); ?> onLoad="load()" onUnload="GUnload()">
<div class="header-container"><div class="header-right">
  <div class="toplinks">
    <?php if(isset($_SESSION['memberid']) && $_SESSION['memberid']!="")
	  {
	 
	   if($_SERVER['REQUEST_URI']=="/unsubscribe?cid=".$_GET['cid']."&mid=".$_GET['mid']){?>
  <a href="<?php echo get_page_link(38); ?>">My Account</a>|<a href="<?php echo get_page_link(58)."/?mes=log"; ?>">Logout</a>
  		<? }else{?>
			<a href="<?php echo get_page_link(38); ?>?cid=<?php echo $_GET['cid']?>&mid=<?php echo $_GET['mid']?>">My Account</a>|<a href="<?php echo get_page_link(58)."/?mes=log"; ?>">Logout</a>
		<? }?>
   <?php } else {
   if($_SERVER['REQUEST_URI']=="/unsubscribe?cid=".$_GET['cid']."&mid=".$_GET['mid']){?>
  		<a href="<?php echo get_page_link(5); ?>">Sign Up</a>|<a href="<?php echo get_page_link(58); ?>?cid=<?php echo $_GET['cid']?>&mid=<?php echo $_GET['mid']?>">Login</a>
	<? }else{?>
		<a href="<?php echo get_page_link(5); ?>">Sign Up</a>|<a href="<?php echo get_page_link(58); ?>">Login</a>
	<? }?>
 <?php } ?>
  </div>
  
  <div class="top-search">
   <form method="post">
     <input type="text" class="input-ts" name="srchkey" id="srchkey" value="<?=$_REQUEST['id']?>" />
    <input type="submit" name="top_srch_button" id="button" value="Submit" class="search-button" />
  </form>
  </div>
  
  <div class="select-yourcity">
<?
	$cat=get_query_var('cat');
	$yourcat=get_category($cat);
	//print_r($yourcat);
?>
<form action="<?php bloginfo('url'); ?>/" method="get">
	<select name="cat" id="cat" class="yourcity" onchange='return test(this.value)'>
	<?	
if(!is_category()){
	echo "<option value='' selected='selected'>Select Your City</option>";
	$qry1=DEFAULT_CITY;
}else{
	$cat=get_query_var('cat');
	$yourcat=get_category($cat);
	if($yourcat->category_parent<>0){
		$ss2=mysql_fetch_array(mysql_query("SELECT b.parent, a.slug, a.term_id FROM wp_terms a, wp_term_taxonomy b
WHERE a.term_id = $yourcat->category_parent"));
		$qry=$ss2[slug];
	}else{
		$qry=$yourcat->slug;
	}
}
//$ss3=mysql_fetch_array(mysql_query($qry));
	$Sel_Sub_Cat=mysql_query("SELECT * FROM wp_term_taxonomy a, wp_terms b, tbl_metropolitian_list c where a.taxonomy = 'category' and a.parent = 0 and a.term_id = b.term_id and b.name=c.area_name order by b.name ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	if($Sel_Sub_Cat_Num){	
	while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){
	if($Sel_Sub_Cat_Fet[term_id]==1) continue;
		?><option <? if($qry==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"  ?>  value="<?=$Sel_Sub_Cat_Fet['slug'];?>"><?=$Sel_Sub_Cat_Fet['name'];?></option><?
	}
	}?>
    </select>
	</form>
	
  </div>
</div>
  <div class="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/logo.png" width="191" height="101" border="0" /></a></div>
  <div class="menu-adtingo">
  <?  if($qry<>'') echo wp_show_categories($qry); else  echo wp_show_categories($qry1); ?>
</div>
</div>
