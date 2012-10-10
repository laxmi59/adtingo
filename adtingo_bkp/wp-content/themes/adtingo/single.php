<?php
get_header(); ?>
<!-- #content -->
<div  class="content-cont-inner">
<?
if(is_category()){
	$cat=get_query_var('cat');
	$yourcat=get_category($cat);
	//echo $yourcat->slug;
}else{
	$cat= $post->post_name;
}
$comb=mysql_fetch_array(mysql_query("select * from `wp_posts` where `post_name` = '$cat'"));
$c_post=mysql_fetch_array(mysql_query("select * from `campaign_posts` where post_id=$comb[ID]"));
$main_post=mysql_fetch_array(mysql_query("select * from `tbl_campaigns` where campaign_id = $c_post[campaign_id]"));
?>
<!--Left content -->
	<div class="content-left">
		<h4 class="skyblue-tit"><strong style="text-transform:uppercase">
		<!--ELECTRONICS &amp; GADGETS </strong>\ Article Entry Breadcrumb-->
		<? 
		$rel=mysql_fetch_array(mysql_query("select * from `wp_term_relationships` where object_id=$comb[ID] and term_taxonomy_id<>2"));
		$scatname=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$rel[term_taxonomy_id]"));
		$mcatrel=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_id=$rel[term_taxonomy_id]"));
		$mcatname=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$mcatrel[parent]"));
		echo $mcatname['name']." -> ".$scatname['name'];
		?></strong>
		</h4>
		<div class="inner-con-left">
			<p><span class="date">Emailed on: <? //$exp=explode(" ",$main_post['schedule_date']); echo $exp[0];?><? $dt=$main_post['schedule_date']; echo date('l F j, Y', strtotime($dt))?></span><!--<img src="images/313.jpg" />-->
			<p style="padding-right:30px;" align="justify"><?=html_entity_decode(stripcslashes($comb['post_content']));?></p>
	  	</div>
		<div class="clear"></div>
	</div><!--Left content ends-->
<!--right content -->
<?php get_sidebar('adtingo2'); ?>  
<!--right content ends-->
</div>
<?php get_footer(); ?>
