<?php
include("includes/adminsessions.php");
include("includes/functions.php");
$TemplateName=$_REQUEST['image']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITETITLE."View Template Preview"?></title>
</head>

<body>
<!--<img src="images/<?php echo $TemplateName;?>"  />-->
<img width="483" height="594" src="http://clients.adtingo.com/Campaign_templates/Campaign_template1/images/<?php echo $TemplateName;?> " />
</body>
</html>