<div class="content-right">
<div class="ads-rt"><br />
<br />
<p align="center">300*250 Ad</p></div>
<div class="google-ads"><img alt="" src="http://ec2-75-101-211-185.compute-1.amazonaws.com/images/gmap.png"  /></div>
<script type="text/javascript">
var xmlHttp
function side_showUser(str){ 
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null){
		alert ("Browser does not support HTTP Request")
		return
 	}
	document.getElementById('side_checked').innerHTML = "Checking...";
	var field="side_run";
	var url="<?php echo home_url( '/' ); ?>wp-content/themes/adtingo/includes/ajax_calls.php"
	url=url+"?q="+str
	url=url+"&act="+field
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=side_stateChanged 
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}
function side_stateChanged(){ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
		document.getElementById("side_checked").innerHTML=xmlHttp.responseText; 
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
<?
 
if($_POST['side_test']){
extract($_POST);
$submitreturn="test";
$_SESSION['side_keyword_title']=$side_keyword_title;
	if($side_subcat=='' && $side_cat<>''){
		$loc= home_url( '/' )."category/".$side_cat;
		header('Location: '.$loc);
	}elseif($side_subcat<>'' && $side_cat<>''){
		$loc= home_url( '/' )."category/".$side_cat."/".$side_subcat;
		header('Location: '.$loc);
	}
}

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

<div class="category-col m-rignone">
    <h1 class="innertitblue">Search Adtingo</h1>
    <div class="search-bg">
	<form method="post">
	<div>&nbsp;</div>
	<input name="side_keyword_title" class="input1" type="text" value="<?=$_SESSION['side_keyword_title']?>" />
    <select name="side_cat" id="cat" class="yourcity" onchange="side_showUser(this.value)">
    <?
	if($Sel_Sub_Cat_Num){	
	while($Sel_Sub_Cat_Fet = mysql_fetch_array($Sel_Sub_Cat)){
	if($Sel_Sub_Cat_Fet[term_id]==1) continue;
		?><option <? if($catid==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"?>  value="<?=$Sel_Sub_Cat_Fet['slug'];?>"><?=$Sel_Sub_Cat_Fet['name'];?></option><?
	}
	}?>
    </select>
	<span id="side_checked">
<? 
$ssl=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$file."'"));
//echo "select * from `wp_terms` where `slug`='".$file."'";
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = '$ssl[term_id]' and tab1.term_id = tab2.term_id ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	?> 
	<select name="side_subcat">
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
    <span class="left"><input name="side_test" type="submit" class="search-button f-right" /></span><span class="right"><a href="#"><img src="images/view-article.jpg"></a></span></form></div>
  </div>
  <div class="clear"></div>
<h2 class="blue-tit">Local Do-Gooders</h2>
<div class="local-gooders-cont">
<img alt="" src="images/no_pic110.gif" class="f-left" />
<h3 class="heading">This will become the tittle assingned for this particular ad.</h3>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing.</p>
</div>
<h2 class="blue-tit">Exclusive Access</h2>
<div class="greybg-content"><h4 class="title">Signup for exclusive access to what's happening in your city...</h4>
<input class="f-left field-city" type="text" name="" value="" /> <input class="signup-btn" type="button" value="" name="signup" />
</div>

</div>