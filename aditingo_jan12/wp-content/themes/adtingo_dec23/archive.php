<?php session_start();
get_header(); 

$mn=$_SERVER['REQUEST_URI'];
$mn1 = basename(rtrim($mn, '/'));
$yr =substr($mn,-3);
$yr1 = str_replace($yr,"",$mn);
$yr2 = basename(rtrim($yr1, '/'));
//echo $mn1."<br>".$yr2;
$ser1=$yr2."-".$mn1;
$path="http://adtingo.com/";
//$path="http://localhost/projects/aditingo/";
 ?>
<!-- #content -->
<div  class="content-cont-inner">
<!--Left content -->
	<div class="content-left">
		<h4 class="skyblue-tit"><strong style="text-transform:uppercase"></strong></h4>
		<!--<div class="inner-con-left">-->
  			<?php if ( have_posts() )	the_post();?>
			<h1 class="page-title">
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'twentyten' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'twentyten' ), get_the_date('F Y') ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'twentyten' ), get_the_date('Y') ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'twentyten' ); ?>
			<?php endif; ?>
			</h1>
			<? 	$mon_array=array('01','02','03','04','05','06','07','08','09','10','11','12');
			$mon1_array=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
			for($i=0;$i<sizeof($mon_array);$i++){
				$ser= get_the_date('Y')."-".$mon_array[$i];
				$val=str_replace("-","/", $ser);
				$selnum=mysql_num_rows(mysql_query("select * from `wp_posts` where post_date LIKE '$ser%' and post_type='post'"));
				if($selnum){?>
					<a href="<?=$path?><?=$val?>"><?=$mon1_array[$i]." ".get_the_date('Y')?></a> |
				<? }
			}?>
			<?php rewind_posts();
				// get_template_part( 'loop', 'archive' );
			?>
			<dl class="archive-list">
			<?
			$sel=mysql_query("select * from `campaign_posts` as tab1, `tbl_campaigns` as tab2, `wp_posts` as tab3 where tab1.post_id = tab3.ID and tab1.campaign_id= tab2.campaign_id and tab3.post_date LIKE '$ser1%'");
			$cols=mysql_num_rows($sel);
			if($cols<>0){
			while($row=mysql_fetch_array($sel)){
			$id=$row['ID'];
			$content=stripslashes($row['text_content']);
			$name=$row['post_name'];
			$title=stripslashes($row['heading']);
			$dtt=$row['post_date'];
			$selcatrel=mysql_fetch_array(mysql_query("select * from `wp_term_relationships` where object_id=$id and term_taxonomy_id<>2"));
//echo "select * from `adit_term_relationships` where object_id=$id and term_taxonomy_id<>2";
$selcattax=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_taxonomy_id=$selcatrel[term_taxonomy_id]"));
//echo "select * from `adit_term_taxonomy` where term_taxonomy_id=$selcatrel[term_taxonomy_id]";
$selscatterms=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$selcattax[term_id]"));
$selcatterms=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$selcattax[parent]"));

if($row['main_image']<>""){ 
	$dispimg="client/Campaign_images/main_image/thumb_images/".$row['main_image'];
}elseif($row['clickble_image']<>""){
	$dispimg="client/Campaign_images/clickble_image/thumb_images/".$row['clickble_image'];
}elseif($row['main_image']=="" && $row['clickble_image']==""){
	$dispimg="client/images/no_pic130.gif";
}
?>

<dt>
<a href="<?=home_url( '/'.$selcatterms['slug'].'/'.$selscatterms['slug'].'/' ).$name?>">
<img alt="" width="130" height="130" src="<?php echo home_url( '/' ); ?><?=$dispimg?>" />
</a></dt>

<dd>
<h4 class="lightskyblue-tit" style="text-transform:uppercase"><span class="f-left"><?=$selcatterms['name']." -> ".$selscatterms['name']?></span><span class="f-right">Emailed on:
<? $dt=$dtt; echo date('l F j, Y', strtotime($dt))?></span></h4>
<?="<h2 class='tit'><a href='".home_url( '/'.$selcatterms['slug'].'/'.$selscatterms['slug'].'/' ).$name."'>".stripslashes($title)."</a></h2><br>"?>
<?="<div>".substr(stripslashes($content), 0, 300)." <a href='".home_url( '/'.$selcatterms['slug'].'/'.$selscatterms['slug'].'/' ).$name."'class='read-more'> Read more... </a></div>"?>
</dd>
<? }}else{ $i=0; }?>
<? if($i==0) echo "<h3 style='text-transform:capitalize;' align='center'>no records found<h3>";?>
</dl>
		<!--</div>-->
		<div class="clear"></div>
		

	</div><!--Left content ends-->
<!--right content -->
<?php get_sidebar('adtingo2'); ?>  
<!--right content ends-->
</div>
<?php get_footer(); ?>
