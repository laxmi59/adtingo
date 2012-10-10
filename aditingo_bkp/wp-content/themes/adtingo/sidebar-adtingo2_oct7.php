<div class="content-right">
<div class="ads-rt"><br />
<br />
<p align="center">300*250 Ad</p></div>
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
			$zip=mysql_fetch_array(mysql_query("select * from `tbl_campaign_list_segmentation` where `campaign_id`=$comb[campaign_id]"));
			//echo $latlon['zipcode'];
			$latlon=mysql_fetch_array(mysql_query("select distinct `ZIP_CODE`, `LATITUDE`, `LONGITUDE` from `zip_code` where `ZIP_CODE`=$zip[zipcode]"));
			
			$city="<table cellpadding='3' cellspacing='3' border='0'><tr><td><b>Title: </b></td><td>".$comb1['campaign_name']."</td></tr><tr><td><b>contact: </b></td><td>".$comb1['contact_info']."</td></tr><tr><td><b>website: </b></td><td><a href='destination_url' target='_blank'>".$comb1['destination_url']."</td></tr><tr><td colspan='2'>".$latlon['CITY']."</td></tr></table>";
			$lat=$latlon['LATITUDE'];
			$lon=$latlon['LONGITUDE'];
			//echo $city;
		}else{
			//echo "it is not a post";
			$cats=mysql_query("SELECT DISTINCT * FROM `wp_terms` AS tab1, `wp_term_taxonomy` AS tab2 WHERE tab1.term_id = tab2.term_id AND tab2.parent =0 AND tab2.taxonomy = 'category'");
			while($cat_fet=mysql_fetch_array($cats)){
				if($cat_fet['slug']==$file ||$cat_fet['slug']==$filett) $show=1;
				if($show==1){
					if($cat_fet['slug']=='washington-dc') $cat= 'washington'; else $cat=$cat_fet['name'];
					if($cat_fet['slug']=='hamptons')$cat= 'EAST HAMPTON'; else $cat=$cat_fet['slug'];
					$zip=mysql_fetch_array(mysql_query("select distinct * from `zip_code` where `CITY`='$cat'"));
					//echo "select distinct * from `ZIP_CODE` where `CITY`='$cat'";
					$city= "<b>".$zip['CITY']."</b>";
					$lat=$zip['LATITUDE'];
					$lon=$zip['LONGITUDE'];
					$show=0;
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
setcookie('side_keyword_title', $side_keyword_title, time()+15);
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


<div class="category-col m-rignone">
    <h1 class="innertitblue">Search Adtingo</h1>
    <div class="search-bg">
	<form method="post">
	<div>&nbsp;</div>
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
<? $ex1=$_SERVER['REQUEST_URI'];
	$file = basename(rtrim($ex1, '/'));
		$tes =str_replace($file,"",$ex1);
		$filett = basename(rtrim($tes, '/'));
		$ssl=mysql_num_rows(mysql_query("select * from `wp_terms` where `slug`='".$filett."'"));
		$ss2=mysql_num_rows(mysql_query("select * from `wp_terms` where `slug`='".$file."'"));
		//echo $ssl;
		$err=0;
		if($ssl<>0){
			$sst=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$filett."'"));
			$sel=mysql_fetch_array(mysql_query("select * from `tbl_catart` where cat_id=$sst[term_id]"));
			if($sel)$err=1;
		}elseif($ss2<>0){
			$ss2=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".$file."'"));
			$sel=mysql_fetch_array(mysql_query("select * from `tbl_catart` where cat_id=$ss2[term_id]"));
			if($sel)$err=1;
		}else{
			$ss2=mysql_fetch_array(mysql_query("select * from `wp_terms` where `slug`='".DEFAULT_CITY."'"));
			$sel=mysql_fetch_array(mysql_query("select * from `tbl_catart` where cat_id=$ss2[term_id]"));
			//echo "select * from `tbl_catart` where cat_id=$ss2[term_id]";
			if($sel)$err=1;
		}
		?>
<div class="local-gooders-cont">
<? if($err<>0){?>
	<? if($sel['img']<>''){?>
		<img alt="" src="<?php echo home_url( '/' ); ?>client/admin/articles/<? echo $sel['img']?>" class="f-left" width="110" height="110" />
		<h3 class="heading"><?=$sel['title']?></h3>
		<p><?=$sel['desc']?></p>
	<? }else{?>
		<h3 class="heading"><?=$sel['title']?></h3>
		<p><?=$sel['desc']?></p>
	<? }?>
<? }else{?>
<h3 style='text-transform:capitalize;' align='center'>  No records Found</h3>
<? }?>
</div>
<h2 class="blue-tit">Exclusive Access</h2>
<div class="greybg-content"><h4 class="title">Signup for exclusive access to what's happening in your city...</h4>
<form method="post" action="<?php echo get_page_link(5); ?>"><input class="f-left field-city" type="text" name="email" /> <input class="signup-btn" type="submit" value="signup" name="signup" /></form></div>

</div>