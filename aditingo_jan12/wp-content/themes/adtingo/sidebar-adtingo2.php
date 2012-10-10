<div class="content-right">
<div class="ads-rt">
<p align="center"><img src="http://adtingo.com/images/ALS_AdTingo-Banner300x250_01c_2010Nov10.jpg"  /></p></div>
<div class="google-ads"><!--<img alt="" src="http://ec2-75-101-211-185.compute-1.amazonaws.com/images/gmap.png"  />-->
<?
$ex1=$_SERVER['REQUEST_URI'];
$file = basename(rtrim($ex1, '/'));
$tes =str_replace($file,"",$ex1);
$filett = basename(rtrim($tes, '/'));
$ss2=mysql_num_rows(mysql_query("select * from `wp_posts` where `post_name`='".$file."' and `post_type`='post'"));
if($ss2){
	$ss2_fet=mysql_fetch_array(mysql_query("select * from `wp_posts` where `post_name`='".$file."' and `post_type`='post'"));
	$comb=mysql_fetch_array(mysql_query("select * from `campaign_posts` where `post_id`=$ss2_fet[ID]"));
	$comb1=mysql_fetch_array(mysql_query("select * from `tbl_campaigns` where `campaign_id`=$comb[campaign_id]"));
	if($comb1['lat']<>0){
		$city="<table cellpadding='3' cellspacing='3' border='0'><tr><td><b>Title: </b></td><td>".$comb1['campaign_name']."</td></tr><tr><td><b>contact: </b></td><td>".$comb1['map_address'].",".$comb1['map_city'].",".$comb1['map_state']."</td></tr><tr><td><b>website: </b></td><td><a href='destination_url' target='_blank'>".$comb1['destination_url']."</td></tr><tr><td colspan='2'>".$latlon['CITY']."</td></tr></table>";
		$lat='';$lon='';
		$lat=$comb1['lat'];
		$lon=$comb1['lng'];
	}else{
		$zip=mysql_fetch_array(mysql_query("select  distinct `ZIP_CODE`, `LATITUDE`, `LONGITUDE`,`CITY` from `zip_code` where `CITY`='".DEFAULT_CITY1."'"));
		//echo "select  distinct `ZIP_CODE`, `LATITUDE`, `LONGITUDE`,`CITY` from `zip_code` where `CITY`='".DEFAULT_CITY1."'";
		$lat='';$lon='';
		$city= "<b>".$zip['CITY']."</b>";
		$lat=$zip['LATITUDE'];
		$lon=$zip['LONGITUDE'];
	}
}else{
	//echo "it is not a post";
	$cats=mysql_query("SELECT * FROM `wp_terms` AS tab1, `wp_term_taxonomy` AS tab2 WHERE tab1.term_id = tab2.term_id AND tab2.parent =0 AND tab2.taxonomy = 'category'");
	while($cat_fet=mysql_fetch_array($cats)){
		if($cat_fet['slug']==$file ||$cat_fet['slug']==$filett) $show=1;
		if($show==1){
			
			$cat1=str_replace("-"," ",$cat_fet['slug']);
			$cat=ucfirst($cat1);
			
			$zip=mysql_fetch_array(mysql_query("select area_name,lat,lng from `tbl_metropolitian_list` where `area_name` ='$cat'"));
			$lat='';$lon='';
			$city= "<b>".$zip['area_name']."</b>";
			$lat=$zip['lat'];
			$lon=$zip['lng'];
			$show=0;
			//echo $lat."<br>";
			break;
		}else{
			$zip=mysql_fetch_array(mysql_query("select area_name,lat,lng from `tbl_metropolitian_list` where `area_name` ='".DEFAULT_CITY1."'"));
			$lat='';$lon='';
			$city= "<b>".$zip['area_name']."</b>";
			$lat=$zip['lat'];
			$lon=$zip['lng'];
			//echo $lat."<br>";
		}
	}
}
		//echo $lat;
