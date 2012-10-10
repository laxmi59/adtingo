<?php session_start();
get_header(); ?>

	<div  class="content-cont-inner">
<script type="text/javascript">
var xmlHttp
function showUser(str){ 
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
	$ex1=$_SERVER['REQUEST_URI'];
	$file = basename(rtrim($ex1, '/'));
	if($file=="compaign" || $file=="category")$catid="atlanta"; else $catid=$file;
		$Sel_cat_single=mysql_fetch_array(mysql_query("SELECT * FROM `wp_terms` where `slug` = '$catid' "));
		$prt=$Sel_cat_single['name'];
		
		$mcatrel=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_id = $Sel_cat_single[term_id]"));
		if($mcatrel['parent']<>0){		
			$mcatname=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$mcatrel[parent]"));
			$prt=$mcatname['name']." -> ".$Sel_cat_single['name'];
		}
	echo $prt;
?></strong></h4>
	<h2 class="blue-tit m-top10"><span class="f-left">Search AdTingo</span><span class="view-archives f-right">VIEW ARCHIVES</span></h2>

<?
$ex1=$_SERVER['REQUEST_URI'];
$file = basename(rtrim($ex1, '/'));
$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and slug='$file' order by tab2.name ");

$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
if($Sel_Sub_Cat_Num==''){
	$tes =str_replace($file,"",$ex1);
	$filett = basename(rtrim($tes, '/'));
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and slug='$filett' order by tab2.name ");
	$num=mysql_num_rows($Sel_Sub_Cat);
	if($num<>''){
		$retunarr="test";
	}
}
if($retunarr){
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id order by tab2.name ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	if($file=="category")$catid="atlanta"; else $catid=$file;

	$sel=mysql_fetch_array(mysql_query("select * from `wp_terms` where slug='$catid'"));
	$Row=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_id=$sel[term_id]"));
	if($Row['parent']<>0){
		$Sel_parent=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$Row[parent]"));
		$catid=$Sel_parent['slug'];
	}
}else{
	//echo "tttt";
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id order by tab2.name ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	$tt=mysql_num_rows(mysql_query("SELECT * FROM `wp_terms` where slug='$file' "));
	if($tt<>''){
		$catid=$file;
	}else{
		$catid="atlanta";
	}
}?>
<? if($_POST['test']){
extract($_POST);
$submitreturn="test";
}
?>
<div class="search-adtingo">
<form method="post">
	<input name="keyword_title" class="input1" type="text" value="<?=$keyword_title?>" />
	<select name="cat" id="cat" class="yourcity" onchange="showUser(this.value)">
    <?
	if($Sel_Sub_Cat_Num){	
	while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){
	if($Sel_Sub_Cat_Fet[term_id]==1) continue;
		?><option <? if($catid==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"?>  value="<?=$Sel_Sub_Cat_Fet['slug'];?>"><?=$Sel_Sub_Cat_Fet['name'];?></option><?
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
<? function disp($img1,$name,$file,$dtt,$title,$content){?>
<dt>
<? if($img1=='') $img="no_pic130.gif"; else $img=$img1;?>
<a href="<?=home_url( '/' ).$name?>"><img alt="" width="130" height="130" src="<?php echo home_url( '/' ); ?>/wp-content/themes/adtingo/images/<?=$img?>" /></a></dt>
<dd>
<h4 class="lightskyblue-tit" style="text-transform:capitalize"><span class="f-left"><strong><?=$file?></strong></span><span class="f-right"><strong>Emailed on:</strong> 
<? $dt=$dtt; echo date('l F j, Y', strtotime($dt))?></span></h4>
<?="<h2 class='tit'><a href='".home_url( '/' ).$name."'>".$title."</a></h2><br>"?>
<?="<div>".substr($content, 0, 300)." <a href='".home_url( '/' ).$name."'class='read-more'> Read more... </a></div>"?>
</dd>
<? }?>
<?php
	$category_description = category_description();
	//if ( ! empty( $category_description ) )	echo '<div class="archive-meta">' . $category_description . '</div>';
?></strong></span></h4>
<? if($submitreturn){
	if($keyword_title =='' && $subcat=='' && $cat<>''){
		$loc= home_url( '/' )."category/".$cat;
		header('Location: '.$loc);
	}elseif($keyword_title =='' && $subcat<>'' && $cat<>''){
		$loc= home_url( '/' )."category/".$cat."/".$subcat;
		header('Location: '.$loc);
	}else{
		$spost=mysql_query("select * from `wp_posts` where post_title like '%$keyword_title%'");
		$spostnum=mysql_num_rows($spost);
		if($spostnum==''){
			$i=1;
		}else{
			$catslg=mysql_fetch_array(mysql_query("select * from `wp_terms` where slug='$cat'"));
			$subcatslg=mysql_fetch_array(mysql_query("select * from `wp_terms` where slug='$subcat'"));
			while($spost_fet=mysql_fetch_array($spost)){
				$spost_cont=mysql_fetch_array(mysql_query("select * from `campaign_posts` as tab1, `tbl_campaigns` as tab2 where tab2.campaign_id=tab1.campaign_id and tab1.post_id =$spost_fet[ID]"));
				if($subcat==""){
					$term_tax=mysql_query("SELECT * FROM `wp_term_taxonomy` where parent='$catslg[term_id]'");
					while($term_tax_fet=mysql_fetch_array($term_tax)){
						$sel_rel=mysql_query("select * from `wp_term_relationships` where term_taxonomy_id='".$term_tax_fet['term_id']."' and object_id=$spost_fet[ID]");
						while($sel_rel_fet=mysql_fetch_array($sel_rel)){ $i=1;
							$des= disp($spost_fet['clickble_image'],$spost_fet['post_name'],$file,$spost_fet['post_date'],$spost_fet['post_title'],$spost_cont['text_content']);
							echo $des;
						}
					}
				}else{
					$sel_rel=mysql_query("select * from `wp_term_relationships` where term_taxonomy_id='".$subcatslg['term_id']."' and object_id=$spost_fet[ID]");
					while($sel_rel_fet=mysql_fetch_array($sel_rel)){ $i=1;
						$des= disp($spost_fet['clickble_image'],$spost_fet['post_name'],$file,$spost_fet['post_date'],$spost_fet['post_title'],$spost_cont['text_content']);
						echo $des;
					}
				}
			}
		}
	}
}elseif($_SESSION['keysearch']){
//echo $_SESSION['keysearch'];
$srchkey=$_SESSION['keysearch'];
extract($_POST);
//print_r($_POST);
$terms_Cat=mysql_query("select * from `wp_terms` where slug like '%$srchkey%'");
//echo "select * from `wp_terms` where slug like '%$srchkey%'";
$terms_Num=mysql_num_rows($terms_Cat);
if($terms_Num){
	while($terms_Cat_Fetch=mysql_fetch_array($terms_Cat)){
		$terms_SubCat=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_id='$terms_Cat_Fetch[term_id]'"));
		if($terms_SubCat['parent']==0){
			$terms_SubCatp=mysql_query("select * from `wp_term_taxonomy` where parent='$terms_SubCat[term_id]'");
			while($terms_SubCatp_fet=mysql_fetch_array($terms_SubCatp)){
				$terms_SubCat_Relation=mysql_query("select * from `wp_term_relationships` where term_taxonomy_id='$terms_SubCatp_fet[term_id]'");
				while($terms_relation=mysql_fetch_array($terms_SubCat_Relation)){
					$spost=mysql_fetch_array(mysql_query("select * from `wp_posts` where ID = '$terms_relation[object_id]' and post_type='post'"));$i=1;
					$comb=mysql_fetch_array(mysql_query("select * from `campaign_posts` where post_id='$spost[ID]' "));
					$combfet=mysql_fetch_array(mysql_query("select * from `tbl_campaigns` where campaign_id='$comb[campaign_id]' "));
					$des= disp($combfet['clickble_image'],$spost['post_name'],$file,$spost['post_date'],$spost['post_title'],$combfet['text_content']);
					echo $des;
				}
			}
		}else{
			$terms_SubCat_Relation=mysql_query("select * from `wp_term_relationships` where term_taxonomy_id='$terms_SubCat[term_id]'");
			while($terms_relation=mysql_fetch_array($terms_SubCat_Relation)){
				$spost=mysql_fetch_array(mysql_query("select * from `wp_posts` where ID = '$terms_relation[object_id]' and post_type='post'"));$i=1;
				$comb=mysql_fetch_array(mysql_query("select * from `campaign_posts` where post_id='$spost[ID]' "));
				$combfet=mysql_fetch_array(mysql_query("select * from `tbl_campaigns` where campaign_id='$comb[campaign_id]' "));
				$des= disp($combfet['clickble_image'],$spost['post_name'],$file,$spost['post_date'],$spost['post_title'],$combfet['text_content']);
				echo $des;
			}
		}
	}
}else{
	$spost_query=mysql_query("select * from `wp_posts` where post_title like '%$srchkey%' and post_type='post'");
	while($spost=mysql_fetch_array($spost_query)){$i=1;
		$comb=mysql_fetch_array(mysql_query("select * from `campaign_posts` where post_id='$spost[ID]' "));
		$combfet=mysql_fetch_array(mysql_query("select * from `tbl_campaigns` where campaign_id='$comb[campaign_id]' "));
		$des= disp($combfet['clickble_image'],$spost['post_name'],$file,$spost['post_date'],$spost['post_title'],$combfet['text_content']);
		echo $des;
	}
	
}
//$spostnum=mysql_num_rows($spost);
session_unset();
}else{?>
<? $i=0;
	$comb=mysql_query("select * from `campaign_posts` as tab1, `tbl_campaigns` as tab2, wp_posts as tab3 where tab2.campaign_id=tab1.campaign_id and tab3.ID=tab1.post_id ");
	while($comb_fet=mysql_fetch_array($comb)){?>
	<?
	$rel=mysql_fetch_array(mysql_query("select * from `wp_term_relationships` where object_id= '$comb_fet[ID]' and term_taxonomy_id<>2"));
	$term_slug=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` AS tab1, `wp_terms` AS tab2 where tab1.term_taxonomy_id='$rel[term_taxonomy_id]' and tab2.term_id='$rel[term_taxonomy_id]'"));
	//echo $term_slug['slug']."-".$file."<br>";
	if($term_slug['slug']==$file){ $i=1;?>
		<? $des= disp($comb_fet['clickble_image'],$comb_fet['post_name'],$file,$comb_fet['post_date'],$comb_fet['post_title'],$comb_fet['text_content']);
		echo $des;?>
	<? }else{ 
		if($term_slug['parent']<>''){
			$term_slug1=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` AS tab1, `wp_terms` AS tab2 where tab1.parent='$term_slug[parent]' and tab2.slug='$file'"));
			if($term_slug1['parent']==$term_slug1['term_id']){ $i=1;?>
				<? $des= disp($comb_fet['clickble_image'],$comb_fet['post_name'],$file,$comb_fet['post_date'],$comb_fet['post_title'],$comb_fet['text_content']);
		echo $des;?>
			<? }
		}
	}
 }//while
}//submit
 if($i==0)echo "<h3 style='text-transform:capitalize;' align='center'>no records found<h3>";
?>
<!--</dd>-->
</dl>
<div class="clear"></div>
  <div class="category-col m-left10"><h1 class="titgray">TODAY&acute;S HOT TOPIC</h1>
  
    <div class="category-cont"><img src="images/today-hot-img.jpg" width="280" height="140" /><h3>This is a Title</h3><p>This is an entry to the title and a button on bottom. Brighten your inbox with all the new, unknown and under appreciated locations in your area. Or else you are going to regret it.</p><p><a href="#" class="read-more">Read More</a></p>
    </div>
  </div>
   <div class="category-col"><h1 class="titgray">POPULAR POSTS</h1>
     <div class="category-cont">
       <dl class="popular-post">
         <dt><img src="images/thube.jpg" /></dt>
         <dd><h2 class="tit">This is a Title</h2>This is an entry to the title and a button on right... <a href="#" class="read-more">Read More</a></dd>
         <dt><img src="images/thube.jpg" /></dt>
         <dd><h2 class="tit">This is a Title</h2>This is an entry to the title and a button on right... <a href="#" class="read-more">Read More</a></dd>
         <dt><img src="images/thube.jpg" /></dt>
         <dd><h2 class="tit">This is a Title</h2>This is an entry to the title and a button on right... <a href="#" class="read-more">Read More</a></dd>
         <dt><img src="images/thube.jpg" /></dt>
         <dd><h2 class="tit">This is a Title</h2>This is an entry to the title and a button on right... <a href="#" class="read-more">Read More</a></dd>
        </dl></div>
   </div>
   </div> <!--#Left Content over-->
			

<?php //get_sidebar(); ?>
<?php get_sidebar('adtingo2'); ?>  
</div><!-- #content -->
<?php get_footer(); ?>

