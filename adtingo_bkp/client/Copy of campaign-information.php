<?php 
error_reporting(0);
include_once('includes/functions.php'); 
//include('includes/dbfiler.php'); 
include_once('includes/values.php'); 
$object=new main();

$TotalRecords=$object->GetTotalNumRecords($_SESSION['arealist']);
if(isset($_POST['step4submit_x_x']))
{
	if($_POST['compaignname']!='' && $_POST['subjectline']!='' && $_POST['intrestAndactivities']!='' && $_POST['templatename']!='')
		{
		$_SESSION['campaign']['compaignname']=$_POST['compaignname'];
		$_SESSION['campaign']['subjectline']=$_POST['subjectline']; 
		$_SESSION['campaign']['intrestAndactivities']=$_POST['intrestAndactivities']; 
		$_SESSION['campaign']['templatename']=$_POST['templatename']; 
		header("location:add-own-template.php");
		exit;
		}
		else
		{
			$compaignname_error="";
			$subjectline_error="";
			$intrestAndactivities_error="";
			$templatename_error="";
			if($_POST["compaignname"]=="")
				{
				$compaignname_error="Campaign Name Required";
				$_SESSION['campaign']['compaignname']="";
				}
				else
				$_SESSION['campaign']['compaignname']=$_POST["compaignname"];
				if($_POST["subjectline"]=="")
				{
				$subjectline_error="Subject Line Required";
				$_SESSION['campaign']['subjectline']="";
				}
				else
				$_SESSION['campaign']['subjectline']=$_POST["subjectline"];
				if($_POST["intrestAndactivities"]=="")
				{
				$intrestAndactivities_error="Category Required";
				$_SESSION['campaign']['intrestAndactivities']="";
				}
				else
				$_SESSION['campaign']['intrestAndactivities']=$_POST["intrestAndactivities"];
				if($_POST["templatename"]=="")
				{
				$templatename_error="Select template Required";
				$_SESSION['campaign']['templatename']="";
				}
				else
				$_SESSION['campaign']['templatename']=$_POST["templatename"];
		}  
		
}		
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
      <div class="title"><h2>Campaign Information</h2><img src="images/step2.gif" alt="Step 1 of 4"   /></div> 
 
      <form  action="" method="post" name="signupForm5" id="signupForm5">                              
            <div class="grey-box">
                <h3 class="grad-box">Campaign Information</h3> 
              <dl class="form">
                <dt>Campaign Name</dt>
                <dd><input   name="compaignname" id="compaignname" tabindex="2"  type="text" value="<?php if($_SESSION['campaign']['compaignname']!="") echo $_SESSION['campaign']['compaignname'] ;?>"  />
				<br/>
				 <span class="red">
		     <?php if($compaignname_error!="") echo $compaignname_error;?>
             </span>
				</dd>
                <dt>Subject Line </dt>
                <dd><input   name="subjectline" id="subjectline"  tabindex="2" type="text" value="<?php if($_SESSION['campaign']['subjectline']!="") echo $_SESSION['campaign']['subjectline'] ;?>" />
				<br/>
				 <span class="red">
				 <?php if($subjectline_error!="") echo $subjectline_error;?>
				 </span>
				</dd>
                <dt>Select Category</dt>
                <dd><select name="intrestAndactivities" id="intrestAndactivities"> 
				<option value="">Select Category</option>
                <?php
				 if($_SESSION['campaign']['intrestAndactivities']!="")
				  $value=$_SESSION['campaign']['intrestAndactivities']; 
							echo IntrestAndActivities_dropdown($value);
		 		  ?>
				</select>
				<br/>
				<span class="red">
				 <?php if($intrestAndactivities_error!="") echo $intrestAndactivities_error;?>
				 </span>
				</dd>  
              </dl>               
              <h3 class="grad-box">Campaign Creation</h3> 
              <dl class="form">
                <dt>Select template</dt>
                <dd> <input type="radio" name="templatename" id="templatename1" value="1"  <?php if($_SESSION['campaign']['templatename']=='1') { ?> checked="checked" <?php } ?> /> 
                  Template 1 
                  <input type="radio" class="m-left5" name="templatename" id="templatename2" value="2" <?php if($_SESSION['campaign']['templatename']=='2') { ?> checked="checked" <?php } ?>/> 
                  Template 2 
                  <input type="radio" class="m-left5" name="templatename" id="templatename3" value="3" <?php if($_SESSION['campaign']['templatename']=='3') { ?> checked="checked" <?php } ?> /> 
                  Template 3
				  <br/>
				  <span class="red">
				 <?php if($templatename_error!="") echo $templatename_error;?>
				 </span>
				  </dd> 
              </dl> 
             </div>

          <a href="step4.php" class="left"><img src="images/back.gif" class="m-right5" alt="Back" /></a><input   src="images/next.gif"  type="image" name="step4submit_x" id="step4submit_x" /> 

    </form>  
</div>



<!--footer-->
 <?php include('includes/footer.php'); ?> 
<!--End footer-->
</body>
</html>
