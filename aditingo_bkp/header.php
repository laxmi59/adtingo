<?php
ob_start();
session_start();
include(get_template_directory()."/includes/functions.php");
include_once(get_template_directory()."/includes/values.php");
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
<script language="javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/javascript.js"> </script>
</head>

<body <?php body_class(); ?>>
<div class="header-container"><div class="header-right">
  <div class="toplinks">
    <?php if(isset($_SESSION['memberid']) && $_SESSION['memberid']!="")
	  {
	  ?>
  <a href="<?php echo get_page_link(38); ?>">MY ACCOUNT</a>|<a href="<?php echo get_page_link(12); ?>">LOGOUT</a>
   <?php } else {?>
   <a href="<?php echo get_page_link(5); ?>">SIGN UP</a>|<a href="<?php echo get_page_link(12); ?>">LOGIN</a>
 <?php } ?>
  </div>
  
  <div class="top-search">
    <input type="text" class="input-ts" name="textfield" id="textfield" />
    <input type="submit" name="button" id="button" value="Submit" class="search-button" />
  </div>
  
  <div class="select-yourcity">
  <!--  <select name="select2" id="select2" class="yourcity">
      <option>SELECT YOUR CITY</option>
      <option>Select 1</option>
      <option>Select 2</option>
      <option>Select 3</option>
      <option>Select 4</option>
      <option>Select 5</option>
            </select>-->
<?
$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id order by tab2.name ");
//$Sel_Sub_Cat=mysql_query("SELECT * FROM `adit_term_taxonomy` as tab1, `adit_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id order by tab2.name ");
$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
if($_GET['scat']=='')$catid=$_GET['cat']; else $catid=$_GET['scat'];
if($_GET['cat']==''){$catid=3;}
?>
<form action="<?php bloginfo('url'); ?>/" method="get">
    <select name="cat" id="cat" class="yourcity" onchange='return this.form.submit()'>
      <!--<option value="">SELECT YOUR CITY</option>-->
      <?
	if($Sel_Sub_Cat_Num){	
	while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){
	if($Sel_Sub_Cat_Fet[term_id]==1) continue;
		?><option <? if($catid==$Sel_Sub_Cat_Fet['term_id']) echo "selected='selected'"?>  value="<?=$Sel_Sub_Cat_Fet['term_id'];?>"><?=$Sel_Sub_Cat_Fet['name'];?></option><?
	}
	}?>
    </select>
	</form>
  </div>
</div>
  <div class="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/logo.png" width="191" height="101" border="0" /></a></div>
  <div class="menu-adtingo">
  <? if($catid<>0 || $catid<>'') echo wp_show_categories($catid);?>
<!--<ul class="top-menunav">
<li><a href="#">Food &amp; Dining </a></li>
<li><a href="#">Style</a></li>
<li><a href="#">Entertainment</a></li>
<li><a href="#">Travel</a></li>
<li><a href="#">Nightlife</a></li>
<li><a href="#">Home &amp; Garden</a></li>
<li><a href="<?php echo home_url(); ?>/?page_id=15">Electronics &amp; Gadgets</a></li>
<li><a href="#">Dating</a></li>
<li><a href="#">Sports &amp; Fitness</a></li>
<li><a href="#">Career &amp; Money</a></li>
<li><a href="#">Cars</a></li>
<li><a href="#">Health &amp; Beauty</a></li>
</ul>-->
</div>
</div>
