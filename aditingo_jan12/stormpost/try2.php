<?
include "dbcon.php";
$xvalues ='';
$yopen ='';
$yunique ='';
$yunsub ='';
$yunread ='';
$yunsub ='';
$yreply ='';
$ysend	='';
include "functions.php";
$obj= new graphs_types();
// for x axis
//$Sel_art=mysql_query("select * from `campaign` where cid between 50 and 51");
if($_GET['act']=='preport'){
	//echo "test";
	$Sel_art=mysql_query("select * from `campaign` where mid='$rid'");
	//echo "select * from `campaign` where mid='$rid'";
}else
	$Sel_art=mysql_query("select * from `campaign`");
	
//echo "select * from `campaign`";
$sz=mysql_num_rows($Sel_art);
for($i=1;$Sel_art_fet=mysql_fetch_array($Sel_art);$i++){
	if($sz==$i) $xvalues .="'".$Sel_art_fet['cid']."'"; else $xvalues .="'".$Sel_art_fet['cid']."', ";
	
	$Sel_art_open=mysql_query("select * from `reports` where mid='$Sel_art_fet[mid]'");
	//echo "select * from `reports` where mid='$Sel_art_fet[mid]'";
	$yopentot=0;$yuniquetot=0; $yunreadtot=0; $yunsubtot=0; $yreplytot=0;
	for($j=1;$Sel_art_open_fet=mysql_fetch_array($Sel_art_open);$j++){
		$yopentot = $yopentot+$Sel_art_open_fet['open'];
		$yuniquetot = $yuniquetot+$Sel_art_open_fet['unique'];
		if($Sel_art_open_fet['open']==0){
			$yunreadtot = $yunreadtot+$j;
		}
		$yunsubtot = $yunsubtot+$Sel_art_open_fet['unsub'];
		$yreplytot = $yreplytot+$Sel_art_open_fet['reply'];
	}
	$yopenavg=$yopentot/sizeof($Sel_art_open_fet);
	$yuniqueavg=$yuniquetot/sizeof($Sel_art_open_fet);
	$yunsubavg=$yunsubtot/sizeof($Sel_art_open_fet);
	$yreplyavg=$yreplytot/sizeof($Sel_art_open_fet);
	$ysendavg=$Sel_art_fet['members']/sizeof($Sel_art_open_fet);
	
	if($sz==$i) $yopen .=$yopenavg; else $yopen .=$yopenavg.", ";
	if($sz==$i) $yunique .=$yuniqueavg; else $yunique .=$yuniqueavg.", ";
	if($sz==$i) $yunread .=$yunreadtot; else $yunread .= $yunreadtot.", ";
	if($sz==$i) $yunsub .=$yunsubavg; else $yunsub .= $yunsubavg.", ";
	if($sz==$i) $yreply .=$yreplyavg; else $yreply .= $yreplyavg.", ";
	if($sz==$i) $ysend .=$ysendavg; else $ysend .= $ysendavg.", ";
}
if($_GET['type']=='' ? $type=1 : $type=$_GET['type']);
//echo $type;
$arry1=array('open','unique','unread','unsubscribe','reply','send');
$arry2=array($yopen,$yunique,$yunread,$yunsub,$yreply,$ysend);
//$arry2=array(1,1,0,1,0,1);
/*echo "<br>";
print_r($arry1);
echo "<br>";
print_r($arry2);*/
$title = "title: { text: 'test'},subtitle: {text: 'Source: WorldClimate.com'}";
?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script type="text/javascript">

function fun(nid){
	window.location='action.php?act=<?=$_GET['act']?>&type='+nid;
}
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
	<? 
	switch ($type) {
    	case 1:
        	$res=$obj->line_graph($xvalues,$yvalues,$title,$arry1,$arry2,'line');
	        break;
    	case 2:
        	$res=$obj->line_graph($xvalues,$yvalues,$title,$arry1,$arry2,'spline');
	        break;
		case 3:
        	$res=$obj->line_labels($xvalues,$yvalues,$title,$arry1,$arry2,'line');
	        break;
		case 4:
        	$res=$obj->line_time_series($xvalues,$yvalues,$title,$arry1,$arry2);
	        break;
		case 5:
        	$res=$obj->spline_plot_bands($xvalues,$yvalues,$title,$arry1,$arry2);
	        break;
		case 6:
        	$res=$obj->area_basic($xvalues,$yvalues,$title,$arry1,$arry2);
	        break;
		case 7:
        	$res=$obj->bar_graph($xvalues,$yvalues,$title,$arry1,$arry2,'bar');
	        break;
		case 8:
        	$res=$obj->bar_graph_stak($xvalues,$yvalues,$title,$arry1,$arry2,'bar');
	        break;
		case 9:
        	$res=$obj->bar_graph($xvalues,$yvalues,$title,$arry1,$arry2,'column');
	        break;
		case 10:
        	$res=$obj->bar_graph_stak($xvalues,$yvalues,$title,$arry1,$arry2,'column');
	        break;
		case 11:
        	$res=$obj->basic_pie($xvalues,$yvalues,$title,$arry1,$arry2);
	        break;
		case 12:
			$res=$obj->piechart($title,$arry1,$arry2);
			break;
		
	}
	echo $res;
	?>
	});
	
});

</script>


<table width="90%">
<? if($_GET['act']<>'preport'){?>
<tr>
	<td width="21%">Select Graph</td>
	<td width="2%">:</td>
	<td width="77%">
	<? $arr=array("select","line","spline","line_label","line_time_series","spline_plot_bands","area_basic","bar","bar_stak","bar_graph_horizontal","bar_graph_horizontal_stack");	?>
		<select name="grp" onChange="fun(this.value)">
			<? for($i=0; $i<sizeof($arr); $i++){?>
			<option value="<?=$i?>" <? if($_GET['type']==$i) echo "selected=selected"?>><?=$arr[$i]?></option>
			<? }?>
		</select></td>
</tr>
<? }?>
<tr>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
	<td colspan="3"><div id="container" style="width: 800px; height: 400px"></div></td>
</tr>
</table>

