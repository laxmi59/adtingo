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
//$camp=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_campaigns` WHERE `campaign_id`=$_GET[rid]"));
//echo "SELECT * FROM `tbl_campaigns` WHERE `campaign_id`=$_GET[rid]";
$getreport=charts($recCampdetails['mailing_ID']);
//$getreport=charts(97);
//echo "<pre>";print_r ($getreport);echo "</pre>";

$shedule=$getreport->scheduledCount;
$totopen=$getreport->uniqueOpensCount;
$notopen=$getreport->deliveredCount-$totopen;

$arr1=array($getreport->scheduledCount." Records Mailed", $getreport->totalBounceCount." Bounce", $notopen." Not Open");
$arr2=array($getreport->scheduledCount,$getreport->totalBounceCount,$notopen);
?>
<style type="text/css">
.tdh1{background:#A4D1FF;}
.tdh2{background:#FFFFFF;}
</style>
<link href="css/css.css" rel="stylesheet"  />
<table width="95%" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td height="30">&nbsp;</td>
 </tr>
 <tr>
   <td height="30">
<div class="account-settings">
      	 <div class="account-settings-top">
         	<div class="account-settings-bottom">
            <div class="as-left-col w-680">
            <p class="bread"><a href="manage_reports.php?uid=<?php echo $_GET[uid]?>">Reports</a><span  class="breadArrow">&nbsp;</span>Link Activity Report </p>
            <div class="reports no-border">
           
          <div class="content-header"><?php echo $recCampdetails['campaign_name']?></div>
          <p> <?php $dt=$recCampdetails['schedule_date']; echo date('l F j, Y', strtotime($dt))?> </p>
        </div>
        	<div class="dataHighlight">
            <table class="goalSummary" width="100%" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                 
                  <td ><div class="secondary" title="Total Clicks"><?php echo round($getreport->mailingParts[0]->totalClicks)?></div></td>
                  <td  width="50%"style="padding-top:10px;"><h5>Total Clicks</h5>  Made by <?php echo round($getreport->mailingParts[0]->uniqueUsers)?> people</td>
				   <td ><div class="peopleClicked" title="People Clicked"><?php echo $getreport->mailingParts[0]->uniqueUsers?></div></td>
                  <td width="50%" valign="middle"style="padding-top:10px;"><h5>People Clicked</h5>Giving you a <strong><?php  //echo round($getreport->totalClicksPercent)
				  echo $getreport->mailingParts[0]->uniqueUsers*100/$getreport->uniqueOpensCount?> %</strong> click rate.</td>
                </tr>
				<?php
				$notclick=$getreport->totalClicksPercent-$getreport->clickRate;
				?>
                <tr  class="border-top">
                  <td ><div class="secondary" title="Clicks per Person"><?php  echo round($getreport->uniqueClicksCount)?></div></td>
                  <td  width="50%"style="padding-top:10px;"><h5>Clicks per Person</h5>  Average of all those who clicked.</td>
                  <td><div class="secondary" title="Didn't Click"><?php echo $getreport->uniqueOpensCount-$getreport->mailingParts[0]->uniqueUsers;//echo $getreport->deliveredCount-$getreport->uniqueOpensCount?></div></td>
                  <td  width="50%" style="padding-top:10px;"><h5>Didn't Click </h5><?php echo $getreport->deliveredCount-$getreport->uniqueOpensCount?> recipients did not open </td>
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
		$bar_color=$sel_fet['unique1']*100/$getreport->totalClicksCount;
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
				  <table align="center">
   
   <tr><td colspan="2"><div class="bghighlight">Campaign Reports</div></td></tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
   		<td><a href="campaign-performance-report.php?uid=<?php echo $_GET[uid]?>&rid=<?php echo $_GET['rid']?>" ><img src="images/pie.png" alt="campaign-performance-reportt" title="Campaign Performance Report"  /></a></td>
        <td><a href="campaign-performance-report.php?uid=<?php echo $_GET[uid]?>&rid=<?php echo $_GET['rid']?>" id="linkClickActivity"><b>Campaign Performance Report</b></a><br>Summary of campaign results to date</td>
	</tr>
    <tr> 
		<td><a href="#"  ><img src="images/icn_link_click_activity.gif" alt="Link Activity &amp; Overlay" /></a></td>
		<td><b>Link Activity &amp; Overlay</b><br>
        Which links were popular, who clicked.</td>
	</tr>
	</table>
            </div>
             <div class="clear"></div>
            </div>
             <div class="clear"></div>
            </div>
             <div class="clear"></div>
            </div>
     
     
     
     
  <div class="clear"></div>
</div></td></tr></table>
            <!--footer-->
            <?php include('includes/footer.php'); ?>
            <!--End footer-->
