<?php 
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

$camp=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_campaigns` WHERE `campaign_id`='".$_GET['rid']."'"));
//echo $camp['mailing_ID'];
$getreport=charts($camp['mailing_ID']);
//echo $getreport;
//$getreport=charts(36);
//echo "<pre>";print_r ($getreport);echo "</pre>";

$shedule=$getreport->scheduledCount;
$totopen=$getreport->uniqueOpensCount;
$notopen=$getreport->deliveredCount-$totopen;

$arr1=array($getreport->deliveredCount." Records Mailed", $getreport->totalBounceCount." Bounce", $notopen." Not Open", $getreport->uniqueOpensCount." Unique Opens ");
$arr2=array($getreport->deliveredCount,$getreport->totalBounceCount,$notopen,$getreport->uniqueOpensCount);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Campaign Performance Report"?></title>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			margin: [-60, 180, 60, 10]
		},
		plotArea: {
			shadow: null,
			borderWidth: null,
			backgroundColor: null
		},
		tooltip: {
			formatter: function() {
				//return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
				return '<b>'+ this.point.name +'</b> ';
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: false,
					formatter: function() {
						if (this.y > 5) return this.point.name;
					},
					color: 'white',
					style: {
						font: '11px Trebuchet MS, Verdana, sans-serif'
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
				<?php /*?>['<?php echo $arr1[2]?>',   <?php echo $arr2[2]?>],<?php */?>
				['<?php echo $arr1[3]?>',   <?php echo $arr2[3]?>]
			]
		}]
	});
});

</script>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<?php include "includes/google_analytic.php";?>
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
              <?php echo $camp['campaign_name']?>
            </h1>
            <p>
              <?php $dt=$camp['schedule_date']; echo date('l F j, Y', strtotime($dt))?>
			  <?
			  	//select category as cat, product as prd where cat.parent=1 and prd.parent=cat.id
			  ?>
            </p>
          </div>
          <div class="chart-box" >
            <div class="chart">
              <div id="container" style="width: 390px; height: 300px; "></div>
              <!-- <img src="images/reports2.jpg" alt=""/>-->
            </div>
            <div class="chart-summary">
              <ul>
                <li class="green">
                  <h3>
                    <?php echo $getreport->scheduledCount?>
                    <a href="#">records mailed</a></h3>
                  <?php echo $getreport->mailingParts[0]->totalOpens?>
                  total opens to date </li>
                <li class="green">
                  <h3>10.781 <a href="#">days it took to mail</a></h3>
                  <?php echo $getreport->mailingParts[0]->totalOpens?>
                  total opens to date</li>
                <li class="red">
                  <h3>
                    <?php echo $getreport->totalBounceCount?>
                    <span><a href="#">Bounced</a></span></h3>
                  <?php echo $getreport->totalBouncePercent?>
                  countn't  to be delivered</li>
                <li class="blue">
                  <h3>
                    <?php echo $notopen?>
                    <span><a href="#" >Not Opened</a></span></h3>
                  Open rates are <a href="#"  title="All about open rates">only estimates</a></li>
              </ul>
            </div>
			<?
			  	$SelectUnsubMembers=mysql_num_rows(mysql_query("select * from `tbl_unsubscribe` where campaign_id=$_REQUEST[rid]"));
				$SelectFarwardMembers=mysql_num_rows(mysql_query("select * from `tbl_emailtofrd` where campaign_id=$_REQUEST[rid]"));
			  ?>
            <div class="chart-summary2">
              <p><span><?php /*$opn2=($getreport->uniqueOpensCount*100)/$getreport->deliveredCount;
                 echo round($opn2,2);*/
				 if($getreport->uniqueOpensCount !=0){
			  	$opn2=($getreport->uniqueOpensCount*100)/$getreport->deliveredCount;
			  }else{
                $opn2=$getreport->uniqueOpensCount;
				}
				 echo round($opn2,2);
				 ?>
                %</span>of all recipients opened so far</p>
              <p><span>
                <?php //echo round($getreport->totalClicksPercent, 2);
				if($getreport->mailingParts[0]->uniqueUsers !=0){
					echo round($getreport->mailingParts[0]->uniqueUsers*100/$getreport->uniqueOpensCount,2);
				}else{
					echo $getreport->mailingParts[0]->uniqueUsers;
				}
				?>
                %</span>clicked a link ( <?php echo $getreport->mailingParts[0]->uniqueUsers?> people )</p>
              <?php /*?><p><span>
                <?php echo round(($SelectUnsubMembers*100)/$getreport->deliveredCount,2);?>
                %</span> unsubscribed (<?php echo $SelectUnsubMembers?> people)</p><?php */?>
              <p><span><?php //echo round(($SelectFarwardMembers*100)/$getreport->deliveredCount,2);
			   if($SelectFarwardMembers !=0){
				  echo round(($SelectFarwardMembers*100)/$getreport->deliveredCount,2);
			}else{
				echo $SelectFarwardMembers;
			}
			  ?> %</span> forwarded the email( <?php echo $SelectFarwardMembers?> people )</p>
              <!--<p><span>0 %</span> people&nbsp;marked it as spam (0 people)</p>-->
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
            <dt><a href="lnk-activity-overlay.php?rid=<?php echo $_GET['rid']?>"  ><img src="images/icn_link_click_activity.gif" alt="Link Activity &amp; Overlay"  title="Link Activity &amp; Overlay"/></a></dt>
            <dd><a href="lnk-activity-overlay.php?rid=<?php echo $_GET['rid']?>" id="linkClickActivity">Link Activity &amp; Overlay</a></dd>
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
