<?php 
error_reporting(0);
include('includes/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
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
          <p class="bread"><a href="#">Reports</a><span  class="breadArrow">&nbsp;</span>Campaign Performance Report</p>
          <div class="reports">
            <h1>testrammi</h1>
            <p > Sent today to 1 subscriber in Sample List </p>
          </div>
          <div class="chart-box" >
            <div class="chart"> <img src="images/reports2.jpg" alt=""/></div>
            <div class="chart-summary">
              <ul>
                <li class="green">
                  <h3>10.781 <a href="#">records mailed</a></h3>
                  16.511total opens to date </li>
                <li class="green">
                  <h3>10.781 <a href="#">days it took to mail</a></h3>
                  16.511  total opens to date</li>
                <li class="red">
                  <h3>1.495 <span><a href="#">Bounced</a></span></h3>
                  4% countn't  to be delivered</li>
                <li class="blue">
                  <h3>25.059 <span><a href="#" >Not Opened</a></span></h3>
                  Open rates are <a href="#"  title="All about open rates">only estimates</a></li>
              </ul>
            </div>
            <div class="chart-summary2">
              <p><span>30.80%</span>of all recipients <a href="#">opened so far</a></p>
              <p><span>10.28%</span>clicked a link (0 people)</p>
              <p><span>0.91%</span>unsubscribed (0 people)</p>
              <p><span>0.91%</span>forwarded the email(0 people)</p>
              <p><span>8</span> people&nbsp;marked it as spam (0%)</p>
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
            <dd><a 
href="lnk-activity-overlay.php"
 id="linkClickActivity">Link Activity &amp; Overlay</a></dd>
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
