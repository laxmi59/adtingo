<?
$object=new main(); 
if(isset($_POST['unsub_submit']) && $_POST['unsub_submit']!="")
{
	$sel=mysql_num_rows(mysql_query("select * from `tbl_members` where `email_address`='$_POST[emailaddress]'"));
	if($sel){
		$selnum=mysql_num_rows(mysql_query("select * from `tbl_unsubscribe` where `email`='$_POST[emailaddress]"));
		if($selnum){
			header("location:". get_page_link(99)."/?msg=3");
		}else{
			mysql_query("insert into `tbl_unsubscribe` (`email`,`date`)values('$_POST[emailaddress]',now())");
			$sel_fet=mysql_fetch_array(mysql_query("select * from `tbl_members` where `email_address`='$_POST[emailaddress]'"));
			mysql_query("delete from `tbl_member_metropolitian` where memberid='".$sel_fet['memberid']."'");
			header("location:". get_page_link(99)."/?msg=1");
		}
	}else{
		header("location:". get_page_link(99)."/?msg=2");
	}
	
}

if($_GET['msg']==1)
$mess="You have been successfully unsubscribed from aditingo.";
if($_GET['msg']==2)
$mess='Your email address does not match our records';
if($_GET['msg']==3)
$mess='Your email address already Unsubscribed from aditingo';
?>
<div class="content-cont-inner">
<div class="content-left">
   
      <div id="div-Form">
        <div class="form-title">Unsubscribe</div>
		
		<div style="clear:both"></div>
	    <div><p>&nbsp;</p>
If you no longer wish to receive any emails from Adtingo.com please enter your   email address below and you will be removed. &nbsp;If you would like to continue to   receive our emails but just not as often, or would like to be removed from a   specific list please <a href="<?php echo get_page_link(58); ?>">login</a> here and change your account   preferences. </div>
        <div class="requiredfields"><span class="red">*</span> Required Fields </div>
		 <div align="center" class="errer-mess1">
        <?php  echo "<br>".$mess; ?>
      </div>
        <div class="register-form">
          <div align="center" class="errer-mess2"></div>
		   <form method="post" name="forgotpwd" onsubmit="return validatepwd();">
          <dl class="form1">
           	<dt>Email <span class="red">*</span></dt>
            <dd><input type="text" id="emailaddress" class="inputs" name="emailaddress"> </dd>
            <dt></dt>
            <dd>
              <input type="submit" value="submit" id="unsub_submit" name="unsub_submit" class="submit-bt">
            </dd>
          </dl>
		      </form>
          <div class="signup"> </div>
        </div>
      </div>

  </div>
<?php get_sidebar('adtingo2'); ?>  
</div>
