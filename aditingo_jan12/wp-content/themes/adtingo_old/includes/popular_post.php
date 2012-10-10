 <div class="category-cont">
	 <dl class="popular-post">
	<? $pop_sel=mysql_query("select * from `wp_postmeta` as tab1, `wp_posts` as tab2 where tab1.`meta_key` = 'popularpost' and tab1.`meta_value` = 'checkbox_on' and tab1.post_id=tab2.ID order by tab2.ID desc limit 0,5 ");
if(mysql_num_rows($pop_sel)){
while($pop_row=mysql_fetch_array($pop_sel)){
	$pop_row_fet=mysql_fetch_array(mysql_query("select * from `campaign_posts` as tab3, `tbl_campaigns` as tab4 where tab3.post_id = '$pop_row[ID]' and tab3.campaign_id= tab4.campaign_id"));
	/*if($pop_row_fet['clickble_image']==''){
		$img="no_pic130.gif";
	}else{
		$img=$pop_row_fet['clickble_image'];
	}*/
?>
<?php
if($pop_row_fet['main_image']<>""){ 
	$dispimg="client/Campaign_images/main_image/thumb_images/".$pop_row_fet['main_image'];
}elseif($pop_row_fet['clickble_image']<>""){
	$dispimg="client/Campaign_images/clickble_image/thumb_images/".$pop_row_fet['clickble_image'];
}elseif($pop_row_fet['main_image']=="" && $pop_row_fet['clickble_image']==""){
	$dispimg="client/images/no_pic130.gif";
}?>
	<dt><a href="<?php echo home_url( '/' ).$pop_row['post_name']?>"><img src="<?php echo home_url( '/' ); ?><?=$dispimg?>" width="60" height="60" /></a></dt>
 	<dd><h2 class="tit"><a href="<?php echo home_url( '/' ).$pop_row['post_name'] ?>" title="<?php echo $pop_row['post_title'] ?>"><?php echo stripslashes(stripslashes(substr($pop_row['post_title'],0,20))) ?></a></h2>
	<?=substr(stripslashes(stripslashes($pop_row_fet['text_content'])),0,30)?> <a href="<?php echo home_url( '/' ).$pop_row['post_name']?>" class="read-more">Read More</a></dd>
  <? }?>   
  
 <? }else{?>
 	<dd><h3 style='text-transform:capitalize;' align='center'> No Popular Posts found</h3></dd>

<? }?>
</dl>
     </div>