?>
<div id="map" style="width: 298px; height: 377px"></div>
	 <script type="text/javascript">
     if (GBrowserIsCompatible()) {
       var gmarkers = [];
			      var htmls = [];
			      var to_htmls = [];
			      var from_htmls = [];
			      var i=0;
			      // A function to create the marker and set up the event window
			      function createMarker(point,name,html) {
				  var marker = new GMarker(point);
		        	// The info window version with the "to here" form open
				to_htmls[i] = html + 'Directions: To here - <a  href="javascript:fromhere(' + i + ')">From here<\/a>' +
           '<br>Start address:<form action="http://maps.google.com/maps" method="get" target="_blank">' +
           '<input type="text" SIZE=40 MAXLENGTH=40 name="saddr" id="saddr" value="" /><br>' +
           '<INPUT value="Get Directions" TYPE="SUBMIT">' +
           '<input type="hidden" name="daddr" value="' + point.lat() + ',' + point.lng() + 
                  // "(" + name + ")" + 
           '"/>';
        // The info window version with the "to here" form open
        from_htmls[i] = html + 'Directions: <a class="d" href="javascript:tohere(' + i + ')">To here<\/a> - <b>From here<\/b>' +
           '<br>End address:<form action="http://maps.google.com/maps" method="get"" target="_blank">' +
           '<input type="text" SIZE=40 MAXLENGTH=40 name="daddr" id="daddr" value="" /><br>' +
           '<INPUT value="Get Directions" TYPE="SUBMIT">' +
           '<input type="hidden" name="saddr" value="' + point.lat() + ',' + point.lng() +
                  // "(" + name + ")" + 
           '"/>';
        // The inactive version of the direction info
        html = html + 'Directions: <a class="b" href="javascript:tohere('+i+')">To here<\/a> - <a class="b"  href="javascript:fromhere('+i+')">From here<\/a>';

        GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml(html);
        });
        gmarkers[i] = marker;
        htmls[i] = html;
        i++;
        return marker;
      }

      // functions that open the directions forms
      function tohere(i) {
        gmarkers[i].openInfoWindowHtml(to_htmls[i]);
      }
      function fromhere(i) {
        gmarkers[i].openInfoWindowHtml(from_htmls[i]);
      }
      var map = new GMap2(document.getElementById("map"));
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
     // map.setCenter(new GLatLng(16.945181,82.238647),15);
	  var point = new GLatLng(<?=$lat?>,<?=$lon?>);
	  map.setCenter(point, 12);
	  var marker = createMarker(point,'',"<div><?=$city?></div>")
      map.addOverlay(marker);
	
	 }else{
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }
</script>
</div>
<div class="category-col m-rignone">
   <h1 class="innertitblue">Search AdTingo</h1>
   <? include(get_template_directory()."/includes/right_search.php");?>
  </div>
  <div class="clear"></div>
<h2 class="blue-tit">Local Do-Gooders</h2>
<?php /*?><? $ex1=$_SERVER['REQUEST_URI'];
	$file = basename(rtrim($ex1, '/'));
		$tes =str_replace($file,"",$ex1);
		$filett = basename(rtrim($tes, '/'));
		$ssl=mysql_num_rows(mysql_query("select * from `wp_terms` where `slug`='".$filett."'"));
		$ss2=mysql_num_rows(mysql_query("select * from `wp_terms` where `slug`='".$file."'"));
		//echo $ssl;
		$err=0;
		if($ssl<>0){
			$ss2=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$filett."'"));
		}elseif($ss2<>0){
			$ss2=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$file."'"));
		}else{
			$ss2=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".DEFAULT_CITY."'"));
		}?><?php */?>
<style type="text/css">

.gallerycontroller{
width: 250px; display:none;
}

/*.gallerycontent{
width: 250px;
height: 200px;
border: 1px solid black;
background-color: #DFDFFF;
padding: 3px;
display: block;
}*/

</style>

<script type="text/javascript">

/***********************************************
* Advanced Gallery script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice must stay intact for legal use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var tickspeed=5000 //ticker speed in miliseconds (2000=2 seconds)
var displaymode="auto" //displaymode ("auto" or "manual"). No need to modify as form at the bottom will control it, unless you wish to remove form.

if (document.getElementById){
document.write('<style type="text/css">\n')
document.write('.gallerycontent{display:none;}\n')
document.write('</style>\n')
}

var selectedDiv=0
var totalDivs=0

function getElementbyClass(classname){
partscollect=new Array()
var inc=0
var alltags=document.all? document.all.tags("DIV") : document.getElementsByTagName("*")
for (i=0; i<alltags.length; i++){
if (alltags[i].className==classname)
partscollect[inc++]=alltags[i]
}
}

function contractall(){
var inc=0
while (partscollect[inc]){
partscollect[inc].style.display="none"
inc++
}
}

function expandone(){
var selectedDivObj=partscollect[selectedDiv]
contractall()
selectedDivObj.style.display="block"
if (document.gallerycontrol)
temp.options[selectedDiv].selected=true
selectedDiv=(selectedDiv<totalDivs-1)? selectedDiv+1 : 0
if (displaymode=="auto")
autocontrolvar=setTimeout("expandone()",tickspeed)
}

function populatemenu(){
temp=document.gallerycontrol.menu
for (m=temp.options.length-1;m>0;m--)
temp.options[m]=null
for (i=0;i<totalDivs;i++){
var thesubject=partscollect[i].getAttribute("subject")
thesubject=(thesubject=="" || thesubject==null)? "HTML Content "+(i+1) : thesubject
temp.options[i]=new Option(thesubject,"")
}
temp.options[0].selected=true
}

function manualcontrol(menuobj){
if (displaymode=="manual"){
selectedDiv=menuobj
expandone()
}
}

function preparemode(themode){
displaymode=themode
if (typeof autocontrolvar!="undefined")
clearTimeout(autocontrolvar)
if (themode=="auto"){
document.gallerycontrol.menu.disabled=true
autocontrolvar=setTimeout("expandone()",tickspeed)
}
else
document.gallerycontrol.menu.disabled=false
}


function startgallery(){
if (document.getElementById("controldiv")) //if it exists
document.getElementById("controldiv").style.display="block"
getElementbyClass("gallerycontent")
totalDivs=partscollect.length
if (document.gallerycontrol){
populatemenu()
if (document.gallerycontrol.mode){
for (i=0; i<document.gallerycontrol.mode.length; i++){
if (document.gallerycontrol.mode[i].checked)
displaymode=document.gallerycontrol.mode[i].value
}
}
}
if (displaymode=="auto" && document.gallerycontrol)
document.gallerycontrol.menu.disabled=true
expandone()
}

if (window.addEventListener)
window.addEventListener("load", startgallery, false)
else if (window.attachEvent)
window.attachEvent("onload", startgallery)
else if (document.getElementById)
window.onload=startgallery

</script>
<?
		/*if($ss2){
			$metro=mysql_fetch_array(mysql_query("select * from `tbl_metropolitian_list` where cat_id=$ss2[term_id]"));
			$sel=mysql_fetch_array(mysql_query("select * from `tbl_catart` where cat_id=$metro[area_id] and `primary_cat`='on'"));
			if($sel)$err=1;
		}*/
		?>
