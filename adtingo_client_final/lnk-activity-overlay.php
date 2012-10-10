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
$notopen=$getreport->deliveredCount-$totopen;

$arr1=array($getreport->scheduledCount." records mailed", $getreport->totalBounceCount." bounce", $notopen."not open");
$arr2=array($getreport->scheduledCount,$getreport->totalBounceCount,$notopen);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE."Link Activity & Overlay"?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
<?php include "includes/google_analytic.php";?>
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
            <p class="bread"><a href="reports.php">Reports</a><span  class="breadArrow">&nbsp;</span>Link Activity & Overlay</p>
            <div class="reports no-border">
           
          <h1 id="campaignTitle"><?php echo $camp['campaign_name']?></h1>
          <p> <?php  $dt=$camp['schedule_date']; echo date('l F j, Y', strtotime($dt))?> </p>
        </div>
        	<div class="dataHighlight">
            <table class="goalSummary" width="100%" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                 
                  <td ><div class="secondary"><?php echo round($getreport->mailingParts[0]->totalClicks)?></div></td>
                  <td  width="50%"><h5>Total Clicks</h5>  Made by <?php echo round($getreport->mailingParts[0]->uniqueUsers)?> people</td>
				   <td ><div class="peopleClicked"><?php  echo $getreport->mailingParts[0]->uniqueUsers?></div></td>
                  <td width="50%"><h5>People Clicked</h5>Giving you a <strong><?php 
				   //echo round($getreport->totalClicksPercent)
				   if($getreport->mailingParts[0]->uniqueUsers !=0){
				  echo $getreport->mailingParts[0]->uniqueUsers*100/$getreport->uniqueOpensCount;
				  }else{
				   echo $getreport->mailingParts[0]->uniqueUsers;
				  }?> %</strong> click rate.</td>
                </tr>
				<?php 
				$notclick=$getreport->totalClicksPercent-$getreport->clickRate;
				?>
                <tr  class="border-top">
                  <td ><div class="secondary"><?php  echo round($getreport->uniqueClicksCount)?></div></td>
                  <td  width="50%"><h5>Clicks per Person</h5>  Average of all those who clicked.</td>
                  <td><div class="secondary"><?php echo $getreport->uniqueOpensCount-$getreport->mailingParts[0]->uniqueUsers; //echo $getreport->deliveredCount-$getreport->uniqueOpensCount?></div></td>
                  <td  width="50%"><h5> Didn’t Click</h5><?php echo $getreport->deliveredCount-$getreport->uniqueOpensCount?>  recipients did not open <!--No recipients have opened yet.--></td>
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
               
				
				<?php
				$ins=mysql_query("CREATE temporary TABLE `link_list` (`name` TEXT NOT NULL ,`unique1` INT NOT NULL ,`total` INT NOT NULL
)");		
				for($i=0;$i<sizeof($getreport->linkReport);$i++){
		if($getreport->linkReport[$i]->uniqueClicks ==0){continue;}
		//echo $getreport->linkReport[$i]->url;
		if($getreport->linkReport[$i]->url == "http://adtingo.com/unsubscribe?cid=MzYw&mid=[-EMAILADDR-]"){ continue;}
		$name=$getreport->linkReport[$i]->url;
		$unique1=$getreport->linkReport[$i]->uniqueClicks;
		$total=$getreport->linkReport[$i]->totalClicks;
		$ins_val=mysql_query("insert into link_list (name, unique1, total) values('$name','$unique1','$total')");
	
	}
	$sel=mysql_query("select * from link_list ORDER BY `total` DESC ");
	while($sel_fet=mysql_fetch_array($sel)){
		//echo $sel_fet['total']."--";
		if($sel_fet['unique1'] !=0){
		$bar_color=$sel_fet['unique1']*100/$getreport->totalClicksCount;
		}else{
			$bar_color=$sel_fet['unique1'];
		}
		?><tr>
			<td><?php echo $sel_fet['name']?><br />
				<table width="450" cellpadding="0"  cellspacing="0" style="-moz-border-radius:3px 3px 3px 3px; border:1px solid #ccc; ">
			<tr><?php if($bar_color==100){?>
			<td colspan="2" class="tdh1" ></td>
			<?php }elseif($bar_color<>0){?>
			<td class="tdh1" width="<?php echo $bar_color?>%" ></td>
			<td class="tdh2" width="<?php echo 100-$bar_color?>"></td>
			<?php }else{?>
			<td colspan="2" class="tdh2"></td>
			<?php }?>
		</tr>
		</table>	
					</td>		
					<td><?php echo $sel_fet['unique1']?></td>
					<td><?php echo $sel_fet['total']?></td>
				</tr>
				
	<?php $bar_color='';$link_val='';$click_val='';}?>
	
              
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
