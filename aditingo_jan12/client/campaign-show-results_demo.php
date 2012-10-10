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
//echo print_r($_POST);
//$camp=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_campaigns` WHERE `campaign_id`=$_GET[rid]"));
//$getreport=charts($camp['mailing_ID']);
$dd=$_POST['jumpMenu'];
echo $dd[0];
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
<!--header start-->
<?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
      <div class="title"><h2>Compare Campaign Results</h2>
      <p class="sub-text"> comparing results across 6 different campaigns. <a href="campaign-comparison.php">Select new campaigns</a> to compare</p>
       </div> 
       <div class="graph"><img src="images/graph-big-img.gif" alt="graph" /></div>
       
        
    <table class="tableHeader"  width="100%" cellpadding="0" cellspacing="0">
      <tbody>
        <tr >
        <th width="26"  class="headerLeft">&nbsp;</th>
          <th class="cellCenter" width="450">&nbsp;</th>
          <th class="cellCenter" width="93" nowrap="nowrap"><img src="images/green-dot.gif" alt="Opens" /> Opens</th>
          <th class="cellCenter" width="84" nowrap="nowrap"><img src="images/blue-dot.gif" alt="Clicks" />  Clicks</th>
          <th class="cellCenter" width="88" nowrap="nowrap"><img src="images/red-dot.gif" alt="Bounces" />  Bounces</th>
           <th class="cellCenter" width="112" nowrap="nowrap"><img src="images/orrange-dot.gif" alt="Unsubscribes" />  Unsubscribes</th>
          <th class="cellCenter headerRight" width="105" nowrap="nowrap"><img src="images/skyblue-dot.gif" alt="Unsubscribes" /> Complaints</th>
          
        </tr>
        <tr  >
        <td align="center" valign="top" class="b">1</td>
          <td>
          
          <div class="b">Smithcast Episode1</div> 

<span>Sent to 66,725 on Tue, 22 Apr 2008 at 6:08 pm<br />

<a href="#">Full Results</a> | <a href="#">View Campaign</a></span>
          
          
             
              </td>
          <td valign="middle" class="cellCenter" ><strong>34.13%</strong><br />
 <span>22,558</span>
 </td>
          <td valign="middle" class="cellCenter"><strong>20.44%</strong><br />
 <span>4,160 </span>
</td>
          <td valign="middle" class="cellCenter"><strong>2.65%</strong><br />
<span>1,770 </span>
</td>
           <td valign="middle" class="cellCenter"><strong>0.84%</strong><br />
<span>546</span> 
</td>
          <td valign="middle" class="cellCenter"><strong>0.08%</strong><br />
<span>52</span></td>
        </tr>
        <tr  >
        <td align="center" valign="top" class="b">2</td>
          <td>
          
          <div class="b">Smithcast Episode2</div> 

<span>Sent to 66,725 on Tue, 22 Apr 2008 at 6:08 pm<br />

<a href="#">Full Results</a> | <a href="#">View Campaign</a></span>
          
          
             
              </td>
          <td valign="middle" class="cellCenter" ><strong>34.13%</strong><br />
 <span>22,558</span>
 </td>
          <td valign="middle" class="cellCenter"><strong>20.44%</strong><br />
 <span>4,160 </span>
</td>
          <td valign="middle" class="cellCenter"><strong>2.65%</strong><br />
<span>1,770 </span>
</td>
           <td valign="middle" class="cellCenter"><strong>0.84%</strong><br />
<span>546</span> 
</td>
          <td valign="middle" class="cellCenter"><strong>0.08%</strong><br />
<span>52</span></td>
        </tr>
        <tr  >
        <td align="center" valign="top" class="b">3</td>
          <td>
          
          <div class="b">Smithcast Episode3</div> 

<span>Sent to 66,725 on Tue, 22 Apr 2008 at 6:08 pm<br />

<a href="#">Full Results</a> | <a href="#">View Campaign</a></span>
          
          
             
              </td>
          <td valign="middle" class="cellCenter" ><strong>34.13%</strong><br />
 <span>22,558</span>
 </td>
          <td valign="middle" class="cellCenter"><strong>20.44%</strong><br />
 <span>4,160 </span>
</td>
          <td valign="middle" class="cellCenter"><strong>2.65%</strong><br />
<span>1,770 </span>
</td>
           <td valign="middle" class="cellCenter"><strong>0.84%</strong><br />
<span>546</span> 
</td>
          <td valign="middle" class="cellCenter"><strong>0.08%</strong><br />