<div class="local-gooders-cont">
<?
if(is_category()){
	$cat=get_query_var('cat');
	$yourcat=get_category($cat);
	$yourcat->slug;
	$ss1=mysql_fetch_array(mysql_query("SELECT b.parent, a.slug, a.term_id FROM wp_terms a, wp_term_taxonomy b
WHERE a.slug = '$yourcat->slug' AND a.term_id = b.term_id"));
	if($ss1['parent']<>'0')
	{
		$qry="select * from `wp_terms` where `term_id`='".$ss1['parent']."'";
	}else{
		$qry="select * from `wp_terms` where `term_id`='".$ss1['term_id']."'";
	}
	
}else{
	$qry="select * from `wp_terms` where `slug`='".DEFAULT_CITY."'";
}
$ss2=mysql_fetch_array(mysql_query($qry));
if($ss2){
	$tt=mysql_num_rows(mysql_query("select * from `tbl_metropolitian_list` where cat_id=$ss2[term_id]"));
	if($tt<>0)
	{
	$metro=mysql_fetch_array(mysql_query("select * from `tbl_metropolitian_list` where cat_id=$ss2[term_id]"));
	//echo "select * from `tbl_metropolitian_list` where cat_id=$ss2[term_id]";
	$selfet=mysql_query("select * from `tbl_catart` where cat_id=$metro[area_id] ");

	while($sel=mysql_fetch_array($selfet)){?>
	<div class="gallerycontent">
	<? if($sel['img']<>''){?>
		<? if($sel['url']<>''){?>
		<a href="<?=$sel['url']?>"><img alt="" src="<?php echo home_url( '/' ); ?>client/admin/articles/<? echo $sel['img']?>" class="f-left" width="110" height="110" /></a>
		<? }else{?>
		<img alt="" src="<?php echo home_url( '/' ); ?>client/admin/articles/<? echo $sel['img']?>" class="f-left" width="110" height="110" />
		<? }?>
		<h3 class="heading"><?=$sel['title']?></h3>
		<p><?=substr($sel['desc'],0,200)?><br /><span style="float:right"><a href="<?php echo get_page_link(371);?>?id=<?=$sel['art_id']?>">Read More</a></span></p>
	<? }else{?>
		<h3 class="heading"><?=$sel['title']?></h3>
		<p><?=substr($sel['desc'],0,200)?><br /><span style="float:right"><a href="<?php echo get_page_link(371);?>?id=<?=$sel['art_id']?>">Read More</a></span></p>
	<? }?>
	</div>
	<? }?>
	<? }else{?>
	<h3 style='text-transform:capitalize;' align='center'>  No records Found</h3>
	<? }?>
<? }else{?>
<h3 style='text-transform:capitalize;' align='center'>  No records Found</h3>
<? }?>
</div>
<div id="controldiv" style="display:none" class="gallerycontroller">
<form name="gallerycontrol">
<select class="gallerycontroller" size="3" name="menu" onChange="manualcontrol(this.options.selectedIndex)">
<option>Blank form</option>
</select>
</form>
</div>
<? if($_SESSION['memberid']==''){?>
<h2 class="blue-tit">Exclusive Access</h2>
<div class="greybg-content"><h4 class="title">Signup for exclusive access to what's happening in your city...</h4>
<form method="post" action="<?php echo get_page_link(5); ?>"><input class="f-left field-city" type="text" name="email" /> <input class="signup-btn1" type="submit" value="signup" name="signup" />
</form></div>
<? }?>
</div>