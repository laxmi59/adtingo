<?php
session_start();
ob_start();

include(get_template_directory()."/includes/functions.php");
include_once(get_template_directory()."/includes/values.php");
include(get_template_directory()."/includes/func.php");
define ("DEFAULT_CITY","los-angeles");
define ("DEFAULT_CITY1","los angeles");
$cooktime=20;
if($_POST['top_srch_button']){
	extract($_POST);
	$cat=DEFAULT_CITY;
	setcookie("keysearch", $srchkey, time()+5);
	$loc= home_url( '/' )."category/".$cat;
	header('Location: '.$loc);
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

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
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
	  ?>
  <a href="<?php echo get_page_link(38); ?>">My Account</a>|<a href="<?php echo get_page_link(58)."/?mes=log"; ?>">Logout</a>
   <?php } else {?>
   <a href="<?php echo get_page_link(5); ?>">Sign Up</a>|<a href="<?php echo get_page_link(58); ?>">Login</a>
 <?php } ?>
  </div>
  
  <div class="top-search">
   <form method="post">
     <input type="text" class="input-ts" name="srchkey" id="srchkey" value="<?=$_COOKIE['keysearch']?>" />
    <input type="submit" name="top_srch_button" id="button" value="Submit" class="search-button" />
  </form>
  </div>
  
  <div class="select-yourcity">

<?

//print_r($arr);

?>
<form action="<?php bloginfo('url'); ?>/" method="get">
	<select name="cat" id="cat" class="yourcity" onchange='return test(this.value)'>
	<?
	//$ser='/projects/aditingo/';
	$ser='/';
	$cit=basename(rtrim($_SERVER['REQUEST_URI'], '/'));
	$ser1=mysql_num_rows(mysql_query("select * from `wp_terms` where `slug`='$cit'"));
	if($_SERVER['REQUEST_URI'] ==$ser || $ser1==0){ 
		echo "<option value='' selected='selected'>Select Your City</option>";
	}else{
		$arr = getValue($_SERVER['REQUEST_URI']);
		$sel="selected='selected'";
	}
	$arr = getValue($_SERVER['REQUEST_URI']);
	?>
    <?
	$Sel_Sub_Cat_Num = mysql_num_rows($arr[0]);
	if($Sel_Sub_Cat_Num){	
	while($Sel_Sub_Cat_Fet = mysql_fetch_array($arr[0])){
	if($Sel_Sub_Cat_Fet[term_id]==1) continue;
		?><option <? if($arr[1]==$Sel_Sub_Cat_Fet['slug']) echo $sel  ?>  value="<?=$Sel_Sub_Cat_Fet['slug'];?>"><?=$Sel_Sub_Cat_Fet['name'];?></option><?
	}
	}?>
    </select>
	</form>
	
  </div>
</div>
  <div class="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/logo.png" width="191" height="101" border="0" /></a></div>
  <div class="menu-adtingo">
  <? $arr = getValue($_SERVER['REQUEST_URI']); if($arr[1]<>'') echo wp_show_categories($arr[1]);?>
</div>
</div>
