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
$notopen=$shedule-$totopen;

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
                  <td ><div class="peopleClicked" title="People Clicked"><?php echo round($getreport->clickRate)?></div></td>
                  <td width="50%" valign="middle"><h5>People Clicked</h5>Giving you a <strong>0%</strong> click rate.</td>
                  <td ><div class="secondary" title="Total Clicks"><?php echo round($getreport->totalClicksPercent)?></div></td>
                  <td  width="50%"><h5>Total Clicks</h5>  Made by 0 people</td>
                </tr>
				<?php
				$notclick=$getreport->totalClicksPercent-$getreport->clickRate;
				?>
                <tr  class="border-top">
                  <td ><div class="secondary" title="Clicks per Person"><?php echo round($getreport->clickRate)?></div></td>
                  <td  width="50%"><h5>Clicks per Person</h5>  Average of all those who clicked.</td>
                  <td><div class="secondary" title="Didn't Click"><?php echo round($notclick)?></div></td>
                  <td  width="50%"><h5>Didn't Click</h5>  No recipients have opened yet.</td>
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
					<?php echo $getreport->linkReport[$i]->url?><br />
					<?php /*?><input type="text" name="bar<?php echo $i?>" style="height:3px;<?php if($bar_color==0) echo 'width:450px; background:none;';else echo 'width:'.$bar_color.'px; background:#A4D1FF;'?>; width:450" /><?php */?>
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
            <!--<div class="as-right-col p-top67">
                   <div class="bghighlight">Campaign Reports</div>
                   <dl class="changepassword">
            <dt><img src="../images/pie.png" alt="Snapshot"  /></dt>
            <dd class="noLink"><a href="campaign-performance-report.php?uid=<?php echo $_GET[uid]?>&rid=<?php echo $_GET['rid']?>">Campaign Performance Report</a></dd>
            <dd class="last">Summary of campaign results to date.</dd>
            <dt><img src="../images/icn_link_click_activity.gif" alt="Link Activity &amp; Overlay" /></dt>
            <dd class="noLink">Link Activity &amp; Overlay</dd>
            <dd class="last">Which links were popular, who clicked.</dd>
          </dl>
                  </div>-->
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
