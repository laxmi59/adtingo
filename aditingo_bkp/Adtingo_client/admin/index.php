<?php
session_start();
$nav=17;
include_once('includes/header.php');
if(isset($_POST['username']) && $_POST['username']!='')
{
	  $checkusername=sprintf("select * from tbl_admin where admin_pwd='%s' and admin_username='%s' and admin_status='%s'",$_POST['password'],$_POST['username'],$object->stripper(1));  
	$chkresult=$object->ExecuteQuery($checkusername);
	 $rows=$object->NumRows($chkresult);
		if($object->NumRows($chkresult)>0)
		{
			$chkrows=$object->FetchArray($chkresult);
			$_SESSION['AdminID']=$chkrows['adminid'];
			$_SESSION['Username']=$chkrows['admin_username'];
			$_SESSION['Email']=$chkrows['admin_email'];
			header("location:manageadmin.php");
			exit;
		}
		else
		{
				header("location:index.php?msg=wrong");
				exit;
		}
}

?>
 
      <table width="40%" border="0" cellspacing="0" cellpadding="0" style="margin-top:50px;">
      <tr><td  align='center' class='v-bottom' height="18" > 
	  	<?php
				if($_REQUEST['msg']=="wrong")
				echo "<span class='errer-mess2'>Invalid Username and Password</span>";
				if($_REQUEST['msg']=="logout")
				echo "<span class='success-msg'>You have been logged out successfully</span>";
				if($_REQUEST['msg']=="expired")
				echo "<span class='success-msg'>Your session has been expired. Please login again</span>";
			?>	</td></tr>
			<tr>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" class="form-headings">Admin login</td>
      </tr>

      <tr>
        <td class="form-bg"><form action="" method="POST" name="adminfrm" onsubmit="return validateadminfrm();">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" align="left"></td>
            <td height="10" align="left"></td>
            <td height="10" align="left"></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
            <td height="30" align="left">Username<span class="red">*</span></td>
            <td align="left"><input name="username" type="text" class="inputs" id="username" /></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
            <td height="30" align="left">Password<span class="red">*</span></td>
            <td align="left"><input name="password" type="password" class="inputs" id="password" /></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
            <td height="30" align="left">&nbsp;</td>
            <td align="left"><input name="button" type="submit" class="button" id="button" value="Login" /></td>
          </tr>
        </table></form></td>
      </tr>
    </table>
 
 <?php include('includes/footer.php'); ?>