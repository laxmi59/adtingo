<?php session_start();
get_header(); 
if(is_category()){$Cat_All=get_query_var('cat');}else{$def=DEFAULT_CITY;}
?>
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
<div class="content-cont-inner">
<!--Left content -->
	<div class="content-left">
		<h4 class="skyblue-tit"><strong style="text-transform:uppercase"></strong></h4>
		<h2 class="blue-tit m-top10">
			<span class="f-left">Search AdTingo</span>
			<span class="view-archives f-right">
				<a href="<?php echo home_url( '/' ).date('Y/m')?>" style="color:#FFFFFF">VIEW ARCHIVES</a>
			</span>
		</h2>
		<div class="search-adtingo">
			<form method="post">
				<input name="keyword_title" class="input1" type="text" value="<?=$_COOKIE['keyword_title']?>" />
				
				<select name="cat" id="cat" class="yourcity" onchange="showUser(this.value)">
					<?=getMainCategories($Cat_All,$def)?>
			    </select>
				<span id="checked">
				<select name="subcat">
					<option value="">All Topics</option>
					<?=getSubCategories($Cat_All,$def)?>
				</select>
				</span>
				<input name="test" type="submit" class="search-button f-right" />
			</form>
		</div>
		<dl class="archive-list">
			<h4 class="lightskyblue-tit">
				<span class="f-left">
					<strong><?php $category_description = category_description();?></strong>
				</span>
			</h4>
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

