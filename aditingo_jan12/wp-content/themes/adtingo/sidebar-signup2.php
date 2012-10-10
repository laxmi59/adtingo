<?php 
$object=new main();
if($_SESSION['Memberid']=='' || $_SESSION['metroIds']=='')
{		
		header("location:".get_page_link(5)."");
			exit;
}

//echo $_SESSION['Memberid'];
if($_POST['but']!='' )
{
//echo $_SESSION['Memberid'];
	$firstname=$_POST["fname"];
	$lastname=$_POST["lname"];
	//$homecity=$_POST["city"];
	$month=$_POST["monthreg"];
	$year=$_POST["yearreg"];
	$date="01";
	if($year <>0 && $month<>0){	$dob=$year."-".$month."-".$date;}else{ $dob="";}
	$gender=$_POST["gender"];
	//$education=$_POST["education"];
	$income=$_POST["income"];
	//$interest=$_POST["interest"];
	$status="1";
		echo $month;
	$error_message='';
		
	$insert="update `tbl_members` set `full_name`='$firstname', `last_name`='$lastname', `dob`='$dob', `gender`='$gender', `income`='$income', `contact_time`='1', `status`='$status' where `memberid`='".$_SESSION['Memberid']."'"; 
	$qry=$object->ExecuteQuery($insert);
	if($qry){
		unset($_SESSION['Memberemail']);
		unset($_SESSION['metroIds']);
		header("location:".get_page_link(58)."/?msg=reg");
		exit;
	}
}
list($birthdatemonths,$birthdatedays,$birthdateyears)=dateArray($_POST['month'],'',$_POST['year'],date("Y")-70,date("Y")-10);
//echo $birthdatemonths;
?>
<div class="content-cont-inner">
  <div class="content-left">
<form method="post" name="regisstration1" action=""><div id="div-Form">
       
	    <div class="form-title">Create  Profile Step2</div><div class="requiredfields"><span class="red">*</span> Required Fields </div>

        <div class="register-form">	<div align="center" class="errer-mess2"></div>
      	  <dl class="form1">
          <dt>First Name  </dt>
          <dd><input type="text" value="<?php echo $_REQUEST['fname'];?>" id="fname" name="fname">
          </dd>
          <dt>Last Name  </dt>
          <dd><input type="text" value="<?php echo $_REQUEST['lname'];?>" id="lname" name="lname">
          </dd>
       
         <!-- <dt>Home City </dt><dd><input type="text" value="" id="city" name="city"></dd>-->
           <dt>Date of Birth  </dt>
		   
		   <dd>
		   <select name="monthreg"  class="w-127" id="monthreg"><option value="">Month</option><?php echo $birthdatemonths;?></select> &nbsp; <select name="yearreg" id="yearreg"  class="w-127"><option value="">Year</option><?php echo $birthdateyears;?></select>
        
         </dd>
          <dt>Gender  </dt><dd class="gender">
          	<input type="radio" value="male" name="gender"> <label>Male</label>
            <input type="radio" value="female" name="gender"> Female
          </dd>
         
          <?php /*?><dt>Education  </dt><dd>
		  
            <select name="education" id="education"><option value="">Select</option>
		 <?php echo getEducation($_REQUEST['education']);?></select>
          </dd> <?php */?>
          <dt>Income  </dt><dd><select name="income" id="income" >
		  <option value="">Select Income</option>
		  <?php echo getIncome($_REQUEST['income']);?>
		  </select></dd>
          <?php /*?><dt>Interests and Activities  </dt><dd>
								<select name="interest" id="interest" >
								<option value="">Select Interest And Activities</option>
                  <?php
							echo IntrestAndActivities($_REQUEST['interest']);
		 		  ?>
                        </select></dd><?php */?>
           
                
               <dt></dt>
			   <dd><table cellpadding="0" cellspacing="0" border="0"><tr><td width="45%">
			   
          <input type="button" name="but1" value="Skip" onclick="javascript:window.location='<?=get_page_link(58)?>/?msg=reg'" class="skip-bt"></td><td><input type="submit" name="but" value="Create" class="create-bt" ></td></tr></table>
		  </dd>     
       </dl>
        
           
          <div class="signup">
          </div>
            
       </div>
      </div></form>
  </div>
  <?php get_sidebar('adtingo2'); ?>
</div>
