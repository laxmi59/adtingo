<?php session_start();
get_header(); 
?>
<div  class="content-cont-inner">

<script type="text/javascript">
var xmlHttp
function showUser(str){ 
//alert(str);
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null){
		alert ("Browser does not support HTTP Request")
		return
 	}
	document.getElementById('checked').innerHTML = "Checking...";
	var field="run";
	var url="<?php echo home_url( '/' ); ?>wp-content/themes/adtingo/includes/ajax_calls.php"
	url=url+"?q="+str
	url=url+"&act="+field
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=stateChanged 
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}
function stateChanged(){ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
		document.getElementById("checked").innerHTML=xmlHttp.responseText; 
		//document.getElementById("hid").value=xmlHttp.responseText;
 	} 
}
function GetXmlHttpObject(){
	var xmlHttp=null;
	try{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
 	}catch (e) {
 		//Internet Explorer
 		try{
  			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  		}catch (e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
 	}
	return xmlHttp;
}
</script>
<!--Left content -->
<div class="content-left">
	<h4 class="skyblue-tit"><strong style="text-transform:uppercase"><?php
	$cat=get_query_var('cat');
	if(is_category()){
		$yourcat=get_category($cat);
		$yourcat->slug;
	}
	$Sel_cat_single=mysql_fetch_array(mysql_query("SELECT * FROM wp_terms a, wp_term_taxonomy b where a.slug = '$yourcat->slug' and a.term_id=b.term_id "));
	$prt=$Sel_cat_single['name'];
	if($Sel_cat_single['parent']<>0){		
		$mcatname=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$Sel_cat_single[parent]"));
		$prt=$mcatname['name']." -> ".$Sel_cat_single['name'];
	}
	echo $prt;
?></strong></h4>
	<h2 class="blue-tit m-top10"><span class="f-left">Search AdTingo</span><span class="view-archives f-right"><a href="<?php echo home_url( '/' ).date('Y/m')?>" style="color:#FFFFFF">VIEW ARCHIVES</a></span></h2>

<?
$arr = getValue($_SERVER['REQUEST_URI']);
//print_r($arr);
//echo $catid;
$Sel_Sub_Cat_Num = mysql_num_rows($arr[0]);
?>
<? if($_POST['test']){
extract($_POST);
	setcookie("keyword_title",$keyword_title,time()+15);
	if($subcat=='' && $cat<>''){
		$loc= home_url( '/' )."category/".$cat;
		header('Location: '.$loc);
	}elseif($subcat<>'' && $cat<>''){
		$loc= home_url( '/' )."category/".$cat."/".$subcat;
		header('Location: '.$loc);
	}
}
?>
<div class="search-adtingo">
<form method="post">
	<input name="keyword_title" class="input1" type="text" value="<?=$_COOKIE['keyword_title']?>" />
	<select name="cat" id="cat" class="yourcity" onchange="showUser(this.value)">
    <?
	if($Sel_Sub_Cat_Num){	
	while($Sel_Sub_Cat_Fet = mysql_fetch_array($arr[0])){
	if($Sel_Sub_Cat_Fet[term_id]==1) continue;
		?><option <? if($arr[1]==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"?>  value="<?=$Sel_Sub_Cat_Fet['slug'];?>"><?=$Sel_Sub_Cat_Fet['name'];?></option><?
	}
	}?>
    </select>
<span id="checked">
<? 
$ssl=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$file."'"));
//echo "select * from `wp_terms` where `slug`='".$file."'";
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = '$ssl[term_id]' and tab1.term_id = tab2.term_id ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	?> 
	<select name="subcat">
  <option value="">All Topics</option><?
	if($Sel_Sub_Cat_Num){	
		while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){?>
			 <option <? if($file==$Sel_Sub_Cat_Fet['slug'] || $subcat ==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"?>value="<?=$Sel_Sub_Cat_Fet['slug']?>"><?=$Sel_Sub_Cat_Fet['name'];?></option>
		<?	}
	}else{
		$ex1=$_SERVER['REQUEST_URI'];
		$file = basename(rtrim($ex1, '/'));
		$tes =str_replace($file,"",$ex1);
		$filett = basename(rtrim($tes, '/'));
		$ssl=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$filett."'"));
		$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = '$ssl[term_id]' and tab1.term_id = tab2.term_id ");
		while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){?>
			 <option <? if($file==$Sel_Sub_Cat_Fet['slug'] || $subcat ==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"?>value="<?=$Sel_Sub_Cat_Fet['slug']?>"><?=$Sel_Sub_Cat_Fet['name'];?></option>
		<?	}
	}?>
	</select>
