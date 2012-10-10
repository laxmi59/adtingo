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

$camp=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_campaigns` WHERE `campaign_id`=$_GET[rid]"));
$getreport=charts($camp['mailing_ID']);
//$getreport=charts(97);
//echo "<pre>";print_r ($getreport);echo "</pre>";

$shedule=$getreport->scheduledCount;
$totopen=$getreport->uniqueOpensCount;
$notopen=$shedule-$totopen;

$arr1=array($getreport->scheduledCount." records mailed", $getreport->totalBounceCount." bounce", $notopen."not open");
$arr2=array($getreport->scheduledCount,$getreport->totalBounceCount,$notopen);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
</head>
<style type="text/css">
.tdh1{background:#A4D1FF;}
.tdh2{background:#FFFFFF;}
</style>
<body>
<!--header-->
<?php include('includes/header.php'); ?> 
<!--end banner-->
<!--body-->
 <div class="body">
 
 <div class="account-settings">
      	 <div class="account-settings-top">
         	<div class="account-settings-bottom">
            <div class="as-left-col w-680">
            <p class="bread"><a href="reports.php">Reports</a><span  class="breadArrow">&nbsp;</span>Campaign Performance Report</p>
            <div class="reports no-border">
           
          <h1 id="campaignTitle"><?php echo $camp['campaign_name']?></h1>
          <p> <?php  $dt=$camp['schedule_date']; echo date('l F j, Y', strtotime($dt))?> </p>
        </div>
        	<div class="dataHighlight">
            <table class="goalSummary" width="100%" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td ><div class="peopleClicked"><?php  echo round($getreport->clickRate)?></div></td>
                  <td width="50%"><h5>peopleclicked</h5>Giving you a <strong>0%</strong> click rate.</td>
                  <td ><div class="secondary"><?php echo round($getreport->totalClicksPercent)?></div></td>
                  <td  width="50%"><h5>total clicks</h5>  Made by 0 people</td>
                </tr>
				<?php 
				$notclick=$getreport->totalClicksPercent-$getreport->clickRate;
				?>
                <tr  class="border-top">
                  <td ><div class="secondary"><?php echo round($getreport->clickRate)?></div></td>
                  <td  width="50%"><h5>clicks per person</h5>  Average of all those who clicked.</td>
                  <td><div class="secondary"><?php echo round($notclick)?></div></td>
                  <td  width="50%"><h5>didn't click</h5>  No recipients have opened yet.</td>
                </tr>
              </tbody>
            </table>
          </div>
          	<div class="report-links">
             <table class="tableHeader"  width="100%" cellpadding="0" cellspacing="0">       
                <tr>
                  <th width="73%" class="headerLeft"  >Links (url)</th>
                  <th width="16%">Unique</th>
                  <th width="11%" class="headerRight" >Total</th>
                </tr>
               
				<?php for($i=0; $i<sizeof($getreport->linkReport);$i++){
				$bar_color[$i]=$getreport->linkReport[$i]->uniqueClicks*$getreport->linkReport[$i]->totalClicks/100;
				?>
				<tr>
					<td>
					<?php echo$getreport->linkReport[$i]->url?><br />
					<?php /*?><input type="text" name="bar<?=$i?>" style="height:3px;<? if($bar_color==0) echo 'width:450px; background:none;';else echo 'width:'.$bar_color.'px; background:#A4D1FF;'?>; width:450" /><?php */?>
					<table width="450" cellpadding="0"  cellspacing="0" style="-moz-border-radius:3px 3px 3px 3px; border:1px solid #ccc; ">
		<tr><?php if($bar_color[$i]==100){?>
			<td colspan="2" class="tdh1" ></td>
			<?php }elseif($bar_color[$i]<>0){?>
			<td class="tdh1" width="<?php echo $bar_color[$i]?>%" ></td>
			<td class="tdh2" width="<?php echo 100-$bar_color[$i]?>"></td>
			<?php }else{?>
			<td colspan="2" class="tdh2"></td>
			<?php }?>
		</tr>
		</table>	
					</td>		
					<td><?php echo $getreport->linkReport[$i]->uniqueClicks?></td>
					<td><?php echo $getreport->linkReport[$i]->totalClicks?></td>
				</tr>
				<?php }?>
               <!-- <tr>
                  <td colspan="3"><img src="images/reports4.jpg" width="670" alt="Report" /></td>
                </tr>-->
              
            </table>
          </div>
        
                    </div>
            <div class="as-right-col p-top67">
                   <div class="bghighlight">Campaign Reports</div>
                   <dl class="changepassword">
            <dt><a href="campaign-performance-report.php?rid=<?php echo $_GET['rid']?>"><img src="images/pie.png" alt="Campaign Performance Report" title="Campaign Performance Report"  /></a></dt>
            <dd class="noLink"><a href="campaign-performance-report.php?rid=<?php echo $_GET['rid']?>">Campaign Performance Report</a></dd>
            <dd class="last">Summary of campaign results to date.</dd>
            <dt><a href="#"  ><img src="images/icn_link_click_activity.gif" alt="Link Activity &amp; Overlay" /></a></dt>
            <dd class="noLink">Link Activity &amp; Overlay</dd>
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
