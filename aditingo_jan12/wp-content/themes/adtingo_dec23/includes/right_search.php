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
setcookie('side_keyword_title', $side_keyword_title, time()+5);
	if($side_subcat=='' && $side_cat<>''){
		$loc= home_url( '/' )."category/".$side_cat;
		header('Location: '.$loc);
	}elseif($side_subcat<>'' && $side_cat<>''){
		$loc= home_url( '/' )."category/".$side_cat."/".$side_subcat;
		header('Location: '.$loc);
	}
}
$arr = getValue($_SERVER['REQUEST_URI']);
$Sel_Sub_Cat_Num = mysql_num_rows($arr[0]);
?>

<div class="search-bg">
<form method="post">
	
	<input name="side_keyword_title" class="input1" type="text" value="<?=$_COOKIE['side_keyword_title']?>" />
	<select name="side_cat" id="cat" class="yourcity" onchange="side_showUser(this.value)">
	<?
	if($Sel_Sub_Cat_Num){	
	while($Sel_Sub_Cat_Fet = mysql_fetch_array($arr[0])){
	if($Sel_Sub_Cat_Fet[term_id]==1) continue;
		?><option <? if($arr[1]==$Sel_Sub_Cat_Fet['slug']) echo "selected='selected'"?>  value="<?=$Sel_Sub_Cat_Fet['slug'];?>"><?=$Sel_Sub_Cat_Fet['name'];?></option><?
	}
	}?>
	</select>
	<span id="side_checked">
	<? 
	$ssl=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$file."'"));
	if($ssl[term_id]==''){$parentval=12;}else{$parentval=$ssl[term_id];}
	//echo "select * from `wp_terms` where `slug`='".$file."'";
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = '$parentval' and tab1.term_id = tab2.term_id and tab1.parent <> 0 ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	?> 
	<select name="side_subcat" class="m-left10">
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
	<span class="left"><input name="side_test" type="submit" class="search-button f-right" /></span><span class="right"><span class="right"><a href="<?php echo home_url( '/' ).date('Y/m')?>"><img src="http://adtingo.com/wp-content/themes/adtingo/images/view-article.jpg" /></a></span></form></div>
