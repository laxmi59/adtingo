<div class="category-cont">
	<? $hot_row=mysql_fetch_array(mysql_query("select * from `wp_postmeta` as tab1, `wp_posts` as tab2 where tab1.`meta_key` = 'hot topic' and tab1.`meta_value` = 'checkbox_on' and tab1.post_id=tab2.ID order by tab2.ID desc limit 0,1 "));
if($hot_row){
	$hot_row_fet=mysql_fetch_array(mysql_query("select * from `campaign_posts` as tab3, `tbl_campaigns` as tab4 where  tab3.post_id = '$hot_row[ID]' and tab3.campaign_id= tab4.campaign_id"));
	if($hot_row_fet['clickble_image']==''){
		$img_hot="no_pic130.gif";
	}else{
		$img_hot=$hot_row_fet['clickble_image'];
	}
?>
	<a href="<?php echo home_url( '/' ).$hot_row['post_name']?>"><img src="<?php echo home_url( '/' ); ?>client/Campaign_images/clickble_image/thumb_images/<?=$img_hot?>" width="280" height="140" /></a>
	<h3><a href="<?php echo home_url( '/' ).$hot_row['post_name']?>"><?=stripslashes($hot_row['post_title'])?></a></h3>
	<p><?=substr(stripslashes($hot_row_fet['text_content']),0,50)?></p>
	<p><a href="<?php echo home_url( '/' ).$hot_row['post_name']; ?>" class="read-more">Read More</a></p>
<? }else{
	echo "<div><h3 style='text-transform:capitalize; height:100px' align='center'>There is no hot topic today</h3></div>";
	echo "<p>&nbsp;</p>";
	}
?>
</div>


    