</span>

<input name="test" type="submit" class="search-button f-right" />
</form></div>
<dl class="archive-list">

<h4 class="lightskyblue-tit"><span class="f-left"><strong>
<? function disp($img1,$name,$id,$dtt,$title,$content){
$selcatrel=mysql_fetch_array(mysql_query("select * from `wp_term_relationships` where object_id=$id and term_taxonomy_id<>2"));
//echo "select * from `adit_term_relationships` where object_id=$id and term_taxonomy_id<>2<br>";
$selcattax=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_taxonomy_id=$selcatrel[term_taxonomy_id]"));
//echo "select * from `adit_term_taxonomy` where term_taxonomy_id=$selcatrel[term_taxonomy_id]";
$selscatterms=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$selcattax[term_id]"));
$selcatterms=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$selcattax[parent]"));
//echo "select * from `adit_terms` where term_id=$selcattax[parent]";
?>
<dt>
<? //if($img1=='') $img="no_pic130.gif"; else $img=$img1;?>
<a href="<?=home_url( '/'.$selcatterms['slug'].'/'.$selscatterms['slug'].'/' ).$name?>"><?php /*?><img alt="" width="130" height="130" src="<?php echo home_url( '/' ); ?>/wp-content/themes/adtingo/images/<?=$img?>" /><?php */?>
<img alt="" width="130" height="130" src="<?php echo home_url( '/' ); ?><?=$img1?>" />
</a></dt>

<dd style="min-height:150px;">
<h4 class="lightskyblue-tit" style="text-transform:uppercase"><span class="f-left"><strong><?=$selcatterms['name']." -> ".$selscatterms['name']?></strong></span><span class="f-right"><strong>Emailed on:</strong> 
<? $dt=$dtt; echo date('l F j, Y', strtotime($dt))?></span></h4>
<?="<h2 class='tit'><a href='".home_url( '/'.$selcatterms['slug'].'/'.$selscatterms['slug'].'/' ).$name."'>".stripslashes(substr($title,0,40))."</a></h2>"?>
<?="<div>".substr(stripslashes($content), 0, 300)."<br><span style='float:right'> <a href='".home_url( '/'.$selcatterms['slug'].'/'.$selscatterms['slug'].'/' ).$name."'class='read-more'> Read more... </a></span></div>"?>
</dd>
<? }?>
<?php
	$category_description = category_description();
	//if ( ! empty( $category_description ) )	echo '<div class="archive-meta">' . $category_description . '</div>';
