<?php 
$rec=array();
$object=new main();
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
			header("location:".get_page_link(44)."");
			exit;
			
		}
	}
}


?>
<div class="content-cont-inner">
<div class="content-left">
    <form onsubmit="return validateformStep1();" method="post" name="registration" action="<?php echo home_url(); ?>/?page_id=19">
      <div id="div-Form">
        <div class="form-title">Create  Profile Step1</div>
        <div class="requiredfields"><span class="red">*</span> Required Fields </div>
        <div class="register-form">
          <div align="center" class="errer-mess2"></div>
          <dl class="form1">
            <dt>Email address <span class="red">*</span></dt>
            <dd>
              <input type="text" onchange="member_emailcheck(this.value,'emailerr');" value="" id="email" class="inputs" name="email">
              <input type="hidden" id="emailerr" name="emailerr">
              <input type="hidden" id="metroIds" name="metroIds">
            </dd>
            <dt> Subscriptions List <span class="red">*</span></dt>
            <dd>
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
            <dd>
              <input type="submit" value="Next" name="but" class="next-bt">
            </dd>
          </dl>
          <div class="signup"> </div>
        </div>
      </div>
    </form>
  </div>
<?php get_sidebar('adtingo2'); ?>  
</div>