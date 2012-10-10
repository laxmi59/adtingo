<?php
get_header(); 

$sel=mysql_fetch_array(mysql_query("select * from tbl_catart where art_id='$_GET[id]'"));
?>

<!-- #content -->
<div  class="content-cont-inner">
<!--Left content -->
<div class="content-left">

<!--<div class="inner-con-left">-->
 <div class="form-title">Local Do-Gooders</div>
 <div class="clear"></div><br />
<? if($sel['img']<>''){?>
<div class="inner-con-left1">
	<? if($sel['url']<>''){?>
		<a href="<?=$sel['url']?>"><img alt="" src="<?php echo home_url( '/' ); ?>client/admin/articles/<? echo $sel['img']?>" class="f-left" width="110" height="110" /></a>
	<? }else{?>
		<img alt="" src="<?php echo home_url( '/' ); ?>client/admin/articles/<? echo $sel['img']?>" class="f-left" width="110" height="110" />
	<? }?>
</div>
	<h3 class="heading"><?=$sel['title']?></h3>
	<p align="justify" style="padding:10px 0"><?=$sel['desc']?></p>
<? }else{?>
	<h3 class="heading"><?=$sel['title']?></h3>
	<p align="justify" style="padding:10px 0"><?=$sel['desc']?></p>
<? }?>
<!--</div>-->
<div class="clear"></div>
  </div><!--Left content ends-->
<!--right content -->
<?php get_sidebar('adtingo2'); ?>  
<!--right content ends-->
</div>
<?php get_footer(); ?>
