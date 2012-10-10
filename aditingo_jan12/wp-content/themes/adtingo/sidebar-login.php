<?php 
session_start();
if($_SESSION['memberid']<>''){ header('location:/view-profile');}
if($_REQUEST['cid']){
	$CampaignID=base64_decode($_REQUEST['cid']);
}
//echo $CampaignID;
$object=new main();  
if($_REQUEST['mes']=="log") {
session_unset();
session_destroy();
header("location:".get_page_link(58)."?mes=logout");
exit;
}  
if(isset($_POST['Member_submit']) && $_POST['Member_submit']!="")
{

   $checkusername="SELECT * FROM `tbl_members` WHERE `email_address`='".$_POST['member_email']."' and `password`='".$_POST['member_pwd']."' and `status`='1'"; 
	$chkresult=$object->ExecuteQuery($checkusername);
	$ResInfo=$object->FetchArray($chkresult);
	$rows=$object->NumRows($chkresult); 
	if($rows)
	{
		$chkrows=$object->FetchArray($chkresult);
			$_SESSION['memberid']=$ResInfo['memberid'];
			if($CampaignID)
			{
				$_SESSION['camapaign_id']=$CampaignID;
			}
			header("location:".get_page_link(38)."");
			exit;
	}
	else
	{
		if(strpos($_SERVER['REQUEST_URI'], "?" )){
		
			header("location:".get_page_link(58)."?msg=invalid");
			exit;
		}
		else
		{
		header("location:".get_page_link(58)."/?msg=invalid");
			exit;
		}
			
	}
}
if($_GET['msg']==2)
$mess='Your email address does not match our records';
if($_GET['msg']==1)
$mess='Login details have been sent to your email address';
?>

<div class="content-cont-inner">
<form name="login" method="post" action="" onSubmit="return validateloginform();">
<div class="content-left">
    <div id="div-Form">
      <div class="form-title">Login</div>
      <div class="requiredfields"><span class="red">*</span> Required Fields </div>
      <div align="center" class="errer-mess">
        <?php  echo $mess; ?>
      </div>
	  	<?php if($_REQUEST['msg']=="invalid") {?>
		<div align="center" class="errer-mess" >Invalid Email and password</div>
		<?php } ?>
		<?php if($_REQUEST['mes']=="logout") {
		session_unset();
		session_destroy();
		?>
		<div align="center" class="errer-mess" >You have been logged out successfully</div>
		<?php } ?>
		<?php if($_REQUEST['msg']=="exp") {?>
		<div align="center" class="errer-mess" >Your session has been expired. Please login again</div>
		<?php } ?>
		<?php if($_REQUEST['msg']=="reg") {?>
		<div align="center" class="errer-mess" >Your account has been created successfully</div>
		<?php } ?>
      <div class="login">
        <dl class="form1">
          <dt>Email Address <span class="red">*</span></dt>
          <dd>
            <input type="text" id="member_email" value="<?php if($_GET['mid']){ echo $_GET['mid'];}?>" name="member_email">
          </dd>
          <dt>Password <span class="red">*</span></dt>
          <dd>
            <input type="password" id="member_pwd" name="member_pwd">
          </dd>
          <dt></dt>
          <dd>
            <input type="submit" value="Submit" class="submit-bt" name="Member_submit">
          </dd>
          <dt></dt>
          <dd><a href="<?php echo get_page_link(22); ?>">Forgot Password ?</a></dd>
        </dl>
      </div>
    </div>
  </div>
   </form>
<?php get_sidebar('adtingo2'); ?>  
</div>