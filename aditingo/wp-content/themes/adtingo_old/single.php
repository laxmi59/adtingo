<?php
get_header(); ?>
		<!-- #content -->
			<div  class="content-cont-inner">
			<?
			$ex=$_SERVER['REQUEST_URI'];
			$ff=basename(rtrim($ex, '/'));
			$comb=mysql_fetch_array(mysql_query("select * from `wp_posts` where `post_name` = '$ff'"));
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
?>
</strong>
</h4>

<div class="inner-con-left">
  <p><span class="date">Emailed on: <? //$exp=explode(" ",$main_post['schedule_date']); echo $exp[0];?><? $dt=$main_post['schedule_date']; echo date('l F j, Y', strtotime($dt))?></span><!--<img src="images/313.jpg" />-->
  <?=html_entity_decode($comb['post_content']);?>
  <?php /*?><? if($comb_fet['clickble_image']=='') $img="313.jpg"; else $img=$main_post['main_image'];?>
		<img alt="" width="313" height="406" src="<?php echo home_url( '/' ); ?>/wp-content/themes/adtingo/images/<?=$img?>" />
  </p>
  <div class="inner-image-details">
    <p><?=$main_post['contact_info']?><br />
     <?=$main_post['destination_url']?></p>
      <a href="<?=$main_post['facebook_link']?>"><img border="0" src="images/facebook.jpg" /></a><a href="<?=$main_post['twitter_link']?>"><img border="0" src="images/twitter.jpg" /></a>
  </div>
</div>

<div class="inner-con-right">
  <h2 class="titblue"><?=$main_post['heading']?></h2>
  <h3 class="subtit"><?=$main_post['sub_heading ']?></h3>
    <? if($main_post['clickble_image']=='') $img="no_pic130.gif"; else $img=$main_post['clickble_image'];?>
		<img alt="" width="130" height="130" src="<?php echo home_url( '/' ); ?>/wp-content/themes/adtingo/images/<?=$img?>" /><p align="justify"><?=$main_post['text_content']?></p>
    
    <div class="bottom-bt w-none"><a href="#" class="check-it-out"></a><a href="#" class="email"></a><a href="#" class="share"></a><a href="#" class="retweet"></a></div><?php */?>
</div>
<div class="clear"></div>
  </div><!--Left content ends-->
<!--right content -->
<?php get_sidebar('adtingo2'); ?>  
<!--right content ends-->
</div>
<?php get_footer(); ?>
