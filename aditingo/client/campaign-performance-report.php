<?php 
session_start();
include_once('includes/session.php');
include('includes/functions.php');
include('includes/values.php');
include('includes/graph.php');
$obj= new graphs_types();
$object=new main(); 
$Clientid=$_SESSION['clientid']; 
$SqlGetclientsinfo=sprintf("select * from tbl_clients where clientid=%d and status='%s'",$object->stripper($_SESSION['clientid']),$object->stripper(1));
$QryGetclientsinfo=$object->ExecuteQuery($SqlGetclientsinfo);
$cols=$object->NumRows($QryGetclientsinfo);
$ResGetclientsinfo=$object->FetchArray($QryGetclientsinfo);

$camp=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_campaigns` WHERE `campaign_id`=$_GET[rid]"));
$getreport=charts($camp['mailing_ID']);
//$getreport=charts(97);
//echo "<pre>";print_r ($getreport);echo "</pre>";

$shedule=$getreport->scheduledCount;
$totopen=$getreport->uniqueOpensCount;
$notopen=$shedule-$totopen;

$arr1=array($getreport->scheduledCount." Records Mailed", $getreport->totalBounceCount." Bounce", $notopen." Not Open");
$arr2=array($getreport->scheduledCount,$getreport->totalBounceCount,$notopen);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
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
				['<?=$arr1[0]?>',   <?=$arr2[0]?>],
				['<?=$arr1[1]?>',   <?=$arr2[1]?>],
				['<?=$arr1[2]?>',   <?=$arr2[2]?>]
			]
		}]
	});
});

</script>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
</head>

<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->
<!--body-->
<div class="body">
  <div class="account-settings">
    <div class="account-settings-top">
      <div class="account-settings-bottom">
        <!--left col-->
        <div class="as-left-col w-680">
          <p class="bread"><a href="reports.php">Reports</a><span  class="breadArrow">&nbsp;</span>Campaign Performance Report</p>
          <div class="reports">
            <h1>
              <?=$camp['campaign_name']?>
            </h1>
            <p>
              <? $dt=$camp['schedule_date']; echo date('l F j, Y', strtotime($dt))?>
            </p>
          </div>
          <div class="chart-box" >
            <div class="chart">
              <div id="container" style="width: 390px; height: 400px; "></div>
              <!-- <img src="images/reports2.jpg" alt=""/>-->
            </div>
            <div class="chart-summary">
              <ul>
                <li class="green">
                  <h3>
                    <?=$getreport->scheduledCount?>
                    <a href="#">records mailed</a></h3>
                  <?=$getreport->mailingParts[0]->totalOpens?>
                  total opens to date </li>
                <li class="green">
                  <h3>10.781 <a href="#">days it took to mail</a></h3>
                  <?=$getreport->mailingParts[0]->totalOpens?>
                  total opens to date</li>
                <li class="red">
                  <h3>
                    <?=$getreport->totalBounceCount?>
                    <span><a href="#">Bounced</a></span></h3>
                  <?=$getreport->totalBouncePercent?>
                  countn't  to be delivered</li>
                <li class="blue">
                  <h3>
                    <?=$notopen?>
                    <span><a href="#" >Not Opened</a></span></h3>
                  Open rates are <a href="#"  title="All about open rates">only estimates</a></li>
              </ul>
            </div>
            <div class="chart-summary2">
              <p><span><? $opn2=$getreport->deliveredCount*$getreport->uniqueOpensCount/100;
                echo $opn2;?>
                %</span>of all recipients <a href="#">opened so far</a></p>
              <p><span>
                <?=round($getreport->totalClicksPercent, 2)?>
                %</span>clicked a link (0 people)</p>
              <p><span>
                <?=round($getreport->unsubscribeResponsesPercent,2)?>
                %</span>unsubscribed (0 people)</p>
              <p><span>0%</span> forwarded the email(0 people)</p>
              <p><span>0%</span> people&nbsp;marked it as spam (0%)</p>
            </div>
          </div>
        </div>
        <!--right col-->
        <div class="as-right-col p-top67">
          <div class="bghighlight">Campaign Reports</div>
          <dl class="changepassword">
            <dt><img src="images/pie.png" alt="Snapshot"  /></dt>
            <dd class="noLink">Campaign Performance Report</dd>
            <dd class="last">Summary of campaign results to date.</dd>
            <dt><a href="#"  ><img src="images/icn_link_click_activity.gif" alt="Link Activity &amp; Overlay" /></a></dt>
            <dd><a href="lnk-activity-overlay.php?rid=<?=$_GET['rid']?>" id="linkClickActivity">Link Activity &amp; Overlay</a></dd>
            <dd class="last">Which links were popular, who clicked.</dd>
          </dl>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<!--footer-->
<?php include('includes/footer.php'); ?>
<!--End footer-->
</body>
</html>