?></strong></span></h4>
<? //if($submitreturn){
if($_COOKIE['side_keyword_title'] ||$_COOKIE['keyword_title']){
if($_COOKIE['keyword_title']){
$keyword_title=$_COOKIE['keyword_title'];
}else{
$keyword_title=$_COOKIE['side_keyword_title'];
}
//echo $keyword_title;
	//if(keyword_title <>''){
		$spost=mysql_query("select * from `wp_posts` where post_title like '%$keyword_title%' order by ID desc");
		$spostnum=mysql_num_rows($spost);
		if($spostnum==''){
			 $i=0;
			
		}else{
		$ex1=$_SERVER['REQUEST_URI'];
		$file = basename(rtrim($ex1, '/'));
		$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and slug='$file' order by tab2.name ");
		$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
if($Sel_Sub_Cat_Num==''){
	$tes =str_replace($file,"",$ex1);
	$filett = basename(rtrim($tes, '/'));
}
if($filett==''){$cat=$file; }else{$cat=$filett;$subcat=$file;}
//echo $cat;
			$catslg=mysql_fetch_array(mysql_query("select * from `wp_terms` where slug='$cat'"));
			$subcatslg=mysql_fetch_array(mysql_query("select * from `wp_terms` where slug='$subcat'"));
			while($spost_fet=mysql_fetch_array($spost)){
				$spost_cont=mysql_fetch_array(mysql_query("select * from `campaign_posts` as tab1, `tbl_campaigns` as tab2 where tab2.campaign_id=tab1.campaign_id and tab1.post_id =$spost_fet[ID]"));
				if($subcat==""){
					$term_tax=mysql_query("SELECT * FROM `wp_term_taxonomy` where parent='$catslg[term_id]'");
					while($term_tax_fet=mysql_fetch_array($term_tax)){
						$sel_rel=mysql_query("select * from `wp_term_relationships` where term_taxonomy_id='".$term_tax_fet['term_id']."' and object_id=$spost_fet[ID]");
						while($sel_rel_fet=mysql_fetch_array($sel_rel)){ 
							if($spost_fet['ID']<>''){
							$i=1;
								if($spost_cont['main_image']<>""){ 
									$dispimg="client/Campaign_images/main_image/thumb_130x130/".$spost_cont['main_image'];
								}elseif($spost_cont['clickble_image']<>""){
									$dispimg="client/Campaign_images/clickble_image/thumb_images/".$spost_cont['clickble_image'];
								}elseif($spost_cont['main_image']=="" && $spost_cont['clickble_image']==""){
									$dispimg="client/images/no_pic130.gif";
								}
								$des= disp($dispimg,$spost_fet['post_name'],$spost_fet['ID'],$spost_fet['post_date'],$spost_fet['post_title'],$spost_cont['text_content']);
								echo $des;
							}else{ continue;}
						}
					}
				}else{
					$sel_rel=mysql_query("select * from `wp_term_relationships` where term_taxonomy_id='".$subcatslg['term_id']."' and object_id=$spost_fet[ID]");
					while($sel_rel_fet=mysql_fetch_array($sel_rel)){ 
						if($spost_fet['ID']<>''){
						$i=1;
							if($spost_cont['main_image']<>""){ 
									$dispimg="client/Campaign_images/main_image/thumb_130x130/".$spost_cont['main_image'];
								}if($spost_cont['clickble_image']<>""){
									$dispimg="client/Campaign_images/clickble_image/thumb_images/".$spost_cont['clickble_image'];
								}elseif($spost_cont['main_image']=="" && $spost_cont['clickble_image']==""){
									$dispimg="client/images/no_pic130.gif";
								}
							$des= disp($dispimg,$spost_fet['post_name'],$spost_fet['ID'],$spost_fet['post_date'],$spost_fet['post_title'],$spost_cont['text_content']);
							echo $des;
						}else{ continue;}
					}
				}
			}
		}
	//}
}elseif($_COOKIE["keysearch"]){
$srchkey=$_COOKIE["keysearch"];
$terms_Cat=mysql_query("select * from `wp_terms` where slug like '%$srchkey%'");
$terms_Num=mysql_num_rows($terms_Cat);
if($terms_Num){
	while($terms_Cat_Fetch=mysql_fetch_array($terms_Cat)){
		$terms_SubCat=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_id='$terms_Cat_Fetch[term_id]'"));
		//echo "select * from `wp_term_taxonomy` where term_id='$terms_Cat_Fetch[term_id]'<br>";
		if($terms_SubCat['parent']==0){
			$terms_SubCatp=mysql_query("select * from `wp_term_taxonomy` where parent='$terms_SubCat[term_id]'");
			while($terms_SubCatp_fet=mysql_fetch_array($terms_SubCatp)){
				$terms_SubCat_Relation=mysql_query("select * from `wp_term_relationships` where term_taxonomy_id='$terms_SubCatp_fet[term_id]'");
				while($terms_relation=mysql_fetch_array($terms_SubCat_Relation)){
					$spost=mysql_fetch_array(mysql_query("select * from `wp_posts` where ID = '$terms_relation[object_id]' and post_type='post'"));
					$comb=mysql_fetch_array(mysql_query("select * from `campaign_posts` where post_id='$spost[ID]' "));
					$combfet=mysql_fetch_array(mysql_query("select * from `tbl_campaigns` where campaign_id='$comb[campaign_id]' "));
					if($spost['ID']<>''){
					$i=1;
						if($combfet['main_image']<>""){ 
									$dispimg="client/Campaign_images/main_image/thumb_130x130/".$combfet['main_image'];
								}if($combfet['clickble_image']<>""){
									$dispimg="client/Campaign_images/clickble_image/thumb_images/".$combfet['clickble_image'];
								}elseif($combfet['main_image']=="" && $combfet['clickble_image']=="" ){
									$dispimg="client/images/no_pic130.gif";
								}
						$des= disp($dispimg,$spost['post_name'],$spost['ID'],$spost['post_date'],$spost['post_title'],$combfet['text_content']);
						echo $des;
					}else{ continue;}
				}
			}
		}else{
			$terms_SubCat_Relation=mysql_query("select * from `wp_term_relationships` where term_taxonomy_id='$terms_SubCat[term_id]'");
			while($terms_relation=mysql_fetch_array($terms_SubCat_Relation)){
				$spost=mysql_fetch_array(mysql_query("select * from `wp_posts` where ID = '$terms_relation[object_id]' and post_type='post'"));
				$comb=mysql_fetch_array(mysql_query("select * from `campaign_posts` where post_id='$spost[ID]' "));
				$combfet=mysql_fetch_array(mysql_query("select * from `tbl_campaigns` where campaign_id='$comb[campaign_id]' "));
				if($spost['ID']<>''){
				$i=1;
					if($combfet['main_image']<>""){ 
									$dispimg="client/Campaign_images/main_image/thumb_130x130/".$combfet['main_image'];
								}if($combfet['clickble_image']<>""){
									$dispimg="client/Campaign_images/clickble_image/thumb_images/".$combfet['clickble_image'];
								}elseif($combfet['main_image']=="" && $combfet['clickble_image']==""){
									$dispimg="client/images/no_pic130.gif";
								}
					$des= disp($dispimg,$spost['post_name'],$spost['ID'],$spost['post_date'],$spost['post_title'],$combfet['text_content']);
					echo $des;
				}else{ continue;}
			}
		}
	}
}else{
	$spost_query=mysql_query("select * from `wp_posts` where post_title like '%$srchkey%' and post_type='post'  order by ID desc");
	while($spost=mysql_fetch_array($spost_query)){
		$comb=mysql_fetch_array(mysql_query("select * from `campaign_posts` where post_id='$spost[ID]' "));
		$combfet=mysql_fetch_array(mysql_query("select * from `tbl_campaigns` where campaign_id='$comb[campaign_id]' "));
		if($spost['ID']<>''){
		$i=1;
		if($combfet['main_image']<>""){ 
									$dispimg="client/Campaign_images/main_image/thumb_130x130/".$combfet['main_image'];
								}if($combfet['clickble_image']<>""){
									$dispimg="client/Campaign_images/clickble_image/thumb_images/".$combfet['clickble_image'];
								}elseif($combfet['main_image']=="" && $combfet['clickble_image']==""){
									$dispimg="client/images/no_pic130.gif";
								}
			$des= disp($dispimg,$spost['post_name'],$spost['ID'],$spost['post_date'],$spost['post_title'],$combfet['text_content']);
			echo $des;
		}else{ continue;}
	}
	
}
//$spostnum=mysql_num_rows($spost);

}else{?>
<? $i=0;
	$comb=mysql_query("select * from `campaign_posts` as tab1, `tbl_campaigns` as tab2, wp_posts as tab3 where tab2.campaign_id=tab1.campaign_id and tab3.ID=tab1.post_id  order by tab3.ID desc ");
	while($comb_fet=mysql_fetch_array($comb)){?>
	<?
	$rel=mysql_fetch_array(mysql_query("select * from `wp_term_relationships` where object_id= '$comb_fet[ID]' and term_taxonomy_id<>2"));
	$term_slug=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` AS tab1, `wp_terms` AS tab2 where tab1.term_taxonomy_id='$rel[term_taxonomy_id]' and tab2.term_id='$rel[term_taxonomy_id]'"));
	//echo $term_slug['slug']."-".$file."<br>";
	if($term_slug['slug']==$file){ 
		if($comb_fet['ID']<>''){
			$i=1;
			if($comb_fet['main_image']<>""){ 
				$dispimg="client/Campaign_images/main_image/thumb_130x130/".$comb_fet['main_image'];
			}if($combfet['clickble_image']<>""){
				$dispimg="client/Campaign_images/clickble_image/thumb_images/".$comb_fet['clickble_image'];
			}elseif($comb_fet['main_image']=="" && $comb_fet['clickble_image']==""){
				$dispimg="client/images/no_pic130.gif";
			}
			$des= disp($dispimg,$comb_fet['post_name'],$comb_fet['ID'],$comb_fet['post_date'],$comb_fet['post_title'],$comb_fet['text_content']);
			echo $des;
		}else{ continue;}
	 }else{ 
		if($term_slug['parent']<>''){
			$term_slug1=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` AS tab1, `wp_terms` AS tab2 where tab1.parent='$term_slug[parent]' and tab2.slug='$file'"));
			if($term_slug1['parent']==$term_slug1['term_id']){
			if($comb_fet['ID']<>''){ 
				$i=1;
				if($comb_fet['main_image']<>""){ 
					$dispimg="client/Campaign_images/main_image/thumb_130x130/".$comb_fet['main_image'];
				}if($comb_fet['clickble_image']<>""){
					$dispimg="client/Campaign_images/clickble_image/thumb_images/".$comb_fet['clickble_image'];
				}elseif($comb_fet['main_image']=="" && $comb_fet['clickble_image']==""){
					$dispimg="client/images/no_pic130.gif";
				}
				$des= disp($dispimg,$comb_fet['post_name'],$comb_fet['ID'],$comb_fet['post_date'],$comb_fet['post_title'],$comb_fet['text_content']);
				echo $des;
			}else{ continue;}?>
			<? }
		}
	}
 }//while
}//submit
//echo $i;
 if($i==0)echo "<h3 style='text-transform:capitalize;' align='center'><img src='http://adtingo.com/images/ALS_AdTingo-UnderConstruction300x250_01a_2010Nov10.jpg' /><h3>";
?>
<!--</dd>-->
</dl>
<div class="clear"></div>
  <div class="category-col m-left10"><h1 class="titgray">TODAY&acute;S HOT TOPIC</h1>
   <? include(get_template_directory()."/includes/hot_post.php");?>
   </div>
     <div class="category-col"><h1 class="titgray">POPULAR POSTS</h1>
	 <? include(get_template_directory()."/includes/popular_post.php");?>
	</div>
   </div> <!--#Left Content over-->
			

<?php //get_sidebar(); ?>
<?php get_sidebar('adtingo2'); ?>  
</div><!-- #content -->
<?php get_footer(); ?>

