<?php 
$rec=array();
include_once("includes/header.php");
include_once("includes/functions.php");


if($_POST['but']!='')
{
	print_r($_POST);
	$error_mess='Please enter';

	unset($_SESSION['metroIds']);
	unset($_SESSION['Memberemail']);
	if($_POST['email']=='')
	{
		$error_mess.=' Email';
	
	}
	if($_POST['metroIds']=='')
	{
		$error_mess.=', Metropolitan Area';
	
	}
	if($_POST['email']!='' && $_POST['metroIds']!='')
	{
		$SqlGetUserDetails=sprintf("select * FROM tbl_members  where email_address='%s'",$object->stripper($_POST['email']));
		$QryGetUserDetails=$object->ExecuteQuery($SqlGetUserDetails);
		$numrows=$object->NumRows($QryGetUserDetails);
		
		
		if($numrows>0)
		{
			$error_mess='Email already exists';
		
		}
		else
		{
			session_start();
			$_SESSION['Memberemail']=$_POST['email'];
			$_SESSION['metroIds']=$_POST['metroIds'];
			header("Location:registration-step2.php");
			exit;
		}
	}
}


?>

  
 <form action="registration.php" name="registration" method="post" onSubmit="return validateformStep1();" ><div id="div-Form">
       
	    <div class="form-title">Create  Profile Step1</div> <div class="requiredfields"><span class="red">*</span> Required Fields </div>

        <div class="register-form">
		<div class="errer-mess2" align="center"><?php echo $error_mess;?></div>
        <dl class="form1">
       	 <dt>Email address <span class="red">*</span></dt><dd><input name="email" type="text" class="inputs" id="email"
  value="<?php echo $_POST['email'];?>" onchange="member_emailcheck(this.value,'emailerr');">      <input type="hidden" name="emailerr"  id="emailerr" /> <input type="hidden" name="metroIds" id="metroIds"/></dd>
  <dt> Subscriptions List <span class="red">*</span></dt><dd>
           <div class="subscriptions">
                <ul class="subscriptions-fields">
       					  <?php
					  $object=new main;
			echo $object->GetmetropolitianareasCheckbox($_REQUEST['mid'],'member');
		   ?>
                </ul>
          </div>
          </dd>  
          <dt></dt>
          <dd><input type="submit" class="greenButton" name="but"  value="Next" /></dd>
		</dl>
        
      	   
        
           
           <div class="signup">
           </div>
            
       </div>
      </div></form>
   <?php include_once("includes/sidebar.php"); ?>
  <?php include_once("includes/footer.php"); ?>