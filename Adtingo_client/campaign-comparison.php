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

//$camp=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_campaigns` WHERE `campaign_id`=$_GET[rid]"));
//$getreport=charts($camp['mailing_ID']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Adtingo</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="css/css.css" rel="stylesheet"  />
</head>
<script type="text/javascript" src="js/javascript.js"></script>
<body>
<!--header start-->
<?php include('includes/header.php'); ?> 
<!-- banner end-->

<!--body start-->
 <div class="body">
      <div class="title"><h2>Campaign Comparison Report</h2> </div> 
 
      <form action="campaign-show-results.php" method="post" onsubmit="return campaign_comparison();">                              
            <div class="grey-box">
                <h3 class="grad-box">Select Campaign List</h3>
                <dl class="form">
                    <dt><select name="jumpMenu[]" id="jumpMenu" onchange="" multiple="multiple" >
					<?php
						$ss=mysql_query("SELECT * FROM `tbl_campaigns` WHERE `clientid` =$Clientid AND `status` =3 AND `template_id` <>0 AND `mailing_ID` <>0");
						$num= mysql_num_rows($ss);
						while($camp_list_fet=mysql_fetch_array($ss)){ 
						$getreport=charts($camp_list_fet['mailing_ID']);
			$deliveredCount=$getreport->deliveredCount;
			if($deliveredCount==0){ continue;}else{?>
						<option value="<?php echo $camp_list_fet['campaign_id']?>"><?php echo $camp_list_fet['campaign_name']?></option>
					<?php }}?>
                 </select>   </dt>
                  </dl>
             </div>
           <div class="button_left">
          <input name="submit" src="images/show-results-bt.gif"  type="image" />
        </div>
    </form>  
</div>
<!--body end-->


<!--footer start-->
 <?php include('includes/footer.php'); ?> 
<!--footer end-->
</body>
</html>
