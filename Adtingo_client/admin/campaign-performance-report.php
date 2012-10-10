<?php 
$nav=13;
include("includes/adminsessions.php");
include('includes/header.php'); 
include('includes/values.php');
include('includes/graph.php');
$obj= new graphs_types();
$object=new main(); 
$getCampdetails="SELECT * FROM `tbl_campaigns` WHERE `campaign_id`=$_GET[rid]";
$resCampdetails=$object->ExecuteQuery($getCampdetails);
$recCampdetails=$object->FetchArray($resCampdetails);

$getreport=charts($recCampdetails['mailing_ID']);
$shedule=$getreport->scheduledCount;
$totopen=$getreport->uniqueOpensCount;
$notopen=$shedule-$totopen;
$arr1=array($getreport->scheduledCount." Records Mailed", $getreport->totalBounceCount." Bounce", $notopen." Not Open");
$arr2=array($getreport->scheduledCount,$getreport->totalBounceCount,$notopen);
?>
<link href="css/css.css" rel="stylesheet"  />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
<script type="text/javascript" src="../js/modules/exporting.js"></script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			margin: [-80, 200, 60, 10]
		},
		plotArea: {
			shadow: null,
			borderWidth: null,
			backgroundColor: null
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					formatter: function() {
						if (this.y > 5) return this.point.name;
					},
					color: 'white',
					style: {
						font: '13px Trebuchet MS, Verdana, sans-serif'
					}
				}
			}
		},
		legend: {
			layout: 'vertical',
			style: {
				left: 'auto',
				bottom: 'auto',
				right: '10px',
				top: '50px'
			}
		},
		series: [{
			type: 'pie',
			name: 'Campaign reports',
			data: [
				['<?php echo $arr1[0]?>',   <?php echo $arr2[0]?>],
				['<?php echo $arr1[1]?>',   <?php echo $arr2[1]?>],
				['<?php echo $arr1[2]?>',   <?php echo $arr2[2]?>]
			]
		}]
	});
});

</script>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td height="30">
   <table width="95%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td height="20" align="left" ><p>&nbsp;</p></td>
   </tr>
   <tr>
		<td height="20" align="left" ><p class="bread"><a href="manage_reports.php?uid=<?php echo $_GET[uid]?>">Reports</a><span  class="breadArrow">&nbsp;</span>Campaign Performance Report</p></td>
  </tr>
  <tr><td  class="content-header"><?php echo $recCampdetails['campaign_name']?></td></tr>
  <tr><td><p><?php $dt=$recCampdetails['schedule_date']; echo date('l F j, Y', strtotime($dt))?></p></td></tr>
   </table></td>
   <td width="23%" rowspan="2" valign="top">
    <div class="as-right-col p-top67">
   <table>
  
   <tr><td colspan="2"><div class="bghighlight">Campaign Reports</div></td></tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
   		<td><img src="images/pie.png" alt="Snapshot"  /></td>
        <td><b>Campaign Performance Report</b><br>Summary of campaign results to date</td>
	</tr>
    <tr> 
		<td><a href="lnk-activity-overlay.php?uid=<?php echo $_GET[uid]?>&rid=<?php echo $_GET['rid']?>"  ><img src="images/icn_link_click_activity.gif" alt="Link Activity &amp; Overlay" title="Link Activity &amp; Overlay" /></a></td>
		<td><a href="lnk-activity-overlay.php?uid=<?php echo $_GET[uid]?>&rid=<?php echo $_GET['rid']?>" id="linkClickActivity"><b>Link Activity &amp; Overlay</b></a><br>
        Which links were popular, who clicked.</td>
	</tr>
	</table></div></td>
 </tr>
 <tr>
    <td width="77%" height="30"><table width="100%" border="0">
      <tr>
        <td width="57%" valign="top"> <div id="container" style="width: 390px; height: 300px; "></div></td>
        <td width="43%" valign="top"><div class="chart-summary2">
              <p><span><?php $opn2=$getreport->deliveredCount*$getreport->uniqueOpensCount/100;
                echo $opn2;?>
                %</span>of all recipients <a href="#">opened so far</a></p>
              <p><span>
                <?php echo round($getreport->totalClicksPercent, 2)?>
                %</span>clicked a link (0 people)</p>
              <p><span>
                <?php echo round($getreport->unsubscribeResponsesPercent,2)?>
                %</span>unsubscribed (0 people)</p>
              <p><span>0%</span> forwarded the email(0 people)</p>
              <p><span>0%</span> people&nbsp;marked it as spam (0%)</p>
          </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

<!--footer-->
<?php include('includes/footer.php'); ?>
<!--End footer-->
