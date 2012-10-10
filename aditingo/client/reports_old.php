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
  <div class="title"><h2>Campaigns Summary</h2> <div class="f-right">  <a onclick="CS.Step4_1.step4_1TestEmail(); return false;" href="campaign-comparison.php" class="greybutton"><span> Campaign Comparison</span></a> </div></div> 
 
     
    <table class="tableHeader"  width="100%" cellpadding="0" 
cellspacing="0">
      <tbody>
        <tr>
          <th class="headerLeft" width="207">Campaign Name</th>
          <th width="363"   >Subject</th>
          <th   width="264" >Schedule Date</th>
          <th class="headerRight" width="124" nowrap="nowrap">Options</th>
        </tr>
        
        <tr>
          <td >testrammi<span>Created Tuesday, 20 July 2010</span> </td>
          <td   >Test</td>
          <td  >20 July 2010,12:00 PM</td>
          <td ><a href="campaign-performance-report.php"><img src="images/reports.png" alt="Reports"  /></a></td>
        </tr>
        
        <tr>
          <td >testrammi<a href="#" class="left"></a> 
            <span>Created Tuesday, 20 July 2010</span> </td>
          <td >Test</td>
          <td >20 July 2010,12:00 PM</td>
          <td ><a href="campaign-performance-report.php"><img src="images/reports.png" alt="Reports"   /></a></td>
        </tr>
        <tr>
          <td >testrammi<a href="#" class="left"></a> 
            <span>Created Tuesday, 20 July 2010</span> </td>
          <td >Test</td>
          <td >20 July 2010,12:00 PM</td>
          <td ><a href="campaign-performance-report.php"><img src="images/reports.png" alt="Reports"  /></a></td>
        </tr>
        <tr>
          <td >testrammi<a href="#" class="left"></a> 
            <span>Created Tuesday, 20 July 2010</span> </td>
          <td >Test</td>
          <td >20 July 2010,12:00 PM</td>
          <td ><a href="campaign-performance-report.php"><img src="images/reports.png" alt="Reports"  /></a></td>
        </tr>
        <tr class="no-border">
          <td >testrammi<a href="#" class="left"></a> 
            <span>Created Tuesday, 20 July 2010</span> </td>
          <td >Test</td>
          <td >20 July 2010,12:00 PM</td>
          <td ><a href="campaign-performance-report.php"><img src="images/reports.png" alt="Reports"   /></a></td>
        </tr>
      </tbody>
    </table>
    <table class="tableFooter" width="100%" cellpadding="0" cellspacing="0">
    
        <tr>
          <td class="left"  >page <span class="fontlightgray"><img  alt="Go to Previous page" src="images/pre-off.gif" /></span>&nbsp;
            <input type="text"  size="2" value="1"   name="page" />
            &nbsp;<a href="#"><img alt="Go to Previous page" src="images/next-page.gif" /></a> of 2 pages        |   view
            <select    name="limit">
              <option value="1">1</option>
              <option selected="selected" value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
              <option value="40">40</option>
              <option value="50">50</option>
              <option value="60">60</option>
              <option value="70">70</option>
              <option value="80">80</option>
              <option value="90">90</option>
              <option value="100">100</option>
            </select>
            per page</td>
          <td class="right" align="right">&nbsp;</td>
        </tr>
       
    </table>
     
 
</div>
<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