<span>52</span></td>
        </tr>
        <tr  >
        <td align="center" valign="top" class="b">4</td>
          <td>
          
          <div class="b">Smithcast Episode4</div> 

<span>Sent to 66,725 on Tue, 22 Apr 2008 at 6:08 pm<br />

<a href="#">Full Results</a> | <a href="#">View Campaign</a></span>
          
          
             
              </td>
          <td valign="middle" class="cellCenter" ><strong>34.13%</strong><br />
 <span>22,558</span>
 </td>
          <td valign="middle" class="cellCenter"><strong>20.44%</strong><br />
 <span>4,160 </span>
</td>
          <td valign="middle" class="cellCenter"><strong>2.65%</strong><br />
<span>1,770 </span>
</td>
           <td valign="middle" class="cellCenter"><strong>0.84%</strong><br />
<span>546</span> 
</td>
          <td valign="middle" class="cellCenter"><strong>0.08%</strong><br />
<span>52</span></td>
        </tr>
        <tr  >
        <td align="center" valign="top" class="b">5</td>
          <td>
          
          <div class="b">Smithcast Episode5</div> 

<span>Sent to 66,725 on Tue, 22 Apr 2008 at 6:08 pm<br />

<a href="#">Full Results</a> | <a href="#">View Campaign</a></span>
          
          
             
              </td>
          <td valign="middle" class="cellCenter" ><strong>34.13%</strong><br />
 <span>22,558</span>
 </td>
          <td valign="middle" class="cellCenter"><strong>20.44%</strong><br />
 <span>4,160 </span>
</td>
          <td valign="middle" class="cellCenter"><strong>2.65%</strong><br />
<span>1,770 </span>
</td>
           <td valign="middle" class="cellCenter"><strong>0.84%</strong><br />
<span>546</span> 
</td>
          <td valign="middle" class="cellCenter"><strong>0.08%</strong><br />
<span>52</span></td>
        </tr>
        <tr  >
        <td align="center" valign="top" class="b">6</td>
          <td>
          
          <div class="b">Smithcast Episode6</div> 

<span>Sent to 66,725 on Tue, 22 Apr 2008 at 6:08 pm<br />

<a href="#">Full Results</a> | <a href="#">View Campaign</a></span>
          
          
             
              </td>
          <td valign="middle" class="cellCenter" ><strong>34.13%</strong><br />
 <span>22,558</span>
 </td>
          <td valign="middle" class="cellCenter"><strong>20.44%</strong><br />
 <span>4,160 </span>
</td>
          <td valign="middle" class="cellCenter"><strong>2.65%</strong><br />
<span>1,770 </span>
</td>
           <td valign="middle" class="cellCenter"><strong>0.84%</strong><br />
<span>546</span> 
</td>
          <td valign="middle" class="cellCenter"><strong>0.08%</strong><br />
<span>52</span></td>
        </tr>
        <tr  class="no-border" >
          <td align="center" valign="top" class="b">&nbsp;</td>
          <td>&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
        </tr>
         
         
         
         
      </tbody>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" class="graph-table-res">
      <tbody>
         
        <tr  >
        <td width="26" align="left" valign="top" >&nbsp;</td>
          <td width="451"  valign="middle">
          
    Averages across all 6 campaigns
              </td>
          <td width="92" valign="middle" class="cellCenter" ><strong>28.97%
          </strong></td>
          <td width="83" valign="middle" class="cellCenter"><strong>13.23%
          </strong></td>
          <td width="89" valign="middle" class="cellCenter"><strong>3.34%
          </strong></td>
           <td width="112" valign="middle" class="cellCenter"><strong>0.94%
          </strong></td>
          <td width="105" valign="middle" class="cellCenter"><strong>0.11%</strong></td>
        </tr>
        <tr  >
          <td align="left" valign="top" >&nbsp;</td>
          <td  valign="middle">&nbsp;</td>
          <td valign="middle" class="cellCenter" >&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
          <td valign="middle" class="cellCenter">&nbsp;</td>
        </tr>
     
      </tbody>
    </table>
    <table class="tableFooter" width="100%" cellpadding="0" 
cellspacing="0">
      <tbody>
        <tr>
          <td class="left" align="right">&nbsp;
         </td>
          <td class="right"> <table width="290" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
    <td align="right">
Export this report as a <select >
              
              <option selected="selected"  >Select CSV</option>
          
            </select> </td>
    <td><img src="images/export.gif" alt="Export" class="export"  /></td>
  </tr>
</table>  </td>
        </tr>
      </tbody>
    </table>
 
         
</div>
<!--body end-->


<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
